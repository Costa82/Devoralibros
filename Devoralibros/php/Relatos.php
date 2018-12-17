<!--
-
- Visor de los Relatos.-
- @author Miguel Costa.
-
-->

<?php
require_once '../inc/funciones.php';
require_once '../inc/validaciones.inc.php';
include_once ("../clases/Relato.php");
include_once ('../clases/Usuario.php');

sesion();
$usuario = new Usuario();

if (isset($_SESSION['datos'])) {
    $nick = $_SESSION['datos']['nick'];
    $id_usuario = $_SESSION['datos']['id_usuario'];
    $foto = $usuario->getFoto($id_usuario);
}

$autor = str_replace("-", " ", $_GET['autor']);

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Página de Relatos</title>
    <link type="text/css" rel="stylesheet" href="../css/font-awesome.css" />
    
    <script>
          var rutacss1 = "../css/main.css?" + Math.random();
          var rutacss2 = "../css/main_libros.css?" + Math.random();
          document.write('<link rel="stylesheet" href="' + rutacss1 + '" type="text/css" media="screen" />'); 
          document.write('<link rel="stylesheet" href="' + rutacss2 + '" type="text/css" media="screen" />'); 
    </script>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah"
    	rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Pathway+Gothic+One'
    	rel='stylesheet' type='text/css' />
    <script src="../jquery/jquery-3.1.1.min.js"></script>
    <script src="../jquery/jquery-3.1.1.min.js"></script>
    <script src="../jquery/jquery_menuMoviles_desplegable.js"></script>
    <script src="../jquery/jquery_listaDeslizante.js"></script>
    <script src="../jquery/jquery_busqueda_avanzada.js"></script>
    <script src="../jquery/jquery_scroll_menuNavegacion.js"></script>
</head>
<body>
	<header>
		<nav>
            <?php include_once("menuNavVisores.php");?>		
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
        $relato = new Relato();
    ?>
    
    <h1>Relatos y poesías</h1>
    
    <?php 
    if ( isset($id_usuario) ) {
        $relato->console_log($autor);
        $relato->mostrarRelatos($id_usuario, $autor);
    } else {
        $relato->console_log($autor);
        $relato->mostrarRelatos(null, $autor);
    }
    ?>        
    
    <?php include_once("infografia.php");?>
    
    <footer>
        <?php include_once("footer.php");?>        
    </footer>

</body>
</html>


