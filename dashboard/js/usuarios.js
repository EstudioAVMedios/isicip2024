var email2;
var id2;
var id3;
var bbdd_cuota = 0;
var bbdd_m_pago = 0;
var bbdd_estado_pago = 0;
var bbdd_cuota_apoyo = 0;
var cuota_apoyo = 0;
var categoria;
var m_pago = false;
var estado_pago = false;
var cuota = 0;

$("#contactform2 .m-pago,#contactform3 .m-pago").click(function () {
  $(".m-pago-check-pago").removeClass("m-pago-check-pago").addClass("m-pago");
  $(this).addClass("m-pago-check-pago").removeClass("m-pago");
  m_pago = $(this).find("p").text();
});

$("#create_user").on("click", function () {
  var datos = new FormData(document.getElementById("contactform3"));
  datos.append("categoria", categoria);
  datos.append("PAGO", m_pago);
  datos.append("CUOTA", cuota);
  datos.append("estado-pago", estado_pago);

  $.ajax({
    url: "php/registros/form.php",
    type: "POST",
    data: datos,
    clearForm: true,
    contentType: false,
    processData: false,
    success: function (res) {
      console.log(res);
      if ($.trim(res) == "ok") {
        location.reload();
      } else if ($.trim(res) == "full") {
        alert("Ya existe un registro con este correo electrónico.");
      }
    },
  });
  return false;
});
/*************************************** CARGANDO DATOS PARA EDITARLOS *************************************/
$(".edit").click(function () {
  email2 = $(this).closest("td").prevAll(".email").text();
  id3 = $(this).prev("p").text();

  $.ajax({
    url: "php/user_fact.php",
    type: "POST",
    data: "id=" + id3 + "&edit=Si",
    success: function (res) {
      var data = jQuery.parseJSON(res);
      id2 = data.ID;
      /*********************************** PERSONALES ***************************************/
      $(".m-pago-check-pago")
        .removeClass("m-pago-check-pago")
        .addClass("m-pago");
      $(".estado-check-pago")
        .removeClass("estado-check-pago")
        .addClass("estado-pago");
      $(".m-pago-check-cuota")
        .removeClass("m-pago-check-cuota")
        .addClass("cuota");
      $(".m-pago-check").addClass("categoria").removeClass("m-pago-check");
      $(".devolver").fadeOut();
      $("#TITULO")
        .find("option[value='" + data.TITULO + "']")
        .attr("selected", "selected");
      $("#NAME").val(data.NAME);
      $("#SURNAME").val(data.SURNAME);
      $("#DNI").val(data.DNI);
      $("#EMAIL").val(data.EMAIL);
      $("#No_REGISTRO").val(data.No_REGISTRO);
      $("#TELEFONO").val(data.TELEFONO);
      $("#DIRECCION").val(data.DIRECCION);
      $("#CIUDAD").val(data.CIUDAD);
      $("#CODIGO_POSTAL").val(data.CODIGO_POSTAL);
      $("#GENERO").val(data.GENERO);
      $("#EINTOLERANCIA").val(data.EINTOLERANCIA);
      $("#PAIS")
        .find("option[value='" + data.PAIS + "']")
        .attr("selected", "selected");
      /****************** PROFESIONAL ***************************/
      $("#CARGO").val(data.CARGO);
      $("#PHOSPITAL").val(data.PHOSPITAL);
      $("#PESPECIALIDAD").val(data.PESPECIALIDAD);
      $("#PPAIS")
        .find("option[value='" + data.PPAIS + "']")
        .attr("selected", "selected");
      $("#PDIRECCION").val(data.PDIRECCION);
      $("#PCIUDAD").val(data.PCIUDAD);
      $("#PCODIGO_POSTAL").val(data.PCODIGO_POSTAL);
      $("#PTIPO_CENTRO")
        .find("option[value='" + data.PTIPO_CENTRO + "']")
        .attr("selected", "selected");
      /****************** FACTURACION ***************************/
      $("#FNAME").val(data.FNAME);
      $("#FSURNAME").val(data.FSURNAME);
      $("#FPAIS")
        .find("option[value='" + data.FPAIS + "']")
        .attr("selected", "selected");
      $("#FDIRECCION").val(data.FDIRECCION);
      $("#FCIUDAD").val(data.FCIUDAD);
      $("#FCODIGO_POSTAL").val(data.FCP);
      $("#FEMAIL").val(data.FEMAIL);
      $("#FTELEFONO").val(data.FTELEFONO);
      $("#FNIF").val(data.FNIF);
      /******************* SERVICIOS *******************************/
      $("#INTOLERANCIA").val(data.INTOLERANCIA);
      categoria = data.CATEGORIA;
      /****************** SECRETARIA TECNICA ***************************/
      $("#TALON_VENTA").val(data.TALON_VENTA);
      $("#NOTA_ABONO").val(data.NOTA_ABONO);
      $("#PATROCINADOR").val(data.PATROCINADOR);
      $("#EMAIL_PATROCINADOR").val(data.EMAIL_PATROCINADOR);

      cuota = data.CUOTA;
      m_pago = data.CUOTA_PAGO;
      estado_pago = data.CUOTA_ESTADO;
      bbdd_cuota = data.CUOTA;
      bbdd_m_pago = data.CUOTA_PAGO;
      bbdd_estado_pago = data.CUOTA_ESTADO;
      bbdd_cuota_apoyo = data.CUOTA_APOYO;
      cuota_apoyo = bbdd_cuota_apoyo;
      if ((estado_pago = data.CUOTA_ESTADO == "DEVOLUCION")) {
        $(".devolver").fadeIn();
      }
      $("#contactform2 .cuota").each(function () {
        if (
          bbdd_estado_pago == "PENDIENTE" &&
          bbdd_cuota == 0 &&
          bbdd_cuota_apoyo != 0
        ) {
          if ($(this).find("p").text() == data.CUOTA_APOYO) {
            $(this).addClass("m-pago-check-cuota").removeClass("cuota");
          }
        } else {
          if ($(this).find("p").text() == data.CUOTA) {
            $(this).addClass("m-pago-check-cuota").removeClass("cuota");
          }
        }
      });

      if (data.CUOTA_PAGO == "TRANSFERENCIA") {
        $("#m-pago1").addClass("m-pago-check-pago").removeClass("m-pago");
      } else if (data.CUOTA_PAGO == "TARJETA ECI") {
        $("#m-pago2").addClass("m-pago-check-pago").removeClass("m-pago");
      } else if (data.CUOTA_PAGO == "TPV") {
        $("#m-pago3").addClass("m-pago-check-pago").removeClass("m-pago");
      } else if (data.CUOTA_PAGO == "FREE") {
        $("#m-pago4").addClass("m-pago-check-pago").removeClass("m-pago");
      }

      if (
        data.CUOTA_ESTADO == "PENDIENTE" &&
        bbdd_cuota_apoyo != 0 &&
        bbdd_cuota == 0
      ) {
        $("#estado-pago2")
          .addClass("estado-check-pago")
          .removeClass("estado-pago");
        $("#contactform2 .devolver_piloto")
          .find("div")
          .find("div:first-child")
          .text("PENDIENTE")
          .removeClass("text-warning text-danger")
          .addClass("text-warning");
        $("#contactform2 .devolver_piloto")
          .find("div")
          .find("div:last-child")
          .text(bbdd_cuota_apoyo + "€")
          .removeClass("text-warning text-danger")
          .addClass("text-warning");
      } else if (data.CUOTA_ESTADO == "PENDIENTE") {
        $("#estado-pago2")
          .addClass("estado-check-pago")
          .removeClass("estado-pago");
        $("#contactform2 .devolver_piloto")
          .find("div")
          .find("div:first-child")
          .text("PENDIENTE")
          .removeClass("text-warning text-danger")
          .addClass("text-warning");
        $("#contactform2 .devolver_piloto")
          .find("div")
          .find("div:last-child")
          .text(bbdd_cuota_apoyo + "€")
          .removeClass("text-warning text-danger")
          .addClass("text-warning");
      } else if (data.CUOTA_ESTADO == "PAGADO") {
        $("#contactform2 .devolver_piloto")
          .find("div")
          .find("div:first-child")
          .text("CONFIRMADO")
          .removeClass("text-warning text-danger");
        $("#contactform2 .devolver_piloto")
          .find("div")
          .find("div:last-child")
          .text("0.00€")
          .removeClass("text-warning text-danger");
        $("#estado-pago1")
          .addClass("estado-check-pago")
          .removeClass("estado-pago");
        $("#contactform2 .devolver_piloto2")
          .find("div")
          .find("div:last-child")
          .text(bbdd_cuota + "€");
      } else if (data.CUOTA_ESTADO == "DEVOLUCION" && bbdd_cuota_apoyo != 0) {
        $("#contactform2 .devolver_piloto2")
          .find("div")
          .find("div:last-child")
          .text(
            (parseFloat(bbdd_cuota_apoyo) + parseFloat(bbdd_cuota)).toFixed(2) +
              "€"
          );
        $("#contactform2 .devolver_piloto")
          .find("div")
          .find("div:first-child")
          .text("A DEVOLVER")
          .removeClass("text-warning text-danger")
          .addClass("text-danger");
        $("#contactform2 .devolver_piloto")
          .find("div")
          .find("div:last-child")
          .text(bbdd_cuota_apoyo + "€")
          .removeClass("text-warning text-danger")
          .addClass("text-danger");
        $("#estado-pago3")
          .addClass("estado-check-pago")
          .removeClass("estado-pago");
      }

      $(".categoria").each(function () {
        if (data.CATEGORIA == $(this).find("p").text()) {
          $(this).addClass("m-pago-check").removeClass("categoria");
        }
      });
    },
  });
});

