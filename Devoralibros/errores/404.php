<!--
- Archivo para los errores 404.
- @author Miguel Costa.
-
-->
<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    include ('php/funciones.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="msapplication-TileImage" content="tile.png" />
<meta name="msapplication-TileColor" content="#d83434" />

<title>Devoralibros404</title>
<link type="text/css" rel="stylesheet" href="../css/font-awesome.css" />

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async
	src="https://www.googletagmanager.com/gtag/js?id=UA-103067390-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    
    gtag('config', 'UA-103067390-1');
</script>

<link href='https://fonts.googleapis.com/css?family=Pathway+Gothic+One'
	rel='stylesheet' type='text/css' />
<link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah"
	rel="stylesheet">
<link href="../apple-touch-icon.png" rel="apple-touch-icon" />
<link href="../apple-touch-icon-152x152.png" rel="apple-touch-icon"
	sizes="152x152" />
<link href="../apple-touch-icon-167x167.png" rel="apple-touch-icon"
	sizes="167x167" />
<link href="../apple-touch-icon-180x180.png" rel="apple-touch-icon"
	sizes="180x180" />
<link href="../icon-hires.png" rel="icon" sizes="192x192" />
<link href="../icon-normal.png" rel="icon" sizes="128x128" />
<script src="../jquery/jquery-3.1.1.min.js"></script>
<script src="../jquery/jquery_scroll_menuNavegacion.js"></script>
<script src="https://code.jquery.com/jquery-latest.min.js"
	type="text/javascript"></script>
<script src="../jquery/cookies.js" type="text/javascript"></script>

<!-- Metemos un aleatorio para el css y el jss -->
<script>
var rutacss1 = "../css/main.css?" + Math.random();
var rutacss2 = "../css/main_libros.css?" + Math.random();
    var rutajs1 = "../jquery/jquery_menuMoviles_desplegable.js?" + Math.random();
    var rutajs2 = "../jquery/jquery_listaDeslizante.js?" + Math.random();
    var rutajs3 = "../jquery/jquery_busqueda_avanzada.js?" + Math.random();
    var rutajs4 = "../jquery/jquery_premios.js?" + Math.random();
    var rutajs5 = "../jquery/jquery_conocenos.js?" + Math.random();
    var rutajs6 = "../jquery/jquery_scroll_menuNavegacion.js?" + Math.random();
    var script = "script";
    
    document.write('<link rel="stylesheet" href="' + rutacss1 + '" type="text/css" media="screen" />'); 
    document.write('<link rel="stylesheet" href="' + rutacss2 + '" type="text/css" media="screen" />'); 
    document.write('<script src="' + rutajs1 + '"></' + script + '>');
    document.write('<script src="' + rutajs2 + '"></' + script + '>');
    document.write('<script src="' + rutajs3 + '"></' + script + '>');
    document.write('<script src="' + rutajs4 + '"></' + script + '>');
    document.write('<script src="' + rutajs5 + '"></' + script + '>');
    document.write('<script src="' + rutajs6 + '"></' + script + '>');
</script>

</head>
<body>
	<header>
		<nav>
          <?php include_once("php/menuNavError.php");?>		
        </nav>
    </header>
    
    	<?php include_once("../php/conocenos.php");?>
    
    	<div class="error404">
    	
            <h2>Ups!!</h2>
            <p>Tenemos algún problemilla, aprovecha a leer un poco o...juega una partidita de '7 y media' en lo que lo arreglamos.</p>
            <form id='pedirCarta' action="/errores/404.php" method="POST">
                <button class="boton juego pedir" type="submit" name="pedir">Pedir Carta</button>
                <button class="boton juego plantarse" style="display:none;" type="submit" name="plantarse">Plantarse</button>
                <button class="boton juego otraPartida" style="display:none;" type="submit" name="otraPartida">Otra Partida</button>
            </form>
            <?php
                // Comportamiento de cada botón.
                if(isset($_POST['otraPartida'])) {
                    session_destroy();
                }
    
                if(isset($_POST['pedir'])) {
                    $jugador = 'humano';
                    pedirCarta($jugador);
                }
    
                if(isset($_POST['plantarse'])) {
                    plantarse();
                }
            ?>
    	
    	</div>
    
    </body>
</html>
