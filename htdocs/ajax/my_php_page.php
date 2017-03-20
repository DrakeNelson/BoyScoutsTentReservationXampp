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

set_time_limit (0);
require_once 'login.php';
$email = $username;
$checker = 1;
$groupcount=0;
$individualcount=0;
//echo $email.$password;

// Create connection
$conn = mysqli_connect($servername, $email, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
//echo "Connected successfully";
}
// if this page was not called by AJAX, die
if (!$_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') die('Invalid request');

// get variable sent from client-side page
$my_variable = isset($_POST['my_variable']) ? strip_tags($_POST['my_variable']) :null;

$sql = "SELECT count(usergroup.BSAID),usergroup.groupid, staffgroups.tentid
		FROM usergroup LEFT JOIN staffgroups ON usergroup.groupid=staffgroups.groupname
		GROUP BY groupid;
		";
if ($res = mysqli_query($conn, $sql)) {
	while ($row = mysqli_fetch_row($res)) {
		if($row[2]==0){
			//loop through groups 
			//$row[] indexes: 0=># of members in group 1=> groupname 2=>tentID
			$sqlForGenderAndAgeForGroup = "SELECT importedstafferinfotable.Gender, importedstafferinfotable.AgeGroup
									FROM importedstafferinfotable JOIN usergroup ON usergroup.BSAID = importedstafferinfotable.BSAMemberNumber 
									WHERE usergroup.groupid = '$row[1]'";
			$resultForGenderAndAgeForGroup = $conn->query($sqlForGenderAndAgeForGroup);
			//$genderAndAgeForGroup this is gender/age for the current group
			$genderAndAgeForGroup=$resultForGenderAndAgeForGroup->fetch_array(MYSQLI_BOTH);
			

			$acceptableTent=false;
			$tentIndex=0;
			while($acceptableTent==false){
				$sqlForTents="SELECT tentid, NumberOfMembers
							FROM tent
							WHERE (NumberOfMembers+$row[0])<=4
							ORDER BY tentid ASC
							LIMIT $tentIndex,1";
				$resultForTent = $conn->query($sqlForTents);
				$minimumTent=$resultForTent->fetch_array(MYSQLI_BOTH);
				//the $minimumTent variable here holds the minimum tent ID 
				
				//get the gender/age for the tent will return null if tent is empty i think
				$sqlForGenderAndAgeForTent = "SELECT importedstafferinfotable.Gender, importedstafferinfotable.AgeGroup
										FROM importedstafferinfotable JOIN usersintent ON usersintent.bsaid = importedstafferinfotable.BSAMemberNumber 
										WHERE usersintent.tentID = '$minimumTent[0]'";
				$resultForGenderAndAgeForTent = $conn->query($sqlForGenderAndAgeForTent);
				//this is the gender/age for current tent
				$genderAndAgeForTent=$resultForGenderAndAgeForTent->fetch_array(MYSQLI_BOTH);				
				
				//check the age/gender for tent matches group
				if(($genderAndAgeForGroup[0]==$genderAndAgeForTent[0]&&$genderAndAgeForGroup[1]==$genderAndAgeForTent[1])||$genderAndAgeForTent==null){
					//set the tent to full if it is now full
					if($minimumTent[1]+$row[0]==4){
						$sqlUpdateTentToFull="UPDATE tent SET isFull=1 WHERE tentID=$minimumTent[0]";
						if ($conn->query($sqlUpdateTentToFull) === TRUE) {
						//echo "Group tent Assigned successfully";
						} else {
							echo "Error updating record: aaa" . $conn->error;
						}
					}
					//set the groups tentid
					$sqlUpdateStaffGroup = "UPDATE staffgroups SET tentid = $minimumTent[0] 
											WHERE groupname =$row[1]";
					if ($conn->query($sqlUpdateStaffGroup) === TRUE) {
						//echo "Group tent Assigned successfully";
					} else {
						echo "Error updating record: aaa" . $conn->error;
					}
					//add the users to the usersintent table
					$sqlGetUsersInGroup = "SELECT bsaid FROM usergroup WHERE groupid = $row[1]";
					if ($resultForUsersInGroup = mysqli_query($conn, $sqlGetUsersInGroup)) {
						while ($rowForUsers = mysqli_fetch_row($resultForUsersInGroup)) {
							$sqlInsertUsersIntoUsersInTent="INSERT INTO usersintent VALUES ('$rowForUsers[0]','$minimumTent[0]')";
							if ($conn->query($sqlInsertUsersIntoUsersInTent) === TRUE) {
								//echo "$rowForUsers[0] Assigned successfully";
							} else {
								echo "Error updating record: bbbb" . $conn->error;
							}
						}
					}else{
						echo "error inserting users into tents";
					}
					//update the tent table to reflect the change in group
					$sqlUpdateTentNumberOfMembers = "UPDATE tent SET NumberOfMembers=NumberOfMembers+$row[0] WHERE tentid = $minimumTent[0]";
					if ($conn->query($sqlUpdateTentNumberOfMembers) === TRUE) {
						//echo "tentNumOfMembers incremented successfully";
					} else {
						echo "Error updating record: cccc" . $conn->error;
					}
					
					$acceptableTent=true;
				}
				
				//increment the tent index so that next time through the minimum tent tries to acquire the next one on the list
				$tentIndex=$tentIndex+1;
			}
		}
	}	
}


$sql = "SELECT BSAMemberNumber,Gender,AgeGroup 
		FROM importedstafferinfotable 
		WHERE BSAMemberNumber not in (SELECT BSAID FROM usersintent)
		";
if ($res = mysqli_query($conn, $sql)) {
	while ($row = mysqli_fetch_row($res)) {
		//looping through all members not in tents
		//indexes $row[0]=bsaid $row[1]=gender $row[2] =agegroup
		
		//c/p starts here
			$acceptableTent=false;
			$tentIndex=0;
			while($acceptableTent==false){
				$sqlForTents="SELECT tentid,NumberOfMembers
							FROM tent
							WHERE NumberOfMembers<4
							ORDER BY tentid ASC
							LIMIT $tentIndex,1";
				$resultForTent = $conn->query($sqlForTents);
				$minimumTent=$resultForTent->fetch_array(MYSQLI_BOTH);
				//the $minimumTent variable here holds the minimum tent ID 
				
				//get the gender/age for the tent will return null if tent is empty i think
				$sqlForGenderAndAgeForTent = "SELECT importedstafferinfotable.Gender, importedstafferinfotable.AgeGroup
										FROM importedstafferinfotable JOIN usersintent ON usersintent.bsaid = importedstafferinfotable.BSAMemberNumber 
										WHERE usersintent.tentID = '$minimumTent[0]'";
				$resultForGenderAndAgeForTent = $conn->query($sqlForGenderAndAgeForTent);
				//this is the gender/age for current tent
				$genderAndAgeForTent=$resultForGenderAndAgeForTent->fetch_array(MYSQLI_BOTH);				
				
				//check the age/gender for tent matches individual
				if(($row[1]==$genderAndAgeForTent[0]&&$row[2]==$genderAndAgeForTent[1])||$genderAndAgeForTent==null){
					//set the tent to full if it is now full
					if($minimumTent[1]+1==4){
						$sqlUpdateTentToFull="UPDATE tent SET isFull=1 WHERE tentID=$minimumTent[0]";
						if ($conn->query($sqlUpdateTentToFull) === TRUE) {
						//echo "Group tent Assigned successfully";
						} else {
							echo "Error updating record: aaa" . $conn->error;
						}
					}
					//add the users to the usersintent table
					$sqlInsertUsersIntoUsersInTent="INSERT INTO usersintent VALUES ('$row[0]','$minimumTent[0]')";
					if ($conn->query($sqlInsertUsersIntoUsersInTent) === TRUE) {
						//echo "Record updated successfully";
					} else {
						echo "Error updating record: " . $conn->error;
					}
					
					//update the tent table to reflect the change in group
					$sqlUpdateTentNumberOfMembers = "UPDATE tent SET NumberOfMembers=NumberOfMembers+1 WHERE tentid = $minimumTent[0]";
					if ($conn->query($sqlUpdateTentNumberOfMembers) === TRUE) {
						//echo "tentNumOfMembers incremented successfully";
					} else {
						echo "Error updating record: cccc" . $conn->error;
					}
					
					$acceptableTent=true;
				}
				
				//increment the tent index so that next time through the minimum tent tries to acquire the next one on the list
			$tentIndex=$tentIndex+1;
		}		
	}
}

mysqli_free_result($res);

mysqli_close($conn);
?>
<h1  style="color:white;"> You have added the entire staff to tents.</h1>
