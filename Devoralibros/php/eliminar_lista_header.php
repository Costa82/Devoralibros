<?php
require_once '../clases/Connection.php';
include_once ('../clases/Lista.php');
include_once ('../clases/Usuario.php');
$bd= Connection::dameInstancia();
$c=$bd->dameConexion();
$lista=new Lista();
$usuario=new Usuario();
$idlista=$_GET['idlista'];
$idusuario=$_GET['idusuario'];
// Comprobamos que exista la lista del usuario y la borramos
if (isset($idlista) AND isset($idusuario)) {
    $sql="DELETE FROM listas WHERE id_lista = ?";
    $sentencia=$c->prepare($sql);
    $sentencia->bind_param("i",$idlista);
    $tipo_usuario=$usuario->getTipoUsuario($idusuario);
    if($sentencia->execute()){
        if($tipo_usuario==2){
            $destino="../Administrador/?pagina=3#mi-ancla";
        }elseif($tipo_usuario==1){
            $destino="../Usuario/?pagina=3#mi-ancla";
        }
        header('Location:'.$destino);
    }else{
        $error='No se ha podido elimiar la lista';
        if($tipo_usuario==2){
            $destino="../Administrador/?pagina=3#mi-ancla?error=$error";
        }elseif($tipo_usuario==1){
            $destino="../Usuario/?pagina=3#mi-ancla?error=$error";
        }
            header('Location:'.$destino);
    }
}

