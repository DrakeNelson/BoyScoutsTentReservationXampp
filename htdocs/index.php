
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

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
						<a id="header_0_LogoHyperLink" href="http:\\www.google.com"><img id="header_0_JamboreeLogoImage" title="Jamboree" src="jamboreelogo.jpg" style="border-width:0px;" /></a>
						<a id="header_2_LogoHyperLink" href="http:\\www.google.com"><img id="header_2_BSALogoImage" title="BSA" src="BSA_Title_Logo.jpg" style="border-width:0px;float: right" /></a>
					</div>
				</div>

				<div id="wrapper-nav">
					<div class="nav">
						<ul>

							<li><a id="header_1_rptItems_ctl00_lnkItem" href="index.php">Tent Request</a></li>
							<li><a id="header_1_rptItems_ctl01_lnkItem" href="admin.html">Admin</a></li>
						</ul>
					</div>
				</div>
				<div id="wrapper-body">
					<div id="left-column">
						<div id="left-element" class="left-element">

							<h3><a id="leftcolumn_0_SectionHeaderHyperLink" href="">SideBar</a></h3>
						</div>
					</div>
					<div id="middle-2columnLEFT">
						<div id="breadcrumb">Boy Scouts of America ~ National Jamboree
						</div>
						<div id="middle-element">
							<h1>
							Tent Request Form
							</h1>
							<p>
								<h2>Fill out this Form to Request Tent Mates.</h2>	
								<p>Please ensure that all BSA IDs are accurate or the form will be deemed invalid</p>
								<form class="form-basic" method="post" action="FormFunction.php">	
									<div class="form-row">
										<label>
											<span>My BSA ID:</span>
											<input type="text" name="bsaid" id="bsaid" placeholder= "BSA ID Number">
										</label>
									</div>					
									<div class="form-row">
										<label>
											<span>My Jamboree ID:</span>
											<input type="text" name="jamid" id="jamid" placeholder="Jamboree registration number">				
										</label>
									</div>
									<div class="form-row">
										<label>
											<span>First Name:</span>
											<input type="text" name="fname" id="fname" placeholder="First Name"> 
										</label>
									</div>		
									<div class="form-row">
										<label>
											<span>Last Name:</span>
											<input type="text" name="lname" id="lname" placeholder="Last Name">                
										</label>
									</div>
									<div class="form-row">
										<label>
											<span>Group Name:</span>
											<input type="text" name="gname" id="gname" placeholder="Group Name">                
										</label>
									</div>
									<div class="form-row">
										<label>
											<span>Email:</span>
											<input type="email" name="email" id="email" placeholder="Email">
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
									<div class="form-row">
										<button type="submit">Submit Form</button>
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
						