/************************* CALCULOS DE PENDIENTES DEVOLUCIONES Y CONFIRMADOS **************************************/

$("#contactform2 .cuota").click(function () {
  $(".m-pago-check-cuota").removeClass("m-pago-check-cuota").addClass("cuota");
  $(this).addClass("m-pago-check-cuota").removeClass("cuota");
  cuota = $(this).find("p").text();

  $(this).removeClass("cuota").addClass("m-pago-check-cuota");
  if (bbdd_estado_pago == "PAGADO") {
    if (parseFloat(cuota) > parseFloat(bbdd_cuota)) {
      cuota_apoyo = cuota - bbdd_cuota;
      pilotos_usuario("PENDIENTE", cuota_apoyo);
    } else if (cuota < bbdd_cuota) {
      console.log(cuota + " " + bbdd_cuota + " " + bbdd_estado_pago);
      cuota_apoyo = bbdd_cuota - cuota;
      pilotos_usuario("DEVOLUCION", cuota_apoyo);
    } else {
      cuota_apoyo = cuota - bbdd_cuota;
      pilotos_usuario("CONFIRMADO", cuota_apoyo);
    }
  } else if (bbdd_estado_pago == "DEVOLUCION") {
    if (cuota > parseFloat(bbdd_cuota) + parseFloat(bbdd_cuota_apoyo)) {
      cuota_apoyo =
        cuota - (parseFloat(bbdd_cuota) + parseFloat(bbdd_cuota_apoyo));
      pilotos_usuario("PENDIENTE", cuota_apoyo);
    } else if (cuota < parseFloat(bbdd_cuota) + parseFloat(bbdd_cuota_apoyo)) {
      cuota_apoyo =
        parseFloat(bbdd_cuota) + parseFloat(bbdd_cuota_apoyo) - cuota;
      pilotos_usuario("DEVOLUCION", cuota_apoyo);
    } else {
      cuota_apoyo =
        cuota - (parseFloat(bbdd_cuota) + parseFloat(bbdd_cuota_apoyo));
      pilotos_usuario("CONFIRMADO", cuota_apoyo);
    }
  } else if (bbdd_estado_pago == "PENDIENTE") {
    if (cuota == 0) {
      cuota_apoyo = parseFloat(cuota);
      pilotos_usuario("CONFIRMADO", cuota_apoyo);
    } else if (cuota < parseFloat(bbdd_cuota) - parseFloat(bbdd_cuota_apoyo)) {
      cuota_apoyo = parseFloat(cuota);
      pilotos_usuario("PENDIENTE", cuota_apoyo);
    } else if (cuota > parseFloat(bbdd_cuota) - parseFloat(bbdd_cuota_apoyo)) {
      cuota_apoyo = parseFloat(cuota);
      pilotos_usuario("PENDIENTE", cuota_apoyo);
    } else {
      cuota_apoyo = parseFloat(cuota);
      pilotos_usuario("PENDIENTE", cuota_apoyo);
    }
  }
});

