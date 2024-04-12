$(document).ready(function () {
  if ($(".badge-number").text() == 0) {
    $(".badge-number").fadeOut();
  }
});

$("#aacompa,#pacompa, #pacompa3, #gestion, #gestion3").on("click", function () {
  sino($(this).attr("id"));
});
$("#aacompa").val("No");

function sino(valor) {
  if ($("#" + valor).prop("checked") == true) {
    $("#" + valor).val("Si");
  } else {
    $("#" + valor).val("No");
  }
}

var email_active;
$(".fact_data").click(function () {
  email_active = $(this).prevAll("p").text();

  $.ajax({
    url: "php/user_fact.php",
    type: "POST",
    data: "id=" + email_active + "&edit=no",
    success: function (res) {
      var data = jQuery.parseJSON(res);

      $("#name_modal").text(data.F_NAME);
      $("#dni_modal").text(data.F_NIF);
      $("#email_modal").text(data.F_EMAIL);
      $("#ciudad_modal").text(data.F_CIUDAD);
      $("#pais_modal").text(data.PAIS);
      $("#tel_modal").text(data.F_TELEFONO);
      $("#prov_modal").text(data.F_PROVINCIA);
      $("#address_modal").text(data.F_DIRECCION);
      $("#pobla_modal").text(data.F_CP);
    },
  });
});
var cuota_pendiente = 0;
var cuota_devolver = 0;
//acompa cuotas;
var acompa_cuota = 0;
var acompa_cuota_pendiente = 0;
var acompa_cuota_devolver = 0;
//hotel cuotas;
var hotel_cuota = 0;
var hotel_cuota_pendiente = 0;
var hotel_cuota_devolver = 0;
//totales
var total_pagado = 0;
var total_pendiente = 0;
var total_devolver = 0;
var total = 0;
var hotel_pagado = 0;
$(".activar").click(function () {
  email_active = $(this).prevAll("p").text();
  $("#modal_email").text($(this).closest("td").prevAll(".email").text());
  var cuota = 0;

  $.ajax({
    url: "php/coste.php",
    type: "POST",
    data: "id=" + email_active + "&hotel=no",
    success: function (res) {
      var data = JSON.parse(res);

      if (data.CUOTA_ESTADO == "PAGADO" && data.CUOTA != 0) {
        $("#tabla_costes")
          .find("tr:nth-child(2)")
          .find("td:nth-child(2)")
          .text("0.00€");
        $("#tabla_costes")
          .find("tr:nth-child(2)")
          .find("td:nth-child(4)")
          .text(data.CUOTA + "€");
        $("#tabla_costes")
          .find("tr:nth-child(2)")
          .find("td:nth-child(3)")
          .text("(PAGADO)(" + data.CUOTA_PAGO + ")")
          .removeClass("text-danger text-warning text-success")
          .addClass("text-success");
        cuota = data.CUOTA;
        cuota_pendiente = 0;
      } else if (data.CUOTA_ESTADO == "DEVOLUCION" && data.CUOTA_APOYO != 0) {
        $("#tabla_costes")
          .find("tr:nth-child(2)")
          .find("td:nth-child(2)")
          .text(data.CUOTA_APOYO + "€");
        $("#tabla_costes")
          .find("tr:nth-child(2)")
          .find("td:nth-child(4)")
          .text(
            (
              Number.parseFloat(data.CUOTA) +
              Number.parseFloat(data.CUOTA_APOYO)
            ).toFixed(2) + "€"
          );
        $("#tabla_costes")
          .find("tr:nth-child(2)")
          .find("td:nth-child(3)")
          .text("(A DEVOLVER)(" + data.CUOTA_PAGO + ")")
          .addClass("text-danger");
        cuota_devolver = data.CUOTA_APOYO;
        cuota =
          Number.parseFloat(data.CUOTA) + Number.parseFloat(data.CUOTA_APOYO);
      } else if (data.CUOTA_ESTADO == "DEVOLUCION") {
        $("#tabla_costes")
          .find("tr:nth-child(2)")
          .find("td:nth-child(2)")
          .text(data.CUOTA + "€");
        $("#tabla_costes")
          .find("tr:nth-child(2)")
          .find("td:nth-child(4)")
          .text(data.CUOTA + "€");
        $("#tabla_costes")
          .find("tr:nth-child(2)")
          .find("td:nth-child(3)")
          .text("(A DEVOLVER)(" + data.CUOTA_PAGO + ")")
          .addClass("text-danger");
        cuota_devolver = data.CUOTA;
        cuota = data.CUOTA;
      } else if (data.CUOTA_ESTADO == "PAGADO" && data.CUOTA == 0) {
        $("#tabla_costes")
          .find("tr:nth-child(2)")
          .find("td:nth-child(2)")
          .text("0.00€");
        $("#tabla_costes")
          .find("tr:nth-child(2)")
          .find("td:nth-child(4)")
          .text("0.00€");
        $("#tabla_costes")
          .find("tr:nth-child(2)")
          .find("td:nth-child(3)")
          .text("(Sin Coste)")
          .removeClass("text-danger text-warning text-success")
          .addClass("text-success");
        cuota = 0;
        cuota_pendiente = 0;
      } else if (
        data.CUOTA_ESTADO == "PENDIENTE" &&
        data.CUOTA == 0 &&
        data.CUOTA_APOYO != 0
      ) {
        $("#tabla_costes")
          .find("tr:nth-child(2)")
          .find("td:nth-child(2)")
          .text(data.CUOTA_APOYO + "€");
        $("#tabla_costes")
          .find("tr:nth-child(2)")
          .find("td:nth-child(4)")
          .text("0.00€");
        $("#tabla_costes")
          .find("tr:nth-child(2)")
          .find("td:nth-child(3)")
          .text("(PENDIENTE)(" + data.CUOTA_PAGO + ")")
          .removeClass("text-danger text-warning text-success")
          .addClass("text-warning");
        cuota_pendiente = data.CUOTA_APOYO;
      } else if (
        data.CUOTA_ESTADO == "PENDIENTE" &&
        data.CUOTA != 0 &&
        data.CUOTA_APOYO != 0
      ) {
        $("#tabla_costes")
          .find("tr:nth-child(2)")
          .find("td:nth-child(2)")
          .text(data.CUOTA_APOYO + "€");
        $("#tabla_costes")
          .find("tr:nth-child(2)")
          .find("td:nth-child(4)")
          .text((data.CUOTA - data.CUOTA_APOYO).toFixed(2) + "€");
        $("#tabla_costes")
          .find("tr:nth-child(2)")
          .find("td:nth-child(3)")
          .text("(PENDIENTE)(" + data.CUOTA_PAGO + ")")
          .removeClass("text-danger text-warning text-success")
          .addClass("text-warning");
        cuota_pendiente = data.CUOTA_APOYO;
        cuota = data.CUOTA - data.CUOTA_APOYO;
      } else if (data.CUOTA_ESTADO == "PENDIENTE" && data.CUOTA == 0) {
        $("#tabla_costes")
          .find("tr:nth-child(2)")
          .find("td:nth-child(2)")
          .text("0.00€");
        $("#tabla_costes")
          .find("tr:nth-child(2)")
          .find("td:nth-child(4)")
          .text("0.00€");
        $("#tabla_costes")
          .find("tr:nth-child(2)")
          .find("td:nth-child(3)")
          .text("(PENDIENTE)(" + data.CUOTA_PAGO + ")")
          .removeClass("text-danger text-warning text-success")
          .addClass("text-warning");
      }
      if (data.ACOMPA_ESTADO == "PAGADO" && data.ACOMPA_CUOTA != 0) {
        $("#tabla_costes")
          .find("#tabla_acompa")
          .find("td:nth-child(2)")
          .text("0.00€");
        $("#tabla_costes")
          .find("#tabla_acompa")
          .find("td:nth-child(4)")
          .text(data.ACOMPA_CUOTA + "€");
        $("#tabla_costes")
          .find("#tabla_acompa")
          .find("td:nth-child(3)")
          .text("(PAGADO)(" + data.ACOMPA_PAGO + ")")
          .removeClass("text-danger text-warning text-success")
          .addClass("text-success");
        acompa_cuota = data.ACOMPA_CUOTA;
      } else if (data.ACOMPA_ESTADO == "DEVOLUCION") {
        $("#tabla_costes")
          .find("#tabla_acompa")
          .find("td:nth-child(2)")
          .text(data.ACOMPA_APOYO + "€");
        $("#tabla_costes")
          .find("#tabla_acompa")
          .find("td:nth-child(4)")
          .text(
            Number(
              parseFloat(data.ACOMPA_CUOTA) + parseFloat(data.ACOMPA_APOYO)
            ).toFixed(2) + "€"
          );
        $("#tabla_costes")
          .find("#tabla_acompa")
          .find("td:nth-child(3)")
          .text("(A DEVOLVER)(" + data.ACOMPA_PAGO + ")")
          .removeClass("text-danger text-warning text-success")
          .addClass("text-danger");

        acompa_cuota_devolver = data.ACOMPA_APOYO;
        acompa_cuota =
          parseFloat(data.ACOMPA_CUOTA) + parseFloat(data.ACOMPA_APOYO);
      } else if (data.ACOMPA_ESTADO == "PAGADO" && data.ACOMPA_CUOTA == 0) {
        $("#tabla_costes")
          .find("#tabla_acompa")
          .find("td:nth-child(2)")
          .text("0.00€");
        $("#tabla_costes")
          .find("#tabla_acompa")
          .find("td:nth-child(4)")
          .text("0.00€");
        $("#tabla_costes")
          .find("#tabla_acompa")
          .find("td:nth-child(3)")
          .text("(Sin Coste)")
          .removeClass("text-danger text-warning text-success")
          .addClass("text-success");
      } else if (data.ACOMPA_ESTADO == "PENDIENTE" && data.ACOMPA_CUOTA != 0) {
        $("#tabla_costes")
          .find("#tabla_acompa")
          .find("td:nth-child(2)")
          .text(Number.parseFloat(data.ACOMPA_APOYO).toFixed(2) + "€");
        $("#tabla_costes")
          .find("#tabla_acompa")
          .find("td:nth-child(4)")
          .text(
            Number.parseFloat(data.ACOMPA_CUOTA - data.ACOMPA_APOYO).toFixed(
              2
            ) + "€"
          );
        $("#tabla_costes")
          .find("#tabla_acompa")
          .find("td:nth-child(3)")
          .text("(PENDIENTE)(" + data.ACOMPA_PAGO + ")")
          .removeClass("text-danger text-warning text-success")
          .addClass("text-warning");
        acompa_cuota_pendiente = Number.parseFloat(data.ACOMPA_APOYO).toFixed(
          2
        );
        acompa_cuota = data.ACOMPA_CUOTA - data.ACOMPA_APOYO;
      } else if (data.ACOMPA_ESTADO == "PENDIENTE" && data.ACOMPA_CUOTA == 0) {
        $("#tabla_costes")
          .find("#tabla_acompa")
          .find("td:nth-child(2)")
          .text(data.ACOMPA_APOYO + "€");
        $("#tabla_costes")
          .find("#tabla_acompa")
          .find("td:nth-child(4)")
          .text("0.00€");
        $("#tabla_costes")
          .find("#tabla_acompa")
          .find("td:nth-child(3)")
          .text("(PENDIENTE)(" + data.ACOMPA_PAGO + ")")
          .removeClass("text-danger text-warning text-success")
          .addClass("text-warning");
        acompa_cuota_pendiente = data.ACOMPA_APOYO;
      } else if (data.ACOMPA_CUOTA == 0) {
        $("#tabla_costes")
          .find("#tabla_acompa")
          .find("td:nth-child(2)")
          .text("0.00€");
        $("#tabla_costes")
          .find("#tabla_acompa")
          .find("td:nth-child(4)")
          .text("0.00€");
        $("#tabla_costes")
          .find("#tabla_acompa")
          .find("td:nth-child(3)")
          .text("(NO SOLICITADO)")
          .removeClass("text-danger text-warning text-success");
      }
      $("#id_resolver_all").text(data.USER_ID);

      $.ajax({
        url: "php/coste.php",
        type: "POST",
        data: "id=" + email_active + "&hotel=si",
        success: function (res2) {
          var data = JSON.parse(res2);
          $(".tabla_hotel").remove();
          hotel_cuota = 0;
          hotel_cuota_devolver = 0;
          hotel_cuota_pendiente = 0;
          hotel_pagado = 0;
          if (data) {
            for (var i = 0; i < data.length; i++) {
              if (data[i].HOTEL_ESTADO == "" && data[i].HOTEL_CUOTA == 0) {
                hotel_cuota = hotel_cuota + data[i].HOTEL_CUOTA;
                $("#tabla_costes").append(
                  "	<tr class='tabla_hotel' ><td class='border-start'>Reserva de Hotel .</td><td>0.00€</td><td class=''>(NO SOLICITADO)</td><td class='border-start border-end'>0.00€</td></tr> "
                );
              } else if (
                data[i].HOTEL_ESTADO == null &&
                data[i].HOTEL_CUOTA == null
              ) {
                $("#tabla_costes").append(
                  "	<tr class='tabla_hotel' ><td class='border-start'>Reserva de Hotel .</td><td>0.00€</td><td class=''>(NO SOLICITADO)</td><td class='border-start border-end'>0.00€</td></tr> "
                );

                hotel_cuota = hotel_cuota + 0;
              } else if (
                data[i].HOTEL_ESTADO == "PAGADO" &&
                data[i].HOTEL_CUOTA != 0
              ) {
                hotel_cuota =
                  parseFloat(hotel_cuota) + parseFloat(data[i].HOTEL_CUOTA);
                hotel_pagado = parseFloat(data[i].HOTEL_CUOTA);
                $("#tabla_costes").append(
                  "	<tr class='tabla_hotel' ><td class='border-start'>Reserva de Hotel (" +
                    data[i].ID +
                    ").</td><td>0.00€</td><td class='text-success'>(PAGADO)(" +
                    data[i].HOTEL_PAGO +
                    ")</td><td class='border-start border-end'>" +
                    Number(hotel_pagado).toFixed(2) +
                    "€</td></tr> "
                );
              } else if (data[i].HOTEL_ESTADO == "DEVOLUCION") {
                hotel_cuota_devolver =
                  parseFloat(hotel_cuota_devolver) +
                  parseFloat(data[i].HOTEL_APOYO);
                hotel_cuota =
                  hotel_cuota +
                  parseFloat(data[i].HOTEL_CUOTA) +
                  parseFloat(data[i].HOTEL_APOYO);
                hotel_pagado =
                  parseFloat(data[i].HOTEL_CUOTA) +
                  parseFloat(data[i].HOTEL_APOYO);
                $("#tabla_costes").append(
                  "	<tr class='tabla_hotel' ><td class='border-start'>Reserva de Hotel (" +
                    data[i].ID +
                    ").</td><td>" +
                    Number(data[i].HOTEL_APOYO).toFixed(2) +
                    "€</td><td class='text-danger'>(A DEVOLVER)(" +
                    data[i].HOTEL_PAGO +
                    ")</td><td class='border-start border-end'>" +
                    Number(hotel_pagado).toFixed(2) +
                    "€</td></tr> "
                );
              } else if (
                data[i].HOTEL_ESTADO == "PAGADO" &&
                data[i].HOTEL_CUOTA == 0
              ) {
                $("#tabla_costes").append(
                  "<tr class='tabla_hotel' ><td class='border-start'>Reserva de Hotel (" +
                    data[i].ID +
                    ").</td><td>0.00€</td><td class='text-success'>(Sin Coste)</td><td class='border-start border-end'>0.00€</td></tr> "
                );
              } else if (
                data[i].HOTEL_ESTADO == "PENDIENTE" &&
                data[i].HOTEL_CUOTA != 0
              ) {
                hotel_cuota_pendiente =
                  parseFloat(hotel_cuota_pendiente) +
                  parseFloat(data[i].HOTEL_APOYO);
                hotel_cuota =
                  hotel_cuota +
                  (parseFloat(data[i].HOTEL_CUOTA) -
                    parseFloat(data[i].HOTEL_APOYO));
                hotel_pagado =
                  parseFloat(data[i].HOTEL_CUOTA) -
                  parseFloat(data[i].HOTEL_APOYO);
                $("#tabla_costes").append(
                  "	<tr class='tabla_hotel' ><td class='border-start'>Reserva de Hotel (" +
                    data[i].ID +
                    ").</td><td>" +
                    Number(hotel_cuota_pendiente).toFixed(2) +
                    "€</td><td class='text-warning'>(PENDIENTE)(" +
                    data[i].HOTEL_PAGO +
                    ")</td><td class='border-start border-end'>" +
                    Number(hotel_pagado).toFixed(2) +
                    "€</td></tr> "
                );
              } else if (
                data[i].HOTEL_ESTADO == "PENDIENTE" &&
                data[i].HOTEL_CUOTA == 0
              ) {
                hotel_cuota_pendiente =
                  parseFloat(hotel_cuota_pendiente) +
                  parseFloat(data[i].HOTEL_APOYO);
                hotel_pagado = parseFloat(data[i].HOTEL_CUOTA);
                $("#tabla_costes").append(
                  "	<tr class='tabla_hotel' ><td class='border-start'>Reserva de Hotel (" +
                    data[i].ID +
                    ").</td><td>" +
                    Number(parseFloat(data[i].HOTEL_APOYO)).toFixed(2) +
                    "€</td><td class='text-warning'>(PENDIENTE)(" +
                    data[i].HOTEL_PAGO +
                    ")</td><td class='border-start border-end'>" +
                    Number(hotel_pagado).toFixed(2) +
                    "€</td></tr> "
                );
              } else if (
                data[i].HOTEL_ESTADO == null &&
                data[i].HOTEL_CUOTA == 0
              ) {
                hotel_cuota_pendiente =
                  hotel_cuota_pendiente + data[i].HOTEL_APOYO;
                $("#tabla_costes").append(
                  "	<tr class='tabla_hotel' ><td class='border-start'>Reserva de Hotel.</td><td>0.00€</td><td class=''>(NO SOLICITADO)</td><td class='border-start border-end'>0.00€</td></tr> "
                );
              }
            }
          }

          total_pendiente =
            parseFloat(cuota_pendiente) +
            parseFloat(acompa_cuota_pendiente) +
            parseFloat(hotel_cuota_pendiente);
          total_devolver =
            parseFloat(cuota_devolver) +
            parseFloat(acompa_cuota_devolver) +
            parseFloat(hotel_cuota_devolver);
          total_pagado =
            parseFloat(cuota) +
            parseFloat(acompa_cuota) +
            parseFloat(hotel_cuota);

          $("#tabla_totales")
            .find("tr:nth-child(2)")
            .find("td:nth-child(4)")
            .text(Number.parseFloat(total_pagado).toFixed(2) + "€")
            .removeClass("text-danger text-warning text-success")
            .addClass("text-success");

          if (total_devolver > total_pendiente) {
            total = parseFloat(total_devolver) - parseFloat(total_pendiente);

            $("#tabla_totales")
              .find("tr:nth-child(2)")
              .find("td:nth-child(2)")
              .text(Number.parseFloat(total).toFixed(2) + "€");
            $("#tabla_totales")
              .find("tr:nth-child(2)")
              .find("td:nth-child(3)")
              .text("(A DEVOLVER)")
              .removeClass("text-danger text-warning text-success")
              .addClass("text-danger");
          } else if (total_devolver < total_pendiente) {
            total = parseFloat(total_pendiente) - parseFloat(total_devolver);

            $("#tabla_totales")
              .find("tr:nth-child(2)")
              .find("td:nth-child(2)")
              .text(Number.parseFloat(total).toFixed(2) + "€");
            $("#tabla_totales")
              .find("tr:nth-child(2)")
              .find("td:nth-child(3)")
              .text("(PENDIENTE)")
              .removeClass("text-danger text-warning text-success")
              .addClass("text-warning");
          } else {
            total = 0;

            $("#tabla_totales")
              .find("tr:nth-child(2)")
              .find("td:nth-child(2)")
              .text(Number.parseFloat(total).toFixed(2) + "€");
            $("#tabla_totales")
              .find("tr:nth-child(2)")
              .find("td:nth-child(3)")
              .text("(CONFIRMADO)")
              .removeClass("text-danger text-warning text-success");
          }
        },
      });
    },
  });

  $.ajax({
    url: "php/pedidos.php",
    type: "POST",
    data: "id=" + email_active,
    success: function (res) {
      if ($.trim(res) == "no") {
      } else {
        var data = JSON.parse(res);
        $(".pedidos_impresos").remove();
        for (var i = 0; i <= data.length; i++) {
          if (data[i].ESTADO == 1) {
            var estado =
              "<td class='border-start text-success'>PAGADO REALIZADO</td>";
          } else {
            var estado =
              "<td class='border-start text-danger'>PAGO INCOMPLETO</td>";
          }

          $("#tabla_pedidos").append(
            " <tr class='pedidos_impresos'><td class='border-start'>" +
              data[i].PEDIDO +
              "</td>" +
              estado +
              " <td class='border-start border-end'>" +
              data[i].DATE +
              "</td> </tr>"
          );
        }
      }
    },
  });
});
$("#send_active").click(function () {
  $.ajax({
    url: "php/user_active.php",
    type: "POST",
    data: "id=" + email_active,
    success: function (res) {
      if ($.trim(res) == "success") {
        location.reload();
      }
    },
  });
});

