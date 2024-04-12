var email2;
var id2;
var id3;
var bbdd_cuota = 0;
var bbdd_m_pago = 0;
var bbdd_estado_pago = 0;
var bbdd_cuota_apoyo = 0;
var cuota_apoyo = 0
var categoria;
var m_pago = false;
var estado_pago = false;
var cuota = 0;


$("#contactform-acompa .m-pago").click(function () {
    $('.m-pago-check-pago').removeClass('m-pago-check-pago').addClass('m-pago')
    $(this).addClass('m-pago-check-pago').removeClass('m-pago');
    m_pago = $(this).find('p').text();
    console.log(m_pago);
})

/*************************************** CARGANDO DATOS PARA EDITARLOS *************************************/

$("#aacompa,#pacompa, #pacompa3, #gestion, #gestion3").on("click", function () {
    sino($(this).attr("id"))
})
$("#aacompa").val("No");

function sino(valor) {
    console.log("#" + valor);
    if ($("#" + valor).prop("checked") == true) {
        $("#" + valor).val("Si")
    } else {
        $("#" + valor).val("No")
    }
}

$(".acompa-modal").click(function () {

    id3 = $(this).prev("p").text();

    $.ajax({
        url: "php/user_fact.php",
        type: "POST",
        data: "id=" + id3 + "&edit=acompa",
        success: function (res) {

            $('#contactform-acompa.m-pago-check-pago').removeClass('m-pago-check-pago').addClass('m-pago');
            $('#contactform-acompa.estado-check-pago').removeClass('estado-check-pago').addClass('estado-pago');
            $('#contactform-acompa.m-pago-check-cuota').removeClass('m-pago-check-cuota').addClass('cuota');
            $('#contactform-acompa .devolver1').fadeOut();
            var data = jQuery.parseJSON(res);
            $("#aname").val(data.NAME);
            $("#aape").val(data.SURNAME);
            $("#adni").val(data.DNI);
            $("#aemail").val(data.EMAIL);
            $("#atel").val(data.TELEFONO);


            cuota = data.ACOMPA_CUOTA;
            m_pago = data.ACOMPA_PAGO;
            estado_pago = data.ACOMPA_ESTADO;
            bbdd_cuota = data.ACOMPA_CUOTA;
            bbdd_m_pago = data.ACOMPA_PAGO;
            bbdd_estado_pago = data.ACOMPA_ESTADO;
            bbdd_cuota_apoyo = data.ACOMPA_APOYO;
            cuota_apoyo = bbdd_cuota_apoyo;


            if (data.ACOMPA_ESTADO == "DEVOLUCION") {
                $('.devolver1').fadeIn();
            }
            if (m_pago == "TRANSFERENCIA") {
                $("#m-pago11").addClass('m-pago-check-pago').removeClass('m-pago');
            } else if (m_pago == "TARJETA ECI") {
                $("#m-pago21").addClass('m-pago-check-pago').removeClass('m-pago');
            } else if (m_pago == "TPV") {
                $("#m-pago31").addClass('m-pago-check-pago').removeClass('m-pago');
            } else if (m_pago == "FREE") {
                $("#m-pago41").addClass('m-pago-check-pago').removeClass('m-pago');
            } else if (m_pago == "") {

                $('#contactform-acompa .m-pago-check-cuota').removeClass('m-pago-check-cuota').addClass('cuota');
                $('#contactform-acompa .m-pago-check-pago').removeClass('m-pago-check-pago').addClass('m-pago');
                $('#contactform-acompa .estado-check-pago').removeClass('estado-check-pago').addClass('estado-pago');
            }


            $('#contactform-acompa .cuota').each(function () {
                if ($(this).find('p').text() == data.ACOMPA_CUOTA) {
                    $(this).addClass('m-pago-check-cuota').removeClass('cuota');
                }
            })

            if (estado_pago == "PENDIENTE") {
                $("#estado-pago21").addClass('estado-check-pago').removeClass('estado-pago');
            } else if (estado_pago == "PAGADO") {
                $("#estado-pago11").addClass('estado-check-pago').removeClass('estado-pago');
            } else if (estado_pago == "DEVOLUCION") {
                $("#estado-pago31").addClass('estado-check-pago').removeClass('estado-pago');
            }
            if (data.ACOMA_ESTADO == "PENDIENTE" && bbdd_cuota_apoyo == 0) {
                $("#estado-pago2").addClass('estado-check-pago').removeClass('estado-pago');
                $('#contactform-acompa .devolver_piloto').find('div').find('div:first-child').text('PENDIENTE').removeClass('text-warning text-danger').addClass('text-warning');
                $('#contactform-acompa .devolver_piloto').find('div').find('div:last-child').text(bbdd_cuota + '€').removeClass('text-warning text-danger').addClass('text-warning');
            }
            if (data.ACOMPA_ESTADO == "PENDIENTE" && bbdd_cuota_apoyo != 0) {
                $('#contactform-acompa .devolver_piloto2').find('div').find('div:last-child').text((parseFloat(bbdd_cuota) - parseFloat(bbdd_cuota_apoyo)).toFixed(2) + '€');
                $("#estado-pago2").addClass('estado-check-pago').removeClass('estado-pago');
                $('#contactform-acompa .devolver_piloto').find('div').find('div:first-child').text('PENDIENTE').removeClass('text-warning text-danger').addClass('text-warning');
                $('#contactform-acompa .devolver_piloto').find('div').find('div:last-child').text(bbdd_cuota_apoyo + '€').removeClass('text-warning text-danger').addClass('text-warning');
            } else if (data.ACOMPA_ESTADO == "PAGADO") {
                $('#contactform-acompa .devolver_piloto').find('div').find('div:first-child').text('CONFIRMADO').removeClass('text-warning text-danger')
                $('#contactform-acompa .devolver_piloto').find('div').find('div:last-child').text('0.00€').removeClass('text-warning text-danger')
                $("#estado-pago1").addClass('estado-check-pago').removeClass('estado-pago');
                $('#contactform-acompa .devolver_piloto2').find('div').find('div:last-child').text(bbdd_cuota + '€');
            } else if (data.ACOMPA_ESTADO == "DEVOLUCION" && bbdd_cuota_apoyo != 0) {

                $('#contactform-acompa .devolver_piloto2').find('div').find('div:last-child').text((parseFloat(bbdd_cuota_apoyo) + parseFloat(bbdd_cuota)).toFixed(2) + '€');
                $('#contactform-acompa .devolver_piloto').find('div').find('div:first-child').text('A DEVOLVER').removeClass('text-warning text-danger').addClass('text-danger');
                $('#contactform-acompa .devolver_piloto').find('div').find('div:last-child').text(bbdd_cuota_apoyo + '€').removeClass('text-warning text-danger').addClass('text-danger');
                $("#estado-pago3").addClass('estado-check-pago').removeClass('estado-pago');
            }

        }

    })
})