/************************* CALCULOS DE PENDIENTES DEVOLUCIONES Y CONFIRMADOS **************************************/

$("#contactform3 .cuota").click(function () {
  $(".m-pago-check-cuota").removeClass("m-pago-check-cuota").addClass("cuota");
  $(this).addClass("m-pago-check-cuota").removeClass("cuota");
  cuota = $(this).find("p").text();
});

/*********************** ENVIO DE LOS CAMBIOS ************************************/
$("#update").click(function () {
  estado_pago = $(".estado-check-pago").find("p").text();
  enviar_user("contactform2");
});

function enviar_user(valor) {
  var datos = new FormData(document.getElementById(valor));
  datos.append("id", id3);
  datos.append("EGESTION", $("#gestion").val());
  datos.append("EINTOLERANCIA", $("#into").val());
  datos.append("CATEGORIA", categoria);
  datos.append("CUOTA", cuota);
  datos.append("PAGO", $(".m-pago-check-pago").find("p").text());
  datos.append("ESTADO", $(".estado-check-pago").find("p").text());
  datos.append("CUOTA_APOYO", cuota_apoyo);

  if (valor == "contactform-acompa") {
    datos.append("acompanante", "Si");
  }
  $.ajax({
    url: "php/update_user.php",
    type: "POST",

    clearForm: true,
    contentType: false,
    processData: false,
    data: datos,
    success: function (res) {
      console.log(res);
      if ($.trim(res) == "ok") {
        location.reload();
      } else if ($.trim(res) == "full") {
        $("#formalert2").append(
          "<p class='bg-blue-2 text-center p-2'>!Lo Sentimos, existe un registro con el email que intenta registrar.</p>"
        );
      } else if ($.trim(res) == "fecha") {
        alert("Lo sentimos no hay disponibilidad para el día " + res);
      }
    },
  });
}
/*********************** FUNCION AUXILIAR DE CALCULOS, IMPRIME PENDIENTE DEVOLUCIONES Y CONFIRMADOS  ************************************/
function pilotos_usuario(valor, valor1) {
  $(".estado-check-pago")
    .removeClass("estado-check-pago")
    .addClass("estado-pago");

  if (valor == "PENDIENTE") {
    $("#contactform2 #estado-pago2")
      .addClass("estado-check-pago")
      .removeClass("estado-pago");
    $("#contactform2 .devolver_piloto")
      .find("div")
      .find("div:first-child")
      .text("PENDIENTE")
      .removeClass("text-warning text-danger")
      .addClass("text-warning");
    $("#contactform2 .devolver_piloto")
      .find("div")
      .find("div:last-child")
      .text(valor1.toFixed(2) + "€")
      .removeClass("text-warning text-danger")
      .addClass("text-warning");
  } else if (valor == "DEVOLUCION") {
    $("#contactform2 #estado-pago3")
      .addClass("estado-check-pago")
      .removeClass("estado-pago");
    $("#contactform2 .devolver_piloto")
      .find("div")
      .find("div:first-child")
      .text("A DEVOLVER")
      .removeClass("text-warning text-danger")
      .addClass("text-danger");
    $("#contactform2 .devolver_piloto")
      .find("div")
      .find("div:last-child")
      .text(valor1.toFixed(2) + "€")
      .removeClass("text-warning text-danger")
      .addClass("text-danger");
  } else {
    $("#contactform2 #estado-pago1")
      .addClass("estado-check-pago")
      .removeClass("estado-pago");
    $("#contactform2 .devolver_piloto")
      .find("div")
      .find("div:first-child")
      .text("CONFIRMADO")
      .removeClass("text-warning text-danger");
    $("#contactform2 .devolver_piloto")
      .find("div")
      .find("div:last-child")
      .text(valor1.toFixed(2) + "€")
      .removeClass("text-warning text-danger");
  }
}

/************************************ ELMINIAR USUARIOS **********************************/
var email_id_delete;
$(".icon-burn").click(function () {
  email_id_delete = $(this).prev("p").text();
  $("#modal_delete").text($(this).closest("td").prevAll(".email").text());
});

$("#send_delete").click(function () {
  $.ajax({
    url: "php/user_delete.php",
    type: "POST",
    data: "id=" + email_id_delete,
    success: function (res) {
      if ($.trim(res) == "success") {
        location.reload();
      }
    },
  });
});
