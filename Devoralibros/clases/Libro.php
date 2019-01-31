<?php
require_once 'Connection.php';
require_once 'Usuario.php';

$usuario = new Usuario();

class Libro
{

    private $c;

    private $tabla;

    public function __construct()
    {
        $bd = Connection::dameInstancia();
        $this->c = $bd->dameConexion();
        $this->tabla = "libros";
    }

    /**
     * normaliza ($cadena)
     * Función que se utilizara dentro de las funciones guardarImgLibro() y modificaImg() para quitar los acentos y las Ñs a las rutas
     *
     * @param
     *            $cadena
     * @return String
     */
    public function normaliza($cadenaOriginal)
    {
        $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ
		ßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ?¿-!¡';
        $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuy
		bsaaaaaaaceeeeiiiidnoooooouuuyybyRr     ';
        $cadena = utf8_decode($cadenaOriginal);
        $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
        $cadena = strtolower($cadena);
        
        return utf8_encode($cadena);
    }

    /**
     * quitarCaracteres ($cadena)
     * Función que se utilizara dentro de las funciones guardarImgLibro() y modificaImg() para quitar los acentos y las Ñs a las rutas
     *
     * @param
     *            $cadena
     * @return String
     */
    public function quitarCaracteres($cadenaOriginal)
    {
        $originales = '?¿-!¡/\\';
        $modificadas = '       ';
        $cadena = utf8_decode($cadenaOriginal);
        $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
        // $cadena = strtolower($cadena);
        
        return utf8_encode($cadena);
    }

    /**
     * numLibros
     * Calcula cuantos libros hay en BBDD
     *
     * @return int
     */
    public function numLibros()
    {
        $sql = "SELECT * FROM " . $this->tabla . "";
        if ($this->c->real_query($sql)) {
            if ($resul = $this->c->store_result()) {
                if ($resul->num_rows == 0) {
                    $numLibros = 0;
                    
                    return $numLibros;
                } else {
                    $numLibros = $resul->num_rows;
                    
                    return $numLibros;
                }
            }
        } else {
            
            return $this->c->errno . " -> " . $this->c->error;
        }
    }