/*href="<?php echo $_SESSION['PHP_SELF'].'?export=true'?>"*/
$(document).ready(function () {
  var boolean = true;
  $("#show").on("click", function () {
    if (boolean == true) {
      $("#exampleFormControlInput1").attr("type", "text");
      $(this).text("Ocultar");
      boolean = false;
    } else {
      $("#exampleFormControlInput1").attr("type", "password");
      $(this).text("Mostrar");
      boolean = true;
    }
  });
});

$(document).ready(function () {
  irArriba();
}); //Hacia arriba

function irArriba() {
  $(".ir-arriba").click(function () {
    $("body,html").animate(
      {
        scrollTop: "0px",
      },
      500
    );
  });
  $(window).scroll(function () {
    if ($(this).scrollTop() > 0) {
      $(".ir-arriba").slideDown(500);
    } else {
      $(".ir-arriba").slideUp(500);
    }
  });
  $(".ir-abajo").click(function () {
    $("body,html").animate(
      {
        scrollTop: "1000px",
      },
      500
    );
  });
}

$("#sendfilter").click(function () {
  var filterdata = new FormData(document.getElementById("form_filter"));
  $("#form_filter input[type=checkbox]").each(function () {
    if (this.checked) {
      filterdata.append("filtro[]", $(this).next("label").text());
    }
  });
  $.ajax({
    url: "php/filter.php",
    type: "POST",
    cache: false,
    data: filterdata,
    contentType: false,
    processData: false,
    success: function (res) {
      if ($.trim(res) == "ok") {
        location.reload();
      }
    },
  });
});

