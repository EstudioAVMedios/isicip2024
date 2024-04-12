// JavaScript Document
 //Hacia arriba
$(window).on("load", function(){
	$("#underpage").animate({right:"0px"},1000);
})

window.addEventListener("keypress", function(event){
    if (event.keyCode == 13){
        event.preventDefault();
    }
}, false);
$(document).ready(function(){

function movilchange(){
$('#encuentro2').css({display:"none"})
$('#log-in').fadeIn();
$('#encuentro').removeClass("w-50 p-5 m-5").addClass('w-100 p-3');
$("#log-in").css("width","90%");
}
	
	
function pcchange(){
	$('#log-in').fadeIn();
	$("#log-in").css("width","60%");
	$('#encuentro').removeClass("w-100 w-50 p-5 m-5").addClass('w-50 p-5 m-5');
}
	
	
	
	
if($(window).width()<1200){
		movilchange();
}else{
	pcchange();
}
	
$(window).resize(function(){
if($(window).width()<1200){
		movilchange();
}else{
	pcchange();
}		

	
})
	
	
})




$(document).ready(function(){ //Hacia arriba
irArriba();
abrir();
});

function abrir(){
	$("body").fadeIn(1000);
	$("#log-in").delay(1000).slideDown();
}

function irArriba(){
  $('.ir-arriba').click(function(){ $('body,html').animate({ scrollTop:'0px' },10);});
  $(window).scroll(function(){
    if($(this).scrollTop() > 100){ 
		$('.ir-arriba').slideDown(600);   
		$("#brand-navbar").slideDown(200); 
       $('nav').addClass('bg-white'); 
		$('nav .nav-link').removeClass('text-white');
		$('nav .nav-link').addClass('nav-link_color');
		$('#registro').css({border:"2px solid var(--bg-color)"})
		$('nav').addClass('position-fixed w-100').addClass('shadow');

		
	}else{ $('.ir-arriba').slideUp(600); 
		$("#brand-navbar").slideUp(200);
		  $('nav').removeClass('bg-white');
		  $('nav .nav-link').addClass('text-white');
		  $('nav .nav-link').removeClass('nav-link_color');
		 $('#registro').css({border:"2px solid white"})
		  $('nav').removeClass('position-fixed w-100').removeClass('shadow');
		 }
	   
	
  });
  $('.ir-abajo').click(function(){ $('body,html').animate({ scrollTop:'body' },200); });
	
}


$("#entendido").click(function(){
	$("#invalidCheck").prop("checked",true);
});


/********************************User-form*****************************************/
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()

/********************************************* Change password to text***************************************/

$("#inputGroupPrepend2").click(function(){
	if($("#inputGroupPrepend2").css("background-color")!="rgb(233, 236, 239)"){
		
		$("#inputGroupPrepend2").css({backgroundColor:"rgb(233, 236, 239)"});
		$("#validationpassword").attr("type","password");
		$("#inputGroupPrepend2 i").css({color:"var(--bg-color)"});
	}else{
	
	$("#validationpassword").attr("type","text");
	$("#inputGroupPrepend2").css("background-color","var(--bg-color)");
	$("#inputGroupPrepend2 i").css({color:"white"});	
	}
})
$("#inputGroupPrepend3").click(function(){
	if($("#inputGroupPrepend3").css("background-color")!="rgb(233, 236, 239)"){
		
		$("#inputGroupPrepend3").css({backgroundColor:"rgb(233, 236, 239)"});
		$("#validationpassword2").attr("type","password");
		$("#inputGroupPrepend3 i").css({color:"var(--bg-color)"});
	}else{
	
	$("#validationpassword2").attr("type","text");
	$("#inputGroupPrepend3").css("background-color","var(--bg-color)");
	$("#inputGroupPrepend3 i").css({color:"white"});	
	}
})

$("#close").click(function(){
$("#alert").fadeOut();
})
$("#close3").click(function(){
$("#alert3").fadeOut();
})
$("#close4").click(function(){
$("#alert4").fadeOut();
})
$("#close5").click(function(){
$("#alert5").fadeOut();
})
$("#close6").click(function(){
$("#alert6").fadeOut();
})
$("#close7").click(function(){
$("#alert7").fadeOut();
})

$("#closeTPVResponse").click(function () {
  $('#alertTPVResponse').fadeOut(500);
});