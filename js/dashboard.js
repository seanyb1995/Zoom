//-----------------------------------------------------dashboard page jquery--//
$(document).ready(function() {
//---------------------------------------------request driver loading screen--//
    $('#request').click(function(){
        $('#overlay').css('display', 'flex');
        setTimeout(function(){
            $('#overlay').css('display', 'none');
        }, 9000); 
    });
    
var timer = $('#requestTime').val();

if(timer !== ""){
    var endTime = $('#requestTime').val();
    var endTime = parseInt(endTime)
    var counterTime = $('#requestTime').val();
    function updateCounter(){
        if(counterTime == 0){
            $('#time').html("0min");
        }else{
            $('#time').html(counterTime + " min");
            counterTime--;
        }
    }
    var time = setInterval(updateCounter, 1000);
    var today = new Date();
    var time = today.getHours() + ":" + (today.getMinutes() + endTime) + ":" + today.getSeconds();
    document.getElementById("endTime").innerHTML = time;
}

var distance = $('#requestDistance').val();

if(distance !== ""){
    var counterDistance = $('#requestDistance').val();
    function updateCounter(){
        if(counterDistance == 0){
            $('#distance').html("0km");
            $('#overlay').css('display', 'flex');
            $('.loader').css('display', 'none');
            $('.receipt').css('display', 'block');
        }else{
            $('#distance').html(counterDistance + " km");
            counterDistance--;
        }
    }
    
    var interval = ((counterTime / counterDistance) * 1000);
    
    var distance = setInterval(updateCounter, interval);
}

var cost = $('#requestCost').val();

if(cost !== ""){
    $('#cost').html("$" + cost);
}
    
// $('#hamburger').click(function(){
//     $(this).css('display', 'none');
//     $('#sideNav').css('display', 'block');
//     $('.fas.fa-times').css('display', 'block');
// });

// $('.fas.fa-times').click(function(){
//     $(this).css('display', 'none');
//     $('#sideNav').css('display', 'none');
//     $('#hamburger').css('display', 'block');
// });

$('#hamburger').click(function(){
    $('#sideNav').css('width', '25%');
    $(this).css('display', 'none');
    $('.fas.fa-times').css('display', 'block');
});



$('.fas.fa-times').click(function(){
    $(this).css('display', 'none');
    $('#sideNav').css('width', '0%');
    $('#hamburger').css('display', 'block');
});

});