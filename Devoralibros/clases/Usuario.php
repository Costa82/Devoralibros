<?php
require_once 'Connection.php';

// include ("../php/phpmailer.php");

class Usuario
{

    private $c;

    private $tabla;

    private $contrasena;

    private $correoAdministrador;

    public function __construct()
    {
        $bd = Connection::dameInstancia();
        $this->c = $bd->dameConexion();
        $this->tabla = "usuarios";
        $this->contrasena = "Misery16!";
        $this->correoAdministrador = "administrador@devoralibros.es";
    }

    /**
     * normaliza
     * Función que se utilizara dentro de las funcione modificaImg() para quitar los acentos y las Ñs a las rutas.
     *
     * @param
     *            $cadenaOriginal
     * @return String
     */
    public function normaliza($cadenaOriginal)
    {
        $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ
		ßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
        $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuy
		bsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
        $cadena = utf8_decode($cadenaOriginal);
        $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
        $cadena = strtolower($cadena);
        
        return utf8_encode($cadena);
    }

    /**
     * getUsuario
     * Función que devuelve los datos de un usuario pasándole su id.
     *
     * @param
     *            $id_usuario
     * @return $datos es un array con todos los datos de usuario (id_tipo,nombre,apellidos,...)
     *         son todos los campos que se guardan para ese usuario en la base de datos
     */
    public function getUsuario($id_usuario)
    {
        $datos = array();
        $sql = "SELECT * FROM $this->tabla WHERE id_usuario=" . $id_usuario;
        if ($this->c->real_query($sql)) {
            if ($result = $this->c->store_result()) {
                if ($result->num_rows == 1) {
                    
                    $registro = $result->fetch_assoc();
                    foreach ($registro as $key => $value) {
                        $datos[$key] = $value;
                    }
                    $result->free_result();
                    return $datos;
                }
            }
        } else {
            
            return $this->c->errno . " -> " . $this->c->error;
        }
    }

    /**
     * mostrarTopMensual
     * Función usuada para devolver los tres primeros clasificados en puntos mensuales.
     */
    public function mostrarTopMensual()
    {
        $bd = Connection::dameInstancia();
        $c = $bd->dameConexion();
        $sql = "SELECT nick, puntosmes, id_usuario, foto FROM usuarios WHERE NOT id_usuario=1 AND NOT id_usuario=2 AND NOT id_usuario=4 AND NOT id_usuario=5 AND NOT id_usuario=100 ORDER BY puntosmes DESC LIMIT 3";
        if ($c->real_query($sql)) {
            if ($resul = $c->store_result()) {
                if ($resul->num_rows > 0) {
                    
                    while ($mostrar = $resul->fetch_assoc()) {
                        echo '<h2>' . $mostrar["nick"] . ' ' . $mostrar["puntosmes"] . ' pts <img src="../fotos/' . $mostrar["foto"] . '" alt="Foto de perfil" height="55"></h2>';
                    }
                    $resul->free_result();
                }
            }
        } else {
            
            echo $c->errno . " -> " . $c->error;
        }
    }

    /**
     * mostrarTopAnual
     * Función usuada para devolver los tres primeros clasificados en puntos totales
     */
    public function mostrarTopAnual()
    {
        $bd = Connection::dameInstancia();
        $c = $bd->dameConexion();
        $sql = "SELECT nick, puntos, id_usuario, foto FROM usuarios WHERE NOT id_usuario=1 AND NOT id_usuario=2 AND NOT id_usuario=4 AND NOT id_usuario=5 AND NOT id_usuario=100 ORDER BY puntos DESC LIMIT 3";
        if ($c->real_query($sql)) {
            if ($resul = $c->store_result()) {
                if ($resul->num_rows > 0) {
                    
                    while ($mostrar = $resul->fetch_assoc()) {
                        echo '<h2>' . $mostrar["nick"] . ' ' . $mostrar["puntos"] . ' pts <img src="../fotos/' . $mostrar["foto"] . '" alt="Foto de perfil" height="55"></h2>';
                    }
                    $resul->free_result();
                }
            }
        } else {
            
            echo $c->errno . " -> " . $c->error;
        }
    }

    /**
     * mostrarUsuarios
     * Función usuada por los administradores para visualizar todos los usuarios y verlos o eliminarlos.
     *
     * @param
     *            $id_usuario
     * @param
     *            $tipo_usuario
     */
    public function mostrarUsuarios($id_usuario, $tipo_usuario)
    {
        $bd = Connection::dameInstancia();
        $c = $bd->dameConexion();
        $sql = "SELECT nick, id_usuario, mail, puntos, puntosmes foto FROM usuarios WHERE NOT id_usuario=1 AND NOT id_usuario=2 AND NOT id_usuario=4 AND NOT id_usuario=5 AND NOT id_usuario=100 ORDER BY nick ASC";
        if ($c->real_query($sql)) {
            if ($resul = $c->store_result()) {
                if ($resul->num_rows > 0) {
                    
                    while ($mostrar = $resul->fetch_assoc()) {
                        echo '<h3 class="nombreListadoUsuarios"><a href="../Amigo/?nickAmigo=' . md5($mostrar["nick"]) . '&tipo_usuario=' . $tipo_usuario . '&id1=' . $id_usuario . '">' . $mostrar["nick"] . ' </a></h3><p class="listadoUsuarios">' . $mostrar["mail"] . ' - ' . $mostrar["puntos"] . ' pts <a href="../php/eliminar_usuario_header.php?id=' . $mostrar["id_usuario"] . '" onclick="return confirmar()"> <i class="fa fa-trash-o" aria-hidden="true" title="borrar amigo"></i></a></p>';
                        // echo '<h3 class="nombreListadoUsuarios">'.$mostrar["nick"].'</h3><p class="listadoUsuarios">'.$mostrar["mail"].' - '.$mostrar["puntos"].' pts </p>';
                    }
                    $resul->free_result();
                }
            }
        } else {
            
            echo $c->errno . " -> " . $c->error;
        }
    }

    /**
     * getPuntosMensual
     * Función que devuelve los puntos mensuales de un usuario pasándole su id
     *
     * @param
     *            $id
     * @return $mostrar["nick"] el nick del usuario
     */
    public function getPuntosMensual($id)
    {
        $c = Connection::dameInstancia();
        $conexion = $c->dameConexion();
        $sql = "SELECT puntosmes FROM usuarios WHERE id_usuario='" . $id . "'";
        if ($conexion->real_query($sql)) {
            if ($resul = $conexion->store_result()) {
                $mostrar = $resul->fetch_assoc();
                
                return $mostrar["puntosmes"];
            }
        } else {
            
            echo $conexion->errno . " -> " . $conexion->error;
        }
    }

    /**
     * getPuntos
     * Función que devuelve los puntos totales de un usuario pasándole su id
     *
     * @param
     *            $id
     * @return $mostrar["nick"] el nick del usuario
     */
    public function getPuntos($id)
    {
        $c = Connection::dameInstancia();
        $conexion = $c->dameConexion();
        $sql = "SELECT puntos FROM usuarios WHERE id_usuario='" . $id . "'";
        if ($conexion->real_query($sql)) {
            if ($resul = $conexion->store_result()) {
                $mostrar = $resul->fetch_assoc();
                
                return $mostrar["puntos"];
            }
        } else {
            
            echo $conexion->errno . " -> " . $conexion->error;
        }
    }

    /**
     * getCodigoPatrocinio
     * Función que devuelve el codigo de Patrocinio de un usuario
     *
     * @param
     *            $id
     * @return $mostrar["codigoUsuario"]
     */
    public function getCodigoPatrocinio($id)
    {
        $c = Connection::dameInstancia();
        $conexion = $c->dameConexion();
        $sql = "SELECT codigoPatrocinio FROM usuarios WHERE id_usuario='" . $id . "'";
        if ($conexion->real_query($sql)) {
            if ($resul = $conexion->store_result()) {
                $mostrar = $resul->fetch_assoc();
                
                return $mostrar["codigoPatrocinio"];
            }
        } else {
            
            echo $conexion->errno . " -> " . $conexion->error;
        }
    }

    /**
     * muestraUsuario
     * Función utilizada en ver_amigo.php para mostrar todos los datos de un usuario pasándole su nick
     *
     * @param
     *            $nick
     */
    public function muestraUsuario($nick)
    {
        $bd = Connection::dameInstancia();
        $c = $bd->dameConexion();
        $sql = "SELECT * FROM usuarios WHERE nick='$nick'";
        if ($c->real_query($sql)) {
            if ($resul = $c->store_result()) {
                if ($resul->num_rows > 0) {
                    while ($mostrar = $resul->fetch_assoc()) {
                        
                        echo '<h2>' . $mostrar["nombre"] . ' ' . $mostrar["apellidos"] . '</h2>';
                        echo '<img src="../fotos/' . $mostrar["foto"] . '" alt="Foto de perfil" height="75">';
                        if ($mostrar["libro_favorito"] == '') {} else {
                            echo '<h4>Libro favorito </h4> ' . $mostrar["libro_favorito"];
                        }
                        if ($mostrar["libro_odiado"] == '') {} else {
                            echo '<h4>Libro que menos le gustó</h4> ' . $mostrar["libro_odiado"];
                        }
                        if ($mostrar["autor_favorito"] == '') {} else {
                            echo '<h4>Autor favorito</h4> ' . $mostrar["autor_favorito"];
                        }
                        if ($mostrar["genero_favorito"] == '') {} else {
                            echo '<h4>Género favorito</h4> ' . $mostrar["genero_favorito"];
                        }
                    }
                    $resul->free_result();
                }
            }
        } else {
            
            echo $c->errno . " -> " . $c->error;
        }
    }

