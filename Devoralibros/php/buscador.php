<!--
- Archivo buscador.php con toda la estructura del buscador de libros.
- @author   Miguel Costa.
-
-->
<?php
require_once '../inc/funciones.php';
require_once '../inc/validaciones.inc.php';
include_once ("../clases/Libro.php");
include_once ('../clases/Usuario.php');
include_once ('../clases/Log.php');

sesion();
$usuario = new Usuario();
$log = new Log();
$desdeDonde = "buscador.php";

if (isset($_SESSION['datos'])) {
    $nick = $_SESSION['datos']['nick'];
    $id_usuario = $_SESSION['datos']['id_usuario'];
    $foto = $_SESSION['datos']['foto'];
}

// Variable de sesion para saber en qué página estamos y podamos volver a ella
$_SESSION['pagina'] = "buscador";

?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Buscador</title>
<link type="text/css" rel="stylesheet" href="../css/font-awesome.css" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah"
	rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Pathway+Gothic+One'
	rel='stylesheet' type='text/css' />
<script src="../jquery/jquery-3.1.1.min.js"></script>
<script async
	src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	
<script>
    adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-6841941891904085",
    enable_page_level_ads: true});
</script>

<!-- Metemos un aleatorio para el css y el jss -->
<script>
    var rutacss1 = "../css/main.css?" + Math.random();
    var rutacss2 = "../css/main_libros.css?" + Math.random();
    var rutacss3 = "../css/main_perfil.css?" + Math.random();
    var rutajs1 = "../jquery/jquery_menuMoviles_desplegable.js?" + Math.random();
    var rutajs2 = "../jquery/jquery_scroll_menuNavegacion.js?" + Math.random();
    var rutajs3 = "../jquery/jquery_listaDeslizante.js?" + Math.random();
    var rutajs4 = "../jquery/jquery_busqueda_avanzada.js?" + Math.random();
    var script = "script";
    
    document.write('<link rel="stylesheet" href="' + rutacss1 + '" type="text/css" media="screen" />'); 
    document.write('<link rel="stylesheet" href="' + rutacss2 + '" type="text/css" media="screen" />'); 
    document.write('<link rel="stylesheet" href="' + rutacss3 + '" type="text/css" media="screen" />');
    document.write('<script src="' + rutajs1 + '"></' + script + '>');
    document.write('<script src="' + rutajs2 + '"></' + script + '>');
    document.write('<script src="' + rutajs3 + '"></' + script + '>');
    document.write('<script src="' + rutajs4 + '"></' + script + '>');
</script>

</head>
<body>
	<header>
		<nav>
		
        <?php include_once ("menuNavBuscadores.php"); ?>
        		
    	</nav>
		<div class="busqueda_avanzada">
			<div class="pestana">
				<p>Búsqueda avanzada</p>
			</div>
        	
                <?php include_once ("formulario_avanzado.php"); ?>
                
            </div>

		<div class="devoralibros_mensual">        
               
        	<?php include_once ("ganador_mes_index.php"); ?>
        	
        </div>
	</header>
	
    <?php
    if (isset($_POST['nombre']) || isset($_SESSION['nombre'])) {
        
        if ( isset($_POST['nombre']) ) {
            $_SESSION['nombre'] = $_POST['nombre'];
        }
        
        // filtramos el input name=nombre para evitar ataques como los XSS Cross-Site Scripting y eliminamos espacios en blanco al inicio y al final
        if ( isset($_POST['nombre']) ) {
            $nombre = trim(filter_var($_POST['nombre'], FILTER_SANITIZE_STRING));
        } else {
            $nombre = trim(filter_var($_SESSION['nombre'], FILTER_SANITIZE_STRING));
        }
        $resultados = libro::buscarTitulo($nombre);
        if ($resultados == 0) {
            echo "Se ha producido un error en la búsqueda.";
        } else if ($resultados['numero'] == 0) {
            echo "<h2 class='resultados'>No se encontraron resultados al buscar '" . $nombre . "' </h2>";
        } else {
            echo "<h2 class='resultados'>Se encontraron " . $resultados['numero'] . " resultado/s al buscar '" . $nombre . "' </h2>";
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
                echo "<li><a href='../Libro/" . $myvar . "'><img src='../img_libros/" . $img_portada . "' alt='" . $titulo . "' title='" . $titulo . "' /></a></li>";
            }
            echo "</ul></div>";
        }
    } else {
        $resultados = libro::buscarTitulo("%");
        if ($resultados == 0) {
            echo "Se ha producido un error en la busqueda.";
        } else if ($resultados['numero'] == 0) {
            echo "<h2 class='resultados'>No se encontraron resultados al buscar '" . $nombre . "' </h2>";
        } else {
            echo "<h2 class='resultados'>Se encontraron " . $resultados['numero'] . " resultados (Todos los libros) </h2>";
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
    ?>
    
    <?php include_once("infografia.php"); ?>
    
    <footer>
        <?php include_once("footer.php"); ?>        
    </footer>
</body>
</html>

