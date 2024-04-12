// JavaScript Document

connect_chat();

setInterval(function(){
	connect_chat();
},10000)

function connect_chat(){
		
	$.ajax({
	url:"connect_admin.php",
	type:"POST",
	data:"",
		
}).done(function(data){	

		if(data!="empty"){
	$("#nadie").remove();
	var json=JSON.parse(data);
	var length2=Object.keys(json).length;
			
		$(".pregunta").remove();
			
for(var i=0; i< length2 ; i++){
	
	$("#chat").prepend("<div class='shadow d-flex rounded text-start align-content-around bg-body m-3 pregunta' style='width: 90%; flex-direction: row'><div class='bg-secondary p-2 rounded text-white d-flex m-2 justify-content-center' style='width: 40px;height: 40px; '>"+ String(json[i].NAME).substr(0,1)  + "</div><div class='d-inline-block m-2' style='width: 80%; font-size: 14px'><p><strong>"+ json[i].NAME +"</strong><br><span>" + json[i].QUESTION + "</span></p> </div></div>")

}
}
		
});
$("textarea").val("");
}


setInterval(function(){
	$.ajax({
			url:"vistas.json",
			type:"POST",
			dataType:"json"	
		
}).done(function(data){
	$("#espectadores").text(data.visitas);
});
},5000);

//----------------------------------------------------------------votaciones----------------------------------------------------------/
$.ajax({
	url:"../../info/poll.json",
	type:"POST",
	dataType:"json"	
	
}).done(function(data){	
var encontrar2;
var count_poll=[];
for(var i=0;i<data.length;i++){
	
	if(data[i].VIDEO==="Streaming"){

	encontrar2= count_poll.includes(data[i].POLL);
if(encontrar2){
	continue;
}	
$("#poll_area").append("<div class='card h-100 m-4 w-75' style='width: 18rem;vertical-align:top'><div class='card-body'><p class='btn estado text-white' style='background:var(--bg-color)' hidden>Visto</p><h5 class='card-title pb-3 border-bottom'>"+ data[i].POLL +"</h5><h6 class='card-subtitle mb-2 text-muted'>Pregunta para streaming</h6><a class='card-link btn btn-secondary my-3 ocultar'><i class='fas fa-eye-slash'></i> Ocultar</a><a class='card-link btn mostrar' style='background:var(--bg-color);color:white'>Mostrar <i class='far fa-eye'></i></a></div></div>");
count_poll.push(data[i].POLL);
		
	}	
}
$('.mostrar').on('click', function(){
	$.ajax({
		url:"poll_live.php",
		type:'POST',
		data:"poll="+$(this).prevAll('.card-title').text()+"&display=block",
		success:function(data){

		}
	})

$(this).closest('.card').addClass('shadow');
$(this).closest('.card').addClass('selected');
})
$('.ocultar').on('click', function(){
$.ajax({
		url:"poll_live.php",
		type:'POST',
		data:"poll="+$(this).prevAll('.card-title').text()+"&display=none",
		success:function(data){

		}
	})

$(this).prevAll('.estado').removeAttr('hidden');
$(this).closest('.card').removeClass('shadow').removeClass('selected');	
})
})

