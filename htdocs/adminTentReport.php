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
                    Administration
                </h1>
                <p>
                <h2>Assign Users To Tents</h2>
                <table class="container">
                    <thead>
                    <tr>
                        <th><h1 style="color:#ddeeff;">Tent ID</h1></th>
                        <th><h1 style="color:#ddeeff;"># Of Members</h1></th>
                        <th><h1 style="color:#ddeeff;">Is Full?</h1></th>
                        <th><h1 style="color:#ddeeff;">Group Members</h1></th>
                        <th><h1 style="color:#ddeeff;">Assign Group</h1></th>
						<th><h1 style="color:#ddeeff;">Remove A Member</h1></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
					$sql = "SELECT tentid, NumberOfMembers, IsFull FROM tent";
                    if ($result = mysqli_query($conn, $sql)) {
                        while ($row = mysqli_fetch_row($result)) { 
						?>
                            <tr>
                                <td><?php echo $row[0] ?></td>
                                <td><?php echo $row[1] ?></td>
                                <td>
									<?php if ($row[2] == 0) {
                                        echo "No";
                                    } else {
                                        echo "Yes";
                                    } ?>
								</td>
                                <td>
                                    <?php
											$sqlFour = "SELECT importedstafferinfotable.FirstName, importedstafferinfotable.LastName 
														FROM importedstafferinfotable JOIN usersintent ON usersintent.BSAID = importedstafferinfotable.BSAMemberNumber 
														WHERE usersintent.tentid like '$row[0]'";
                                            if ($resultFour = mysqli_query($conn, $sqlFour)) {
                                                while ($rowFour = mysqli_fetch_row($resultFour)) {
                                                    echo $rowFour[0] . " " . $rowFour[1] . "<br>";
                                                }
                                            }
                                    ?>
								</td>
                                <td>
									<?php if ($row[2] == 0) { ?>
                                    <button onclick="assignFunction(value)" value = <?php echo $row[0] ?>>Assign</button>
									<script>
										var myWindow;
										function assignFunction(value) {
											myWindow = window.open("grouptableassigner.php?tentid="+value, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=50,width=900,height=900");
										}
									</script>
									<?php }?>
                                </td>
								<td>
									<?php if ($row[1] != 0) { ?>
                                    <button onclick="removeFunction(value)" value = <?php echo $row[0] ?>>Remove</button>
									<script>
										var myWindow;
										function removeFunction(value) {
											myWindow = window.open("groupTableRemover.php?tentid="+value, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=50,width=900,height=900");
										}
									</script>
									<?php }?>
                                </td>
                            </tr>
                            <?php
                        }
                        mysqli_free_result($result);
                        mysqli_free_result($resultFour);
                    }
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