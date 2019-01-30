<!--
- Archivo visorUltimosSubidos.php con toda la estructura del buscador de libros.
- @author Miguel Costa.
-
-->
<?php
require_once '../inc/funciones.php';
sesion();
require_once '../inc/validaciones.inc.php';
include_once ("../clases/Libro.php");
include_once ('../clases/Usuario.php');
$usuario = new Usuario();

if (isset($_SESSION['datos'])) {
    $nick = $_SESSION['datos']['nick'];
    $id_usuario = $_SESSION['datos']['id_usuario'];
    $foto = $usuario->getFoto($id_usuario);
}

$libro = new Libro();

// Variable de sesion para saber en qué página estamos y podamos volver a ella
$_SESSION['pagina'] = "visorUltimosSubidos";

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Visor últimos libros subidos</title>
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
    (adsbygoogle = window.adsbygoogle || []).push({
      google_ad_client: "ca-pub-6841941891904085",
      enable_page_level_ads: true
    });
</script>

<!-- Metemos un aleatorio para el css y el jss -->
<script>
    var rutacss1 = "../css/main.css?" + Math.random();
    var rutacss2 = "../css/main_libros.css?" + Math.random();
    var rutacss3 = "../css/main_perfil.css?" + Math.random();
    var rutajs1 = "../jquery/jquery_menuMoviles_desplegable.js?" + Math.random();
    var rutajs2 = "../jquery/jquery_listaDeslizante.js?" + Math.random();
    var rutajs3 = "../jquery/jquery_scroll_menuNavegacion.js?" + Math.random();
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
            <?php include_once("menuNavBuscadores.php");?>		
	</nav>
		<div class="busqueda_avanzada">
			<div class="pestana">
				<p>Búsqueda avanzada</p>
			</div>
            <?php include_once("formulario_avanzado.php");?>
        </div>
		<div class="devoralibros_mensual">               
                <?php include_once("ganador_mes_index.php");?>
        </div>
	</header>
    <?php
    $libro->mostrarUltimosSubidos();
    ?>
    <?php include_once("infografia.php");?>
    <footer>
        <?php include_once("footer.php");?>        
    </footer>
</body>
</html>