// JavaScript Document


$('input[name="rol_p"]').change(function () {

  if ($('#rol_p2').prop("checked") == true) {
    $("#ctype_select").fadeIn()
  } else {
    $("#ctype_select").fadeOut()
  }
})

$('#color_evento').focusout(function () {

  $(this).css({
    background: $(this).val()
  });

})

$('#color_evento').focusin(function () {

  $(this).css({
    background: $(this).val()
  });

})


$(window).on("load", function () {

  $('#color_evento').focus();

})

var poll_count = 2;

$(".btn-close").click(function () {


  $(this).closest(".alert").fadeOut();

})


fechas_event();

function fechas_event() {

  $('.fechas_programa').remove();

  $.ajax({


    url: "../info/generico.json",

    type: "GET",

    dataType: "json"


  }).done(function (data) {


    $('#color_evento').val(data.COLOR);

    $('#titulo').val(data.NAME);

    $('#startdate').val(data.STARTDATE);

    $('#finishdate').val(data.FINISHDATE);


    $num_dias = Math.round(new Date(data.FINISHDATE) - new Date(data.STARTDATE)) / (1000 * 60 * 60 * 24) + 1;

    for (var i = 0; i < $num_dias; i++) {


      $startdate = new Date(data.STARTDATE);

      $dia = $startdate.getDate() + parseInt(i);
		$mes= $startdate.getMonth()+1;

      $fecha = $startdate.getFullYear() + "/" + $mes + "/" + $dia;


      $("#check_fecha").append("<div class='form-group border mb-3 col-md-2 fechas_programa'><div class='form-check form-switch m-2'><input class='form-check-input' type='radio' value='" + $fecha + "' name='programa_fecha' id='programa_fecha'><label class='form-check-label' for='flexCheckDefault'>" + $fecha + "</label></div>");


    }

  })

}


//*************************************************************************MENU********************************************************************//

var link;


$("form").addClass("d-none");

$("#form_style").removeClass("d-none");

$('#style').addClass("active_menu");


$("li").click(function () {


  $("li").removeClass("active_menu");

  $(this).addClass("active_menu");


  if ($(this).attr("id") == "style") {


    $("form").addClass("d-none");

    $("#form_style").removeClass("d-none");


  } else if ($(this).attr("id") == "inicio") {


    $("form").addClass("d-none");

    $("#form_inicio").removeClass("d-none");


  } else if ($(this).attr("id") == "programa") {


    $("form").addClass("d-none");

    $("#form_programa").removeClass("d-none");


  } else if ($(this).attr("id") == "form") {


    $("form").addClass("d-none");

    $("#form_form").removeClass("d-none");


  } else if ($(this).attr("id") == "ponentes") {


    $("form").addClass("d-none");

    $("#form_ponentes").removeClass("d-none");


  } else if ($(this).attr("id") == "videos") {


    $("form").addClass("d-none");

    $("#form_videos").removeClass("d-none");


  } else if ($(this).attr("id") == "preguntas") {


    $("form").addClass("d-none");

    $("#form_poll").removeClass("d-none");


  } else if ($(this).attr("id") == "patrocinio") {


    $("form").addClass("d-none");

    $("#form_patrocinio").removeClass("d-none");


  } else if ($(this).attr("id") == "sociedades") {


    $("form").addClass("d-none");

    $("#form_sociedades").removeClass("d-none");


  }


});


//*************************************************************************PROGRAMA********************************************************************//


programa();


function programa() {

  $.ajax({


    url: "../info/programa.json",

    type: "GET",

    dataType: "json"


  }).done(function (data) {


    $count = 1;

    for (var i = 0; i < data.length; i++) {

      $count++

      $("#table_programa").append("<tr class='programa_table'><th scope='row' class='text-center' id='id_programa'>" + data[i].ID + "</th><td id='titulo_crud'>" + data[i].TITULO + "</td><td id='text_crud'><p hidden>" + data[i].TEXT + "</p></td><td id='h_inicio_crud' class='text-center'>" + data[i].HORAINICIO + "</td><td id='h_final_crud' class='text-center'>" + data[i].HORAFINALIZAR + "</td><td id='fecha_programa' class='text-center'>" + data[i].DATE + "</td><td class='text-center edit_p text-warning' data-bs-dismiss='modal'><i class='fas fa-edit''></i></td><td class='text-center delete_programa text-danger'><i class='fas fa-trash'></i></td></tr>");

    }

    edit_programa();

    delete_programa();

  });


}

