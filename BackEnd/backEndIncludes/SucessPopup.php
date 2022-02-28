<link rel="stylesheet" href="CSS/popupcss.css" type="text/css" />
 <div class='popup' id='popup-S2'>
     <div class='content'>
         <div class='close-btn' onclick='togglePopup1()'>×</div>
         <div class='icon'>
             <i class='fa fa-check' aria-hidden='true'></i>
         </div>
         <h1>Congratulations!</h1>
         <p class='description'> <?php echo $SucessMes; ?></p>
         <p class='description' align='center'><button class='Sucessbtn' onclick='togglePopup1()'>&nbsp;&nbsp; Okay &nbsp;&nbsp;</button></p>
     </div>
 </div>

 <script>
     function togglePopup1() {
         document.getElementById('popup-S2').classList.toggle('active');
     }
     togglePopup1();
 </script>