    /**
     * getUsuarioNick
     * Función que devuelve los datos de un usuario pasándole su nick
     *
     * @param
     *            $nick
     * @return $datos es un array con todos los datos de usuario (id_tipo,nombre,apellidos,...)
     *         son todos los campos que se guardan para ese usuario en la base de datos
     */
    public function getUsuarioNick($nick)
    {
        $c = Connection::dameInstancia();
        $conexion = $c->dameConexion();
        $datos = array();
        $sql = "SELECT * FROM usuarios WHERE nick=" . $nick;
        if ($conexion->real_query($sql)) {
            if ($result = $conexion->store_result()) {
                if ($result->num_rows == 1) {
                    $registro = $result->fetch_assoc();
                    foreach ($registro as $key => $value) {
                        $datos[$key] = $value;
                    }
                    $result->free_result();
                    
                    return $datos;
                }
            }
        } else {
            
            return $conexion->errno . " -> " . $conexion->error;
        }
    }

    /**
     * getIdusuario
     * Función que devuelve el id de un usuario pasándole su nick.
     *
     * @param
     *            $nick
     * @return $mostrar["id_usuario"]
     */
    public function getIdusuario($nick)
    {
        $c = Connection::dameInstancia();
        $conexion = $c->dameConexion();
        $sql = "SELECT id_usuario FROM usuarios WHERE UPPER(nick)=UPPER('$nick')";
        if ($conexion->real_query($sql)) {
            if ($resul = $conexion->store_result()) {
                $mostrar = $resul->fetch_assoc();
                
                return $mostrar["id_usuario"];
            }
        } else {
            
            echo $conexion->errno . " -> " . $conexion->error;
        }
    }

    /**
     * getNick
     * Función que devuelve el nick de un usuario pasándole su id.
     *
     * @param
     *            $id
     * @return $mostrar["nick"]
     */
    public function getNick($id)
    {
        $c = Connection::dameInstancia();
        $conexion = $c->dameConexion();
        $sql = "SELECT nick FROM usuarios WHERE id_usuario='" . $id . "'";
        if ($conexion->real_query($sql)) {
            if ($resul = $conexion->store_result()) {
                $mostrar = $resul->fetch_assoc();
                
                return $mostrar["nick"];
            }
        } else {
            
            echo $conexion->errno . " -> " . $conexion->error;
        }
    }

    /**
     * getNombre
     * Función que devuelve el nombre de un usuario pasándole su id
     *
     * @param
     *            $id
     * @return $mostrar["nombre"]
     */
    public function getNombre($id)
    {
        $c = Connection::dameInstancia();
        $conexion = $c->dameConexion();
        $sql = "SELECT nombre FROM usuarios WHERE id_usuario='" . $id . "'";
        if ($conexion->real_query($sql)) {
            if ($resul = $conexion->store_result()) {
                $mostrar = $resul->fetch_assoc();
                
                return $mostrar["nombre"];
            }
        } else {
            
            echo $conexion->errno . " -> " . $conexion->error;
        }
    }

    /**
     * getTipoUsuario
     * Función que devuelve el tipo de un usuario pasándole su id, tipo=1 es un usuario normal
     * tipo=2 es un administrador.
     *
     * @param
     *            $id
     * @return $mostrar["tipo_usuario"]
     */
    public function getTipoUsuario($id)
    {
        $c = Connection::dameInstancia();
        $conexion = $c->dameConexion();
        $sql = "SELECT tipo_usuario FROM usuarios WHERE id_usuario='" . $id . "'";
        if ($conexion->real_query($sql)) {
            if ($resul = $conexion->store_result()) {
                $mostrar = $resul->fetch_assoc();
                
                return $mostrar["tipo_usuario"];
            }
        } else {
            
            echo $conexion->errno . " -> " . $conexion->error;
        }
    }

    /**
     * getMail
     * Función que devuelve el mail pasándole su id.
     *
     * @param
     *            $id
     * @return $mostrar["mail"]
     */
    public function getMail($id)
    {
        $c = Connection::dameInstancia();
        $conexion = $c->dameConexion();
        $sql = "SELECT mail FROM usuarios WHERE id_usuario='" . $id . "'";
        if ($conexion->real_query($sql)) {
            if ($resul = $conexion->store_result()) {
                $mostrar = $resul->fetch_assoc();
                
                return $mostrar["mail"];
            }
        } else {
            
            echo $conexion->errno . " -> " . $conexion->error;
        }
    }

    /**
     * esRegistrado
     * Método que se utiliza para comprobar si un usuario está registrado y poder loguearse.
     *
     * @param
     *            $nick
     * @param
     *            $pass
     * @return $registro['id_usuario'], si no está registrado devuelve -1
     */
    public function esRegistrado($nick, $pass)
    {
        $passMD5 = md5($pass);
        $sql = "SELECT * FROM $this->tabla WHERE UPPER(nick)=UPPER('$nick') AND pass ='$passMD5'";
        if ($this->c->real_query($sql)) {
            if ($result = @$this->c->store_result()) {
                if ($result->num_rows == 1) {
                    $registro = $result->fetch_assoc();
                    
                    return $registro['id_usuario'];
                }
                $result->free_result();
            } else {
                
                return - 1; // no hay usuario registrado
            }
        } else {
            
            return $this->c->errno . "->" . $this->c->error;
        }
    }

    /**
     * esRegistradoNick
     * Método que se utiliza para comprobar si un usuario está registrado y poder loguearse.
     *
     * @param
     *            $nick
     * @return $registro['id_usuario'], si no está registrado devuelve -1
     */
    public function esRegistradoNick($nick)
    {
        $sql = "SELECT * FROM $this->tabla WHERE UPPER(nick)=UPPER('$nick')";
        if ($this->c->real_query($sql)) {
            if ($result = @$this->c->store_result()) {
                if ($result->num_rows == 1) {
                    $registro = $result->fetch_assoc();
                    
                    return $registro['id_usuario'];
                }
                $result->free_result();
            } else {
                
                return - 1; // no hay usuario registrado
            }
        } else {
            
            return $this->c->errno . "->" . $this->c->error;
        }
    }

    /**
     * esRegistradoMail
     * Método que se utiliza para comprobar si un usuario está registrado y poder cambiar su pass.
     *
     * @param
     *            $mail
     * @return $registro['id_usuario'], si no está registrado devuelve -1
     */
    public function esRegistradoMail($mail)
    {
        $sql = "SELECT * FROM $this->tabla WHERE mail ='$mail'";
        if ($this->c->real_query($sql)) {
            if ($result = @$this->c->store_result()) {
                if ($result->num_rows == 1) {
                    $registro = $result->fetch_assoc();
                    
                    return $registro['id_usuario'];
                }
                $result->free_result();
            } else {
                
                return - 1; // no hay usuario registrado
            }
        } else {
            
            return $this->c->errno . "->" . $this->c->error;
        }
    }

    /**
     * existeUsuario
     * Comprueba si el nick del usuario no existe para poder registrarlo como uno nuevo (grabar_registro_header.php)
     * El nick del usuario siempre va a ser de tipo UNIQUE
     *
     * @param
     *            $nick
     * @return boolean
     */
    public function existeUsuario($nick)
    {
        $sql = "SELECT nick FROM $this->tabla WHERE UPPER(nick)=UPPER('$nick')";
        if ($this->c->real_query($sql)) {
            if ($result = $this->c->store_result()) {
                if ($result->num_rows == 1) {
                    $result->free_result();
                    
                    return true;
                } else {
                    $result->free_result();
                    
                    return false;
                }
            } else {
                return false;
            }
        } else {
            
            return "Error nº" . $this->c->errno;
        }
    }

    /**
     * existeCodigoPatrocinio
     * Comprueba si el codigoPatrocinio existe y si es así suma 10 puntos al que envió la invitación.
     *
     * @param
     *            $codigoPatrocinio
     * @return boolean
     */
    public function existeCodigoPatrocinio($codigoPatrocinio)
    {
        $bd = Connection::dameInstancia();
        $c = $bd->dameConexion();
        $sql = "SELECT nick FROM usuarios WHERE codigoPatrocinio = '$codigoPatrocinio'";
        if ($c->real_query($sql)) {
            if ($resul = $c->store_result()) {
                if ($resul->num_rows == 1) {
                    $mostrar = $resul->fetch_assoc();
                    $nick = $mostrar["nick"];
                    $puntos = 10;
                    $this->sumarPuntosRegistro($nick, $puntos);
                    
                    return true;
                } else {
                    
                    return false;
                }
            }
        } else {
            
            echo $c->errno . " -> " . $c->error;
        }
    }

    /**
     * esmailRepetido
     * Comprueba si el mail del usuario no existe para poder registrarlo como uno nuevo (grabar_registro_header.php)
     * El mail del usuario siempre va a ser de tipo UNIQUE
     *
     * @param
     *            $mail
     * @return boolean
     */
    public function esmailRepetido($mail)
    {
        $sql = "SELECT * FROM $this->tabla WHERE mail='$mail'";
        if ($this->c->real_query($sql)) {
            if ($result = $this->c->store_result()) {
                if ($result->num_rows == 1) {
                    $result->free_result();
                    
                    return true;
                } else {
                    $result->free_result();
                    
                    return false;
                }
            }
        } else {
            
            return "Error nº" . $this->c->errno;
        }
    }

    /**
     * sonAmigos
     * Comprueba si dos usuarios son amigos haciendo una consulta en la tabla usuarios_amigos
     * Dos usuarios serán amigos si el id1 corresponde al usuario1, el id2 corresponde al usuario2 y el estado=2.
     *
     * @param
     *            $id1
     * @param
     *            $id2
     * @return boolean
     */
    public function sonAmigos($id1, $id2)
    {
        $c = Connection::dameInstancia();
        $conexion = $c->dameConexion();
        $sql = "SELECT * FROM usuarios_amigos WHERE id_usuario1='$id1' AND id_usuario2='$id2' AND estado=2";
        if ($conexion->real_query($sql)) {
            if ($result = $conexion->store_result()) {
                if ($result->num_rows > 0) {
                    $result->free_result();
                    
                    return true;
                } else {
                    $result->free_result();
                    
                    return false;
                }
            }
        } else {
            
            return "Error nº" . $conexion->errno;
        }
    }

