<?php


if ( $_POST ) {


    include( "../../assets/php/config.php" );


    $id = $_POST[ 'id' ];

    if ( $_POST[ 'edit' ] == "no" ) {


        $sql3 = 'SELECT * FROM facturacion WHERE USER_ID=:id';
        $resultado3 = $cnt->prepare( $sql3 );
        $resultado3->execute( array( ":id" => $id ) );
        $fila3 = $resultado3->fetch( PDO::FETCH_ASSOC );

        $datos = json_encode( $fila3 );

        echo $datos;


    } else if($_POST[ 'edit' ] == "Si") {


        $sql = 'SELECT * FROM form WHERE ID=:id';
        $resultado = $cnt->prepare( $sql );
        $resultado->execute( array( ":id" => $id ) );
        $fila = $resultado->fetch( PDO::FETCH_ASSOC );
		
		$sql = 'SELECT * FROM pendiete WHERE USER_ID=:id';
        $resultado = $cnt->prepare( $sql );
        $resultado->execute( array( ":id" => $id ) );
        $fila1 = $resultado->fetch( PDO::FETCH_ASSOC );
		
		$sql = 'SELECT * FROM profesionales WHERE USER_ID=:id';
        $resultado = $cnt->prepare( $sql );
        $resultado->execute( array( ":id" => $id ) );
        $fila2 = $resultado->fetch( PDO::FETCH_ASSOC );	
		
		$fila3['PESPECIALIDAD']=$fila2['ESPECIALIDAD'];
		$fila3['PHOSPITAL']=$fila2['HOSPITAL'];
		$fila3['PPAIS']=$fila2['PAIS'];
		$fila3['PCIUDAD']=$fila2['CIUDAD'];
		$fila3['PCODIGO_POSTAL']=$fila2['CODIGO_POSTAL'];
		$fila3['PTIPO_CENTRO']=$fila2['TIPO_CENTRO'];
		$fila3['PDIRECCION']=$fila2['DIRECCION'];
		

        $datos = array_merge( $fila, $fila1);
		$datos = array_merge( $datos, $fila3);

        if ( $fila[ 'IMPORT' ] == 0 ) {

            $sql3 = 'SELECT * FROM facturacion WHERE USER_ID=:id';
            $resultado3 = $cnt->prepare( $sql3 );
            $resultado3->execute( array( ":id" => $id ) );
            $fila4 = $resultado3->fetch( PDO::FETCH_ASSOC );
            $datos2['FNAME'] = $fila4['F_NAME'];
			$datos2['FSURNAME'] = $fila4['F_SURNAME'];
			$datos2['FEMAIL'] = $fila4['F_EMAIL'];
			$datos2['FNIF'] = $fila4['F_NIF'];
			$datos2['FCIUDAD'] = $fila4['F_CIUDAD'];
			$datos2['FTELEFONO'] = $fila4['F_TELEFONO'];
			$datos2['FDIRECCION'] = $fila4['F_DIRECCION'];
			$datos2['FCP'] = $fila4['F_CP'];
			$datos2['FPAIS'] = $fila4['PAIS'];
			
            $datos3 = array_merge( $datos, $datos2 );
            $datos4 = json_encode( $datos3 );

            echo $datos4;

        } else {
            $datos4 = json_encode( $datos );
			            echo $datos4;
        }
    }else if($_POST[ 'edit' ] == "acompa") {


        $sql = 'SELECT * FROM acompa WHERE USER_ID=:id';
        $resultado = $cnt->prepare( $sql );
        $resultado->execute( array( ":id" => $id ) );
        $fila = $resultado->fetch( PDO::FETCH_ASSOC );
			
		$sql = 'SELECT * FROM pendiete WHERE USER_ID=:id';
        $resultado = $cnt->prepare( $sql );
        $resultado->execute( array( ":id" => $id ) );
        $fila1 = $resultado->fetch( PDO::FETCH_ASSOC );
		
        $datos = array_merge( $fila, $fila1);	 
		echo json_encode( $datos );
       
    }
} else {
    echo "no";
}


?>