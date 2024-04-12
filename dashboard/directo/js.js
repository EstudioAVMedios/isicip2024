// JavaScript Document

var inicio;

var finalizar;

var intervalo;

var intervalo_cierre;

var blur_out;

resize_window();

function resize_window() {
  if ($(window).width() < 1200) {
    $("nav img")
      .attr("src", "Imagenes/headerStreamingMovil.png")
      .height("55px");

    $("#video").width("100%");

    $("#chat_general").width("100%");
  } else {
    $("nav img")
      .attr("src", "Imagenes/headerStreaming.png")
      .height("auto")
      .removeClass("m-3");

    $("#video").width("80%");

    $("#chat_general").width("19%");
  }
}

$(window).on("resize", function () {
  resize_window();
});

/*-----------------------------------------------------cierre de pestaña------------------------------------------*/

/*   var bPreguntar = true;

     

    window.onbeforeunload = preguntarAntesDeSalir;

     

    function preguntarAntesDeSalir()

    {

      if (bPreguntar){



				  

		  $.ajax({

		url:"php/time.php",

		type:"POST",

		data:"time=" + new Date().getTime() - inicio,

		success:function(){

			

		}})



        return "¿Seguro que quieres salir?";

		  

    }else{

		cliente_atento();

	}

	}

*/

$("#salir").on("click", function () {
  bPreguntar = false;

  finalizar = new Date().getTime() - inicio;

  time(finalizar);

  window.location = "../../personal/";
});

/*-------------------------------------------------chat-----------------------------------------------------------------*/

connect_chat("");

$("#send_question").on("click", function () {
  connect_chat($("textarea").val());
});

function connect_chat(e) {
  $.ajax({
    url: "php/connect_chat.php",
    type: "POST",
    data: "question=" + e,
  }).done(function (data) {
    if (data != "empty") {
      $("#nadie").remove();
      var json = JSON.parse(data);
      var length2 = Object.keys(json).length;
      $(".pregunta").remove();

      for (var i = 0; i < length2; i++) {
        $("#chat").prepend(
          "<div class='shadow d-flex rounded text-start align-content-around bg-body mx-3 my-2 pregunta' style='width: 90%; flex-direction: row'><div class='bg-secondary p-2 rounded text-white d-flex m-2 justify-content-center' style='width: 40px;height: 40px; text-transform:uppercase'>" +
            String(json[i].NAME).substr(0, 1) +
            "</div><div class='d-inline-block m-2' style='width: 80%; font-size: 14px'><p><strong>" +
            json[i].NAME +
            "</strong><br><span>" +
            json[i].QUESTION +
            "</span><p style='font-size:10px' class='text-muted text-end'>" +
            json[i].DATE +
            "</p></p></div></div>"
        );
      }
    }
  });

  $("textarea").val("");
}

/*------------------------------------------------TIME------------------------------------------------------*/

$("#exampleModal4").modal().show();

$("#aceptar").on("click", function () {
  $("body").removeClass("modal-open");

  $("body").css("padding-right", "");

  $("#exampleModal4").modal().hide();

  $("#exampleModal4").removeClass("in");

  $(".modal-backdrop").remove();

  cliente_atento();
});

cliente_atento();

function cliente_atento() {
  clearTimeout(intervalo_cierre);

  inicio = new Date().getTime();

  intervalo = setTimeout(function () {
    blur();
  }, 120000);
}

function blur() {
  finalizar = new Date().getTime() - inicio;

  time(finalizar);

  cliente_atento();
}

function time(e) {
  $.ajax({
    url: "php/time.php",

    type: "POST",

    data: "time=" + e,

    success: function (res) {},
  });
}

function msToTime(duration) {
  var milliseconds = parseInt((duration % 1000) / 100),
    seconds = Math.floor((duration / 1000) % 60),
    minutes = Math.floor((duration / (1000 * 60)) % 60),
    hours = Math.floor((duration / (1000 * 60 * 60)) % 24);

  hours = hours < 10 ? "0" + hours : hours;

  minutes = minutes < 10 ? "0" + minutes : minutes;

  seconds = seconds < 10 ? "0" + seconds : seconds;

  return hours + ":" + minutes + ":" + seconds + "." + milliseconds;
}

var monitor = setInterval(function () {
  var elem = document.activeElement;

  if (elem && elem.tagName == "IFRAME") {
    clearTimeout(blur_out);

    blur_out = "";

    $(window).focus();

    return false;
  }

  if (elem && elem.id == "video") {
    clearTimeout(blur_out);

    blur_out = "";

    $(window).focus();

    return false;
  }
}, 100);
