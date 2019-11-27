<?php

require_once '../clases/Correo.php';
require_once '../clases/Validaciones.php';

$correo = new Correo();
$validaciones = new Validaciones();

//6Lf7WsQUAAAAALVQFOHGLzIecVOnOc7vSASkeFwQ local
//6LcJW8QUAAAAAHZwrH69SW0bmGN2LotC37S2ZHaU producción
$recaptcha_secret = '6LcJW8QUAAAAAHZwrH69SW0bmGN2LotC37S2ZHaU'; 
$recaptcha_response = $_POST['recaptcha_response']; 

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify?");
curl_setopt($ch, CURLOPT_POST, 1);
$campos=array('secret'=>$recaptcha_secret,'response'=>$recaptcha_response);
curl_setopt($ch, CURLOPT_POSTFIELDS,$campos);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$ch_exec = curl_exec($ch);
$respuesta_google = json_decode($ch_exec);
curl_close ($ch);

if($respuesta_google->score > 0.5){

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