    /**
     * solicitudEnviada
     * Comprueba si se ha enviado alguna solicitud entre dos usuarios, una solicitud está enviada
     * cuando el id del usuario 1 es igual a su id, lo mismo para el usuario2 y el estado=1.
     *
     * @param
     *            $id1
     * @param
     *            $id2
     * @return boolean
     */
    public function solicitudEnviada($id1, $id2)
    {
        $c = Connection::dameInstancia();
        $conexion = $c->dameConexion();
        $sql = "SELECT * FROM usuarios_amigos WHERE estado=1 AND (id_usuario1='$id1' AND id_usuario2='$id2') OR (id_usuario1='$id2' AND id_usuario2='$id1')";
        if ($conexion->real_query($sql)) {
            if ($result = $conexion->store_result()) {
                if ($result->num_rows > 0) {
                    
                    $result->free_result();
                    return true;
                } else {
                    $result->free_result();
                    
                    return false;
                }
            }
        } else {
            
            return "Error nº" . $conexion->errno;
        }
    }

    /**
     * enviarMailSolicitud
     * Envía un email informando al usuario con id2 que ha recibido una solicitud de amistad.
     *
     * @param
     *            $id1
     * @param
     *            $id2
     */
    public function enviarMailSolicitud($id1, $id2)
    {
        $imagen = '../img/DEVORALIBROS_8_72ppi.png';
        $mail = $this->getMail($id2);
        $nombre2 = $this->getNombre($id2);
        $nick1 = $this->getNick($id1);
        
        $smtp = new PHPMailer();
        
        // Indicamos que vamos a utilizar un servidor SMTP
        $smtp->IsSMTP();
        
        // Definimos el formato del correo con UTF-8
        $smtp->CharSet = "UTF-8";
        
        // autenticación contra nuestro servidor smtp
        $smtp->SMTPAuth = true;
        // $smtp->SMTPSecure = "tls";
        $smtp->Host = "smtp.devoralibros.es";
        $smtp->Username = $this->correoAdministrador;
        $smtp->Password = $this->contrasena;
        $smtp->Port = 587;
        
        // datos de quien realiza el envio
        $smtp->From = "administrador@devoralibros.es"; // from mail
        $smtp->FromName = "Administrador de Devoralibros"; // from mail name
                                                           
        // Indicamos las direcciones donde enviar el mensaje con el formato
                                                           // "correo"=>"nombre usuario"
                                                           // Se pueden poner tantos correos como se deseen
        $mailTo = array(
            $mail => ""
            // "correo_2_DondeSeEnviaElMensaje@servidor.info"=>"Nombre_2 persona que recibe el correo",
            // "correo_3_DondeSeEnviaElMensaje@servidor.info"=>"Nombre_3 persona que recibe el correo"
        );
        
        // establecemos un limite de caracteres de anchura
        $smtp->WordWrap = 50; // set word wrap
                              
        // NOTA: Los correos es conveniente enviarlos en formato HTML y Texto para que
                              // cualquier programa de correo pueda leerlo.
                              
        // Definimos el contenido HTML del correo
        $contenidoHTML = "<head>";
        $contenidoHTML .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">";
        $contenidoHTML .= "</head><body>";
        $contenidoHTML .= "<h1 style='color:blue;'>Hola " . $nombre2 . "</h1> ";
        $contenidoHTML .= '<p>Has recibido una solicitud de amistad de ' . $nick1 . ', si quieres aceptarla ve a tu p&aacute;gina de perfil, secci&oacute;n "Mis amigos".
						<br/><a href="https://www.devoralibros.es">¡Entra a Devoralibros!</a>
						<br/><br/>Saludos y recuerda...NUNCA DEJES DE LEER!</p>
						<br/><br/>
						<a href="https://www.devoralibros.es"><img src="' . $imagen . '" width="150"/></a>
						<p>Beatriz, Belén, Esther y Miguel
						<br/><strong>Administradores de DevoraLibros</strong>
                        <br/><br/>
                        Si en cualquier momento quieres dejar de recibir estos correos puedes <a href="https://www.devoralibros.es/FormularioInicioSesion/">darte de baja</a> desde tu perfil.
                        <br/><br/>
                        <i>Estimado usuario, para nosotros es muy importante la privacidad, por ello, en cumplimento del nuevo RGPD te recordamos que recibes este email porque te has suscrito de manera voluntaria a nuestra lista de correo electrónico. Tus datos se almacenarán en nuestra Base de Datos, con la finalidad de enviarte correos electrónicos. Asimismo, te informamos de que tus datos serán tratados con la mayor confidencialidad posible y que con tu aceptación estarías mostrando tu consentimiento a recibir correos electrónicos comerciales propios o sobre productos de terceros. En cada comunicación que recibas de esta web tendrás la opción de darte de baja de esta lista y revocar tu consentimiento.</i></p>';
        $contenidoHTML .= "</body>\n";
        
        // Definimos el contenido en formato Texto del correo
        // $contenidoTexto="Contenido en formato Texto";
        // $contenidoTexto.="\n\nhttps://www.lawebdelprogramador.com";
        
        // Definimos el subject
        $smtp->Subject = "Devoralibros";
        
        // Adjuntamos el archivo "leameLWP.txt" al correo.
        // Obtenemos la ruta absoluta de donde se ejecuta este script para encontrar el
        // archivo leameLWP.txt para adjuntar. Por ejemplo, si estamos ejecutando nuestro
        // script en: /home/xve/test/sendMail.php, nos interesa obtener unicamente:
        // /home/xve/test para posteriormente adjuntar el archivo leameLWP.txt, quedando
        // /home/xve/test/leameLWP.txt
        $rutaAbsoluta = substr($_SERVER["SCRIPT_FILENAME"], 0, strrpos($_SERVER["SCRIPT_FILENAME"], "/"));
        // $smtp->AddAttachment($rutaAbsoluta."/leameLWP.txt", "LeameLWP.txt");
        
        // Indicamos el contenido
        $smtp->AltBody = $contenidoTexto; // Text Body
        $smtp->MsgHTML($contenidoHTML); // Text body HTML
        
        foreach ($mailTo as $mail => $name) {
            $smtp->ClearAllRecipients();
            $smtp->AddAddress($mail, $name);
            
            $smtp->Send(); // Envía el correo.
        }
    }

    /**
     * generarCodigo
     * Creamos un código numérico aleatorio con la longitud que deseemos
     *
     * @param
     *            $longitud
     * @return $key
     */
    function generarCodigo($longitud)
    {
        $key = '';
        $pattern = '1234567890';
        $max = strlen($pattern) - 1;
        for ($i = 0; $i < $longitud; $i ++)
            $key .= $pattern{mt_rand(0, $max)};
        return $key;
    }

    /**
     * enviarConfirmacionRegistro
     * Envía un email para confirmar el registro
     *
     * @param
     *            $id1
     * @param
     *            $pass
     */
    public function enviarConfirmacionRegistro($nick, $pass)
    {
        $imagen = '../img/DEVORALIBROS_8_72ppi.png';
        $id = $this->getIdusuario($nick);
        $mail = $this->getMail($id);
        
        $smtp = new PHPMailer();
        
        // Indicamos que vamos a utilizar un servidor SMTP
        $smtp->IsSMTP();
        
        // Definimos el formato del correo con UTF-8
        $smtp->CharSet = "UTF-8";
        
        // autenticación contra nuestro servidor smtp
        $smtp->SMTPAuth = true;
        // $smtp->SMTPSecure = "tls";
        $smtp->Host = "smtp.devoralibros.es";
        $smtp->Username = $this->correoAdministrador;
        $smtp->Password = $this->contrasena;
        $smtp->Port = 587;
        
        // datos de quien realiza el envio
        $smtp->From = "administrador@devoralibros.es"; // from mail
        $smtp->FromName = "Administrador de Devoralibros"; // from mail name
                                                           
        // Indicamos las direcciones donde enviar el mensaje con el formato
                                                           // "correo"=>"nombre usuario"
                                                           // Se pueden poner tantos correos como se deseen
        $mailTo = array(
            $mail => ""
            // "correo_2_DondeSeEnviaElMensaje@servidor.info"=>"Nombre_2 persona que recibe el correo",
            // "correo_3_DondeSeEnviaElMensaje@servidor.info"=>"Nombre_3 persona que recibe el correo"
        );
        
        // establecemos un limite de caracteres de anchura
        $smtp->WordWrap = 50; // set word wrap
                              
        // NOTA: Los correos es conveniente enviarlos en formato HTML y Texto para que
                              // cualquier programa de correo pueda leerlo.
                              
        // Definimos el contenido HTML del correo
        $contenidoHTML = "<head>";
        $contenidoHTML .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">";
        $contenidoHTML .= "</head><body>";
        $contenidoHTML .= "<h1 style='color:blue;'>Confirma tu registro " . $nick . "</h1>";
        $contenidoHTML .= '<p>¡Estás a sólo un paso de convertirte en un auténtico DevoraLibros!Aquí tienes tus datos para registrarte, más adelante podrás cambiar tu contraseña en tu página de perfil haciendo click en "editar perfil".
						<br/><br/><strong>Contraseña:</strong>' . $pass . '
						<br/><strong>Nick:</strong>' . $nick . '
						<br/><a href="https://www.devoralibros.es/FormularioInicioSesion/">¡Confirma tu registro!</a>
						<br/><br/>Saludos y recuerda...NUNCA DEJES DE LEER!</p>
						<br/><br/>
						<a href="https://www.devoralibros.es"><img src="' . $imagen . '" width="150"/></a>
						<p>Beatriz, Belén, Esther y Miguel
						<br/><strong>Administradores de DevoraLibros</strong>
                        <br/><br/>
                        Si en cualquier momento quieres dejar de recibir estos correos puedes <a href="https://www.devoralibros.es/FormularioInicioSesion/">darte de baja</a> desde tu perfil.
                        <br/><br/>
                        <i>Estimado usuario, para nosotros es muy importante la privacidad, por ello, en cumplimento del nuevo RGPD te recordamos que recibes este email porque te has suscrito de manera voluntaria a nuestra lista de correo electrónico. Tus datos se almacenarán en nuestra Base de Datos, con la finalidad de enviarte correos electrónicos. Asimismo, te informamos de que tus datos serán tratados con la mayor confidencialidad posible y que con tu aceptación estarías mostrando tu consentimiento a recibir correos electrónicos comerciales propios o sobre productos de terceros. En cada comunicación que recibas de esta web tendrás la opción de darte de baja de esta lista y revocar tu consentimiento.</i></p>';
        $contenidoHTML .= "</body>\n";
        
        // Definimos el contenido en formato Texto del correo
        // $contenidoTexto="Contenido en formato Texto";
        // $contenidoTexto.="\n\nhttps://www.lawebdelprogramador.com";
        
        // Definimos el subject
        $smtp->Subject = "Devoralibros";
        
        // Adjuntamos el archivo "leameLWP.txt" al correo.
        // Obtenemos la ruta absoluta de donde se ejecuta este script para encontrar el
        // archivo leameLWP.txt para adjuntar. Por ejemplo, si estamos ejecutando nuestro
        // script en: /home/xve/test/sendMail.php, nos interesa obtener unicamente:
        // /home/xve/test para posteriormente adjuntar el archivo leameLWP.txt, quedando
        // /home/xve/test/leameLWP.txt
        $rutaAbsoluta = substr($_SERVER["SCRIPT_FILENAME"], 0, strrpos($_SERVER["SCRIPT_FILENAME"], "/"));
        // $smtp->AddAttachment($rutaAbsoluta."/leameLWP.txt", "LeameLWP.txt");
        
        // Indicamos el contenido
        $smtp->AltBody = $contenidoTexto; // Text Body
        $smtp->MsgHTML($contenidoHTML); // Text body HTML
        
        foreach ($mailTo as $mail => $name) {
            $smtp->ClearAllRecipients();
            $smtp->AddAddress($mail, $name);
            
            if ($smtp->Send()) {
                // Envía el correo.
                $this->enviarMailsAltaUsuario($nick, $mail);
            }
        }
    }

