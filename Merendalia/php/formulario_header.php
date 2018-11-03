<?php

require_once '../clases/Correo.php';
$correo = new Correo();
$strMensaje="";

if(isset($_REQUEST['enviar'])){
    
    if(isset($_REQUEST['nombre']) AND isset($_REQUEST['mail']) AND isset($_REQUEST['dia']) AND isset($_REQUEST['hora_entrada']) AND isset($_REQUEST['hora_salida'])){
        
        // Campos obligatorios
        $nombre = $_REQUEST['nombre'];
        $mail = $_REQUEST['mail'];
        $dia = $_REQUEST['dia'];
        $hora_entrada = $_REQUEST['hora_entrada'];
        $hora_salida = $_REQUEST['hora_salida'];
        
        // Campos opcionales
        if ( isset($_REQUEST['telefono']) ) {
            $telefono = $_REQUEST['telefono'];
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
        $envio = $correo->enviarMailsReserva($mail, $nombre, $dia, $hora_entrada, $hora_salida, $telefono, $comentario, $whatsapp);
        
        if ( $envio == "OK" ) {
            $destino="envioCorrecto.php";            
        } else {
            $destino="envioFallido.php";
        }
        
        if (!headers_sent()) {
            header('Location:'.$destino);
            exit;
        }
    }
}
?>