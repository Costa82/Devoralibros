<?php
require_once '../inc/funciones.php';
require_once '../inc/validaciones.inc.php';
require_once '../clases/Connection.php';
$bd= Connection::dameInstancia();
$c=$bd->dameConexion();
$nick=$_SESSION['datos']['nick'];
$id_usuario=$_SESSION['datos']['id_usuario'];
$tipo_usuario=$_SESSION['datos']['tipo_usuario'];
$sql_comentarios="SELECT * FROM libros A, usuarios_comentan_libros C WHERE A.id_libro=C.id_libro AND C.id_usuario='".$id_usuario."'";
        if($c->real_query($sql_comentarios)){
            if($resul_comentarios=$c->store_result()){
                $num_total_registros=$resul_comentarios->num_rows;
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
                // Muestro todos los libros comentados por el usuarios
                $sql="SELECT A.id_libro,A.titulo,A.img_portada,C.comentario,C.votacion FROM libros A, usuarios_comentan_libros C WHERE A.id_libro=C.id_libro AND C.id_usuario=".$id_usuario." ORDER BY A.titulo ASC LIMIT ".$inicio."," . $TAMANO_PAGINA;
                if($c->real_query($sql)){
                    if($resul=$c->store_result()){
                        if($resul->num_rows>0){
                            echo "<h2>Libros comentados</h2>";
                            echo "<div class='contenido1'>";
                            
                            while($mostrar=$resul->fetch_assoc()){
                                $myvar = str_replace(" ", "-", $mostrar["titulo"]);
                                echo "<div class='imagen2'>
                                     <a href='../Libro/".$myvar."'><img src='../img_libros/".$mostrar['img_portada']."' alt='".$mostrar["titulo"]."'  title='".$mostrar["titulo"]."'/></a>
                                         <div class='botones'>
                                         <a href='../FormularioEditarComentario/?libro=".$mostrar['id_libro']."' title='modifica tu comentario' class='boton'>Editar</a>
                                     </div></div>";                       
                                }
                                $resul->free_result();
                                echo "</div>";
                                 }else{
                                        $resul->free_result();
                                        echo "<h2>Aún no has comentado ningún libro</h2>";
                                 }
                         }
                }else{
                         echo $c->errno." -> ".$c->error;
                }
                echo '<div class="numeracion">';
                    if ($total_paginas > 1) {
                        if($tipo_usuario==1){
                            if ($pag != 1)
                                    echo '<a href="../Usuario/?pagina=1&pag='.($pag-1).'#mi-ancla"><img src="../img/izq.gif" border="0"></a>';
                            for ($i=1;$i<=$total_paginas;$i++) {
                                    if ($pag == $i)
                                            //si muestro el índice de la página actual, no coloco enlace
                                            echo $pag;
                                    else
                                            //si el índice no corresponde con la página mostrada actualmente,
                                            //coloco el enlace para ir a esa página
                                            echo '  <a href="../Usuario/?pagina=1&pag='.$i.'#mi-ancla">'.$i.'</a>  ';
                            }
                            if ($pag != $total_paginas)
                                    echo '<a href="../Usuario/?pagina=1&pag='.($pag+1).'#mi-ancla"><img src="../img/der.gif" border="0"></a>';
                        }else{
                            if ($pag != 1)
                                    echo '<a href="../Administrador/?pagina=5&pag='.($pag-1).'#mi-ancla"><img src="../img/izq.gif" border="0"></a>';
                            for ($i=1;$i<=$total_paginas;$i++) {
                                    if ($pag == $i)
                                            //si muestro el índice de la página actual, no coloco enlace
                                            echo $pag;
                                    else
                                            //si el índice no corresponde con la página mostrada actualmente,
                                            //coloco el enlace para ir a esa página
                                            echo '  <a href="../Administrador/?pagina=5&pag='.$i.'#mi-ancla">'.$i.'</a>  ';
                            }
                            if ($pag != $total_paginas)
                                    echo '<a href="../Administrador/?pagina=5&pag='.($pag+1).'#mi-ancla"><img src="../img/der.gif" border="0"></a>';
                        }
                    }
                    echo '</div>';
                }else {
                    echo "<h2>Aún no has comentado ningún libro</h2>";
                }
            }
        }
?>