    /**
     * enviarMail
     * Envía un email informando al usuario con id2 que ha recibido un mensaje.
     *
     * @param
     *            $id1
     * @param
     *            $id2
     * @param
     *            $mensaje
     */
    public function enviarMail($id1, $id2, $mensaje)
    {
        $men = htmlentities($mensaje, ENT_QUOTES, "UTF-8");
        $mail = $this->getMail($id2);
        $nombre2 = $this->getNombre($id2);
        $nick1 = $this->getNick($id1);
        $imagen = '../img/DEVORALIBROS_8_72ppi.png';
        
        $smtp = new PHPMailer();
        
        // Indicamos que vamos a utilizar un servidor SMTP
        $smtp->IsSMTP();
        
        // Definimos el formato del correo con UTF-8
        $smtp->CharSet = "UTF-8";
        
        // autenticación contra nuestro servidor smtp
        $smtp->SMTPAuth = true;
        // $smtp->SMTPSecure = "tls";
        $smtp->Host = "smtp.devoralibros.es";
        $smtp->Username = $this->correoAdministrador;
        $smtp->Password = $this->contrasena;
        $smtp->Port = 587;
        
        // datos de quien realiza el envio
        $smtp->From = "administrador@devoralibros.es"; // from mail
        $smtp->FromName = "Administrador de Devoralibros"; // from mail name
                                                           
        // Indicamos las direcciones donde enviar el mensaje con el formato
                                                           // "correo"=>"nombre usuario"
                                                           // Se pueden poner tantos correos como se deseen
        $mailTo = array(
            $mail => ""
            // "correo_2_DondeSeEnviaElMensaje@servidor.info"=>"Nombre_2 persona que recibe el correo",
            // "correo_3_DondeSeEnviaElMensaje@servidor.info"=>"Nombre_3 persona que recibe el correo"
        );
        
        // establecemos un limite de caracteres de anchura
        $smtp->WordWrap = 50; // set word wrap
                              
        // NOTA: Los correos es conveniente enviarlos en formato HTML y Texto para que
                              // cualquier programa de correo pueda leerlo.
                              
        // Definimos el contenido HTML del correo
        $contenidoHTML = "<head>";
        $contenidoHTML .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">";
        $contenidoHTML .= "</head><body>";
        $contenidoHTML .= "<h1 style='color:blue;'>Hola " . $nombre2 . "</h1>
						<p>Has recibido un mensaje de " . $nick1 . "</p>";
        $contenidoHTML .= '<p>' . $men . '
						<br/><a href="https://www.devoralibros.es/FormularioInicioSesion/">¡Entra a Devoralibros!</a>
						<br/><br/>Saludos y recuerda...NUNCA DEJES DE LEER!</p>
						<br/><br/>
						<a href="https://www.devoralibros.es"><img src="' . $imagen . '" width="150"/></a>
						<p>Beatriz, Belén, Esther y Miguel
						<br/><strong>Administradores de DevoraLibros</strong>
                        <br/><br/>
                        Si en cualquier momento quieres dejar de recibir estos correos puedes <a href="https://www.devoralibros.es/FormularioInicioSesion/">darte de baja</a> desde tu perfil.
                        <br/><br/>
                        <i>Estimado usuario, para nosotros es muy importante la privacidad, por ello, en cumplimento del nuevo RGPD te recordamos que recibes este email porque te has suscrito de manera voluntaria a nuestra lista de correo electrónico. Tus datos se almacenarán en nuestra Base de Datos, con la finalidad de enviarte correos electrónicos. Asimismo, te informamos de que tus datos serán tratados con la mayor confidencialidad posible y que con tu aceptación estarías mostrando tu consentimiento a recibir correos electrónicos comerciales propios o sobre productos de terceros. En cada comunicación que recibas de esta web tendrás la opción de darte de baja de esta lista y revocar tu consentimiento.</i></p>';
        $contenidoHTML .= "</body>\n";
        
        // Definimos el contenido en formato Texto del correo
        // $contenidoTexto="Contenido en formato Texto";
        // $contenidoTexto.="\n\nhttps://www.lawebdelprogramador.com";
        
        // Definimos el subject
        $smtp->Subject = "Devoralibros";
        
        // Adjuntamos el archivo "leameLWP.txt" al correo.
        // Obtenemos la ruta absoluta de donde se ejecuta este script para encontrar el
        // archivo leameLWP.txt para adjuntar. Por ejemplo, si estamos ejecutando nuestro
        // script en: /home/xve/test/sendMail.php, nos interesa obtener unicamente:
        // /home/xve/test para posteriormente adjuntar el archivo leameLWP.txt, quedando
        // /home/xve/test/leameLWP.txt
        $rutaAbsoluta = substr($_SERVER["SCRIPT_FILENAME"], 0, strrpos($_SERVER["SCRIPT_FILENAME"], "/"));
        // $smtp->AddAttachment($rutaAbsoluta."/leameLWP.txt", "LeameLWP.txt");
        
        // Indicamos el contenido
        $smtp->AltBody = $contenidoTexto; // Text Body
        $smtp->MsgHTML($contenidoHTML); // Text body HTML
        
        foreach ($mailTo as $mail => $name) {
            $smtp->ClearAllRecipients();
            $smtp->AddAddress($mail, $name);
            
            $smtp->Send(); // Envía el correo.
        }
    }

    /**
     * enviarMailBienvenida
     * Envía un email dando al usuario la bienvenida.
     *
     * @param
     *            $nick
     * @param
     *            $mail
     */
    // public function enviarMailBienvenida($nick, $mail)
    // {
    // $imagen = '../img/DEVORALIBROS_8_72ppi.png';
    
    // $smtp = new PHPMailer();
    
    // // Indicamos que vamos a utilizar un servidor SMTP
    // $smtp->IsSMTP();
    
    // // Definimos el formato del correo con UTF-8
    // $smtp->CharSet = "UTF-8";
    
    // // autenticación contra nuestro servidor smtp
    // $smtp->SMTPAuth = true;
    // // $smtp->SMTPSecure = "tls";
    // $smtp->Host = "smtp.devoralibros.es";
    // $smtp->Username = $this->correoAdministrador;
    // $smtp->Password = $this->contrasena;
    // $smtp->Port = 587;
    
    // // datos de quien realiza el envio
    // $smtp->From = "administrador@devoralibros.es"; // from mail
    // $smtp->FromName = "Administrador de Devoralibros"; // from mail name
    
    // // Indicamos las direcciones donde enviar el mensaje con el formato
    // // "correo"=>"nombre usuario"
    // // Se pueden poner tantos correos como se deseen
    // $mailTo = array(
    // $mail => ""
    // // "correo_2_DondeSeEnviaElMensaje@servidor.info"=>"Nombre_2 persona que recibe el correo",
    // // "correo_3_DondeSeEnviaElMensaje@servidor.info"=>"Nombre_3 persona que recibe el correo"
    // );
    
    // // establecemos un limite de caracteres de anchura
    // $smtp->WordWrap = 50; // set word wrap
    
    // // NOTA: Los correos es conveniente enviarlos en formato HTML y Texto para que
    // // cualquier programa de correo pueda leerlo.
    
