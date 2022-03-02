<?php require_once 'DataBase/config.php';
session_start();


$num_per_page = 40;
$start_from = ($WP - 1) * 40;
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

  <!--SweetAlert CDN-->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <!--Google Translate-->
  <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

  <!--Jquery CDN-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!--JavaScript-->
  <script language="JavaScript" type="text/javascript" src="JSFile.js"></script>
  <script>
    function popupconfimation(form) {
      swal({
          title: "Are you sure?",
          text: "The selected record will be deleted!",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            form.submit();
            return true;
          }
        });
      return false;
    }

    $(document).ready(function() {
      $("#search").on("search", function() {
        var name = $(this).val();
        var Redirectpg = document.getElementById("Redirectpg").value;
        var TableName = document.getElementById("TableName").value;
        var StartF = document.getElementById("StartF").value;
        var NumberPP = document.getElementById("numPP").value;
        if (document.body.contains(document.getElementById("cVats"))) {
          var CATge = document.getElementById("cVats").value;
        } else {
          var CATge = "empty";
        }
        $.post("fetchsearch.php", {
          name: name,
          Redirectpg: Redirectpg,
          TableName: TableName,
          StartF: StartF,
          NumberPP: NumberPP,
          CATge: CATge
        }, function(data) {
          $("tbody#back_result").html(data);
        });
      });

      $("#search").keyup(function() {
        var name = $(this).val();
        var Redirectpg = document.getElementById("Redirectpg").value;
        var TableName = document.getElementById("TableName").value;
        var StartF = document.getElementById("StartF").value;
        var NumberPP = document.getElementById("numPP").value;
        if (document.body.contains(document.getElementById("cVats"))) {
          var CATge = document.getElementById("cVats").value;
        } else {
          var CATge = "empty";
        }
        if (name == null || name == "" || name == '') {
          $.post("fetchsearch.php", {
            name: name,
            Redirectpg: Redirectpg,
            TableName: TableName,
            StartF: StartF,
            NumberPP: NumberPP,
            CATge: CATge
          }, function(data) {
            $("tbody#back_result").html(data);
          });
        } else {
          $.post("findsearch.php", {
            name: name,
            Redirectpg: Redirectpg,
            TableName: TableName,
            CATge: CATge
          }, function(data) {
            $("tbody#back_result").html(data);
          });
        }
      });
    });
  </script>
</head>

