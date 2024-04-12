<?php 

include("../../../assets/php/config.php");

$id=$_POST['id'];


$sql="SELECT * FROM form WHERE ID=:id";
$resultado=$cnt->prepare($sql);
$resultado->execute(array(":id"=>$id));
$fila=$resultado->fetch(PDO::FETCH_ASSOC);

if($fila['ESTADOQR']==0){
	$estado=1;
}else{
	$estado=0;
}

$sql1="UPDATE `form` SET `ESTADOQR`= :estado WHERE ID=:id";
$resultado1=$cnt->prepare($sql1);
$resultado1->execute(array(":estado"=>$estado,":id"=>$id));
$fila1=$resultado1->fetch(PDO::FETCH_ASSOC);


echo "ok";

// $mensaje="<!doctype html>
// <html>
// <head>
// <meta charset='utf-8'>
// <title>BANCO CAMINOS</title>
// </head>

// <body>
// <div style='margin: auto;text-align: center;width: 100%'>
//   <table style='margin: auto;background: white;text-align: left;width:650px;' cellpadding='0' cellspacing='0'>
//     <tbody>
//       <tr><td colspan='3'><p style='text-align:center;font-size:14px;'>“Activa el visualizado de imágenes en la parte superior de este correo para ver tu invitación correctamente”</p><br><br><br></td></tr>
//       <tr>
      
//         <td colspan='3'><img src='https://scanner.avstreaming.es/assets/Imagenes/header.png'></td>
//       </tr>
//       <tr>
//         <td style='width:30px'></td>
//         <td style='width: 590px;'><img src='https://scanner.avstreaming.es/assets/Imagenes/NOMBRES/{ip}.png' width='400'>
//           <p style='font-size: 17px;font-family: Arial'> Aquí tienes tu entrada para el kick off que celebraremos el jueves, 9 de marzo a las 16.00 h., en el Teatro Goya (C. de Sepúlveda, 3-5, 28011 Madrid).
// 			<br>
//             <br>
//             Deberás presentar el código QR que ves más abajo en la entrada para poder acceder al espacio. También encontrarás la fila y butaca que tienes reservada para ti.
// 			<br>
//             <br>
//             ¡Tenemos muchas ganas de verte y pasar un buen momento juntos!
// 			<br>
//             <br>
//             <strong style='font-size: 23px'><span style='color:#E0B022'>#Ready</span><span style='color:#009AA9'>Steady</span><span style='color:#B6B09C'>GO!</span></strong> </p>
//           <br>
//           <br></td>
//         <td style='width:30px'></td>
//       </tr>
//       <tr>
//         <td colspan='3' style='height: 40px;'></td>
//       </tr>
//       <tr>
//         <td colspan='3'><table style='background: #00263A;font-family: Arial' cellpadding='0' cellspacing='0'>
//             <tbody>
//               <tr style='background: #00263A;height: 243px;'>
//                 <td style='width: 30px'></td>
//                 <td style='195px'><img src='https://scanner.avstreaming.es/assets/QRS/QR/{ip}.png' width='185'></td>
//                 <td style='width: 30px'></td>
//                 <td style='width: 315px'><p style='color: white;vertical-align: text-top;padding-left: 20px;margin: 0px;font-size: 17px;'>
// 					<strong style='font-size: 18px'> FILA: {name}         |         Asiento: {surname}</strong>
// 					<br>
//                     <br>
//                     <br>
//                     <br>
//                     <strong>CONTACTOS</strong><br>
//                     <br>
//                     Email: cagenjo@bancocaminos.es<br>
//                     Telf: +(34) 618 05 14 62<br>
//                   </p></td>
//                 <td style='width: 155px;'></td>
//               </tr>
//             </tbody>
//           </table></td>
//       </tr>
//     </tbody>
//   </table>
// </div>
// </body>
// </html>";


?>