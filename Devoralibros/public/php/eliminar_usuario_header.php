<?php
require_once '../clases/Connection.php';
include_once ('../clases/Usuario.php');
$bd= Connection::dameInstancia();
$c=$bd->dameConexion();
$usuario=new Usuario();
$id=$_GET['id'];
if (isset($id)) {
    $sql="DELETE FROM usuarios WHERE id_usuario = ?";
    $sentencia=$c->prepare($sql);
    $sentencia->bind_param("i",$id);
    if($sentencia->execute()){
      	$error='NOERROR';
        $destino="../EditarUsuarios/?err=".$error;        
        header('Location:'.$destino);
    }else{
        $error='ERROR';
        $destino="../EditarUsuarios/?err=".$error;
        header('Location:'.$destino);
    }
}