    /**
     * existeIsbn($isbn)
     * Función que se utilizara dentro de la función addLibro para ver si ya existe el isbn del libro a subir.
     *
     * @param
     *            $isbn
     * @return boolean
     */
    public function existeIsbn($isbn)
    {
        $sql = "SELECT * FROM " . $this->tabla . " WHERE isbn='" . $isbn . "'";
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
     * existeTitulo($titulo)
     * Función que se utilizara dentro de la función addLibro para ver si ya existe el titulo del libro a subir.
     *
     * @param
     *            $titulo
     * @param
     *            $autor
     * @return boolean
     */
    public function existeTitulo($titulo, $autor)
    {
        $sql = "SELECT * FROM " . $this->tabla . " WHERE titulo='" . $titulo . "' AND autor='" . $autor . "'";
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
     * existeIdLibro($id)
     * Función que comprueba si ya existe el id del libro.
     *
     * @param
     *            $id
     * @return boolean
     */
    public static function existeIdLibro($id)
    {
        $c = Connection::dameInstancia();
        $conexion = $c->dameConexion();
        $sql = "SELECT * FROM libros WHERE id_libro='" . $id . "'";
        $resul = $conexion->query($sql);
        if ($resul->num_rows == 0) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * addLibro($id_usuario,$titulo,$isbn,$autor,$sinopsis,$genero,$genero2,$resumen,$serie,$pelicula,$fecha_subida,$img)
     * Función que se utilizará en el fichero SubirLibro.php para añadir un libro.
     * Dentro de esta función, utilizaremos la funcion  guardarImgLibro($titulo,$img).
     *
     * @param
     *            $id_usuario
     * @param
     *            $titulo
     * @param
     *            $isbn
     * @param
     *            $autor
     * @param
     *            $sinopsis
     * @param
     *            $genero
     * @param
     *            $genero2
     * @param
     *            $resumen
     * @param
     *            $serie
     * @param
     *            $pelicula
     * @param
     *            $fecha_subida
     * @param
     *            $img
     * @param
     *            $banner
     * @param
     *            $votacion
     * @return int
     */
    public function addLibro($id_usuario, $titulo, $isbn, $autor, $autorLibro, $sinopsis, $genero, $genero2, $resumen, $serie, $pelicula, $fecha_subida, $img, $banner, $votacion)
    {
        if ($this->existeTitulo($titulo, $autor)) {
            $foto = $this->guardarImgLibro($titulo, $img);
            $tituloSinCaracteres = $this->quitarCaracteres($titulo);
            $sql = "INSERT INTO " . $this->tabla . " (titulo,isbn,autor,autorLibro,sinopsis,genero,genero2,img_portada,id_usuario,fecha_subida,resumen,serie,pelicula,banner) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $sen = $this->c->prepare($sql);
            $sino = nl2br($sinopsis);
            $res = nl2br($resumen);
            $usuario = new Usuario();
            $sen->bind_param("sisissssisssss", $tituloSinCaracteres, $isbn, $autor, $autorLibro, $sino, $genero, $genero2, $foto, $id_usuario, $fecha_subida, $res, $serie, $pelicula, $banner);
            
            if ($sen->execute()) {
                
                if ($votacion != NULL) {
                    $id_libro = $this->get_id($tituloSinCaracteres);
                    $this->addVoto($id_usuario, $id_libro, $votacion);
                }
                $puntos = 5;
                $this->sumaPuntos($id_usuario, $puntos);
                $usuario->enviarMailsSubidaLibro($titulo);
                return - 402; // Se ha creado con exito
            } else {
                return - 401; // No se ha podido crear
            }
        } else {
            return - 400; // Este libro ya existe
        }
    }

    /**
     * sumaPuntos($id_usuario,$puntos)
     * Función que sumara puntos al realizar diversas acciones.
     *
     * @param
     *            $id_usuario
     * @param
     *            $puntos
     */
    public function sumaPuntos($id_usuario, $puntos)
    {
        $sql_puntos = "UPDATE usuarios SET puntos= puntos + ?, puntosmes= puntosmes + ? WHERE id_usuario = ?";
        $stmt = $this->c->stmt_init();
        $stmt->prepare($sql_puntos);
        $stmt->bind_param("iii", $puntos, $puntos, $id_usuario);
        $stmt->execute();
    }

    /**
     * modificarLibro($id_libro,$titulo,$isbn,$autor,$sinopsis,$genero,$genero2,$resumen,$serie,$pelicula,$banner)
     * Función que se utilizara en modificarLibro.php para modificar un libro.
     *
     * @param
     *            $id_libro
     * @param
     *            $titulo
     * @param
     *            $autor
     * @param
     *            $sinopsis
     * @param
     *            $genero
     * @param
     *            $genero2
     * @param
     *            $resumen
     * @param
     *            $serie
     * @param
     *            $pelicula
     * @param
     *            $banner
     * @return boolean
     */
    public function modificarLibro($id_libro, $titulo, $isbn, $autor, $sinopsis, $genero, $genero2, $resumen, $serie, $pelicula, $banner)
    {
        $sql_query = "UPDATE libros SET titulo= ? , isbn= ?, autor= ?, sinopsis= ?, genero= ?, genero2= ?, resumen= ?, serie= ?, pelicula= ?, banner= ? WHERE id_libro= ?";
        $stmt = $this->c->stmt_init();
        $stmt->prepare($sql_query);
        if ($stmt === false) {
            return false;
        }
        $sino = nl2br($sinopsis);
        $res = nl2br($resumen);
        $stmt->bind_param('sissssssssi', $titulo, $isbn, $autor, $sino, $genero, $genero2, $res, $serie, $pelicula, $banner, $id_libro);
        $stmt->execute();
    }

    /**
     * modificarLibroResumen($id_libro,$id_usuario,$resumen)
     * Función que se utilizara en modificarLibroResumen.php para añadir el resumen personal.
     *
     * @param
     *            $id_libro
     * @param
     *            $id_usuario
     * @param
     *            $resumen
     * @return boolean
     */
    public function modificarLibroResumen($id_libro, $id_usuario, $resumen)
    {
        $sql_query = "UPDATE libros SET resumen= ? , id_usuario= ? WHERE id_libro= ?";
        $stmt = $this->c->stmt_init();
        $stmt->prepare($sql_query);
        if ($stmt === false) {
            return false;
        }
        $res = nl2br($resumen);
        $stmt->bind_param('sii', $res, $id_usuario, $id_libro);
        $stmt->execute();
        $puntos = 4;
        $this->sumaPuntos($id_usuario, $puntos);
    }

    /**
     * modificarImgLibro($titulo,$img_portada,$id_libro)
     * Función que se utilizara en modificarLibro.php para modificar la imagen de un libro.
     *
     * @param
     *            $titulo
     * @param
     *            $img_portada
     * @param
     *            $id_libro
     * @return boolean
     */
    public function modificarImgLibro($titulo, $img_portada, $id_libro)
    {
        $titulo = $this->quitarCaracteres($titulo);
        $img = $this->modificarImg($titulo, $img_portada);
        $this->console_log($img);
        $sql_query = "UPDATE $this->tabla SET  " . "  img_portada = ?" . " WHERE id_libro= ?";
        
        $stmt = $this->c->stmt_init();
        $stmt->prepare($sql_query);
        if ($stmt === false) {
            return false;
        }
        $stmt->bind_param('si', $img, $id_libro);
        $stmt->execute();
    }

    /**
     * modificarImg($titulo,$archivo_img)
     * Función utilizada dentro de la función modificarImgLibro,para modificar la imagen de portada
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
        $lugar = '../img_libros/';
        // Validamos la imagen
        if ($img_name != NULL and $extension != NULL and $img_size != 0) {
            if ($img_size <= $_REQUEST['lim_tamano']) {
                $nombre_img = $this->normaliza($titulo . "." . $extension);
                $ruta = $lugar . $nombre_img;
                
                if (file_exists($ruta)) {
                    
                    if ($extension == "jpg") {
                        $extension = "png";
                        $this->console_log("Archivo a borrar" . $lugar . $this->normaliza($titulo . ".jpg"));
                        unlink($lugar . $this->normaliza($titulo . ".jpg"));
                    } else {
                        $extension = "jpg";
                        $this->console_log("Archivo a borrar" . $lugar . $this->normaliza($titulo . ".png"));
                        unlink($lugar . $this->normaliza($titulo . ".png"));
                    }
                    $nombre_img = $this->normaliza($titulo . "." . $extension);
                    $ruta = $lugar . $nombre_img;
                }
                
                // Guardamos la foto en la carpeta del proyecto "img_libros"
                move_uploaded_file($img_tmp_name, $ruta);
                // Declaramos la ruta de la imagen en la base de datos
                $rutaBD = $nombre_img;
            } else {
                $rutaOrigen = "../img_libros/libro_generico.jpg";
                $rutaFinal = $this->normaliza($lugar . $titulo . ".png");
                copy($rutaOrigen, $rutaFinal);
                $rutaBD = $this->normaliza($titulo . ".png");
            }
        } else { // en caso de que el usuario no inserte imagen
            $rutaOrigen = "../img_libros/libro_generico.jpg";
            $rutaFinal = $this->normaliza($lugar . $titulo . ".png");
            copy($rutaOrigen, $rutaFinal);
            $rutaBD = $this->normaliza($titulo . ".png");
        }
        return $rutaBD;
    }

    /**
     * addComentario($id_usuario,$id_libro,$comentario,$fecha_comentario)
     * Función que se utilizara en realizaComentario.php para añadir un comentario al libro.
     *
     * @param
     *            $id_usuario
     * @param
     *            $id_libro
     * @param
     *            $comentario
     * @param
     *            $fecha_comentario
     * @return boolean
     */
    public function addComentario($id_usuario, $id_libro, $comentario, $fecha_comentario)
    {
        $titulo = $this->nombreLibro($id_libro);
        $id_usuario_libro = $this->get_id_usuario_libro($titulo);
        $sql = "INSERT INTO usuarios_comentan_libros (id_usuario,id_libro,comentario,fecha_comentario) VALUES(?,?,?,?)";
        $sen = $this->c->prepare($sql);
        $comen = nl2br($comentario);
        $sen->bind_param("iiss", $id_usuario, $id_libro, $comen, $fecha_comentario);
        if ($sen->execute()) {
            $puntos = 2;
            $this->sumaPuntos($id_usuario, $puntos);
            $usuario = new Usuario();
            if ($id_usuario != $id_usuario_libro) {
                $usuario->enviarMailComentario($id_usuario_libro, $titulo);
                $usuario->enviarMensajeComentario($id_usuario_libro, $titulo);
            }
            return true; // Se ha creado con exito
        } else {
            return false; // No se ha podido crear
        }
    }

    /**
     * addVoto($id_usuario,$id_libro,$votacion)
     * Función que se utilizara en realizaVOtacion.php para añadir un voto al libro.
     *
     * @param
     *            $id_usuario
     * @param
     *            $id_libro
     * @param
     *            $votacion
     * @return boolean
     */
    public function addVoto($id_usuario, $id_libro, $votacion)
    {
        $sql = "INSERT INTO usuarios_votan_libros (id_usuario,id_libro,votacion) VALUES(?,?,?)";
        $sen = $this->c->prepare($sql);
        $sen->bind_param("iii", $id_usuario, $id_libro, $votacion);
        if ($sen->execute()) {
            $puntos = 1;
            $this->sumaPuntos($id_usuario, $puntos);
            return true; // Se ha creado con exito
        } else {
            
            return false; // No se ha podido crear
        }
    }

    /**
     * modificarComentario($id_libro,$id_usuario,$comentario)
     * Función que se utilizara en modificarComentario.php para modificar el comentario.
     *
     * @param
     *            $id_libro
     * @param
     *            $id_usuario
     * @param
     *            $comentario
     * @return boolean
     */
    public function modificarComentario($id_libro, $id_usuario, $comentario)
    {
        $sql_query = "UPDATE usuarios_comentan_libros SET comentario= ? WHERE id_usuario= ? AND id_libro= ?";
        $stmt = $this->c->stmt_init();
        $stmt->prepare($sql_query);
        if ($stmt === false) {
            return false;
        }
        $stmt->bind_param('sii', $comentario, $id_usuario, $id_libro);
        $stmt->execute();
    }

    /**
     * guardarImgLibro($titulo,$archivo_img):
     * Función utilizada dentro de la función addLibro,para guardar la imagen de portada
     *
     * @param
     *            $titulo
     * @param
     *            $archivo_img
     */
    public function guardarImgLibro($titulo, $archivo_img)
    {
        $titulo = $this->quitarCaracteres($titulo);
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
        $lugar = '../img_libros/';
        // Validamos la imagen
        if ($img_name != NULL and $extension != NULL and $img_size != 0) {
            if ($img_size <= $_REQUEST['lim_tamano']) {
                $nombre_img = $this->normaliza($titulo . "." . $extension);
                $ruta = $lugar . $nombre_img;
                // Guardamos la foto en la carpeta del proyecto "img_libros"
                move_uploaded_file($img_tmp_name, $ruta);
                // Declaramos la ruta de la imagen en la base de datos
                $rutaBD = $nombre_img;
            } else {
                $rutaOrigen = "../img_libros/libro_generico.jpg";
                $rutaFinal = $this->normaliza($lugar . $titulo . ".png");
                copy($rutaOrigen, $rutaFinal);
                $rutaBD = $this->normaliza($titulo . ".png");
            }
        } else { // en caso de que el usuario no inserte imagen
            $rutaOrigen = "../img_libros/libro_generico.jpg";
            $rutaFinal = $this->normaliza($lugar . $titulo . ".png");
            copy($rutaOrigen, $rutaFinal);
            $rutaBD = $this->normaliza($titulo . ".png");
        }
        return $rutaBD;
    }

    /**
     * mostrarLibro($id_libro)
     * Función utilizada en visorLibro.php,para mostrar todos los datos de un libro(título, autor, imagen, etc.)
     *
     * @param
     *            $id_libro
     */
    public function mostrarLibro($id_libro)
    {
        $votacion = $this->mostrarVotacion($id_libro);
        
        $sql = "SELECT A.id_libro,A.titulo,A.autor,A.genero,A.genero2,A.sinopsis,A.resumen,A.serie,A.pelicula,A.banner,B.nombre,B.nick FROM " . $this->tabla . " A, usuarios B WHERE A.id_usuario=B.id_usuario AND A.id_libro='" . $id_libro . "'";
        
        if ($this->c->real_query($sql)) {
            
            if ($resul = $this->c->store_result()) {
                
                // Si el usuario no se ha dado de baja
                if ($resul->num_rows > 0) {
                    while ($mostrar = $resul->fetch_assoc()) {
                        echo "<div class='descripcion'>
									<h4>Autor</h4> " . $mostrar["autor"] . "
									<h4>Genero/s</h4> " . $mostrar["genero"];
                        if ($mostrar["genero2"] != 'NULL' && $mostrar["genero2"] != 'cualquiera') {
                            echo ", " . $mostrar["genero2"];
                        } else {
                            echo "";
                        }
                        echo "<h4>Sinopsis</h4> " . $mostrar["sinopsis"];
                        
                        if ($mostrar["serie"] != "NULL" && $mostrar["serie"] !== "No" && $mostrar["serie"] !== "NO") {
                            echo "<h4>Serie/s</h4> " . $mostrar["serie"];
                        } else {
                            echo "";
                        }
                        if ($mostrar["pelicula"] != "NULL" && $mostrar["pelicula"] !== "No" && $mostrar["pelicula"] !== "NO") {
                            echo "<h4>Película/s</h4> " . $mostrar["pelicula"];
                        } else {
                            echo "";
                        }
                        if ($votacion != 0) {
                            echo "<h4>Votación</h4> " . $votacion . "/10";
                        }
                        if ($mostrar["banner"] != "NULL") {
                            echo "</br></br><h4 class='enlace_compra'>" . $mostrar["banner"] . "</h4>";
                        }
                        
                        if (isset($_SESSION['id_usuario'])) {
                            $idusuario = $_SESSION['id_usuario'];
                        }
                        
                        echo "<a href='../FormularioVotarLibro/?libro=" . $id_libro . "' class='boton separado' title='Vota el libro'>¡Vota!</a>";
                        
                        if (isset($_SESSION['id_usuario']) && isset($_SESSION['datos']['tipo_usuario']) && isset($_SESSION['datos'])) {
                            $tipo_usuario = $_SESSION['datos']['tipo_usuario'];
                            if ($tipo_usuario == 2) {
                                echo "<a href='../FormularioEditarLibro/?libro=" . $id_libro . "' class='boton separado' title='Modifica el libro'>Editar</a>";
                            }
                        }
                        echo "</div></div>";
                        
                        // libro::mostrarLibrosRelacionados($mostrar["genero"],$mostrar["genero2"],$mostrar["autor"],$id_libro);
                        
                        echo "<h2>Resumen personal</h2>";
                        
                        if ($mostrar["resumen"] == "¡Sé el primero en leerte el libro y subir tu resumen personal!") {
                            echo "<div class='resumen'>" . $mostrar["resumen"] . "</div>";
                            
                            if (isset($_SESSION['id_usuario']) && isset($_SESSION['datos']['tipo_usuario']) && isset($_SESSION['datos'])) {
                                if ($tipo_usuario == 2 || $tipo_usuario == 1) {
                                    echo "<center><a href='../FormularioEditarResumen/?libro=" . $id_libro . "' class='boton' title='Añadir Resumen'>Añadir resumen</a></center>";
                                }
                            }
                        } else {
                            echo "<div class='resumen'><h4>" . $mostrar["nick"] . "</h4> " . $mostrar["resumen"] . "</div>";
                        }
                    }
                    $resul->free_result();
                } // Si el usuario se ha dado de baja
                else {
                    $sql1 = "SELECT A.id_libro,A.titulo,A.autor,A.genero,A.genero2,A.sinopsis,A.resumen,A.serie,A.pelicula,A.banner FROM " . $this->tabla . " A WHERE A.id_libro='" . $id_libro . "'";
                    
                    if ($this->c->real_query($sql1)) {
                        
                        if ($resul = $this->c->store_result()) {
                            
                            // Si el usuario no se ha dado de baja
                            if ($resul->num_rows > 0) {
                                while ($mostrar = $resul->fetch_assoc()) {
                                    echo "<div class='descripcion'>
									<h4>Autor</h4> " . $mostrar["autor"] . "
									<h4>Genero/s</h4> " . $mostrar["genero"];
                                    if ($mostrar["genero2"] != 'NULL' && $mostrar["genero2"] != 'cualquiera') {
                                        echo ", " . $mostrar["genero2"];
                                    } else {
                                        echo "";
                                    }
                                    echo "<h4>Sinopsis</h4> " . $mostrar["sinopsis"];
                                    
                                    if ($mostrar["serie"] != "NULL" && $mostrar["serie"] !== "No" && $mostrar["serie"] !== "NO") {
                                        echo "<h4>Serie/s</h4> " . $mostrar["serie"];
                                    } else {
                                        echo "";
                                    }
                                    if ($mostrar["pelicula"] != "NULL" && $mostrar["pelicula"] !== "No" && $mostrar["pelicula"] !== "NO") {
                                        echo "<h4>Película/s</h4> " . $mostrar["pelicula"];
                                    } else {
                                        echo "";
                                    }
                                    if ($votacion != 0) {
                                        echo "<h4>Votación</h4> " . $votacion . "/10";
                                    }
                                    if ($mostrar["banner"] != "NULL") {
                                        echo "</br></br><h4 class='enlace_compra'>" . $mostrar["banner"] . "</h4>";
                                    }
                                    
                                    if (isset($_SESSION['id_usuario'])) {
                                        $idusuario = $_SESSION['id_usuario'];
                                    }
                                    
                                    echo "<a href='../FormularioVotarLibro/?libro=" . $id_libro . "' class='boton separado' title='Vota el libro'>¡Vota!</a>";
                                    
                                    if (isset($_SESSION['id_usuario']) && isset($_SESSION['datos']['tipo_usuario']) && isset($_SESSION['datos'])) {
                                        $tipo_usuario = $_SESSION['datos']['tipo_usuario'];
                                        if ($tipo_usuario == 2) {
                                            echo "<a href='../FormularioEditarLibro/?libro=" . $id_libro . "' class='boton separado' title='Modifica el libro'>Editar</a>";
                                        }
                                    }
                                    echo "</div></div>";
                                    
                                    // libro::mostrarLibrosRelacionados($mostrar["genero"],$mostrar["genero2"],$mostrar["autor"],$id_libro);
                                    
                                    echo "<h2>Resumen personal</h2>";
                                    
                                    if ($mostrar["resumen"] == "¡Sé el primero en leerte el libro y subir tu resumen personal!") {
                                        echo "<div class='resumen'>" . $mostrar["resumen"] . "</div>";
                                        
                                        if (isset($_SESSION['id_usuario']) && isset($_SESSION['datos']['tipo_usuario']) && isset($_SESSION['datos'])) {
                                            if ($tipo_usuario == 2 || $tipo_usuario == 1) {
                                                echo "<center><a href='../FormularioEditarResumen/?libro=" . $id_libro . "' class='boton' title='Añadir Resumen'>Añadir resumen</a></center>";
                                            }
                                        }
                                    } else {
                                        echo "<div class='resumen'><h4>Anónimo</h4> " . $mostrar["resumen"] . "</div>";
                                    }
                                }
                                $resul->free_result();
                            }
                        }
                    } else {
                        echo $this->c->errno . " -> " . $this->c->error;
                    }
                }
            }
        } else {
            echo $this->c->errno . " -> " . $this->c->error;
        }
    }

    /**
     * mostrarLibrosRelacionados($genero, $genero2, $autor, $id_libro)
     * Muestra los libros relacionados con el que se muestra
     *
     * @param
     *            $genero
     * @param
     *            $genero2
     * @param
     *            $autor
     * @param
     *            $id_libro
     */
    public function mostrarLibrosRelacionados($genero, $genero2, $autor, $id_libro)
    {
        $this->console_log($genero);
        $this->console_log($genero2);
        $this->console_log($autor);
        $this->console_log($id_libro);
        $resultados = $this->buscarLibrosRelacionados($genero, $genero2, $autor, $id_libro);
        if ($resultados['numero'] == 5) {
            echo "<h2>Te pueden interesar...</h2>";
            echo "<div class='ultimosSubidos'><ul class='temas_flex libros_pequenos'>";
            for ($i = 0; $i < count($resultados['filas_consulta']); $i ++) {
                foreach ($resultados['filas_consulta'][$i] as $key => $value) {
                    if ($key == "id_libro") {
                        $id_libro_actual = $value;
                    } elseif ($key == "img_portada") {
                        $img_portada = $value;
                    } elseif ($key == "titulo") {
                        $titulo = $value;
                        $myvar = str_replace(" ", "-", $titulo);
                    }
                }
                echo "<li><a href='../Libro/" . $myvar . "'><img src='../img_libros/" . $img_portada . "' alt='" . $titulo . "' title='" . $titulo . "'/></a></li>";
            }
            echo "</ul></div>";
        }
    }

    /**
     * buscarLibrosRelacionados($genero, $genero2, $autor, $id_libro)
     * busca 5 libros relacionados por autor o género con el que se muestra (Gracias Mate!)
     *
     * @param
     *            $genero
     * @param
     *            $genero2
     * @param
     *            $autor
     * @param
     *            $id_libro
     * @return $datos
     */
    public function buscarLibrosRelacionados($genero, $genero2, $autor, $id_libro)
    {
        $c = Connection::dameInstancia();
        $conexion = $c->dameConexion();
        $consulta = "SELECT (CASE WHEN t.autor='" . $autor . "' THEN 1 WHEN t.genero='" . $genero . "' THEN 2 ELSE 3 END) as orden, t.* FROM libros t WHERE ( t.autor='" . $autor . "' or t.genero in ('" . $genero . "', '" . $genero2 . "') or t.genero2 in ('" . $genero . "', '" . $genero2 . "') ) and t.id_libro!='" . $id_libro . "' ORDER BY 1,2 limit 5";
        $resultado = $conexion->query($consulta);
        if ($resultado->num_rows != 0) {
            while ($row = $resultado->fetch_assoc()) {
                $rows[] = $row;
            }
            $datos = array(
                'numero' => $resultado->num_rows,
                'filas_consulta' => $rows
            );
            return $datos;
        } else {
            return $datos = array(
                'numero' => 0
            );
        }
    }

    /**
     * libro_del_dia()
     * Función utilizada en index.php,para mostrar un libro aleatorio cada vez que entremos en la página
     */
    public function libro_del_dia()
    {
        // Mostrará cada vez un registro distinto
        $sql = "SELECT id_libro,titulo,autor,genero,sinopsis,genero2,img_portada FROM " . $this->tabla . " ORDER BY RAND() LIMIT 1";
        if ($this->c->real_query($sql)) {
            if ($resul = $this->c->store_result()) {
                if ($resul->num_rows > 0) {
                    echo "<div class='libroRand'>";
                    while ($mostrar = $resul->fetch_assoc()) {
                        $myvar = str_replace(" ", "-", $mostrar["titulo"]);
                        echo "<div class='imagenRand'>" . "<a href='Libro/" . $myvar . "'><img src='./img_libros/" . $mostrar['img_portada'] . "' alt='" . $mostrar["titulo"] . "'  title='" . $mostrar["titulo"] . "'/></a>" . "</div>";
                        echo "<div class='descripcionRand'>" . "<h4>Título</h4> " . $mostrar["titulo"] . "" . "<h4>Sinopsis</h4> " . $mostrar["sinopsis"] . "" . "<h4>Autor</h4> " . $mostrar["autor"] . "" . "<h4>Genero/s</h4> " . $mostrar["genero"];
                        if ($mostrar["genero2"] != 'NULL') {
                            echo ", " . $mostrar["genero2"];
                        } else {
                            echo "";
                        }
                        echo "</div>";
                    }
                    echo "</div>";
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
     * mostrarVotacion($id_libro)
     * Función utilizada dentro de la función mostrarLibro(),para mostrar la votación media de cada libro
     *
     * @param
     *            $id_libro
     * @return $row['votacion'] La media de la votación
     */
    public function mostrarVotacion($id_libro)
    {
        $c = Connection::dameInstancia();
        $conexion = $c->dameConexion();
        $consulta = "SELECT avg(votacion) as votacion from usuarios_votan_libros where id_libro=" . $id_libro;
        $resultado = $conexion->query($consulta);
        $row = $resultado->fetch_assoc();
        return round($row['votacion'], 1);
    }

    /**
     * mostrarComentarios($id_libro)
     * Función utilizada en visorLibro.php,para mostrar todos los comentario de un libro
     *
     * @param
     *            $id_libro
     */
    public function mostrarComentarios($id_libro)
    {
        $sql = "SELECT A.comentario,A.votacion,A.fecha_comentario,B.nombre,B.nick FROM  usuarios_comentan_libros A, usuarios B WHERE id_libro='" . $id_libro . "' AND A.id_usuario=B.id_usuario ORDER BY fecha_comentario";
        if ($this->c->real_query($sql)) {
            if ($resul = $this->c->store_result()) {
                if ($resul->num_rows > 0) {
                    while ($mostrar = $resul->fetch_assoc()) {
                        echo "<div class='comentarios'>
									<h4>" . $mostrar["nick"] . "</h4>
									" . $mostrar["comentario"] . "
									<h4> " . $mostrar["fecha_comentario"] . "</h4>";
                        echo "</div>";
                    }
                    $resul->free_result();
                } else {
                    $resul->free_result();
                    echo "<div class='comentarios'>No hay comentarios para este libro, ¡sé el primero!</div>";
                }
            }
        } else {
            echo $this->c->errno . " -> " . $this->c->error;
        }
    }

    /**
     * nombreLibro($id)
     * Función que devuelve el nombre de un libro a partir de su id.
     *
     * @param
     *            $id
     * @return $mostrar["titulo"] el título del libro
     */
    public function nombreLibro($id)
    {
        $sql = "SELECT titulo FROM " . $this->tabla . " WHERE id_libro='" . $id . "'";
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
     * get_isbn($id)
     * Función que devuelve el número isbn de un libro a partir de su id.
     *
     * @param
     *            $id
     * @return $mostrar["isbn"] el número isbn del libro
     */
    public function get_isbn($id)
    {
        $sql = "SELECT isbn FROM " . $this->tabla . " WHERE id_libro='" . $id . "'";
        if ($this->c->real_query($sql)) {
            if ($resul = $this->c->store_result()) {
                $mostrar = $resul->fetch_assoc();
                return $mostrar["isbn"];
            }
        } else {
            echo $this->c->errno . " -> " . $this->c->error;
        }
    }

    /**
     * get_autor($id)
     * Función que devuelve el autor de un libro a partir de su id.
     *
     * @param
     *            $id
     * @return $mostrar["autor"] el autor del libro
     */
    public function get_autor($id)
    {
        $sql = "SELECT autor FROM " . $this->tabla . " WHERE id_libro='" . $id . "'";
        if ($this->c->real_query($sql)) {
            if ($resul = $this->c->store_result()) {
                $mostrar = $resul->fetch_assoc();
                return $mostrar["autor"];
            }
        } else {
            echo $this->c->errno . " -> " . $this->c->error;
        }
    }

    /**
     * get_genero($id)
     * Función que devuelve el género de un libro a partir de su id.
     *
     * @param
     *            $id
     * @return $mostrar["genero"] el género del libro
     */
    public function get_genero($id)
    {
        $sql = "SELECT genero FROM " . $this->tabla . " WHERE id_libro='" . $id . "'";
        if ($this->c->real_query($sql)) {
            if ($resul = $this->c->store_result()) {
                $mostrar = $resul->fetch_assoc();
                return $mostrar["genero"];
            }
        } else {
            echo $this->c->errno . " -> " . $this->c->error;
        }
    }

    /**
     * get_genero2($id)
     * Función que devuelve el género2 de un libro a partir de su id.
     *
     * @param
     *            $id
     * @return $mostrar["genero2"] el género2 del libro
     */
    public function get_genero2($id)
    {
        $sql = "SELECT genero2 FROM " . $this->tabla . " WHERE id_libro='" . $id . "'";
        if ($this->c->real_query($sql)) {
            if ($resul = $this->c->store_result()) {
                $mostrar = $resul->fetch_assoc();
                return $mostrar["genero2"];
            }
        } else {
            echo $this->c->errno . " -> " . $this->c->error;
        }
    }

    /**
     * get_sinopsis($id)
     * Función que devuelve la sinopsis de un libro a partir de su id.
     *
     * @param
     *            $id
     * @return $mostrar["sinopsis"] la sinopsis del libro
     */
    public function get_sinopsis($id)
    {
        $sql = "SELECT sinopsis FROM " . $this->tabla . " WHERE id_libro='" . $id . "'";
        if ($this->c->real_query($sql)) {
            if ($resul = $this->c->store_result()) {
                $mostrar = $resul->fetch_assoc();
                return $mostrar["sinopsis"];
            }
        } else {
            echo $this->c->errno . " -> " . $this->c->error;
        }
    }

    /**
     * get_resumen($id)
     * Función que devuelve el resumen de un libro a partir de su id.
     *
     * @param
     *            $id
     * @return $mostrar["resumen"] el resumen del libro
     */
    public function get_resumen($id)
    {
        $sql = "SELECT resumen FROM " . $this->tabla . " WHERE id_libro='" . $id . "'";
        if ($this->c->real_query($sql)) {
            if ($resul = $this->c->store_result()) {
                $mostrar = $resul->fetch_assoc();
                return $mostrar["resumen"];
            }
        } else {
            echo $this->c->errno . " -> " . $this->c->error;
        }
    }

    /**
     * get_banner($id)
     * Función que devuelve el banner de un libro a partir de su id.
     *
     * @param
     *            $id
     * @return $mostrar["banner"] el resumen del libro
     */
    public function get_banner($id)
    {
        $sql = "SELECT banner FROM " . $this->tabla . " WHERE id_libro='" . $id . "'";
        if ($this->c->real_query($sql)) {
            if ($resul = $this->c->store_result()) {
                $mostrar = $resul->fetch_assoc();
                return $mostrar["banner"];
            }
        } else {
            echo $this->c->errno . " -> " . $this->c->error;
        }
    }

    /**
     * get_serie($id)
     * Función que devuelve la serie de un libro a partir de su id.
     *
     * @param
     *            $id
     * @return $mostrar["serie"] la serie del libro
     */
    public function get_serie($id)
    {
        $sql = "SELECT serie FROM " . $this->tabla . " WHERE id_libro='" . $id . "'";
        if ($this->c->real_query($sql)) {
            if ($resul = $this->c->store_result()) {
                $mostrar = $resul->fetch_assoc();
                return $mostrar["serie"];
            }
        } else {
            echo $this->c->errno . " -> " . $this->c->error;
        }
    }

    /**
     * get_pelicula($id)
     * Función que devuelve la película de un libro a partir de su id.
     *
     * @param
     *            $id
     * @return $mostrar["pelicula"] la película del libro
     */
    public function get_pelicula($id)
    {
        $sql = "SELECT pelicula FROM " . $this->tabla . " WHERE id_libro='" . $id . "'";
        if ($this->c->real_query($sql)) {
            if ($resul = $this->c->store_result()) {
                $mostrar = $resul->fetch_assoc();
                return $mostrar["pelicula"];
            }
        } else {
            echo $this->c->errno . " -> " . $this->c->error;
        }
    }

    /**
     * get_imagen($id)
     * Función que devuelve la imagen de un libro a partir de su id.
     *
     * @param
     *            $id
     * @return $mostrar["img_portada"] la imagen del libro
     */
    public function get_imagen($id)
    {
        $sql = "SELECT img_portada FROM " . $this->tabla . " WHERE id_libro='" . $id . "'";
        if ($this->c->real_query($sql)) {
            if ($resul = $this->c->store_result()) {
                $mostrar = $resul->fetch_assoc();
                return $mostrar["img_portada"];
            }
        } else {
            echo $this->c->errno . " -> " . $this->c->error;
        }
    }

    /**
     * get_id($titulo)
     * Función que devuelve el id de un libro a partir de su titulo.
     *
     * @param
     *            $titulo
     * @return $mostrar["id"] el del libro
     */
    public function get_id($titulo)
    {
        $sql = "SELECT id_libro FROM " . $this->tabla . " WHERE titulo='" . $titulo . "'";
        if ($this->c->real_query($sql)) {
            if ($resul = $this->c->store_result()) {
                $mostrar = $resul->fetch_assoc();
                return $mostrar["id_libro"];
            }
        } else {
            echo $this->c->errno . " -> " . $this->c->error;
        }
    }

    /**
     * get_id_usuario_libro($titulo)
     * Función que devuelve el id de un libro a partir de su titulo.
     *
     * @param
     *            $titulo
     * @return $mostrar["id"] el del libro
     */
    public function get_id_usuario_libro($titulo)
    {
        $sql = "SELECT id_usuario FROM " . $this->tabla . " WHERE titulo='" . $titulo . "'";
        if ($this->c->real_query($sql)) {
            if ($resul = $this->c->store_result()) {
                $mostrar = $resul->fetch_assoc();
                return $mostrar["id_usuario"];
            }
        } else {
            echo $this->c->errno . " -> " . $this->c->error;
        }
    }

    /**
     * get_comentario($id_libro,$id_usuario)
     * Función utilizada en modificarComentario.php que devuelve el comentario de un usuario de un libro.
     *
     * @param
     *            $id_libro,$id_usuario
     * @return $mostrar["comentario"] el comentario del libro
     */
    public function get_comentario($id_libro, $id_usuario)
    {
        $c = Connection::dameInstancia();
        $conexion = $c->dameConexion();
        $consulta = "SELECT comentario FROM usuarios_comentan_libros WHERE id_libro='" . $id_libro . "' AND id_usuario='" . $id_usuario . "'";
        $resultado = $conexion->query($consulta);
        if ($resultado->num_rows != 0) {
            $mostrar = $resultado->fetch_assoc();
            return $mostrar["comentario"];
        }
    }

    /**
     * get_votacion($id_libro,$id_usuario)
     * Función utilizada en modificarComentario.php que devuelve la votación de un usuario de un libro.
     *
     * @param
     *            $id_libro,$id_usuario
     * @return $mostrar["votacion"] la votación del libro
     */
    public function get_votacion($id_libro, $id_usuario)
    {
        $c = Connection::dameInstancia();
        $conexion = $c->dameConexion();
        $consulta = "SELECT votacion FROM usuarios_comentan_libros WHERE id_libro='" . $id_libro . "' AND id_usuario='" . $id_usuario . "'";
        $resultado = $conexion->query($consulta);
        if ($resultado->num_rows != 0) {
            $mostrar = $resultado->fetch_assoc();
            return $mostrar["votacion"];
        }
    }

    /**
     * buscarTitulo($cadena):
     * Función utilizada en buscador.php y que devuelve un array con el numero de resultados de la consulta como primer parametro
     * y los resultados de la misma como segundo como $clave => $valor.
     *
     * @param
     *            $cadena
     * @return $datos
     */
    public static function buscarTitulo( $cadena )
    {
        $c = Connection::dameInstancia();
        $conexion = $c->dameConexion();
        $consulta = "Select * from libros where titulo like '%" . $cadena . "%' OR autor like '%" . $cadena . "%' OR genero like '%" . $cadena . "%' ORDER BY titulo ASC";
        $resultado = $conexion->query($consulta);
        if ($resultado->num_rows != 0) {
            while ($row = $resultado->fetch_assoc()) {
                $rows[] = $row;
            }
            $datos = array(
                'numero' => $resultado->num_rows,
                'filas_consulta' => $rows
            );
            return $datos;
        } else {
            return $datos = array(
                'numero' => 0
            );
        }
    }
    
    /**
     * buscarTituloLimit( $cadena, $inicio,$TAMANO_PAGINA ):
     * Función utilizada en buscador.php y que devuelve un array con el numero de resultados de la consulta como primer parametro
     * y los resultados de la misma como segundo como $clave => $valor. Con LIMIT
     *
     * @param
     *            $cadena
     * @param
     *            $inicio
     *  @param
     *            $TAMANO_PAGINA
     * @return $datos
     */
    public static function buscarTituloLimit( $cadena, $inicio,$TAMANO_PAGINA )
    {
        $c = Connection::dameInstancia();
        $conexion = $c->dameConexion();
        $consulta = "Select * from libros where titulo like '%" . $cadena . "%' OR autor like '%" . $cadena . "%' OR genero like '%" . $cadena . "%' ORDER BY titulo ASC LIMIT " . $inicio . "," . $TAMANO_PAGINA;
        $resultado = $conexion->query($consulta);
        if ($resultado->num_rows != 0) {
            while ($row = $resultado->fetch_assoc()) {
                $rows[] = $row;
            }
            $datos = array(
                'numero' => $resultado->num_rows,
                'filas_consulta' => $rows
            );
            return $datos;
        } else {
            return $datos = array(
                'numero' => 0
            );
        }
    }

    /**
     * buscarLibro($titulo,$autor,$isbn,$genero):
     * Función utilizada en buscadorAvanzado.php y que devuelve un array con el numero de resultados de las consultas como primer parametro
     * y los resultados de la misma como segundo como $clave => $valor.
     * Podremos buscar por un parámetro, dos, tres o los cuatro.
     *
     * @param
     *            $titulo
     * @param
     *            $autor
     * @param
     *            $isbn
     * @param
     *            $genero
     * @return $datos
     */
    public static function buscarLibro($titulo, $autor, $isbn, $genero)
    {
        $c = Connection::dameInstancia();
        $conexion = $c->dameConexion();
        if (! empty($titulo)) {
            if (! empty($autor)) {
                if (! empty($isbn)) {
                    if ($genero != "cualquiera") {
                        $consulta = "Select * from libros where titulo like '%" . $titulo . "%' AND autor like '%" . $autor . "%' AND isbn='" . $isbn . "' AND (genero='" . $genero . "' OR genero2='" . $genero . "') ORDER BY titulo ASC";
                    } else {
                        $consulta = "Select * from libros where titulo like '%" . $titulo . "%' AND autor like '%" . $autor . "%' AND isbn='" . $isbn . "' ORDER BY titulo ASC";
                    }
                } else {
                    if ($genero != "cualquiera") {
                        $consulta = "Select * from libros where titulo like '%" . $titulo . "%' AND autor like '%" . $autor . "%' AND (genero='" . $genero . "' OR genero2='" . $genero . "') ORDER BY titulo ASC";
                    } else {
                        $consulta = "Select * from libros where titulo like '%" . $titulo . "%' AND autor like '%" . $autor . "%' ORDER BY titulo ASC";
                    }
                }
            } else {
                if (! empty($isbn)) {
                    if ($genero != "cualquiera") {
                        $consulta = "Select * from libros where titulo like '%" . $titulo . "%' AND isbn='" . $isbn . "' AND (genero='" . $genero . "' OR genero2='" . $genero . "') ORDER BY titulo ASC";
                    } else {
                        $consulta = "Select * from libros where titulo like '%" . $titulo . "%' AND isbn='" . $isbn . "' ORDER BY titulo ASC";
                    }
                } else {
                    if ($genero != "cualquiera") {
                        $consulta = "Select * from libros where titulo like '%" . $titulo . "%' AND (genero='" . $genero . "' OR genero2='" . $genero . "') ORDER BY titulo ASC";
                    } else {
                        $consulta = "Select * from libros where titulo like '%" . $titulo . "%' ORDER BY titulo ASC";
                    }
                }
            }
        } else {
            if (! empty($autor)) {
                if (! empty($isbn)) {
                    if ($genero != "cualquiera") {
                        $consulta = "Select * from libros where autor like '%" . $autor . "%' AND isbn='" . $isbn . "' AND (genero='" . $genero . "' OR genero2='" . $genero . "') ORDER BY titulo ASC";
                    } else {
                        $consulta = "Select * from libros where autor like '%" . $autor . "%' AND isbn='" . $isbn . "' ORDER BY titulo ASC";
                    }
                } else {
                    if ($genero != "cualquiera") {
                        $consulta = "Select * from libros where autor like '%" . $autor . "%' AND (genero='" . $genero . "' OR genero2='" . $genero . "') ORDER BY titulo ASC";
                    } else {
                        $consulta = "Select * from libros where autor like '%" . $autor . "%' ORDER BY titulo ASC";
                    }
                }
            } else {
                if (! empty($isbn)) {
                    if ($genero != "cualquiera") {
                        $consulta = "Select * from libros where isbn='" . $isbn . "' AND (genero='" . $genero . "' OR genero2='" . $genero . "') ORDER BY titulo ASC";
                    } else {
                        $consulta = "Select * from libros where isbn='" . $isbn . "' ORDER BY titulo ASC";
                    }
                } else {
                    if ($genero != "cualquiera") {
                        $consulta = "Select * from libros where genero='" . $genero . "' OR genero2='" . $genero . "' ORDER BY titulo ASC";
                    } else {
                        $consulta = "Select * from libros ORDER BY titulo ASC";
                    }
                }
            }
        }
        $resultado = $conexion->query($consulta);
        if ($resultado->num_rows != 0) {
            while ($row = $resultado->fetch_assoc()) {
                $rows[] = $row;
            }
            $datos = array(
                'numero' => $resultado->num_rows,
                'filas_consulta' => $rows
            );
            return $datos;
        } else {
            return $datos = array(
                'numero' => 0
            );
        }
    }
    
    /**
     * buscarLibroLimit($titulo,$autor,$isbn,$genero,$inicio,$TAMANO_PAGINA):
     * Función utilizada en buscadorAvanzado.php y que devuelve un array con el numero de resultados de las consultas como primer parametro
     * y los resultados de la misma como segundo como $clave => $valor.
     * Podremos buscar por un parámetro, dos, tres o los cuatro. Con LIMIT
     *
     * @param
     *            $titulo
     * @param
     *            $autor
     * @param
     *            $isbn
     * @param
     *            $genero
     * @param
     *            $inicio
     * @param
     *            $TAMANO_PAGINA
     * @return $datos
     */
    public static function buscarLibroLimit($titulo, $autor, $isbn, $genero, $inicio, $TAMANO_PAGINA) 
    {
        $c = Connection::dameInstancia();
        $conexion = $c->dameConexion();
        if (! empty($titulo)) {
            if (! empty($autor)) {
                if (! empty($isbn)) {
                    if ($genero != "cualquiera") {
                        $consulta = "Select * from libros where titulo like '%" . $titulo . "%' AND autor like '%" . $autor . "%' AND isbn='" . $isbn . "' AND (genero='" . $genero . "' OR genero2='" . $genero . "') ORDER BY titulo ASC LIMIT " . $inicio . "," . $TAMANO_PAGINA;
                    } else {
                        $consulta = "Select * from libros where titulo like '%" . $titulo . "%' AND autor like '%" . $autor . "%' AND isbn='" . $isbn . "' ORDER BY titulo ASC LIMIT " . $inicio . "," . $TAMANO_PAGINA;
                    }
                } else {
                    if ($genero != "cualquiera") {
                        $consulta = "Select * from libros where titulo like '%" . $titulo . "%' AND autor like '%" . $autor . "%' AND (genero='" . $genero . "' OR genero2='" . $genero . "') ORDER BY titulo ASC LIMIT " . $inicio . "," . $TAMANO_PAGINA;
                    } else {
                        $consulta = "Select * from libros where titulo like '%" . $titulo . "%' AND autor like '%" . $autor . "%' ORDER BY titulo ASC LIMIT " . $inicio . "," . $TAMANO_PAGINA;
                    }
                }
            } else {
                if (! empty($isbn)) {
                    if ($genero != "cualquiera") {
                        $consulta = "Select * from libros where titulo like '%" . $titulo . "%' AND isbn='" . $isbn . "' AND (genero='" . $genero . "' OR genero2='" . $genero . "') ORDER BY titulo ASC LIMIT " . $inicio . "," . $TAMANO_PAGINA;
                    } else {
                        $consulta = "Select * from libros where titulo like '%" . $titulo . "%' AND isbn='" . $isbn . "' ORDER BY titulo ASC LIMIT " . $inicio . "," . $TAMANO_PAGINA;
                    }
                } else {
                    if ($genero != "cualquiera") {
                        $consulta = "Select * from libros where titulo like '%" . $titulo . "%' AND (genero='" . $genero . "' OR genero2='" . $genero . "') ORDER BY titulo ASC LIMIT " . $inicio . "," . $TAMANO_PAGINA;
                    } else {
                        $consulta = "Select * from libros where titulo like '%" . $titulo . "%' ORDER BY titulo ASC LIMIT " . $inicio . "," . $TAMANO_PAGINA;
                    }
                }
            }
        } else {
            if (! empty($autor)) {
                if (! empty($isbn)) {
                    if ($genero != "cualquiera") {
                        $consulta = "Select * from libros where autor like '%" . $autor . "%' AND isbn='" . $isbn . "' AND (genero='" . $genero . "' OR genero2='" . $genero . "') ORDER BY titulo ASC LIMIT " . $inicio . "," . $TAMANO_PAGINA;
                    } else {
                        $consulta = "Select * from libros where autor like '%" . $autor . "%' AND isbn='" . $isbn . "' ORDER BY titulo ASC LIMIT " . $inicio . "," . $TAMANO_PAGINA;
                    }
                } else {
                    if ($genero != "cualquiera") {
                        $consulta = "Select * from libros where autor like '%" . $autor . "%' AND (genero='" . $genero . "' OR genero2='" . $genero . "') ORDER BY titulo ASC LIMIT " . $inicio . "," . $TAMANO_PAGINA;
                    } else {
                        $consulta = "Select * from libros where autor like '%" . $autor . "%' ORDER BY titulo ASC LIMIT " . $inicio . "," . $TAMANO_PAGINA;
                    }
                }
            } else {
                if (! empty($isbn)) {
                    if ($genero != "cualquiera") {
                        $consulta = "Select * from libros where isbn='" . $isbn . "' AND (genero='" . $genero . "' OR genero2='" . $genero . "') ORDER BY titulo ASC LIMIT " . $inicio . "," . $TAMANO_PAGINA;
                    } else {
                        $consulta = "Select * from libros where isbn='" . $isbn . "' ORDER BY titulo ASC LIMIT " . $inicio . "," . $TAMANO_PAGINA;
                    }
                } else {
                    if ($genero != "cualquiera") {
                        $consulta = "Select * from libros where genero='" . $genero . "' OR genero2='" . $genero . "' ORDER BY titulo ASC LIMIT " . $inicio . "," . $TAMANO_PAGINA;
                    } else {
                        $consulta = "Select * from libros ORDER BY titulo ASC LIMIT " . $inicio . "," . $TAMANO_PAGINA;
                    }
                }
            }
        }
        $resultado = $conexion->query($consulta);
        if ($resultado->num_rows != 0) {
            while ($row = $resultado->fetch_assoc()) {
                $rows[] = $row;
            }
            $datos = array(
                'numero' => $resultado->num_rows,
                'filas_consulta' => $rows
            );
            return $datos;
        } else {
            return $datos = array(
                'numero' => 0
            );
        }
    }

    /**
     * libros_mejor_valorados():
     * Función utilizada en index.php y que devuelve los 5 libros mejor valorados.
     *
     * @return $rows
     */
    public static function libros_mejor_valorados()
    {
        $c = Connection::dameInstancia();
        $conexion = $c->dameConexion();
        $consulta = "select libros.id_libro,libros.titulo,libros.fecha_subida,libros.img_portada,avg(usuarios_votan_libros.votacion) from libros, usuarios_votan_libros where usuarios_votan_libros.id_libro=libros.id_libro group by libros.id_libro having count(usuarios_votan_libros.votacion) > 1 order by avg(usuarios_votan_libros.votacion) DESC LIMIT 5";
        $resultado = $conexion->query($consulta);
        if ($resultado->num_rows == 0) {
            return 0;
        } else {
            while ($row = $resultado->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        }
    }

    /**
     * imprimir_libro_mv($rows):
     * Función utilizada en index.php y que muestra la imagen de los libros en una lista.
     * Las imágenes serán un enlace que te llevará a visorLibro.php
     *
     * @param
     *            $value
     * @return $rows
     */
    public static function imprimir_libro_mv($value)
    {
        $myvar = str_replace(" ", "-", $value["titulo"]);
        echo "<li><a href='Libro/" . $myvar . "'><img src='./img_libros/" . $value['img_portada'] . "' alt='" . $value["titulo"] . "'  title='" . $value["titulo"] . "'/></a></li>";
    }

    public static function getVotos($value)
    {
        $c = Connection::dameInstancia();
        $conexion = $c->dameConexion();
        $consulta = "SELECT COUNT(*) AS total FROM libros, usuarios_votan_libros WHERE libros.id_libro=usuarios_votan_libros .id_libro AND libros.id_libro='" . $value["id_libro"] . "'";
        $resultado = $conexion->query($consulta);
        if ($resultado->num_rows != 0) {
            $mostrar = $resultado->fetch_assoc();
            Libro::console_log($mostrar["total"]);
            return $mostrar["total"];
        }
    }

    /**
     * ultimos_libros_subidos():
     * Función utilizada en index.php y que devuelve los últimos 5 libros subidos.
     * Luego los mostraremos con imprimir_ultimos_libros_subidos($rows)
     */
    public static function ultimos_libros_subidos()
    {
        $c = Connection::dameInstancia();
        $conexion = $c->dameConexion();
        $consulta = "SELECT img_portada,titulo,id_libro FROM libros WHERE NOT resumen = '¡Sé el primero en leerte el libro y subir tu resumen personal!' order by fecha_subida DESC,  id_libro DESC LIMIT 5";
        $resultado = $conexion->query($consulta);
        $titulo_antiguo = "";
        while ($row = $resultado->fetch_assoc()) {
            $rows[] = $row;
        }
        Libro::imprimir_ultimos_libros_subidos($rows);
    }

    /**
     * novedades():
     * Función utilizada en index.php y que devuelve las últimas novedades.
     * Luego los mostraremos con imprimir_ultimos_libros_subidos($rows)
     */
    public static function novedades()
    {
        $c = Connection::dameInstancia();
        $conexion = $c->dameConexion();
        $consulta = "SELECT img_portada,titulo,id_libro,resumen FROM libros WHERE resumen = '¡Sé el primero en leerte el libro y subir tu resumen personal!' order by fecha_subida DESC, id_libro DESC LIMIT 5";
        $resultado = $conexion->query($consulta);
        $titulo_antiguo = "";
        while ($row = $resultado->fetch_assoc()) {
            $rows[] = $row;
        }
        Libro::imprimir_ultimos_libros_subidos($rows);
    }

    /**
     * imprimir_ultimos_libros_subidos($rows):
     * Función utilizada dentro de ultimos_libros_subidos() y que muestra la imagen de los libros en una lista.
     * Las imágenes serán un enlace que te llevará a visorLibro.php
     *
     * @param
     *            $rows
     */
    private static function imprimir_ultimos_libros_subidos($rows)
    {
        foreach ($rows as $key => $value) {
            $imagen = $value['img_portada'];
            $myvar = str_replace(" ", "-", $value["titulo"]);
            echo "<li><a href='Libro/" . $myvar . "'><img src='./img_libros/" . $imagen . "' alt='" . $value["titulo"] . "'  title='" . $value["titulo"] . "'/></a></li>";
        }
    }

    /**
     * mostrarNovedades()
     * Muestra las últimas novedades
     */
    public static function mostrarNovedades()
    {
        $resultados = libro::buscarNovedades();
        if ($resultados == 0) {
            echo "Se ha producido un error en la busqueda.";
        } else if ($resultados['numero'] == 0) {
            echo "<h2 class='resultados'>No se encontraron resultados al buscar.</h2>";
        } else {
            echo "<h2 class='resultados'>Últimas novedades subidas.</h2>";
            echo "<div class='ultimosSubidos'><ul class='temas_flex'>";
            for ($i = 0; $i < count($resultados['filas_consulta']); $i ++) {
                foreach ($resultados['filas_consulta'][$i] as $key => $value) {
                    if ($key == "id_libro") {
                        $id_libro_actual = $value;
                    } elseif ($key == "img_portada") {
                        $img_portada = $value;
                    } elseif ($key == "titulo") {
                        $titulo = $value;
                        $myvar = str_replace(" ", "-", $titulo);
                    }
                }
                echo "<li><a href='../Libro/" . $myvar . "'><img src='../img_libros/" . $img_portada . "' alt='" . $titulo . "' title='" . $titulo . "'/></a></li>";
            }
            echo "</ul></div>";
        }
    }

    /**
     * buscarNovedades()
     * Busca las últimas 30 novedades
     *
     * @return $datos
     */
    public static function buscarNovedades()
    {
        $c = Connection::dameInstancia();
        $conexion = $c->dameConexion();
        $cadena = "¡Sé el primero en leerte el libro y subir tu resumen personal!";
        $consulta = "Select * from libros where resumen like '%" . $cadena . "%' ORDER BY fecha_subida DESC LIMIT 30";
        $resultado = $conexion->query($consulta);
        if ($resultado->num_rows != 0) {
            while ($row = $resultado->fetch_assoc()) {
                $rows[] = $row;
            }
            $datos = array(
                'numero' => $resultado->num_rows,
                'filas_consulta' => $rows
            );
            return $datos;
        } else {
            return $datos = array(
                'numero' => 0
            );
        }
    }

    /**
     * mostrarMejorVotados()
     * Muestra las libros mejor votados
     */
    public static function mostrarMejorVotados()
    {
        $resultados = libro::buscarMejorVotados();
        if ($resultados == 0) {
            echo "Se ha producido un error en la busqueda.";
        } else if ($resultados['numero'] == 0) {
            echo "<h2 class='resultados'>No se encontraron resultados al buscar.</h2>";
        } else {
            echo "<h2 class='resultados'>Libros mejor votados.</h2>";
            echo "<div class='ultimosSubidos'><ul class='temas_flex'>";
            for ($i = 0; $i < count($resultados['filas_consulta']); $i ++) {
                foreach ($resultados['filas_consulta'][$i] as $key => $value) {
                    if ($key == "id_libro") {
                        $id_libro_actual = $value;
                    } elseif ($key == "img_portada") {
                        $img_portada = $value;
                    } elseif ($key == "titulo") {
                        $titulo = $value;
                        $myvar = str_replace(" ", "-", $titulo);
                    }
                }
                echo "<li><a href='../Libro/" . $myvar . "'><img src='../img_libros/" . $img_portada . "' alt='" . $titulo . "' title='" . $titulo . "'/></a></li>";
            }
            echo "</ul></div>";
        }
    }

    /**
     * buscarMejorVotados()
     * Busca los libros mejor votados
     *
     * @return $datos
     */
    public static function buscarMejorVotados()
    {
        $c = Connection::dameInstancia();
        $conexion = $c->dameConexion();
        $consulta = "select libros.id_libro,libros.titulo,libros.fecha_subida,libros.img_portada,avg(usuarios_votan_libros.votacion) from libros, usuarios_votan_libros where usuarios_votan_libros.id_libro=libros.id_libro group by libros.id_libro having count(usuarios_votan_libros.votacion) > 1 order by avg(usuarios_votan_libros.votacion) DESC LIMIT 30";
        $resultado = $conexion->query($consulta);
        if ($resultado->num_rows != 0) {
            while ($row = $resultado->fetch_assoc()) {
                $rows[] = $row;
            }
            $datos = array(
                'numero' => $resultado->num_rows,
                'filas_consulta' => $rows
            );
            return $datos;
        } else {
            return $datos = array(
                'numero' => 0
            );
        }
    }

    /**
     * mostrarUltimosSubidos()
     * Muestra los últimos 30 libros subidos
     *
     * @return $datos
     */
    public static function mostrarUltimosSubidos()
    {
        $resultados = libro::buscarUtimosSubidos();
        if ($resultados == 0) {
            echo "Se ha producido un error en la busqueda.";
        } else if ($resultados['numero'] == 0) {
            echo "<h2 class='resultados'>No se encontraron resultados al buscar</h2>";
        } else {
            echo "<h2 class='resultados'>Últimos libros subidos.</h2>";
            echo "<div class='ultimosSubidos'><ul class='temas_flex'>";
            for ($i = 0; $i < count($resultados['filas_consulta']); $i ++) {
                foreach ($resultados['filas_consulta'][$i] as $key => $value) {
                    if ($key == "id_libro") {
                        $id_libro_actual = $value;
                    } elseif ($key == "img_portada") {
                        $img_portada = $value;
                    } elseif ($key == "titulo") {
                        $titulo = $value;
                        $myvar = str_replace(" ", "-", $titulo);
                    }
                }
                echo "<li><a href='../Libro/" . $myvar . "'><img src='../img_libros/" . $img_portada . "' alt='" . $titulo . "' title='" . $titulo . "'/></a></li>";
            }
            echo "</ul></div>";
        }
    }

    /**
     * buscarUtimosSubidos()
     * Busca los últimos 30 libros subidos
     *
     * @return $datos
     */
    public static function buscarUtimosSubidos()
    {
        $c = Connection::dameInstancia();
        $conexion = $c->dameConexion();
        $cadena = "¡Sé el primero en leerte el libro y subir tu resumen personal!";
        $consulta = "Select * from libros where resumen not like '%" . $cadena . "%' ORDER BY fecha_subida DESC LIMIT 30";
        $resultado = $conexion->query($consulta);
        if ($resultado->num_rows != 0) {
            while ($row = $resultado->fetch_assoc()) {
                $rows[] = $row;
            }
            $datos = array(
                'numero' => $resultado->num_rows,
                'filas_consulta' => $rows
            );
            return $datos;
        } else {
            return $datos = array(
                'numero' => 0
            );
        }
    }

    /**
     * console_log
     * Sacamos por consola lo que le pasemos
     *
     * @param
     *            $data
     */
    function console_log($data)
    {
        echo '<script>';
        echo 'console.log(' . json_encode($data) . ')';
        echo '</script>';
    }
}
?>