$(".form-check-label").on("click", function () {
  return false;
});

$(".js-nav").click(function () {
  $(this).parent().find(".menu").toggleClass("active");
});

$("#subir_excel").click(function () {
  $(this).find("span").fadeIn();
  if ($("#radio1").prop("checked") == true) {
    var importar = new FormData(document.getElementById("import-form"));
    $.ajax({
      url: "php/importfile.php",
      type: "POST",
      cache: false,
      data: importar,
      contentType: false,
      processData: false,
      success: function (res) {
        console.log(res);
        if ($.trim(res) == "ok") {
          location.reload();
        } else {
          var data = JSON.parse(res);
          for (var i = 0; i < data.length; i++) {
            $("#imprime_lista_duplicado").append(
              " <tr> <td>" +
                data[i].NAME +
                "</td><td>" +
                data[i].SURNAME +
                "</td><td class='text-danger'>" +
                data[i].EMAIL +
                "</td></tr>"
            );
          }
          $("#tabla_lista_duplicado").fadeIn();
          $("#subir_excel").find("span").fadeOut();
        }

        /*   location.reload();*/
      },
    });
  } else {
    var importar = new FormData(document.getElementById("import-form"));
    $.ajax({
      url: "php/importfileact.php",
      type: "POST",
      cache: false,
      data: importar,
      contentType: false,
      processData: false,
      success: function (res) {
        if ($.trim(res) == "ok") {
          location.reload();
        }
      },
    });
  }
});