//--------------------------------------------------------DESCARTAR----------------------------------------------------------------------//


function descartar() {

  var respuestas2;

  $('form').each(function () {

    $(this)[0].reset();

  })

  $('.ponente_video_select').remove(); //remover los ponentes del select para ser impresos nuevamente con los cambios

  $('.video_ponente_icon').remove(); //remover el icono del ponente que esta fuera del div del ponente


  $('.eliminar_videoponente').prev('.col-md-5').remove();

  $('.eliminar_videoponente').next('br').remove();

  $('.eliminar_videoponente').remove();

  poll_count = 2;

  respuestas2 = document.getElementsByClassName('respuesta').length;

  for (var h = respuestas2; h >= 3; h--) {

    $(".respuesta:last").remove();

    $(".respuesta_input:last").remove();

  }

  $('.respuesta_input').val("");

  $('option:selected').attr('selected', false);

  $('#id_programa_input').prop('disabled', true);

  $('#id_programa_input').val('');


}


$(".descartar").click(function () {

  descartar();

})


function edit_programa() {


  $(".edit_p").click(function () {

    descartar();

    $("#titulo_programa").val($(this).prevAll("#titulo_crud").text());

    $("#texto_programa").val($(this).prevAll("#text_crud").text());

    $("#h_inicio_programa").val($(this).prevAll("#h_inicio_crud").text());

    $("#h_final_programa").val($(this).prevAll("#h_final_crud").text());

    $("#id_programa_input").prop("disabled", false);

    $("#id_programa_input").val($(this).prevAll("#id_programa").text());

    $date = $(this).prevAll("#fecha_programa").text();

    $('input[name="programa_fecha"]').each(function () {

      if ($(this).val() == $date) {

        $(this).prop("checked", true);

      }

    })

  })


}

function delete_check_programa_ponente() {

  $(".fecha_ponente").remove();

  $('.tab-pane').remove();

  $('#fechas_programa_ponente .form-check').remove();

}


function delete_programa_item() {

  $(".programa_table").remove();

}


function delete_programa() {


  $(".delete_programa").click(function () {


    let confirmAction = confirm("Seguro que desea eliminar este elemento?");


    if (confirmAction) {

      $.ajax({

        url: "php/delete.php",

        type: "POST",

        data: "titulo_p=" + $(this).prevAll('#titulo_crud').text() + "&date=" + $(this).prevAll('#fecha_programa').text(),

        success: function (data_res) {


          delete_programa_item();

          programa();

          delete_check_programa_ponente();

          fechas_event();

          check_programa_ponente();


        }

      })

    }

  })


}


$("#enviar_programa").click(function () {


  var datos = $("#form_programa").serialize();

  if ($("#titulo_programa").val() != "" && $("#h_inicio_programa").val() != "" && $("#h_final_programa").val() != "" && $("#texto_programa").val() != "" && $(":checked").val() != undefined) {


    $.ajax({

      url: "php/connect_programa.php",

      type: "POST",

      data: datos,

      success: function (res) {


        if (res == "success") {


          delete_check_programa_ponente();

          check_programa_ponente();

          delete_programa_item();

          programa();


          fechas_event();


          $("#form_programa")[0].reset();

        }

      }

    })


  } else {

    $("#alerta_programa").fadeIn();

  }

})


//*********************************************************LIMITE DE TEXTO********************************************************************//


length_text();


function length_text() {


  $("textarea").on("load", function () {


    var valor = $(this).val().length;

    var maxlength = $(this).attr("maxlength");


    $(this).next("p").text(valor + " / " + maxlength);
  })


  $("textarea").on("keyup", function () {


    var valor = $(this).val().length;

    var maxlength = $(this).attr("maxlength");


    $(this).next("p").text(valor + " / " + maxlength);


  })

}


//*************************************************************PONENTE********************************************************************//


check_programa_ponente();

