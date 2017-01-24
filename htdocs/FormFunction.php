<?php
$BsaId     = $_POST["bsaid"];
$FirstName = $_POST["fname"];
$LastName  = $_POST["lname"];
$Email     = $_POST["email"];
$Gname     = $_POST["gname"];
$Gender    = $_POST["Gender"];
$BirthDate = $_POST["dob"];
$Teammate1 = $_POST["mate1"];
$Teammate2 = $_POST["mate2"];
$Teammate3 = $_POST["mate3"];
require_once 'login.php';
$validityChecker = true;
$failString = "";

$teammateExist1=false;
$teammateExist2=false;
$teammateExist3=false;
if($Teammate1!=null){
	$teammateExist1=true;
}
if($Teammate2!=null){
	$teammateExist2=true;
}
if($Teammate3!=null){
	$teammateExist3=true;
}

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
if($teammateExist1){
	$duplicateQueryString = "SELECT BSAID FROM usergroup WHERE BSAID LIKE '$Teammate1'";
	$legitimateQueryString ="SELECT BSAMemberNumber FROM importedstafferinfotable WHERE BSAMemberNumber LIKE '$Teammate1'"; 
	$resultDupe  = mysqli_query($conn, $duplicateQueryString);
	$resultLegit = mysqli_query($conn, $legitimateQueryString);

	if ($resultLegit ->fetch_object()==null){
		$validityChecker=false;
		$failString = "Pref Teammate #1 BSAID is invalid";
	} else if($resultDupe->fetch_object()!=null) {
		$validityChecker=false;
		$failString = "Pref Teammate #1 BSAID is already in another team";
	}
}

if($teammateExist2){
	$duplicateQueryString = "SELECT BSAID FROM usergroup WHERE BSAID LIKE '$Teammate2'";
	$legitimateQueryString ="SELECT BSAMemberNumber FROM importedstafferinfotable WHERE BSAMemberNumber LIKE '$Teammate2'"; 
	$resultDupe  = mysqli_query($conn, $duplicateQueryString);
	$resultLegit = mysqli_query($conn, $legitimateQueryString);
	if ($resultLegit ->fetch_object()==null){
		$validityChecker=false;
		$failString = "Pref Teammate #2 BSAID is invalid";
	} else if($resultDupe->fetch_object()!=null) {
		$validityChecker=false;
		$failString = "Pref Teammate #2 BSAID is already in another team";
	}
}

if($teammateExist3){
	$duplicateQueryString = "SELECT BSAID FROM usergroup WHERE BSAID LIKE '$Teammate3'";
	$legitimateQueryString ="SELECT BSAMemberNumber FROM importedstafferinfotable WHERE BSAMemberNumber LIKE '$Teammate3'"; 
	$resultDupe  = mysqli_query($conn, $duplicateQueryString);
	$resultLegit = mysqli_query($conn, $legitimateQueryString);

	if ($resultLegit ->fetch_object()==null){
		$validityChecker=false;
		$failString = "Pref Teammate #3 BSAID is invalid";
	} else if($resultDupe->fetch_object()!=null) {
		$validityChecker=false;
		$failString = "Pref Teammate #3 BSAID is already in another team";
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
                <li><a id="header_1_rptItems_ctl01_lnkItem" href="admin.php">Admin</a></li>
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
                        <?php if($teammateExist1): ?>
						<li><?php echo $Teammate1; ?> </li>
						<?php endif; if($teammateExist2): ?>
                        <li><?php echo $Teammate2; ?> </li>
						<?php endif; if($teammateExist3): ?>
                        <li><?php echo $Teammate3; ?> </li>
						<?php endif; ?>
                    </ul>
                    </p>
                    </p>
                <?php else: ?>
                    <h1> Please navigate back and correct the following error: </h1><?php echo $failString; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div id="footer">

        <h3 id="footer_0_FooterCopyright">&copy; 2016 Boy Scouts of America - All Rights Reserved</h3>
    </div>

</div>
</body>
</html>
						