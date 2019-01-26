<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Galería de fotos</title>
<link type="text/css" rel="stylesheet" href="../css/font-awesome.css" />

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

<!-- Metemos un aleatorio para la recarga automática del css y el js -->
<script>

    var rutacss1 = "../css/main.css?" + Math.random();
    var rutacss2 = "../jquery/jquery_menuMoviles_desplegable.js?" + Math.random();
    var script = "script";
    
    document.write('<link rel="stylesheet" href="' + rutacss1 + '" type="text/css" media="screen" />');
    document.write('<script src="' + rutacss2 + '"></' + script + '>');
	
</script>

<script>
        function validar(){
            if (document.getElementById('condiciones').checked){
            	return true;
            }
            else
            {
                alert("El formulario no puede ser enviado si no acepta el Aviso Legal y la Política de Privacidad");
                return false;
            }
        }
</script>

</head>
<body>
	<header>

		<nav>
          <?php include_once("menuNav.php");?>		
      	</nav>
	</header>

	<div class="contenedor_contacto">

		<h3>CONTACTO</h3>

		<p>
			Estamos aquí solo para que disfrutes, para eso queremos ponértelo
			fácil y qué mejor manera que contactando con nosotros. Te
			contestaremos lo antes posible, atenderemos tus dudas y por supuesto,
			¡haremos que vuelvas! </br>
			</br>Calle Paraíso 2 (Pasaje Alarcón) </br>
			</br>47003 Valladolid </br>
			</br>Teléfono 983.85.73.69 </br>
			</br>Email: <a href="mailto:info@merendalia.es" title="Contactar"><i>info@merendalia.es</i></a>
		</p>
	</div>

	<div class="contenedor_formulario">
    	<?php include_once("formulario_contacto.php");?>	
	</div>

	<footer>
        <?php include_once("footer.php");?>        
    </footer>

</body>
</html>