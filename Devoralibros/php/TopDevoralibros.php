<!--
- Visor de los Top Devoralibros.
- @author Miguel Costa.
-
-->
<?php
require_once '../inc/funciones.php';
require_once '../inc/validaciones.inc.php';
include_once ('../clases/Usuario.php');
include_once ('../clases/Log.php');
sesion();

$log = new Log();
$desdeDonde = "TopDevoralibros.php";
$usuario = new Usuario();

if (isset($_SESSION['datos'])) {
    $nick = $_SESSION['datos']['nick'];
    $id_usuario = $_SESSION['datos']['id_usuario'];
    $foto = $_SESSION['datos']['foto'];
}
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Top Devoralibros</title>
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
                include_once ("menuNavVisores.php");
            ?>
			
		</nav>
		<div class="busqueda_avanzada">
			<div class="pestana">
				<p>Búsqueda avanzada</p>
			</div>
				
				<?php
                    include_once ("formulario_avanzado.php");
                ?>
				
			</div>
		<div class="devoralibros_mensual">  
			
				<?php
                    include_once ("ganador_mes_index.php");
                ?>
				
			</div>
	</header>
		<?php
            $top = new Usuario();
        ?>
		<!--section class="puntos">
			<img src="../img/promoDevoralibros.jpg" width="100%" height="100%" alt="Promo Top Devoralibros">
		</section>-->

	<div class="tops">
		<section class="topMensual">
			<h1>Top Mensual</h1>
			
			<?php
                $top->mostrarTopMensual();
            ?>
			
		</section>
		<section class="topAnual">
			<h1>Top General</h1>
			
			<?php
                $top->mostrarTopAnual();
            ?>
			
		</section>
	</div>
	<section class="puntos">
		<p>¡Mejora tu Status de Devorador! Sumarás puntos por registrarte,
			subir libros, realizar comentarios, votar libros...etc. Conseguirás
			regalos al subir de Status y lo más importante...¡serás la envidia de
			los demás devoradores!</p>
		<p>Hasta 100 pts. Devorador Novel</p>
		<p>Hasta 500 pts. Devorador Medio</p>
		<p>Hasta 1000 pts. Devorador Experto</p>
		<p>Más de 1000 pts. Devorador Máster</p>
		<p>¡A SUMAR!</p>
		<p>
			<a class='conseguirPuntos' href='../Preguntas/4'
				title='como conseguir puntos'>Pincha aquí para ver como conseguir
				puntos...</a>
		</p>
	</section>
		
		<?php
            include_once ("infografia.php");
        ?>
        
		<footer>
			<?php
                include_once ("footer.php");
            ?>          
		</footer>
</body>
</html>
