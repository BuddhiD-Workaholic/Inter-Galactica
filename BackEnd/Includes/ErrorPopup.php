<link rel="stylesheet" href="CSS/popupcss.css" type="text/css" />
<div class='popup' id='popup-D2'>
    <div class='content'>
        <div class='close-btn' onclick='togglePopup2()'>×</div>
        <div class='iconError'>
            <i class='fas fa-exclamation-triangle' aria-hidden='true'></i>
        </div>
        <h1>Error!</h1>
        <p class='description'><b> <?php echo $ErrorMes; ?> </b></p>
        <p class='description' align='center'><button class='Errorbtn' onclick='togglePopup2()'>&nbsp;&nbsp; Okay &nbsp;&nbsp;</button></p>
    </div>
</div>

<script>
    function togglePopup2() {
        document.getElementById('popup-D2').classList.toggle('active');
    }
    togglePopup2();
</script>