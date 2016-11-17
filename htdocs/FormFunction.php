<?php
$BsaId = $_POST["bsaid"];
$JamId = $_POST["jamid"];
$FirstName = $_POST["fname"];
$LastName = $_POST["lname"];
$Email = $_POST["email"];
$Gname = $_POST["gname"];
$Teammate1 = $_POST["mate1"];
$Teammate2 = $_POST["mate2"];
$Teammate3 = $_POST["mate3"];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boyscoutdatabase";
$validityChecker = false;
$failString = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$queryString = "SELECT BSAMemberNumber FROM importedstafferinfotable WHERE BSAMemberNumber LIKE '$BsaId'";
$result = mysqli_query($conn, $queryString);

if (!$result->fetch_object()->BSAMemberNumber) {
    $failString = "Fail at main user";
    header('Location: index.php');
    exit();
} else {
    echo "Main User exists in the reference table\n";
    $queryString = "SELECT BSAMemberNumber FROM importedstafferinfotable WHERE BSAMemberNumber LIKE '$Teammate2'";
    $result = mysqli_query($conn, $queryString);

    if (!$result->fetch_object()->BSAMemberNumber) {
        echo "Fail at Teammate 2\n";
        $failString = "Fail at Teammate 2";
    } else {
        echo "User 2 exists in the reference table\n";
        $queryString = "SELECT BSAMemberNumber FROM importedstafferinfotable WHERE BSAMemberNumber LIKE '$Teammate3'";
        $result = mysqli_query($conn, $queryString);

        if (!$result->fetch_object()->BSAMemberNumber) {
            echo "Fail at Teammate 3";
            $failString = "Fail at Teammate 3";
        } else {
            echo "User 3 exists in the reference table\n";
            $queryString = "SELECT BSAMemberNumber FROM importedstafferinfotable WHERE BSAMemberNumber LIKE '$Teammate1'";
            $result = mysqli_query($conn, $queryString);

            if (!$result->fetch_object()->BSAMemberNumber) {
                echo "Fail at Teammate 1";
                $failString = "Fail at Teammate 1";
            } else {
                echo "User 1 exists in the reference table\n";
                echo "all users pass test Creating Group";

                $queryString = "SELECT groupid FROM staffgroups WHERE groupname LIKE '$Gname'";
                $result = mysqli_query($conn, $queryString);

                if (!$result->fetch_object()->groupid) {
                    $insertString = "INSERT INTO staffgroups (groupid,tentid) VALUES('$Gname',0) ";
                    if ($conn->query($insertString) === TRUE) {
                        echo "New group created successfully";
                        $insertString = "INSERT INTO usergroup (groupid,JAMID) VALUES('$Gname',$BsaId) ";
                        if ($conn->query($insertString) === TRUE) {
                            echo "user added to group";
                        }
                        $insertString = "INSERT INTO usergroup (groupid,JAMID) VALUES('$Gname',$Teammate3) ";
                        if ($conn->query($insertString) === TRUE) {
                            echo "user added to group";
                        }
                        $insertString = "INSERT INTO usergroup (groupid,JAMID) VALUES('$Gname',$Teammate2) ";
                        if ($conn->query($insertString) === TRUE) {
                            echo "user added to group";
                        }
                        $insertString = "INSERT INTO usergroup (groupid,JAMID) VALUES('$Gname',$Teammate1) ";
                        if ($conn->query($insertString) === TRUE) {
                            echo "user added to group";
                        }
                        $validityChecker = true;
                    } else {
                        echo "Error: " . $insertString . "<br>" . $conn->error;
                        $failString = "Error: " . $insertString . "<br>" . $conn->error;
                    }
                } else {
                    echo "fail at group name not unique";
                    $failString = "fail at group name not unique";
                }
            }
        }
    }
}

$conn->close();
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>
        Tent Manager
    </title>
    <link href="examplecss.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="form-basic.css">
    <script type="text/javascript">

    </script>
</head>

<body>
<div id="wrapper">
    <br/>

    <div id="wrapper-header">
        <div id="logo">
            <a id="header_0_LogoHyperLink" href="http:\\www.google.com"><img id="header_0_JamboreeLogoImage"
                                                                             title="Jamboree" src="jamboreelogo.jpg"
                                                                             style="border-width:0px;"/></a>
            <a id="header_2_LogoHyperLink" href="http:\\www.google.com"><img id="header_2_BSALogoImage" title="BSA"
                                                                             src="BSA_Title_Logo.jpg"
                                                                             style="border-width:0px;float: right"/></a>
        </div>
    </div>

    <div id="wrapper-nav">
        <div class="nav">
            <ul>

                <li><a id="header_1_rptItems_ctl00_lnkItem" href="index.php">Tent Request</a></li>
                <li><a id="header_1_rptItems_ctl01_lnkItem" href="admin.html">Admin</a></li>
            </ul>
        </div>
    </div>
    <div id="wrapper-body">
        <div id="middle-2columnLEFT">
            <div id="breadcrumb">Boy Scouts of America ~ National Jamboree
            </div>
            <div id="middle-element">

                <?php if ($validityChecker == true): ?>
                    <h1>
                        Thank You <?php echo $FirstName . " " . $LastName . "!" ?>
                    </h1>
                    <p>
                    <h2>Your Request For Tent Mates Has Been Submitted.</h2>
                    <p>You will recieve an email at <?php echo $Email ?> when your request has been processed.</p>
                    <p>You have requested the following members to tent with:
                    <ul>
                        <li><?php echo $BsaId ?> </li>
                        <li><?php echo $Teammate1 ?> </li>
                        <li><?php echo $Teammate2 ?> </li>
                        <li><?php echo $Teammate3 ?> </li>
                    </ul>
                    </p>
                    </p>
                <?php else: ?>
                    <h1> YOU FAIL </h1><?php echo $failString; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div id="footer">

        <h3 id="footer_0_FooterCopyright">&copy; 2016 Boy Scouts of America - All Rights Reserved</h3>
    </div>

</div>
</body>
< / html >
						