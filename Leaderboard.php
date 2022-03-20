<?php
require_once './DataBase/config.php';
?>

<div id="popupV3" class="cardX one noun">
  <div class="headerM">
    <i class="arrow fas fa-chevron-left"></i>
    <h3 class="title">Leaderboard</h3>
    <div></div>
  </div>
  <div class="rest">
    <!--Leader board Starts-->
    <?php
    $sqlQ2 = "SELECT * FROM `player` ORDER By Xp DESC LIMIT 10";
    $results2 = mysqli_query($con, $sqlQ2);
    if (mysqli_num_rows($results2) > 0) {
      $count = 1;
      while ($row = mysqli_fetch_assoc($results2)) {
        echo '<div class="others flex">
        <div class="rank">
          <i class="fas fa-caret-up"></i>
          <p class="num">' . $count++ . '</p>
        </div>
        <div class="info flex">
          <img src="' . $row['img'] . '" alt="Error" class="p_img">
          <p class="link">Level:' . $row['level'] . '</p>
          <p class="points">XP: ' . $row['Xp'] . '</p>
        </div>
      </div>';
      }
    } else {
      echo "<div class='title'>No Players available!</div><div class='sub_title'>&nbsp;</div>";
    }
    ?>
    <!--Leader board Ends-->
  </div>
</div>