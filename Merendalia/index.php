<!--
- Archivo index principal Merendalia.
- @author   Miguel Costa.
-->


<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Merendalia</title>
<link type="text/css" rel="stylesheet" href="css/font-awesome.css" />

<script>
     var rutacss1 = "css/main.css?" + Math.random();
     document.write('<link rel="stylesheet" href="' + rutacss1 + '" type="text/css" media="screen" />'); 
</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async
	src="https://www.googletagmanager.com/gtag/js?id=UA-122491095-1"></script>
<script>
  	window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    
    gtag('config', 'UA-122491095-1');
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
<script src="https://code.jquery.com/jquery-latest.min.js"
	type="text/javascript"></script>
<script src="jquery/cookies.js" type="text/javascript"></script>
<script src="jquery/jquery_menuMoviles_desplegable.js"></script>

</head>
<body>
	<header>

<!-- 		<div class="titulo_movil"> -->
<!-- 			<a href='' title='Inicio'><img -->
<!-- 				src='img/merendalia_logotipo_RGB-01.png' alt='Merendalia' /></a> -->
<!-- 		</div> -->

		<nav>
          <?php include_once("php/menuNavIndex.php");?>		
      	</nav>

	</header>

	<div class="presentacion">
		<h1>El ocio a tu manera</h1>
		<p>
			Asiste a los eventos que organizamos o reserva el espacio y organiza
			el tuyo </br>El ocio es cosa de amigos </br>¿entras?
		</p>
	</div>

	<div class="contenedor_circulos">
		<a class="circulo amarillo" href="php/eventos.php"
			title="Nuestros Eventos">
			<h2>Nuestros Eventos</h2>
		</a> <a class="circulo rojo" href="php/reservas.php"
			title="Reserva de espacio">
			<h2>Reserva de espacio</h2>
		</a> <a class="circulo verde" href="php/menus.php"
			title="Menús privados">
			<h2>Menús privados</h2>
		</a>
	</div>

	<!--//BLOQUE COOKIES-->
	<div id="overbox3">
		<div id="infobox3">
			<p>
				Esta web utiliza cookies para obtener datos estadísticos de la
				navegación de sus usuarios. Si continúas navegando consideramos que
				aceptas su uso. <a href="php/cookies.php" class="mas_informacion">Más
					información </a> <a onclick="aceptar_cookies();"
					style="cursor: pointer;" class="aceptar"> Aceptar</a>
			</p>
		</div>
	</div>
	<!--//FIN BLOQUE COOKIES-->

	<footer>
        <?php include_once("php/footer.php");?>        
    </footer>

</body>
</html>