var toogle2 = true;

$("#show").click(function () {
  if (toogle2 == true) {
    $("#pass").attr("type", "text");

    $(this).text("Ocultar");

    toogle2 = false;
  } else {
    $("#pass").attr("type", "password");

    $(this).text("Mostrar");

    toogle2 = true;
  }
});

var toogle3 = true;

$("#show1").click(function () {
  if (toogle3 == true) {
    $("#pass1").attr("type", "text");

    $(this).text("Ocultar");

    toogle3 = false;
  } else {
    $("#pass1").attr("type", "password");

    $(this).text("Mostrar");

    toogle3 = true;
  }
});

var lado = false;
var categoria = false;
var m_pago = false;
var estado_pago = false;
var cuota = 0;
$(".categoria, .estado-pago").click(function () {
  if ($(this).hasClass("categoria")) {
    $(".m-pago-check").removeClass("m-pago-check").addClass("categoria");
    $(this).removeClass("categoria").addClass("m-pago-check");
    categoria = $(this).find("p").text();
  } else if ($(this).hasClass("cuota")) {
    if (
      $(".m-pago-check-cuota").find("p").text() == lado &&
      $(".estado-check-pago").find("p").text() == "PAGADO"
    ) {
      $(".estado-check-pago")
        .removeClass("estado-check-pago")
        .addClass("estado-pago");
      if (lado == 550) {
        $("#estado-pago3")
          .removeClass("estado-pago")
          .addClass("estado-check-pago");
        estado_pago = $("#estado-pago3").find("p").text();
        $(".devolver").fadeIn();
      } else {
        $("#estado-pago31")
          .removeClass("estado-pago")
          .addClass("estado-check-pago");
        estado_pago = $("#estado-pago31").find("p").text();
        $(".devolver1").fadeIn();
      }
    } else if (
      $(".m-pago-check-cuota").find("p").text() == 0 &&
      $(".estado-check-pago").find("p").text() == "PAGADO"
    ) {
      $(".m-pago-check-pago")
        .removeClass("m-pago-check-pago")
        .addClass("m-pago");
      $(".estado-check-pago")
        .removeClass("estado-check-pago")
        .addClass("estado-pago");
      if (lado == 550) {
        $("#estado-pago2")
          .removeClass("estado-pago")
          .addClass("estado-check-pago");
        estado_pago = $("#estado-pago2").find("p").text();
      } else {
        $("#estado-pago21")
          .removeClass("estado-pago")
          .addClass("estado-check-pago");
        estado_pago = $("#estado-pago21").find("p").text();
      }
    } else if (
      $(".m-pago-check-cuota").find("p").text() == 0 &&
      $(".estado-check-pago").find("p").text() == "DEVOLUCION"
    ) {
      $(".estado-check-pago")
        .removeClass("estado-check-pago")
        .addClass("estado-pago");
      if (lado == 550) {
        $("#estado-pago1")
          .removeClass("estado-pago")
          .addClass("estado-check-pago");
        estado_pago = $("#estado-pago1").find("p").text();
        $(".devolver").fadeOut();
      } else {
        $("#estado-pago11")
          .removeClass("estado-pago")
          .addClass("estado-check-pago");
        estado_pago = $("#estado-pago11").find("p").text();
        $(".devolver1").fadeOut();
      }
    } else if (
      $(".m-pago-check-cuota").find("p").text() == lado &&
      $(".estado-check-pago").find("p").text() == "PENDIENTE"
    ) {
      $(".m-pago-check-pago")
        .removeClass("m-pago-check-pago")
        .addClass("m-pago");
      $(".estado-check-pago")
        .removeClass("estado-check-pago")
        .addClass("estado-pago");
      if (lado == 550) {
        $("#estado-pago1")
          .removeClass("estado-pago")
          .addClass("estado-check-pago");
        $("#m-pago4").removeClass("m-pago").addClass("m-pago-check-pago");
        m_pago = $("#m-pago4").find("p").text();
        estado_pago = $("#estado-pago1").find("p").text();
      } else {
        $("#estado-pago11")
          .removeClass("estado-pago")
          .addClass("estado-check-pago");
        $("#m-pago41").removeClass("m-pago").addClass("m-pago-check-pago");
        m_pago = $("#m-pago41").find("p").text();
        estado_pago = $("#estado-pago11").find("p").text();
      }
    } else {
      $(".m-pago-check-pago")
        .removeClass("m-pago-check-pago")
        .addClass("m-pago");
      $(".estado-check-pago")
        .removeClass("estado-check-pago")
        .addClass("estado-pago");

      if (lado == 550) {
        $("#estado-pago2")
          .removeClass("estado-pago")
          .addClass("estado-check-pago");
        estado_pago = $("#estado-pago2").find("p").text();
      } else {
        $("#estado-pago21")
          .removeClass("estado-pago")
          .addClass("estado-check-pago");
        estado_pago = $("#estado-pago21").find("p").text();
      }
    }

    $(".m-pago-check-cuota")
      .removeClass("m-pago-check-cuota")
      .addClass("cuota");
    $(this).removeClass("cuota").addClass("m-pago-check-cuota");
    cuota = $(this).find("p").text();
  } else if ($(this).hasClass("m-pago")) {
    if (
      $(".m-pago-check-cuota").find("p").text() == lado &&
      estado_pago == false
    ) {
      estado_pago = $("#estado-pago2").find("p").text();
    }
    $(".m-pago-check-pago").removeClass("m-pago-check-pago").addClass("m-pago");
    $(this).removeClass("m-pago").addClass("m-pago-check-pago");
    m_pago = $(this).find("p").text();
  } else if ($(this).hasClass("estado-pago")) {
    if (
      $(this).find("p").text() == "PAGADO" &&
      $(".m-pago-check-cuota").find("p").text() == 0
    ) {
      if (lado == 550) {
        $(".m-pago-check-pago")
          .removeClass("m-pago-check-pago")
          .addClass("m-pago");
        $("#m-pago4").removeClass("m-pago").addClass("m-pago-check-pago");
        m_pago = $("#m-pago4").find("p").text();
        $(".devolver").fadeOut();
      } else if (lado == 350) {
        $(".m-pago-check-pago")
          .removeClass("m-pago-check-pago")
          .addClass("m-pago");
        $("#m-pago41").removeClass("m-pago").addClass("m-pago-check-pago");
        m_pago = $("#m-pago41").find("p").text();
        $(".devolver1").fadeOut();
      }
    }
    $(".estado-check-pago")
      .removeClass("estado-check-pago")
      .addClass("estado-pago");
    $(this).removeClass("estado-pago").addClass("estado-check-pago");
    estado_pago = $(this).find("p").text();
  }
});