$('#delete-acompa').click(function () {
    var datos = new FormData(document.getElementById('contactform-acompa'));
    datos.append("id", id3);


    $.ajax({
        url: "php/acompa_delete.php",
        type: "POST",
        clearForm: true,
        contentType: false,
        processData: false,
        data: datos,
        success: function (res) {
            console.log(res);
            if ($.trim(res) == "ok") {

                location.reload();

            }

        }


    });

    return false;
})


/************************* CALCULOS DE PENDIENTES DEVOLUCIONES Y CONFIRMADOS **************************************/


$('#contactform-acompa .cuota').click(function () {
    $('#contactform-acompa .m-pago-check-cuota').removeClass('m-pago-check-cuota').addClass('cuota');
    $(this).addClass('m-pago-check-cuota').removeClass('cuota');
    cuota = $(this).find('p').text();

    $(this).removeClass('cuota').addClass('m-pago-check-cuota');
    if (bbdd_estado_pago == "PAGADO") {
        if (cuota > bbdd_cuota) {
            cuota_apoyo = cuota - bbdd_cuota;
            pilotos_acompa("PENDIENTE", cuota_apoyo);

        } else if (cuota < bbdd_cuota) {
            cuota_apoyo = bbdd_cuota - cuota;
            pilotos_acompa("DEVOLUCION", cuota_apoyo);
        } else {
            cuota_apoyo = cuota - bbdd_cuota;
            pilotos_acompa("CONFIRMADO", cuota_apoyo);
        }
    } else if (bbdd_estado_pago == "DEVOLUCION") {

        if (cuota > (parseFloat(bbdd_cuota) + parseFloat(bbdd_cuota_apoyo))) {
            cuota_apoyo = cuota - (parseFloat(bbdd_cuota) + parseFloat(bbdd_cuota_apoyo));
            pilotos_acompa("PENDIENTE", cuota_apoyo)

        } else if (cuota < (parseFloat(bbdd_cuota) + parseFloat(bbdd_cuota_apoyo))) {
            cuota_apoyo = parseFloat(bbdd_cuota) + parseFloat(bbdd_cuota_apoyo) - cuota;
            pilotos_acompa("DEVOLUCION", cuota_apoyo)

        } else {
            cuota_apoyo = cuota - (parseFloat(bbdd_cuota) + parseFloat(bbdd_cuota_apoyo));
            pilotos_acompa("CONFIRMADO", cuota_apoyo)

        }
    } else if (bbdd_estado_pago == "PENDIENTE") {

        if (cuota == 0) {
            cuota_apoyo = parseFloat(cuota);
            pilotos_acompa("CONFIRMADO", cuota_apoyo)

        } else if (cuota < (parseFloat(bbdd_cuota) - parseFloat(bbdd_cuota_apoyo))) {
            cuota_apoyo = parseFloat(cuota);
            pilotos_acompa("PENDIENTE", cuota_apoyo)

        } else if (cuota > (parseFloat(bbdd_cuota) - parseFloat(bbdd_cuota_apoyo))) {
            cuota_apoyo = parseFloat(cuota);
            pilotos_acompa("PENDIENTE", cuota_apoyo)

        } else {
            cuota_apoyo = parseFloat(cuota);
            pilotos_acompa("PENDIENTE", cuota_apoyo)
        }
    }
})