function check_programa_ponente() {

  $('#fechas_programa_ponente .card').remove();


  $.ajax({


    url: "../info/programa.json",

    type: "GET",

    dataType: "json"


  }).done(function (data) {


    for (var i = 0; i < data.length; i++) {


      $idsin = new Date(data[i].DATE).getDate();

      $id2 = "#check" + $idsin;

      $id2sin = "check" + $idsin;


      if ($($id2).html() != undefined) {


      } else {


        $("#fechas_programa_ponente").append("<div class='card w-100' style='width: 18rem;'><div class='card-header'>Programa " + data[i].DATE + "</div><ul class='list-group list-group-flush' id='" + $id2sin + "'></ul></div>");


      }


    }


    $(".list-group-flush").each(function () {


      for (var g = 0; g < data.length; g++) {


        $idsin = new Date(data[g].DATE).getDate();

        $id2 = "#check" + $idsin;


        if ($(this).attr("id") == "check" + new Date(data[g].DATE).getDate()) {


          $($id2).append("<li class='list-group-item border-bottom'><div class='form-switch  py-1 mx-1'><input class='form-check-input' type='checkbox' value='" + data[g].TITULO + "," + data[g].DATE + "' name='programa[]' id='programa_p'><label class='form-check-label px-2' for='flexCheckDefault'>" + data[g].TITULO + "</label></div></li>");


        }

      }

    })


  })


}


$('#enviar_ponente').on('click', function (e) {


  if ($('#nombre_p').val() != "" && $('#apellidos_p').val() != "" && $('#cargo_p').val() != "" && $('#empresa_p').val() != "" && $('#pais_p').val() != "" && $('#email_p').val() != "" && $('#bio_p').val() != "") {


    var formdata = new FormData(document.getElementById('form_ponentes'));

    e.preventDefault();

    var destino = "php/connect_ponente.php";


    $.ajax({

      url: destino,

      type: 'POST', // Siempre que se envíen ficheros, por POST, no por GET.						

      data: formdata, // Al atributo data se le asigna el objeto FormData.$("#form_ponentes").serialize() + "&foto_p" + $('#foto_p')[0].files[0]

      cache: false,
      contentType: false,
      processData: false,
      success: function (res) { // En caso de que todo salga bien.		


        descartar();
        ponentes(true);

      },

      error: function () { // Si hay algún error.

        alert("Algo ha fallado.");

      }

    })

  } else {

    $('#alerta_ponente').fadeIn();

  }

});


ponentes(false);

function ponentes(e) {

  if (e == true) {

    delete_ponente_item();


  }


  $.ajax({


    url: "../info/ponentes.json",

    type: "GET",

    dataType: "json"


  }).done(function (data) {

    if (data != null) {


      var estado;

      $("#nom_ponencias").text(data.length);


      $count1 = 0;

      for (var i = 0; i < data.length; i++) {


        $("td").each(function () {

          if ($(this).text() == data[i].EMAIL) {

            estado = true;

            return false;

          } else {

            estado = false;

          }

        })


        if (estado == false) {

          $('#videos_ponente').append("<option value='" + data[i].TITLENAME + " " + data[i].NAME + " " + data[i].LASTNAME + "' class='ponente_video_option'>" + data[i].TITLENAME + " " + data[i].NAME + " " + data[i].LASTNAME + "</option>");

          $count1++;

          $("#table_ponentes").append("<tr class='ponentes_table' ><td scope='row' class='text-start' id='name_ponente'>" + data[i].NAME + "</th><td id='lastname_ponente'>" + data[i].LASTNAME + "</td><td id='charge_ponente' class='text-start' hidden>" + data[i].CHARGE + "</td><td id='rol_ponente' class='text-start' hidden>" + data[i].ROL + "</td><td id='company_ponente' class='text-start'>" + data[i].COMPANY + "</td><td id='bio_ponente' class='text-start' hidden>" + data[i].BIO + "</td><td id='img_ponente' class='text-start' hidden>" + data[i].IMG + "</td><td id='country_ponente' class='text-start' hidden>" + data[i].COUNTRY + "</td><td id='linkedin_ponente' class='text-start' hidden>" + data[i].LINKEDIN + "</td><td id='email_ponente' class='text-start'>" + data[i].EMAIL + "</td><td id='titulo_ponente' hidden>" + data[i].TITLENAME + "</td><td id='ctype_ponente' hidden>" + data[i].COMMITTEETYPE + "</td><td class='text-center edit edit_ponente text-primary' data-bs-dismiss='modal'><i class='fas fa-edit''></i></td><td class='text-center delete_p text-danger'><i class='fas fa-trash'></i></td></tr>");

        } else {

          continue;

        }


      }

      $("#nom_ponentes").text($count1);

      delete_ponente();

      edit_ponente();


    }

  });


}


