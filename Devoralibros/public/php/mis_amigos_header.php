<?php
require_once '../clases/Connection.php';
include_once ('../clases/Usuario.php');
$bd= Connection::dameInstancia();
$c=$bd->dameConexion();
$usuario=new Usuario();
$id1=$_GET['id1'];
$id2=$_GET['id2'];
// Comprueba que existan los dos id e introduce la fila de vuelta con estado=2,
// también modifica la fila de ida de estado=1 a estado=2 para que sean amigos.
if (isset($id1) AND isset($id2)) {
    $exito="";
    $estado=2;
    $sql="INSERT INTO usuarios_amigos (estado,id_usuario1,id_usuario2)"
        . " VALUES(?,?,?)";    
    $sentencia=$c->prepare($sql);
    $sentencia->bind_param("iii",$estado,$id2,$id1);    
    $sql_query = "UPDATE usuarios_amigos SET estado= ? "
                ." WHERE id_usuario1= ? AND id_usuario2= ?";
 	$stmt =  $c->stmt_init();
        $stmt->prepare($sql_query);
        if ($stmt === false) {
            return false;
          }
	$stmt->bind_param('iii',$estado,$id1,$id2);    
    $tipo_usuario=$usuario->getTipoUsuario($id1);
    if($sentencia->execute()&&$stmt->execute()){
		$puntos = 1;
        $usuario->sumarPuntosAmistad($id1,$puntos);
        $usuario->sumarPuntosAmistad($id2,$puntos);
        if($tipo_usuario==2){
            $destino="../Administrador/?pagina=2#mi-ancla";
        }elseif($tipo_usuario==1){
            $destino="../Usuario/?pagina=2#mi-ancla";
        }
        header('Location:'.$destino);
    }else{
        $error=  'No se ha podido aceptar la solicitud';
        if($tipo_usuario==2){
            $destino="../Administrador/?pagina=2#mi-ancla?error=$error";
        }elseif($tipo_usuario==1){
            $destino="../Usuario/?pagina=2#mi-ancla?error=$error";
        }
        header('Location:'.$destino);
    }
    return $exito;    
}
?>