<?php
    require_once 'Connection.php';
    class Concurso{
        private $c;
        private $tabla;
        
        public function __construct() {
            $bd=  Connection::dameInstancia();
            $this->c=$bd->dameConexion();
            $this->tabla="concursos";
        }

        /** 
         * normaliza ($cadena)
         * Función que se utilizara dentro de las funciones guardarImgConcurso() y modificaImg() para quitar los acentos y las Ñs a las rutas
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
         *  existeConcurso($nombre):
         *  Función que se utilizará dentro de la función addConcurso() para ver si ya existe el concurso a subir.
         *  @param $nombre 
         *  @return boolean
         */
        public function existeConcurso($nombre){
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
         * addConcurso($id_usuario,$nombre,$descripcion,$fecha_subida,$img);
         * Función que se utilizara en el fichero SubirConcurso.php para añadir un concurso.
         * Dentro de esta función, utilizaremos las funciones existeConcurso($nombre) y guardarImgConcurso($nombre,$img).
         * Devuelve un valor númerico para imprimir un mensaje u otro dependiendo de si se ha realizado con exito o no.
         * Para imprimir los mensajes utilizaremos los ficheros validacionesConcurso.inc.php y definesConcurso.inc.php, los cuales estarán dentro de la carpeta inc.
         * @param $id_usuario
         * @param $nombre
         * @param $descripcion
         * @param $fecha_subida
         * @param $img
         * @return int
         */
        public function addConcurso($id_usuario,$nombre,$descripcion,$fecha_subida,$img){

            if($this->existeConcurso($nombre)){
              $foto=$this->guardarImgConcurso($nombre,$img);
              $activo=1;
              $sql="INSERT INTO ".$this->tabla." (id_usuario,nombre,descripcion,fecha_subida,img_concurso,activo) VALUES(?,?,?,?,?,?)";
              $sen=$this->c->prepare($sql);
              $desc=nl2br($descripcion);
              $sen->bind_param("issssi",$id_usuario,$nombre,$desc,$fecha_subida,$foto,$activo);
              if($sen->execute()){                 
                return -402;  // Se ha creado con exito
              }else{
                return -401;  // No se ha podido crear
              }
            }else{
                return -400; // Este concurso ya existe
            }
        }

        /** 
         * guardarImgConcurso($nombre,$archivo_img):
         * Función utilizada dentro de la función addConcurso(), para guardar la imagen
         * @param $nombre
         * @param $archivo_img
         */
        public function guardarImgConcurso($nombre,$archivo_img){
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
            $lugar='../img_concursos/';
            // Validamos la imagen
            if($img_name!=NULL AND $extension!=NULL AND $img_size!=0){
                if($img_size<=$_REQUEST['lim_tamano']){
                    $nombre_img=$this->normaliza($nombre.".".$extension);
                    $ruta=$lugar.$nombre_img;
                    // Guardamos la foto en la carpeta del proyecto "img_concursos"
                    move_uploaded_file($img_tmp_name, $ruta);
                    // Declaramos la ruta de la imagen en la base de datos
                    $rutaBD=$nombre_img;
                }else{
                    $rutaOrigen="../img_concursos/concurso_generico.jpg";
                    $rutaFinal=$this->normaliza($lugar.$nombre.".png");
                    copy($rutaOrigen, $rutaFinal);
                    $rutaBD=$this->normaliza($nombre.".png");
                }
            }else{// En caso de que el usuario no inserte imagen
                $rutaOrigen="../img_concursos/concurso_generico.jpg";
                    $rutaFinal=$this->normaliza($lugar.$nombre.".png");
                    copy($rutaOrigen, $rutaFinal);
                    $rutaBD=$this->normaliza($nombre.".png");
            }
            return $rutaBD;
        } 
        
        /** 
         * mostrarConcursos();
         * Función que se utilizará en el fichero VisorConcursos.php para mostrar todos los concursos.
         * Dentro de la función añadiremos una paginación que mostrará por página 5 resultados ordenados por la fecha de subida.
         */
        public function mostrarConcursos(){
            $sql_concursos="SELECT * FROM ".$this->tabla;
            if($this->c->real_query($sql_concursos)){
                if($resul_concursos=$this->c->store_result()){
                    $num_total_registros=$resul_concursos->num_rows;
                    // Si hay registros
                    if ($num_total_registros > 0) {
                    // Limito la busqueda
                    $TAMANO_PAGINA = 5;
                    $pag = false;
                    // Examino la pagina a mostrar y el inicio del registro a mostrar
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
                    $sql="SELECT id_concurso,nombre,descripcion,fecha_subida,img_concurso,activo FROM ".$this->tabla." ORDER BY fecha_subida DESC LIMIT ".$inicio."," . $TAMANO_PAGINA;
                        if($this->c->real_query($sql)){
                            if($resul=$this->c->store_result()){
                                if($resul->num_rows>0){
                                    while($mostrar=$resul->fetch_assoc()){
                                        // Si tiene activo=1 el Concurso está activo, si tiene activo=2 el Concurso está cancelado
                                        if ($mostrar["activo"]==1){
                                            echo "<div class='noticias'>";
                                        }else {
                                            echo "<div class='noticias cancelado'>"
                                            . "<h2 class='finalizado'>Finalizado</h2>";    
                                        }
                                        echo "<div class='imgNoticia'>
                                                    <img src='../img_concursos/".$mostrar["img_concurso"]."' alt='".$mostrar["nombre"]."' title='".$mostrar["nombre"]."'>
                                                </div>
                                                <div class='noticia'>
                                                    <h4>".$mostrar["nombre"]."</h4>
                                                    ".$mostrar["descripcion"];
                                        if(isset($_SESSION['id_usuario']) AND ($mostrar["activo"]==1)){
                                            $tipo_usuario=$_SESSION['datos']['tipo_usuario'];
                                            if($tipo_usuario==2){
                                                echo " <a class='boton' href='../FormularioEditarConcurso/?concurso=".$mostrar['id_concurso']."' title='Modificar concurso'><i class='fa fa-pencil' aria-hidden='true'></i></a>";
                                                echo " <a class='boton' href='../php/cancelarConcurso_header.php?concurso=".$mostrar['id_concurso']."' title='Cancelar concurso'><i class='fa fa-ban' aria-hidden='true'></i></a></div>";                                            
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
                                echo "<div class='comentarios'>No hay concursos subidos</div>";
                                }
                            }
                        }else{
                            echo $this->c->errno." -> ".$this->c->error;
                        }
                        echo '<div class="numeracion">';
                        if ($total_paginas > 1) {
                                if ($pag != 1)
                                        echo '<a href="../Concursos/?pag='.($pag-1).'"><img src="../img/izq.gif" border="0"></a>';
                                for ($i=1;$i<=$total_paginas;$i++) {
                                        if ($pag == $i)
                                                // Si muestro el índice de la página actual, no coloco enlace
                                                echo $pag;
                                        else
                                                // Si el índice no corresponde con la página mostrada actualmente,
                                                // coloco el enlace para ir a esa página
                                                echo '  <a href="../Concursos/?pag='.$i.'">'.$i.'</a>  ';
                                }
                                if ($pag != $total_paginas)
                                        echo '<a href="../Concursos/?pag='.($pag+1).'"><img src="../img/der.gif" border="0"></a>';
                        }
                        echo '</div>';
                    }else {
                        echo "<div class='comentarios'>No hay concursos subidos</div>";
                    }
                }
            }
        }
        
        /** 
         * get_imagen($id):
         * Función que nos devuelve la imagen del concurso a partir de su id
         * @param $id
         * @return $mostrar["img_concurso"]
         */
        public function get_imagen($id){
            $sql="SELECT img_concurso FROM ".$this->tabla." WHERE id_concurso='".$id."'";
            if($this->c->real_query($sql)){
                if($resul=$this->c->store_result()){
                    $mostrar=$resul->fetch_assoc();
                    return $mostrar["img_concurso"];
                }
            }else{
                echo $this->c->errno." -> ".$this->c->error;
            }
        }
        
        /** 
         * concursosActivos():
         * Función que comprueba si un concurso está activo para mostrar la imagen de 'apúntate ya' o no.
         * Estará activo si activo=1.
         */
        public function concursosActivos(){
            $sql_concursos="SELECT * FROM ".$this->tabla." WHERE activo=1";
            if($this->c->real_query($sql_concursos)){
                if($resul_concursos=$this->c->store_result()){
                    $num_total_registros=$resul_concursos->num_rows;
                    // Si hay registros
                    if ($num_total_registros > 0) {
                        echo '<img src="img/apuntate-ya.png" alt="Apúntate ya" title="Apúntate ya" class="apuntate"/>';
                    }else {
                        echo '';
                    }
                }else{
                    echo $this->c->errno." -> ".$this->c->error;
                }
            }
        }
        
        /**
         * modificarConcurso($id_concurso,$nombre,$descripcion)
         * Función que se utilizará en modificarConcurso.php para modificar un concurso.
         * @param $id_concurso
         * @param $nombre
         * @param $descripcion
         * @return boolean
         */
        public function modificarConcurso($id_concurso,$nombre,$descripcion){
            $sql_query = "UPDATE concursos SET nombre= ? , descripcion= ? WHERE id_concurso= ?";
            $stmt =  $this->c->stmt_init();
            $stmt->prepare($sql_query);
            if ($stmt === false) {
                return false;
            }
            $desc=nl2br($descripcion);
            $stmt->bind_param('ssi',$nombre,$desc,$id_concurso);
            $stmt->execute();
        }
        
        /**
         * modificarImgConcurso($nombre,$img_concurso,$id_concurso)
         * Función que se utilizará en modificarConcurso.php para modificar la imagen del concurso.
         * @param $nombre
         * @param $img_concurso
         * @param $id_concurso
         * @return boolean
         */
        public function modificarImgConcurso($nombre,$img_concurso,$id_concurso){
            $img=$this->modificarImg($nombre,$img_concurso);
            $sql_query = "UPDATE $this->tabla SET  "
                   ."  img_concurso = ?"
                   ." WHERE id_concurso= ?";

            $stmt =  $this->c->stmt_init();
            $stmt->prepare($sql_query);
            if ($stmt === false) {
                return false;
            }
            $stmt->bind_param('si',$img,$id_concurso);
            $stmt->execute();
        }
       
        /**
         * modificarImg($nombre,$archivo_img):
         * Función utilizada dentro de la función modificarImgConcurso(),para modificar la imagen del concurso
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
		$lugar='../img_concursos/';
		// Validamos la imagen
		if($img_name!=NULL AND $extension!=NULL AND $img_size!=0){
                    if($img_size<=$_REQUEST['lim_tamano']){
			$nombre_img=$this->normaliza($nombre.".".$extension);
			$ruta=$lugar.$nombre_img;
			// Guardamos la foto en la carpeta del proyecto "img_concursos"
			move_uploaded_file($img_tmp_name, $ruta);
			// Declaramos la ruta de la imagen en la base de datos
			$rutaBD=$nombre_img;
                    }else{
                        $rutaOrigen="../img_concursos/concurso_generico.jpg";
                        $rutaFinal=$this->normaliza($lugar.$nombre.".png");
                        copy($rutaOrigen, $rutaFinal);
                        $rutaBD=$this->normaliza($nombre.".png");
                    }
		}else{// En caso de que el usuario no inserte imagen
                    $rutaOrigen="../img_concursos/concurso_generico.jpg";
			$rutaFinal=$this->normaliza($lugar.$nombre.".png");
			copy($rutaOrigen, $rutaFinal);
			$rutaBD=$this->normaliza($nombre.".png");
		}
		return $rutaBD;
	}
        
        /** 
         * nombreConcurso($id)
         * Función que devuelve el nombre del concurso a partir de su id.
         * @param $id
         * @return $mostrar["nombre"] el nombre del concurso
         */
        public function nombreConcurso($id){
            $sql="SELECT nombre FROM ".$this->tabla." WHERE id_concurso='".$id."'";
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
         * Función que devuelve la descripción del concurso a partir de su id.
         * @param $id
         * @return $mostrar["descripcion"] la descripción del concurso
         */
        public function get_descripcion($id){
            $sql="SELECT descripcion FROM ".$this->tabla." WHERE id_concurso='".$id."'";
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