$(".m-pago2").click(function () {
  $(".m-pago2-check").removeClass("m-pago2-check").addClass("m-pago2");
  $(this).removeClass("m-pago2").addClass("m-pago2-check");
  mpago2 = $(this).find("p").text();

  if (mpago2 == "TRANSF") {
    $("#bankdata").slideDown();
  } else {
    $("#bankdata").slideUp();
  }
  if (mpago2 == 2) {
    $("#socsec").fadeIn().addClass("required text");
  } else {
    $("#socsec").fadeOut().removeClass("required text");
  }
});

$(function () {
  var v = $("#contactform").validate({
    submitHandler: function (form) {
      if (mpago != false && mpago2 != false) {
        if (
          $("#pass").val() != "" &&
          $("#pass1").val() != "" &&
          $("#pass").val() === $("#pass1").val()
        ) {
          if ($("#type").text() != 3) {
            $(function () {
              validate($("#dni").val());
            });

            return false;
          } else {
            enviar();
          }
        } else {
          $("#formalert").append(
            "<p class='bg-blue-2 text-center p-2'>!Lo Sentimos, las contraseñas no coinciden.</p>"
          );
        }
      } else {
        $("#formalert").append(
          "<p class='bg-blue-2 text-center p-2'>!Lo Sentimos, Debe seleccionar su método de pago y la cuota.</p>"
        );
      }
    },
  });
});

//To clear message field on page refresh (you may clear other fields too, just give the 'id to input field' in html and mention it here, as below)

$("#contactform #message").val("");

function enviar() {
  var datos = new FormData(document.getElementById("contactform"));

  datos.append("type", mpago2);
  datos.append("ip", $("#ip").text());
  datos.append("pais", $("#pais").text());
  datos.append("pay", mpago);
  $.ajax({
    url: "../assets/php/form1.php",

    /*target: "#result",*/

    clearForm: true,

    data: datos,

    contentType: false,

    processData: false,

    type: "POST",

    success: function (res) {
      if ($.trim(res) == "ok") {
        location.reload();
      } else if ($.trim(res) == "full") {
        $("#formalert").append(
          "<p class='bg-blue-2 text-center p-2'>!Lo Sentimos, existe un registro con el email que intenta registrar.</p>"
        );
      }
    },
  });

  return false;
}

function validate(value) {
  var validChars = "TRWAGMYFPDXBNJZSQVHLCKET";

  var nifRexp = /^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKET]{1}$/i;

  var nieRexp = /^[XYZ]{1}[0-9]{7}[TRWAGMYFPDXBNJZSQVHLCKET]{1}$/i;

  var str = value.toUpperCase();

  var nie = str

    .replace(/^[X]/, "0")

    .replace(/^[Y]/, "1")

    .replace(/^[Z]/, "2");

  var letter = str.substr(-1);

  var charIndex = parseInt(nie.substr(0, 8)) % 23;

  if (!nifRexp.test(str) && !nieRexp.test(str))
    $("#formalert").append(
      "<p class='bg-blue-2 text-center p-2'>!Lo Sentimos, debe introducir un documento válido.</p>"
    );

  if (validChars.charAt(charIndex) === letter) enviar();

  return false;
}

