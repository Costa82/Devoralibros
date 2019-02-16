<!--
- Archivo index principal Merendalia.
- @author Miguel Costa.
-->


<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description"
	content="Alquila el local para celebraciones, cumpleaños, fiestas sorpresa, reuniones con amigos y familia Valladolid. Reserva los menús privados solo para tu grupo." />
<meta name="robots" content="NOODP">
<title>Merendalia</title>
<link type="text/css" rel="stylesheet" href="css/font-awesome.css" />

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

<!-- Metemos un aleatorio para la recarga automática del css y el js -->
<script>

	var rutacss1 = "css/main.css?" + Math.random();
    var rutajs1 = "jquery/jquery_menuMoviles_desplegable.js?" + Math.random();
    var script = "script";
    
    document.write('<link rel="stylesheet" href="' + rutacss1 + '" type="text/css" media="screen" />');
    document.write('<script src="' + rutajs1 + '"></' + script + '>');
	
</script>

</head>
<body>
	<header>

		<nav>
          <?php include_once("php/menuNavIndex.php");?>		
      	</nav>

	</header>

	<!-- PRESENTACIÓN -->

	<div class="presentacion">
		<h1>El ocio a tu manera</h1>
		<p>
			Asiste a los eventos que organizamos o reserva el espacio y organiza
			el tuyo </br>El ocio es cosa de amigos </br>¿entras?
		</p>
	</div>

	<!-- FIN PRESENTACIÓN -->

	<!-- CÍRCULOS -->

	<div class="contenedor_circulos">
		<a class="circulo amarillo" href="eventos/" title="Nuestros Eventos">
			<h2>Nuestros Eventos</h2>
		</a> 
		<a class="circulo rojo" href="reservas-tarifas/"
			title="Reserva de espacio">
			<h2>Reserva de espacio</h2>
		</a> 
		<a class="circulo verde" href="menus-privados/"
			title="Menús privados">
			<h2>Menús privados</h2>
		</a>
		<a class="circulo negro" href="menus-privados/"
			title="Menús bocaditos">
			<h2 class="bocaditos">Menús bocaditos</h2>
		</a>
	</div>

	<!-- FIN CÍRCULOS -->

	<!-- RESEÑAS GOOGLE -->

	<!-- 	<div class="google"> -->

	<!-- 		<h3>Reseñas de Google</h3> -->

	<!-- 		<div class="resenas_google"> -->
	<!-- 			<p class="nombre"> -->
	<!-- 				<img alt="foto google" src="img/ireneCarnero.jpg"><strong> Irene Carnero</strong> -->
	<!-- 			</p> -->
	<!-- 			<p>Fui con la familia y probamos un menú alemán, todo casero, muy -->
	<!-- 				bueno y bastante cantidad. Está muy bien pensado para ir con niños -->
	<!-- 				ya que tiene una piscina de bolas, mi sobrino lo pasó en grande. -->
	<!-- 				También puedes alquilar el espacio entero para eventos, aunque en -->
	<!-- 				esta ocasión estábamos dos grupos y resultó todo muy bien, el -->
	<!-- 				personal un encanto. Repetiremos!</p> -->
	<!-- 		</div> -->

	<!-- 		<div class="resenas_google"> -->
	<!-- 			<p class="nombre"> -->
	<!-- 				<img alt="foto google" src="img/adeliaMerelo.jpg"><strong> Adelia Merelo</strong> -->
	<!-- 			</p> -->
	<!-- 			<p>Hemos celebrado un cumpleaños y nos hemos sentido como si -->
	<!-- 				estuviéramos en nuestra casa. Muy buena comida y excelente atención. -->
	<!-- 				El lugar muy agradable, un acierto reservar un espacio para que los -->
	<!-- 				pequeños puedan jugar " a su aire". Sin duda repetiremos.</p> -->
	<!-- 		</div> -->

	<!-- 		<div class="resenas_google"> -->
	<!-- 			<p class="nombre"> -->
	<!-- 				<img alt="foto google" src="img/cristinaYRaul.jpg"><strong> Cristina y Raul</strong> -->
	<!-- 			</p> -->
	<!-- 			<p>Una tarde estupenda. Los talleres para niños son una idea genial, -->
	<!-- 				salieron encantados. Mi hijo ya me está pidiendo volver: la -->
	<!-- 				actividad, el personal, el lugar, la merienda ...a todo un 10. -->
	<!-- 				Muchas gracias y volveremos pronto.</p> -->
	<!-- 		</div> -->

	<!-- 		<p> -->
	<!-- 			Deja tu reseña en <strong><a -->
	<!-- 				href="http://search.google.com/local/writereview?placeid=ChIJSVs5JN4TRw0Rt_6evx9gRIc" -->
	<!-- 				target="_blank">Google</a></strong> -->
	<!-- 		</p> -->

	<!-- 	</div> -->

	<!-- FIN RESEÑAS GOOGLE -->

	<!-- BLOQUE COOKIES-->

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

	<!-- FIN BLOQUE COOKIES-->

	<footer>
        <?php include_once("php/footer.php");?>        
    </footer>

</body>
</html>