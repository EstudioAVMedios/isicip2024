<?php

include("../../assets/php/config.php");
session_start();
$id=$_SESSION[ 'user_evento_id' ]['ID'];
$pedido=$_SESSION['PEDIDO'];
$sql="SELECT * FROM reservas_hotel WHERE USER_ID=:id";
$respuesta=$cnt->prepare($sql);
$respuesta->execute(array(":id"=>$id));
while($fila=$respuesta->fetch(PDO::FETCH_ASSOC)){
$reservas[]=$fila;
}

$sql="SELECT * FROM pendiete WHERE USER_ID=:id";
$respuesta=$cnt->prepare($sql);
$respuesta->execute(array(":id"=>$id));
while($fila=$respuesta->fetch(PDO::FETCH_ASSOC)){
$cuotas[]=$fila;
}

foreach($cuotas as $elemento){
if($elemento["CUOTA_APOYO"]!=0.00 and $elemento['CUOTA']==0.00 and $elemento['CUOTA_ESTADO']=="PENDIENTE"){
$sql="UPDATE `pendiete` SET `CUOTA_APOYO`=:apoyo,`CUOTA_PAGO`=:pago, `CUOTA_ESTADO`=:estado, `CUOTA`=:cuota WHERE ID=:id";
$respuesta=$cnt->prepare($sql);
$respuesta->execute(array(":apoyo"=>0,":pago"=>"TPV", ":estado"=>"PAGADO", ":cuota"=>$elemento['CUOTA_APOYO'],":id"=>$elemento['ID']));
}else if($elemento['CUOTA_ESTADO']=="PENDIENTE"){
    $sql="UPDATE pendiete SET 'CUOTA_APOYO'=:apoyo,`CUOTA_PAGO`=:pago,'CUOTA_ESTADO'=:estado  WHERE ID=:id";
    $respuesta=$cnt->prepare($sql);
    $respuesta->execute(array(":apoyo"=>0,":pago"=>"TPV", ":cuota"=>"PAGADO", ":id"=>$elemento['ID']));    
}
}

foreach($cuotas as $elemento){
    if($elemento["ACOMPA_APOYO"]!=0.00 and $elemento['ACOMPA_CUOTA']==0.00 and $elemento['ACOMPA_ESTADO']=="PENDIENTE"){
    $sql="UPDATE `pendiete` SET `ACOMPA_APOYO`=:apoyo,`ACOMPA_PAGO`=:pago,`ACOMPA_ESTADO`=:estado, `ACOMPA_CUOTA`=:cuota WHERE ID=:id";
    $respuesta=$cnt->prepare($sql);
    $respuesta->execute(array(":apoyo"=>0,":pago"=>"TPV", ":estado"=>"PAGADO", ":cuota"=>$elemento['ACOMPA_APOYO'],":id"=>$elemento['ID']));
}else if($elemento['ACOMPA_ESTADO']=="PENDIENTE"){
        $sql="UPDATE pendiete SET 'ACOMPA_APOYO'=:apoyo,`ACOMPA_PAGO`=:pago,'ACOMPA_ESTADO'=:estado  WHERE ID=:id";
        $respuesta=$cnt->prepare($sql);
        $respuesta->execute(array(":apoyo"=>0,":pago"=>"TPV", ":cuota"=>"PAGADO", ":id"=>$elemento['ID']));    
    }
}

foreach($reservas as $elemento){

        if($elemento["HOTEL_APOYO"]!=0.00 and $elemento['HOTEL_CUOTA']==0.00 and $elemento['HOTEL_ESTADO']=="PENDIENTE"){
        $sql="UPDATE `reservas_hotel ` SET `HOTEL_APOYO`=:apoyo,`HOTEL_ESTADO`=:estado, `HOTEL_CUOTA`=:cuota WHERE ID=:id";
        $respuesta=$cnt->prepare($sql);
        $respuesta->execute(array(":apoyo"=>0, ":estado"=>"PAGADO", ":cuota"=>$elemento['HOTEL_APOYO'],":id"=>$elemento['ID']));

}else if($elemento['HOTEL_ESTADO']=="PENDIENTE"){

        $sql="UPDATE reservas_hotel SET 'HOTEL_APOYO'=:apoyo,'HOTEL_ESTADO'=:estado  WHERE ID=:id";
        $respuesta=$cnt->prepare($sql);
        $respuesta->execute(array(":apoyo"=>0, ":cuota"=>"PAGADO", ":id"=>$elemento['ID']));    
}
}
$sql="UPDATE pedidos SET ESTADO=:estado WHERE PEDIDO=:pedido";
$resultado=$cnt->prepare($sql);
$resultado->execute(array(":estado"=>1, ":pedido"=>$pedido));

        $sql = "SELECT * FROM pendiete WHERE USER_ID=:id";
        $respuesta = $cnt->prepare( $sql );
        $respuesta->execute( array( ":id" => $id ) );
        $fila = $respuesta->fetch( PDO::FETCH_ASSOC );
    
        if ( $fila[ 'CUOTA_ESTADO' ] == "PAGADO"
            and $fila[ 'ACOMPA_ESTADO' ] == "PAGADO" ) {
            $estado_cuotas = 1;
        } else if ( $fila[ 'CUOTA_ESTADO' ] == "PAGADO"
            and $fila[ 'ACOMPA_ESTADO' ] == "" ) {
            $estado_cuotas = 1;
        } else {
            $estado_cuotas = 0;
        }
        $count = 0;
        $sql = "SELECT * FROM reservas_hotel WHERE USER_ID=:id";
        $respuesta = $cnt->prepare( $sql );
        $respuesta->execute( array( ":id" => $id ) );
        while ( $fila = $respuesta->fetch( PDO::FETCH_ASSOC ) ) {
            if ( $fila[ 'HOTEL_ESTADO' ] == "PENDIENTE" ) {
                $estado_reserva = 0;
                $count++;
            } else if ( $fila[ 'HOTEL_ESTADO' ] == "DEVOLUCION" ) {
                $estado_reserva = 0;
                $count++;
            } else if ( $fila[ 'HOTEL_ESTADO' ] == "PAGADO" ) {
                $estado_reserva = 1;
            }
        }
    
        if ( $estado_cuotas == 1 and $count == 0 ) {
            $estado = 1;
        } else {
            $estado = 0;
        }
        /********************FOMULARIO ASISTENTES************************/
     
        $sql = "UPDATE `form` SET `ESTADO`=:estado   WHERE ID=:id";
        $respuesta = $cnt->prepare( $sql );
        $respuesta->execute( array( ":estado" => $estado, ":id" => $id ) );
$envio_copia=true;
$id_copia=$id;
include("../php/sender.php"); 
$_SESSION[ 'user_evento_id' ]['ID']=$id_copia;
header("location:../../../../personal/index.php");
?>