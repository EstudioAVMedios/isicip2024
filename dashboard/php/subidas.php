<?php
include( "../../assets/php/config.php" );
$id = $_POST[ 'id' ];

if ( $_FILES[ 'datafact' ][ 'name' ]!="" ) {

    $fileTmpPath = $_FILES[ 'datafact' ][ 'tmp_name' ];
    $fileName = $_FILES[ 'datafact' ][ 'name' ];
    $fileSize = $_FILES[ 'datafact' ][ 'size' ];
    $fileType = $_FILES[ 'datafact' ][ 'type' ];

    clearstatcache();
    if ( is_dir( '../../assets/archivos/descargas/' . $id ) ) {
        move_uploaded_file( $fileTmpPath, '../../assets/archivos/descargas/' . $id . "/" . $fileName );

    } else {
        mkdir( "../../assets/archivos/descargas/" . $id, 0777 );
        move_uploaded_file( $fileTmpPath, '../../assets/archivos/descargas/' . $id . "/" . $fileName );

    }
    echo "ok";
} else if($_POST['delete']){
	unlink('../../assets/archivos/descargas/' . $id."/".$_POST['filename']);
	echo "ok";
}else{
$nombres=[];
    $dir = opendir( '../../assets/archivos/descargas/' . $id );
 while ($elemento = readdir($dir)){

	 $nombres[]=$elemento;	 
 }
	
	 echo json_encode($nombres);
}

?>