function delete_ponente() {


  $('.delete_p').click(function () {


    let confirmAction = confirm("Seguro que desea eliminar este elemento?");


    if (confirmAction) {


      $email = $(this).prevAll("#email_ponente").text();

      $.ajax({

        url: "php/delete_ponente.php",

        type: "POST",

        data: "email_p=" + $email,

        success: function (res) {

          if (res = "success") {

            alert("Ponente eliminado");

            ponentes(true);

          }

        }

      })

    }
  })

}


function delete_ponente_item() {

  $(".ponentes_table").remove();

  $('.videopoenete').remove();

  $('.separar').remove();

}

function edit_ponente() {


  $(".edit_ponente").click(function () {

    descartar();
    var titulo = $(this).prevAll("#titulo_ponente").text();
    var ctype = $(this).prevAll("#ctype_ponente").text();

    $("input[value|=" + $(this).prevAll("#rol_ponente").text() + "]").prop("checked", true);

    $("#nombre_p").val($(this).prevAll("#name_ponente").text());

    $("#apellidos_p").val($(this).prevAll("#lastname_ponente").text());

    $("#cargo_p").val($(this).prevAll("#charge_ponente").text());

    $("#empresa_p").val($(this).prevAll("#company_ponente").text());

    $("textarea").val($(this).prevAll("#bio_ponente").text());

    $("#pais_p").val($(this).prevAll("#country_ponente").text());

    $("#linkedin_p").val($(this).prevAll("#linkedin_ponente").text());

    $("#email_p").val($(this).prevAll("#email_ponente").text());


    $("#titulo_p option").each(function () {


      if ($(this).text() == titulo) {

        $(this).attr("selected", true);

      }
    })

    $("#comitetype_p option").each(function () {


      if ($(this).text() == ctype) {

        $(this).attr("selected", true);

      }
    })
    var email = $(this).prevAll("#email_ponente").text();

    $.ajax({


      url: "../info/ponentes.json",

      type: "GET",

      dataType: "json"


    }).done(function (data) {


      for (var i = 0; i < data.length; i++) {


        if (data[i].EMAIL == email) {


          $fecha_programa = $(this).text();


          $('input[type="checkbox"]').each(function () {


            if ($(this).val() === data[i].PROGRAMA + "," + data[i].DATE_PROGRAM) {

              $(this).prop("checked", true);
            }

          })

        }
      }

    })

  })

}


//*********************************************VIDEOS********************************************************//

get_videos();

function get_videos() {

  $('.video_table').remove();

  $(".video_option_poll").remove();

  var existe = false;

  var count_videos = [];

  var contador_videos = 0;


  $.ajax({


    url: "../info/videos_carta.json",

    type: "GET",

    dataType: "json"


  }).done(function (data) {

    for (var i = 0; i < data.length; i++) {


      encontrar = count_videos.includes(data[i].TITLE);

      if (encontrar) {

        continue;

      }

      $('#table_video').append("<tr class='video_table' ><td scope='row' class='text-start' id='titulo_video'>" + data[i].TITLE + "</th><td id='video_name' hidden>" + data[i].VIDEONAME + "</td><td class='text-start' id='video_content'>" + data[i].CONTENT + "</td><td id='video_img' class='text-start' hidden>" + data[i].FILE + "</td><td id='h_video' class='text-start'>" + data[i].HDURATION + "</td><td id='m_video' class='text-start'>" + data[i].MDURATION + "</td><td class='text-start video_ponente' id='ponente" + i + "'></td><td class='text-center edit text-warning edit_video' data-bs-dismiss='modal'><i class='fas fa-edit'></i></td><td class='text-center delete_v text-danger'><i class='fas fa-trash'></i></td></tr>")

      $("#video_select").append("<option class='video_option_poll'>" + data[i].TITLE + "</option>")

      count_videos.push(data[i].TITLE)

      contador_videos++

      for (var g = 0; g < data.length; g++) {

        if (data[g].TITLE == data[i].TITLE) {

          $("#ponente" + i + "").append(data[g].SPEAKER + "<br>")

        }

      }

    }

    edit_video();

    delete_video();

    $('#nom_videos').text(contador_videos);

  })


}


