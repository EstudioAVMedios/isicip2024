<?php
include( "../../../assets/php/config.php" );

if($_POST['edit']){
	
$id=$_POST['id'];
$sql="SELECT * FROM all_campos WHERE ID=:id";	
$resultado=$cnt->prepare($sql);
$resultado->execute(array(":id"=>$id));
$fila=$resultado->fetch(PDO::FETCH_ASSOC);

echo json_encode($fila);

}else{
    
$name=strtoupper($_POST['campo_name']);
$tipo=$_POST['campo_tipo'];
$placeholder=$_POST['campo_placeholder'];
$campo=$_POST['campo_existen'];

if($campo!=0){
	
$sql="UPDATE `all_campos` SET 
`TIPO`=:TIPO,
`PLACEHOLDER`=:PLACEHOLDER
WHERE ID=:id";	
$resultado=$cnt->prepare($sql);
$resultado->execute(array(
":TIPO"=>$tipo,
":PLACEHOLDER"=>$placeholder,
":id"=>$campo
));

}else{
	
    $sql="INSERT INTO `all_campos`(
    `CAMPO`,
    `ESTADO`,
    `TIPO`,
    `PLACEHOLDER`,
    `PRIORIDAD`) VALUES (
    :CAMPO,
    :ESTADO,
    :TIPO,
    :PLACEHOLDER,
    :PRIORIDAD
    )";	
    $resultado=$cnt->prepare($sql);
    $resultado->execute(array(
    ":CAMPO"=>$name,
    ":ESTADO"=>0,
    ":TIPO"=>$tipo,
    ":PLACEHOLDER"=>ucwords($placeholder),
    ":PRIORIDAD"=>""
    ));
    if($tipo=="USUARIO" or $tipo=="INTERNO"){
    $sql="ALTER TABLE form ADD COLUMN $name varchar(900) NULL";	
    $resultado=$cnt->prepare($sql);
    $resultado->execute();	
    }elseif($tipo=="PROF"){
    $sql="ALTER TABLE profesionales ADD COLUMN $name varchar(900) NULL";	
    $resultado=$cnt->prepare($sql);
    $resultado->execute();	
    }elseif($tipo=="ACOMPA"){
    $sql="ALTER TABLE ACOMPA ADD COLUMN $name varchar(900) NULL";	
    $resultado=$cnt->prepare($sql);
    $resultado->execute();	
    }elseif($tipo=="FACT"){
    $sql="ALTER TABLE facturacion ADD COLUMN $name varchar(900) NULL";	
    $resultado=$cnt->prepare($sql);
    $resultado->execute();	
    }
    
            
    }
echo "ok";		
}

?>