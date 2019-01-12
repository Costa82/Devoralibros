<?php
require_once 'Connection.php';

class Relato
{

    private $c;

    private $tabla;

    public function __construct()
    {
        $bd = Connection::dameInstancia();
        $this->c = $bd->dameConexion();
        $this->tabla = "relatos";
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
     * existeRelato($titulo):
     * Función que se utilizará dentro de la función addRelato() para comprobar si ya existe el relato a subir.
     *
     * @param
     *            $titulo
     * @return boolean
     */
    public function existeRelato($titulo)
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
     * addRelato($id_usuario,$titulo,$escritor,$relato,$fecha_subida)
     * Función que se utilizara en el fichero SubirRelato.php para añadir un relato.
     * Dentro de esta función, utilizaremos la funcione existeRelato($titulo).
     * Devuelve un valor númerico para imprimir un mensaje u otro dependiendo de si se ha realizado con exito o no.
     * Para imprimir los mensajes utilizaremos los ficheros validacionesRelato.inc.php y definesRelato.inc.php, los cuales estarán dentro de la carpeta inc.
     *
     * @param
     *            $id_usuario
     * @param
     *            $titulo
     * @param
     *            $escritor
     * @param
     *            $relato
     * @param
     *            $fecha_subida
     * @return int
     */
    public function addRelato($id_usuario, $titulo, $escritor, $relato, $urlExtra, $fecha_subida)
    {
        if ($this->existeRelato($titulo)) {
            $sql = "INSERT INTO " . $this->tabla . " (id_usuario,titulo,escritor,relato,urlExtra,fecha_subida) VALUES(?,?,?,?,?,?)";
            $sen = $this->c->prepare($sql);
            $rel = nl2br($relato);
            $sen->bind_param("isssss", $id_usuario, $titulo, $escritor, $rel, $urlExtra, $fecha_subida);
            if ($sen->execute()) {
                return - 402; // Se ha creado con exito
            } else {
                return - 401; // No se ha podido crear
            }
        } else {
            return - 400; // Este relato ya existe
        }
    }

    /**
     * mostrarRelatos()
     * Función que se utilizará en el fichero VisorRelatos.php para mostrar todos los relatos.
     * Dentro de la función añadiremos una paginación que mostrará por página 5 resultados ordenados por la fecha de subida.
     *
     * @param
     *            $id_usuario
     */
    public function mostrarRelatos($id_usuario, $autor)
    {
        if (strpos($_SERVER['REQUEST_URI'], "Todos") !== false) {            
            $sql_relatoss = "SELECT * FROM " . $this->tabla;
        }else {
            $sql_relatoss = "SELECT * FROM " . $this->tabla. " WHERE escritor = '".$autor."' OR titulo = '".$autor."'";
        }
        
        $this->console_log("Query1: ". $sql_relatoss);
        
        if ($this->c->real_query($sql_relatoss)) {
            
            if ($resul_relatos = $this->c->store_result()) {
                $num_total_registros = $resul_relatos->num_rows;
                
                // Si hay registros
                if ($num_total_registros > 0) {
                    // Limito la busqueda
                    $TAMANO_PAGINA = 2;
                    $pag = false;
                    
                    // Examino la pagina a mostrar y el inicio del registro a mostrar
                    if (strpos($_SERVER['REQUEST_URI'], "Todos") !== false) {
                        
                        if ($autor != "Todos") {
                            $pag = substr($autor, 5);
                            $this->console_log("Pagina: ". $pag);
                        }
                    }
                    if (! $pag) {
                        $inicio = 0;
                        $pag = 1;
                    } else {
                        $inicio = ($pag - 1) * $TAMANO_PAGINA;
                    }
                    
                    // Calculo el total de paginas
                    $total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);
                    
                    if (strpos($_SERVER['REQUEST_URI'], "Todos") !== false) {
                        $sql = "SELECT * FROM " . $this->tabla . " ORDER BY fecha_subida DESC LIMIT " . $inicio . "," . $TAMANO_PAGINA;
                    }else {
                        $sql = "SELECT * FROM " . $this->tabla . " WHERE escritor = '".$autor."' OR titulo = '".$autor."' ORDER BY fecha_subida DESC LIMIT " . $inicio . "," . $TAMANO_PAGINA;
                    }
                    
                    $this->console_log("Query2: ". $sql);
                    
                    if ($this->c->real_query($sql)) {
                        
                        if ($resul = $this->c->store_result()) {
                            
                            if ($resul->num_rows > 0) {
                                
                                while ($mostrar = $resul->fetch_assoc()) {
                                    
                                    echo "<div class='noticias'>
                                                <div class='noticia'>
                                                    <h4>" . $mostrar["titulo"] . "</h4>                                                    
                                                    <br />" . $mostrar["relato"] . "";
                                    
                                    if ($mostrar["urlExtra"] != null) {
                                        echo "<br /><br /><a href='" . $mostrar['urlExtra'] . "' target='_blank'>" . $mostrar['urlExtra'] . "</a><br />";
                                    }
                                    
                                    echo "<br /><h4>" . $mostrar["escritor"] . "</h4>
                                            	<h4> " . $mostrar["fecha_subida"] . "</h4>";
                                    
                                    if (isset($_SESSION['id_usuario'])) {
                                        $tipo_usuario = $_SESSION['datos']['tipo_usuario'];
                                        
                                        if ($tipo_usuario == 2 || $id_usuario == $mostrar["$id_usuario"]) {
                                            echo " <a class='boton' href='../FormularioEditarRelato/?relato=" . $mostrar['id_relato'] . "'><i class='fa fa-pencil' aria-hidden='true'></i></a></div>";
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
                                echo "<div class='comentarios'>No hay relatos subidos</div>";
                            }
                        }
                    } else {
                        echo $this->c->errno . " -> " . $this->c->error;
                    }
                    
                    echo '<div class="numeracion">';
                    
                    if ($total_paginas > 1) {
                        
                        if ($pag != 1)
                            echo '<a href="../Relatos/Todos' . ($pag - 1) . '"><img src="../img/izq.gif" border="0"></a>';
                        
                        for ($i = 1; $i <= $total_paginas; $i ++) {
                            if ($pag == $i)
                                // Si muestro el índice de la página actual, no coloco enlace
                                echo $pag;
                            else
                                // Si el índice no corresponde con la página mostrada actualmente,
                                // coloco el enlace para ir a esa página
                                echo '  <a href="../Relatos/Todos' . $i . '">' . $i . '</a>  ';
                        }
                        
                        if ($pag != $total_paginas)
                            echo '<a href="../Relatos/Todos' . ($pag + 1) . '"><img src="../img/der.gif" border="0"></a>';
                    }
                    echo '</div>';
                } else {
                    echo "<div class='comentarios'>No hay relatos subidas</div>";
                }
            }
        }
    }

    /**
     * mostrar_ultima_noticia();
     * Función que se utilizará en el index para mostrar la ultima noticia.
     */
    public function mostrar_ultimo_relato()
    {
        $sql = "SELECT * FROM " . $this->tabla . " ORDER BY fecha_subida DESC LIMIT 1";
        if ($this->c->real_query($sql)) {
            if ($resul = $this->c->store_result()) {
                if ($resul->num_rows > 0) {
                    while ($mostrar = $resul->fetch_assoc()) {
                        echo "<h2><a href='Relatos/' title='Relatos'>Relatos</a></h2>
                            	  <h4 class='tituloNoticia'><a href='Relatos/' title='" . $mostrar["titulo"] . "'>" . $mostrar["titulo"] . "</a></h4>
                                  <strong>" . $mostrar["escritor"] . "</strong>
                            	  <div class='libroRand'>
                            		
                                  <div class='descripcionRand'>
                                                " . $mostrar["relato"] . "</br></br>";
                        
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
     * modificarRelato($id_noticia,$titulo,$descripcion,$fuente)
     * Función que se utilizará en modificarRelato.php para modificar una noticia.
     *
     * @param
     *            $id_relato
     * @param
     *            $titulo
     * @param
     *            $escritor
     * @param
     *            $relato
     * @param
     *            $url
     * @return boolean
     */
    public function modificarRelato($id_relato, $titulo, $escritor, $rel, $urlExtra)
    {
        $sql_query = "UPDATE relatos SET titulo= ? , escritor= ?, relato= ?, urlExtra= ? WHERE id_relato= ?";
        $stmt = $this->c->stmt_init();
        $stmt->prepare($sql_query);
        if ($stmt === false) {
            return false;
        }
        $rel = nl2br($rel);
        $stmt->bind_param('ssssi', $titulo, $escritor, $rel, $urlExtra, $id_relato);
        $stmt->execute();
    }

    /**
     * nombreRelato($id)
     * Función que devuelve el nombre del relato a partir de su id.
     *
     * @param
     *            $id
     * @return $mostrar["titulo"]
     */
    public function nombreRelato($id)
    {
        $sql = "SELECT titulo FROM " . $this->tabla . " WHERE id_relato='" . $id . "'";
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
     * get_relato($id)
     * Función que devuelve el relato a partir de su id.
     *
     * @param
     *            $id
     * @return $mostrar["relato"]
     */
    public function get_relato($id)
    {
        $sql = "SELECT relato FROM " . $this->tabla . " WHERE id_relato='" . $id . "'";
        if ($this->c->real_query($sql)) {
            if ($resul = $this->c->store_result()) {
                $mostrar = $resul->fetch_assoc();
                return $mostrar["relato"];
            }
        } else {
            echo $this->c->errno . " -> " . $this->c->error;
        }
    }

    /**
     * get_escritor($id)
     * Función que devuelve el escritor a partir de su id.
     *
     * @param
     *            $id
     * @return $mostrar["escritor"]
     */
    public function get_escritor($id)
    {
        $sql = "SELECT escritor FROM " . $this->tabla . " WHERE id_relato='" . $id . "'";
        if ($this->c->real_query($sql)) {
            if ($resul = $this->c->store_result()) {
                $mostrar = $resul->fetch_assoc();
                return $mostrar["escritor"];
            }
        } else {
            echo $this->c->errno . " -> " . $this->c->error;
        }
    }

    /**
     * get_url($id)
     * Función que devuelve la url del relato a partir de su id.
     *
     * @param
     *            $id
     * @return $mostrar["url"]
     */
    public function get_url($id)
    {
        $sql = "SELECT urlExtra FROM " . $this->tabla . " WHERE id_relato='" . $id . "'";
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
     * mostrarAutores()
     * Función que devuelve una lista con todos los autores que han escrito relatos
     */
    public function mostrarAutores()
    {
        $sql = "SELECT DISTINCT escritor FROM " . $this->tabla . " ORDER BY escritor";
        if ($this->c->real_query($sql)) {
            if ($resul = $this->c->store_result()) {
                if ($resul->num_rows > 0) {
                    echo "<ul id='listaAutores'>";
                    while ($mostrar = $resul->fetch_assoc()) {
                        $myvar = str_replace(" ", "-", $mostrar["escritor"]);
                        echo "<li><a href='../Relatos/" . $myvar . "'>" . $mostrar["escritor"] . "</a></li>";
                    }
                    echo "</ul>";
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
     * mostrarTitulos()
     * Función que devuelve una lista con todos los títulos de los relatos
     */
    public function mostrarTitulos()
    {
        $sql = "SELECT DISTINCT titulo FROM " . $this->tabla . " ORDER BY titulo";
        if ($this->c->real_query($sql)) {
            if ($resul = $this->c->store_result()) {
                if ($resul->num_rows > 0) {
                    echo "<ul id='listaTitulos'>";
                    while ($mostrar = $resul->fetch_assoc()) {
                        $myvar = str_replace(" ", "-", $mostrar["titulo"]);
                        echo "<li><a href='../Relatos/" . $myvar . "'>" . $mostrar["titulo"] . "</a></li>";
                    }
                    echo "</ul>";
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
