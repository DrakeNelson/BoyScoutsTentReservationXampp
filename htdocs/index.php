
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
								<h2>Enter the following to log in</h2>	
								<p>Enter your BSA ID number and your Jamboree Registration Code then click "continue".</p>
								<form class="form-basic" method="post" action="tentRequest.php">	
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
						