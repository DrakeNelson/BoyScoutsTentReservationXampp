<?php
require_once 'login.php';
$email = $username;
session_start();
date_default_timezone_set("America/Chicago"); 


if(isset($_SESSION['checker'])){
	$checker=$_SESSION['checker'];
}
$counter = 0;
if($checker==0){
	header('Location: admin.php');
	exit();
}
// Create connection
$conn = mysqli_connect($servername, $email, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
//echo "Connected successfully";
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
    <link rel="stylesheet" href="table.css">
	<link rel = "stylesheet" href = "buttonstyle.css"type="text/css"/>
	
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
                <li><a id="header_1_rptItems_ctl01_lnkItem" href="adminSignOn.php?checker=<?php echo $checker ?>">Admin</a></li>
           		<li><a id="header_1_rptItems_ctl02_lnkItem" href="endsession.php">Log Out</a></li>
			</ul>
        </div>
    </div>
    <div id="wrapper-body">
        <div id="left-column">
            <div id="left-element" class="left-element">

                <h3><a id="leftcolumn_0_SectionHeaderHyperLink" href="/Home/BrandGuide.aspx">Navigation</a></h3>
				<ul>
					<a id="leftcolumn_0_CategoryRepeater_ctl00_CategoryHyperLink" href="adminSignOn.php">Admin Home</a>
					<br />
				</ul>
				<ul>
					<a id="leftcolumn_0_CategoryRepeater_ctl00_CategoryHyperLink" href="adminUpdateUsers.php">Update Users</a>
					<br />
				</ul>
				<ul>
					<a id="leftcolumn_0_CategoryRepeater_ctl00_CategoryHyperLink" href="adminTentReport.php">Tent Report</a>
					<br />
				</ul>
				<ul>
					<a id="leftcolumn_0_CategoryRepeater_ctl00_CategoryHyperLink" href="userReport.php">User Report</a>
					<br />
				</ul>							

            </div>
        </div>
        <div id="middle-2columnLEFT">
            <div id="breadcrumb">Boy Scouts of America ~ National Jamboree
            </div>
            <div id="middle-element">
                <h1>
                    Update Users
                </h1>
                <p>
                <h2>Update the staff table in database with users from an Excel file.</h2>
				<p>
				***BE VERY CAREFUL WITH THIS FEATURE READ THE FOLLOWING INSTRUCTIONS VERY CAREFULLY***<br>
				Navigate to the .xls file you wish to update the database from.<br>
				This function should only be used if you are absolutely sure the file you are selecting is formatted properly.<br>
				The Following criteria must be met:<br>
				The .xls file chosen should contain only a single spreadsheet in the workbook.<br>
				The columns of the excel file should be the following IN ORDER: <br>
				Registration Code, BSA Member Number, Attendee Type, First Name, Last Name, Gender<br>
				No extra columns can be read, it doesnt matter what the headers are called or if they exist but these must be in order.<br>
				<img src="sampleExcelFile.png" alt="Sample XLS File">
					<form action="adminUploadNewUsers.php" method="post" enctype="multipart/form-data">
						Select .xls file:
						<input type="file" name="fileToUpload" id="fileToUpload"><br><br>
						<input type="submit" value="Update Database" name="submit">
					</form>
				</p>
            </div>
        </div>
    </div>
    <div id="footer">

        <h3 id="footer_0_FooterCopyright">&copy; 2016 Boy Scouts of America - All Rights Reserved</h3>
    </div>

</div>
</body>
</html>