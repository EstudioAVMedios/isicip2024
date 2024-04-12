// Custom JavaScript

$(document).ready(function () {
  var ip, pais, ciudad;

  ("use strict");

  // sticky header

  function headerSticky() {
    var windowPos = $(window).scrollTop();

    if (windowPos > 20) {
      $(".fixed-top").addClass("on-scroll");

      $(".light-nav-on-scroll")
        .addClass("dtr-menu-light")
        .removeClass("dtr-menu-dark");

      $(".dark-nav-on-scroll")
        .addClass("dtr-menu-dark")
        .removeClass("dtr-menu-light");
    } else {
      $(".fixed-top").removeClass("on-scroll");

      $(".light-nav-on-load")
        .addClass("dtr-menu-light")
        .removeClass("dtr-menu-dark");

      $(".dark-nav-on-load")
        .addClass("dtr-menu-dark")
        .removeClass("dtr-menu-light");
    }
  }

  headerSticky();

  $(window).scroll(headerSticky);

  // main menu

  $(".main-navigation .sf-menu").superfish({
    delay: 100,

    animation: {
      opacity: "show",

      height: "show",
    },

    speed: 300,
  });

  // menudropdown auto align

  var wapoMainWindowWidth = $(window).width();

  $(".sf-menu ul li").mouseover(function () {
    // checks if third level menu exist

    var subMenuExist = $(this).find(".sub-menu").length;

    if (subMenuExist > 0) {
      var subMenuWidth = $(this).find(".sub-menu").width();

      var subMenuOffset =
        $(this).find(".sub-menu").parent().offset().left + subMenuWidth;

      // if sub menu is off screen, give new position

      if (subMenuOffset + subMenuWidth > wapoMainWindowWidth) {
        var newSubMenuPosition = subMenuWidth;

        $(this).find(".sub-menu").css({
          left: -newSubMenuPosition,

          top: "0",
        });
      }
    }
  }); // menu ends

  // scrollspy

  $("body").scrollspy({
    offset: 170,

    target: ".dtr-scrollspy",
  });

  // nav scroll

  if ($("#dtr-header-global").length) {
    var navoffset = $("#dtr-header-global").height();

    $('.dtr-nav a[href^="#"], .dtr-scroll-link').on("click", function (e) {
      event.preventDefault();

      $("html, body").animate(
        {
          scrollTop: $($(this).attr("href")).offset().top - navoffset - 37,
        },
        "slow",
        "easeInSine"
      );
    });
  } else {
    $(".dtr-scroll-link").on("click", function (e) {
      event.preventDefault();

      $("html, body").animate(
        {
          scrollTop: $($(this).attr("href")).offset().top,
        },
        "slow",
        "easeInSine"
      );
    });
  }

  // responsive header nav scroll

  var mnavoffset = $(".dtr-responsive-header").height();

  var scroll = new SmoothScroll(".dtr-responsive-header-menu a", {
    speed: 500,

    speedAsDuration: true,

    offset: mnavoffset + 15,
  });

  // responsive menu

  $(".main-navigation .dtr-nav").slicknav({
    label: "",

    prependTo: ".dtr-responsive-header-menu",

    closedSymbol: "",

    openedSymbol: "",

    allowParentLinks: "true",

    menuButton: "#dtr-menu-button",

    closeOnClick: true,
  });

  // responsive scrollspy

  $(".slicknav_nav").addClass("dtr-scrollspy");

  // responsive menu button

  $("#dtr-menu-button").on("click", function (e) {
    $(".slicknav_nav").slideToggle();
  });

  // responsive menu hamburger

  var $hamburger = $("#dtr-menu-button");

  $hamburger.on("click", function (e) {
    $hamburger.toggleClass("is-active");
  });

  // sectionAnchor

  function sectionAnchor() {
    var navoffset = $("#dtr-header-global").height();

    var hash = window.location.hash;

    if (hash != "") {
      setTimeout(function () {
        $("html, body")
          .stop()
          .animate(
            {
              scrollTop: $(hash).offset().top - navoffset - 37,
            },
            800,
            "easeInSine"
          );

        history.pushState("", document.title, window.location.pathname);
      }, 500);
    }
  }

  sectionAnchor();

  // responsiveAnchor

  var windowWidth = $(window).width();

  if (windowWidth < 992) {
    function responsiveAnchor() {
      var mnavoffset = $(".dtr-responsive-header").height();

      var hash = window.location.hash;

      if (hash != "") {
        setTimeout(function () {
          $("html, body")
            .stop()
            .animate(
              {
                scrollTop: $(hash).offset().top - mnavoffset - 15,
              },
              800,
              "easeInSine"
            );

          history.pushState("", document.title, window.location.pathname);
        }, 500);
      }
    }

    responsiveAnchor();
  }

  // sticky tabs

  if ($(".dtr-sticky-tabs-wrapper").length > 0) {
    var tabs_container = $(".dtr-sticky-tabs-wrapper");

    var tabs_nav = $(".dtr-sticky-tabs-nav");

    var offset = tabs_container.offset().top;

    $(window).scroll(function (event) {
      var scroll = $(window).scrollTop();

      var total = tabs_container.height() + offset - 200;

      if (scroll > total) {
        tabs_nav.addClass("dtr-sticky-tabs-hide");
      }

      if (scroll < total) {
        tabs_nav.removeClass("dtr-sticky-tabs-hide");
      }
    });
  }

  // sticky tabs scroll

  var taboffset = $("#dtr-header-global").height();

  var taboffset2 = $(".dtr-sticky-tabs-nav").height() + 500;

  $(".dtr-sticky-tabs li a").click(function (event) {
    event.preventDefault();

    $("html, body").animate(
      {
        scrollTop:
          $($(this).attr("href")).offset().top - taboffset - taboffset2,
      },
      "slow",
      "easeInSine"
    );
  });

  // testimonial

  $(".dtr-testimonial-slider").slick({
    slidesToShow: 1,

    slidesToScroll: 1,

    arrows: false,

    dots: true,

    infinite: true,

    autoplay: true,

    autoplaySpeed: 4000,

    fade: true,

    speed: 1000,
  });

  // img slider 3col

  $(".dtr-img-slider-3col").slick({
    slidesToShow: 3,

    slidesToScroll: 1,

    arrows: false,

    dots: false,

    infinite: true,

    autoplay: true,

    autoplaySpeed: 4000,

    responsive: [
      {
        breakpoint: 768,

        settings: {
          slidesToShow: 2,

          slidesToScroll: 1,
        },
      },
    ],
  });

  // img slider 2col

  $(".dtr-img-slider-2col").slick({
    slidesToShow: 2,

    slidesToScroll: 1,

    arrows: false,

    dots: false,

    infinite: true,

    autoplay: true,

    autoplaySpeed: 4500,

    responsive: [
      {
        breakpoint: 768,

        settings: {
          slidesToShow: 2,

          slidesToScroll: 1,
        },
      },
    ],
  });

  // img slider 1col

  $(".dtr-img-slider-1col").slick({
    slidesToShow: 1,

    slidesToScroll: 1,

    arrows: true,

    dots: false,

    infinite: true,

    autoplay: true,

    fade: true,

    speed: 1500,

    autoplaySpeed: 4500,

    responsive: [
      {
        breakpoint: 768,

        settings: {
          slidesToShow: 1,

          slidesToScroll: 1,
        },
      },
    ],
  });

  // wow animations

  if ($(window).outerWidth() >= 767) {
    new WOW().init({
      mobile: false,
    });
  }

  // parallax

  if ($(window).outerWidth() >= 767) {
    $(".parallax").parallaxie({
      speed: 0.6,

      size: "auto",
    });

    $(".parallax.parallax-slow").parallaxie({
      speed: 0.3,
    });
  }

  // video popup

  $(".dtr-video-popup").venobox();

  // Popup video

  $(".popup-video").magnificPopup({
    disableOn: 320,

    type: "iframe",

    mainClass: "mfp-fade",

    removalDelay: 150,

    preloader: false,

    fixedContentPos: false,
  });

  // Popup image

  $(".popup-image").magnificPopup({
    type: "image",
  });

  // Popup gallery

  $(".popup-gallery").magnificPopup({
    type: "image",

    mainClass: "mfp-fade",

    removalDelay: 150,

    gallery: {
      enabled: true,
    },
  });

  // counter

  $(".dtr-counter").appear(function () {
    $(".counting-number").countTo();
  });

  /****************************VALIDAD DNI*********************************************/

  //Contact form

  $(function () {
    var v = $("#contactform").validate({
      submitHandler: function (form) {
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
      },
    });
  });

  //To clear message field on page refresh (you may clear other fields too, just give the 'id to input field' in html and mention it here, as below)

  $("#contactform #message").val("");
}); // document ready

