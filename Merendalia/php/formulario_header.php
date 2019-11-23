<?php

require_once '../clases/Correo.php';
require_once '../clases/Validaciones.php';
require_once "../php/recaptchalib.php";

$correo = new Correo();
$validaciones = new Validaciones();
$strMensaje="";

$secret = "6LcmPMQUAAAAALeqSP40VP-Oawijs__NDXoi8r6n";
$response = null;

// comprueba la clave secreta
$reCaptcha = new ReCaptcha($secret);

if ($_POST["g-recaptcha-response"]) {
	$response = $reCaptcha->verifyResponse(
	$_SERVER["REMOTE_ADDR"],
	$_POST["g-recaptcha-response"]
	);
}

if ($response != null) {
    
    if(isset($_REQUEST['nombre']) AND isset($_REQUEST['mail']) AND isset($_REQUEST['dia']) AND isset($_REQUEST['hora_entrada']) AND isset($_REQUEST['hora_salida'])) {
        
        // Campos obligatorios
        $nombre = $_REQUEST['nombre'];
        $mail = $_REQUEST['mail'];
        $dia = $_REQUEST['dia'];
        $hora_entrada = $_REQUEST['hora_entrada'];
        $hora_salida = $_REQUEST['hora_salida'];
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
        
        if ( isset($_REQUEST['comentario']) ) {
            $comentario = $_REQUEST['comentario'];
        } else {
            $comentario = null;
        }
        
        if (isset($_POST['whatsapp']) && $_POST['whatsapp'] == '1')
        {
            $whatsapp = "OK";
        }
        else
        {
            $whatsapp = "KO";
        }
        
        // Enviamos el correo de reserva
        // Comprobamos que no sea ninguno de estos correos (info@basededatos-info.com, yourmail@gmail.com)
        if ( $mail === "info@basededatos-info.com" || $mail === "yourmail@gmail.com" || $mail === "artyea@msn.com" || !$telefonoValido ) {
            $envio = "KO";
        } else {
            $envio = $correo->enviarMailsReserva($mail, $nombre, $dia, $hora_entrada, $hora_salida, $telefono, $comentario, $whatsapp);
        }
        
        if ( $envio == "OK" ) {
            $destino="../envio-correcto/";
        } else {
            $destino="../envio-fallido/";
        }
        
        // El nombre, mail, dia, hora_entrada y hora_salida tienen que ser obligatorios
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