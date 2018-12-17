<?php
require_once '../clases/Connection.php';
include_once ('../clases/Usuario.php');
$bd= Connection::dameInstancia();
$c=$bd->dameConexion();
$usuario=new Usuario();
$id1=$_GET['id1'];
$id2=$_GET['id2'];
// Comprueba que existan el id1 y el id2 e introduce en la tabla usuarios_amigos
// una fila con estado=1, que es solicitud de amistad sin aprobar.
if (isset($id1) AND isset($id2)) {
    $estado=1;
    $sql="INSERT INTO usuarios_amigos (estado,id_usuario1,id_usuario2)"
        . " VALUES(?,?,?)";    
    $sentencia=$c->prepare($sql);
    $sentencia->bind_param("iii",$estado,$id1,$id2);
    $tipo_usuario=$usuario->getTipoUsuario($id1);
    $usuario->enviarMailSolicitud($id1,$id2);
    if($sentencia->execute()){
        if($tipo_usuario==2){
            $destino="index_administrador.php?pagina=2#mi-ancla";
        }elseif($tipo_usuario==1){
            $destino="index_usuario.php?pagina=2#mi-ancla";
        }
        header('Location:'.$destino);
    }else{
        $error='No se ha podido enviar la solicitud';
        $destino="index_administrador.php?pagina=2#mi-ancla?error=$error";
        header('Location:'.$destino);
    }    
}
?>