// on load

$(window).on("load", function () {
  // preloader

  $(".dtr-preloader").delay(400).fadeOut(500);
}); // close on load

function enviar() {
  var datos = new FormData(document.getElementById("contactform"));

  datos.append("type", $("#type").text());
  datos.append("ip", $("#ip").text());
  datos.append("pais", $("#pais").text());

  $.ajax({
    url: "../php/contact-form.php",

    /*target: "#result",*/

    clearForm: true,

    data: datos,

    contentType: false,

    processData: false,

    type: "POST",

    success: function (res) {
      if ($.trim(res) == "ok") {
        $("#contact").fadeOut();

        $("#alert-pay").append(
          "<p class='bg-blue p-3 text-white' style='border-radius:15px'><strong>FELICIDADES!!</strong><br> Está a un pequeño paso de una gran experiencia, solo debe completar el pago para poder validar su registro. En unos instantes recibirá un email con sus datos de acceso y un enlace para completar el pago cuando desee.</p>"
        );

        $("#msg1").remove();

        $("#payButton").fadeIn();
      } else if ($.trim(res) == "full") {
        $("#formalert").append(
          "<p class='bg-blue-2 text-center p-2'>!Lo Sentimos, existe un registro con el email que intenta registrar.</p>"
        );
      }

      console.log(res);
    },
  });

  return false;
}

