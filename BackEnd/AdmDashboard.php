<?php require_once 'DataBase/config.php';
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dashboard</title>

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

	<!--JavaScript-->
	<script language="JavaScript" type="text/javascript" src="JSFile.js"></script>

	<!--SweetAlert CDN-->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<script>
		$(document).ready(function() {
			$("#search").on("input", function() {
				$("div#back_result").css({
					display: "none"
				});
			});
			$("#search").keyup(function() {
				var name = $(this).val();
				var Redirectpg = document.getElementById("Redirectpg").value;
				var TableName = document.getElementById("TableName").value;
				if (name == null || name == "") {
					$("div#back_result").css({
						display: "none"
					});
				} else {
					$.post("findsearch.php", {
						name: name,
						Redirectpg: Redirectpg,
						TableName: TableName
					}, function(data) {
						$("div#back_result").css({
							display: "block"
						});
						$("div#back_result").html(data);
					});
				}
			});
		});
	</script>

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
					<a href="EmpDashboard.php" class="active"><span class="las la-igloo"></span><span> Dashboard</span></a>
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
					<a href="#"><span class="las la-user-clock"></span><span class="openbtn"> Waiting List</span></a>
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
				</label>
				Dashboard
			</h2>
			<!-- searchwrapper Starts-->
			<div class="asearch-wrapper">
				<form class="searchbardiv" method="post" action="#">
					<input type="search" name="search" id="search" placeholder=" Search here" autocomplete="off" />
					<div class="back_result" id="back_result"></div>
					<input type="hidden" readonly id="TableName" value="benificieriessftbl" />
					<input type="hidden" readonly id="Redirectpg" value="EmpDashboard.php" />
				</form>
			</div>
			<!-- searchwrapper ENDs-->
			<div class="user-wrapper">
				<div class="notification">
					<div class="notifications">
						<?php require_once 'Includes/AgentChangeify.php';  ?>
						<?php require_once 'Includes/Deathify.php';  ?>
						<?php require_once 'Includes/Paymentify.php';  ?>
					</div>
				</div>
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
			</div>
		</header>
		<!-- header bar END -->
		<main>
			<?php
			$sqlQ1 = "SELECT count(*) FROM `benificieriessftbl`";
			$results = mysqli_query($con, $sqlQ1);
			if (mysqli_num_rows($results) > 0) {
				$row = mysqli_fetch_assoc($results);
				$Bcount = $row['count(*)'];
			}
			?>
			<div class="cards" style="margin-bottom: 20px !important;">
				<div class="card-single">
					<div>
						<h1>
							<?php echo $Bcount; ?>
						</h1>
						<span>Beneficiaries</span>
					</div>
					<div>
						<span class="las la-users"></span>
					</div>
				</div>
				<?php
				$sqlQ1 = "SELECT count(*) FROM `waitinglistsftbl`";
				$results = mysqli_query($con, $sqlQ1);
				if (mysqli_num_rows($results) > 0) {
					$row = mysqli_fetch_assoc($results);
					$Bcount = $row['count(*)'];
				}
				?>
				<div class="card-single">
					<div>
						<h1>
							<?php echo $Bcount; ?>
						</h1>
						<span>Waiting List</span>
					</div>
					<div>
						<span class="las la-user-clock"></span>
					</div>
				</div>
				<?php
				$year = date("Y");
				$month = date('M') . 'e';
				$sqlQ1 = "SELECT count(*) FROM `paymentrecordssftbl` WHERE payyear='" . $year . "' AND  $month='1'";
				$results = mysqli_query($con, $sqlQ1);
				if (mysqli_num_rows($results) > 0) {
					$row = mysqli_fetch_assoc($results);
					$Bcount = $row['count(*)'];
				}
				?>
				<div class="card-single">
					<div>
						<h1>
							<?php echo $Bcount; ?>
						</h1>
						<span>Accepted Payments</span>
					</div>
					<div>
						<span class="las la-money-bill"></span>
					</div>
				</div>
				<div class="card-single">
					<div>
						<h1>
							<?php
							function DateXml($Date, $Utype)
							{
								$xml = simplexml_load_file('BackEnd/loginrecords.xml');
								$i = -1;
								$count = 0;
								foreach ($xml->children() as $user) {
									$i++;
									$usernameDate = $user->Date; //username is attribute name
									$Usertype = $user->UserType;

									if ($usernameDate == $Date && $Usertype == $Utype) {
										$count++;
									}
								}
								return $count;
							}
							$d = date("Y/m/d");
							echo (DateXml($d, "EMP"));
							?>
						</h1>
						<span>Login atempts: <br><?php echo $d; ?></span>
					</div>
					<div>
						<span class="fas fa-clipboard-user"></span>
					</div>
				</div>

			</div>
			<!-- cards END -->
			<!-- TABLE -->
			<div class="recent-grid">
				<!-- maintable -->
				<div class="projects">
					<div class="card">
						<div class="card-header">
							<h3>Recent Customers</h3>
							<a href="BeneficiaryList.php">
								<button>
									See all <span class="las la-arrow-right"></span>
								</button></a>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table width="100%">
									<thead>
										<tr>
											<td>ID</td>
											<td>NIC</td>
											<td>Name</td>
											<td>Gender</td>
											<td>Category</td>
											<td>DOB</td>
											<td>Area Code</td>
										</tr>
									</thead>
									<tbody>
										<?php
										$sql = "SELECT * FROM `benificieriessftbl` order by b_add_date DESC;";
										$results = mysqli_query($con, $sql);
										if (mysqli_num_rows($results) > 0) {
											$count = 0;
											while ($row = mysqli_fetch_assoc($results)) {
												$count++;
												echo "<tr> <td>" . $row['bid'] . "</td> <td>" . $row['nic'] . "</td> <td>" . $row['b_name'] . "</td> <td>" . $row['gender'] . "</td> <td>" . $row['cid'] . "</td> <td>" . $row['bday'] . "</td> <td>" . $row['areacode'] . "</td> </tr>";
												if ($count == 20) {
													break;
												}
											}
										} else {
											$ErrorMes = "No results found!";
											require_once 'Includes/ErrorPopup.php';
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<!-- side table -->
				<div class="customers">
					<div class="card">
						<div class="card-header">
							<h3>Active Users</h3>
							<img src='Images/active.png' width='16px' height='16px' />
						</div>
						<div class="card-body">
							<?php
							$sqlU2 = "SELECT emp_name,emp_dep FROM `employeesftbl` WHERE IsActive='1'";
							$resultsU2 = mysqli_query($con, $sqlU2);
							if (mysqli_num_rows($resultsU2) > 0) {
								while ($row2 = mysqli_fetch_assoc($resultsU2)) {
									echo "<div class='customer'>
									<div class='info'>
										<img src='Images/user.png' width='30px' height='30px' />
										<div>
											<h4>" . $row2['emp_name'] . "</h4>
											<small>" . $row2['emp_dep'] . "<small>
										</div>
									</div>
								</div>";
								}
							}
							mysqli_close($con);
							?>
						</div>
					</div>
				</div>
			</div>
		</main>
	</div>
</body>
<!-- table collapse JS-->
<script>
	$(".openbtn").click(function() {
		$(".sidebar-menu ul .showtbl").toggleClass("show");
	});
	$(".openbtn1").click(function() {
		$(".sidebar-menu ul .showtbl1").toggleClass("show");
	});
</script>

</html>