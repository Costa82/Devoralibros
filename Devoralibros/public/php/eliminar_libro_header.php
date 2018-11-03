<?php
require_once '../clases/Connection.php';
include_once ('../clases/Libro.php');
include_once ('../clases/Usuario.php');
$bd= Connection::dameInstancia();
$c=$bd->dameConexion();
$libro=new Libro();
$usuario=new Usuario();
$idlibro=$_GET['idlibro'];
$idusuario=$_GET['idusuario'];
// Comprobamos que exista el id del libro y lo borramos
if (isset($idlibro) AND isset($idusuario)) {
    $sql="DELETE FROM libros WHERE id_libro = ?";
    $sentencia=$c->prepare($sql);
    $sentencia->bind_param("i",$idlibro);
    $tipo_usuario=$usuario->getTipoUsuario($idusuario);
    if($sentencia->execute()){
	$puntos = -5;
	$libro->sumaPuntos($idusuario,$puntos);
        if($tipo_usuario==2){
            $destino="../Administrador/?pagina=1#mi-ancla";
        }elseif($tipo_usuario==1){
            $destino="../Usuario/?pagina=1#mi-ancla";
        }
        header('Location:'.$destino);
    }else{
        $error='No se ha podido elimiar el libro';
        if($tipo_usuario==2){
            $destino="../Administrador/?pagina=1#mi-ancla?error=$error";
        }elseif($tipo_usuario==1){
            $destino="../Usuario/?pagina=1#mi-ancla?error=$error";
        }
            header('Location:'.$destino);
    }
}