$("#more").click(function () {
  if ($("#info").css("display") == "none") {
    $("#info").fadeIn();

    $("#more-text").text("Menos info");
  } else {
    $("#info").fadeOut();

    $("#more-text").text("Más info");
  }
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
      1000
    );
  });

  $(window).scroll(function () {
    if ($(this).scrollTop() > 0) {
      $(".ir-arriba").slideDown(600);
    } else {
      $(".ir-arriba").slideUp(600);
    }
  });

  $(".ir-abajo").click(function () {
    $("body,html").animate(
      {
        scrollTop: "1000px",
      },
      1000
    );
  });
}

var toogle2 = true;

$("#show").click(function () {
  if (toogle2 == true) {
    $("#pass").attr("type", "text");

    $(this).text("Hide");

    toogle2 = false;
  } else {
    $("#pass").attr("type", "password");

    $(this).text("Show");

    toogle2 = true;
  }
});

var toogle3 = true;

$("#show1").click(function () {
  if (toogle3 == true) {
    $("#pass1").attr("type", "text");

    $(this).text("Hide");

    toogle3 = false;
  } else {
    $("#pass1").attr("type", "password");

    $(this).text("Show");

    toogle3 = true;
  }
});

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

$("#pay-now").click(function () {
  $("#pay").fadeIn();

  $("html, body").animate(
    {
      scrollTop: 900,
    },
    1000
  );
});

$("#send-login").click(function () {
  var login = new FormData(document.getElementById("login-form"));

  $.ajax({
    url: "php/log.php",

    /*target: "#result",*/

    clearForm: true,

    data: login,

    contentType: false,

    processData: false,

    type: "POST",

    success: function (res) {
      if ($.trim(res) == "pause") {
        $("#login-alert").append(
          "<p class='bg-blue p-3 text-white my-3' style='border-radius:15px'><strong>Sorry!</strong> Your account is not active yet</p>"
        );
      } else if ($.trim(res) == "pass") {
        $("#login-alert").append(
          "<p class='bg-blue p-3 text-white my-3' style='border-radius:15px'><strong>Sorry!</strong> wrong password.</p>"
        );
      } else if ($.trim(res) == "email") {
        $("#login-alert").append(
          "<p class='bg-blue p-3 text-white my-3' style='border-radius:15px'><strong>Sorry!</strong> the email is not registered.</p>"
        );
      } else if ($.trim(res) == "correcto") {
        window.location.href = "system/";
      }

      console.log(res);
    },
  });
});

$("#send-change").click(function () {
  if (
    $("#change-email").val() != "" &&
    $("#change-pass").val() != "" &&
    $("#change-pass2").val() != ""
  ) {
    if ($("#change-pass").val() === $("#change-pass2").val()) {
      var change = new FormData(document.getElementById("change-form"));

      $.ajax({
        url: "php/change.php",

        /*target: "#result",*/

        clearForm: true,

        data: change,

        contentType: false,

        processData: false,

        type: "POST",

        success: function (res) {
          if ($.trim(res) == "ok") {
            $("#change-alert").append(
              "<p class='bg-blue p-3 text-white my-3' style='border-radius:15px'><strong>All ready!</strong> Your password has been change successfully.</p>"
            );

            $("#change-form")[0].reset();
          } else if ($.trim(res) == "empty") {
            $("#change-alert").append(
              "<p class='bg-blue p-3 text-white my-3' style='border-radius:15px'><strong>Sorry!</strong> the email is not registered.</p>"
            );
          }

          console.log(res);
        },
      });
    } else {
      $("#change-alert").append(
        "<p class='bg-blue p-3 text-white my-3' style='border-radius:15px'><strong>Sorry!</strong> Passwords not match</p>"
      );
    }
  } else {
    $("#change-alert").append(
      "<p class='bg-blue p-3 text-white my-3' style='border-radius:15px'> Todos los campos son obligatorios</p>"
    );
  }
});

