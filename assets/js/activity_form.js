// JavaScript Document

var ip;
var pais;
var ciudad;
var code;

$("#close2").click(function () {
  $("#alert2").fadeOut(100);
  $("#alerta").remove();
});

//*********************************************form code************************************************//

$('input[name="code"]').change(function () {
  $(this).each(function () {
    if ($(this).attr("id") == "Checkedyes") {
      $("#codeinput").fadeIn();
      $("#gopay").fadeOut();
    } else {
      $("#codeinput").fadeOut();
      $("#gopay").delay(100).fadeIn();
      $("#form_code").fadeOut();
    }
  });
});

$("#sendcode").click(function () {
  if ($("#validationCustom01").val() != "") {
    $.ajax({
      url: "php/form2.php",
      type: "POST",
      data: "code=" + $("#validationCustom01").val(),
      success: function (res) {
        if (res == "noneexist") {
          $("#alert5").fadeIn();
        } else if (res == "success") {
          $("#form_code").fadeIn();
          code = $("#validationCustom01").val();
        } else if (res == "long") {
          $("#alert6").fadeIn();
        }
        if (res == "success") {
        }
      },
    });
  }
});

//**********************************draggable*********************************************//

$("#makeMeDraggable1").draggable({
  axis: "x",
  appendTo: "body",
  containment: ".libros",
  stop: function () {
    if ($(window).width() < 600) {
      if (
        parseInt($("#makeMeDraggable1").css("left")) >
        parseInt($(".libros").css("width")) * 0.65
      ) {
        $("#draggable-section").fadeOut(500);
        $("#form_all").fadeIn();
      }
    } else {
      if (
        parseInt($("#makeMeDraggable1").css("left")) >
        parseInt($(".libros").css("width")) * 0.9
      ) {
        $("#draggable-section").fadeOut(500);
        $("#form_all").fadeIn();
      }
    }
  },
});

$("#submit").click(function () {
  if ($("#validationpassword2").val() == "") {
    if ($("#invalidCheck").prop("checked") == true) {
      if (
        /^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/.test(
          $("#validationCustomUsername").val()
        )
      ) {
        var datos =
          $("#form1").serialize() +
          "&tyc=" +
          $("#invalidCheck").prop("checked") +
          "&ip=" +
          ip +
          "&state=" +
          ciudad +
          "&country=" +
          pais +
          "&code=" +
          code;

        $.ajax({
          url: "php/form.php",
          type: "POST",
          data: datos,
          success: function (e) {
            if (e == "existe") {
              $("#alert").fadeIn();
            } else if (e == "success") {
              var correo = $("#validationCustomUsername").val();
              $("#alert3 strong span").text(correo);
              $("#alert3").fadeIn();
              $("#form1")[0].reset();
              $("#form_code").fadeOut();
              datos = "";
            }
          },
        });
      } else {
        $("#alert4").fadeIn();
        return false;
      }
      return false;
    }
  }
});

//****************************************************************************ENTREGA TPV***********************************************************************//

$("#payTPV1").click(sendPayTPV);
$("#payTPV2").click(sendPayTPV);
function sendPayTPV() {
  var hasError = validateRegisterPayForm();
  if (!hasError) {
    if ($("#first").prop("checked") == true) {
      asistencia = "Online";
    } else if ($("#second").prop("checked") == true) {
      asistencia = "Presencial";
    }
    var data = new FormData(document.getElementById("formTPV"));
    data.append("code", "TPV");
    data.append("asistencia", asistencia);
    data.append("tyc", $("#invalidCheckTPV").prop("checked"));

    $.ajax({
      url: "php/form.php",
      type: "POST",
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      success: function (e) {
        console.log(e);
        if (e == "existe") {
          $("#alert").fadeIn();
        } else if (e == "success") {
          window.location.href =
            "https://isicip23.com/php/redsys/ejemploGeneraPet.php?cuota=" +
            data.get("asistencia");
        }
      },
    });
  }
}
//************************************************************************ENTREGA BANK TRANSFER******************************************************//
$("#paybank1").click(send_transfer);
$("#paybank2").click(send_transfer2);

function send_transfer() {
  var hasError = validateRegisterPayForm();
  if (!hasError) {
    $("#wire85").modal("show");
  }
}

function send_transfer2() {
  var hasError = validateRegisterPayForm();
  if (!hasError) {
    $("#wire370").modal("show");
  }
}

