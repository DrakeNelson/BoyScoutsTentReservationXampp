<?php
$BsaId  = $_POST["bsaid"];
$JamId  = $_POST["jamid"];
require_once 'login.php';
$gender = "";

$conn   = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$statusString = "";
$queryString = "SELECT BSAMemberNumber, RegCode, Gender, FirstName, LastName, AgeGroup, Email FROM importedstafferinfotable WHERE BSAMemberNumber = '$BsaId' AND RegCode = '$JamId'";
$result =$conn->query($queryString);
if (!$result->num_rows > 0) {
    $failString = "Fail at main user";
    header('Location: index.php');
    exit();
} else {
	$statusString="good";
	if ($result = mysqli_query($conn, $queryString)) {
		while ($row = mysqli_fetch_row($result)) {
			$gender = $row[2];
			$fname  = $row[3];
			$lname  = $row[4];
			$dob    = $conn->real_escape_string($row[5]);
			$Email  = $row[6];
		}
	}
}
$conn->close();
?>

<html xmlns="http://www.w3.org/1999/xhtml" >
	<head id="Head1"><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><title>
	Tent Manager
		</title>
		<link href="examplecss.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="form-basic.css">
		<script type="text/javascript">

		</script>
	</head>

		<body>
			<div id="wrapper">
				<br />

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
							<li><a id="header_1_rptItems_ctl01_lnkItem" href="adminSignOn.php">Admin</a></li>
						</ul>
					</div>
				</div>
				<div id="wrapper-body">
					<div id="left-column">
						<div id="left-element" class="left-element">

						</div>
					</div>
					<div id="middle-2columnLEFT">
						<div id="breadcrumb">Boy Scouts of America ~ National Jamboree
						</div>
						<div id="middle-element">
							<h1>
							Tent Mate Request
							</h1>
							<p>
								<h2>Click Yes To Continue</h2>	
								<p>You may edit the Email field if you would prefer to be contacted via a different Email address. Click "Yes" to continue to the next page and request tent mates</p>
								<form class="form-basic" method="post" action="tentRequestTwo.php">	
									<div class="form-row">
										<label>
											<span>My BSA ID:</span>
											<input type="text" name="bsaid" id="bsaid" value = <?php echo $BsaId;?> readonly>
										</label> 
									</div>					
									<div class="form-row">
										<label>
											<span>My Jamboree ID:</span>
											<input type="text" name="jamid" id="jamid" value = <?php echo $JamId;?> readonly>				
										</label>
									</div>
									<div class="form-row">
										<label>
											<span>First Name:</span>
											<input type="text" name="fname" id="fname" value = <?php echo $fname;?>  readonly> 
										</label>
									</div>		
									<div class="form-row">
										<label>
											<span>Last Name:</span>
											<input type="text" name="lname" id="lname" value = <?php echo $lname;?> readonly>                
										</label>
									</div>
									<div class="form-row">
										<label>
											<span>Staff Type:</span>
											<input type="text" name="dob" id="dob" value=<?php echo $dob;?> readonly>                
										</label>
									</div>
									<div class="form-row">
										<label>
											<span>Gender:</span>
											<input type="text" name="Gender" value = <?php echo $gender;?> id="Gender" readonly>                
										</label>
									</div>
									<div class="form-row">
										<label>
											<span>Email:</span>
											<input type="email" name="email"  id="email" required value=<?php echo $Email;?>>
										</label>
									</div>
									<div class="form-row">
										<button type="submit">Yes</button>
									</div>
								</form>
							</p>
						</div>
					</div>
				</div>
				<div id="footer">
					<h3 id="footer_0_FooterCopyright">&copy; 2016 Boy Scouts of America - All Rights Reserved</h3>
				</div>

			</div>
			</script>
	</body>
</html>
						