$('#videos_ponente').change(function () {


  if ($(this).val() != "Elija ponentes...") {

    $('#seleccion_ponente').append("<div class='col-md-5 my-2 border-bottom videoponente'><i class='far fa-user-circle video_ponente_icon'></i> <span class='ponente_video_select'>" + $(this).val() + "</span></div><button type='button' class='btn-close eliminar_videoponente py-3' aria-label='Close'></button><br>");

  }

  videoponente_self_delete();

})


function videoponente_self_delete() {

  $('.eliminar_videoponente').click(function () {

    $(this).prev('.col-md-5').remove();

    $(this).next('br').remove();

    $(this).remove();

  })

}


$('#enviar_video').on('click', function () {

  var video_data = new FormData(document.getElementById('form_videos'));

  $('.ponente_video_select').each(function () {


    video_data.append("ponente_v[]", $(this).text());


  })


  $.ajax({

    url: 'php/connect_video.php',

    type: 'POST',

    cache: false,

    data: video_data,

    contentType: false,

    processData: false,

    success: function (res) {
      console.log(res);
      descartar();

      get_videos();

    }


  })

})


function edit_video() {


  $('.edit').click(function () {

    var videoname = $(this).prevAll('#video_name').text();

    var videocont = $(this).prevAll('#video_content').text();

    var titulo_video = $(this).prevAll('#titulo_video').text();

    $('#titulo_v').val($(this).prevAll('#titulo_video').text());

    $('#video_name option').each(function () {

      if ($(this).text() == videoname) {

        $(this).attr("selected", true);

      }


    })

    $('#contenido_v option').each(function () {

      if ($(this).text() == videocont) {

        $(this).attr("selected", true);

      }


    })

    $('#video_h').val($(this).prevAll('#h_video').text());

    $('#video_m').val($(this).prevAll('#m_video').text());


    $.ajax({


      url: "../info/videos_carta.json",

      type: "GET",

      dataType: "json"


    }).done(function (data) {

      for (var g = 0; g < data.length; g++) {

        if (data[g].TITLE == titulo_video) {


          $('#seleccion_ponente').append("<div class='col-md-5 my-2 border-bottom videoponente'><i class='far fa-user-circle video_ponente_icon'></i> <span class='ponente_video_select'>" + data[g].SPEAKER + "</span></div><button type='button' class='btn-close eliminar_videoponente py-3' aria-label='Close'></button><br>");

        }

      }

      videoponente_self_delete();

    });

  })

  videoponente_self_delete();

}


function delete_video() {

  $('.delete_v').on("click", function () {


    let confirmAction = confirm("Seguro que desea eliminar este elemento?");


    if (confirmAction) {


      $video = $(this).prevAll("#titulo_video").text();

      $.ajax({

        url: "php/delete_video.php",

        type: "POSTS",

        data: "video=" + $video,

        success: function (res) {

          console.log(res);

          descartar();

          get_videos();

          if (res = "success") {

          }

        }

      })

    }


  })

}


//*********************************************POLL********************************************************//


var poll_count = 2;

$('#add_poll').click(function () {

  poll_count++

  $("#respuestas").append("<span class='input-group respuesta' id='basic-addon1' >Respuesta " + poll_count + "</span><input type='text' class='form-control border form-control-sm mb-3 respuesta_input'  aria-label='Username'  name='respuesta" + poll_count + "' id='respuesta" + poll_count + "' required>");

})

$('#less_poll').click(function () {

  poll_count--

  $(".respuesta:last").remove();

  $(".respuesta_input:last").remove();

})


$('#send_poll').on('click', function () {

  if ($('#poll').val() != "" && $('#respuesta_1').val() != "" && $('#respuesta_2').val() != "" && $('#pregunta_h').val() != "" && $('#pregunta_m').val() != "" && $('#pregunta_s').val() != "" && $('#poll_type option:selected').text() != "Elija tipo de pregunta..." && $('#video_select option:selected').text() != "Elija el video...") {


    var poll_data = new FormData();

    poll_data.append("poll", $('#poll').val());


    $('.respuesta_input').each(function () {

      poll_data.append("answer[]", $(this).val());

    });


    poll_data.append("time", (parseInt(($('#pregunta_h').val() * 60)) + parseInt($("#pregunta_m").val())) * 60 + parseInt($('#pregunta_s').val()));

    poll_data.append("video_poll", $('#video_select').val());

    poll_data.append("poll_type", $('#poll_type').val());


    $.ajax({

      url: 'php/connect_poll.php',

      type: "POST",

      cache: false,

      data: poll_data,

      contentType: false,

      processData: false,

      success: function (res) {

        descartar();

        get_poll();


      }


    })


  } else {

    $('#alerta_poll').fadeIn();

  }

})

