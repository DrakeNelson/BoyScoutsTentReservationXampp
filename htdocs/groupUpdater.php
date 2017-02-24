<?php
$groupid = $_REQUEST['groupid'];
$tentid = $_REQUEST['tentid'];
$checker = 1;
require_once 'login.php';
$email = $username;
//echo $email.$password;

// Create connection
$conn = mysqli_connect($servername, $email, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
//echo "Connected successfully";
}
$sql = "UPDATE staffgroups SET tentid = $tentid WHERE groupid LIKE '$groupid'";

if ($conn->query($sql) === TRUE) {
    //echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$sql = "SELECT COUNT(*) 
		FROM usergroup JOIN staffgroups ON usergroup.groupid=staffgroups.groupname
		WHERE staffgroups.tentid LIKE '$tentid'";

if ($result = mysqli_query($conn, $sql)) {
	while ($row = mysqli_fetch_row($result)) {
		//echo $row[0];
		$memCount = $row[0];
		$sqlTwo = "SELECT COUNT(*)
					FROM usersintent 
					WHERE TentID = '$tentid'";
		if ($resultTwo = mysqli_query($conn, $sqlTwo)) {
			while ($rowTwo = mysqli_fetch_row($resultTwo)) {
				$memCount = $memCount + $rowTwo[0];
			}
		}			
		if($memCount==4){
			$sql = "UPDATE tent SET IsFull = 1, NumberOfMembers=4 WHERE tentid=$tentid";
			if ($conn->query($sql) === TRUE) {
				//echo "tent full bool updated successfully";
			} else {
				echo "Error updating record: " . $conn->error;
			}
		}else{
			$sql = "UPDATE tent SET NumberOfMembers=$memCount WHERE tentid=$tentid";
			if ($conn->query($sql) === TRUE) {
				//echo "tent numofmems updated successfully";
			} else {
				echo "Error updating record: " . $conn->error;
			}
		}
	}
}
$usersInTentSql = "SELECT usergroup.BSAID, staffgroups.groupname 
					FROM usergroup JOIN staffgroups ON staffgroups.groupname=usergroup.groupid
					WHERE staffgroups.groupid like '$groupid';";
$result = $conn->query($usersInTentSql);
$sql2=" ";
while($row = $result->fetch_array())
{
	$sql2 .= "INSERT INTO usersintent (BSAID, TentID) VALUES ($row[0] , $tentid);";
}

if ($conn->multi_query($sql2) === TRUE) {
    //echo "New records created successfully";
} else {
    echo "Error: " . $sql2 . "<br>" . $conn->error;
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
		<h1 style="color:white;" > Group: <?php echo $groupid;?> Assigned to Tent: <?php echo $tentid;?></h1>
		<h2 style="color:white;" > Refresh Page to View Changes</h2>
	</p>
</html>