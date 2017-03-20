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
$tentid = $_REQUEST['tentid'];
require_once 'login.php';
$email = $username;
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
$sqlForGroups = "SELECT importedstafferinfotable.BSAMemberNumber, importedstafferinfotable.FirstName, importedstafferinfotable.LastName 
				FROM importedstafferinfotable JOIN usergroup ON importedstafferinfotable.BSAMemberNumber=usergroup.BSAID
				JOIN staffgroups ON staffgroups.groupname=usergroup.groupid
				JOIN tent ON tent.tentid=staffgroups.tentid
				WHERE tent.tentid = '$tentid'";

	//				JOIN usersintent ON usersintent.TentID=tent.tentid
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
	<h1  style="color:white;"> TENT: <?php echo $tentid;?></h1>
	<table class="container">
		<thead>
		<tr>
			<th><h1 style="color:#ddeeff;">BSA ID</h1></th>
			<th><h1 style="color:#ddeeff;">First Name</h1></th>
			<th><h1 style="color:#ddeeff;">Last Name</h1></th>
			<th><h1 style="color:#ddeeff;">Remove</h1></th>
		</tr>
		</thead>
		<tbody>
		<?php
		$sqlForUsers = "SELECT importedstafferinfotable.BSAMemberNumber, importedstafferinfotable.FirstName, importedstafferinfotable.LastName 
				FROM importedstafferinfotable JOIN usersintent ON importedstafferinfotable.BSAMemberNumber=usersintent.BSAID
				WHERE usersintent.TentID = '$tentid'";
				
		if ($resultForUsers = mysqli_query($conn, $sqlForUsers)) {
			while ($row = mysqli_fetch_row($resultForUsers)) {
		?>
			<tr>
				<td><?php echo $row[0] ?></td>
				<td>
					<?php echo $row[1] ?></td>
				<td><?php echo $row[2] ?></td>
				<td>
				<?php if (true==true) { ?>
					<button onclick="myFunction(value)" value = <?php echo $row[0] ?>>Remove</button>
					<script>
						function myFunction(value) {
							myWindow = window.open("userRemover.php?tentid=<?php echo $tentid;?>&BSAID="+value, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=150");
							myWindow.opener.close();
						}
					</script>
				<?php } ?>
				</td>
			</tr>
			<?php
			}
		}
		?>

		</tbody>
	</table>
	</p>
</html>