get_poll();

function get_poll() {

  $('.poll_table').remove();


  var encontrar2;

  var count_poll = [];

  var contador_preguntas = 0;

  $.ajax({


    url: "../info/poll.json",

    type: "GET",

    dataType: "json"


  }).done(function (data) {


    for (var i = 0; i < data.length; i++) {


      encontrar2 = count_poll.includes(data[i].POLL);

      if (encontrar2) {

        continue;

      }

      $('#table_pregunta').append("<tr class='poll_table' ><td scope='row' class='text-start' id='pregunta'>" + data[i].POLL + "</th><td id='respuestas" + i + "'></td><td class='text-start' id='tipo_pregunta'>" + data[i].TYPE + "</td><td id='video_pregunta' class='text-start'>" + data[i].VIDEO + "</td><td id='tiempo' class='text-start'>" + data[i].TIME + "</td><td class='text-center edit text-warning edit_pregunta' data-bs-dismiss='modal'><i class='fas fa-edit'></i></td><td class='text-center delete_p text-danger'><i class='fas fa-trash'></i></td></tr>")

      count_poll.push(data[i].POLL)

      contador_preguntas++

      for (var g = 0; g < data.length; g++) {

        if (data[g].POLL == data[i].POLL) {

          $("#respuestas" + i + "").append(data[g].ANSWER + "<br>")

        }

      }

    }

    editar_pregunta();

    delete_pregunta();

    $('#nom_preguntas').text(contador_preguntas);

  })


}


function delete_pregunta() {


  $('.delete_p').on("click", function () {


    let confirmAction = confirm("Seguro que desea eliminar este elemento?");


    if (confirmAction) {


      $poll = $(this).prevAll("#pregunta").text();

      $.ajax({

        url: "php/delete_poll.php",

        type: "POST",

        data: "poll=" + $poll,

        success: function (res) {


          descartar();

          get_poll();

          if (res = "success") {

          }

        }

      })

    }


  })

}

function editar_pregunta() {


  $('.edit_pregunta').on("click", function () {


    $video_select = $(this).prevAll('#video_pregunta').text();

    $poll = $(this).prevAll('#pregunta').text();

    $('#poll').val($(this).prevAll('#pregunta').text());


    if ($(this).prevAll('#tipo_pregunta').text() == "checkbox") {


      $('#poll_type option[value="checkbox"]').attr('selected', true);


    } else {


      $('#poll_type option[value="radio"]').attr('selected', true);

    }


    $('.video_option_poll').each(function () {

      if ($(this).text() == $video_select) {

        $(this).attr('selected', true);

      }

    })


    /********************************** transformas el tiempode segundos a horas, minutos y segundos***********************************************/

    $total = $(this).prevAll('#tiempo').text();


    var minuto = 0;

    var minuto_count = 0;

    var horas = 0;

    var segundos = $total;

    hora_minuto();

    function hora_minuto() {

      if ($total >= 60) {


        for (var i = 60; i <= $total; i) {

          $total -= 60;

          minuto_count++;


          if (minuto_count == 60) {

            horas++;

            minuto_count = 0;

            i = 0;

          }

          if ($total < 60) {

            break;

          }

        }

      }


      $('#pregunta_h').val(horas);

      $('#pregunta_m').val(minuto_count);

      $('#pregunta_s').val($total);

    }

    $('.respuesta').remove();

    $('.respuesta_input').remove();

    poll_count = 0;

    $.ajax({

      url: "../info/poll.json",

      type: "GET",

      dataType: "json"


    }).done(function (data) {

      for (var i = 0; i < data.length; i++) {

        if (data[i].POLL == $poll) {

          poll_count++

          $("#respuestas").append("<span class='input-group respuesta' id='basic-addon1' >Respuesta " + poll_count + "</span><input type='text' class='form-control border form-control-sm mb-3 respuesta_input'  aria-label='Username'  name='respuesta" + poll_count + "' id='respuesta" + poll_count + "' required value='" + data[i].ANSWER + "'>");

        }

      }

    })

  })


  //fin de la funcion editar_pregunta()

}