/*********************** ENVIO DE LOS CAMBIOS ************************************/
$('#update_acompa').click(function () {
    estado_pago = $('#contactform-acompa .estado-check-pago').find('p').text();
    enviar_acompa('contactform-acompa');
    return false;

})

function enviar_acompa(valor) {
    var datos = new FormData(document.getElementById(valor));
    datos.append("id", id3);
    datos.append("CUOTA", cuota);
    datos.append("PAGO", $('.m-pago-check-pago').find('p').text());
    datos.append("ESTADO", $('.estado-check-pago').find('p').text());
    datos.append("CUOTA_APOYO", cuota_apoyo);

    if (valor == 'contactform-acompa') {
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

                $("#formalert2").append("<p class='bg-blue-2 text-center p-2'>!Lo Sentimos, existe un registro con el email que intenta registrar.</p>");

            } else if ($.trim(res) == "fecha") {

                alert("Lo sentimos no hay disponibilidad para el día " + res);

            }


        }


    });

    return false;

}
/*********************** FUNCION AUXILIAR DE CALCULOS, IMPRIME PENDIENTE DEVOLUCIONES Y CONFIRMADOS  ************************************/
function pilotos_acompa(valor, valor1) {
    $('.estado-check-pago').removeClass('estado-check-pago').addClass('estado-pago');

    if (valor == "PENDIENTE") {
        $('#contactform-acompa #estado-pago21').addClass('estado-check-pago').removeClass('estado-pago');
        $('#contactform-acompa .devolver_piloto').find('div').find('div:first-child').text('PENDIENTE').removeClass('text-warning text-danger').addClass('text-warning');
        $('#contactform-acompa .devolver_piloto').find('div').find('div:last-child').text(valor1.toFixed(2) + '€').removeClass('text-warning text-danger').addClass('text-warning');
    } else if (valor == "DEVOLUCION") {
        $('#contactform-acompa #estado-pago31').addClass('estado-check-pago').removeClass('estado-pago');
        $('#contactform-acompa .devolver_piloto').find('div').find('div:first-child').text('A DEVOLVER').removeClass('text-warning text-danger').addClass('text-danger');
        $('#contactform-acompa .devolver_piloto').find('div').find('div:last-child').text(valor1.toFixed(2) + '€').removeClass('text-warning text-danger').addClass('text-danger');
    } else {
        $('#contactform-acompa #estado-pago11').addClass('estado-check-pago').removeClass('estado-pago');
        $('#contactform-acompa .devolver_piloto').find('div').find('div:first-child').text('CONFIRMADO').removeClass('text-warning text-danger');
        $('#contactform-acompa .devolver_piloto').find('div').find('div:last-child').text(valor1.toFixed(2) + '€').removeClass('text-warning text-danger');
    }

}