<body>
  <!-- Side  bar -->
  <input type="checkbox" id="nav-toggle" checked="checked"/>
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
        </label>
        <?php
        if (isset($_GET['ViewCat'])) {
          echo "<input type='hidden' readonly id='cVats' value='" . $_GET['ViewCat'] . "' />";
          $sql = "SELECT cname FROM `categorysftbl` where cid='" . $_GET['ViewCat'] . "'";
          $results = mysqli_query($con, $sql);
          if (mysqli_num_rows($results) > 0) {
            while ($row = mysqli_fetch_assoc($results)) {
              echo "" . $row['cname'] . " Waiting List";
            }
          }
        } else {
          echo "Waiting List";
        }
        ?>
      </h2>
      <!-- searchwrapper Starts-->
      <div class="asearch-wrapper">
        <form class="searchbardiv" method="post" action="#">
          <input type="search" name="search" id="search" placeholder=" Search here" autocomplete="off" />
          <input type="hidden" readonly id="Redirectpg" value="WaitingList.php" />
          <input type="hidden" readonly id="TableName" value="waitinglistsftbl" />
          <input type="hidden" readonly id="StartF" value="<?php echo $start_from; ?>" />
          <input type="hidden" readonly id="numPP" value="<?php echo $num_per_page; ?>" />
        </form>
      </div>
      <!-- searchwrapper ENDs-->
      <div class="user-wrapper">
        <div class="notification">
          <?php require_once 'Includes/AgentChangeify.php';  ?>
          <?php require_once 'Includes/Deathify.php';  ?>
          <?php require_once 'Includes/Paymentify.php';  ?>
        </div>
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
      if (isset($_GET['WMessage'])) {
        $M = $_GET['WMessage'];
        if ($M == 0) {
          $ErrorMes = "<b> Error! <br> Try again Later!</b> <br> <a href='ContactInfo.php'>Get help here</a>";
          require_once 'Includes/ErrorPopup.php';
        } else if ($M == 1) {
          $SucessMes = "NIC no: <b>" . $_GET['NIC'] . "</b> is being Deleted from the System!";
          require_once 'Includes/SucessPopup.php';
        } else if ($M == 2) {
          $SucessMes = "NIC no: <b>" . $_GET['NIC'] . "</b> is being Inserted to the System!";
          require_once 'Includes/SucessPopup.php';
        } else if ($M == 3) {
          $SucessMes = "NIC no: <b>" . $_GET['NIC'] . "</b> is Updated in the system!";
          require_once 'Includes/SucessPopup.php';
        } else {
          $ErrorMes = "There's been an Error! <br> <a href='ContactInfo.php'>Get help here</a><br> ";
          require_once 'Includes/ErrorPopup.php';
        }
      }
      ?>

      <?php
      if ((isset($_POST['NIC'])) && (isset($_POST['CID']))) {
        $NIC = $_POST['NIC'];
        $CID = $_POST['CID'];

        $sql3 = "DELETE FROM `waitinglistsftbl` Where cid='" . $CID . "' AND nic='" . $NIC . "';";
        if (mysqli_query($con, $sql3) > 0) {
          if (isset($_GET['ViewCat'])) {
            echo "<meta http-equiv=\"refresh\" content=\"0;URL=WaitingList.php?WMessage=1&ViewCat=" . $CID . "&NIC=" . $NIC . "\">";
          } else {
            echo "<meta http-equiv=\"refresh\" content=\"0;URL=WaitingList.php?WMessage=1&NIC=" . $NIC . "\">";
          }
        } else {
          $ErrorMes = "Some internel error, Try again later! Error: <a href='ContactInfo.php'>Get help here</a><br> " . mysqli_error($con);
          require_once 'Includes/ErrorPopup.php';
        }
      }
      ?>
      <div class="recent-grid" style="display: inline">
        <!-- maintable -->
        <div class="projects">
          <div class="card">
            <div class="card-header">
              <?php
              if (isset($_GET['ViewCat'])) {
                echo " <h3><a href='WaitingListAdd.php?CAT=" . $_GET['ViewCat'] . "' class='addbtn'>Add New <i class='fas fa-plus'></i></a></h3>";
              }
              ?>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table width="160%">
                  <thead>
                    <tr>
                      <td>NO</td>
                      <td>NIC</td>
                      <td>Name</td>
                      <td>Address</td>
                      <td>Gender</td>
                      <td>Area Name</td>
                      <td>Contact Number</td>
                      <td>DOB</td>
                      <td>Age</td>
                      <td>Marks</td>
                      <td>Qualification</td>
                      <td>Date</td>
                      <td>Payment Office</td>
                      <td>Guardian</td>
                      <td>Other</td>
                      <td>Moving Away</td>
                      <td>Update</td>
                      <td>Delete</td>
                    </tr>
                  </thead>
                  <tbody id="back_result">
                    <?php
                    if (isset($_GET['ViewCat'])) {
                      $Category = $_GET['ViewCat'];
                      $sql = "SELECT * FROM `waitinglistsftbl` WHERE cid='" . $Category . "'  ORDER BY wl_add_date ASC limit $start_from,$num_per_page;";
                      $results = mysqli_query($con, $sql);
                      $count = 0;
                      if (mysqli_num_rows($results) > 0) {
                        while ($row = mysqli_fetch_assoc($results)) {
                          if (($row['other']) == null) {
                            $ot = "-";
                          } else {
                            $ot = $row['other'];
                          }
                          if (($row['guardian']) == null) {
                            $gu = "-";
                          } else {
                            $gu = $row['guardian'];
                          }
                          $count++;
                          echo "<form enctype='multipart/form-data' onsubmit='return popupconfimation(this)' action='WaitingList.php?ViewCat=" . $_GET['ViewCat'] . "' method='post'>";
                          echo "<input type='hidden' readonly name='NIC' value='" . $row['nic'] . "'>";
                          echo "<input type='hidden' readonly name='CID' value='" . $row['cid'] . "'>";
                          echo "<tr> <td>" . $count . "</td> <td>" . $row['nic'] . "</td> <td>" . $row['wl_name'] . "</td> <td>" . $row['wl_addr'] . "</td> <td>" . $row['gender'] . "</td> <td>" . $row['areacode'] . "</td> <td>" . $row['wl_contact'] . "</td> <td>" . $row['bday'] . "</td> <td>" . $row['Age'] . "</td> <td>" . $row['marks'] . "</td><td>" . $row['qualifi'] . "</td> <td>" . $row['wl_add_date'] . "</td> <td>" . $row['POid'] . "</td> <td>" . $gu . "</td> <td>" . $ot . "</td> <td><a href='EmpMoveaway.php?Nic=" . $row["nic"] . "&Cid=" . $row["cid"] . "' target='_blank' class='opbtn'>Move <i class='fas fa-suitcase-rolling'></i></a><td/>  <a href='WaitingListUpdate.php?NicNo=" . $row["nic"] . "&CAT=" . $row["cid"] . "' class='paybtn'> Update <i class='fas fa-external-link-alt'></i></a></td> <td> <button name='Wdeletebtn' value='submit' class='btnde'> Delete  <i class='fas fa-trash-alt'></i></button>" . "</td> </tr>";
                          echo "</form>";
                        }
                      } else {
                        $ErrorMes = "No results found!<br> " . mysqli_error($con);
                        require_once 'Includes/ErrorPopup.php';
                      }
                    } else {
                      $sql = "SELECT * FROM `waitinglistsftbl` order by wl_add_date ASC limit $start_from,$num_per_page;";
                      $results = mysqli_query($con, $sql);
                      $count = 0;
                      if (mysqli_num_rows($results) > 0) {
                        while ($row = mysqli_fetch_assoc($results)) {
                          if (($row['other']) == null) {
                            $ot = "-";
                          } else {
                            $ot = $row['other'];
                          }
                          if (($row['guardian']) == null) {
                            $gu = "-";
                          } else {
                            $gu = $row['guardian'];
                          }
                          $count++;
                          echo "<form enctype='multipart/form-data' onsubmit='return popupconfimation(this)' action='WaitingList.php' method='post'>";
                          echo "<input type='hidden' readonly name='NIC' value='" . $row['nic'] . "'>";
                          echo "<input type='hidden' readonly name='CID' value='" . $row['cid'] . "'>";
                          echo "<tr> <td>" . $count . "</td> <td>" . $row['nic'] . "</td> <td>" . $row['wl_name'] . "</td> <td>" . $row['wl_addr'] . "</td> <td>" . $row['gender'] . "</td> <td>" . $row['areacode'] . "</td> <td>" . $row['wl_contact'] . "</td> <td>" . $row['bday'] . "</td> <td>" . $row['Age'] . "</td> <td>" . $row['marks'] . "</td><td>" . $row['qualifi'] . "</td> <td>" . $row['wl_add_date'] . "</td> <td>" . $row['POid'] . "</td> <td>" . $gu . "</td> <td>" . $ot . "</td> <td><a href='EmpMoveaway.php?Nic=" . $row["nic"] . "&Cid=" . $row["cid"] . "' target='_blank' class='opbtn'>Move <i class='fas fa-suitcase-rolling'></i></a><td/>  <a href='WaitingListUpdate.php?NicNo=" . $row["nic"] . "&CAT=" . $row["cid"] . "' class='paybtn'> Update <i class='fas fa-external-link-alt'></i></a></td> <td> <button name='Wdeletebtn' value='submit' class='btnde'> Delete  <i class='fas fa-trash-alt'></i></button>" . "</td> </tr>";
                          echo "</form>";
                        }
                      } else {
                        $ErrorMes = "No results found!<br> " . mysqli_error($con);
                        require_once 'Includes/ErrorPopup.php';
                      }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
            <!--Pagination starts-->
            <div class="pagination" align="center">
              <?php
              if (isset($_GET['ViewCat'])) {
                $CIDV = $_GET['ViewCat'];
                $Pl_sql = "SELECT * FROM `waitinglistsftbl` WHERE cid='" . $CIDV . "'  ORDER BY wl_add_date ASC";
                $Pl_results = mysqli_query($con, $Pl_sql);
                $totalRecords = mysqli_num_rows($Pl_results);
                $totalPage = ceil($totalRecords / $num_per_page);

                if ($WP > 1) {
                  echo "<a href='WaitingList.php?WLPage=" . ($WP - 1) . "&ViewCat=" . $CIDV . "'> Previous </a>";
                }
                for ($i = 1; $i < $totalPage; $i++) {
                  echo "<a href='WaitingList.php?WLPage=" . $i . "&ViewCat=" . $CIDV . "'>" . $i . "</a>";
                }
                if ($i > $WP) {
                  echo "<a href='WaitingList.php?WLPage=" . ($WP + 1) . "&ViewCat=" . $CIDV . "'> Next </a>";
                }
              } else {
                $Pl_sql = "SELECT * FROM `waitinglistsftbl` order by wl_add_date ASC";
                $Pl_results = mysqli_query($con, $Pl_sql);
                $totalRecords = mysqli_num_rows($Pl_results);
                $totalPage = ceil($totalRecords / $num_per_page);

                if ($WP > 1) {
                  echo "<a href='WaitingList.php?WLPage=" . ($WP - 1) . "'> Previous </a>";
                }
                for ($i = 1; $i < $totalPage; $i++) {
                  echo "<a href='WaitingList.php?WLPage=" . $i . "'>" . $i . "</a>";
                }
                if ($i > $WP) {
                  echo "<a href='WaitingList.php?WLPage=" . ($WP + 1) . "'> Next </a>";
                }
              }
              ?>
            </div>
            <!--Pagination Ends-->
          </div>
        </div>
      </div>
    </main>
  </div>
  <?php
  mysqli_close($con);
  ?>

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