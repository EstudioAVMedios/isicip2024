// JavaScript Document

$("#close1").click(function () {
  $("#chat_general")
    .css("position", "relative")
    .animate({ left: "-49%" }, 1000);
});
$("#close2").click(function () {
  $("#chat_general").animate({ left: "0%" }, 1000);
});
connect_chat();
var nombre, chat;
setInterval(function () {
  connect_chat();
}, 2000);

setInterval(function () {
  connect_chatselect();
}, 2000);

function connect_chatselect() {
  $.ajax({
    url: "connect_admin2.php",

    type: "POST",

    data: "",
  }).done(function (data) {
    if (data != "empty") {
      $("#nadie2").remove();

      var json = JSON.parse(data);

      var length2 = Object.keys(json).length;

      $(".pregunta2").fadeOut();

      $(".pregunta2").remove();

      for (var i = 0; i < length2; i++) {
        $("#chat2").prepend(
          "<div class='shadow d-flex rounded text-start align-content-around m-3 pregunta2' style='width: 90%; flex-direction: row'><div class='bg-secondary p-2 rounded text-white d-flex m-2 justify-content-center' style='width: 40px;height: 40px; text-transform:uppercase'>" +
            String(json[i].NAME).substr(0, 1) +
            "</div><div class='d-inline-block m-2 datos' style='width: 80%; font-size: 14px'><p class='name-chat'><strong class='name'>" +
            json[i].NAME +
            "</strong><br><span class='question-chat'>" +
            json[i].CHAT +
            "</span><p style='font-size:10px' class='text-muted text-end'>" +
            json[i].DATE +
            "</p></p></div><div class='ms-auto text-center rounded-end m-0 p-2 bg-danger deleteask' style='cursor:pointer'><i class='fas fa-trash-alt text-white p-2' style='font-size:25px'></i></div></div>"
        );
        $(".procesando").delay(2000).remove();
      }

      $(".deleteask").click(function () {
        $("#procesain").append(
          "<button class='btn  bg-none procesando' styl2='color:rgb(0, 25, 101)' type='button' disabled><span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Procesando...</button>"
        );
        $.ajax({
          url: "deleteask.php",
          type: "post",
          data:
            "ask=" + $(this).prevAll(".datos").find(".question-chat").text(),
          success: function (res) {},
        });
      });
    } else {
      $(".pregunta2").remove();

      $(".pregunta2").fadeIn();
    }
  });

  $("textarea").val("");
}

function connect_chat() {
  $.ajax({
    url: "connect_admin.php",

    type: "POST",

    data: "",
  }).done(function (data) {
    if (data != "empty") {
      $("#nadie").remove();

      var json = JSON.parse(data);

      var length2 = Object.keys(json).length;

      $(".pregunta").fadeOut();

      $(".pregunta").remove();

      for (var i = 0; i < length2; i++) {
        if (json[i].STATE == 1) {
          $("#chat").prepend(
            "<div class='shadow d-flex rounded text-start align-content-around m-3 pregunta' style='border: 2px solid #198754; width: 90%;cursor:pointer; flex-direction: row;'><div class='bg-secondary p-2 rounded text-white d-flex m-2 justify-content-center' style='width: 40px;height: 40px; text-transform:uppercase'>" +
              String(json[i].NAME).substr(0, 1) +
              "</div><div class='d-inline-block m-2 datos' style='width: 80%; font-size: 14px'><p class='name-chat'><strong class='name'>" +
              json[i].NAME +
              "</strong><br><span class='question-chat'>" +
              json[i].QUESTION +
              "</span><p style='font-size:10px' class='text-muted text-end'>" +
              json[i].DATE +
              "</p></p></div><div class='ms-auto text-center m-0 p-2 bg-success' style='border:1px solid #198754'><i class='fas fa-user-check text-white p-2' style='font-size:25px'></i></div></div>"
          );
        } else {
          $("#chat").prepend(
            "<div class='shadow d-flex rounded text-start align-content-around m-3 pregunta' style='width: 90%;cursor:pointer; flex-direction: row;'><div class='bg-secondary p-2 rounded text-white d-flex m-2 justify-content-center' style='width: 40px;height: 40px; text-transform:uppercase'>" +
              String(json[i].NAME).substr(0, 1) +
              "</div><div class='d-inline-block m-2 datos' style='width: 80%; font-size: 14px'><p class='name-chat'><strong class='name'>" +
              json[i].NAME +
              "</strong><br><span class='question-chat'>" +
              json[i].QUESTION +
              "</span><p style='font-size:10px' class='text-muted text-end'>" +
              json[i].DATE +
              "</p></p></div></div>"
          );
        }
      }

      $("#chat .pregunta").click(function () {
        $("#procesain").append(
          "<button class='btn  bg-none procesando' styl2='color:rgb(0, 25, 101)' type='button' disabled><span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Procesando...</button>"
        );
        nombre = $(this).find(".datos").find(".name-chat").find(".name").text();
        chat = $(this)
          .find(".datos")
          .find(".name-chat")
          .find(".question-chat")
          .text();
        $.ajax({
          url: "chat-select.php",
          type: "POST",
          data: "name=" + nombre + "&chat=" + chat,
          success: function (res) {
            console.log(res);
          },
        });

        $(this).find(".datos").css({ background: "red!important" });
      });
    } else {
      $(".pregunta").remove();

      $(".pregunta").fadeIn();
    }
  });

  $(".procesando").remove();
}

$(".toggle-password").click(function () {
  $(this).toggleClass("fa-eye fa-eye-slash");

  var input = $($(this).attr("toggle"));

  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
