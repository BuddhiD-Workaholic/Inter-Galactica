<div class="Prfilescard">
    <?php
    $sqlQ1 = "SELECT * FROM `player` WHERE email='" . $_SESSION["userid"] . "'";
    $results1 = mysqli_query($con, $sqlQ1);
    if (mysqli_num_rows($results1) > 0) {
        while ($rowW = mysqli_fetch_assoc($results1)) {
            echo '<img src="' . $rowW['img'] . '" alt="Error Loading the Image" class="avatar">';
            echo ' <h3 style="margin-bottom: 18px;">' . $rowW['name'] . '</h3>';
            echo '<div style="margin-top: 0px;">';
            echo ' <p class="TEXTp"><i>Email: </i>' . $rowW['email'] . '</p>
        <p class="TEXTp"><i>TP Number: </i>' . $rowW['contact'] . '</p>
        <p class="TEXTp"><i>Level: </i>' . $rowW['level'] . '</p>
        <p class="TEXTp"><i>XP: </i>' . $rowW['Xp'] . '</p>';
            echo ' </div>';
        }
    }
    ?>
    <p><a class="abutton" onclick="return confirmLogout()" href="./Includes/logout.inc.php"><i class="las la-sign-out-alt"></i>Log out</a></p>
</div>