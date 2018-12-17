<?php
    require_once 'Connection.php';
    class Libreria{
        private $c;
        private $tabla;
        public function __construct() {
            $bd=  Connection::dameInstancia();
            $this->c=$bd->dameConexion();
            $this->tabla="librerias";
        }

        /** 
         * normaliza ($cadena)
         * Función que se utilizara dentro de las funciones guardarImgLibreria() y modificaImg() para quitar los acentos y las Ñs a las rutas
         * @param $cadena 
         * @return String
         */
        public function normaliza ($cadena){
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
         *  existeLibreria($nombre):
         *  Función que se utilizara dentro de la función addLibreria() para ver si ya existe la librería a subir.
         *  @param $nombre 
         *  @return boolean
         */
        public function existeLibreria($nombre){
            $sql="SELECT * FROM ".$this->tabla." WHERE nombre='".$nombre."'";
            if($this->c->real_query($sql)){
                if($resul=$this->c->store_result()){
                    if($resul->num_rows==0){
                        return true;
                    }else{
                        return false;
                    }
                }
            }else{
                return $this->c->errno." -> ".$this->c->error;
            }
        }

        /** 
         * addLibreria($id_usuario,$nombre,$descripcion,$fecha_subida,$img);
         * Función que se utilizara en el fichero SubirLibreria.php para añadir una librería.
         * Dentro de esta función, utilizaremos las funciones existeLibreria($nombre) y guardarImgLibreria($nombre,$img).
         * Devuelve un valor númerico para imprimir un mensaje u otro dependiendo de si se ha realizado con exito o no.
         * Para imprimir los mensajes utilizaremos los ficheros validacionesLibreria.inc.php y definesLibreria.inc.php, los cuales estarán dentro de la carpeta inc.
         * @param $id_usuario
         * @param $nombre
         * @param $descripcion
         * @param $fecha_subida
         * @param $img
         * @return int
         */
        public function addLibreria($id_usuario,$nombre,$descripcion,$fecha_subida,$img){

            if($this->existeLibreria($nombre)){
              $foto=$this->guardarImgLibreria($nombre,$img);
              $sql="INSERT INTO ".$this->tabla." (id_usuario,nombre,descripcion,fecha_subida,img_libreria) VALUES(?,?,?,?,?)";
              $sen=$this->c->prepare($sql);
              $desc=nl2br($descripcion);
              $sen->bind_param("issss",$id_usuario,$nombre,$desc,$fecha_subida,$foto);
              if($sen->execute()){                 
                return -402;  // Se ha creado con exito
              }else{
                return -401;  // No se ha podido crear
              }
            }else{
                return -400; // Esta libreria ya existe
            }
        }

        /** 
         * guardarImgLibreria($nombre,$archivo_img):
         * Función utilizada dentro de la función addLibreria(), para guardar la imagen
         * @param $nombre
         * @param $archivo_img
         */
        public function guardarImgLibreria($nombre,$archivo_img){
            $img_name = $archivo_img['name'];
            $img_type=$archivo_img['type'];
            $img_tmp_name=$archivo_img['tmp_name'];
            $img_size=$archivo_img['size'];
            if($img_type=="image/jpeg"||$img_type=="image/pjpeg"||$img_type=="image/jpg"){
                $extension="jpg";
            }elseif ($img_type=="image/png") {
                $extension="png";
            }else{
                $extension=NULL;
            }
            $ruta="NULL";
            $rutaBD="NULL";
            $lugar='../img_librerias/';
            // Validamos la imagen
            if($img_name!=NULL AND $extension!=NULL AND $img_size!=0){
                if($img_size<=$_REQUEST['lim_tamano']){
                    $nombre_img=$this->normaliza($nombre.".".$extension);
                    $ruta=$lugar.$nombre_img;
                    // Guardamos la foto en la carpeta del proyecto "img_librerias"
                    move_uploaded_file($img_tmp_name, $ruta);
                    // Declaramos la ruta de la imagen en la base de datos
                    $rutaBD=$nombre_img;
                }else{
                    $rutaOrigen="../img_librerias/libreria_generica.jpg";
                    $rutaFinal=$this->normaliza($lugar.$nombre.".png");
                    copy($rutaOrigen, $rutaFinal);
                    $rutaBD=$this->normaliza($nombre.".png");
                }
            }else{// En caso de que el usuario no inserte imagen
                $rutaOrigen="../img_librerias/libreria_generica.jpg";
                    $rutaFinal=$this->normaliza($lugar.$nombre.".png");
                    copy($rutaOrigen, $rutaFinal);
                    $rutaBD=$this->normaliza($nombre.".png");
            }
            return $rutaBD;
        } 
        
        /** 
         * mostrarLibrerias();
         * Función que se utilizará en el fichero VisorLibrerias.php para mostrar todas las librerías.
         * Dentro de la función añadiremos una paginación que mostrará por página 5 resultados ordenados alfabéticamente.
         */
        public function mostrarLibrerias(){
            $sql_librerias="SELECT * FROM ".$this->tabla;
            if($this->c->real_query($sql_librerias)){
                if($resul_librerias=$this->c->store_result()){
                    $num_total_registros=$resul_librerias->num_rows;
                    // Si hay registros
                    if ($num_total_registros > 0) {
                    // Limito la busqueda
                    $TAMANO_PAGINA = 5;
                    $pag = false;
                    // Examino la página a mostrar y el inicio del registro a mostrar
                    if (isset($_GET["pag"]))
                        $pag = $_GET["pag"];

                    if (!$pag) {
                            $inicio = 0;
                            $pag = 1;
                    }
                    else {
                            $inicio = ($pag - 1) * $TAMANO_PAGINA;
                    }
                    // Calculo el total de paginas
                    $total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);
                    $sql="SELECT id_libreria,nombre,descripcion,fecha_subida,img_libreria FROM ".$this->tabla." ORDER BY id_libreria DESC LIMIT ".$inicio."," . $TAMANO_PAGINA;
                        if($this->c->real_query($sql)){
                            if($resul=$this->c->store_result()){
                                if($resul->num_rows>0){
                                    while($mostrar=$resul->fetch_assoc()){
                                        echo "<div class='noticias'>
                                                <div class='imgNoticia'>
                                                    <img src='../img_librerias/".$mostrar["img_libreria"]."' alt='".$mostrar["nombre"]."' title='".$mostrar["nombre"]."'>
                                                </div>
                                                <div class='noticia'>
                                                    <h4>".$mostrar["nombre"]."</h4>
                                                    ".$mostrar["descripcion"];
                                        if(isset($_SESSION['id_usuario'])){
                                            $tipo_usuario=$_SESSION['datos']['tipo_usuario'];
                                            if($tipo_usuario==2){
                                                echo " <a class='boton' href='../FormularioEditarLibreria/?libreria=".$mostrar['id_libreria']."'><i class='fa fa-pencil' aria-hidden='true'></i></a></div>";
                                            }else {
                                                echo "";
                                            }
                                        }else{
                                            echo "";
                                        }
                                        echo "</div></div>";
                                    }
                                    $resul->free_result();
                                }else{
                                $resul->free_result();
                                echo "<div class='comentarios'>No hay librerías subidas</div>";
                                }
                            }
                        }else{
                            echo $this->c->errno." -> ".$this->c->error;
                        }
                        echo '<div class="numeracion">';

                        if ($total_paginas > 1) {
                                if ($pag != 1)
                                        echo '<a href="../Librerias/?pag='.($pag-1).'"><img src="../img/izq.gif" border="0"></a>';
                                for ($i=1;$i<=$total_paginas;$i++) {
                                        if ($pag == $i)
                                                // Si muestro el índice de la página actual, no coloco enlace
                                                echo $pag;
                                        else
                                                // Si el índice no corresponde con la página mostrada actualmente,
                                                // coloco el enlace para ir a esa página
                                                echo '  <a href="../Librerias/?pag='.$i.'">'.$i.'</a>  ';
                                }
                                if ($pag != $total_paginas)
                                        echo '<a href="../Librerias/?pag='.($pag+1).'"><img src="../img/der.gif" border="0"></a>';
                        }
                        echo '</div>';
                    }else {
                        echo "<div class='comentarios'>No hay librerías subidas</div>";
                    }
                }
            }
        }
        
        /** 
         * get_imagen($id):
         * Función que nos devuelve la imagen de la librería a partir de su id
         * @param $id
         * @return $mostrar["img_libreria"]
         */
        public function get_imagen($id){
            $sql="SELECT img_libreria FROM ".$this->tabla." WHERE id_libreria='".$id."'";
            if($this->c->real_query($sql)){
                if($resul=$this->c->store_result()){
                    $mostrar=$resul->fetch_assoc();
                    return $mostrar["img_libreria"];
                }
            }else{
                echo $this->c->errno." -> ".$this->c->error;
            }
        }
        
        /**
         * modificarLibreria($id_libreria,$nombre,$descripcion)
         * Función que se utilizara en modificarLibreria.php para modificar una librería.
         * @param $id_libreria
         * @param $nombre
         * @param $descripcion
         * @return boolean
         */
        public function modificarLibreria($id_libreria,$nombre,$descripcion){
            $sql_query = "UPDATE librerias SET nombre= ? , descripcion= ? WHERE id_libreria= ?";
            $stmt =  $this->c->stmt_init();
            $stmt->prepare($sql_query);
            if ($stmt === false) {
                return false;
            }
            $desc=nl2br($descripcion);
            $stmt->bind_param('ssi',$nombre,$desc,$id_libreria);
            $stmt->execute();
        }
        
        /**
         * modificarImgLibreria($nombre,$img_libreria,$id_libreria)
         * Función que se utilizara en modificarLibreria.php para modificar la imagen de la librería.
         * @param $nombre
         * @param $img_libreria
         * @param $id_libreria
         * @return boolean
         */
        public function modificarImgLibreria($nombre,$img_libreria,$id_libreria){
            $img=$this->modificarImg($nombre,$img_libreria);
            $sql_query = "UPDATE $this->tabla SET  "
                   ."  img_libreria = ?"
                   ." WHERE id_libreria= ?";

           $stmt =  $this->c->stmt_init();
           $stmt->prepare($sql_query);
           if ($stmt === false) {
               return false;
           }
           $stmt->bind_param('si',$img,$id_libreria);
           $stmt->execute();
        }
        
        /**
         * modificarImg($nombre,$archivo_img):
         * Función utilizada dentro de la función modificarImgLibreria(),para modificar la imagen de la librería
         * @param $nombre
         * @param $archivo_img
         */
        public function modificarImg($nombre,$archivo_img){
            $img_name = $archivo_img['name'];
            $img_type=$archivo_img['type'];
            $img_tmp_name=$archivo_img['tmp_name'];
            $img_size=$archivo_img['size'];
            if($img_type=="image/jpeg"||$img_type=="image/pjpeg"||$img_type=="image/jpg"){
		$extension="jpg";
            }elseif ($img_type=="image/png") {
		$extension="png";
            }else{
		$extension=NULL;
            }
		$ruta="NULL";
		$rutaBD="NULL";
		$lugar='../img_librerias/';
		// Validamos la imagen
		if($img_name!=NULL AND $extension!=NULL AND $img_size!=0){
                    if($img_size<=$_REQUEST['lim_tamano']){
			$nombre_img=$this->normaliza($nombre.".".$extension);
			$ruta=$lugar.$nombre_img;
			// Guardamos la foto en la carpeta del proyecto "img_librerias"
			move_uploaded_file($img_tmp_name, $ruta);
			// Declaramos la ruta de la imagen en la base de datos
			$rutaBD=$nombre_img;
                    }else{
                        $rutaOrigen="../img_librerias/libreria_generica.jpg";
                        $rutaFinal=$this->normaliza($lugar.$nombre.".png");
                        copy($rutaOrigen, $rutaFinal);
                        $rutaBD=$this->normaliza($nombre.".png");
                    }
		}else{// En caso de que el usuario no inserte imagen
                    $rutaOrigen="../img_librerias/libreria_generica.jpg";
			$rutaFinal=$this->normaliza($lugar.$nombre.".png");
			copy($rutaOrigen, $rutaFinal);
			$rutaBD=$this->normaliza($nombre.".png");
		}
		return $rutaBD;
	}
        
        /** 
         * nombreLibreria($id)
         * Función que devuelve el nombre de la librería a partir de su id.
         * @param $id
         * @return $mostrar["nombre"] el nombre de la librería
         */
        public function nombreLibreria($id){
            $sql="SELECT nombre FROM ".$this->tabla." WHERE id_libreria='".$id."'";
            if($this->c->real_query($sql)){
                if($resul=$this->c->store_result()){
                    $mostrar=$resul->fetch_assoc();
                    return $mostrar["nombre"];
                }
            }else{
                echo $this->c->errno." -> ".$this->c->error;
            }
        }
        
        /** 
         * get_descripcion($id)
         * Función que devuelve la descripción de la librería a partir de su id.
         * @param $id
         * @return $mostrar["descripcion"] la descripción de la librería
         */
        public function get_descripcion($id){
            $sql="SELECT descripcion FROM ".$this->tabla." WHERE id_libreria='".$id."'";
            if($this->c->real_query($sql)){
                if($resul=$this->c->store_result()){
                    $mostrar=$resul->fetch_assoc();
                    return $mostrar["descripcion"];
                }
            }else{
                echo $this->c->errno." -> ".$this->c->error;
            }
        }
    }    
?>

