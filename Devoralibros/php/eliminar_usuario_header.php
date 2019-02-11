<?php

// Ponemos al usuario de BAJA
require_once '../clases/Connection.php';
include_once ('../clases/Usuario.php');
$bd = Connection::dameInstancia();
$c = $bd->dameConexion();
$usuario = new Usuario();
$id = $_GET['id'];

$pagina = null;
if( isset($_GET['pagina']) ) {
    $pagina = $_GET['pagina'];
}

$tipo_usuario = $usuario->getTipoUsuario($id);
$usuario->console_log($tipo_usuario);

if (isset($id)) {
    
    $sql="UPDATE usuarios SET Estado = 'BAJA' WHERE id_usuario = ?";
    $sentencia=$c->prepare($sql);
    $sentencia->bind_param("i",$id);
    if($sentencia->execute()){
        
        if ($pagina == 'editarUsuarios') {
          	$error='NOERROR';
            $destino="../EditarUsuarios/?err=".$error;        
            header('Location:'.$destino);
        } else {
            $destino="../php/cerrarSesion.php";
            header('Location:'.$destino);
        }
        
    }else{
        
        if ($pagina == 'editarUsuarios') {
            $error='ERROR';
            $destino="../EditarUsuarios/?err=".$error;
            header('Location:'.$destino);
        } else {
            $destino="../php/cerrarSesion.php";
            header('Location:'.$destino);
        }
    }
}