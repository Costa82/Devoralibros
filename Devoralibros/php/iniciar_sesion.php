<!--
- Formulario de inicio de sesión.
- @author Miguel Costa (HTML5).
-
-->

<?php
require_once '../inc/defines.inc.php';
require_once '../inc/validaciones.inc.php';
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type"
	content="application/xhtml+xml; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Formulario de Inicio de sesión</title>

<!-- CSS -->
<link href='https://fonts.googleapis.com/css?family=Pathway+Gothic+One'
	rel='stylesheet' type='text/css' />
<link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah"
	rel="stylesheet">

<!-- Metemos un aleatorio para el css y el jss -->
<script>
    var rutacss1 = "../css/font-awesome.css?" + Math.random();
    var rutacss2 = "../css/main.css?" + Math.random();
    var rutacss3 = "../css/form-elements.css?" + Math.random();
    var rutacss4 = "../css/style.css?" + Math.random();
    document.write('<link rel="stylesheet" href="' + rutacss1 + '" type="text/css" media="screen" />'); 
    document.write('<link rel="stylesheet" href="' + rutacss2 + '" type="text/css" media="screen" />'); 
    document.write('<link rel="stylesheet" href="' + rutacss3 + '" type="text/css" media="screen" />'); 
    document.write('<link rel="stylesheet" href="' + rutacss4 + '" type="text/css" media="screen" />'); 
</script>

</head>
<body>
	<div class="container">
		<div class="form-box">
			<div class="form-top">
				<div class="form-top-left">
					<div class="derecha">
						<a href='../Inicio' title='Inicio'><img
							src='../img/DEVORALIBROS_8_72ppi.png' alt='Devoralibros' /></a>
					</div>
					<h2>Inicia sesión</h2>
					<p>
						<span>*</span> Campos obligatorios.
					</p>
					<p>
						Si no estás registrado, <a href='../FormularioRegistro/'>regístrate</a>
					</p>
					<div id='errores'>
                            <?php
                            if (isset($_REQUEST['num'])) {
                                $num = $_REQUEST['num'];
                                $mensaje = validacionExisteUsuario($num);
                                echo $mensaje;
                            }
                            ?>
                        </div>
				</div>
			</div>
			<div class="form-bottom">
				<form role="form" action="../php/logueo_header.php" method="post"
					class="login-form">
					<div class="form-group">
						<label><span>* </span>Nick</label> <input type="text" name="nick"
							placeholder=Nick... required="required" />
					</div>
					<div class="form-group">
						<label><span>* </span>Contraseña</label> <input type="password"
							name="contrasena" placeholder=Contraseña... required="required" />
					</div>
					<h3>
						<a href="../FormularioEnvioContraseña/">He olvidado la contraseña
							y/o el Nick...</a>
					</h3>
					<div class="botones">
						<button type="submit" name='loguear' class="btn">¡Inicia sesión!</button>
						<button type="button" onclick=" location.href='../Inicio' "
							class="btn">Volver a Inicio</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
