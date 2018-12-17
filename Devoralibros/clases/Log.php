<!--
- Escribe lo que le pasen a un archivo de logs
- @param string $cadena texto a escribir en el log
- @param string $tipo texto que indica el tipo de mensaje. Los valores normales son Info, Error,  
-                                       Warn Debug, Critical
-->
<?php
require_once 'Connection.php';
require_once '../inc/defines.inc.php';
require_once '../inc/validaciones.inc.php';

class Log
{

    private $c;

    private $tabla;

    public function __construct()
    {
        $bd = Connection::dameInstancia();
        $this->c = $bd->dameConexion();
        $this->tabla_errores_usuarios = "errores_usuarios";
        $this->tabla_errores_generales = "errores_generales";
    }

    /**
     * write_log( $desdeDonde, $cadena, $numError, $tipo, $separacion )
     * Método que escribe el log
     *
     * @param
     *            $desdeDonde
     * @param
     *            $cadena
     * @param
     *            $numError
     * @param
     *            $descripcion
     * @param
     *            $separacion
     */
    public function write_log($desdeDonde, $cadena, $numError, $tipo, $separacion)
    {
        $arch = fopen("../logs/logDevoralibros_" . date("Y-m-d") . ".txt", "a+");
        $ip = $_SERVER['REMOTE_ADDR'];
        
        fwrite($arch, "[" . date("Y-m-d H:i:s.u") . " - $tipo] " . $ip . " - " . $desdeDonde . "\n");
        fwrite($arch, "[" . date("Y-m-d H:i:s.u") . " - $tipo] " . $ip . " - " . $cadena . "\n");
        
        if ($numError != null) {
            $mensaje = validacionErrores($numError);
            fwrite($arch, "[" . date("Y-m-d H:i:s.u") . " - $tipo] " . $ip . " - Error " . $numError . " '" . $mensaje . "'\n");
            $this->insertarErrorUsuario(date("YmdHisu"), str_replace("-", "", $numError), $mensaje, $desdeDonde, $cadena, $ip);
        }
        
        if ($separacion != null) {
            $lineaSeparacion = str_pad($separacion, 70, $separacion);
            fwrite($arch, $lineaSeparacion . "\n");
        }
        
        fclose($arch);
    }

    /**
     * insertarErrorUsuario( $id_error, $cod_error, $desc_error, $ubicacion, $descripcion, $ip )
     * Método que registra el error en BBDD, en la tabla errores_usuarios
     *
     * @param
     *            $id_error
     * @param
     *            $cod_error
     * @param
     *            $ubicacion
     * @param
     *            $descripcion
     * @param
     *            $ip
     */
    public function insertarErrorUsuario($id_error, $cod_error, $desc_error, $ubicacion, $descripcion, $ip)
    {
        $desdeDonde = 'Log.php - insertarErrorUsuario($id_error, $cod_error, $desc_error, $ubicacion, $descripcion, $ip)';
        
        $sql = "INSERT INTO $this->tabla_errores_usuarios (`id_error`, `cod_error`, `desc_error`, `ubicacion`, `descripcion`, `ip`)" . " VALUES(?,?,?,?,?,?)";
        $sentencia = $this->c->prepare($sql);
        $sentencia->bind_param("ssssss", $id_error, $cod_error, $desc_error, $ubicacion, $descripcion, $ip);
        if ($sentencia->execute()) {
            $cadena = 'Inserción correcta en la tabla de errores';
            $numError = null;
            $tipo = 'ERROR';
            $separacion = null;
            $this->write_log($desdeDonde, $cadena, $numError, $tipo, $separacion);
        }
    }

    /**
     * write_log( $desdeDonde, $cadena, $numError, $tipo, $separacion )
     * Método que escribe el log
     *
     * @param
     *            $desdeDonde
     * @param
     *            $cadena
     * @param
     *            $numError
     * @param
     *            $descripcion
     * @param
     *            $separacion
     */
    public function write_log_error_general($desdeDonde, $cadena, $numError, $tipo, $separacion)
    {
        $arch = fopen("../logs/logDevoralibros_" . date("Y-m-d") . ".txt", "a+");
        $ip = $_SERVER['REMOTE_ADDR'];
        
        fwrite($arch, "[" . date("Y-m-d H:i:s.u") . " - $tipo] " . $ip . " - " . $desdeDonde . "\n");
        fwrite($arch, "[" . date("Y-m-d H:i:s.u") . " - $tipo] " . $ip . " - " . $cadena . "\n");
        
        if ($numError != null) {
            $mensaje = validacionErrores($numError);
            fwrite($arch, "[" . date("Y-m-d H:i:s.u") . " - $tipo] " . $ip . " - Error " . $numError . " '" . $mensaje . "'\n");
            $this->insertarErrorGeneral(date("YmdHisu"), str_replace("-", "", $numError), $mensaje, $desdeDonde, $cadena, $ip);
        }
        
        if ($separacion != null) {
            $lineaSeparacion = str_pad($separacion, 70, $separacion);
            fwrite($arch, $lineaSeparacion . "\n");
        }
        
        fclose($arch);
    }

    /**
     * insertarErrorGeneral( $id_error, $cod_error, $desc_error, $ubicacion, $descripcion, $ip )
     * Método que registra el error en BBDD, en la tabla errores_generales
     *
     * @param
     *            $id_error
     * @param
     *            $cod_error
     * @param
     *            $ubicacion
     * @param
     *            $descripcion
     * @param
     *            $ip
     */
    public function insertarErrorGeneral($id_error, $cod_error, $desc_error, $ubicacion, $descripcion, $ip)
    {
        $desdeDonde = 'Log.php - insertarErrorGeneral($id_error, $cod_error, $desc_error, $ubicacion, $descripcion, $ip)';
        
        $sql = "INSERT INTO $this->tabla_errores_generales (`id_error`, `cod_error`, `desc_error`, `ubicacion`, `descripcion`, `ip`)" . " VALUES(?,?,?,?,?,?)";
        $sentencia = $this->c->prepare($sql);
        $sentencia->bind_param("ssssss", $id_error, $cod_error, $desc_error, $ubicacion, $descripcion, $ip);
        if ($sentencia->execute()) {
            $cadena = 'Inserción correcta en la tabla de errores';
            $numError = null;
            $tipo = 'ERROR';
            $separacion = null;
            $this->write_log($desdeDonde, $cadena, $numError, $tipo, $separacion);
        }
    }
}

?>