    // // Definimos el contenido HTML del correo
    // $contenidoHTML = "<head>";
    // $contenidoHTML .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">";
    // $contenidoHTML .= "</head><body>";
    // $contenidoHTML .= "<h1 style='color:blue;'>Bienvenido a DevoraLibros " . $nick . "</h1>";
    // $contenidoHTML .= '<p>¿Por qué no te animas a comentar algún libro de los ya subidos o, mejor aún, a subir alguno que quieras hacer un resumen personal? En esta comunidad podrás dar rienda suelta a tus pensamientos sobre libros.
    // <br/><a href="https://www.devoralibros.es/FormularioInicioSesion/">¡Entra a Devoralibros!</a>
    // <br/><br/>Saludos y recuerda...NUNCA DEJES DE LEER!</p>
    // <br/><br/>
    // <a href="https://www.devoralibros.es"><img src="' . $imagen . '" width="150"/></a>
    // <p>Beatriz, Belén, Esther y Miguel
    // <br/><strong>Administradores de DevoraLibros</strong>
    // <br/><br/>
    // Si en cualquier momento quieres dejar de recibir estos correos puedes <a href="https://www.devoralibros.es/FormularioInicioSesion/">darte de baja</a> desde tu perfil.
    // <br/><br/>
    // <i>Estimado usuario, para nosotros es muy importante la privacidad, por ello, en cumplimento del nuevo RGPD te recordamos que recibes este email porque te has suscrito de manera voluntaria a nuestra lista de correo electrónico. Tus datos se almacenarán en nuestra Base de Datos, con la finalidad de enviarte correos electrónicos. Asimismo, te informamos de que tus datos serán tratados con la mayor confidencialidad posible y que con tu aceptación estarías mostrando tu consentimiento a recibir correos electrónicos comerciales propios o sobre productos de terceros. En cada comunicación que recibas de esta web tendrás la opción de darte de baja de esta lista y revocar tu consentimiento.</i></p>';
    // $contenidoHTML .= "</body>\n";
    
    // // Definimos el contenido en formato Texto del correo
    // // $contenidoTexto="Contenido en formato Texto";
    // // $contenidoTexto.="\n\nhttps://www.lawebdelprogramador.com";
    
    // // Definimos el subject
    // $smtp->Subject = "Devoralibros";
    
    // // Adjuntamos el archivo "leameLWP.txt" al correo.
    // // Obtenemos la ruta absoluta de donde se ejecuta este script para encontrar el
    // // archivo leameLWP.txt para adjuntar. Por ejemplo, si estamos ejecutando nuestro
    // // script en: /home/xve/test/sendMail.php, nos interesa obtener unicamente:
    // // /home/xve/test para posteriormente adjuntar el archivo leameLWP.txt, quedando
    // // /home/xve/test/leameLWP.txt
    // $rutaAbsoluta = substr($_SERVER["SCRIPT_FILENAME"], 0, strrpos($_SERVER["SCRIPT_FILENAME"], "/"));
    // // $smtp->AddAttachment($rutaAbsoluta."/leameLWP.txt", "LeameLWP.txt");
    
    // // Indicamos el contenido
    // $smtp->AltBody = $contenidoTexto; // Text Body
    // $smtp->MsgHTML($contenidoHTML); // Text body HTML
    
    // foreach ($mailTo as $mail => $name) {
    // $smtp->ClearAllRecipients();
    // $smtp->AddAddress($mail, $name);
    
    // $smtp->Send(); // Envía el correo.
    // }
    
    // $this->enviarMailsAltaUsuario($nick, $mail);
    // }
    
    /**
     * enviarEmailInvitacion
     * Envia un email al usuario al que has enviado la invitacion.
     *
     * @param
     *            $nick
     * @param
     *            $mail
     * @param
     *            $codigoPatrocinio
     */
    public function enviarEmailInvitacion($mail, $nick, $codigoPatrocinio)
    {
        $imagen = '../img/DEVORALIBROS_8_72ppi.png';
        
        $smtp = new PHPMailer();
        
        // Indicamos que vamos a utilizar un servidor SMTP
        $smtp->IsSMTP();
        
        // Definimos el formato del correo con UTF-8
        $smtp->CharSet = "UTF-8";
        
        // autenticación contra nuestro servidor smtp
        $smtp->SMTPAuth = true;
        // $smtp->SMTPSecure = "tls";
        $smtp->Host = "smtp.devoralibros.es";
        $smtp->Username = $this->correoAdministrador;
        $smtp->Password = $this->contrasena;
        $smtp->Port = 587;
        
        // datos de quien realiza el envio
        $smtp->From = "miguel@devoralibros.es"; // from mail
        $smtp->FromName = "Administrador de Devoralibros"; // from mail name
                                                           
        // Indicamos las direcciones donde enviar el mensaje con el formato
                                                           // "correo"=>"nombre usuario"
                                                           // Se pueden poner tantos correos como se deseen
        $mailTo = array(
            $mail => ""
            // "correo_2_DondeSeEnviaElMensaje@servidor.info"=>"Nombre_2 persona que recibe el correo",
            // "correo_3_DondeSeEnviaElMensaje@servidor.info"=>"Nombre_3 persona que recibe el correo"
        );
        
        // establecemos un limite de caracteres de anchura
        $smtp->WordWrap = 50; // set word wrap
                              
        // NOTA: Los correos es conveniente enviarlos en formato HTML y Texto para que
                              // cualquier programa de correo pueda leerlo.
                              
        // Definimos el contenido HTML del correo
        $contenidoHTML = "<head>";
        $contenidoHTML .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">";
        $contenidoHTML .= "</head><body>";
        $contenidoHTML .= "<h1 style='color:blue;'>Bienvenido a Devoralibros</h1>";
        $contenidoHTML .= '<p>¡Hola futuro devorador de libros! Un amigo tuyo, <i>' . $nick . '</i>, te ha enviado una invitación para que te registres en DevoraLibros.
						<br/>Tu código de registro es: <strong>' . $codigoPatrocinio . '</strong>, introdúcelo al registrarte y tanto tu amigo como tu recibiréis 10 puntos extras.
						<br/><a href="https://www.devoralibros.es/FormularioInicioSesion/">¡Entra a Devoralibros!</a>
						<br/><br/>Saludos y recuerda...NUNCA DEJES DE LEER!</p>
						<br/><br/>
						<a href="https://www.devoralibros.es"><img src="' . $imagen . '" width="150"/></a>
						<p>Beatriz, Belén, Esther y Miguel
						<br/><strong>Administradores de DevoraLibros</strong>
                        <br/><br/>
                        Si en cualquier momento quieres dejar de recibir estos correos puedes <a href="https://www.devoralibros.es/FormularioInicioSesion/">darte de baja</a> desde tu perfil.
                        <br/><br/>
                        <i>Estimado usuario, para nosotros es muy importante la privacidad, por ello, en cumplimento del nuevo RGPD te recordamos que recibes este email porque te has suscrito de manera voluntaria a nuestra lista de correo electrónico. Tus datos se almacenarán en nuestra Base de Datos, con la finalidad de enviarte correos electrónicos. Asimismo, te informamos de que tus datos serán tratados con la mayor confidencialidad posible y que con tu aceptación estarías mostrando tu consentimiento a recibir correos electrónicos comerciales propios o sobre productos de terceros. En cada comunicación que recibas de esta web tendrás la opción de darte de baja de esta lista y revocar tu consentimiento.</i></p>';
        $contenidoHTML .= "</body>\n";
        
        // Definimos el contenido en formato Texto del correo
        // $contenidoTexto="Contenido en formato Texto";
        // $contenidoTexto.="\n\nhttps://www.lawebdelprogramador.com";
        
        // Definimos el subject
        $smtp->Subject = "Devoralibros";
        
        // Adjuntamos el archivo "leameLWP.txt" al correo.
        // Obtenemos la ruta absoluta de donde se ejecuta este script para encontrar el
        // archivo leameLWP.txt para adjuntar. Por ejemplo, si estamos ejecutando nuestro
        // script en: /home/xve/test/sendMail.php, nos interesa obtener unicamente:
        // /home/xve/test para posteriormente adjuntar el archivo leameLWP.txt, quedando
        // /home/xve/test/leameLWP.txt
        $rutaAbsoluta = substr($_SERVER["SCRIPT_FILENAME"], 0, strrpos($_SERVER["SCRIPT_FILENAME"], "/"));
        // $smtp->AddAttachment($rutaAbsoluta."/leameLWP.txt", "LeameLWP.txt");
        
        // Indicamos el contenido
        $smtp->AltBody = $contenidoTexto; // Text Body
        $smtp->MsgHTML($contenidoHTML); // Text body HTML
        
        foreach ($mailTo as $mail => $name) {
            $smtp->ClearAllRecipients();
            $smtp->AddAddress($mail, $name);
            
            $smtp->Send(); // Envía el correo.
        }
    }

