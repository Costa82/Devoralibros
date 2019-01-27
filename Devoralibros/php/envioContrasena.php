<!--
- Formulario de recordatorio de contraseña.
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
<title>Formulario de Recordatorio de contraseña</title>
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
					<h2>Recupera tu contraseña y/o tu nick</h2>
					<p>
						<span>*</span> Campos obligatorios.
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
				<div class="form-top-right">
					<i class="fa fa-key"></i>
				</div>
			</div>
			<div class="form-bottom">
				<form role="form" action="../php/envioContrasena_header.php"
					method="post" class="login-form">
					<div class="form-group">
						<label><span>* </span>Email</label> <input type="email"
							name="mail" placeholder=Email... required="required" />
					</div>
					<p>Si el email introducido es correcto recibirá en el mismo la
						nueva contraseña, si no lo encuentra en la carpeta principal
						búsquelo en correo no deseado.</p>
					<div class="botones">
						<button type="submit" name='recuperar' class="btn">Recupera tu
							cuenta</button>
						<button type="button" onclick=" location.href='../Inicio' "
							class="btn">Volver a Inicio</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>

