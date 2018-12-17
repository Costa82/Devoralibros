<?php
require_once 'Connection.php';

class Noticia
{

    private $c;

    private $tabla;

    public function __construct()
    {
        $bd = Connection::dameInstancia();
        $this->c = $bd->dameConexion();
        $this->tabla = "noticias";
    }

    /**
     * normaliza ($cadena)
     * Función que se utilizara dentro de las funciones guardarImgNoticia() y modificaImg() para quitar los acentos y las Ñs a las rutas
     *
     * @param
     *            $cadena
     * @return String
     */
    public function normaliza($cadena)
    {
        $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ
        ßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
        $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuy
        bsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
        $cadena = utf8_decode($cadena);
        $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
        $cadena = strtolower($cadena);
        return utf8_encode($cadena);
    }

    /**
     * existeNoticia($titulo):
     * Función que se utilizará dentro de la función addNoticia() para ver si ya existe la noticia a subir.
     *
     * @param
     *            $titulo
     * @return boolean
     */
    public function existeNoticia($titulo)
    {
        $sql = "SELECT * FROM " . $this->tabla . " WHERE titulo='" . $titulo . "'";
        if ($this->c->real_query($sql)) {
            if ($resul = $this->c->store_result()) {
                if ($resul->num_rows == 0) {
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            return $this->c->errno . " -> " . $this->c->error;
        }
    }

    /**
     * addNoticia($id_usuario,$titulo,$descripcion,$fecha_subida,$img,$fuente)
     * Función que se utilizara en el fichero SubirNoticia.php para añadir una noticia.
     * Dentro de esta función, utilizaremos las funciones existeNoticia($titulo) y guardarImgNoticia($titulo,$img).
     * Devuelve un valor númerico para imprimir un mensaje u otro dependiendo de si se ha realizado con exito o no.
     * Para imprimir los mensajes utilizaremos los ficheros validacionesNoticia.inc.php y definesNoticia.inc.php, los cuales estarán dentro de la carpeta inc.
     *
     * @param
     *            $id_usuario
     * @param
     *            $titulo
     * @param
     *            $descripcion
     * @param
     *            $fecha_subida
     * @param
     *            $img
     * @param
     *            $fuente
     * @return int
     */
    public function addNoticia($id_usuario, $titulo, $descripcion, $urlExtra, $fecha_subida, $img, $fuente)
    {
        if ($this->existeNoticia($titulo)) {
            $foto = $this->guardarImgNoticia($titulo, $img);
            $sql = "INSERT INTO " . $this->tabla . " (id_usuario,titulo,descripcion,urlExtra,fecha_subida,img_noticia,fuente) VALUES(?,?,?,?,?,?,?)";
            $sen = $this->c->prepare($sql);
            $desc = nl2br($descripcion);
            $url=nl2br($urlExtra);
            
            $sen->bind_param("issssss", $id_usuario, $titulo, $desc, $url, $fecha_subida, $foto, $fuente);
            if ($sen->execute()) {
                return - 402; // Se ha creado con exito
            } else {
                return - 401; // No se ha podido crear
            }
        } else {
            return - 400; // Esta noticia ya existe
        }
    }

    /**
     * guardarImgNoticia($titulo,$archivo_img):
     * Función utilizada dentro de la función addNoticia(), para guardar la imagen
     *
     * @param
     *            $titulo
     * @param
     *            $archivo_img
     */
    public function guardarImgNoticia($titulo, $archivo_img)
    {
        $img_name = $archivo_img['name'];
        $img_type = $archivo_img['type'];
        $img_tmp_name = $archivo_img['tmp_name'];
        $img_size = $archivo_img['size'];
        if ($img_type == "image/jpeg" || $img_type == "image/pjpeg" || $img_type == "image/jpg") {
            $extension = "jpg";
        } elseif ($img_type == "image/png") {
            $extension = "png";
        } else {
            $extension = NULL;
        }
        $ruta = "NULL";
        $rutaBD = "NULL";
        $lugar = '../img_noticias/';
        // Validamos la imagen
        if ($img_name != NULL and $extension != NULL and $img_size != 0) {
            if ($img_size <= $_REQUEST['lim_tamano']) {
                $nombre_img = $this->normaliza($titulo . "." . $extension);
                $ruta = $lugar . $nombre_img;
                // Guardamos la foto en la carpeta del proyecto "img_noticias"
                move_uploaded_file($img_tmp_name, $ruta);
                // Declaramos la ruta de la imagen en la base de datos
                $rutaBD = $nombre_img;
            } else {
                $rutaOrigen = "../img_noticias/noticia_generica.jpg";
                $rutaFinal = $this->normaliza($lugar . $titulo . ".png");
                copy($rutaOrigen, $rutaFinal);
                $rutaBD = $this->normaliza($titulo . ".png");
            }
        } else { // En caso de que el usuario no inserte imagen
            $rutaOrigen = "../img_noticias/noticia_generica.jpg";
            $rutaFinal = $this->normaliza($lugar . $titulo . ".png");
            copy($rutaOrigen, $rutaFinal);
            $rutaBD = $this->normaliza($titulo . ".png");
        }
        return $rutaBD;
    }

    /**
     * mostrarNoticias();
     * Función que se utilizará en el fichero VisorNoticias.php para mostrar todas las noticias.
     * Dentro de la función añadiremos una paginación que mostrará por página 5 resultados ordenados por la fecha de subida.
     */
    public function mostrarNoticias()
    {
        $sql_noticias = "SELECT * FROM " . $this->tabla;
        if ($this->c->real_query($sql_noticias)) {
            if ($resul_noticias = $this->c->store_result()) {
                $num_total_registros = $resul_noticias->num_rows;
                // Si hay registros
                if ($num_total_registros > 0) {
                    // Limito la busqueda
                    $TAMANO_PAGINA = 5;
                    $pag = false;
                    // Examino la pagina a mostrar y el inicio del registro a mostrar
                    if (isset($_GET["pag"]))
                        $pag = $_GET["pag"];
                    
                    if (! $pag) {
                        $inicio = 0;
                        $pag = 1;
                    } else {
                        $inicio = ($pag - 1) * $TAMANO_PAGINA;
                    }
                    // Calculo el total de paginas
                    $total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);
                    $sql = "SELECT * FROM " . $this->tabla . " ORDER BY fecha_subida DESC LIMIT " . $inicio . "," . $TAMANO_PAGINA;
                    if ($this->c->real_query($sql)) {
                        if ($resul = $this->c->store_result()) {
                            if ($resul->num_rows > 0) {
                                while ($mostrar = $resul->fetch_assoc()) {
                                    echo "<div class='noticias'>
                                                <div class='imgNoticia'>
                                                    <img src='../img_noticias/" . $mostrar["img_noticia"] . "' alt='" . $mostrar["titulo"] . "' title='" . $mostrar["titulo"] . "'>
                                                </div>
                                                <div class='noticia'>
                                                    <h4>" . $mostrar["titulo"] . "</h4>
                                                    " . $mostrar["descripcion"] . "<br />";
                                    
                                    if ( $mostrar["urlExtra"] != null ) {
                                        echo "<br /><a href='".$mostrar['urlExtra']."' target='_blank'>".$mostrar['urlExtra']."</a><br />";
                                    }
                                    
                                    if ($mostrar["fuente"] != 'Noticia de Devoralibros') {
                                        echo "</br><strong>Fuente de la noticia: </strong><a href='" . $mostrar["fuente"] . "' target='_blank'>" . $mostrar["fuente"] . "</a>";
                                    } else {
                                        echo "</br><strong>Fuente de la noticia: </strong>Noticia de Devoralibros";
                                    }
                                    echo "<h4> " . $mostrar["fecha_subida"] . "</h4>";
                                    if (isset($_SESSION['id_usuario'])) {
                                        $tipo_usuario = $_SESSION['datos']['tipo_usuario'];
                                        if ($tipo_usuario == 2) {
                                            echo " <a class='boton' href='../FormularioEditarNoticia/?noticia=" . $mostrar['id_noticia'] . "'><i class='fa fa-pencil' aria-hidden='true'></i></a></div>";
                                        } else {
                                            echo "";
                                        }
                                    } else {
                                        echo "";
                                    }
                                    echo "</div></div>";
                                }
                                $resul->free_result();
                            } else {
                                $resul->free_result();
                                echo "<div class='comentarios'>No hay noticias subidas</div>";
                            }
                        }
                    } else {
                        echo $this->c->errno . " -> " . $this->c->error;
                    }
                    echo '<div class="numeracion">';
                    if ($total_paginas > 1) {
                        if ($pag != 1)
                            echo '<a href="../Noticias/?pag=' . ($pag - 1) . '"><img src="../img/izq.gif" border="0"></a>';
                        for ($i = 1; $i <= $total_paginas; $i ++) {
                            if ($pag == $i)
                                // Si muestro el índice de la página actual, no coloco enlace
                                echo $pag;
                            else
                                // Si el índice no corresponde con la página mostrada actualmente,
                                // coloco el enlace para ir a esa página
                                echo '  <a href="../Noticias/?pag=' . $i . '">' . $i . '</a>  ';
                        }
                        if ($pag != $total_paginas)
                            echo '<a href="../Noticias/?pag=' . ($pag + 1) . '"><img src="../img/der.gif" border="0"></a>';
                    }
                    echo '</div>';
                } else {
                    echo "<div class='comentarios'>No hay noticias subidas</div>";
                }
            }
        }
    }

    /**
     * mostrar_ultima_noticia();
     * Función que se utilizará en el index para mostrar la ultima noticia.
     */
    public function mostrar_ultima_noticia()
    {
        $sql = "SELECT * FROM " . $this->tabla . " ORDER BY fecha_subida DESC LIMIT 1";
        if ($this->c->real_query($sql)) {
            if ($resul = $this->c->store_result()) {
                if ($resul->num_rows > 0) {
                    while ($mostrar = $resul->fetch_assoc()) {
                        echo "<h2><a href='Noticias/' title='Noticias'>Noticias</a></h2>
                            	  <h4 class='tituloNoticia'><a href='Noticias/' title='" . $mostrar["titulo"] . "'>" . $mostrar["titulo"] . "</a></h4>
                            	  <div class='libroRand'>
                            		<div class='imagenRand'>
                                            <a href='Noticias/'><img src='img_noticias/" . $mostrar["img_noticia"] . "' alt='" . $mostrar["titulo"] . "' title='" . $mostrar["titulo"] . "'></a>
                                    </div>
                                  <div class='descripcionRand'>
                                                " . $mostrar["descripcion"] . "</br></br>";
                        
                        echo "<h4> " . $mostrar["fecha_subida"] . "</h4>";
                        echo "</div></div>";
                    }
                    $resul->free_result();
                } else {
                    $resul->free_result();
                }
            }
        } else {
            echo $this->c->errno . " -> " . $this->c->error;
        }
    }

    /**
     * get_imagen($id):
     * Función que nos devuelve la imagen de la noticia a partir de su id
     *
     * @param
     *            $id
     * @return $mostrar["img_noticia"]
     */
    public function get_imagen($id)
    {
        $sql = "SELECT img_noticia FROM " . $this->tabla . " WHERE id_noticia='" . $id . "'";
        if ($this->c->real_query($sql)) {
            if ($resul = $this->c->store_result()) {
                $mostrar = $resul->fetch_assoc();
                return $mostrar["img_noticia"];
            }
        } else {
            echo $this->c->errno . " -> " . $this->c->error;
        }
    }

    /**
     * modificarNoticia($id_noticia,$titulo,$descripcion,$fuente)
     * Función que se utilizará en modificarNoticia.php para modificar una noticia.
     *
     * @param
     *            $id_noticia
     * @param
     *            $titulo
     * @param
     *            $descripcion
     * @param
     *            $fuente
     * @return boolean
     */
    public function modificarNoticia($id_noticia, $titulo, $descripcion, $urlExtra, $fuente)
    {
        $sql_query = "UPDATE noticias SET titulo= ? , descripcion= ?, urlExtra= ?, fuente= ? WHERE id_noticia= ?";
        $stmt = $this->c->stmt_init();
        $stmt->prepare($sql_query);
        if ($stmt === false) {
            return false;
        }
        $desc = nl2br($descripcion);
        $url = nl2br($urlExtra);
        $stmt->bind_param('ssssi', $titulo, $desc, $url, $fuente, $id_noticia);
        $stmt->execute();
    }

    /**
     * modificarImgNoticia($titulo,$img_noticia,$id_noticia)
     * Función que se utilizará en modificarNoticia.php para modificar la imagen de la noticia.
     *
     * @param
     *            $titulo
     * @param
     *            $img_noticia
     * @param
     *            $id_noticia
     * @return boolean
     */
    public function modificarImgNoticia($titulo, $img_noticia, $id_noticia)
    {
        $img = $this->modificarImg($titulo, $img_noticia);
        $sql_query = "UPDATE $this->tabla SET  " . "  img_noticia = ?" . " WHERE id_noticia= ?";
        
        $stmt = $this->c->stmt_init();
        $stmt->prepare($sql_query);
        if ($stmt === false) {
            return false;
        }
        $stmt->bind_param('si', $img, $id_noticia);
        $stmt->execute();
    }

    /**
     * modificarImg($titulo,$archivo_img):
     * Función utilizada dentro de la función modificarImgNoticia(),para modificar la imagen de la noticia
     *
     * @param
     *            $titulo
     * @param
     *            $archivo_img
     */
    public function modificarImg($titulo, $archivo_img)
    {
        $img_name = $archivo_img['name'];
        $img_type = $archivo_img['type'];
        $img_tmp_name = $archivo_img['tmp_name'];
        $img_size = $archivo_img['size'];
        if ($img_type == "image/jpeg" || $img_type == "image/pjpeg" || $img_type == "image/jpg") {
            $extension = "jpg";
        } elseif ($img_type == "image/png") {
            $extension = "png";
        } else {
            $extension = NULL;
        }
        $ruta = "NULL";
        $rutaBD = "NULL";
        $lugar = '../img_noticias/';
        // Validamos la imagen
        if ($img_name != NULL and $extension != NULL and $img_size != 0) {
            if ($img_size <= $_REQUEST['lim_tamano']) {
                $nombre_img = $this->normaliza($titulo . "." . $extension);
                $ruta = $lugar . $nombre_img;
                // Guardamos la foto en la carpeta del proyecto "img_noticias"
                move_uploaded_file($img_tmp_name, $ruta);
                // Declaramos la ruta de la imagen en la base de datos
                $rutaBD = $nombre_img;
            } else {
                $rutaOrigen = "../img_noticias/noticia_generica.jpg";
                $rutaFinal = $this->normaliza($lugar . $titulo . ".png");
                copy($rutaOrigen, $rutaFinal);
                $rutaBD = $this->normaliza($titulo . ".png");
            }
        } else { // En caso de que el usuario no inserte imagen
            $rutaOrigen = "../img_noticias/cnoticia_generica.jpg";
            $rutaFinal = $this->normaliza($lugar . $titulo . ".png");
            copy($rutaOrigen, $rutaFinal);
            $rutaBD = $this->normaliza($titulo . ".png");
        }
        return $rutaBD;
    }

    /**
     * nombreNoticia($id)
     * Función que devuelve el nombre de la noticia a partir de su id.
     *
     * @param
     *            $id
     * @return $mostrar["titulo"] el nombre de la noticia
     */
    public function nombreNoticia($id)
    {
        $sql = "SELECT titulo FROM " . $this->tabla . " WHERE id_noticia='" . $id . "'";
        if ($this->c->real_query($sql)) {
            if ($resul = $this->c->store_result()) {
                $mostrar = $resul->fetch_assoc();
                return $mostrar["titulo"];
            }
        } else {
            echo $this->c->errno . " -> " . $this->c->error;
        }
    }

    /**
     * get_descripcion($id)
     * Función que devuelve la descripción de la noticia a partir de su id.
     *
     * @param
     *            $id
     * @return $mostrar["descripcion"] la descripción de la noticia
     */
    public function get_descripcion($id)
    {
        $sql = "SELECT descripcion FROM " . $this->tabla . " WHERE id_noticia='" . $id . "'";
        if ($this->c->real_query($sql)) {
            if ($resul = $this->c->store_result()) {
                $mostrar = $resul->fetch_assoc();
                return $mostrar["descripcion"];
            }
        } else {
            echo $this->c->errno . " -> " . $this->c->error;
        }
    }
    
    /**
     * get_url($id)
     * Función que devuelve la url de la noticia a partir de su id.
     *
     * @param
     *            $id
     * @return $mostrar["url"] la descripción de la noticia
     */
    public function get_url($id)
    {
        $sql = "SELECT urlExtra FROM " . $this->tabla . " WHERE id_noticia='" . $id . "'";
        if ($this->c->real_query($sql)) {
            if ($resul = $this->c->store_result()) {
                $mostrar = $resul->fetch_assoc();
                return $mostrar["urlExtra"];
            }
        } else {
            echo $this->c->errno . " -> " . $this->c->error;
        }
    }

    /**
     * get_fuente($id)
     * Función que devuelve la fuente de la noticia a partir de su id.
     *
     * @param
     *            $id
     * @return $mostrar["fuente"] la fuente de la noticia
     */
    public function get_fuente($id)
    {
        $sql = "SELECT fuente FROM " . $this->tabla . " WHERE id_noticia='" . $id . "'";
        if ($this->c->real_query($sql)) {
            if ($resul = $this->c->store_result()) {
                $mostrar = $resul->fetch_assoc();
                return $mostrar["fuente"];
            }
        } else {
            echo $this->c->errno . " -> " . $this->c->error;
        }
    }
}
?>