    /**
     * enviarMailComentario
     * Envía un email informando al usuario que ha recibido un comentario sobre su libro.
     *
     * @param
     *            $id
     * @param
     *            $titulo
     */
    public function enviarMailComentario($id, $titulo)
    {
        $nick = $this->getNick($id);
        $mail = $this->getMail($id);
        $imagen = '../img/DEVORALIBROS_8_72ppi.png';
        
        $smtp = new PHPMailer();
        
        // Indicamos que vamos a utilizar un servidor SMTP
        $smtp->IsSMTP();
        
        // Definimos el formato del correo con UTF-8
        $smtp->CharSet = "UTF-8";
        
        // autenticación contra nuestro servidor smtp
        $smtp->SMTPAuth = true;
        // $smtp->SMTPSecure = "tls";
        $smtp->Host = "smtp.devoralibros.es";
        $smtp->Username = $this->correoAdministrador;
        $smtp->Password = $this->contrasena;
        $smtp->Port = 587;
        
        // datos de quien realiza el envio
        $smtp->From = "administrador@devoralibros.es"; // from mail
        $smtp->FromName = "Administrador de Devoralibros"; // from mail name
                                                           
        // Indicamos las direcciones donde enviar el mensaje con el formato
                                                           // "correo"=>"nombre usuario"
                                                           // Se pueden poner tantos correos como se deseen
        $mailTo = array(
            $mail => ""
            // "correo_2_DondeSeEnviaElMensaje@servidor.info"=>"Nombre_2 persona que recibe el correo",
            // "correo_3_DondeSeEnviaElMensaje@servidor.info"=>"Nombre_3 persona que recibe el correo"
        );
        
        // establecemos un limite de caracteres de anchura
        $smtp->WordWrap = 50; // set word wrap
                              
        // NOTA: Los correos es conveniente enviarlos en formato HTML y Texto para que
                              // cualquier programa de correo pueda leerlo.
                              
        // Definimos el contenido HTML del correo
        $contenidoHTML = "<head>";
        $contenidoHTML .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">";
        $contenidoHTML .= "</head><body>";
        $contenidoHTML .= "<h1 style='color:blue;'>Hola " . $nick . "</h1>";
        $contenidoHTML .= '<p>Tu libro, ' . $titulo . ', ha recibido un comentario de un usuario, ¿te gustaría leerlo? .
						<br/><a href="https://www.devoralibros.es/FormularioInicioSesion/">¡Entra a Devoralibros!</a>
						<br/><br/>Saludos y recuerda...NUNCA DEJES DE LEER!</p>
						<br/><br/>
						<a href="https://www.devoralibros.es"><img src="' . $imagen . '" width="150"/></a>
						<p>Beatriz, Belén, Esther y Miguel
						<br/><strong>Administradores de DevoraLibros</strong>
                        <br/><br/>
                        Si en cualquier momento quieres dejar de recibir estos correos puedes <a href="https://www.devoralibros.es/FormularioInicioSesion/">darte de baja</a> desde tu perfil.
                        <br/><br/>
                        <i>Estimado usuario, para nosotros es muy importante la privacidad, por ello, en cumplimento del nuevo RGPD te recordamos que recibes este email porque te has suscrito de manera voluntaria a nuestra lista de correo electrónico. Tus datos se almacenarán en nuestra Base de Datos, con la finalidad de enviarte correos electrónicos. Asimismo, te informamos de que tus datos serán tratados con la mayor confidencialidad posible y que con tu aceptación estarías mostrando tu consentimiento a recibir correos electrónicos comerciales propios o sobre productos de terceros. En cada comunicación que recibas de esta web tendrás la opción de darte de baja de esta lista y revocar tu consentimiento.</i></p>';
        $contenidoHTML .= "</body>\n";
        
        // Definimos el contenido en formato Texto del correo
        // $contenidoTexto="Contenido en formato Texto";
        // $contenidoTexto.="\n\nhttps://www.lawebdelprogramador.com";
        
        // Definimos el subject
        $smtp->Subject = "Devoralibros";
        
        // Adjuntamos el archivo "leameLWP.txt" al correo.
        // Obtenemos la ruta absoluta de donde se ejecuta este script para encontrar el
        // archivo leameLWP.txt para adjuntar. Por ejemplo, si estamos ejecutando nuestro
        // script en: /home/xve/test/sendMail.php, nos interesa obtener unicamente:
        // /home/xve/test para posteriormente adjuntar el archivo leameLWP.txt, quedando
        // /home/xve/test/leameLWP.txt
        $rutaAbsoluta = substr($_SERVER["SCRIPT_FILENAME"], 0, strrpos($_SERVER["SCRIPT_FILENAME"], "/"));
        // $smtp->AddAttachment($rutaAbsoluta."/leameLWP.txt", "LeameLWP.txt");
        
        // Indicamos el contenido
        $smtp->AltBody = $contenidoTexto; // Text Body
        $smtp->MsgHTML($contenidoHTML); // Text body HTML
        
        foreach ($mailTo as $mail => $name) {
            $smtp->ClearAllRecipients();
            $smtp->AddAddress($mail, $name);
            
            $smtp->Send(); // Envía el correo.
        }
    }

    /**
     * enviarMailsSubidaLibro
     * Envía un email informandonos que se ha subido un libro.
     *
     * @param
     *            $titulo
     */
    public function enviarMailsSubidaLibro($titulo)
    {
        $imagen = '../img/DEVORALIBROS_8_72ppi.png';
        
        $smtp = new PHPMailer();
        
        // Indicamos que vamos a utilizar un servidor SMTP
        $smtp->IsSMTP();
        
        // Definimos el formato del correo con UTF-8
        $smtp->CharSet = "UTF-8";
        
        // autenticación contra nuestro servidor smtp
        $smtp->SMTPAuth = true;
        // $smtp->SMTPSecure = "tls";
        $smtp->Host = "smtp.devoralibros.es";
        $smtp->Username = $this->correoAdministrador;
        $smtp->Password = $this->contrasena;
        $smtp->Port = 587;
        
        // datos de quien realiza el envio
        $smtp->From = "administrador@devoralibros.es"; // from mail
        $smtp->FromName = "Administrador de Devoralibros"; // from mail name
                                                           
        // Indicamos las direcciones donde enviar el mensaje con el formato
                                                           // "correo"=>"nombre usuario"
                                                           // Se pueden poner tantos correos como se deseen
        $mailTo = array(
            "costa_torito@hotmail.com" => "Miguel",
            "esther_can85@hotmail.com" => "Esther",
            "blozares@gmail.com" => "Beatriz",
            "neleb_kas@hotmail.com" => "Belén"
        );
        
        // establecemos un limite de caracteres de anchura
        $smtp->WordWrap = 50; // set word wrap
                              
        // NOTA: Los correos es conveniente enviarlos en formato HTML y Texto para que
                              // cualquier programa de correo pueda leerlo.
                              
        // Definimos el contenido HTML del correo
        $contenidoHTML = "<head>";
        $contenidoHTML .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">";
        $contenidoHTML .= "</head><body>";
        $contenidoHTML .= "<h1 style='color:blue;'>¡Hola Administrador!</h1>";
        $contenidoHTML .= '<p>Se ha subido un libro nuevo, <strong>' . $titulo . '</strong>, ¿podrías revisar si está todo correcto y poner el enlace de Amazon? .
						<br/><a href="https://www.devoralibros.es/FormularioInicioSesion/">¡Entra a Devoralibros!</a>
						<br/><br/>Saludos y recuerda...NUNCA DEJES DE LEER!</p>
						<br/><br/>
						<a href="https://www.devoralibros.es"><img src="' . $imagen . '" width="150"/></a>
						<p>Beatriz, Belén, Esther y Miguel
						<br/><strong>Administradores de DevoraLibros</strong>
                        <br/><br/>
                        Si en cualquier momento quieres dejar de recibir estos correos puedes <a href="https://www.devoralibros.es/FormularioInicioSesion/">darte de baja</a> desde tu perfil.
                        <br/><br/>
                        <i>Estimado usuario, para nosotros es muy importante la privacidad, por ello, en cumplimento del nuevo RGPD te recordamos que recibes este email porque te has suscrito de manera voluntaria a nuestra lista de correo electrónico. Tus datos se almacenarán en nuestra Base de Datos, con la finalidad de enviarte correos electrónicos. Asimismo, te informamos de que tus datos serán tratados con la mayor confidencialidad posible y que con tu aceptación estarías mostrando tu consentimiento a recibir correos electrónicos comerciales propios o sobre productos de terceros. En cada comunicación que recibas de esta web tendrás la opción de darte de baja de esta lista y revocar tu consentimiento.</i></p>';
        $contenidoHTML .= "</body>\n";
        
        // Definimos el contenido en formato Texto del correo
        // $contenidoTexto="Contenido en formato Texto";
        // $contenidoTexto.="\n\nhttps://www.lawebdelprogramador.com";
        
        // Definimos el subject
        $smtp->Subject = "Devoralibros";
        
        // Adjuntamos el archivo "leameLWP.txt" al correo.
        // Obtenemos la ruta absoluta de donde se ejecuta este script para encontrar el
        // archivo leameLWP.txt para adjuntar. Por ejemplo, si estamos ejecutando nuestro
        // script en: /home/xve/test/sendMail.php, nos interesa obtener unicamente:
        // /home/xve/test para posteriormente adjuntar el archivo leameLWP.txt, quedando
        // /home/xve/test/leameLWP.txt
        $rutaAbsoluta = substr($_SERVER["SCRIPT_FILENAME"], 0, strrpos($_SERVER["SCRIPT_FILENAME"], "/"));
        // $smtp->AddAttachment($rutaAbsoluta."/leameLWP.txt", "LeameLWP.txt");
        
        // Indicamos el contenido
        $smtp->AltBody = $contenidoTexto; // Text Body
        $smtp->MsgHTML($contenidoHTML); // Text body HTML
        
        foreach ($mailTo as $mail => $name) {
            $smtp->ClearAllRecipients();
            $smtp->AddAddress($mail, $name);
            
            $smtp->Send(); // Envía el correo.
        }
    }

