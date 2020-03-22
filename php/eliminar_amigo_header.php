<?php
require_once '../clases/Connection.php';
include_once ('../clases/Usuario.php');
$bd= Connection::dameInstancia();
$c=$bd->dameConexion();
$usuario=new Usuario();
$id1=$_GET['id1'];
$id2=$_GET['id2'];
// Comprobamos que existan los dos id y borramos la amistad de la tabla usuarios_amigos
// Dos usuarios son amigos si tienen dos filas en estado=2 con sus id tanto de ida como de vuelta (id1=id_usuario1, id2=id_usuario2 e id1=id_usuario2, id2=id_usuario1)
// Si solo hay una fila de ida (id1=id_usuario1, id2=id_usuario2) y el estado=1 sólo es una solicitud de amistad
if (isset($id1) AND isset($id2)) {
    $sql="DELETE FROM usuarios_amigos WHERE id_usuario1 = ? AND id_usuario2 = ? OR id_usuario1 = ? AND id_usuario2 = ?";
    $sentencia=$c->prepare($sql);
    $sentencia->bind_param("iiii",$id1,$id2,$id2,$id1);
    $tipo_usuario=$usuario->getTipoUsuario($id1);
    if($sentencia->execute()){
        if($tipo_usuario==2){
            $destino="index_administrador.php?pagina=2#mi-ancla";
        }elseif($tipo_usuario==1){
            $destino="index_usuario.php?pagina=2#mi-ancla";
        }
        header('Location:'.$destino);
    }else{
        $error='No se ha podido elimiar al usuario';
        $destino="index_administrador.php?pagina=2#mi-ancla?error=$error";
        header('Location:'.$destino);
    }
}

