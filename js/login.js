//---------------------------------------------------------login page jquery--//
function reveallogin() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
//---------------------------------------------------------register page jquery--//
function revealregister() {
  var x = document.getElementById("password_1");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
//------------------------------------------ toggle icon for password reveal--//
$(document).ready(function() {
//-----------------------------------------------------------password reveal--//
  $('#icon').click(function(){
    $(this).toggleClass("fa-eye fa-eye-slash");
  });
});
//-----------------------------------------------------------login animation--//
$(document).ready(function(){
  
  function doBounce(element, times, distance, speed) {
    for(var i = 0; i < times; i++) {
        element.animate({marginTop: '-='+distance}, speed)
            .animate({marginTop: '+='+distance}, speed);
    }        
}
  
  $('.btn').click(function(){
    $(this).empty();
    $(this).toggleClass("btn loading");
    $('.loading').append("<i class='fas fa-circle-notch fa-spin'></i>");
    setTimeout(function(){
      $('.loading').empty();
      $("<i class='fas fa-check'></i>").hide().appendTo('.loading').fadeIn(500);
    }, 3000);
    setTimeout(function(){
      doBounce($('.loading'), 4, '20px', 300);
    }, 4000);
    setTimeout(function(){
      $('.username').hide();
      $('.email').hide();
      $('.password').hide();
      $('.remember-me').attr("style", "display: none !important");
      $('.forgot-password').hide();
      $('.loading').hide();
      $('.sign-up').hide();
      $('.sign-in').hide();
      $('.color').toggleClass("expanded");
    }, 7000);
  });
});