    /**
     * enviarMailsSubidaLibro
     * Envía un email informandonos que se ha subido un libro.
     *
     * @param
     *            $titulo
     */
    public function enviarMailsAltaUsuario($nick, $mail)
    {
        $imagen = '../img/DEVORALIBROS_8_72ppi.png';
        
        $smtp = new PHPMailer();
        
        // Indicamos que vamos a utilizar un servidor SMTP
        $smtp->IsSMTP();
        
        // Definimos el formato del correo con UTF-8
        $smtp->CharSet = "UTF-8";
        
        // autenticación contra nuestro servidor smtp
        $smtp->SMTPAuth = true;
        // $smtp->SMTPSecure = "tls";
        $smtp->Host = "smtp.devoralibros.es";
        $smtp->Username = $this->correoAdministrador;
        $smtp->Password = $this->contrasena;
        $smtp->Port = 587;
        
        // datos de quien realiza el envio
        $smtp->From = "administrador@devoralibros.es"; // from mail
        $smtp->FromName = "Administrador de Devoralibros"; // from mail name
                                                           
        // Indicamos las direcciones donde enviar el mensaje con el formato
                                                           // "correo"=>"nombre usuario"
                                                           // Se pueden poner tantos correos como se deseen
        $mailTo = array(
            "costa_torito@hotmail.com" => "Miguel",
            "esther_can85@hotmail.com" => "Esther",
            "blozares@gmail.com" => "Beatriz",
            "neleb_kas@hotmail.com" => "Belén"
        );
        
        // establecemos un limite de caracteres de anchura
        $smtp->WordWrap = 50; // set word wrap
                              
        // NOTA: Los correos es conveniente enviarlos en formato HTML y Texto para que
                              // cualquier programa de correo pueda leerlo.
                              
        // Definimos el contenido HTML del correo
        $contenidoHTML = "<head>";
        $contenidoHTML .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">";
        $contenidoHTML .= "</head><body>";
        $contenidoHTML .= "<h1 style='color:blue;'>¡Hola Administrador!</h1>";
        $contenidoHTML .= '<p>Se ha registrado un nuevo usuario con nick <strong>' . $nick . '</strong>, y mail <strong>' . $mail . '</strong>
						<br/><a href="https://www.devoralibros.es/FormularioInicioSesion/">¡Entra a Devoralibros!</a>
						<br/><br/>Saludos y recuerda...NUNCA DEJES DE LEER!</p>
						<br/><br/>
						<a href="https://www.devoralibros.es"><img src="' . $imagen . '" width="150"/></a>
						<p>Beatriz, Belén, Esther y Miguel
						<br/><strong>Administradores de DevoraLibros</strong>
                        <br/><br/>
                        Si en cualquier momento quieres dejar de recibir estos correos puedes <a href="https://www.devoralibros.es/FormularioInicioSesion/">darte de baja</a> desde tu perfil.
                        <br/><br/>
                        <i>Estimado usuario, para nosotros es muy importante la privacidad, por ello, en cumplimento del nuevo RGPD te recordamos que recibes este email porque te has suscrito de manera voluntaria a nuestra lista de correo electrónico. Tus datos se almacenarán en nuestra Base de Datos, con la finalidad de enviarte correos electrónicos. Asimismo, te informamos de que tus datos serán tratados con la mayor confidencialidad posible y que con tu aceptación estarías mostrando tu consentimiento a recibir correos electrónicos comerciales propios o sobre productos de terceros. En cada comunicación que recibas de esta web tendrás la opción de darte de baja de esta lista y revocar tu consentimiento.</i></p>';
        $contenidoHTML .= "</body>\n";
        
        // Definimos el contenido en formato Texto del correo
        // $contenidoTexto="Contenido en formato Texto";
        // $contenidoTexto.="\n\nhttps://www.lawebdelprogramador.com";
        
        // Definimos el subject
        $smtp->Subject = "Devoralibros";
        
        // Adjuntamos el archivo "leameLWP.txt" al correo.
        // Obtenemos la ruta absoluta de donde se ejecuta este script para encontrar el
        // archivo leameLWP.txt para adjuntar. Por ejemplo, si estamos ejecutando nuestro
        // script en: /home/xve/test/sendMail.php, nos interesa obtener unicamente:
        // /home/xve/test para posteriormente adjuntar el archivo leameLWP.txt, quedando
        // /home/xve/test/leameLWP.txt
        $rutaAbsoluta = substr($_SERVER["SCRIPT_FILENAME"], 0, strrpos($_SERVER["SCRIPT_FILENAME"], "/"));
        // $smtp->AddAttachment($rutaAbsoluta."/leameLWP.txt", "LeameLWP.txt");
        
        // Indicamos el contenido
        $smtp->AltBody = $contenidoTexto; // Text Body
        $smtp->MsgHTML($contenidoHTML); // Text body HTML
        
        foreach ($mailTo as $mail => $name) {
            $smtp->ClearAllRecipients();
            $smtp->AddAddress($mail, $name);
            
            $smtp->Send(); // Envía el correo.
        }
    }

    /**
     * enviarMensaje
     * Método que inserta en la tabla usuarios_mensajes el mensaje enviado de id1 a id2.
     *
     * @param
     *            $id1
     * @param
     *            $id2
     * @param
     *            $mensaje
     */
    public function enviarMensaje($id1, $id2, $mensaje)
    {
        $bd = Connection::dameInstancia();
        $c = $bd->dameConexion();
        $fecha = date("Y-m-d");
        $sql = "INSERT INTO usuarios_mensajes (id_usuario1, id_usuario2, mensaje, fecha)" . " VALUES(?,?,?,?)";
        $sentencia = $c->prepare($sql);
        $sentencia->bind_param("iiss", $id1, $id2, $mensaje, $fecha);
        if ($sentencia->execute()) {
            $exito = - 307;
        } else {
            $exito = - 668;
        }
        return $exito;
    }

    /**
     * enviarMensajeBienvenida
     * Método que inserta en la tabla usuarios_mensajes el mensaje de Bienvenida
     *
     * @param
     *            $nick
     */
    public function enviarMensajeBienvenida($nick)
    {
        $id1 = 100;
        $id2 = $this->getIdusuario($nick);
        $bd = Connection::dameInstancia();
        $c = $bd->dameConexion();
        $fecha = date("Y-m-d");
        $mensaje = '¡Hola ' . $nick . '! ¿Por qué no te animas a comentar algún libro de los ya subidos o, mejor aún, a subir alguno que quieras hacer un resumen personal' . ' tú mismo? En esta comunidad podrás dar rienda suelta a tus pensamientos sobre libros. ¡BIENVENIDO!';
        $sql = "INSERT INTO usuarios_mensajes (id_usuario1, id_usuario2, mensaje, fecha)" . " VALUES(?,?,?,?)";
        $sentencia = $c->prepare($sql);
        $sentencia->bind_param("iiss", $id1, $id2, $mensaje, $fecha);
        if ($sentencia->execute()) {
            $exito = - 307;
        } else {
            $exito = - 668;
        }
        return $exito;
    }

    /**
     * enviarMensajeComentario
     * Metodo que inserta en la tabla usuarios_mensajes el mensaje de comentario sobre un libro tuyo.
     *
     * @param
     *            $nick
     * @param
     *            $titulo
     */
    public function enviarMensajeComentario($id, $titulo)
    {
        $nick = $this->getNick($id);
        $id1 = 100;
        $id2 = $this->getIdusuario($nick);
        $bd = Connection::dameInstancia();
        $c = $bd->dameConexion();
        $fecha = date("Y-m-d");
        $mensaje = '¡Hola ' . $nick . '! Tu libro ' . $titulo . ' ha recibido un comentario.';
        $sql = "INSERT INTO usuarios_mensajes (id_usuario1, id_usuario2, mensaje, fecha)" . " VALUES(?,?,?,?)";
        $sentencia = $c->prepare($sql);
        $sentencia->bind_param("iiss", $id1, $id2, $mensaje, $fecha);
        if ($sentencia->execute()) {
            $exito = - 307;
        } else {
            $exito = - 668;
        }
        return $exito;
    }

    /**
     * mensajesSinLeer
     * Comprueba si el usuario tiene mensajes sin leer
     *
     * @param
     *            $id
     * @return boolean
     */
    public function mensajesSinLeer($id)
    {
        $bd = Connection::dameInstancia();
        $c = $bd->dameConexion();
        $sql = "SELECT * FROM usuarios_mensajes WHERE id_usuario2='$id' AND leido=1";
        if ($c->real_query($sql)) {
            if ($result = $c->store_result()) {
                if ($result->num_rows > 0) {
                    
                    $result->free_result();
                    return true;
                } else {
                    
                    $result->free_result();
                    return false;
                }
            }
        } else {
            return "Error nº" . $c->errno;
        }
    }

    /**
     * tipoUsuario
     * Método que nos devuelve el tipo de usuario a partir de su id
     *
     * @param
     *            $id_usuario
     * @return $id_tipo_usuario
     */
    public function tipoUsuario($id_usuario)
    {
        $sql = "SELECT id_tipo_usuario from $this->tabla WHERE id_usuario=" . $id_usuario;
        $sentencia = $this->c->prepare($sql);
        $sentencia->execute();
        $sentencia->bind_result($id_tipo_usuario);
        $registros = $sentencia->fetch();
        $sentencia->close();
        
        return $id_tipo_usuario;
    }

    /**
     * insertarUsuario
     * Método que introduce un usuario en la Base de datos, a un usuario se le inserta por defecto el tipo 1 (usuario normal).
     * Por defecto, al ser el campo Nick de tipo UNIQUE, phpMyadmin nunca insertará dos usuarios con el mismo Nick, aún así,
     * comprobamnos que ese nick no exista ya en la base de datos para que no se repita.
     *
     * @param
     *            $nombre
     * @param
     *            $apellidos
     * @param
     *            $mail
     * @param
     *            $nick
     * @param
     *            $pass
     * @param
     *            $libro_favorito
     * @param
     *            $libro_odiado
     * @param
     *            $autor_favorito
     * @param
     *            $genero_favorito
     * @param
     *            $archivo_foto
     * @param
     *            $codigo
     * @param
     *            $codigoPatrocinio
     * @return $exito=-310->el usuario ha sido insertado correctamente y $exito!=-310-> no se inserta el nuevo usuario
     */
    public function insertarUsuario($nombre, $apellidos, $mail, $nick, $pass, $libro_favorito, $libro_odiado, $autor_favorito, $genero_favorito, $archivo_foto, $codigo, $codigoPatrocinio)
    {
        $foto = $this->guardarFoto($nick, $archivo_foto);
        $exito = "";
        $tipo_usuario = 1;
        $passMD5 = md5($pass);
        $sql = "INSERT INTO $this->tabla (`tipo_usuario`, `nombre`, `apellidos`, `mail`, `nick`, `pass`, `libro_favorito`, `libro_odiado`, `autor_favorito`, `genero_favorito`, `foto`, `codigo`, `codigoPatrocinio`)" . " VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $sentencia = $this->c->prepare($sql);
        $sentencia->bind_param("issssssssssss", $tipo_usuario, $nombre, $apellidos, $mail, $nick, $passMD5, $libro_favorito, $libro_odiado, $autor_favorito, $genero_favorito, $foto, $codigo, $codigoPatrocinio);
        if ($sentencia->execute()) {
            $exito = - 306;
            
            $this->enviarMensajeBienvenida($nick);
            $this->enviarConfirmacionRegistro($nick, $pass);
            // $this->enviarMailBienvenida($nick,$mail);
            $puntos = 5;
            $this->sumarPuntosRegistro($nick, $puntos);
            if ($codigo != NULL) {
                $puntos = 10;
                $this->sumarPuntosRegistro($nick, $puntos);
            }
        } else {
            $exito = - 303;
        }
        return $exito;
    }