$('.minutos').change(function () {

  if ($(this).val() > 59) {

    $(this).val(59);

  }

})

$('.horas').change(function () {

  if ($(this).val() > 2) {

    $(this).val(2);

  }

})


//****************************************************PATROCINADORES********************************************************//


$('#send_patrocinio').on('click', function () {

  var datosFORM = new FormData(document.getElementById('form_patrocinio'));

  $.ajax({

    url: "php/connect_patrocinio.php",

    type: "POST",

    data: datosFORM,

    cache: false,

    contentType: false,

    processData: false


  }).done(function (data) {

    get_patrocinadores();


  })

})


get_patrocinadores();


function get_patrocinadores() {

  descartar();

  $('.patrocinio_table').remove();

  var count_patrocinio = 0;

  $.ajax({

    url: "../info/patrocinio.json",

    type: "GET",

    dataType: "json"

  }).done(function (data) {

    for (var i = 0; i < data.length; i++) {


      $('#table_patrocinio').append("<tr class='patrocinio_table' ><td scope='row' class='text-start' id='name_patrocinador'>" + data[i].NAME + "</th><td id='url_patrocinador'>" + data[i].URL + "</td><td id='video_patrocinador' hidden>" + data[i].VIDEO + "</td><td id='info_patrocinador'hidden>" + data[i].INFO + "</td><td class='text-start' id='email_patrocinador'>" + data[i].EMAIL + "</td><td id='phone_patrocinador' class='phone_patrocinador'>" + data[i].PHONE + "</td><td id='linkedin_patrocinador' class='linkedin_patrocinador' hidden>" + data[i].LINKEDIN + "</td><td id='contact_patrocinador'>" + data[i].CONTACTNAME + "</td><td id='type_patrocinador' class='type_patrocinador'>" + data[i].TYPE + "</td><td class='text-center edit text-warning edit_patrocinio' data-bs-dismiss='modal'><i class='fas fa-edit'></i></td><td class='text-center delete_patrocinador text-danger'><i class='fas fa-trash'></i></td></tr>");

      count_patrocinio++;


    }


    $('#nom_patrocionio').text(count_patrocinio);

    edit_patrocinadores();

    delete_patrocinio();

  })


}


function edit_patrocinadores() {

  $('.edit_patrocinio').on("click", function () {

    $('#empresa_patrocinio').val($(this).prevAll('#name_patrocinador').text());
	  $('#contact_patrocinio').val($(this).prevAll('#contact_patrocinador').text());

    $('#url_patrocinio').val($(this).prevAll('#url_patrocinador').text());

    $('#video_patrocinio').val($(this).prevAll('#video_patrocinador').text());

    $('#email_patrocinio').val($(this).prevAll('#email_patrocinador').text());

    $('#phone_patrocinio').val($(this).prevAll('#phone_patrocinador').text());

    $('#linkedin_patrocinio').val($(this).prevAll('#linkedin_patrocinador').text());

    $type = $(this).prevAll('#type_patrocinador').text();

    $('#type_patrocinio option').each(function () {

      if ($(this).val() == $type) {

        $(this).prop("selected", true);

      }

    })

    $('#info_patrocinio').val($(this).prevAll('#info_patrocinador').text());

  })

}


function delete_patrocinio() {


  $('.delete_patrocinador').on("click", function () {

    let confirmAction = confirm("Seguro que desea eliminar este elemento?");

    if (confirmAction) {

      $poll = $(this).prevAll("#name_patrocinador").text();

      $.ajax({

        url: "php/delete_patrocinio.php",

        type: "POST",

        data: "patrocinador=" + $poll,

        success: function (res) {


          descartar();

          get_patrocinadores();

          if (res = "success") {

          }

        }

      })

    }


  })

}


//--------------------------------------------------------------SOCIEDADES-----------------------------------------------------------//


$('#send_sociedades').on("click", function () {


  var datos = new FormData(document.getElementById('form_sociedades'));


  $.ajax({

    url: "php/connect_sociedades.php",

    type: "POST",

    data: datos,

    cache: false,

    contentType: false,

    processData: false


  }).done(function (res) {

    descartar();


  })


})