$("#send-ask").click(function () {
  if ($("#ask-pass").val() === "") {
    if (
      $("#ask-email").val() != "" &&
      $("#ask-name").val() != "" &&
      $("#ask-msg").val() != ""
    ) {
      var ask = new FormData(document.getElementById("ask-form"));

      $.ajax({
        url: "php/mail.php",

        /*target: "#result",*/

        clearForm: true,

        data: ask,

        contentType: false,

        processData: false,

        type: "POST",

        success: function (res) {
          if ($.trim(res) == "ok") {
            $("#ask-alert").append(
              "<p class='bg-blue p-3 text-white my-3' style='border-radius:15px'><strong>Todo listo!</strong> En breves minutos recibirá un correo electrónico con el resumen de su consulta. Uno de nuestros agentes se pondrá en contacto con usted a la mayor brevedad</p>"
            );

            $("#ask-form")[0].reset();
          } else if ($.trim(res) == "empty") {
            $("#ask-alert").append(
              "<p class='bg-blue p-3 text-white my-3' style='border-radius:15px'><strong>Lo sentimos!</strong> El correo electrónico introducido no está registrado para este evento</p>"
            );
          }

          console.log(res);
        },
      });
    } else {
      $("#ask-alert").append(
        "<p class='bg-blue p-3 text-white my-3' style='border-radius:15px'> Todos los campos son obligatorios</p>"
      );
    }
  }
});

//*********************************************************PATROCINIO******************************************************//

var count_patrotype = [];

var encontrar;

var id_patrocinio;

var count_patrocinio = 0;

$(".open_modal_patrocinador").click(function () {
  $(".name_patrocinador").remove();
  $(".address_patrocinador").remove();
  var empresa = $(this).prevAll(".card-title").text();

  $(".download_container").remove();

  $.ajax({
    url: "../php/patrocinio.php",
    type: "POST",
    data: "name=" + empresa,
  }).done(function (data) {
    var datos = JSON.parse(data);

    $("#company_name").text(datos.NAME);
    if (datos.URL != "") {
      $("#web_patrocinador").attr("href", datos.URL).fadeIn();
    } else {
      $("#web_patrocinador").fadeOut();
    }
    if (datos.PHONE != "") {
      $("#phone_patrocinador").fadeIn().text(datos.PHONE);
    } else {
      $("#phone_patrocinador").fadeOut();
    }
    if (datos.CONTACTNAME != "") {
      $("#nombre_contacto").fadeIn();
      $("#nombre_contacto").text(datos.CONTACTNAME);
    } else {
      $("#nombre_contacto").fadeOut();
    }

    $("#email_patrocinador").text(datos.EMAIL);
    $("#logo_patrocinador")
      .attr("src", "../Imagenes/sponsors/" + datos.LOGO)
      .closest("a")
      .attr("href", datos.URL);
    $("#info_patrocinador").html(
      "<p id='info_patrocinador'>" + datos.INFO + "</p>"
    );
    if (datos.FONDO != "") {
      $("#fondo_patrocinador")
        .fadeIn()
        .css("background-image", "url(" + datos.FONDO + ")");
      console.log();
    }
    if (datos.FILE != null) {
      $("#archivo1")
        .fadeIn()
        .find("div")
        .find("a")
        .attr(
          "href",
          "https://isicip23.com/assets/archivos/patrocinadores/" + datos.FILE
        )
        .attr("download", datos.FILE)
        .next("p")
        .text(datos.FILE);
      console.log();
    } else {
      $("#archivo1").fadeOut();
    }
    if (datos.FILE2 != null) {
      $("#archivo2")
        .fadeIn()
        .find("div")
        .find("a")
        .attr(
          "href",
          "https://isicip23.com/assets/archivos/patrocinadores/" + datos.FILE2
        )
        .attr("download", datos.FILE2)
        .next("p")
        .text(datos.FILE2);
      console.log();
    } else {
      $("#archivo2").fadeOut();
    }
    $("#video").find("iframe").attr("src", datos.VIDEO);
    console.log(datos.FONDO);
  });
});

$(".programa_active").removeClass("programaon").addClass("programaoff");

$(".programa_active:first").addClass("programaon");

$(".programa_active").on("click", function () {
  $(".programa_active").removeClass("programaon").addClass("programaoff");

  $(this).addClass("programaon");
});

$("title").after(
  "<meta property='og:locale' content='es_ES'><meta property='og:type' content='article'><meta property='og:title' content='ISICIP 2023'><meta property='og:url' content='https://isicip23.com/'><meta property='og:site_name' content='ISICIP 2023'><meta property='article:modified_time' content='2023-06-07T15:19:50+00:00'><meta property='og:image' content='https://isicip23.com/assets/images/indeximg1.png'>"
);
