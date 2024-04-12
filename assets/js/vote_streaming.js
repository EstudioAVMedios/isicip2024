// JavaScript Document



/*********************************************Asiganando Votaciones*******************************************************/	



$.ajax({

	url:"../../info/poll.json",

	type:"GET",

	dataType:"json"	

}).done(function(data){	

var encontrar2;

var count_poll=[];

var marca=0;

for(var i=0;i<data.length;i++){



	encontrar2= count_poll.includes(data[i].POLL);

if(encontrar2){

	continue;

}	

	

if(data[i].VIDEO=="Streaming"){

	

	$('#poll_area').append("<div class='card w-100 h-100 '' id='pregunta"+ i +"' style='position: absolute;z-index: 10001; display:none'><div class='poll' hidden>"+ data[i].POLL +"</div><div class='time' hidden>"+ data[i].TIME +"</div><div class='card-header'><i class='far fa-check-square'></i> Cuestionario</div><div class='card-body'><div class='container p-4'><div class='alert alert-warning alert-dismissible d-none' role='alert' id='alert3'><strong><i class='fas fa-exclamation-triangle'></i> Lo sentimos!</strong> su respuesta no ha podido ser procesada, Intentelo nuevamente.<button type='button' class='btn-close' id='close3'  aria-label='Close'></button></div><blockquote class='blockquote mb-0'><form><p class='h3'>"+ data[i].POLL +"</p><hr><div class='py-1' id='respuesta"+ i +"'></div><button type='button' class='btn btn-outline-secondary m-4 btn-lg me-auto saltar'>Saltar</button><button type='button' class='btn btn-secondary m-4 btn-lg me-auto enviar'>Enviar</button></form></blockquote></div></div></div>");



	marca ="-"+10;

	for(var g=0;g<data.length;g++){

		if(data[i].POLL==data[g].POLL){

		$("#respuesta"+ i +"").append("<div class='form-check form-switch py-1'><input class='form-check-input' type='"+ data[g].TYPE +"' name='respuesta[]' id='answer"+ g +"' value='"+ data[g].ANSWER +"'><label class='form-check-label' for='answer"+ g +"'>"+ data[g].ANSWER +"</label></div>");	

		}		

	}

	count_poll.push(data[i].POLL);

}

}

//*************************************************************ENVIAR VOTOS*****************************************************************//

	

var alerta=false;

var alerta1=false;

var id_pregunta;

$(".enviar").click(function(){



id_pregunta="#"+$(this).closest('.card').attr("id");

	

		if($(this).closest('form').serialize()==""){

			if(alerta1==false){

			$(this).closest("form").append("<div class='alert alert-warning alert-dismissible' role='alert' id='alert5'><strong><i class='fas fa-exclamation-triangle'></i> Respuesta obligatoria!</strong> Si desea enviar su respuesta en blacno debe presionar el boton de saltar, de lo contrario debe seleccionar una de las opciones<button type='button' class='btn-close' id='close5'  aria-label='Close'></button></div>");

			alerta1=true;

				

	$("#close5").click(function(){

		

		$("#alert5").remove();

		alerta1=false;

	})

	

				}

		}else{

				var datos ="poll="+ $(this).prevAll('p').text()+"&" + $(this).closest('form').serialize()+"&video=Streaming&id=" + $("#user button span").text();



			$.ajax({

			

				url:"../../connect/vote.php",

				type:"POST",

				data: datos,

				success:function(res){



					if(res=="success"){

					console.log(res);	

var id=id_pregunta + " input";

var id2=id_pregunta + " button";

var id3= id_pregunta + " form";

$(id3).append("<div class='alert alert-success mb-5' role='alert' id='alert'><p class='h5'><strong><i class='fas fa-exclamation-triangle'></i> Muchas gracias!</strong> Hemos registrado su voto de forma satisfactoria. Espere a que esta pregunta sea retirada por el moderador.</p></div>");

$(id).attr('disabled',true);

$(id2).attr('disabled',true);

				

						

				}else{



				$("#alert3").fadeIn();



				}

				}	

			

				})

			}})





		

	$(".saltar").click(function(){



id_pregunta="#"+$(this).closest('.card').attr("id");

		

				var datos ="poll="+ $(this).prevAll('p').text()+"&respuesta[]=Salto&video=Streaming&id="+$("#user button span").text();



			$.ajax({

			

				url:"../../connect/vote.php",

				type:"POST",

				data: datos,

				success:function(res){

					if(res=="success"){

var id=id_pregunta + " input";

var id2=id_pregunta + " button";

var id3= id_pregunta + " form";

$(id3).append("<div class='alert alert-success mb-5' role='alert' id='alert'><p class='h5'><strong><i class='fas fa-exclamation-triangle'></i> Muchas gracias!</strong> Hemos registrado su voto de forma satisfactoria. Espere a que esta pregunta sea retirada por el moderador.</p></div>");

$(id).attr('disabled',true);

$(id2).attr('disabled',true);	

						

				}else{

					$("#alert3").fadeIn();

				}	

			

				}

			})

		});

	



	

setInterval(function(){

	

$.ajax({

	url:"../../info/poll.json",

	type:"GET",

	dataType:"json",

	cache: false,

	contentType: false,

    processData: false

}).done(function(data){

	

	for(var i=0; i<data.length;i++){

	

	$('.poll').each(function(){

if($(this).text()==data[i].POLL){

 $(this).closest('.card').css({display:data[i].DISPLAY});

}

})



}

})



},5000);

$("#close3").click(function(){

$("#alert3").fadeOut();

})





//fin de la function para votos

});



