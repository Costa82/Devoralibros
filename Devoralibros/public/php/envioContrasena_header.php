<?php
 spl_autoload_register ( function ($nombre_clase) {
            include_once ('../clases/'. $nombre_clase . '.php');
    } );
if(isset($_REQUEST['recuperar'])){
    if(!empty($_REQUEST['mail'])){
        $mail=$_REQUEST['mail'];
        $usuario=new Usuario();
        if($id_usuario = $usuario->esRegistradoMail($mail)){ // Para recuperar la contraseña, se comprueba que sea ususario registrado.
            require_once '../inc/funciones.php';
            $nombre=$usuario->getNombre($id_usuario);
			$nick=$usuario->getNick($id_usuario);
            // Función para generar una contraseña aleatoria
            function generarCodigo($longitud) {
                $key = '';
                $pattern = '1234567890';
                $max = strlen($pattern)-1;
                for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
                return $key;
            } 
            $numeroAleatorio = generarCodigo(4); // Genera un código de 4 caracteres de longitud.            
            $pass=$numeroAleatorio.'Aa';
            // Cambiamos la antigua contraseña por la nueva en la base de datos.
            $usuario->cambiarPass($pass,$id_usuario);            
            // Enviamos el email
            $destinatario = $mail; 
            $asunto = "DevoraLibros-password";
            $cuerpo = ' 
            <html> 
            <head> 
               <title>Recuperaci&oacute;n de contrase&ntilde;a</title> 
            </head> 
            <body> 
            <h1 style="color:blue;">Hola '.$nombre.'</h1> 
            <p>Te enviamos una nueva contrase&ntilde;a para que puedas volver a entrar en DevoraLibros, recuerda que luego puedes modificarla desde la p&aacute;gina de tu perfil en Editar Usuario.
            
            <br/><br/>Tu contrase&ntilde;a es: <em>'.$pass.'</em>
			<br/><br/>Tu Nick es: <em>'.$nick.'</em>
                
            <br/><br/>Saludos y recuerda...NUNCA DEJES DE LEER!</p>
            <br/><br/>
            <p>Beatriz, Bel&eacute;n, Esther y Miguel 
            <br/><strong>Administradores de DevoraLibros</p>
            </body> 
            </html> 
            '; 
            //para el envío en formato HTML 
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=utf-8\r\n"; 
            //dirección del remitente 
            $headers .= "From: DevoraLibros <administrador@devoralibros.es>\r\n"; 
            //dirección de respuesta, si queremos que sea distinta que la del remitente 
            //$headers .= "Reply-To: mariano@desarrolloweb.com\r\n"; 
            //ruta del mensaje desde origen a destino 
            //$headers .= "Return-path: holahola@desarrolloweb.com\r\n"; 
            //direcciones que recibián copia 
            //$headers .= "Cc: maria@desarrolloweb.com\r\n"; 
            //direcciones que recibirán copia oculta 
            //$headers .= "Bcc: pepe@pepe.com,juan@juan.com\r\n"; 
            mail($destinatario,$asunto,$cuerpo,$headers); 
            $tipo_usuario=$_SESSION['datos']['tipo_usuario'];
            $destino="iniciar_sesion.php";         
        }else{
             $num=-201;
             $destino="envioContrasena.php?num=$num";
        }          
    }         
}else{
     $num=-201;
     $destino="../FormularioEnvioContraseña/?num=$num";
}
if (!headers_sent()) {
  header('Location:'.$destino);  
exit;
}
?>

