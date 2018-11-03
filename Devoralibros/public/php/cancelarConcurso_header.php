<?php
require_once '../clases/Concurso.php';
$bd= Connection::dameInstancia();
$c=$bd->dameConexion();
$concurso=new Concurso();
$id_concurso=$_GET['concurso'];
// Actualizamos el valor activo, que estará a 1, a 2 que es concurso cancelado
if (isset($id_concurso)) {
    $sql="UPDATE concursos SET activo = 2 WHERE id_concurso = ?";
    $sentencia=$c->prepare($sql);
    $sentencia->bind_param("i",$id_concurso);
    if($sentencia->execute()){
            $destino="../Concursos/";
        header('Location:'.$destino);
    }else{
        $error='No se ha podido cancelar el concurso';
        $destino="../Concursos/?error=$error";
        header('Location:'.$destino);
    }
}