$("#submit85").click(function () {
  var data =
    $("#formTPV").serialize() +
    "&tyc=" +
    $("#invalidCheckTPV").prop("checked") +
    "&ip=" +
    ip +
    "&state=" +
    ciudad +
    "&country=" +
    pais +
    "&code=BANK&asistencia=Online";

  $.ajax({
    url: "php/form.php",
    type: "POST",
    data: data,
    success: function (e) {
      if ($.trim(e) == "success") {
        var correo = $("#validationCustomUsernameTPV").val();
        $("#alert3 strong span").text(correo);
        $("#alert3").fadeIn();
        $("#form1")[0].reset();
        $("#form_code").fadeOut();
        $("#wire85").modal("hide");
        $("html, body").animate(
          {
            scrollTop: 0,
          },
          200
        );
        $("#formTPV")[0].reset();
      } else if ($.trim(e) == "existe") {
        $("#alert7").fadeIn();
        $("html, body").animate(
          {
            scrollTop: 0,
          },
          200
        );
        $("#wire85").modal("hide");
      }
    },
  });
});

$("#submit370").click(function () {
  var data =
    $("#formTPV").serialize() +
    "&tyc=" +
    $("#invalidCheckTPV").prop("checked") +
    "&ip=" +
    ip +
    "&state=" +
    ciudad +
    "&country=" +
    pais +
    "&code=BANK&asistencia=Presencial";

  $.ajax({
    url: "php/form.php",
    type: "POST",
    data: data,
    success: function (e) {
      if ($.trim(e) == "success") {
        var correo = $("#validationCustomUsernameTPV").val();
        $("#alert3 strong span").text(correo);
        $("#alert3").fadeIn();
        $("#form1")[0].reset();
        $("#form_code").fadeOut();
        $("#wire370").modal("hide");
        $("#formTPV")[0].reset();
        $("html, body").animate(
          {
            scrollTop: 0,
          },
          200
        );
      } else if ($.trim(e) == "existe") {
        $("#alert7").fadeIn();
        $("html, body").animate(
          {
            scrollTop: $("#nom_programa").offset().top,
          },
          200
        );
        $("#wire370").modal("hide");
      }
    },
  });
});
var asistencia = 0;
//**************************************************************************VALIDATE***********************************************************//
function validateRegisterPayForm() {
  $("#alertTPV").fadeOut(500);
  var error = "";
  var hasError = false;
  if (
    $("#validationpasswordTPV").val() != "" &&
    $("#validationpassword2TPV").val() != ""
  ) {
    if (
      $("#validationpasswordTPV").val() == $("#validationpassword2TPV").val()
    ) {
      $("#validationpasswordTPV")
        .siblings(".invalid-feedback")
        .css("display", "none");
      $("#validationpassword2TPV")
        .siblings(".invalid-feedback")
        .css("display", "none");
      $("#validationpasswordTPV")
        .siblings(".valid-feedback")
        .css("display", "block");
      $("#validationpassword2TPV")
        .siblings(".valid-feedback")
        .css("display", "block");
      if ($("#invalidCheckTPV").prop("checked") == true) {
        $("#invalidCheckTPV")
          .siblings(".invalid-feedback")
          .css("display", "none");
        $("#invalidCheckTPV")
          .siblings(".valid-feedback")
          .css("display", "block");
        if (
          /^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/.test(
            $("#validationCustomUsernameTPV").val()
          )
        ) {
          $("#validationCustomUsernameTPV")
            .siblings(".invalid-feedback")
            .css("display", "none");
          $("#validationCustomUsernameTPV")
            .siblings(".valid-feedback")
            .css("display", "block");

          /****************************************CHECK ALL FIELDS *****************************************/

          if (
            $("#validationCustom03TPV").val() != "" &&
            $("#validationCustom07TPV").val() != "" &&
            $("#validationCustom08TPV").val() != "" &&
            $("#validationCustom09TPV").val() != "" &&
            $("#validationCustom10TPV").val() != "" &&
            $("#validationCustom11TPV").val() != "" &&
            $("#validationCustom12TPV").val() != ""
          ) {
            $("#validationCustom03TPV")
              .siblings(".invalid-feedback")
              .css("display", "none");
            $("#validationCustom03TPV")
              .siblings(".valid-feedback")
              .css("display", "block");
            if ($("#validationCustom05TPV").val() != "") {
              $("#validationCustom05TPV")
                .siblings(".invalid-feedback")
                .css("display", "none");
              $("#validationCustom05TPV")
                .siblings(".valid-feedback")
                .css("display", "block");
              if ($("#validationCustom03ITPV").val() != "") {
                $("#validationCustom03ITPV")
                  .siblings(".invalid-feedback")
                  .css("display", "none");
                $("#validationCustom03ITPV")
                  .siblings(".valid-feedback")
                  .css("display", "block");
                if ($("#validationCustom05ITPV").val() != "") {
                  $("#validationCustom05ITPV")
                    .siblings(".invalid-feedback")
                    .css("display", "none");
                  $("#validationCustom05ITPV")
                    .siblings(".valid-feedback")
                    .css("display", "block");
                } else {
                  // console.log('check invoice surname');
                  $("#validationCustom05ITPV")
                    .siblings(".invalid-feedback")
                    .css("display", "block");
                  error = "Check invoice surname";
                  hasError = true;
                }
              } else {
                // console.log('check invoice surname');
                $("#validationCustom03ITPV")
                  .siblings(".invalid-feedback")
                  .css("display", "block");
                error = "Check invoice name";
                hasError = true;
              }
            } else {
              // console.log('check surname');
              $("#validationCustom05TPV")
                .siblings(".invalid-feedback")
                .css("display", "block");
              error = "Check surname";
              hasError = true;
            }
          } else {
            // console.log('check name');
            error = "Check all required fields (*)";
            hasError = true;
          }
        } else {
          // console.log('check username');
          $("#validationCustomUsernameTPV")
            .siblings(".invalid-feedback")
            .css("display", "block");
          error = "Check username";
          hasError = true;
        }
      } else {
        // console.log('checks politics');
        $("#invalidCheckTPV")
          .siblings(".invalid-feedback")
          .css("display", "block");
        error = "Check privacy policy";
        hasError = true;
      }
    } else {
      // console.log('password desiguales');
      $("#validationpasswordTPV")
        .siblings(".invalid-feedback")
        .css("display", "block");
      $("#validationpassword2TPV")
        .siblings(".invalid-feedback")
        .css("display", "block");
      error = "Password not match";
      hasError = true;
    }
  } else {
    // console.log('campos de password vacío');
    error = "Fill passwords";
    hasError = true;
    if ($("#validationpasswordTPV").val() != "") {
      $("#validationpasswordTPV")
        .siblings(".invalid-feedback")
        .css("display", "block");
    }
    if ($("#validationpassword2TPV").val() != "") {
      $("#validationpassword2TPV")
        .siblings(".invalid-feedback")
        .css("display", "block");
    }
  }
  if (hasError) {
    $("#alertTPV span").text(error);
    $("#alertTPV").fadeIn();
    $("html, body").animate(
      {
        scrollTop: $("#form_all").offset().top,
      },
      200
    );
  }
  return hasError;
}

