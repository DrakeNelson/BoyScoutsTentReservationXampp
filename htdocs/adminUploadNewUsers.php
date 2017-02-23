<?php
require_once 'login.php';
$email = $username;
session_start();
if(isset($_SESSION['checker'])){
	$checker=$_SESSION['checker'];
}
$counter = 0;
if($checker==0){
	header('Location: admin.php');
	exit();
}
// Create connection
//$conn = mysqli_connect($servername, $email, $password, $dbname);
$mysqli = new mysqli($servername, $email, $password, $dbname);
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
	//echo "upload ready to procede";
        $uploadOk = 1;
}
// Allow certain file formats
if($imageFileType != "xls") {
	header('Location: adminUpdateUsers.php?redirectMsg=1');
	exit();
}
if ($uploadOk != 0) {
// if everything is ok, try to upload file

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

//echo "<br>".$target_file."<br>";
require_once 'Classes/PHPExcel/IOFactory.php';

$inputFileType = 'Excel5';
$inputFileName = $target_file;

$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objPHPExcelReader = $objReader->load($inputFileName);

$loadedSheetNames = $objPHPExcelReader->getSheetNames();

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcelReader, 'CSV');

date_default_timezone_set('America/Chicago');
$date = date('_m_d_Y', time());
//echo $date."<br>";
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

                <h3><a id="leftcolumn_0_SectionHeaderHyperLink" href="/Home/BrandGuide.aspx">SideBar</a></h3>
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
                    Administration
                </h1>
                <p>
                <h2>The Following Users Were Added To The Database</h2>
                <h3>If any of this data appears to be eroneous or does not match column headings of the table contact a system administrator immediately</h3>
				<p>If a fatal error timeout occurs refresh the page and confirm the resubmission</p>
                <table class="container">
                    <thead>
                    <tr>
                        <th><h1 style="color:#ddeeff;">Reg Code</h1></th>
                        <th><h1 style="color:#ddeeff;">BSA #</h1></th>
                        <th><h1 style="color:#ddeeff;">Group</h1></th>
                        <th><h1 style="color:#ddeeff;">First Name</h1></th>
                        <th><h1 style="color:#ddeeff;">Last Name</h1></th>
                        <th><h1 style="color:#ddeeff;">Gender</h1></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
					foreach($loadedSheetNames as $sheetIndex => $loadedSheetName) {
						$objWriter->setSheetIndex($sheetIndex);
						$objWriter->save('uploads\\'.$loadedSheetName.$date.'.csv');
//						echo $loadedSheetName."<br>";
						$file = file_get_contents('uploads\\'.$loadedSheetName.$date.'.csv');
						$data = array_map("str_getcsv", preg_split('/\r*\n+|\r+/', $file));
						foreach($data as $row){
							if($row[0]!='Reg Code'&&$row[0]!=null){
							$rc=$mysqli->real_escape_string($row[0]);
							$bs=$mysqli->real_escape_string($row[1]);							
							
							$at=$mysqli->real_escape_string($row[2]);
							$age;
							if (strpos($at, '16') !== false) {
								$age="under26";
							}else if (strpos($at, '26') !== false) {
								$age="over26";
							}else if (strpos($at, 'youth') !== false){
								$age="under26";
							}else{
								$age="over26";
							}
							$fn=$mysqli->real_escape_string($row[3]);							
							$ln=$mysqli->real_escape_string($row[4]);
							$ge=$mysqli->real_escape_string($row[5]);

								
								$sql = "SELECT * FROM importedstafferinfotable WHERE BSAMemberNumber='$bs'";
								$result = $mysqli->query($sql);
								if ($result->num_rows > 0) {
									
								} else {
									$queryStringTwo = "INSERT INTO importedstafferinfotable 
											(FirstName,LastName,BSAMemberNumber,Gender,AttendeeType,RegCode,AgeGroup)
											VALUES('$fn','$ln','$bs','$ge','$at','$rc','$age')
											ON DUPLICATE KEY UPDATE BSAMemberNumber=BSAMemberNumber";
									if ($mysqli->query($queryStringTwo) === TRUE) {
									
					?>
						<tr>
							<td><?php echo $row[0] ?></td>
							<td><?php echo $row[1] ?></td>							
							<td><?php echo $row[2] ?></td>
							<td><?php echo $row[3] ?></td>							
							<td><?php echo $row[4] ?></td>
							<td><?php echo $row[5] ?></td>
						</tr>
					<?php
								} else {
										echo "Error: q2 " . $queryStringTwo . "<br>";
									}
								}
							}
						}
					} 
					// ALTER TABLE `cron-stats` ADD CONSTRAINT tb_un UNIQUE (`user`)
					$mysqli->close();
                    ?>

                    </tbody>
                </table>
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