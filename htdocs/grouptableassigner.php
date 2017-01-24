<?php
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
$sqlForTent = "SELECT NumberOfMembers 
				FROM tent  
				WHERE tentid = '$tentid'";
$tentMemCount = 0;
if ($resultForTent = mysqli_query($conn, $sqlForTent)) {
	while ($rowForTent = mysqli_fetch_row($resultForTent)) {
		$tentMemCount = $rowForTent[0];
	}
}	
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
			<th><h1 style="color:#ddeeff;">Group ID</h1></th>
			<th><h1 style="color:#ddeeff;">Group Members</h1></th>
			<th><h1 style="color:#ddeeff;">Tent Id</h1></th>
			<th><h1 style="color:#ddeeff;">Is Approved</h1></th>
			<th><h1 style="color:#ddeeff;">Assign </h1></th>
		</tr>
		</thead>
		<tbody>
		<?php
		$sql = "SELECT groupid, tentid, IsApproved,groupname 
				FROM staffgroups 
				WHERE tentid like '0'";

		if ($result = mysqli_query($conn, $sql)) {
			while ($row = mysqli_fetch_row($result)) { 
			$sqlForGroup = "SELECT COUNT(*) FROM usergroup WHERE groupid LIKE '$row[3]'";
				$groupMemCount=0;
				if ($resultForGroup = mysqli_query($conn, $sqlForGroup)) {
					while ($rowForGroup = mysqli_fetch_row($resultForGroup)) {
						$groupMemCount = $rowForGroup[0];
					}
				}
				if($groupMemCount<= 4 -$tentMemCount ){
					
				?>
				<tr>
					<td><?php echo $row[0] ?></td>
					<td>
						<?php
							$sqlTwo = "SELECT importedstafferinfotable.FirstName, importedstafferinfotable.LastName 
										FROM importedstafferinfotable JOIN usergroup ON usergroup.BSAID = importedstafferinfotable.BSAMemberNumber 
										WHERE usergroup.groupid like '$row[3]'";
							if ($resultTwo = mysqli_query($conn, $sqlTwo)) {
								while ($rowTwo = mysqli_fetch_row($resultTwo)) {
									echo $rowTwo[0] . " " . $rowTwo[1] . "<br>";
								}
							}
						?>
					</td>
					<td><?php echo $row[1] ?></td>
					<td><?php if ($row[2] == 0) {
							echo "No";
						} else {
							echo "Yes";
						} ?>
					</td>
					<td>
					<?php if ($row[2] == 0) { ?>
						<button onclick="myFunction(value)" value = <?php echo $row[0] ?>>Assign</button>
						<script>
						
							function myFunction(value) {
								myWindow = window.open("groupUpdater.php?tentid=<?php echo $tentid;?>&groupid="+value, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=150");
								myWindow.opener.close();
							}
						</script>
						<?php }?>
					</td>
				</tr>
				<?php
				}
			}
			mysqli_free_result($result);
		}
		?>

		</tbody>
	</table>
	</p>
	
	<p>
	<table class="container">
		<thead>
		<tr>
			<th><h1 style="color:#ddeeff;">BSA ID</h1></th>
			<th><h1 style="color:#ddeeff;">First Name</h1></th>
			<th><h1 style="color:#ddeeff;">Last Name</h1></th>
			<th><h1 style="color:#ddeeff;">Code</h1></th>
			<th><h1 style="color:#ddeeff;">Assign </h1></th>
		</tr>
		</thead>
		<tbody>
		<?php
		$sql = "SELECT BSAMemberNumber, FirstName, LastName,Code 
				FROM importedstafferinfotable 
				WHERE BSAMemberNumber NOT IN (SELECT BSAID FROM usergroup) 
				AND BSAMemberNumber NOT IN (SELECT BSAID FROM usersintent)";

		if ($result = mysqli_query($conn, $sql)) {
			while ($row = mysqli_fetch_row($result)) { 
				?>
				<tr>
					<td>
						<?php echo $row[0]; ?>
					</td>
					<td>
						<?php echo $row[1]; ?>
					</td>
					<td>
						<?php echo $row[2]; ?>
					</td>
					<td>
						<?php echo $row[3]; ?>
					</td>
					<td>
					<?php if ($row[2] == 0) { ?>
						<button onclick="myFunction2(value)" value = <?php echo $row[0] ?>>Assign</button>
						<script>
						
							function myFunction2(value) {
								myWindow = window.open("userUpdater.php?tentid=<?php echo $tentid;?>&BSAID="+value, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=150");
								myWindow.opener.close();
							}
						</script>
						<?php }?>
					</td>
				</tr>
				<?php
			}
			mysqli_free_result($result);
		}
		?>

		</tbody>
	</table>
</html>