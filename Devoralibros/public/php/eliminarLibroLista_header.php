<?php
require_once '../clases/Connection.php';
include_once ('../clases/Lista.php');
include_once ('../clases/Usuario.php');
$bd= Connection::dameInstancia();
$c=$bd->dameConexion();
$lista=new Lista();
$usuario=new Usuario();
$idlista=$_GET['lista'];
$idlibro=$_GET['libro'];
$idusuario=$_GET['usuario'];
// Comprobamos que exista la lista y el libro y borramos el libro de la lista
if (isset($idlista) AND isset($idlibro)) {
    $sql="DELETE FROM listas_contienen_libros WHERE id_lista = ? AND id_libro = ?";
    $sentencia=$c->prepare($sql);
    $sentencia->bind_param("ii",$idlista,$idlibro);
    $tipo_usuario=$usuario->getTipoUsuario($idusuario);
    if($sentencia->execute()){
        if($tipo_usuario==2){
            $destino="../Administrador/?pagina=3#mi-ancla";
        }elseif($tipo_usuario==1){
            $destino="../Usuario/?pagina=3#mi-ancla";
        }
        header('Location:'.$destino);
    }else{
        $error='No se ha podido elimiar el libro';
        if($tipo_usuario==2){
            $destino="../Administrador/?pagina=3#mi-ancla?error=$error";
        }elseif($tipo_usuario==1){
            $destino="../Usuario/?pagina=3#mi-ancla?error=$error";
        }
            header('Location:'.$destino);
    }
}