    /**
     * guardarFoto
     * Método que guarda la foto del usuario en la carpeta del proyecto y devuelve la ruta de la imagen que se guarda en la base de datos
     * Si el usuario no inserta una imagen, se guardará por defecto la imagen "sinFotoBlue.png" con el nick del usuario
     *
     * @param
     *            $nick
     * @param
     *            $archivo_foto
     * @return $rutaBD
     */
    public function guardarFoto($nick, $archivo_foto)
    {
        $foto_name = $archivo_foto['name'];
        $foto_type = $archivo_foto['type'];
        $foto_tmp_name = $archivo_foto['tmp_name'];
        $foto_size = $archivo_foto['size'];
        if ($foto_type == "image/jpeg" || $foto_type == "image/pjpeg") {
            $extension = "jpg";
        } elseif ($foto_type == "image/png") {
            $extension = "png";
        } else {
            $extension = NULL;
        }
        $ruta = "NULL";
        $rutaBD = "NULL";
        $lugar = '../fotos/';
        // Validamos la fotografía
        if ($foto_name != NULL and $extension != NULL and $foto_size != 0) {
            if ($foto_size <= $_REQUEST['lim_tamano']) {
                $nombre_foto = $nick . "." . $extension;
                $ruta = $lugar . $nombre_foto;
                // Guardamos la foto en la carpeta del proyecto "fotos" con su nick Ejemplo: Ana.jpg
                move_uploaded_file($foto_tmp_name, $ruta);
                // Declaramos la ruta de la imagen en la base de datos
                $rutaBD = $nombre_foto;
            }
        } else { // en caso de que el usuario no inserte imagen
            $rutaOrigen = $lugar . "sinFotoBlue.png";
            $rutaFinal = $lugar . $nick . ".png";
            copy($rutaOrigen, $rutaFinal);
            $rutaBD = $nick . ".png";
        }
        
        return $rutaBD;
    }

    /**
     * sumarPuntosRegistro
     * Suma los puntos que le pasemos al usuario
     *
     * @param
     *            $nick
     * @param
     *            $puntos
     */
    public function sumarPuntosRegistro($nick, $puntos)
    {
        $id_usuario = $this->getIdusuario($nick);
        $sql_puntos = "UPDATE $this->tabla SET puntos= puntos + ?, puntosmes = puntosmes + ? WHERE id_usuario = ?";
        $stmt = $this->c->stmt_init();
        $stmt->prepare($sql_puntos);
        $stmt->bind_param("iii", $puntos, $puntos, $id_usuario);
        $stmt->execute();
    }

    /**
     * sumarPuntosAmistad
     * Suma los puntos al aceptarse una solicitud de amistad
     *
     * @param
     *            $id_usuario
     * @param
     *            $puntos
     */
    public function sumarPuntosAmistad($id_usuario, $puntos)
    {
        $sql_puntos = "UPDATE $this->tabla SET puntos= puntos + ?, puntosmes = puntosmes + ? WHERE id_usuario = ?";
        $stmt = $this->c->stmt_init();
        $stmt->prepare($sql_puntos);
        $stmt->bind_param("iii", $puntos, $puntos, $id_usuario);
        $stmt->execute();
    }

    /**
     * modificardatos
     * Método usado en modificaTusDatos_header.php y que modifica los datos del usuario
     *
     * @param
     *            $nombre
     * @param
     *            $apellidos
     * @param
     *            $mail
     * @param
     *            $$pass
     * @param
     *            $libro_favorito
     * @param
     *            $libro_odiado
     * @param
     *            $autor_favorito
     * @param
     *            $genero_favorito
     * @param
     *            $id_usuario
     * @return boolean
     */
    public function modificardatos($nombre, $apellidos, $mail, $pass, $libro_favorito, $libro_odiado, $autor_favorito, $genero_favorito, $id_usuario)
    {
        $sql_query = "UPDATE $this->tabla SET nombre= ? , apellidos= ? , mail= ? ," . "  pass = ? , libro_favorito = ? , libro_odiado = ? , autor_favorito = ? , genero_favorito = ? " . " WHERE id_usuario= ?";
        $stmt = $this->c->stmt_init();
        $stmt->prepare($sql_query);
        if ($stmt === false) {
            return false;
        }
        $stmt->bind_param('ssssssssi', $nombre, $apellidos, $mail, $pass, $libro_favorito, $libro_odiado, $autor_favorito, $genero_favorito, $id_usuario);
        $stmt->execute();
    }

    /**
     * modificarFoto
     * Función que se utilizara en modificarUsuario.php para modificar la imagen de perfil.
     *
     * @param
     *            $nick
     * @param
     *            $archivo_foto
     * @param
     *            $id_usuario
     * @return boolean
     */
    public function modificarFoto($nick, $archivo_foto, $id_usuario)
    {
        $foto = $this->modificarImg($nick, $archivo_foto);
        $sql_query = "UPDATE $this->tabla SET  " . "  foto = ?" . " WHERE id_usuario= ?";
        
        $stmt = $this->c->stmt_init();
        $stmt->prepare($sql_query);
        if ($stmt === false) {
            return false;
        }
        $stmt->bind_param('si', $foto, $id_usuario);
        $stmt->execute();
    }

    /**
     * modificarImg
     * Función que se utilizara en modificarFoto() para modificar la imagen de perfil.
     *
     * @param
     *            $nick
     * @param
     *            $archivo_img
     * @return $rutaBD
     */
    public function modificarImg($nick, $archivo_img)
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
        $lugar = '../fotos/';
        // Validamos la imagen
        if ($img_name != NULL and $extension != NULL and $img_size != 0) {
            if ($img_size <= $_REQUEST['lim_tamano']) {
                $nombre_img = $this->normaliza($nick . "." . $extension);
                $ruta = $lugar . $nombre_img;
                // Guardamos la foto en la carpeta del proyecto "img_libros"
                move_uploaded_file($img_tmp_name, $ruta);
                // Declaramos la ruta de la imagen en la base de datos
                $rutaBD = $nombre_img;
            } else {
                $rutaOrigen = "../fotos/sinFotoBlue.png";
                $rutaFinal = $this->normaliza($lugar . $nick . ".png");
                copy($rutaOrigen, $rutaFinal);
                $rutaBD = $this->normaliza($nick . ".png");
            }
        } else { // en caso de que el usuario no inserte imagen
            $rutaOrigen = "../fotos/sinFotoBlue.png";
            $rutaFinal = $this->normaliza($lugar . $nick . ".png");
            copy($rutaOrigen, $rutaFinal);
            $rutaBD = $this->normaliza($nick . ".png");
        }
        
        return $rutaBD;
    }

    /**
     * getPassUsuario
     * Método que se emplea para obtener la contraseña de un usuario a partir de su id.
     *
     * @param
     *            $id
     * @return $registro['pass'], si no existe devuelve -1
     */
    public function getPassUsuario($id)
    {
        $sql = "SELECT pass FROM $this->tabla WHERE id_usuario=$id";
        if ($this->c->real_query($sql)) {
            if ($result = @$this->c->store_result()) {
                if ($result->num_rows == 1) {
                    $registro = $result->fetch_assoc();
                    
                    return $registro['pass'];
                }
                $result->free_result();
            } else {
                
                return - 1;
            }
        } else {
            
            return $this->c->errno . "->" . $this->c->error;
        }
    }

    /**
     * getFoto
     * Método que se emplea para obtener la foto de un usuario a partir de su id.
     *
     * @param
     *            $id
     * @return $registro['foto'], si no existe devuelve -1
     */
    public function getFoto($id)
    {
        $sql = "SELECT foto FROM $this->tabla WHERE id_usuario=" . $id;
        if ($this->c->real_query($sql)) {
            if ($result = @$this->c->store_result()) {
                if ($result->num_rows == 1) {
                    $registro = $result->fetch_assoc();
                    
                    return $registro['foto'];
                }
                $result->free_result();
            } else {
                
                return - 1;
            }
        } else {
            
            return $this->c->errno . "->" . $this->c->error;
        }
    }

    /**
     * cambiarPass
     * Esta función se usa en el archivo envioContrasena_header.php y con ella modificamos, en la tabla usuarios,
     * la contraseña del usuario que ha olvidado la suya para que pueda volver a entrar.
     *
     * @param
     *            $pass
     * @param
     *            $id_usuario
     * @return boolean
     */
    public function cambiarPass($pass, $id_usuario)
    {
        $passmd5 = md5($pass);
        $sql_query = "UPDATE $this->tabla SET pass= ?" . " WHERE id_usuario= ?";
        
        $stmt = $this->c->stmt_init();
        $stmt->prepare($sql_query);
        if ($stmt === false) {
            return false;
        }
        $stmt->bind_param('si', $passmd5, $id_usuario);
        $stmt->execute();
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

    /**
     * numUsuarios
     * Calcula cuantos usuarios hay en BBDD
     *
     * @return int
     */
    public function numUsuarios()
    {
        $sql = "SELECT * FROM " . $this->tabla . "";
        if ($this->c->real_query($sql)) {
            if ($resul = $this->c->store_result()) {
                if ($resul->num_rows == 0) {
                    $numUsuarios = 0;
                    
                    return $numUsuarios;
                } else {
                    $numUsuarios = $resul->num_rows;
                    
                    // No contamos a los administradores
                    return ($numUsuarios - 5);
                }
            }
        } else {
            
            return $this->c->errno . " -> " . $this->c->error;
        }
    }
}
?>
