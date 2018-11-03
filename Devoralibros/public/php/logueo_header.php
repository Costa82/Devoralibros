<?php
spl_autoload_register(function ($nombre_clase) {
    include_once ('../clases/' . $nombre_clase . '.php');
});

include_once ('../clases/Log.php');

$log = new Log();
$desdeDonde = "logueo_header.php";

if (isset($_REQUEST['loguear'])) {
    
    if (! empty($_REQUEST['nick']) and ! empty($_REQUEST['contrasena'])) {
        $nick = trim($_REQUEST['nick']);
        $pass = trim($_REQUEST['contrasena']);
        $usuario = new Usuario();
        
        if ($id_usuario = $usuario->esRegistradoNick($nick)) {
            
            if ($id_usuario = $usuario->esRegistrado($nick, $pass)) { // para loguearse, se comprueba que sea ususario registrado
                
                $cadena = "Usuario " . $nick . " logueado correctamente.";
                $error = null;
                $tipo = "INFO";
                $separacion = "*";
                $log->write_log($desdeDonde, $cadena, $error, $tipo, $separacion);
                
                require_once '../inc/funciones.php';
                sesion();
                $_SESSION['id_usuario'] = $id_usuario;
                $_SESSION['datos'] = $usuario->getUsuario($id_usuario);
                $tipo_usuario = $_SESSION['datos']['tipo_usuario'];
                switch ($tipo_usuario) {
                    case 1:
                        $destino = "../Usuario/";
                        break;
                    case 2:
                        $destino = "../Administrador/";
                        break;
                    default:
                        $num = - 201;
                        $destino = "../FormularioInicioSesion/?num=$num";
                        break;
                }
            } else {
                
                $num = - 202;
                $cadena = "El usuario " . $nick . " no se logueó correctamente.";
                $tipo = "ERROR";
                $separacion = "*";
                $log->write_log($desdeDonde, $cadena, $num, $tipo, $separacion);
                
                $destino = "../FormularioInicioSesion/?num=$num";
            }
        } else {
            
            $num = - 201;
            $cadena = "El usuario " . $nick . " no se logueó correctamente.";
            $tipo = "ERROR";
            $separacion = "*";
            $log->write_log($desdeDonde, $cadena, $num, $tipo, $separacion);
            
            $destino = "../FormularioInicioSesion/?num=$num";
        }
    }
}

if (! headers_sent()) {
    header('Location:' . $destino);
    exit();
}
?>