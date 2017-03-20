<?php
date_default_timezone_set("America/Chicago"); 

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
$Teammate1Name="";
$Teammate2Name="";
$Teammate3Name="";
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
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($teammateExist1){
	$duplicateQueryString = "SELECT BSAID FROM usergroup WHERE BSAID LIKE '$Teammate1'";
	$legitimateQueryString ="SELECT BSAMemberNumber, Gender, AgeGroup, FirstName, LastName FROM importedstafferinfotable WHERE BSAMemberNumber LIKE '$Teammate1'";
	$inTentQueryString ="SELECT BSAID FROM usersintent WHERE BSAID LIKE '$Teammate1';";
	$resultDupe  = $conn->query($duplicateQueryString);
	$resultLegit = $conn->query($legitimateQueryString);
	$resultInTent= $conn->query($inTentQueryString);
	if ($resultLegit ->fetch_object()==null){
		$validityChecker=false;
		$failString = "Pref Teammate #1 BSAID is invalid";
	} else if($resultDupe->fetch_object()!=null) {
		$validityChecker=false;
		$failString = "Pref Teammate #1 BSAID is already in another team";
	}else if($resultInTent->fetch_object()!=null){
		$validityChecker=false;
		$failString = "Pref Teammate #1 has been assigned to a tent contact admin for removal";
	}else{
		$row111 = ($conn->query($legitimateQueryString));
		$row=$row111->fetch_array(MYSQLI_BOTH);
		if($Gender !=$row[1]){
			$validityChecker=false;
			$failString = "Pref Teammate #1 must be $Gender";
		}
		if($BirthDate !=$row[2]){
			$validityChecker=false;
			$failString = "Pref Teammate #1 must be  $BirthDate";
		}
		$Teammate1Name=$row[3] . " " . $row[4];
	}
}
if($teammateExist2){
	$duplicateQueryString = "SELECT BSAID FROM usergroup WHERE BSAID LIKE '$Teammate2'";
	$legitimateQueryString ="SELECT BSAMemberNumber, Gender, AgeGroup, FirstName, LastName FROM importedstafferinfotable WHERE BSAMemberNumber LIKE '$Teammate2'"; 
	$resultDupe  = $conn->query($duplicateQueryString);
	$resultLegit = $conn->query($legitimateQueryString);
	$inTentQueryString ="SELECT BSAID FROM usersintent WHERE BSAID LIKE '$Teammate2';";
	$resultInTent= $conn->query($inTentQueryString);

	if ($resultLegit ->fetch_object()==null){
		$validityChecker=false;
		$failString = "Pref Teammate #2 BSAID is invalid";
	} else if($resultDupe->fetch_object()!=null) {
		$validityChecker=false;
		$failString = "Pref Teammate #2 BSAID is already in another team";
	}else if($resultInTent->fetch_object()!=null){
		$validityChecker=false;
		$failString = "Pref Teammate #2 has been assigned to a tent contact admin for removal";
	}else{
		$row111 = ($conn->query($legitimateQueryString));
		$row=$row111->fetch_array(MYSQLI_BOTH);
		if($Gender !=$row[1]){
			$validityChecker=false;
			$failString = "Pref Teammate #2 must be $Gender";
		}
		if($BirthDate !=$row[2]){
			$validityChecker=false;
			$failString = "Pref Teammate #2 must be  $BirthDate";
		}			
		$Teammate2Name=$row[3] . " " . $row[4];
	}
}

