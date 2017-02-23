<?php
$BsaId     = $_POST["bsaid"];
$Gender    = $_POST["Gender"];
$BirthDate = $_POST["dob"];
$FirstName = $_POST["fname"];
$LastName  = $_POST["lname"];
$Email     = $_POST["email"];

require_once 'login.php';
$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$queryString = "SELECT COUNT(*) FROM staffgroups";
$result = mysqli_query($conn, $queryString);

if ($result = mysqli_query($conn, $queryString)) {
	while ($row = mysqli_fetch_row($result)) {
		$groupCount = $row[0];
	}
}

$groupCount+=1;
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
								<h2>Create Group by Entering BSA IDs of Prefered Tent Mates</h2>	
								<p>This system will reject any groups in which any of the members are already requested in another group.
								Ensure All of the following BSA ID numbers are accurate before clicking "Continue".</p>
								<form class="form-basic" method="post" action="FormFunction.php">	
									<div class="form-row">
										<label>
											<span>My BSA ID:</span>
											<input type="text" name="bsaid" id="bsaid" value = <?php echo $BsaId;?> readonly>
										</label> 
									</div>	
									<div class="form-row">
										<label>
											<span>Group Id:</span>
											<input type="text" name="gname" id="gname" value = <?php echo $groupCount;?> readonly>                
										</label>
									</div>
									<div class="form-row">
										<label>
											<span>Pref Teammate #1 Bsa ID:</span>
											<input type="text" name="mate1" id="mate1" placeholder="BSA ID number">
										</label>
									</div>
									<div class="form-row">
										<label>
											<span>Pref Teammate #2 Bsa ID:</span>
											<input type="text" name="mate2" id="mate2" placeholder="BSA ID number">
										</label>
									</div>
									<div class="form-row">
										<label>
											<span>Pref Teammate #3 Bsa ID:</span>
											<input type="text" name="mate3" id="mate3" placeholder="BSA ID number">
										</label>
									</div>
									<input type="hidden" name="Gender" id="Gender" value=<?php echo $Gender;?>>
									<input type="hidden" name="dob"    id="dob"    value=<?php echo $BirthDate;?>>
									<input type="hidden" name="fname"  id="fname"  value=<?php echo $FirstName;?>>
									<input type="hidden" name="lname"  id="lname"  value=<?php echo $LastName;?>>
									<input type="hidden" name="email"  id="email"  value=<?php echo $Email;?>>
									<div class="form-row">
										<button type="submit">Continue</button>
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
						
									
