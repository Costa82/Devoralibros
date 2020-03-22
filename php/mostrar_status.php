<!--
- Proyecto Fin de Ciclo DAW IES Galileo 2017
-
- Archivo para mostrar el status de un lector.
-
- @project  2ºDAW
- @author   Miguel Costa.
-
-->
<?php

    require_once '../inc/funciones.php';
    require_once '../inc/validaciones.inc.php';
    include_once ('../clases/Usuario.php');
    sesion();
    $usuario=new Usuario();
    $nick=$_SESSION['datos']['nick'];
    $id_usuario=$_SESSION['datos']['id_usuario'];

	$puntos=$usuario->getPuntos($id_usuario);
	$puntosMes=$usuario->getPuntosMensual($id_usuario);
	if($puntos<100){
        echo '<h1>Devorador Novel</h1>';
    }
    if($puntos>99 && $puntos<500){
        echo '<h1>Devorador Medio</h1>';
    }
    if($puntos>499 && $puntos<1000){
        echo '<h1>Devorador Experto</h1>';
    }
    if($puntos>999){
         echo '<h1>Devorador Máster</h1>';
    }
    echo '<p class="parrafoPuntos">'.$puntosMes.' puntos mensuales</p>';
    echo '<p class="parrafoPuntos">'.$puntos.' puntos totales</p>';
            
?>