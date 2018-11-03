<?php

require_once '../clases/Correo.php';
$correo = new Correo();
$strMensaje="";

if(isset($_REQUEST['enviar'])){
    
    if(isset($_REQUEST['nombre']) AND isset($_REQUEST['mail'])){
        
        // Campos obligatorios
        $nombre = $_REQUEST['nombre'];
        $mail = $_REQUEST['mail'];
        
        // Campos opcionales
        if ( isset($_REQUEST['telefono']) ) {
            $telefono = $_REQUEST['telefono'];
        } else {
            $telefono = null;
        }
        
        if ( isset($_REQUEST['consulta']) ) {
            $consulta = $_REQUEST['consulta'];
        } else {
            $consulta = null;
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
        $envio = $correo->enviarMailsConsulta($mail, $nombre, $telefono, $consulta, $whatsapp);
        
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