$("#pay").click(function (e) {
  e.preventDefault();
  $(
    this
  ).prepend(` <div id="spin" class="spinner-grow d-inline-block" role="status" style="color: white; width: 16px; height: 16px;">
    <span class="visually-hidden">Loading...</span>
  </div>`);
  // $("#spin").remove();
  $("#formRedsys").submit();
});

$("#closeTPV").click(function () {
  $("#alertTPV").fadeOut(500);
});

$("#closeTPVResponse").click(function () {
  $("#alertTPVResponse").fadeOut(500);
});

$("#first").click(function () {
  if (!$("#first").prop("checked")) {
    $("#first").prop("checked", true);
    asistencia = "Online";
    return;
  }
  if ($("#second").prop("checked") == true) {
    $("#second").prop("checked", false);
  }
  if ($("#first").prop("checked")) {
    $("#pay_second").fadeOut(500);
    $("#pay_first").fadeIn();
  }
});

$("#inputGroupPrependTPV1").click(function () {
  if ($("#validationpasswordTPV").prop("type") == "password") {
    $("#validationpasswordTPV").prop("type", "text");
  } else {
    $("#validationpasswordTPV").prop("type", "password");
  }
});

$("#inputGroupPrependTPV2").click(function () {
  if ($("#validationpassword2TPV").prop("type") == "password") {
    $("#validationpassword2TPV").prop("type", "text");
  } else {
    $("#validationpassword2TPV").prop("type", "password");
  }
});

$("#second").click(function () {
  if (!$("#second").prop("checked")) {
    $("#second").prop("checked", true);
    asistencia = "Presencial";
    return;
  }
  if ($("#first").prop("checked") == true) {
    $("#first").prop("checked", false);
  }
  if ($("#second").prop("checked")) {
    $("#pay_first").fadeOut(500);
    $("#pay_second").fadeIn();
  }
});
