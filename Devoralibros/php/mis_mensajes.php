<?php
require_once '../inc/funciones.php';
require_once '../inc/validaciones.inc.php';
require_once '../clases/Connection.php';
require_once '../clases/Usuario.php';
$usuario= new Usuario();
$bd= Connection::dameInstancia();
$c=$bd->dameConexion();
$nick=$_SESSION['datos']['nick'];
$id_usuario=$_SESSION['datos']['id_usuario'];
$tipo_usuario=$_SESSION['datos']['tipo_usuario'];
$sql_mensajes="SELECT * FROM usuarios_mensajes WHERE id_usuario2='".$id_usuario."'";
        if($c->real_query($sql_mensajes)){
            if($resul_mensajes=$c->store_result()){
                $num_total_registros=$resul_mensajes->num_rows;
                //Si hay registros
                if ($num_total_registros > 0) {
                //Limito la busqueda
                $TAMANO_PAGINA = 10;
                $pag = false;
                //examino la pagina a mostrar y el inicio del registro a mostrar
                if (isset($_GET["pag"]))
                    $pag = $_GET["pag"];

                if (!$pag) {
                        $inicio = 0;
                        $pag = 1;
                }
                else {
                        $inicio = ($pag - 1) * $TAMANO_PAGINA;
                }
                //calculo el total de paginas
                $total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);
                    // Muestro todos los comentarios
                    $sql="SELECT id_mensaje,mensaje, id_usuario1, fecha, leido FROM usuarios_mensajes WHERE id_usuario2=".$id_usuario." ORDER BY fecha DESC, id_mensaje DESC LIMIT ".$inicio."," . $TAMANO_PAGINA;
                    if($c->real_query($sql)){
                        if($resul=$c->store_result()){
                            if($resul->num_rows>0){ 
                                echo "<h2>Mis mensajes</h2>";
                                while($mostrar=$resul->fetch_assoc()){
                                    $nick=$usuario->getNick($mostrar['id_usuario1']);
                                    if ($mostrar['leido']==1){
                                        echo "<div class='comentarios'>";
                                    }else {
                                        echo "<div class='comentarios leidos'>";
                                    }
                                        echo "<h3 class='nickMensajes'>".$nick."</h3><a href='../php/ver_amigo.php?nickAmigo=".md5($nick)."&tipo_usuario=".$tipo_usuario."&id1=".$id_usuario."&id_mensaje=".$mostrar['id_mensaje']."' title='Responder'>";
                                            //Si es un mensaje del Administrador no deja responder
                                            if ($mostrar['id_usuario1']!=100){
                                                echo "<i class='fa fa-share-square-o' aria-hidden='true'></i></a>";
                                            }else {
                                                echo "</a>";
                                            }
                                            if ($mostrar['leido']==1){ 
                                                echo "<a href='../php/marcar_leido_header.php?id_mensaje=".$mostrar['id_mensaje']."&tipo_usuario=".$tipo_usuario."' title='Marcar como leido'><i class='fa fa-check' aria-hidden='true'></i></a>";
                                            }
                                            echo "<a href='../php/eliminar_mensaje_header.php?id_mensaje=".$mostrar['id_mensaje']."&tipo_usuario=".$tipo_usuario."' title='Eliminar mensaje'><i class='fa fa-trash' aria-hidden='true'></i></a></br>".$mostrar['mensaje'].""
                                            . "</br><strong>".$mostrar['fecha']."</strong>"
                                            . "</div>";
                                    }
                                    $resul->free_result();
                                    }else{
                                        $resul->free_result();
                                        echo "<h2>Aún no tienes mensajes</h2>";
                                    }
                            }
                    }else{
                             echo $c->errno." -> ".$c->error;
                    }
                    echo '<div class="numeracion">';
                    if ($total_paginas > 1) {
                            if ($pag != 1)
                                if ($tipo_usuario==1){
                                    echo '<a href="index_usuario.php?pagina=4&pag='.($pag-1).'#mi-ancla"><img src="../img/izq.gif" border="0"></a>';
                                }else{
                                    echo '<a href="index_administrador.php?pagina=4&pag='.($pag-1).'#mi-ancla"><img src="../img/izq.gif" border="0"></a>';
                                }for ($i=1;$i<=$total_paginas;$i++) {
                                    if ($pag == $i)
                                            //si muestro el índice de la página actual, no coloco enlace
                                            echo $pag;
                                    else
                                            //si el índice no corresponde con la página mostrada actualmente,
                                            //coloco el enlace para ir a esa página
                                    if ($tipo_usuario==1){
                                        echo '<a href="index_usuario.php?pagina=4&pag='.$i.'#mi-ancla">'.$i.'</a>';
                                    }else{
                                        echo '<a href="index_administrador.php?pagina=4&pag='.$i.'#mi-ancla">'.$i.'</a>';
                                    }
                            }
                            if ($pag != $total_paginas)
                                    if ($tipo_usuario==1){
                                    echo '<a href="index_usuario.php?pagina=4&pag='.($pag+1).'#mi-ancla"><img src="../img/der.gif" border="0"></a>';
                                }else{
                                    echo '<a href="index_administrador.php?pagina=4&pag='.($pag+1).'#mi-ancla"><img src="../img/der.gif" border="0"></a>';
                                }
                    }
                    echo '</div>';
                }else {
                    echo "<h2>No tienes mensajes</h2>";
                }
            }
        }
?>

