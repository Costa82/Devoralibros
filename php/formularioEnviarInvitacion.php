<!--
-
- Formulario de invitar a un amigo.
-
-->

<?php
require_once '../inc/funciones.php';
sesion();
require_once '../inc/validaciones.inc.php';
include_once ('../clases/Usuario.php');
$id_usuario = $_SESSION['datos']['id_usuario'];
$nick = $_SESSION['datos']['nick'];
$usuario = new Usuario();
$codigoPatrocinio = $usuario->getCodigoPatrocinio($id_usuario);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type"
	content="application/xhtml+xml; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Formulario de Invitacion</title>

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
					<div>
						<h2>Invita a un amigo</h2>
						<p>Envía tu código de registro a un amigo y ganad los dos 10
							puntos extras.</p>
					</div>
                        <?php
                        if (isset($_REQUEST['enviarInvitacion'])) {
                            if (isset($_REQUEST['mail'])) {
                                $email = $_REQUEST['mail'];
                                $usuario->enviarEmailInvitacion($email, $nick, $codigoPatrocinio);
                                echo "<h3 class='azul'>Se ha enviado la invitación correctamente.</h3>";
                            } else {
                                echo "<h3 class='error'>No se ha podido enviar la invitación.</h3>";
                            }
                        }
                        ?>
                    </div>
			</div>
			<div class="form-bottom">
				<form action="#" method="POST" class="login-form">
						<?php
    echo "<h2>Tu código de invitación es: " . $codigoPatrocinio . "</h2>";
    ?>
						<div class="form-group">
						<label>Introduce el email de tu amigo:</label> <input type="email"
							name="mail" placeholder=email... required="required" />
					</div>
					<div class="botones">
						<button type="submit" name='enviarInvitacion' class="btn">¡Envía
							la invitación!</button>
							<?php
    $tipo_usuario = $_SESSION['datos']['tipo_usuario'];
    switch ($tipo_usuario) {
        case 1:
            $destino = "../Usuario/";
            break;
        case 2:
            $destino = "../Administrador/";
            break;
        
        default:
            $destino = "../Inicio";
            break;
    }
    ?>
                              <button type="button"
							onclick=" location.href='<?php echo $destino;?>' " class="btn">Volver</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
