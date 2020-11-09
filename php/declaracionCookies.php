<!--
- Declaración Cookies.
- @author Miguel Costa.
-
-->
<!DOCTYPE html>
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type"
	content="application/xhtml+xml; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>Declaración Cookies</title>

<!-- CSS -->
<link type="text/css" rel="stylesheet" href="../css/font-awesome.css" />

<link rel="stylesheet" href="../css/style.css" />
<link rel="stylesheet" href="../css/form-elements.css" />
<link rel="stylesheet" href="../css/main.css" />
<link rel="stylesheet" href="../css/main_libros.css" />
<link rel="stylesheet" href="../css/main_perfil.css" />
<link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah"
	rel="stylesheet" />
<link href='https://fonts.googleapis.com/css?family=Pathway+Gothic+One'
	rel='stylesheet' type='text/css' />
<script src="../jquery/jquery-3.1.1.min.js"></script>

<!-- Metemos un aleatorio para el css y el jss -->
<script>
	var rutacss1 = "../css/style.css?" + Math.random();
    var rutacss2 = "../css/form-elements.css?" + Math.random();
    var rutacss3 = "../css/main.css?" + Math.random();
    var rutacss4 = "../css/main_libros.css?" + Math.random();
    var rutacss5 = "../css/main_perfil.css?" + Math.random();
    var rutajs1 = "../jquery/jquery_acordeon.js?" + Math.random();
    var rutajs2 = "../jquery/jquery_scroll_menuNavegacion.js?" + Math.random();
    var script = "script";
    
    document.write('<link rel="stylesheet" href="' + rutacss1 + '" type="text/css" media="screen" />'); 
    document.write('<link rel="stylesheet" href="' + rutacss2 + '" type="text/css" media="screen" />'); 
    document.write('<link rel="stylesheet" href="' + rutacss3 + '" type="text/css" media="screen" />');
    document.write('<link rel="stylesheet" href="' + rutacss4 + '" type="text/css" media="screen" />');
    document.write('<link rel="stylesheet" href="' + rutacss5 + '" type="text/css" media="screen" />'); 
    document.write('<script src="' + rutajs1 + '"></' + script + '>');
    document.write('<script src="' + rutajs2 + '"></' + script + '>');
</script>

</head>
<body>
	<div class='contenedorAvisoLegal'>

		<h2>DECLARACIÓN DE COOKIES</h2>
		<h3 class='tituloAviso'>www.devoralibros.es</h3>

		<div class='contenido'>

			<script id="CookieDeclaration"
				src="https://consent.cookiebot.com/f223db39-bbaf-4c29-bfe1-8d6bb6ea19cc/cd.js"
				type="text/javascript" async></script>

		</div>

		<div class="botones">
		<?php

		$pagina = $_GET['pagina'];

		switch ($pagina) {
			case 1:
				$destino="../Inicio";
				break;
			case 2:
				$destino="../Usuario/";
				break;
			case 3:
				$destino="../Administrador/";
				break;
			case 4:
				$destino="../FormularioRegistro/";
				break;
			default:
				$destino="Inicio";
		}
			
		?>
			<button type="button"
				onclick=" location.href='<?php echo $destino;?>' " class="boton"
				title="Volver">Volver</button>
		</div>
	</div>
</body>
</html>



