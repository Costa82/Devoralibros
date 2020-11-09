<!--
- Archivo index principal con toda la estructura de la página.
- @author Miguel Costa.
-
-->

<?php
include_once ("clases/Libro.php");
include_once ("clases/Usuario.php");
include_once ("clases/Noticia.php");
include_once ("clases/Concurso.php");
require_once 'inc/funciones.php';

sesion();
if (isset($_SESSION['id_usuario']) and (isset($_SESSION['datos']['tipo_usuario']) == 1 or isset($_SESSION['datos']['tipo_usuario']) == 2)) {
    
    $usuario = new Usuario();
    $nick = $_SESSION['datos']['nick'];
    $id = $_SESSION['datos']['id_usuario'];
    $foto = $_SESSION['datos']['foto'];
}

// Variable de sesion para saber en qué página estamos y podamos volver a ella
$_SESSION['pagina'] = "index";

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="msapplication-TileImage" content="tile.png" />
<meta name="msapplication-TileColor" content="#d83434" />
<meta name="description"
	content="Leer no es solo mezclarse con las palabras de unas páginas encuadernadas, es adentrarse en un mundo creado por alguien para si mismo, para ti,
     y recrearlo dentro de tu mente, considerando RECREAR bajo la más literal de sus acepciones: volver a crear algo, una historia creada por el escritor, y recreada por el lector...TÚ" />
<title>Devoralibros</title>
<link type="text/css" rel="stylesheet" href="css/font-awesome.css" />

<script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="f223db39-bbaf-4c29-bfe1-8d6bb6ea19cc" data-blockingmode="auto" type="text/javascript"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async
	src="https://www.googletagmanager.com/gtag/js?id=UA-103067390-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-103067390-1', { 'anonymize_ip': true });
</script>

<link href='https://fonts.googleapis.com/css?family=Pathway+Gothic+One'
	rel='stylesheet' type='text/css' />
<link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah"
	rel="stylesheet">
<link href="apple-touch-icon.png" rel="apple-touch-icon" />
<link href="apple-touch-icon-152x152.png" rel="apple-touch-icon"
	sizes="152x152" />
<link href="apple-touch-icon-167x167.png" rel="apple-touch-icon"
	sizes="167x167" />
<link href="apple-touch-icon-180x180.png" rel="apple-touch-icon"
	sizes="180x180" />
<link href="icon-hires.png" rel="icon" sizes="192x192" />
<link href="icon-normal.png" rel="icon" sizes="128x128" />
<script src="jquery/jquery-3.1.1.min.js"></script>
<script src="jquery/jquery_scroll_menuNavegacion.js"></script>
<script src="https://code.jquery.com/jquery-latest.min.js"
	type="text/javascript"></script>
<script src="jquery/cookies.js" type="text/javascript"></script>

<!-- Metemos un aleatorio para el css y el jss -->
<script>
var rutacss1 = "css/main.css?" + Math.random();
var rutacss2 = "css/main_libros.css?" + Math.random();
    var rutajs1 = "jquery/jquery_menuMoviles_desplegable.js?" + Math.random();
    var rutajs2 = "jquery/jquery_listaDeslizante.js?" + Math.random();
    var rutajs3 = "jquery/jquery_busqueda_avanzada.js?" + Math.random();
    var rutajs4 = "jquery/jquery_premios.js?" + Math.random();
    var rutajs5 = "jquery/jquery_conocenos.js?" + Math.random();
    var rutajs6 = "jquery/jquery_scroll_menuNavegacion.js?" + Math.random();
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
          <?php include_once("php/menuNavIndex.php");?>		
        </nav>

		<div id='slider'>

			<div class="busqueda_avanzada">
				<div class="pestana">
					<p>Búsqueda avanzada</p>
				</div>
                  <?php include_once("php/formulario_avanzado_index.php");?>
              </div>

			<!-- <div class="devoralibros_mensual">                
                  <?//php include_once("php/ganador_mes_index.php");?>
              </div> -->

			<div class="contenedor_titulo">
				<img class="titulo_devoralibros"
					src="img/DEVORALIBROS_17_300ppi.png" />
			</div>

			<div id='buscador'>
				<form action="Buscador/" method="POST">
					<label><p>Busca tu libro</p> <input type="search" name="nombre"
						placeholder="Buscar"></label>
				</form>
			</div>

		</div>

		<div class="navegacion">
           <?php include_once("php/navegacionSecundariaIndex.php");?>
        </div>

	</header>
	
	<center>
		<iframe
			src="https://rcm-eu.amazon-adsystem.com/e/cm?o=30&p=42&l=ur1&category=amazon_es&banner=0R3J1Y4B94F3QYQB7VR2&f=ifr&linkID=d173bf045260285c0ac34630d19a3e5d&t=devora-21&tracking_id=devora-21"
			width="234" height="60" scrolling="no" border="0" marginwidth="0"
			style="border: none;" frameborder="0"></iframe>
	</center>
  
    <?php include_once("php/conocenos.php");?>
    
  	<section class='libroDelDia'>
		<!--h2>Por si te interesa...</h2-->
            <?php
            $noticia = new Noticia();
            $noticia->mostrar_ultima_noticia();
            ?>
    </section>

	<center>
		<div class='publicidad'>
			<script async
				src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- Adaptable -->
			<ins class="adsbygoogle" style="display: block"
				data-ad-client="ca-pub-6841941891904085" data-ad-slot="5370628212"
				data-ad-format="auto"></ins>
			<script>
        (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
		</div>
	</center>

	<section class='libroDelDia'>
		<h2>Te proponemos...</h2>            
            <?php
            $libro = new Libro();
            $libro->libro_del_dia();
            ?>
    </section>

	<section class='ultimosSubidos'>
		<h2 class='tituloazul'>
			<a href="Novedades/">Novedades</a>
		</h2>
		<ul class="temas_flex">            
            <?php
            Libro::novedades();
            ?>
        </ul>
	</section>

	<section class='librosPopulares'>
		<h2>
			<a href="MejorVotados/">Libros mejor votados</a>
		</h2>
		<ul class="temas_flex">
            <?php
            $libros = Libro::libros_mejor_valorados();
            foreach ($libros as $key => $value) {
                Libro::imprimir_libro_mv($value);
            }
            ?>
        </ul>
	</section>

	<section class='ultimosSubidos'>
		<h2 class='tituloazul'>
			<a href="UltimosSubidos/">Últimos libros subidos</a>
		</h2>
		<ul class="temas_flex">            
            <?php
            Libro::ultimos_libros_subidos();
            ?>
        </ul>
	</section>
  
    <?php include_once("php/infografiaIndex.php");?>
  
    <center>
		<div class='publicidad'>
			<script async
				src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- Adaptable -->
			<ins class="adsbygoogle" style="display: block"
				data-ad-client="ca-pub-6841941891904085" data-ad-slot="5370628212"
				data-ad-format="auto"></ins>
			<script>
        (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
		</div>
	</center>

	<!--//BLOQUE COOKIES
	<div id="overbox3">
		<div id="infobox3">
			<p>
				Hola Devorador, esta web utiliza cookies para obtener datos
				estadísticos de la navegación de sus usuarios. Si continúas
				navegando consideramos que aceptas su uso. <a
					href="politica-privacidad.php">Más información </a> <a
					onclick="aceptar_cookies();" style="cursor: pointer;"> Cerrar</a>
			</p>
		</div>
	</div>
	//FIN BLOQUE COOKIES-->
	
	<footer>
        <?php include_once("php/footer.php");?>        
    </footer>

</body>
</html>
