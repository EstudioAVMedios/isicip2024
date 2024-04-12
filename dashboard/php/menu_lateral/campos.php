<?php
include( '../../../assets/php/config.php' );
if ( $_POST[ 'campos' ] ) {
    $campos = json_decode( $_POST[ 'campos' ] );

    $sql = "SELECT * FROM all_campos";
    $resultado = $cnt->prepare( $sql );
    $resultado->execute();
    while ( $fila = $resultado->fetch( PDO::FETCH_ASSOC ) ) {
        $all_campos[] = $fila;
    }
    foreach ( $all_campos as $elemento ) {
		$count=0;
        for ( $i = 0; $i < count( $campos ); $i++ ) {
			
            if ( $elemento[ 'ID' ] == $campos[ $i ] ) {
				$count++;
                if ( $campos[ $i + 1 ] == "si" ) {
                    $requerido = "required";
                } else {
                    $requerido = "";
                }

                $sql = "UPDATE `all_campos` SET `ESTADO`=:estado, `PRIORIDAD`=:required WHERE ID=:id";
                $resultado = $cnt->prepare( $sql );
                $resultado->execute( array( ":estado" => 1, ":required" => $requerido, ":id" => $campos[ $i ] ) );
               
            }

            $i = $i + 1;

        }
		if($count==0){			
                $sql = "UPDATE `all_campos` SET `ESTADO`=:estado, `PRIORIDAD`=:required WHERE ID=:id";
                $resultado = $cnt->prepare( $sql );
                $resultado->execute( array( ":estado" => 0, ":required" =>"", ":id" => $elemento['ID'] ) );
		}
    }
}
echo "ok";
?>