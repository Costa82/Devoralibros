<?php

require_once '../clases/Correo.php';
require_once '../clases/Validaciones.php';

$correo = new Correo();
$validaciones = new Validaciones();

$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify'; 
$recaptcha_secret = '6LcJW8QUAAAAAHZwrH69SW0bmGN2LotC37S2ZHaU'; 
$recaptcha_response = $_POST['recaptcha_response']; 
$recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response); 
$recaptcha = json_decode($recaptcha); 

if($recaptcha->score >= 0){

	if(isset($_REQUEST['nombre']) AND isset($_REQUEST['mail'])){
		 
		// Campos obligatorios
		$nombre = $_REQUEST['nombre'];
		$mail = $_REQUEST['mail'];
		$telefonoValido = true;
		 
		// Campos opcionales
		if ( isset($_REQUEST['telefono']) ) {
			 
			$telefono = $_REQUEST['telefono'];
			 
			if ($telefono != "" && $telefono != null) {
				 
				if (!$validaciones->validarTelefono($telefono)) {
					$telefonoValido = false;
				}
			} else {
				$telefono = null;
			}
			 
		} else {
			$telefono = null;
		}
		 
		if ( isset($_REQUEST['consulta']) ) {
			$consulta = $_REQUEST['consulta'];
		} else {
			$consulta = null;
		}
		 
		if (isset($_POST['whatsapp']) && $_POST['whatsapp'] == '1') {
			$whatsapp = "OK";
		} else {
			$whatsapp = "KO";
		}
		 
		// Enviamos el correo de reserva
		// Comprobamos que no sea ninguno de estos correos (info@basededatos-info.com, yourmail@gmail.com)
		if ( $mail === "info@basededatos-info.com" || $mail === "yourmail@gmail.com" || $mail === "artyea@msn.com" || !$telefonoValido ) {
			$envio = "KO";
		} else {
			$envio = $correo->enviarMailsConsulta($mail, $nombre, $telefono, $consulta, $whatsapp);
		}
		 
		// Comprobamos cómo ha ido el envío
		if ( $envio == "OK" ) {
			$destino="../envio-correcto/";
		} else {
			$destino="../envio-fallido/";
		}
		 
		// El nombre y el mail tienen que ser obligatorios
	} else {
		$destino="../envio-fallido/";
	}

	// El recaptcha ha ido mal
} else {
	$destino="../envio-fallido/";
}

if (!headers_sent()) {
	header('Location:'.$destino);
	exit;
}

?>