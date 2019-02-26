<?php

require_once '../clases/Connection.php';
include_once ('../clases/Usuario.php');
include_once ('../clases/Log.php');

$log = new Log();
$desdeDonde = "buscadorAmigo_header.php";

$bd= Connection::dameInstancia();
$c = $bd->dameConexion();
$usuario = new Usuario();
$id1 = $_GET['id1'];
$id2 = $_GET['id2'];
$tipo_usuario = $usuario->getTipoUsuario($id1);

// Comprueba que existan el id1 y el id2 e introduce en la tabla usuarios_amigos
// una fila con estado=1, que es solicitud de amistad sin aprobar.
if (isset($id1) AND isset($id2)) {
    
    $estadoId1 = $usuario->getEstado($id1);
    $estadoId2 = $usuario->getEstado($id2);
    
    if ( $estadoId1 == 'ALTA' && $estadoId2 == 'ALTA' ) {
        
        $estado = 1;
        $sql = "INSERT INTO usuarios_amigos (estado,id_usuario1,id_usuario2)"
            . " VALUES(?,?,?)";    
        $sentencia = $c->prepare($sql);
        $sentencia->bind_param("iii",$estado,$id1,$id2);
        $usuario->enviarMailSolicitud($id1,$id2);
        
        if($sentencia->execute()){
            
            $log->write_log($desdeDonde, "Se ha enviado una solicitud del usuario: " . $id1 . " al usuario: " . $id2,
                null, "INFO", "*");
            
            if($tipo_usuario == 2){
                $destino = "index_administrador.php?pagina=2#mi-ancla";
            }elseif($tipo_usuario == 1){
                $destino = "index_usuario.php?pagina=2#mi-ancla";
            }
            header('Location:'.$destino);
            
        }else{
            
            $error = 'No se ha podido enviar la solicitud';
            
            $log->write_log($desdeDonde, "No se ha podido enviar la solicitud del usuario: " . $id1 . " al usuario: " . $id2,
                - 669, "ERROR", "*");
            
            if($tipo_usuario == 2){
                $destino = "index_administrador.php?pagina=2#mi-ancla?error=$error";
            }elseif($tipo_usuario == 1){
                $destino = "index_usuario.php?pagina=2#mi-ancla?error=$error";
            }
            header('Location:'.$destino);
        }    
    } else {
        
        $error = 'No se ha podido enviar la solicitud';
        if($tipo_usuario == 2){
            $destino = "index_administrador.php?pagina=2#mi-ancla?error=$error";
        }elseif($tipo_usuario == 1){
            $destino = "index_usuario.php?pagina=2#mi-ancla?error=$error";
        }
        header('Location:'.$destino);
    }
        
} else {
    
    $error = 'No se ha podido enviar la solicitud';
    if($tipo_usuario == 2){
        $destino = "index_administrador.php?pagina=2#mi-ancla?error=$error";
    }elseif($tipo_usuario == 1){
        $destino = "index_usuario.php?pagina=2#mi-ancla?error=$error";
    }
    header('Location:'.$destino);
}
?>

