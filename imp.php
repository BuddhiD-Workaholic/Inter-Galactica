<?php require_once "./imp.php";?>
<script>
    //Copy from here
    async function confirmLogout() {
        const power = document.querySelector('body');
        power.classList.add('blurOut');
        await sleep(50); //await for half a ms to blur the screen and popup the alert
        var c = confirm("Do you wish to Log-Out?");
        power.classList.remove('blurOut');
        return c;
    }
</script>
<style>
    .Prfilescard {
        box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
        max-width: 20vw;
        margin: auto;
        text-align: center;
        font-family: arial;
    }

    .abutton {
        padding-right: 0px !important;
        padding-left: 0px !important;
        border: none;
        outline: 0;
        display: inline-block;
        padding: 8px;
        color: white;
        background-color: #000;
        text-align: center;
        cursor: pointer;
        width: 100%;
        font-size: 18px;
    }

    .abutton:hover,
    a:hover {
        opacity: 0.7;
    }

    .avatar {
        vertical-align: middle;
        width: 100px;
        height: 100px;
        border-radius: 50%;
    }

    .TEXTp {
        font-weight: bold;
        font-size: 0.8rem;
    }
</style>

<div class="Prfilescard">
    <img src="" alt="Error Loading the Image" class="avatar">
    <h1 style="margin-bottom: 0px;">John Doe</h1>
    <div style="margin-top: 0px;">
        <p class="TEXTp"><i>Email: </i> Harvard University</p>
        <p class="TEXTp"><i>TP Number: </i> Harvard University</p>
        <p class="TEXTp"><i>Level: </i> Harvard University</p>
        <p class="TEXTp"><i>XP: </i> Harvard University</p>
    </div>
    <p><a class="abutton" onclick="return confirmLogout()">Log-Out</a></p>
</div>