<?php
    require_once 'Connection.php';
    class Lista{
        private $c;
        private $tabla;
        public function __construct() {
            $bd=  Connection::dameInstancia();
            $this->c=$bd->dameConexion();
            $this->tabla="listas";
        }

        /** 
         *  existeLista($nombrelista):
         *  Función que se utilizará dentro de la función addLista() para ver si ya existe la lista a subir.
         *  @param $nombrelista 
         *  @return boolean
         */
        public function existeLista($nombrelista){
            $sql="SELECT * FROM ".$this->tabla." WHERE nombre_lista='".$nombrelista."'";
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
         * addLista($id_usuario,$nombrelista,$descripcion);
         * Función que se utilizara en el fichero SubirLista.php para añadir una lista.
         * Dentro de esta función, utilizaremos las funciones existeLista($nombrelista) y guardarImgLista($nombre,$img).
         * Devuelve un valor númerico para imprimir un mensaje u otro dependiendo de si se ha realizado con exito o no.
         * Para imprimir los mensajes utilizaremos los ficheros validacionesLista.inc.php y definesLista.inc.php, los cuales estarán dentro de la carpeta inc.
         * @param $id_usuario
         * @param $nombrelista
         * @param $descripcion
         * @return int
         */
        public function addLista($id_usuario,$nombrelista,$descripcion){

            if($this->existeLista($nombrelista)){
              $sql="INSERT INTO ".$this->tabla." (id_usuario,nombre_lista,descripcion) VALUES(?,?,?)";
              $sen=$this->c->prepare($sql);
              $desc=nl2br($descripcion);
              $sen->bind_param("iss",$id_usuario,$nombrelista,$desc);
              if($sen->execute()){                 
                return -402;  // Se ha creado con exito
              }else{
                return -401;  // No se ha podido crear
              }
            }else{
                return -400; // Esta lista ya existe
            }
        }
        
        /** 
         *  mostrarListasUsuario($idusuario,$idlibro);
         *  Función que se utilizará en el fichero visorLista.php para mostrar todas las listas de ese usuario y poder añadir el libro a alguna de ellas.
         *  @param $idusuario
         *  @param $idlibro       
         */
        public function mostrarListasUsuario($idusuario,$idlibro){
            $sql="SELECT id_lista,id_usuario,nombre_lista,descripcion FROM ".$this->tabla." WHERE id_usuario=".$idusuario." ORDER BY nombre_lista";
                if($this->c->real_query($sql)){
                    if($resul=$this->c->store_result()){
                        if($resul->num_rows>0){
                            echo "<ul class='listado'>";                        
                            while($mostrar=$resul->fetch_assoc()){   
                                $idlista=$mostrar["id_lista"];
                                $descripcion=$mostrar["descripcion"];
                                echo "<li><a href='../php/addLibroLista_header.php?idlista=".$idlista."&idlibro=".$idlibro."&idusuario=".$idusuario."' title='Añadir a lista'><i class='fa fa-plus' aria-hidden='true'></i></a> ".$mostrar["nombre_lista"]."</li>";
                            }
                            echo "</ul>";
                            $resul->free_result();
                        }else{
                        $resul->free_result();
                        echo "<p class='error'>Aún no has creado ninguna lista</p>";
                        }
                    }
                }else{
                    echo $this->c->errno." -> ".$this->c->error;
            }
        }
        
        /** 
         *  mostrarListasVisorAmigo($idusuario);
         *  Función que se utilizara en el fichero ver_Amigo.php para mostrar todas las listas de ese usuario.
         *  Llamaremos también a la función mostrarLibrosListasAmigos($idlista) para mostrar los libros de cada lista.
         *  @param $idusuario
         */
        public function mostrarListasVisorAmigo($idusuario){
            $sql="SELECT id_lista,id_usuario,nombre_lista,descripcion FROM ".$this->tabla." WHERE id_usuario=".$idusuario." ORDER BY nombre_lista";
                if($this->c->real_query($sql)){
                    if($resul=$this->c->store_result()){
                        if($resul->num_rows>0){
                            echo "<ul class='listado'>";                        
                            while($mostrar=$resul->fetch_assoc()){   
                                $idlista=$mostrar["id_lista"];
                                $descripcion=$mostrar["descripcion"];
                                echo "<li class='nombreLista'><i class='fa fa-eye' aria-hidden='true' title='ver más información'></i><strong title='Pulsa para ver más información'>".$mostrar["nombre_lista"]."</strong>"
                                        ."<div class='librosLista'><p><strong>Descripción: </strong>".$descripcion."</p>";
                                        $this->mostrarLibrosListasAmigos($idlista);
                                        echo "</div>";
                            }
                            echo "</ul>";
                            $resul->free_result();
                        }else{
                        $resul->free_result();
                        echo "<h4>No hay listas subidas</h4>";
                        }
                    }
                }else{
                    echo $this->c->errno." -> ".$this->c->error;
            }
        }
        
        /** 
         *  mostrarLibrosListasAmigos($idlista)
         *  Función utilizada dentro de mostrarListasVisorAmigo($idusuario) para mostrar los libros de cada lista.
         *  @param $idlista
         */
        public function mostrarLibrosListasAmigos($idlista){
            $sql="SELECT C.id_lista,A.titulo,A.id_libro FROM libros A, listas B, listas_contienen_libros C WHERE A.id_libro=C.id_libro AND B.id_lista=C.id_lista AND C.id_lista=".$idlista;
                if($this->c->real_query($sql)){
                    if($resul=$this->c->store_result()){
                        if($resul->num_rows>0){ 
                            echo "<ul>";
                            while($mostrar=$resul->fetch_assoc()){   
                                $titulo=$mostrar["titulo"];
                                $myvar = str_replace(" ", "-", $mostrar["titulo"]);
                                $idlibro=$mostrar["id_libro"];
                                echo "<li><a href='../Libro/".$myvar."'>".$titulo."</a></li>";                                
                            }
                            echo "</ul>";
                            $resul->free_result();
                        }else{
                        $resul->free_result();
                        echo "<h4>No hay libros en la lista</h4>";
                        }
                    }
                }else{
                    echo $this->c->errno." -> ".$this->c->error;
            }
        }
        
        
        /** 
         *  mostrarListas($idusuario)
         *  Función que se utilizara en el fichero mis_listas.php para mostrar todas las listas de ese usuario.
         *  Llamaremos también a la función mostrarLibrosListas($idlista,$idusuario) para mostrar los libros de cada lista.
         *  @param $idusuario
         */
        public function mostrarListas($idusuario){
            $sql="SELECT id_lista,id_usuario,nombre_lista,descripcion FROM ".$this->tabla." WHERE id_usuario=".$idusuario." ORDER BY nombre_lista";
                if($this->c->real_query($sql)){
                    if($resul=$this->c->store_result()){
                        if($resul->num_rows>0){
                            echo "<ul class='listado'>";                        
                            while($mostrar=$resul->fetch_assoc()){   
                                $idlista=$mostrar["id_lista"];
                                $descripcion=$mostrar["descripcion"];
                                echo "<li class='nombreLista'><i class='fa fa-eye' aria-hidden='true' title='ver más información'></i><a href='../FormularioEditarLista/?idlista=".$idlista."' title='Editar lista'><i class='fa fa-pencil' aria-hidden='true'></i></a> <a href='../php/eliminar_lista_header.php?idlista=".$idlista."&idusuario=".$idusuario."' title='Borrar lista' onclick='return confirmar()'> <i class='fa fa-trash-o' aria-hidden='true' title='borrar lista'></i></a> <strong>".$mostrar["nombre_lista"]."</strong>"
                                        ."<div class='librosLista'><p><strong>Descripción: </strong>".$descripcion."</p>";
                                        $this->mostrarLibrosListas($idlista,$idusuario);
                                        echo "</div>";
                            }
                            echo "</ul>";
                            $resul->free_result();
                        }else{
                        $resul->free_result();
                        echo "<h4>No hay listas subidas</h4>";
                        }
                    }
                }else{
                    echo $this->c->errno." -> ".$this->c->error;
            }
        }
        
        /** 
         *  mostrarLibrosListas($idlista,$idusuario)
         *  Función utilizada dentro de mostrarListas($idusuario) para mostrar los libros de cada lista.
         *  @param $idlista
         *  @param $idusuario
         */
        public function mostrarLibrosListas($idlista,$idusuario){
            $sql="SELECT C.id_lista,A.titulo,A.id_libro FROM libros A, listas B, listas_contienen_libros C WHERE A.id_libro=C.id_libro AND B.id_lista=C.id_lista AND C.id_lista=".$idlista;
                if($this->c->real_query($sql)){
                    if($resul=$this->c->store_result()){
                        if($resul->num_rows>0){ 
                            echo "<ul>";
                            while($mostrar=$resul->fetch_assoc()){   
                                $titulo=$mostrar["titulo"];
                                $idlibro=$mostrar["id_libro"];
                                $myvar = str_replace(" ", "-", $titulo);
                                echo "<li><a href='../php/eliminarLibroLista_header.php?libro=".$idlibro."&lista=".$idlista."&usuario=".$idusuario."' title='Elimina el libro de la lista' onclick='return confirmar()'><i class='fa fa-trash-o' aria-hidden='true'></i></a><a href='../Libro/".$myvar."'>".$titulo."</a></li>";                                
                            }
                            echo "</ul>";
                            $resul->free_result();
                        }else{
                        $resul->free_result();
                        echo "<h4>No hay libros en la lista</h4>";
                        }
                    }
                }else{
                    echo $this->c->errno." -> ".$this->c->error;
            }
        }
        
        /**
         * modificarLista($id_lista,$nombrelista,$descripcion)
         * Función que se utilizará en modificarLista.php para modificar una lista.
         * @param $id_lista
         * @param $nombrelista
         * @param $descripcion
         * @return boolean
         */
        public function modificarLista($id_lista,$nombrelista,$descripcion){
            $sql_query = "UPDATE listas SET nombre_lista= ? , descripcion= ? WHERE id_lista= ?";
            $stmt =  $this->c->stmt_init();
            $stmt->prepare($sql_query);
            if ($stmt === false) {
                return false;
            }
            $desc=nl2br($descripcion);
            $stmt->bind_param('ssi',$nombrelista,$desc,$id_lista);
            $stmt->execute();
        }
        
        /** 
         * nombreLista($idlista)
         * Función que devuelve el nombre de la lista a partir de su id.
         * @param $idlista
         * @return $mostrar["nombre_lista"] el nombre de la lista
         */
        public function nombreLista($idlista){
            $sql="SELECT nombre_lista FROM ".$this->tabla." WHERE id_lista='".$idlista."'";
            if($this->c->real_query($sql)){
                if($resul=$this->c->store_result()){
                    $mostrar=$resul->fetch_assoc();
                    return $mostrar["nombre_lista"];
                }
            }else{
                echo $this->c->errno." -> ".$this->c->error;
            }
        }
        
        /** 
         * get_descripcion($idlista)
         * Función que devuelve la descripción de la lista a partir de su id.
         * @param $idlista
         * @return $mostrar["descripcion"] la descripción de la lista.
         */
        public function get_descripcion($idlista){
            $sql="SELECT descripcion FROM ".$this->tabla." WHERE id_lista='".$idlista."'";
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

