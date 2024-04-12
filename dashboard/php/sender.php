<?php

include("../../assets/php/config.php");
require("registros/SMTP/class.phpmailer.php");
require("registros/SMTP/class.smtp.php");
date_default_timezone_set("Europe/Madrid");

if (isset($_POST['single']) and isset($_POST['ID'])) {
	enviar($_POST['ID'], $cnt);
} else if (!isset($_POST['single']) and !isset($_POST['ID'])) {
	$envios = json_decode($_POST["envios"]);
	for ($i = 0; $i < count($envios); $i++) {

		enviar($envios[$i], $cnt);
	}
}

if ($envio_copia == true) {
	enviar($id_copia, $cnt);
}

function enviar($valor, $cnt)
{
	session_start();

	$fila = [];
	$fila2 = [];
	$fila3 = [];
	$habitaciones = [];
	//********************************************fila USUARIO**************************************//
	$sql = 'SELECT * FROM form WHERE ID=:id';
	$resultado = $cnt->prepare($sql);
	$resultado->execute(array(":id" => $valor));
	$fila = $resultado->fetch(PDO::FETCH_ASSOC);
	if ($_POST['email'] == "") {
		$email = $fila['EMAIL'];
	} else {
		$email = $_POST['email'];
	}
	//********************************************fila fila2**************************************//
	$sql = 'SELECT * FROM acompa WHERE USER_ID=:id';
	$resultado = $cnt->prepare($sql);
	$resultado->execute(array(":id" => $valor));
	$fila2 = $resultado->fetch(PDO::FETCH_ASSOC);
	//********************************************fila DATOS DE FACTURACION**************************************//
	$sql = 'SELECT * FROM facturacion WHERE USER_ID=:id';
	$resultado = $cnt->prepare($sql);
	$resultado->execute(array(":id" => $valor));
	$fila3 = $resultado->fetch(PDO::FETCH_ASSOC);
	//********************************************fila DATOS DE PAGO**************************************//
	$sql4 = 'SELECT * FROM pendiete WHERE USER_ID=:id';
	$resultado4 = $cnt->prepare($sql4);
	$resultado4->execute(array(":id" => $valor));
	$fila6 = $resultado4->fetch(PDO::FETCH_ASSOC);
	//********************************************fila RESERVAS**************************************//
	$sql4 = 'SELECT * FROM reservas_hotel WHERE USER_ID=:id';
	$resultado4 = $cnt->prepare($sql4);
	$resultado4->execute(array(":id" => $valor));
	while ($fila10 = $resultado4->fetch(PDO::FETCH_ASSOC)) {
		$reserva[] = $fila10;
	}

	//********************************************fila fila3URA**************************************//
	$sql4 = 'SELECT * FROM profesionales WHERE USER_ID=:id';
	$resultado4 = $cnt->prepare($sql4);
	$resultado4->execute(array(":id" => $valor));
	$fila5 = $resultado4->fetch(PDO::FETCH_ASSOC);
	//********************************************fila EVENTO**************************************//
	$sql4 = 'SELECT * FROM evento';
	$resultado4 = $cnt->prepare($sql4);
	$resultado4->execute(array(":id" => $valor));
	$evento = $resultado4->fetch(PDO::FETCH_ASSOC);
	//********************************************fila EVENTO**************************************//
	if ($fila['LAN'] == "ES") {
		$tableName = "all_campos";
	} else {
		$tableName = "all_campos2";
	}
	$sql = "SELECT * FROM $tableName WHERE ESTADO=1";
	$respuesta = $cnt->prepare($sql);
	$respuesta->execute();
	while ($fila4 = $respuesta->fetch(PDO::FETCH_ASSOC)) {
		$campos_all[] = $fila4;
	}
	/******************************** SELECCION DE SESIONES A MOSTRAR *********************************************/
	$sql = "SELECT * FROM generales_form";
	$respuesta = $cnt->prepare($sql);
	$respuesta->execute();
	$sesiones = $respuesta->fetch(PDO::FETCH_ASSOC);
	/******************************** SELECCION DE SESIONES A MOSTRAR *********************************************/
	$sql = "SELECT * FROM habitaciones";
	$respuesta = $cnt->prepare($sql);
	$respuesta->execute();
	while ($hotel = $respuesta->fetch(PDO::FETCH_ASSOC)) {
		$habitaciones[] = $hotel;
	}


	$_SESSION['user_evento_id'] = [];
	$_SESSION['user_evento_id']['ID'] = $valor;
	foreach ($campos_all as $elemento) {
		if ($elemento['TIPO'] == "ACOMPA") :
			$_SESSION['user_evento_id']["A$elemento[CAMPO]"] = $fila2["$elemento[CAMPO]"];
		elseif ($elemento['TIPO'] == "FACT") :
			$_SESSION['user_evento_id']["F$elemento[CAMPO]"] = $fila3["$elemento[CAMPO]"];
		elseif ($elemento['TIPO'] == "PROF") :
			$_SESSION['user_evento_id']["P$elemento[CAMPO]"] = $fila5["$elemento[CAMPO]"];
		else :
			if ($elemento['CAMPO'] == "PASS") :
			elseif ($elemento['CAMPO'] == "HABITACION") :
				$ahabitacion = $fila["$elemento[CAMPO]"];
			else :
				$_SESSION['user_evento_id']["$elemento[CAMPO]"] = $fila["$elemento[CAMPO]"];
			endif;

		endif;
	}

	if ($sesiones['ESTADO_FACTURA'] == 1) {

		$_SESSION['user_evento_id']['FNAME'] = $fila3['F_NAME'];
		$_SESSION['user_evento_id']['FSURNAME'] = $fila3['F_SURNAME'];
		$_SESSION['user_evento_id']['FNIF'] = $fila3['F_NIF'];
		$_SESSION['user_evento_id']['FCIUDAD'] = $fila3['F_CIUDAD'];
		$_SESSION['user_evento_id']['FTELEFONO'] = $fila3['F_TELEFONO'];
		$_SESSION['user_evento_id']['FDIRECCION'] = $fila3['F_DIRECCION'];
		$_SESSION['user_evento_id']['FCODIGO_POSTAL'] = $fila3['F_CP'];
		$_SESSION['user_evento_id']['FEMAIL'] = $fila3['F_EMAIL'];
		$_SESSION['user_evento_id']['FPAIS'] = $fila3['PAIS'];
	}

	if ($fila6['CUOTA_ESTADO'] == "PENDIENTE" and $fila6['CUOTA_APOYO'] != 0 and $fila6['CUOTA'] == 0) {
		$cuota_m_pago = "(" . $fila6['CUOTA_PAGO'] . ")(PENDIENTE DE PAGO " . $fila6['CUOTA_APOYO'] . "€)";
		$cuota = $fila6['CUOTA_APOYO'];
	} else if ($fila6['CUOTA_ESTADO'] == "PENDIENTE") {
		$cuota_m_pago = "(" . $fila6['CUOTA_PAGO'] . ")(PENDIENTE DE PAGO " . $fila6['CUOTA_APOYO'] . "€)";
		$cuota = $fila6['CUOTA'];
	} else if ($fila6['CUOTA_ESTADO'] == "PAGADO"  and $fila6['CUOTA_PAGO'] != "FREE") {
		$cuota_m_pago = "(" . $fila6['CUOTA_PAGO'] . ")(PAGADO)";
		$cuota = $fila6['CUOTA'];
	} else if ($fila6['CUOTA_ESTADO'] == "DEVOLUCION") {
		$cuota_m_pago = "(" . $fila6['CUOTA_PAGO'] . ")(PENDIENTE DE DEVOLUCION " . $fila6['CUOTA_APOYO'] . "€)";
		$cuota = $fila6['CUOTA'];
	} else if ($fila6['CUOTA_ESTADO'] == "PAGADO"  and $fila6['CUOTA_PAGO'] == "FREE") {
		$cuota_m_pago = "(Sin Coste)";
		$cuota = $fila6['CUOTA'];
	}

	if ($fila6['ACOMPA_ESTADO'] == "PENDIENTE" and $fila6['ACOMPA_APOYO'] == 0) {
		$acompa_m_pago = "(" . $fila6['ACOMPA_PAGO'] . ")(PENDIENTE DE PAGO " . $fila6['ACOMPA_CUOTA'] . "€)";
		$acompa_cuota = $fila6['ACOMPA_CUOTA'];
	} else if ($fila6['ACOMPA_ESTADO'] == "PENDIENTE" and $fila6['ACOMPA_APOYO'] != 0) {
		$acompa_m_pago = "(" . $fila6['ACOMPA_PAGO'] . ")(PENDIENTE DE PAGO " . $fila6['ACOMPA_APOYO'] . "€)";
		$acompa_cuota = $fila6['ACOMPA_CUOTA'];
	} else if ($fila6['ACOMPA_ESTADO'] == "PAGADO"  and $fila6['ACOMPA_PAGO'] != "FREE") {
		$acompa_m_pago = "(" . $fila6['ACOMPA_PAGO'] . ")(PAGADO)";
		$acompa_cuota = $fila6['ACOMPA_CUOTA'];
	} else if ($fila6['ACOMPA_ESTADO'] == "DEVOLUCION") {
		$acompa_m_pago = "(" . $fila6['ACOMPA_PAGO'] . ")(PENDIENTE DE DEVOLUCION " . $fila6['ACOMPA_APOYO'] . "€)";
		$acompa_cuota = $fila6['ACOMPA_CUOTA'];
	} else if ($fila6['ACOMPA_ESTADO'] == "PAGADO"  and $fila6['ACOMPA_PAGO'] == "FREE") {
		$acompa_m_pago = "(Sin Coste)";
		$acompa_cuota = $fila6['ACOMPA_CUOTA'];
	}

	$acuota_hab = 0;
	$sender = true;
	$bloque_alojamiento_sender = '';
	foreach ($reserva as $elemento) {

		if ($elemento['HOTEL_ESTADO'] == "PENDIENTE" and $elemento['HOTEL_CUOTA'] == 0) {
			$acuota_hab = $acuota_hab + $elemento['HOTEL_APOYO'];
			$bloque_alojamiento_sender .= "<strong> Reserva | " . $elemento['ID'] . ": </strong>" . number_format($elemento['HOTEL_APOYO'], 2, ',', '.') . "€ (" . $elemento['HOTEL_PAGO'] . ")(PENDEINTE DE PAGO " . $elemento['HOTEL_APOYO'] . ")<br>";
			$_SESSION['user_evento_id']['HABITACION'] = $elemento['HABITACION'];
		} elseif ($elemento['HOTEL_ESTADO'] == "PENDIENTE" and $elemento['HOTEL_CUOTA'] != 0) {
			$acuota_hab = $acuota_hab + $elemento['HOTEL_APOYO'];
			$bloque_alojamiento_sender .= "<strong> Reserva | " . $elemento['ID'] . ": </strong>" . number_format($elemento['HOTEL_CUOTA'], 2, ',', '.') . "€ (" . $elemento['HOTEL_PAGO'] . ")(PENDEINTE DE PAGO " . $elemento['HOTEL_APOYO'] . ")<br>";
			$_SESSION['user_evento_id']['HABITACION'] = $elemento['HABITACION'];
		} else if ($elemento['HOTEL_ESTADO'] == "PAGADO" and $elemento['HOTEL_PAGO'] != "FREE") {
			$acuota_hab = $acuota_hab + $elemento['HOTEL_CUOTA'];
			$bloque_alojamiento_sender .= "<strong> Reserva | " . $elemento['ID'] . ": </strong>" . number_format($elemento['HOTEL_CUOTA'], 2, ',', '.') . "€ (" . $elemento['HOTEL_PAGO'] . ")(PAGADO)<br>";
			$_SESSION['user_evento_id']['HABITACION'] = $elemento['HABITACION'];
		} else if ($elemento['HOTEL_ESTADO'] == "PAGADO" and $elemento['HOTEL_PAGO'] == "FREE") {
			$acuota_hab = $acuota_hab + $elemento['HOTEL_CUOTA'];
			$bloque_alojamiento_sender .= "<strong> Reserva | " . $elemento['ID'] . ": </strong>" . number_format($elemento['HOTEL_CUOTA'], 2, ',', '.') . "€ (Sin Coste)<br>";
			$_SESSION['user_evento_id']['HABITACION'] = $elemento['HABITACION'];
		} else if ($elemento['HOTEL_ESTADO'] == "DEVOLUCION") {
			$acuota_hab = $acuota_hab + $elemento['HOTEL_CUOTA'];
			$bloque_alojamiento_sender .= "<strong> Reserva | " . $elemento['ID'] . ": </strong>" . number_format($elemento['HOTEL_CUOTA'], 2, ',', '.') . "€ (" . $elemento['HOTEL_PAGO'] . ")(PENDEINTE A DEVOLVER " . $elemento['HOTEL_APOYO'] . ")<br>";
			$_SESSION['user_evento_id']['HABITACION'] = $elemento['HABITACION'];
		}

		$_SESSION['user_evento_id']['HABITACION'] = $elemento['HABITACION'];
	}
	if ($acuota_hab == 0) {
		$hotel_m_pago = "(No Solicitado)";
	}
	$name = $fila['NAME'];
	$surname = $fila['SURNAME'];
	//*********************************************************Mail***************************************************************************//

	if ($_POST['error'] == 'error') {
		$envio = false;
		$error = true;
		$send_copia = true;
	} else {
		$envio = true;
		$send_copia = false;
	}
	$code = $_POST['code'];
	$_SESSION['user_evento_id']['CATEGORIA'] = $fila['CATEGORIA'];
	if ($fila['LAN'] == 'ES') {
		if ($fila['IMPORT'] == 1) : $password = 'sepsis1234';
		else : $password = 'Debe introducir la contraseña creada en la inscripción.';
		endif;
		$texto = "Ha recibido este email porque su cuenta ha sido activada quedando validado su registro en la reunión <strong>" . $evento['NAME'] . "</strong><br><br> Siéntese libre de acceder al área privada de la plataforma de la reunión <a href='https://fcsepsismeetings.com/'>(https://fcsepsismeetings.com/)</a> iniciando sesión con <br><br>
			 Usuario: " . $fila['EMAIL'] . "<br>
			 Contraseña:  " . $password . "<br><br>";
		include('registros/mail.php');
	} else {
		if ($fila['IMPORT'] == 1) : $password = 'sepsis1234';
		else : $password = 'You must use the password created when registering.';
		endif;
		$texto = "You have received this email because your account has been activated validating your registration to the <strong>" . $evento['NAME'] . "</strong><br><br> Feel free to access the private area of the meeting platform <a href='https://fcsepsismeetings.com/'>(https://fcsepsismeetings.com/)</a> by entering your <br><br>
			Username: " . $fila['EMAIL'] . "<br>
			Password: " . $password . "<br><br>";
		include('registros/mail-en.php');
	}

	echo 'ok';
}