if($teammateExist3){
	$duplicateQueryString = "SELECT BSAID FROM usergroup WHERE BSAID LIKE '$Teammate3'";
	$legitimateQueryString ="SELECT BSAMemberNumber, Gender, AgeGroup, FirstName, LastName FROM importedstafferinfotable WHERE BSAMemberNumber LIKE '$Teammate3'"; 
	$resultDupe  = $conn->query($duplicateQueryString);
	$resultLegit = $conn->query($legitimateQueryString);
	$inTentQueryString ="SELECT BSAID FROM usersintent WHERE BSAID LIKE '$Teammate3';";
	$resultInTent= $conn->query($inTentQueryString);

	if ($resultLegit ->fetch_object()==null){
		$validityChecker=false;
		$failString = "Pref Teammate #3 BSAID is invalid";
	} else if($resultDupe->fetch_object()!=null) {
		$validityChecker=false;
		$failString = "Pref Teammate #3 BSAID is already in another team";
	}else if($resultInTent->fetch_object()!=null){
		$validityChecker=false;
		$failString = "Pref Teammate #3 has been assigned to a tent contact admin for removal";
	}else{
		$row111 = ($conn->query($legitimateQueryString));
		$row=$row111->fetch_array(MYSQLI_BOTH);
		if($Gender !=$row[1]){
			$validityChecker=false;
			$failString = "Pref Teammate #3 must be $Gender";
		}
		if($BirthDate !=$row[2]){
			$validityChecker=false;
			$failString = "Pref Teammate #3 must be  $BirthDate";
		}			
		$Teammate3Name=$row[3] . " " . $row[4];
	}
}

if($validityChecker==true){		
		$sql = "insert into usergroup (BSAID,groupid) values ('$BsaId','$Gname');";
			if($conn->query($sql)){
			// echo "sql executed";
			}else{
			echo $conn->error;
			}
		//		if($teammateExist1)				{$sql .= "insert into usergroup (BSAID,groupid) values ('$Teammate1','$Gname');";}
		if($teammateExist2)				{				
		$sql="insert into usergroup (BSAID,groupid) values ('$Teammate2','$Gname');";
			if($conn->query($sql)){
			// echo "sql executed";
			}else{
			echo $conn->error;
			}
		}
		if($teammateExist1)				{				
		$sql="insert into usergroup (BSAID,groupid) values ('$Teammate1','$Gname');";
			if($conn->query($sql)){
			// echo "sql executed";
			}else{
			echo $conn->error;
			}
		}
		if($teammateExist3)				{				
		$sql="insert into usergroup (BSAID,groupid) values ('$Teammate3','$Gname');";
			if($conn->query($sql)){
			 //echo "sql executed";
			}else{
			echo $conn->error;
			}
		}
		//$sql .= "insert into usergroup (BSAID,groupid) values ('$Teammate2','$Gname');";}
//		if($teammateExist3)				{$sql .= "insert into usergroup (BSAID,groupid) values ('$Teammate3','$Gname');";}
		$sql = 						         "insert into staffgroups (groupname) values ('$Gname');";
			if($conn->query($sql)){
			 //echo "sql executed";
			}else{
			echo $conn->error;
			}
			//this is the emailer
$to      = $Email;
$subject = 'Tent Mate Reservation Confirmation';
$headers = 'From: webmaster@21products.com' . "\r\n" .
    'Reply-To: no respons' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
		// The message email
		$message = "Hello $FirstName,\r\n\r\nYour requested grouping has been processed and your tent at the 2017 Boy Scouts Jamboree will have the following members:\r\n$Teammate1Name\r\n$Teammate1Name\r\n$Teammate2Name\r\n$Teammate3Name\r\n$FirstName $LastName\r\n\r\n Thank you for using the Tent Reservation System, See you at the Jamboree!";
       		$message = wordwrap($message, 70, "\r\n");

mail($to, $subject, $message, $headers);

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
			<a id="header_0_LogoHyperLink" href="http://www.summitbsa.org/events/jamboree/overview/"><img id="header_0_JamboreeLogoImage" title="Jamboree" src="jamboreeLogoNew.jpg" style="border-width:0px;" /></a>
			<a id="header_2_LogoHyperLink" href="http://www.scouting.org/"><img id="header_2_BSALogoImage" title="BSA" src="BSA_Title_Logo.jpg" style="border-width:0px;float: right" /></a>
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
						<li><?php echo $FirstName . " " . $LastName ?> </li>
                        <?php if($teammateExist1): ?>
						<li><?php echo $Teammate1Name; ?> </li>
						<?php endif; if($teammateExist2): ?>
                        <li><?php echo $Teammate2Name; ?> </li>
						<?php endif; if($teammateExist3): ?>
                        <li><?php echo $Teammate3Name; ?> </li>
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
						