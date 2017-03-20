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
$conn = mysqli_connect($servername, $email, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
//echo "Connected successfully";
}
// Create your database query
$query = "SELECT importedstafferinfotable.BSAMemberNumber, importedstafferinfotable.FirstName, importedstafferinfotable.LastName, usersintent.TentID
			FROM importedstafferinfotable LEFT JOIN usersintent ON importedstafferinfotable.BSAMemberNumber=usersintent.BSAID";  

// Execute the database query
$result = $conn->query($query);
require_once 'Classes/PHPExcel.php';

// Instantiate a new PHPExcel object
$objPHPExcel = new PHPExcel(); 
// Set the active Excel worksheet to sheet 0
$objPHPExcel->setActiveSheetIndex(0); 
// Initialise the Excel row number
$rowCount = 1; 

//set headers
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, "BSAMemberNumber"); 
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, "FirstName"); 
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, "LastName"); 
$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, "TentID"); 

$rowCount = 2;
//while($row = $result->fetch_array()){ 
//	//set values
//	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $row['BSAMemberNumber']); 
//	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $row['FirstName']); 
//	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $row['LastName']); 
//	$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $row['TentID']); 
//	$rowCount++; 
//} 
//
//// Instantiate a Writer to create an OfficeOpenXML Excel .xlsx file
//$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
//// Write the Excel file to filename some_excel_file.xlsx in the current directory
//$objWriter->save('uploads/UserReport.xlsx'); 
date_default_timezone_set("America/Chicago");
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
					<a id="leftcolumn_0_CategoryRepeater_ctl00_CategoryHyperLink" href="adminTentReport.php?startIndex=0&indexCount=15">Tent Report</a>
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
				
                <h2>Users</h2>
				Click the image below to download an excel spreadsheet of all the users and to which tent they are assigned
				<a href="/uploads/UserReport.xlsx" download>
				  <img border="0" src="DownloadXLSX.png" alt="download" width="142" height="142">
				</a>
				<FORM action="userReport.php" method="POST">
				You can use this search feature to pull the tent assignment for any individual.</br>
				<input type="checkbox" name="inTents"> Show All Members In Tents</br>
				Search : <SELECT name="cascade" size="1" >
				<OPTION value="bsaid">BSA ID</option>
				<OPTION value="firstname">First Name</option>
				<OPTION value="lastname">Last Name</option>
				<OPTION value="tentid">Tent ID</option>	
				
				</SELECT>
				<input type="text" name="searchbar">
				<input type="submit" value="GO">
				<br />
			<!--THIS NEEDS TO BE FIXED	Sort : <input type="checkbox" name="bsa"> BSA ID <input type="checkbox" name="fn" > First Name <input type="checkbox" name="ln"> Last Name <input type="checkbox" name="tent"> Tent ID-->
				<FORM/>
                <table class="container">
                    <thead>
                    <tr>
                        <th><h1 style="color:#ddeeff;">BSA ID</h1></th>
                        <th><h1 style="color:#ddeeff;">First Name</h1></th>
                        <th><h1 style="color:#ddeeff;">Last Name</h1></th>
                        <th><h1 style="color:#ddeeff;">Tent ID</h1></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
        //
		//			if(!empty($_POST))
		//			{
		//				$asdf = $_POST['searchbar'];
		//				$sql = "SELECT FirstName, LastName, BSAMemberNumber FROM importedstafferinfotable LIKE '$asdf%'";
						if($_POST['cascade']=="bsaid"){
							$index="BSAMemberNumber";
						}
						//if(isset($_POST['bsa'])){
						//	$result.sort
						//}
		//					$sql = "SELECT BSAMemberNumber FROM importedstafferinfotable LIKE $asdf";
		//					if(isset($_POST['bsa'])){
		//						$query .= " ORDER BY BSAMemberNumber";
		//					}
		//				}
		 				if($_POST['cascade']=="firstname"){
		 					$index="FirstName";
		 				}
						if($_POST['cascade']=="lastname"){
							$index="LastName";
						}
						if($_POST['cascade']=="tentid"){
							$index="TentID";
						}
		//				//$sql = "SELECT FirstName, LastName, BSAMemberNumber FROM importedstafferinfotable LIKE '$asdf%'";
        //            if ($result = mysqli_query($conn, $sql)) {
        //                while ($row = mysqli_fetch_row($result)) { 
						while($row = $result->fetch_array()){ 
							//set values
							$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $row['BSAMemberNumber']); 
							$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $row['FirstName']); 
							$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $row['LastName']); 
							$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $row['TentID']); 
							$rowCount++; 
						if(isset($_POST['inTents'])){
							//if($row[$index]==$_POST['searchbar']){
								if($row['TentID']!=null){
							?>
								<tr>
									<td><?php echo $row['BSAMemberNumber']; ?></td>
									<td><?php echo $row['FirstName']; ?></td>
									<td>
										<?php echo $row['LastName']; ?>
									</td>
									<td>
										<?php
										echo $row['TentID'];
										?>
									</td>
								</tr>
								<?php
									}
							//}
							}else{
								if(isset($_POST['searchbar'])){
								if(strtolower($row[$index])==strtolower($_POST['searchbar'])){
								?>
									<tr>
										<td><?php echo $row['BSAMemberNumber']; ?></td>
										<td><?php echo $row['FirstName']; ?></td>
										<td>
											<?php echo $row['LastName']; ?>
										</td>
										<td>
											<?php
											echo $row['TentID'];
											?>
										</td>
									</tr>
									<?php
									}
								}
							} 
						}

						// Instantiate a Writer to create an OfficeOpenXML Excel .xlsx file
						$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
						// Write the Excel file to filename some_excel_file.xlsx in the current directory
						$objWriter->save('uploads/UserReport.xlsx'); 
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