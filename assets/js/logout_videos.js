// JavaScript Document
var ip; 
var pais;
var ciudad;

//*********************************proxy id*********************************************************//



function callback(e){
	 ip= e['IPv4'];
	 pais= e['country_name'];
	ciudad= e['state'];
	}
	$.ajax({
		url:"https://geoip-db.com/jsonp/",
		dataType:"jsonp"
	})



//*********************************selseccion de url**************************************************//



if($(".active").text()==" Ponencias a la carta"){
	$("#logout").click(function(){

	var datos="&ip=" + ip + "&state=" + ciudad  + "&country=" + pais; 
	$.ajax({
		url:"../../connect/log_close.php",
		type:"POST",
		data: datos,
		success:function(e){

			if(e=="success"){
		
				window.location.href="../../index.php";
			}else{
				alert(e);
			}
		}
	})
})
	
}else{
	
	$("#logout").click(function(){

	var datos="&ip=" + ip + "&state=" + ciudad  + "&country=" + pais; 
	$.ajax({
		url:"../../connect/log_close.php",
		type:"POST",
		data: datos,
		success:function(e){

			if(e=="success"){
		
				window.location.href="../../index.php";
			}
		}
	})
})
}



//*********************************cierre sesion*******************************************************//





	
	
	


