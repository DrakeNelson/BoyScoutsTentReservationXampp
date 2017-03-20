<?php
session_start();
if(isset($_SESSION['checker'])){
	$checker=$_SESSION['checker'];
}
$counter = 0;
if($checker==0){
	header('Location: admin.php');
	exit();
}
$bsaid = $_REQUEST['BSAID'];
$tentid = $_REQUEST['tentid'];
$checker = 1;
require_once 'login.php';
$email = $username;
$password = $password;
//echo $email.$password;

// Create connection
$conn = mysqli_connect($servername, $email, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
//echo "Connected successfully";
}
$sql = "INSERT INTO usersintent (BSAID,TentID) VALUES ('$bsaid', '$tentid')";

if ($conn->query($sql) === TRUE) {
    //echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$sql = "SELECT NumberOfMembers 
		FROM tent 
		WHERE tentid LIKE '$tentid'";

if ($result = mysqli_query($conn, $sql)) {
	while ($row = mysqli_fetch_row($result)) {
		$memnumint = $row[0]+1;
		if($row[0]==3){
			$sql = "UPDATE tent SET IsFull = 1, NumberOfMembers=4 WHERE tentid=$tentid";
			if ($conn->query($sql) === TRUE) {
				//echo "tent full bool updated successfully";
			} else {
				echo "Error updating record: " . $conn->error;
			}
		}else{
			$sql = "UPDATE tent SET NumberOfMembers=$memnumint WHERE tentid=$tentid";
			if ($conn->query($sql) === TRUE) {
				//echo "tent numofmems updated successfully";
			} else {
				echo "Error updating record: " . $conn->error;
			}
		}
	}
}

$sql = "SELECT FirstName, LastName FROM importedstafferinfotable WHERE  BSAMemberNumber like '$bsaid'";
if ($result = mysqli_query($conn, $sql)) {
	while ($row = mysqli_fetch_row($result)) {
		$userName = $row[0]." ".$row[1];
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
		<link rel="stylesheet" href="table.css"/>
		<link rel="stylesheet" href="buttonstyle.css"/>
		<script type="text/javascript">

		</script>
	</head>
	<p>
		<h1 style="color:white;" > User: <?php echo $userName;?> Assigned to Tent: <?php echo $tentid;?></h1>
		<h2 style="color:white;" > Refresh Page to View Changes</h2>
	</p>
	
</html>