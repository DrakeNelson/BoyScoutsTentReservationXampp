<?php
$email = "root";
$password = "";
$dbname = "boyscoutdatabase";
$servername = "localhost";
$checker = 1;

//echo $email.$password;

// Create connection
$conn = mysqli_connect($servername, $email, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
//echo "Connected successfully";
}

$sql = "SELECT groupid, tentid, IsApproved,groupname FROM staffgroups";


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
    <link rel="stylesheet" href="table.css">
    <script type="text/javascript">

    </script>
</head>

<body>
<div id="wrapper">
    <br/>

    <div id="wrapper-header">
        <div id="logo">
            <a id="header_0_LogoHyperLink" href="http://www.summitbsa.org/events/jamboree/jamboree-registration/"><img
                    id="header_0_JamboreeLogoImage" title="Jamboree" src="jamboreelogo.jpg" style="border-width:0px;"/></a>
            <a id="header_2_LogoHyperLink" href="http://www.scouting.org/"><img id="header_2_BSALogoImage" title="BSA"
                                                                                src="BSA_Title_Logo.jpg"
                                                                                style="border-width:0px;float: right"/></a>
        </div>
    </div>

    <div id="wrapper-nav">
        <div class="nav">
            <ul>

                <li><a id="header_1_rptItems_ctl00_lnkItem" href="index.php">Tent Request</a></li>
                <li><a id="header_1_rptItems_ctl01_lnkItem"
                       href="adminSignOn.php?checker=<?php echo $checker ?>">Admin</a></li>
            </ul>
        </div>
    </div>
    <div id="wrapper-body">
        <div id="left-column">
            <div id="left-element" class="left-element">

                <h3><a id="leftcolumn_0_SectionHeaderHyperLink" href="/Home/BrandGuide.aspx">SideBar</a></h3>

                <ul>
                    <a id="leftcolumn_0_CategoryRepeater_ctl00_CategoryHyperLink" href="">Item</a>

                    <br/>
                </ul>

            </div>
        </div>
        <div id="middle-2columnLEFT">
            <div id="breadcrumb">Boy Scouts of America ~ National Jamboree
            </div>
            <div id="middle-element">
                <h1>
                    Administration
                </h1>
                <p>
                <h2>Logged In as Tent Manager</h2>
                <table class="container">
                    <thead>
                    <tr>
                        <th><h1 style="color:#ddeeff;">Group ID</h1></th>
                        <th><h1 style="color:#ddeeff;">Group Members</h1></th>
                        <th><h1 style="color:#ddeeff;">Tent Id</h1></th>
                        <th><h1 style="color:#ddeeff;">Is Approved</h1></th>
                        <th><h1 style="color:#ddeeff;">Assign </h1></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($result = mysqli_query($conn, $sql)) {
                        while ($row = mysqli_fetch_row($result)) { ?>
                            <tr>
                                <td><?php echo $row[0] ?></td>
                                <td>
                                    <?php
                                    $sqlTwo = "SELECT JAMID FROM usergroup where groupid like '$row[3]'";
                                    if ($resultTwo = mysqli_query($conn, $sqlTwo)) {
                                        while ($rowTwo = mysqli_fetch_row($resultTwo)) {
                                            $sqlThree = "SELECT FirstName, LastName FROM importedstafferinfotable WHERE BSAMemberNumber LIKE '$rowTwo[0]'";
                                            if ($resultThree = mysqli_query($conn, $sqlThree)) {
                                                while ($rowThree = mysqli_fetch_row($resultThree)) {
                                                    echo $rowThree[0] . " " . $rowThree[1] . "<br>";
                                                }
                                            }
                                        }
                                    }
                                    ?></td>
                                <td><?php echo $row[1] ?></td>
                                <td><?php if ($row[2] == 0) {
                                        echo "No";
                                    } else {
                                        echo "Yes";
                                    } ?></td>
                                '
                                <td>
                                    <form action="http://google.com">
                                        <input type="submit" value="Assign"/>
                                    </form>
                                </td>
                            </tr>
                            <?php
                        }
                        mysqli_free_result($result);
                    }
                    ?>

                    </tbody>
                </table>
                </p>
            </div>
        </div>
    </div>
    <div id="footer">

        <h3 id="footer_0_FooterCopyright">&copy; 2016 Boy Scouts of America - All Rights Reserved</h3>
    </div>

</div>
</body >
< / html >