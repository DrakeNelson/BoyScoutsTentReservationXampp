<?php
$checker = $_REQUEST['checker'];
if($checker==1){
	$email = "root";
	$password = "";
}else{
	$email 					= $_POST["email"];
	$password 				= $_POST["password"];
}
if($email!="root"){
	header('Location: admin.html');
	exit();
}

//$dbname 				= "boyscoutdatabase";
//$servername 			= "localhost";



//echo $email.$password;

// Create connection
//$conn = mysqli_connect($servername, $email, $password,$dbname);
//// Check connection
//if ($conn->connect_error) {
//    die("Connection failed: " . $conn->connect_error);
//} else{
////echo "Connected successfully";
//}

//$sql="SELECT groupid,groupname, tentid, IsApproved FROM staffgroups";

//if ($result=mysqli_query($conn,$sql))
//  {
//  // Fetch one and one row
//  while ($row=mysqli_fetch_row($result))
//    {
//    printf ("%s (%s) (%s)\n",$row[0],$row[1], $row[2]);
//    }
//  // Free result set
//  mysqli_free_result($result);
//}

//mysqli_close($conn);


//$queryString = "SELECT AdminName, Password FROM admin";
//$result = mysqli_query($conn,$queryString);
//
//if($result->fetch_object()->AdminName){
//	echo "test passed";
//}
$checker = 1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
	<head id="Head1"><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><title>
	Tent Manager
		</title>
		<link href="examplecss.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="form-login.css">
		<link rel="stylesheet" href="table.css">
		<script type="text/javascript">

		</script>
	</head>

		<body>
			<div id="wrapper">
				<br />

				<div id="wrapper-header">
					<div id="logo">
						<a id="header_0_LogoHyperLink" href="http://www.summitbsa.org/events/jamboree/jamboree-registration/"><img id="header_0_JamboreeLogoImage" title="Jamboree" src="jamboreelogo.jpg" style="border-width:0px;" /></a>
						<a id="header_2_LogoHyperLink" href="http://www.scouting.org/"><img id="header_2_BSALogoImage" title="BSA" src="BSA_Title_Logo.jpg" style="border-width:0px;float: right" /></a>
					</div>
				</div>

				<div id="wrapper-nav">
					<div class="nav">
						<ul>

							<li><a id="header_1_rptItems_ctl00_lnkItem" href="index.php">Tent Request</a></li>
							<li><a id="header_1_rptItems_ctl01_lnkItem" href="adminSignOn.php?checker=<?php echo $checker ?>">Admin</a></li>
						</ul>
					</div>
				</div>
				<div id="wrapper-body">
					<div id="left-column">
						<div id="left-element" class="left-element">

							<h3><a id="leftcolumn_0_SectionHeaderHyperLink" href="/Home/BrandGuide.aspx">SideBar</a></h3>

							<ul>
								<a id="leftcolumn_0_CategoryRepeater_ctl00_CategoryHyperLink" href="adminGroupReport.php">Group Report</a>

								<br />
							</ul>

							<ul>
								<a id="leftcolumn_0_CategoryRepeater_ctl01_CategoryHyperLink" href="">Item</a>

								<br />
							</ul>
							
						</div>
					</div>
					<div id="middle-2columnLEFT">
						<div id="breadcrumb">Boy Scouts of America ~ National Jamboree
						</div>
						<div id="middle-element">
							<h1>
							Administration
							</h1>
							<p>
								<h2>Logged In as Tent Manager</h2>	
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