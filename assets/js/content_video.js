// JavaScript Document

var encontrar;

var count_videos = [];

var count_tarjetas_carta = 0;

var count_tarjetas_comite = 0;

/****************************************BUSCANDO VIDEOS EN JSON*********************************************/

$.ajax({
  url: "../../info/videos_carta.json",
  type: "GET",
  dataType: "json",
}).done(function (data) {
  for (var i = 0; i < data.length; i++) {
    encontrar = count_videos.includes(data[i].TITLE);

    if (encontrar) {
      continue;
    }
    if (data[i].CONTENT == "Sesiones05") {
      $("#pills-10").append(
        "<div class='card h-100 m-3 d-inline-block text-start border-0' style='width: 15rem;vertical-align:top'><img src='../../assets/images/miniaturas/generica.png' class='card-img-top'> <div class='card-body'><h5 class='card-title'>" +
          data[i].TITLE +
          "</h5></div> <ul class='list-group list-group-flush'><li class='list-group-item'>Duration <span class='badge rounded text-white p-2' style='background-color: var(--bg-color)'>" +
          data[i].HDURATION +
          "H " +
          data[i].MDURATION +
          "M</span></li></ul><div class='card-body'><a href='video_ponencias.php?video=" +
          data[i].TITLE +
          "' class='card-link' style='color: var(--bg-color)'><i class='fas fa-play'></i> Watch video</a></div></div>"
      );

      count_videos.push(data[i].TITLE);

      /*for(var g=0;g<data.length;g++){

	if(data[g].TITLE==data[i].TITLE){

			$("#speaker"+ i+"").append(data[g].SPEAKER + "<br>");

			

		}

	}*/
    }
    if (data[i].CONTENT == "Sesiones06") {
      $("#pills-11").append(
        "<div class='card h-100 m-3 d-inline-block text-start border-0' style='width: 15rem;vertical-align:top'><img src='../../assets/images/miniaturas/generica.png' class='card-img-top'> <div class='card-body'><h5 class='card-title'>" +
          data[i].TITLE +
          "</h5></div> <ul class='list-group list-group-flush'></li><li class='list-group-item'>Duration <span class='badge rounded text-white p-2' style='background-color: var(--bg-color)'>" +
          data[i].HDURATION +
          "H " +
          data[i].MDURATION +
          "M</span></li></ul><div class='card-body'><a href='video_ponencias.php?video=" +
          data[i].TITLE +
          "' class='card-link' style='color: var(--bg-color)'><i class='fas fa-play'></i> Watch video</a></div></div>"
      );

      count_videos.push(data[i].TITLE);

      /*for(var g=0;g<data.length;g++){

	if(data[g].TITLE==data[i].TITLE){

			$("#speaker"+ i+"").append(data[g].SPEAKER + "<br>");

			

		}

	}*/
    }

    if (data[i].CONTENT == "Sesiones12") {
      $("#pills-12").append(
        "<div class='card h-100 m-3 d-inline-block text-start border-0' style='width: 15rem;vertical-align:top'><img src='../../assets/images/miniaturas/generica.png' class='card-img-top'> <div class='card-body'><h5 class='card-title'>" +
          data[i].TITLE +
          "</h5></div> <ul class='list-group list-group-flush'></li><li class='list-group-item'>Duration <span class='badge rounded text-white p-2' style='background-color: var(--bg-color)'>" +
          data[i].HDURATION +
          "H " +
          data[i].MDURATION +
          "M</span></li></ul><div class='card-body'><a href='video_ponencias.php?video=" +
          data[i].TITLE +
          "' class='card-link' style='color: var(--bg-color)'><i class='fas fa-play'></i> Watch video</a></div></div>"
      );

      count_videos.push(data[i].TITLE);

      /*for(var g=0;g<data.length;g++){

	if(data[g].TITLE==data[i].TITLE){

			$("#speaker"+ i+"").append(data[g].SPEAKER + "<br>");

			

		}

	}*/
    }

    if (data[i].CONTENT == "Sesiones16") {
      $("#pills-16").append(
        "<div class='card h-100 m-3 d-inline-block text-start border-0' style='width: 15rem;vertical-align:top'><img src='../../assets/images/miniaturas/generica.png' class='card-img-top'> <div class='card-body'><h5 class='card-title'>" +
          data[i].TITLE +
          "</h5></div> <ul class='list-group list-group-flush'><li class='list-group-item'>Duration <span class='badge rounded text-white p-2' style='background-color: var(--bg-color)'>" +
          data[i].HDURATION +
          "H " +
          data[i].MDURATION +
          "M</span></li></ul><div class='card-body'><a href='video_ponencias.php?video=" +
          data[i].TITLE +
          "' class='card-link' style='color: var(--bg-color)'><i class='fas fa-play'></i> Watch video</a></div></div>"
      );

      count_videos.push(data[i].TITLE);

      /*for(var g=0;g<data.length;g++){

	if(data[g].TITLE==data[i].TITLE){

			$("#speaker"+ i+"").append(data[g].SPEAKER + "<br>");

			

		}

	}*/
    }
    if (data[i].CONTENT == "Sesiones5") {
      $("#pills-5").append(
        "<div class='card h-100 m-3 d-inline-block text-start border-0' style='width: 15rem;vertical-align:top'><img src='../../assets/images/miniaturas/generica.png' class='card-img-top'> <div class='card-body'><h5 class='card-title'>" +
          data[i].TITLE +
          "</h5></div> <ul class='list-group list-group-flush'><li class='list-group-item  border-top' id='speaker" +
          i +
          "'></li><li class='list-group-item'>Duration <span class='badge rounded ' style='background-color: var(--bg-color)'>" +
          data[i].HDURATION +
          "H " +
          data[i].MDURATION +
          "M</span></li></ul><div class='card-body'><a href='video_ponencias.php?video=" +
          data[i].TITLE +
          "' class='card-link' style='color: var(--bg-color)'><i class='fas fa-play'></i> Watch video</a></div></div>"
      );

      count_videos.push(data[i].TITLE);

      /*for(var g=0;g<data.length;g++){

	if(data[g].TITLE==data[i].TITLE){

			$("#speaker"+ i+"").append(data[g].SPEAKER + "<br>");

			

		}

	}*/
    }
    if (data[i].CONTENT == "Sesiones6") {
      $("#pills-6").append(
        "<div class='card h-100 m-3 d-inline-block text-start border-0' style='width: 15rem;vertical-align:top'><img src='../../assets/images/miniaturas/generica.png' class='card-img-top'> <div class='card-body'><h5 class='card-title'>" +
          data[i].TITLE +
          "</h5></div> <ul class='list-group list-group-flush'><li class='list-group-item  border-top' id='speaker" +
          i +
          "'></li><li class='list-group-item'>Duration <span class='badge rounded ' style='background-color: var(--bg-color)'>" +
          data[i].HDURATION +
          "H " +
          data[i].MDURATION +
          "M</span></li></ul><div class='card-body'><a href='video_ponencias.php?video=" +
          data[i].TITLE +
          "' class='card-link' style='color: var(--bg-color)'><i class='fas fa-play'></i> Watch video</a></div></div>"
      );

      count_videos.push(data[i].TITLE);

      /*for(var g=0;g<data.length;g++){

	if(data[g].TITLE==data[i].TITLE){

			$("#speaker"+ i+"").append(data[g].SPEAKER + "<br>");

			

		}

	}*/
    }
    if (data[i].CONTENT == "Sesiones7") {
      $("#pills-7").append(
        "<div class='card h-100 m-3 d-inline-block text-start border-0' style='width: 15rem;vertical-align:top'><img src='../../assets/images/miniaturas/generica.png' class='card-img-top'> <div class='card-body'><h5 class='card-title'>" +
          data[i].TITLE +
          "</h5></div> <ul class='list-group list-group-flush'><li class='list-group-item  border-top' id='speaker" +
          i +
          "'></li><li class='list-group-item'>Duration <span class='badge rounded ' style='background-color: var(--bg-color)'>" +
          data[i].HDURATION +
          "H " +
          data[i].MDURATION +
          "M</span></li></ul><div class='card-body'><a href='video_ponencias.php?video=" +
          data[i].TITLE +
          "' class='card-link' style='color: var(--bg-color)'><i class='fas fa-play'></i> Watch video</a></div></div>"
      );

      count_videos.push(data[i].TITLE);

      /*for(var g=0;g<data.length;g++){

	if(data[g].TITLE==data[i].TITLE){

			$("#speaker"+ i+"").append(data[g].SPEAKER + "<br>");

			

		}

	}*/
    }

    if (data[i].CONTENT == "A la Carta") {
      //Diferenciar videos a la carta de sesiones diferidas

      $("#pills-16").append(
        "<div class='card h-100 m-3 d-inline-block text-start border-0' style='width: 15rem;'><img src='../../assets/images/miniaturas/generica.png' class='card-img-top'> <div class='card-body'><h5 class='card-title'>" +
          data[i].TITLE +
          "</h5></div> <ul class='list-group list-group-flush'><li class='list-group-item  border-top' id='speaker" +
          i +
          "'></li><li class='list-group-item'>Duration <span class='badge rounded ' style='background-color: var(--bg-color)'>" +
          data[i].HDURATION +
          "H " +
          data[i].MDURATION +
          "M</span></li></ul><div class='card-body'><a href='video_ponencias.php?video=" +
          data[i].TITLE +
          "' class='card-link' style='color: var(--bg-color)'><i class='fas fa-play'></i> Watch video</a></div></div>"
      );

      count_videos.push(data[i].TITLE);

      count_tarjetas_carta++;

      /****************************************ASIGNANDO PONENTES VIDEO*********************************************/

      for (var g = 0; g < data.length; g++) {
        if (data[g].TITLE == data[i].TITLE) {
          $("#speaker" + i + "").append(data[g].SPEAKER + "<br>");
        }
      }
    } else {
      $("#videos_cards_diferido").append(
        "<div class='card h-100 m-3 d-inline-block text-start border-0' style='width: 15rem;'><img src='../../Imagenes/videos/miniaturas/" +
          data[i].FILE +
          "' class='card-img-top'> <div class='card-body'><h5 class='card-title'>" +
          data[i].TITLE +
          "</h5></div> <ul class='list-group list-group-flush'><li class='list-group-item  border-top border-bottom' id='speaker" +
          i +
          "'></li></ul><div class='card-body'><div hidden class='title_diferido'>" +
          data[i].TITLE +
          "</div><div class='url_diferido' hidden>" +
          data[i].URL +
          "</div><a data-bs-toggle='modal' data-bs-target='#staticBackdrop' class='card-link' style='color: var(--bg-color);cursor:pointer'><i class='fas fa-play'></i> Watch video</a></div></div>"
      );

      count_videos.push(data[i].TITLE);

      count_tarjetas_comite++;

      /****************************************ASIGNANDO PONENTES VIDEO*********************************************/

      for (g = 0; g < data.length; g++) {
        if (data[g].TITLE == data[i].TITLE) {
          $("#speaker" + i + "").append(data[g].SPEAKER + "<br>");
        }
      }
    }
  }

  $(".card-link").click(function () {
    $("#video_diferido_title").text($(this).prevAll(".title_diferido").text());
    $("iframe").attr("src", $(this).prevAll(".url_diferido").text());
  });

  $("#nom_videos_carta").text(count_tarjetas_carta);

  $("#nom_videos_diferido").text(count_tarjetas_comite);
});

/***************ASIGNANDO RUTAS Y TEXTO MENU, VIDEO EN PAGINA DE VIDEO SEGUN CONTENT*******************/

//la pgina de video por defecto está creada para videos a la carta, pero si el video que llega por GET es de Sesiones debemos cambiar la apariencia del menu y las rutas para adaptarlo a sesiones

$.ajax({
  url: "../../info/videos_carta.json",

  type: "GET",

  dataType: "json",
}).done(function (data) {
  for (var i = 0; i < data.length; i++) {
    if (data[i].TITLE == $("#video_name").text()) {
      $("#video1").attr("src", "../../Imagenes/videos/" + data[i].VIDEONAME);

      if (data[i].CONTENT == "Sesiones") {
        $("#menu")
          .html("<i class='fa fa-reply-all'></i> Volver a Sesiones en diferido")
          .attr("href", "diferido.php");
      }
    }
  }
});
