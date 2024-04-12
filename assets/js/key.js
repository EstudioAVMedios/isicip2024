
$(document).ready(function(){
	
setInterval(key,80000);

function key(){


	 $.ajax({

                url: "../php/key.php",

                /*target: "#result",*/

                clearForm: true,

                data:"",

                contentType: false,

                processData: false,

                type: "POST",

                success: function (res) {

                   if ($.trim(res) == "out") {

window.location.href='../index.php?key=true';
                    }


                }

            })

}
	
	
	
	
})
