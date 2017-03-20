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
$conn = new mysqli($servername, $email, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
//echo "Connected successfully";
}

$sql = "SELECT * FROM usersintent WHERE BSAID = '$bsaid'";
$result = $conn->query($sql);

if ($result->num_rows>0) {
    $sqlTwo="DELETE FROM usersintent WHERE BSAID = '$bsaid'";
	$resultt=$conn->query($sqlTwo);
} else {
    $sql = "SELECT * FROM usergroup WHERE BSAID = '$bsaid'";
	$result = $conn->query($sql);
	if ($result->num_rows>0) {
		$sqlFour="SELECT groupname FROM staffgroups WHERE groupname in (SELECT groupid FROM usergroup WHERE BSAID='$bsaid')";
		$resulttt = $conn->query($sqlFour);
		if($resulttt->num_rows>0){
			while ($row = mysqli_fetch_row($resulttt)) {
				$sqlFive="DELETE FROM staffgroups where groupname = '$row[0]'";
			}
		}
		$sqlTwo="DELETE FROM usergroup WHERE BSAID = '$bsaid'";
		$resultt=$conn->query($sqlTwo);
	}
}

$sql = "SELECT FirstName, LastName FROM importedstafferinfotable WHERE  BSAMemberNumber like '$bsaid'";
if ($result = mysqli_query($conn, $sql)) {
	while ($row = mysqli_fetch_row($result)) {
		$userName = $row[0]." ".$row[1];
	}
}
$sql = "UPDATE tent SET NumberOfMembers=NumberOfMembers-1,IsFull=0 WHERE tentid = '$tentid'";
$thing = $conn->query($sql);
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
		<h1 style="color:white;" > User: <?php echo $userName;?> Removed From Tent: <?php echo $tentid;?></h1>
		<h2 style="color:white;" > Refresh Page to View Changes</h2>
	</p>
	
</html>