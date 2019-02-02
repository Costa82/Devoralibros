<?php
spl_autoload_register(function ($nombre_clase) {
    include_once ('../clases/' . $nombre_clase . '.php');
});
require_once '../inc/funciones.php';
require_once '../inc/validaciones.inc.php';
$usuario = new Usuario();
$strMensaje = "";
session_start();

if (isset($_REQUEST['enviar'])) {
    $_SESSION['nickF'] = $_POST['nick'];
    $_SESSION['nombreF'] = $_POST['nombre'];
    $_SESSION['apellidosF'] = $_POST['apellidos'];
    $_SESSION['mailF'] = $_POST['mail'];
    $_SESSION['libro_favoritoF'] = $_POST['libro_favorito'];
    $_SESSION['libro_odiadoF'] = $_POST['libro_odiado'];
    $_SESSION['autor_favoritoF'] = $_POST['autor_favorito'];
    $_SESSION['generoF'] = $_POST['genero'];
    $errores = array();
    $num = - 301; // "El usuario se ha registrado correctamente."-> '../inc/defines.inc.php'
    if (isset($_REQUEST['nick']) and isset($_REQUEST['nombre']) and isset($_REQUEST['mail'])) {
        /**
         * Nick es Campo obligatorio
         * Si cumple los criterios de validación (esNick())
         * (tiene que tener de 4 a 8 caracteres, letras ó números)
         * Debemos de comprobar si el usuario no está regsitrado previamente
         */
        if (esNick($_REQUEST['nick'])) {
            if (! $usuario->existeUsuario($_REQUEST['nick'])) {
                $nick = $_REQUEST['nick']; // -> '../inc/validaciones.inc.php'
                $numeroAleatorio = rand(0000, 9999);
                $codigoPatrocinio = $nick . $numeroAleatorio;
            } else {
                $num = - 300;
                $errores[] = $num;
            }
        } else {
            $num = - 211;
            $errores[] = $num;
        }
        
        // Campo obligatorio
        if (esNombreValido($_REQUEST['nombre'])) {
            $nombre = ponerLetraEnMayuscula($_REQUEST['nombre']); // -> '../inc/validaciones.inc.php'
        } else {
            $num = - 207;
            $errores[] = $num;
        }
        
        // Campo no obligatorio
        if (! empty($_REQUEST['apellidos'])) {
            if (esNombreValido($_REQUEST['apellidos'])) {
                $apellidos = ponerLetraEnMayuscula($_REQUEST['apellidos']); // -> '../inc/validaciones.inc.php'
            } else {
                $num = - 208;
                $errores[] = $num;
            }
        } else {
            $apellidos = NULL;
        }
        
        // Campo obligatorio
        if (esMailValido($_REQUEST['mail'])) {
            if ($usuario->esmailRepetido($_REQUEST['mail'])) {
                $num = - 204;
                $errores[] = $num;
            } else {
                $mail = $_REQUEST['mail'];
            }
        } else {
            $num = - 209;
            $errores[] = $num;
        }
        
        $numeroAleatorio = $usuario->generarCodigo(4); // Genera un código de 4 caracteres de longitud.
        $pass = $numeroAleatorio . 'Aa';
        
        // Campos no obligatorios
        // El objeto Usuario presenta una función que valida y guarda la ruta de la foto
        $archivo_foto = $_FILES['foto'];
        
        if (! empty($_REQUEST['libro_favorito'])) {
            if (! tieneCaracteresEspeciales($_REQUEST['libro_favorito'])) {
                $libro_favorito = ponerLetraEnMayuscula($_REQUEST['libro_favorito']);
            } else {
                $num = - 217;
                $errores[] = $num;
            }
        } else {
            $libro_favorito = NULL;
        }
        
        if (! empty($_REQUEST['libro_odiado'])) {
            if (! tieneCaracteresEspeciales($_REQUEST['libro_odiado'])) {
                $libro_odiado = ponerLetraEnMayuscula($_REQUEST['libro_odiado']);
            } else {
                $num = - 217;
                $errores[] = $num;
            }
        } else {
            $libro_odiado = NULL;
        }
        
        if (! empty($_REQUEST['autor_favorito'])) {
            if (esNombreValido($_REQUEST['autor_favorito'])) {
                $autor_favorito = ponerLetraEnMayuscula($_REQUEST['autor_favorito']); // -> '../inc/validaciones.inc.php'
            } else {
                $num = - 214;
                $errores[] = $num;
            }
        } else {
            $autor_favorito = NULL;
        }
        
        if (! empty($_REQUEST['genero_favorito'])) {
            if (esNombreValido($_REQUEST['genero_favorito'])) {
                $genero_favorito = ponerLetraEnMayuscula($_REQUEST['genero_favorito']); // -> '../inc/validaciones.inc.php'
            } else {
                $num = - 215;
                $errores[] = $num;
            }
        } else {
            $genero_favorito = NULL;
        }
        
        if (! empty($_REQUEST['codigo'])) {
            if (esCodigoCorrecto($_REQUEST['codigo'])) {
                $codigo = $_REQUEST['codigo'];
            } elseif ($usuario->existeCodigoPatrocinio($_REQUEST['codigo'])) {
                $codigo = $_REQUEST['codigo'];
            } else {
                $num = - 216;
                $errores[] = $num;
            }
        } else {
            $codigo = NULL;
        }
        
        /**
         * Lo registramos como usuario normal, tipo_usuario=1,
         * insertarUsuario($nombre,$apellidos,$mail,$nick,$pass,$libro_favorito,$libro_odiado,$autor_favorito,$archivo_foto,$codigo),
         */
        
        /*
         * A la vez que se inserta un usuario en la base de datos, queremos que nos devuelva
         * un mensaje de validación, es decir, que es correcto,
         * como un mensaje de error si no se ha podido hacer la inserción.
         * Quiero coger los mensajes de error que vienen determinados en el archivo 'defines.inc.php'
         * Este número nos dirá si el usuario se ha registrado ó no correctamente, ó si ya estaba registrado previamente.
         */
        
        // $num nos devuelve un número definido en el archivo 'defines.inc.php'
        if ($num == - 301) {
            $num = $usuario->insertarUsuario($nombre, $apellidos, $mail, $nick, $pass, $libro_favorito, $libro_odiado, $autor_favorito, $genero_favorito, $archivo_foto, $codigo, $codigoPatrocinio);
            $errores[] = $num;
        }
        
    } else { // Error, campos obligatorios no rellenados
        $num = - 303;
        $errores[] = $num;
    }
    if ($num != - 306) {
        $strError = serialize($errores);
        $error = urlencode($strError);
        $destino = "../FormularioRegistro/?error=$error";
    } else {
        /**
         * El usuario se ha registrado correctamente.
         * Le mostramos el mensaje de confimarción de registro
         */
        $strError = serialize($errores);
        $error = urlencode($strError);
        $destino = "../FormularioRegistro/?error=$error";
    }
}
if (! headers_sent()) {
    header('Location:' . $destino);
    exit();
}
?>