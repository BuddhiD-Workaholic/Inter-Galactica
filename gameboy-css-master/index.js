const leaderboard = document.querySelector('#leaderboard');
const popupV3 = document.querySelector('#popupV3');
leaderboard.addEventListener('click', () => {
  if ($(".cardX").hasClass("noun")) {
    $(".cardX").removeClass("noun");
  } else {
    $(".cardX").addClass("noun");
  }
})

