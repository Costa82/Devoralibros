<?php
require_once '../clases/Usuario.php';
$bd= Connection::dameInstancia();
$c=$bd->dameConexion();
$usuario=new Usuario();
$id_mensaje=$_REQUEST['id_mensaje'];
$tipo_usuario=$_REQUEST['tipo_usuario'];
// Actualizamos el valor leido, que estará a 1, a 2 que es mensaje leido
if (isset($id_mensaje)) {
    $sql="UPDATE usuarios_mensajes SET leido = 2 WHERE id_mensaje = ?";
    $sentencia=$c->prepare($sql);
    $sentencia->bind_param("i",$id_mensaje);
    if($sentencia->execute()){
        switch ($tipo_usuario){
               case 1:
                   $destino="index_usuario.php?pagina=4#mi-ancla";
               break;
               case 2:
                   $destino="index_administrador.php?pagina=4#mi-ancla";
               break;               
               default:
                   $destino="../index.php";
               break;
        }
        header('Location:'.$destino);
    }else{
        $error='No se ha podido marcar el mensaje';
        $destino="index_administrador.php?pagina=4#mi-ancla?error=$error";
        header('Location:'.$destino);
    }
}

