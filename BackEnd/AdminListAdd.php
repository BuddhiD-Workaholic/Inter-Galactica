<?php require_once 'DataBase/config.php';
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Waiting List</title>

	<!--StyleSheet-->
	<link rel="stylesheet" href="CSS/EmpCSS.css" type="text/css" />
	<link rel="shortcut icon" href="images/Icon.jpg">

	<!--Boostrap Starts
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css"> -->

	<!--FontAwsome CDN-->
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" />

	<!--Jquery CDN-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!--Google Translate-->
  <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
 
	<!--SweetAlert CDN-->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<!--JavaScript-->
	<script language="JavaScript" type="text/javascript" src="JSFile.js"></script>
	<script language="JavaScript" type="text/javascript" src="EmpWaitingListvalidation.js"></script>
</head>

<body>
	<!-- Side  bar -->
	<input type="checkbox" id="nav-toggle" />
	<div class="sidebar">
		<div class="sidebar-brand">
			<h2><span class="las la-star-of-life"></span><span>Samurdhi</span></h2>
		</div>
		<!--SideBar Starts-->
		<div class="sidebar-menu">
			<ul>
				<li>
					<a href="EmpDashboard.php"><span class="las la-igloo"></span><span> Dashboard</span></a>
				</li>
				<li>
					<a href="#"><span class="las la-users"></span><span class="openbtn1"> Beneficiary List</span></a>
					<ul class="showtbl1">
						<br />
						<li class="toplist">
							<a href="BeneficiaryList.php"><span class="las la-user-clock"></span><span> View All</span></a>
						</li>
						<?php
						$sql = "SELECT cid,cname FROM `categorysftbl`";
						$results = mysqli_query($con, $sql);
						if (mysqli_num_rows($results) > 0) {
							while ($row = mysqli_fetch_assoc($results)) {
								echo "<li class='toplist'> <a href='BeneficiaryList.php?ViewCat=" . $row['cid'] . "'><span class='las la-user-clock'></span><span> View " . $row['cname'] . "</span></a> </li>";
							}
						}
						?>
					</ul>
				</li>
				<li>
					<a href="#" class="active"><span class="las la-user-clock"></span><span class="openbtn"> Waiting List</span></a>
					<ul class="showtbl">
						<br />
						<li class="toplist">
							<a href="WaitingList.php"><span class="las la-user-clock"></span><span> View All</span></a>
						</li>
						<?php
						$sql = "SELECT cid,cname FROM `categorysftbl`";
						$results = mysqli_query($con, $sql);
						if (mysqli_num_rows($results) > 0) {
							while ($row = mysqli_fetch_assoc($results)) {
								echo "<li class='toplist'> <a href='WaitingList.php?ViewCat=" . $row['cid'] . "'><span class='las la-user-clock'></span><span> View " . $row['cname'] . "</span></a> </li>";
							}
						}
						?>
					</ul>
				</li>
				<li>
					<a href="EmpGNArea.php"><span class="las la-user-times"></span><span> GN Area Manage</span></a>
				</li>
				<li>
					<a href="EmpPayments.php"><span class="las la-money-bill"></span><span> Payment Records</span></a>
				</li>
				<li>
					<a href="CategoryManage.php"><span class="las la-print"></span><span> Category Manage</span></a>
				</li>
				<li>
					<a href="PaymentOFManage.php"><span class="las la-phone"></span><span> Payment Offices</span></a>
				</li>
				<li>
					<a href="ReportGeneration.php"><span class="fal fa-file-chart-pie"></span><span> Report Generation</span></a>
				</li>
				<li>
					<a href="ContactInfo.php"><span class="las la-info-circle"></span><span> Contact Info</span></a>
				</li>
			</ul>
			<!--SideBar Ends-->
		</div>
	</div>
	<!-- Side  bar END-->
	<div class="main-content">
		<!-- header bar -->
		<header>
			<h2>
				<label for="nav-toggle">
					<span class="las la-bars"></span>
				</label><?php
						$sql = "SELECT cname FROM `categorysftbl` where cid='" . $_GET['CAT'] . "'";
						$results = mysqli_query($con, $sql);
						if (mysqli_num_rows($results) > 0) {
							while ($row = mysqli_fetch_assoc($results)) {
								echo "Update waiting list " . $row['cname'] . "";
							}
						}
						?>
			</h2>
			<div class="user-wrapper">
				<div class="notification">
					<?php require_once 'Includes/AgentChangeify.php';  ?>
					<?php require_once 'Includes/Deathify.php';  ?>
					<?php require_once 'Includes/Paymentify.php';  ?>
				</div>
				<img src="Images/user.png" width="38px" height="38px" alt="Error" />
				<!--UserWarapper Starts-->
				<div class="notification">
					<div class="notBtn" href="#">
						<img src="Images/user.png" width="38px" height="38px" alt="Error" />
						<div>
						</div>
						<div class="box">
							<div class="display">
								<div class="cont">
									<div class="sec">
										<div class="txt-profile" s>
											<img src="Images/user.png" width="38px" height="38px" alt="Error" />
											<div class="txt-profiletxt">
												<h4><?php echo ($_SESSION['useruid']); ?></h4>
												<small>Employee</small>
											</div>
										</div>
									</div>
									<div class="sec">
										<div class="txt">
											<a href="EmpUserprofile.php"><i class="las la-user"></i></i>View Profile</a>
										</div>
									</div>
									<div class="sec">
										<div class="txt">
											<a href="./Includes/logout.inc.php"><i class="las la-sign-out-alt"></i></i>Log out</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					</a>
				</div>
				<!---Userwrapper Ends-->
			</div>
		</header>
		<!-- header bar END -->
		<main>
			<!-- TABLE -->
			<?php
			if (isset($_POST["submitUpdate"])) {

				$InNIC = $_POST['GNIC'];
				$InCID = $_POST['CID'];
				$NIC = $_POST["NIC"];
				$bname = $_POST["Bname"];
				$Addr = $_POST["Addr"];
				$contact = $_POST["contact"];
				$gender = $_POST["gender"];
				$bday = $_POST["bday"];
				$Age = $_POST["Age"];
				$qual = $_POST["qual"];
				$marks = $_POST["marks"];
				$addDate = $_POST["addDate"];
				$Guardian = $_POST["guardian"];
				$POID = $_POST["POID"];
				$CID = $_POST["CID"];
				$AreaNO = $_POST["AreaNO"];
				$Other = $_POST["Other"];

				$sql1 = "UPDATE `waitinglistsftbl` SET `nic`='" . $NIC . "',`wl_name`='" . $bname . "',`gender`='" . $gender . "',`bday`='" . $bday . "',`qualifi`='" . $qual . "',`marks`='" . $marks . "',`wl_addr`='" . $Addr . "',`Age`='" . $Age . "',`wl_contact`='" . $contact . "',`wl_add_date`='" . $addDate . "',`guardian`='" . $Guardian . "',`other`='" . $Other . "',`POid`='" . $POID . "',`cid`='" . $CID . "',`areacode`='" . $AreaNO . "' WHERE cid='" . $InCID . "' AND nic='" . $InNIC . "'";

				if (mysqli_query($con, $sql1) > 0) {
					echo "<meta http-equiv=\"refresh\" content=\"0;URL=WaitingList.php?WMessage=3&ViewCat=" . $CID . "&NIC=" . $NIC . "\">";
				} else {
					$ErrorMes = "The Entered values are wrong! <br> Enter the Values again! <br> <a href='ContactInfo.php'>Get help here</a><br> " . mysqli_error($con);
					require_once 'Includes/ErrorPopup.php';
				}
			}
			?>

			<?php
			$GCID = $_GET['CAT'];
			$GNIC = $_GET['NicNo'];
			$sql2 = "SELECT * FROM `waitinglistsftbl` WHERE cid='" . $GCID . "' AND nic='" . $GNIC . "'";
			$results = mysqli_query($con, $sql2);
			if (mysqli_num_rows($results) > 0) {
				while ($row = mysqli_fetch_assoc($results)) {
			?>
					<div class="recent-grid" style="display: inline">
						<!-- maintable -->
						<div class="projects">
							<div class="card">
								<div class="card-header">
									<form autocomplete="off" enctype="multipart/form-data" onreset="return validateReset()" onsubmit="return validateAll()" action="WaitingListUpdate.php?CAT=<?php echo $GCID; ?>&NicNo=<?php echo $GNIC; ?>" method="post">
										<input type="hidden" readonly name="GNIC" value="<?php echo $GNIC; ?>">
										<div class="row">
											<div class="column">
												<label for="NIC">NIC</label>
												<input type="text" id="NIC" name="NIC" value="<?php echo $row['nic']; ?>">
											</div>
											<div class="column">
												<label for="NIC">Category</label>
												<input readonly id="CID" name="CID" value="<?php echo $GCID; ?>">
											</div>
										</div>
										<div class="row">
											<div class="column">
												<label for="Bname">Beneficiary Name</label>
												<textarea name="Bname" id="Bname" rows="2"><?php echo $row['wl_name']; ?></textarea>
											</div>
											<div class="column">
												<label for="Addr">Address</label>
												<textarea name="Addr" id="Addr" rows="2"><?php echo $row['wl_addr']; ?></textarea>
											</div>
										</div>
										<div class="row">
											<div class="column">
												<label for="contact">Contact Number</label>
												<input type="text" id="contact" name="contact" value="<?php echo $row['wl_contact']; ?>">
											</div>
											<div class="column">
												<label for="gender">Gender</label><br>
												<div align="center">
													<label><input class="radio" id="radio1" type="radio" name="gender" value="Male" <?php echo ($row['gender'] == 'Male') ?  "checked" : "";  ?>>Male</label>
													<label><input class="radio" id="radio2" type="radio" name="gender" value="Female" <?php echo ($row['gender'] == 'Female') ?  "checked" : "";  ?>>Female</label>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="column">
												<label for="bday">Birth Day</label>
												<input type="date" name="bday" id="bday" value="<?php echo $row['bday']; ?>">
											</div>
											<div class="column">
												<label for="Age">Age</label>
												<input type="text" name="Age" id="Age" value="<?php echo $row['Age']; ?>">
											</div>
										</div>
										<div class="row">
											<div class="column">
												<label for="qual">Qualification</label>
												<input type="text" name="qual" id="qual" value="<?php echo $row['qualifi']; ?>">
											</div>
											<div class="column">
												<label for="marks">Marks</label>
												<input type="text" name="marks" id="marks" value="<?php echo $row['marks']; ?>">
											</div>
										</div>
										<div class="row">
											<div class="column">
												<label for="addDate">Add Date</label>
												<input type="date" readonly name="addDate" id="addDate" value="<?php $d = date("Y-m-d");
																												echo $d ?>">
											</div>
											<div class="column">
												<label for="guardian">Guardian</label>
												<input type="text" name="guardian" id="guardian" value="<?php echo $row['guardian']; ?>">
											</div>
										</div>
										<div class="row">
											<div class="column">
												<label for="POID">Payment Office ID</label>
												<select id="POID" name="POID">
													<option value="<?php echo $row['POid']; ?>" selected><?php echo $row['POid']; ?></option>
													<?php
													$sqlSele1 = "SELECT * FROM `paymentofficessftbl`";
													$results1 = mysqli_query($con, $sqlSele1);
													if (mysqli_num_rows($results1) > 0) {
														while ($row1 = mysqli_fetch_assoc($results1)) {
															echo "<option value='" . $row1['POid'] . "'>" . $row1['o_name'] . "</option>";
														}
													}
													?>
												</select>
											</div>
											<div class="column">
												<label for="AreaNO">Area No</label>
												<select id="AreaNO" name="AreaNO">
													<option value="<?php echo $row['areacode']; ?>" selected><?php echo $row['areacode']; ?></option>
													<?php
													$sqlSele2 = "SELECT * FROM `gnareasftbl`";
													$results2 = mysqli_query($con, $sqlSele2);
													if (mysqli_num_rows($results2) > 0) {
														while ($row2 = mysqli_fetch_assoc($results2)) {
															echo "<option value='" . $row2['areacode'] . "'>" . $row2['a_name'] . "</option>";
														}
													}
													?>
												</select>
											</div>
										</div>
										<div class="row">
											<div class="column">
												<label for="Other">Other</label>
												<textarea name="Other" id="Other" rows="3"><?php echo $row['other']; ?></textarea>
											</div>
										</div>
										<div align="center">
											<button type="submit" name="submitUpdate" class="buttonSubmit" value="submit">Submit</button>
											<button type="reset" value="reset">Cancel</button>
										</div>
									</form>
							<?php
						}
					} else {
						$ErrorMes = "<b> Error, O results found! <br> Try again Later!</b> <br> <a href='ContactInfo.php'>Get help here</a> <br> " . mysqli_error($con);
						require_once 'Includes/ErrorPopup.php';
					}
							?>
								</div>
								<div class="card-body">
								</div>
							</div>
						</div>
					</div>
		</main>
	</div>
	<?php
	mysqli_close($con);
	?>
</body>
<script>
	$(".openbtn").click(function() {
		$(".sidebar-menu ul .showtbl").toggleClass("show");
	});

	$(".openbtn1").click(function() {
		$(".sidebar-menu ul .showtbl1").toggleClass("show");
	});
</script>

</html>