function enviar2(valor) {
  var datos = new FormData(document.getElementById(valor));
  datos.append("id", id3);
  datos.append("acompa", $("#pacompa").val());
  datos.append("EGESTION", $("#gestion").val());
  datos.append("EINTOLERANCIA", $("#into").val());
  datos.append("CATEGORIA", categoria);
  datos.append("noches", $("#noches").text());
  datos.append("habitacion", $(".hotel_hab_check").find("p").text());
  datos.append("cuota", cuota);
  datos.append("hotel_cuota", total_hab);
  datos.append("m-pago", m_pago);
  datos.append("estado-pago", estado_pago);
  datos.append("hotel_apoyo", hotel_apoyo);

  if (valor == "contactform-acompa") {
    datos.append("acompanante", "Si");
  }
  $.ajax({
    url: "php/update.php",
    type: "POST",

    clearForm: true,
    contentType: false,
    processData: false,
    data: datos,
    success: function (res) {
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

  return false;
}

/**********************************************SENDER*****************************************************************************/
var idsender;
$(".send").click(function () {
  $("#modal_email_sender").text($(this).closest("td").prevAll(".email").text());
  idsender = $(this).prevAll("p").text();
});

$("#send_sender").click(function () {
  enviar3(idsender, $("#conf_email").val());
});

function enviar3(valor, valor1) {
  $.ajax({
    url: "php/sender.php",

    data: "ID=" + valor + "&email=" + valor1 + "&single=true",

    type: "POST",

    success: function (res) {
      location.reload();
    },
  });

  return false;
}
$("#inputPassword2").on("focus", function () {
  $(this).stop().animate(
    {
      width: "350px",
    },
    500
  );
});

$(".guardar-hotel").on("click", function () {
  var fecha = $(this).closest("p").prevAll("p").text();
  var todas = $(this)
    .closest("p")
    .prevAll("p")
    .closest("div")
    .prevAll(".total_hab")
    .find("input")
    .val();
  var prebloqueo = $(this)
    .closest("p")
    .prevAll("p")
    .closest("div")
    .prevAll(".prebloqueo")
    .find("input")
    .val();
  var reservadas = $(this)
    .closest("p")
    .prevAll("p")
    .closest("div")
    .prevAll(".prebloqueo")
    .find("p")
    .find("span")
    .text();

  $.ajax({
    url: "php/hoteles.php",
    type: "POST",
    data:
      "fecha=" +
      fecha +
      "&todas=" +
      todas +
      "&prebloqueo=" +
      prebloqueo +
      "&reservadas=" +
      reservadas,
    success: function (res) {
      if ($.trim(res) == "ok") {
        window.location.reload();
      }
    },
  });
});

$("#mensaje_mail").on("click", function () {
  var para = $("#lista-usuarios").val();
  var asunto = $("input[name='aname']").val();
  var mensaje = $("#texto-mensaje").val();
  if (para == "No") {
    alert("Debe seleccionar un usuario destino para enviar esta notificación.");
  } else {
    if (mensaje != "" && asunto != "") {
      $.ajax({
        url: "php/mail.php",
        type: "POST",
        data:
          "destinatario=" + para + "&asunto=" + asunto + "&mensaje=" + mensaje,
        success: function (res) {
          console.log(res);
          if ($.trim(res) == "ok") {
            location.reload();
          }
        },
      });
    } else {
      alert("Todos los campos son necesarios para enviar la notificación");
    }
  }

  return false;
});

$("#subir_fact").on("click", function () {
  var datos = new FormData(document.getElementById("contact-acturas"));
  datos.append("id", id3);
  $.ajax({
    url: "php/subidas.php",
    type: "POST",
    data: datos,
    clearForm: true,
    contentType: false,
    processData: false,
    success: function (res) {
      if ($.trim(res) == "ok") {
        location.reload();
      } else if ($.trim(res) == "no") {
        alerta("Debe subir un archivo.");
      }
    },
  });
});

$(".subida").on("click", function () {
  $(".factura_mostrada").remove();
  id3 = $(this).prev("p").text();
  var datos = new FormData(document.getElementById("contact-acturas"));
  datos.append("id", id3);

  $.ajax({
    url: "php/subidas.php",
    type: "POST",
    data: datos,
    clearForm: true,
    contentType: false,
    processData: false,
    success: function (res) {
      var data = JSON.parse(res);
      for (var i = 0; i <= data.length; i++) {
        if (data[i] != "." && data[i] != ".." && data[i] != undefined) {
          $("#facturas-mostradas").append(
            "<div class='col-4  px-2 my-3 factura_mostrada'><div class='border rounded-5'><div class='text-end p-2'><p hidden>" +
              data[i] +
              "</p><button type='button' class='btn-close delete-btn-fact' data-bs-toggle='modal' data-bs-target='#eliminar-fact'></button></div><div class='w-100 p-2 text-white rounded-5' style='background:linear-gradient(45deg, rgba(50,225,159,1) 32%, rgba(229,255,71,1) 100%) !important'><i class='icon-file elicon edit' data-bs-toggle='modal' data-bs-target='#staticBackdrop4'></i> " +
              data[i] +
              "</div></div></div>"
          );
        }
      }
      $(".delete-btn-fact").on("click", function () {
        file = $(this).prevAll("p").text();
      });
    },
  });
});
var file;

$("#delete-factura").on("click", function () {
  $.ajax({
    url: "php/subidas.php",
    type: "POST",
    data: "id=" + id3 + "&delete=true&filename=" + file,
    success: function (res) {
      if ($.trim(res) == "ok") {
        location.reload();
      }
    },
  });
});

$("#all_fields").on("click", function () {
  $("#form_filter input[type='checkbox'").each(function () {
    if ($(this).prop("checked") != true) {
      $(this).prop("checked", true);
    }
  });
});
$("#resolver_all").on("click", function () {
  $.ajax({
    url: "php/resolver.php",
    type: "POST",
    data: "id=" + $(this).prev("p").text(),
    success: function (res) {
      if ($.trim(res) == "ok") {
        location.reload();
      }
      console.log(res);
    },
  });
});

$(".hide").on("click", function () {
  $.ajax({
    url: "php/hide.php",
    type: "POST",
    data: "hide=True&id=" + $(this).prev("p").text(),
    success: function (res) {
      if ($.trim(res) == "ok") {
        location.reload();
      }
    },
  });
});

$(".show").on("click", function () {
  $.ajax({
    url: "php/hide.php",
    type: "POST",
    data: "hide=false&id=" + $(this).prev("p").text(),
    success: function (res) {
      if ($.trim(res) == "ok") {
        location.reload();
      }
    },
  });
});

$("#cgestion").click(function () {
  if ($(this).prop("checked") == true) {
    $(this).val("Si");
  } else {
    $(this).val("No");
  }
});

/****************** CATEGORIAS ****************************/
var id_edit = 0;
$(".categoria_edit").on("click", function () {
  id_edit = $(this).prev("p").text();
  var cuota = $(this).closest("ul").prev("button").text();

  $("#add_categoria").text("Actualizar");
  $("#campo_categoria").val(cuota);

  $.ajax({
    url: "php/create_categoria.php",
    type: "POST",
    data: "categoria=" + cuota + "&getData=true",
    success: function (res) {
      $("select[name=categoria_asociada]")
        .find("option")
        .each(function () {
          if ($(this).val() == $.trim(res)) {
            $(this).prop("selected", true);
          }
        });
      console.log(res);
    },
  });

  console.log(cuota);
});

$("#add_categoria").on("click", function () {
  if (id_edit == 0) {
    $.ajax({
      url: "php/create_categoria.php",
      type: "POST",
      data:
        "categoria=" +
        $("#campo_categoria").val() +
        "&create=true&categoria_asociada=" +
        $("select[name=categoria_asociada]").val(),
      success: function (res) {
        if ($.trim(res) == "ok") {
          location.reload();
        }
      },
    });
  } else {
    $.ajax({
      url: "php/create_categoria.php",
      type: "POST",
      data:
        "categoria=" +
        $("#campo_categoria").val() +
        "&edit=true&id=" +
        id_edit +
        "&categoria_asociada=" +
        $("select[name=categoria_asociada]").val(),
      success: function (res) {
        if ($.trim(res) == "ok") {
          location.reload();
        }
      },
    });
  }
});

$(".categoria_delete").on("click", function () {
  id_edit = $(this).prev("p").text();
  $.ajax({
    url: "php/create_categoria.php",
    type: "POST",
    data: "delete=true&id=" + id_edit,
    success: function (res) {
      if ($.trim(res) == "ok") {
        location.reload();
      }
    },
  });
});

$(".button_submenu").on("click", function () {
  if ($(this).find("i").hasClass("icon-minus")) {
    $(this).find("i").removeClass("icon-minus").addClass("icon-plus");
  } else {
    $(this).find("i").removeClass("icon-plus").addClass("icon-minus");
  }
});

$(".container_modulo").on("click", function () {
  if ($(this).find("div").find("input").prop("checked") == true) {
    $(this).find("div").find("input").prop("checked", false);
  } else {
    $(this).find("div").find("input").prop("checked", true);
  }
});
$("#send_modulos").on("click", function () {
  formularios("modulos_form");
});
$("#send_evento").on("click", function () {
  formularios("evento_form");
});
$("#send_fecha_hoteles").on("click", function () {
  formularios("fechas_hoteles");
});
/***************************************************** FECHAS ALOJAMIENTO **********************************************/

function formularios(valor) {
  var datos = new FormData(document.getElementById(valor));
  $.ajax({
    url: "php/menu_lateral/" + valor + ".php",
    type: "POST",
    data: datos,
    clearForm: true,
    contentType: false,
    processData: false,
    success: function (res) {
      if ($.trim(res) === "ok") {
        location.reload();
      }
    },
  });
}
$("#modulos_item").click(function () {
  $.ajax({
    url: "php/menu_lateral/modulos_form.php",
    type: "POST",
    data: "consulta=true",
    success: function (res) {
      var dato = JSON.parse(res);
      if (dato.ESTADO_ACOMPA == 1) {
        $("#modulos_form input[name=acompa]").prop("checked", true);
      } else {
        $("#modulos_form input[name=acompa]").prop("checked", false);
      }
      if (dato.ESTADO_ALOJAMIENTO == 1) {
        $("#modulos_form input[name=alojamiento]").prop("checked", true);
      } else {
        $("#modulos_form input[name=alojamiento]").prop("checked", false);
      }
      if (dato.ESTADO_FACTURA == 1) {
        $("#modulos_form input[name=factura]").prop("checked", true);
      } else {
        $("#modulos_form input[name=factura]").prop("checked", false);
      }
      if (dato.ESTADO_EXTRAS == 1) {
        $("#modulos_form input[name=ser]").prop("checked", true);
      } else {
        $("#modulos_form input[name=ser]").prop("checked", false);
      }
      if (dato.ESTADO_PROF == 1) {
        $("#modulos_form input[name=profesional]").prop("checked", true);
      } else {
        $("#modulos_form input[name=profesional]").prop("checked", false);
      }
    },
  });
});

/*********************************** ENVIOS MASIVOS *****************************************/
var envios = [];
var count = 0;
$(".container_masivo, .label_masivo").on("click", function (event) {
  if (event.shiftKey == 1) {
    if ($(this).hasClass("label_masivo")) {
      var id = $(this).prev("p").text();
    } else {
      var id = $(this).find("div").find("p").text();
    }

    if (id < envios[envios.length - 1]) {
      $(".container_masivo").each(function () {
        if (
          Number.parseInt($(this).find("div").find("p").text()) >= id &&
          Number.parseInt($(this).find("div").find("p").text()) <
            envios[envios.length - 1]
        ) {
          $(this).find("div").find("input").prop("checked", true);
          envios.unshift($(this).find("div").find("p").text());
          count++;
        }
      });
    }
    if (id > envios[envios.length - 1]) {
      $(".container_masivo").each(function () {
        if (
          Number.parseInt($(this).find("div").find("p").text()) <= id &&
          Number.parseInt($(this).find("div").find("p").text()) >
            envios[envios.length - 1]
        ) {
          $(this).find("div").find("input").prop("checked", true);
          envios.push($(this).find("div").find("p").text());
          count++;
        }
      });
      console.log(id);
    }
  } else {
    if ($(this).find("div").find("input").prop("checked") == true) {
      $(this).find("div").find("input").prop("checked", false);
      console.log("Si");
      count--;
      var indice = envios.indexOf($(this).find("div").find("p").text());
      envios.splice(indice, 1);
    } else {
      if ($(this).hasClass("label_masivo")) {
        $(this).prev("input").prop("checked", true);
        envios.push($(this).prev("p").text());
      } else {
        $(this).find("div").find("input").prop("checked", true);
        envios.push($(this).find("div").find("p").text());
      }

      count++;
    }
  }
  $("#masivo_counter").text(count);
});

$("#send_masivo").on("click", function () {
  $(this).find("span").fadeIn();
  var cadena = JSON.stringify(envios);
  $.ajax({
    url: "php/sender.php",
    type: "POST",
    data: "envios=" + cadena,
    success: function (res) {
      if ($.trim(res)) {
        location.reload();
      } else {
        window.reload();
      }
    },
  });
});
/********************************** CREANDO HABITACIONES *****************************************/
var id_update = 0;
$(".lista_hab").on("click", function () {
  var id_hab = $(this).prev("p").text();
  console.log(id_hab);
  $.ajax({
    url: "php/menu_lateral/create_hab.php",
    type: "POST",
    data: "id=" + id_hab + "&delete=no&update=no",
    success: function (res) {
      var data = JSON.parse(res);
      $("input[name=hab_name]").val(data.HABITACION);
      $("input[name=hab_hotel]").val(data.HOTEL);
      $("input[name=hab_precio]").val(data.PRECIO);
      $("option[value='" + data.TIPO + "']").prop("selected", true);
      id_update = data.ID;
    },
  });
});
$("#send_hab_create").on("click", function () {
  var datos = new FormData(document.getElementById("hab_create_form"));
  datos.append("id", id_update);
  datos.append("delete", "no");
  datos.append("update", "si");
  $.ajax({
    url: "php/menu_lateral/create_hab.php",
    type: "POST",
    data: datos,
    clearForm: true,
    contentType: false,
    processData: false,
    success: function (res) {
      location.reload();
    },
  });
});
$(".delete_hab_card").on("click", function () {
  var id_hab = $(this).prev("p").text();
  $.ajax({
    url: "php/menu_lateral/create_hab.php",
    type: "POST",
    data: "id=" + id_hab + "&delete=si&update=no",
    success: function (res) {
      location.reload();
    },
  });
});

/********************************** GESTION DE CAMPOS *****************************************/
$(".requerido").on("click", function () {
  $(this).find("button").toggleClass("active");
});

$("#send_campos_formulario").on("click", function () {
  var datos = [];
  $(".bloque_campos").each(function () {
    var requerido;
    if ($(this).find(".requerido").find("button").hasClass("active")) {
      requerido = "si";
    } else {
      requerido = "No";
    }
    if (
      $(this)
        .find(".container_masivo")
        .find(".form-switch")
        .find("input")
        .prop("checked") == true
    ) {
      datos.push(
        $(this)
          .find(".container_masivo")
          .find(".form-switch")
          .find("input")
          .attr("name"),
        requerido
      );
    }
  });

  $.ajax({
    url: "php/menu_lateral/campos.php",
    type: "POST",
    data: {
      campos: JSON.stringify(datos),
    },
    success: function (res) {
      console.log(res);
      if ($.trim(res) == "ok") {
        location.reload();
      }
    },
  });
});

$("select[name=campo_existen]").change(function () {
  if ($(this).val() != 0) {
    $.ajax({
      url: "php/menu_lateral/campos_create.php",
      type: "POST",
      data: "edit=si&id=" + $(this).val(),
      success: function (res) {
        var data = JSON.parse(res);

        $("input[name=campo_name]").val(data.CAMPO).prop("disabled", true);
        $("input[name=campo_placeholder]").val(data.PLACEHOLDER);
        $("select[name=campo_tipo] option").each(function () {
          if ($(this).val() == data.TIPO) {
            $(this).prop("selected", true);
          }
        });
      },
    });
  } else {
    $("input[name=campo_name]").prop("disabled", false);
    $("#campo_create")[0].reset();
  }
});
$("input[name=campo_name]").keyup(function () {
  $(this).val($(this).val().replaceAll(" ", "_"));
});
$("#send_create_campo").on("click", function () {
  var data = new FormData(document.getElementById("campo_create"));
  console.log(data.get("campo_existen"));
  $.ajax({
    url: "php/menu_lateral/campos_create.php",
    type: "POST",
    data: data,
    clearForm: true,
    contentType: false,
    processData: false,
    success: function (res) {
      console.log(res);
      if ($.trim(res) == "ok") {
        location.reload();
      }
    },
  });
});

/********************************** CREANDO CUOTAS *****************************************/
var edicion = 0;
$("#send_cuota_create").on("click", function () {
  var data = new FormData(document.getElementById("cuota_create_form"));
  if (edicion == 0) {
    data.append("create", "si");
    $.ajax({
      url: "php/menu_lateral/cuota_create.php",
      type: "POST",
      data: data,
      clearForm: true,
      contentType: false,
      processData: false,
      success: function (res) {
        console.log(res);
        if ($.trim(res) == "ok") {
          location.reload();
        }
      },
    });
  } else {
    data.append("edit", "si");
    data.append("id", edicion);
    $.ajax({
      url: "php/menu_lateral/cuota_create.php",
      type: "POST",
      data: data,
      clearForm: true,
      contentType: false,
      processData: false,
      success: function (res) {
        console.log(res);
        if ($.trim(res) == "ok") {
          location.reload();
        }
      },
    });
  }
});

$(".delete_cuota_card").on("click", function () {
  var id = $(this).prev("p").text();
  $.ajax({
    url: "php/menu_lateral/cuota_create.php",
    type: "POST",
    data: "delete=si&id=" + id,
    success: function (res) {
      console.log(res);
      if ($.trim(res) == "ok") {
        location.reload();
      }
    },
  });
});
$(".lista_cuota").on("click", function () {
  var id = $(this).prev("p").text();
  edicion = id;
  $.ajax({
    url: "php/menu_lateral/cuota_create.php",
    type: "POST",
    data: "call=si&id=" + id,
    success: function (res) {
      var data = JSON.parse(res);

      $("input[name=cuota_name]").val(data[0].NAME);
      $("input[name=cuota_precio]").val(data[0].PRECIO);
      if (data[0].VISIBILIDAD == 1) {
        $("input[name=visibilidad_cuota]").prop("checked", true);
      } else {
        $("input[name=visibilidad_cuota]").prop("checked", false);
      }

      $("select[name=cuota_tipo] option").each(function () {
        console.log($(this).val());
        if ($(this).val() == data[0].TIPO) {
          $(this).prop("selected", true);
        }
      });
    },
  });
});

class CRYPTO {
  constructor(valor) {
    this.texto = valor;
  }
  get_encrypt() {
    this.encrypt = this.texto
      .replace("x", "02568")
      .replace("G", "453@")
      .replace("H", "029367")
      .replace("X", "453*988*")
      .replace("v", "7893@*")
      .replace("M", "4532112")
      .replace("f", "0563*34")
      .replace("F", "4985687")
      .replace("R", "70030303")
      .replace("m", "0278+-64")
      .replace("d", "4534562")
      .replace("D", "0563")
      .replace("j", "453@@@")
      .replace("K", "7893-*@")
      .replace("S", "45313223")
      .replace("l", "4523?_234")
      .replace("C", "49@87?@")
      .replace("w", "7003_@");
    return this.encrypt;
  }
  get_decrypt() {
    this.decrypt = this.texto
      .replace("02568", "x")
      .replace("453@", "G")
      .replace("029367", "H")
      .replace("453*988*", "X")
      .replace("7893@*", "v")
      .replace("4532112", "M")
      .replace("0563*34", "f")
      .replace("4985687", "F")
      .replace("70030303", "R")
      .replace("0278+-64", "m")
      .replace("4534562", "d")
      .replace("0563", "D")
      .replace("453@@@", "j")
      .replace("7893-*@", "K")
      .replace("45313223", "S")
      .replace("4523?_234", "l")
      .replace("49@87?@", "C")
      .replace("7003_@", "w");
    return this.decrypt;
  }
}
/*********************************************************** METODO DE PAGO *************************************************/
$("#metodo_pago_open").on("click", function () {
  $.ajax({
    url: "php/menu_lateral/metodo_pago.php",
    type: "POST",
    data: "call=si",
    success: function (res) {
      var data = JSON.parse(res);
      if (data.TRANSFERENCIA == 1) {
        $("input[name=titular_cuenta]").closest(".col-12").fadeIn();
        $("input[name=transferencia]").prop("checked", true);
        $("input[name=titular_cuenta]").val(data.TITULAR_CUENTA);
        $("input[name=entidad_bancaria]").val(data.ENTIDAD);
        $("input[name=ibam_cuenta]").val(data.IBAM);
        $("input[name=swift_cuenta]").val(data.SWIFT_CODE);
      }
      if (data.TARJETA_VECI == 1) {
        $("input[name=tarjeta_veci]").prop("checked", true);
      }
      if (data.TARJETA == 1) {
        $("input[name=clave_comercio]").closest(".col-12").fadeIn();
        $("input[name=tarjeta]").prop("checked", true);
        $("input[name=clave_comercio]").val(data.CLAVE_COMERCIO);
        var encriptacion = new CRYPTO(data.KEY);
        var encrypt = encriptacion.get_encrypt();
        $("input[name=key_privada]").val(encrypt);
      }
    },
  });
});
$("#mostrar_key").on("click", function () {
  $("#editar_key,#send_cuentas").prop("disabled", true);
  var encriptacion = new CRYPTO($("input[name=key_privada]").val());
  var decrypt = encriptacion.get_decrypt();

  $("input[name=key_privada]").attr("type", "text").val(decrypt);

  var count = 6;
  var intervalo = setInterval(cuenta, 1000);

  function cuenta() {
    count--;
    $("#mostrar_key")
      .text(count + " Ocultar")
      .prop("disabled", true);
    if (count == 0) {
      var encriptacion = new CRYPTO($("input[name=key_privada]").val());
      var encrypt = encriptacion.get_encrypt();
      $("input[name=key_privada]").attr("type", "password").val(encrypt);
      $("#mostrar_key").text("Mostrar").prop("disabled", false);
      clearInterval(intervalo);
      $("#editar_key, #send_cuentas").prop("disabled", false);
    }
  }
  return false;
});

$(".container_pago").on("click", function () {
  if ($(this).find("div").find("input").prop("checked") == true) {
    $(this).find("div").find("input").prop("checked", false);
    $(this).closest(".col-12").next(".p-3").fadeOut();
  } else {
    $(this).find("div").find("input").prop("checked", true);
    $(this).closest(".col-12").next(".p-3").fadeIn();
  }
});

$("#editar_key").on("click", function () {
  $("#mostrar_key, #send_cuentas").prop("disabled", true);
  var encriptacion = new CRYPTO($("input[name=key_privada]").val());
  var decrypt = encriptacion.get_decrypt();

  $("input[name=key_privada]")
    .attr("type", "text")
    .val(decrypt)
    .prop("disabled", false);

  var count = 10;
  var intervalo = setInterval(cuenta, 1000);

  function cuenta() {
    count--;
    $("#editar_key")
      .text(count + " Ocultar")
      .prop("disabled", true);
    if (count == 0) {
      var encriptacion = new CRYPTO($("input[name=key_privada]").val());
      var encrypt = encriptacion.get_encrypt();
      $("input[name=key_privada]")
        .attr("type", "password")
        .val(encrypt)
        .prop("disabled", true);
      $("#editar_key").text("Editar").prop("disabled", false);
      clearInterval(intervalo);
      $("#mostrar_key, #send_cuentas").prop("disabled", false);
    }
  }
  return false;
});

$("#send_cuentas").on("click", function () {
  var datos = new FormData(document.getElementById("datos_metodo_pago"));
  datos.append("edit", "si");
  var encriptacion = new CRYPTO($("input[name=key_privada]").val());
  var decrypt = encriptacion.get_decrypt();
  datos.append("key", decrypt);
  $.ajax({
    url: "php/menu_lateral/metodo_pago.php",
    type: "POST",
    data: datos,
    clearForm: true,
    contentType: false,
    processData: false,
    success: function (res) {
      console.log(res);
      if ($.trim(res) == "ok") {
        location.reload();
      }
    },
  });
});

$(".sticky-top").css({
  height: $(window).height() - 240 + "px",
});
$(".overflow-tabla").css({
  height: $(window).height() - 340 + "px",
});

$("label").click(function () {
  var attr = $(this).attr("for");
  if (attr != "") {
    if (
      $("#" + attr).attr("type") == "radio" ||
      $("#" + attr).attr("type") == "checkbox"
    ) {
      if ($("#" + attr).prop("checked") == true) {
        $("#" + attr).prop("checked", false);
      } else {
        $("#" + attr).prop("checked", true);
      }
    }
  }
});

/******************************************** CODIGOS DESCUENTOS  *****************************************/
var id_codigos = "";
$("#send_codigos").on("click", function () {
  var datos = new FormData(document.getElementById("datos_codigo"));
  if (id_codigos != "") {
    datos.append("edit", true);
    datos.append("id", id_codigos);
  } else {
    datos.append("create", true);
    console.log("create");
  }
  $.ajax({
    url: "php/menu_lateral/codigos_descuento.php",
    type: "POST",
    data: datos,
    clearForm: true,
    contentType: false,
    processData: false,
    success: function (res) {
      console.log(res);
      if ($.trim(res) == "ok") {
        location.reload();
      }
    },
  });
});

$(".delete_codigo_card").on("click", function () {
  var id = $(this).prev("p").text();
  $.ajax({
    url: "php/menu_lateral/codigos_descuento.php",
    type: "POST",
    data: "delete=true&id=" + id,
    success: function (res) {
      console.log(res);
      if ($.trim(res) == "ok") {
        location.reload();
      }
    },
  });
});

$(".lista_codigo").on("click", function () {
  id_codigos = $(this).prev("p").text();
  var cupos = $(this).closest(".d-flex").closest("li").prev("li").text();
  cupos = cupos.substr(7);
  var codigo = $(this)
    .closest(".d-flex")
    .closest("li")
    .prev("li")
    .prev("li")
    .text();
  $("#datos_codigo input[name=cupos]").val(parseInt(cupos));
  $("#datos_codigo input[name=codigo]").val($.trim(codigo));
});
