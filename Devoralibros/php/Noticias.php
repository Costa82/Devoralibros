<!--
- Visor de las noticias.
- @author Miguel Costa.
-
-->

<?php
require_once '../inc/funciones.php';
require_once '../inc/validaciones.inc.php';
include_once ("../clases/Noticia.php");
include_once ('../clases/Usuario.php');
include_once ('../clases/Log.php');
sesion();

$log = new Log();
$desdeDonde = "Noticias.php";
$usuario = new Usuario();

if (isset($_SESSION['datos'])) {
    $nick = $_SESSION['datos']['nick'];
    $id_usuario = $_SESSION['datos']['id_usuario'];
    $foto = $_SESSION['datos']['foto'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Página de Noticias</title>
<link type="text/css" rel="stylesheet" href="../css/font-awesome.css" />

<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah"
	rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Pathway+Gothic+One'
	rel='stylesheet' type='text/css' />
<script src="../jquery/jquery-3.1.1.min.js"></script>

<!-- Metemos un aleatorio para el css y el jss -->
<script>
    var rutacss1 = "../css/main.css?" + Math.random();
    var rutacss2 = "../css/main_libros.css?" + Math.random();
    var rutajs1 = "../jquery/jquery_menuMoviles_desplegable.js?" + Math.random();
    var rutajs2 = "../jquery/jquery_scroll_menuNavegacion.js?" + Math.random();
    var rutajs3 = "../jquery/jquery_listaDeslizante.js?" + Math.random();
    var rutajs4 = "../jquery/jquery_busqueda_avanzada.js?" + Math.random();
    var script = "script";
    
    document.write('<link rel="stylesheet" href="' + rutacss1 + '" type="text/css" media="screen" />'); 
    document.write('<link rel="stylesheet" href="' + rutacss2 + '" type="text/css" media="screen" />'); 
    document.write('<script src="' + rutajs1 + '"></' + script + '>');
    document.write('<script src="' + rutajs2 + '"></' + script + '>');
    document.write('<script src="' + rutajs3 + '"></' + script + '>');
    document.write('<script src="' + rutajs4 + '"></' + script + '>');
</script>

</head>
<body>

	<header>

		<nav>
				<?php
    try {
        include_once ("menuNavVisores.php");
        
        $cadena = "Se cargo correctamente menNavVisores.php";
        $error = null;
        $tipo = "INFO";
        $separacion = "*";
        $log->write_log($desdeDonde, $cadena, $error, $tipo, $separacion);
    } catch (Exception $e) {
        
        $cadena = "No se pudo cargar menNavVisores.php." . $e;
        $error = - 1000;
        $tipo = "ERROR";
        $separacion = "*";
        $log->write_log_error_general($desdeDonde, $cadena, $error, $tipo, $separacion);
    }
    ?>	
			</nav>
		<div class="busqueda_avanzada">
			<div class="pestana">
				<p>Búsqueda avanzada</p>
			</div>
				
				<?php
    try {
        include_once ("formulario_avanzado.php");
        
        $cadena = "Se cargo correctamente formulario_avanzado.php";
        $error = null;
        $tipo = "INFO";
        $separacion = "*";
        $log->write_log($desdeDonde, $cadena, $error, $tipo, $separacion);
    } catch (Exception $e) {
        
        $cadena = "No se pudo cargar formulario_avanzado.php." . $e;
        $error = - 1000;
        $tipo = "ERROR";
        $separacion = "*";
        $log->write_log_error_general($desdeDonde, $cadena, $error, $tipo, $separacion);
    }
    ?>
			
			</div>
		<div class="devoralibros_mensual">                
				<?php
    try {
        include_once ("ganador_mes_index.php");
        
        $cadena = "Se cargo correctamente ganador_mes_index.php";
        $error = null;
        $tipo = "INFO";
        $separacion = "*";
        $log->write_log($desdeDonde, $cadena, $error, $tipo, $separacion);
    } catch (Exception $e) {
        
        $cadena = "No se pudo cargar ganador_mes_index.php." . $e;
        $error = - 1000;
        $tipo = "ERROR";
        $separacion = "*";
        $log->write_log_error_general($desdeDonde, $cadena, $error, $tipo, $separacion);
    }
    ?>
			</div>

	</header>
		
		<?php
$noticia = new Noticia();
?>
		
		<h1>Noticias</h1>
		
		<?php
try {
    $noticia->mostrarNoticias();
    
    $cadena = "Se mostraron correctamente las noticias. mostrarNoticias()";
    $error = null;
    $tipo = "INFO";
    $separacion = "*";
    $log->write_log($desdeDonde, $cadena, $error, $tipo, $separacion);
} catch (Exception $e) {
    
    $cadena = "No se mostraron las noticias. Error al llamar a mostrarNoticias()." . $e;
    $error = - 1000;
    $tipo = "ERROR";
    $separacion = "*";
    $log->write_log_error_general($desdeDonde, $cadena, $error, $tipo, $separacion);
}

try {
    include_once ("infografia.php");
    
    $cadena = "Se cargo correctamente infografia.php";
    $error = null;
    $tipo = "INFO";
    $separacion = "*";
    $log->write_log($desdeDonde, $cadena, $error, $tipo, $separacion);
} catch (Exception $e) {
    
    $cadena = "No se pudo cargar infografia.php." . $e;
    $error = - 1000;
    $tipo = "ERROR";
    $separacion = "*";
    $log->write_log_error_general($desdeDonde, $cadena, $error, $tipo, $separacion);
}
?>
		
		<footer>
		
			<?php
try {
    include_once ("footer.php");
    
    $cadena = "Se cargo correctamente footer.php";
    $error = null;
    $tipo = "INFO";
    $separacion = "*";
    $log->write_log($desdeDonde, $cadena, $error, $tipo, $separacion);
} catch (Exception $e) {
    
    $cadena = "No se pudo cargar footer.php." . $e;
    $error = - 1000;
    $tipo = "ERROR";
    $separacion = "*";
    $log->write_log_error_general($desdeDonde, $cadena, $error, $tipo, $separacion);
}
?>  
			
		</footer>

</body>
</html>
