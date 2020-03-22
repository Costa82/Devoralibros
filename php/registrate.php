<!--
- Formulario de registro.
- @author Miguel Costa (HTML5).
-
-->
<?php
require_once '../inc/defines.inc.php';
require_once '../inc/validaciones.inc.php';
require_once '../clases/Usuario.php';
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type"
	content="application/xhtml+xml; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Formulario de Registro</title>

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

<link href='https://fonts.googleapis.com/css?family=Pathway+Gothic+One'
	rel='stylesheet' type='text/css' />
<link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah"
	rel="stylesheet">
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
					<h2>Regístrate</h2>
					<p>
						<span>*</span> Campos obligatorios.
					</p>
					<p>
						Si ya estás registrado, <a href='../FormularioInicioSesion/'>inicia
							sesión</a>
					</p>
					<div id='errores'>
                        <?php
                        if (isset($_REQUEST['error'])) {
                            $error = urldecode($_REQUEST['error']);
                            $errores = unserialize($error);
                            foreach ($errores as $key => $value) {
                                if ($value == - 306) {
                                    echo "<p class='azul'>- " . validacionExisteUsuario($value) . "</p>";
                                } else {
                                    echo "<p>- " . validacionExisteUsuario($value) . "</p>";
                                }
                            }
                        }
                        ?>
                    </div>
				</div>
			</div>
			<div class="form-bottom">
				<form enctype="multipart/form-data" role="form"
					action="../php/grabar_registro_header.php" method="post"
					class="login-form" onSubmit="return validar();">
					<div class="form-group">
						<label><span>* </span>Nick</label> <input type="text" name="nick"
							placeholder="4 a 8 caracteres" required="required"
							value="<?php if (isset($_SESSION['nickF'])){ echo $_SESSION['nickF']; } ?>" />
					</div>
					<div class="form-group">
						<label><span>* </span>Nombre</label> <input type="text"
							name="nombre" placeholder="Nombre..." required="required"
							value="<?php if (isset($_SESSION['nombreF'])){ echo $_SESSION['nombreF']; } ?>" />
					</div>
					<div class="form-group">
						<label>Apellidos</label> <input type="text" name="apellidos"
							placeholder="Apellidos..."
							value="<?php if (isset($_SESSION['apellidosF'])){ echo $_SESSION['apellidosF']; } ?>" />
					</div>
					<div class="form-group">
						<label><span>* </span>Email</label> <input type="email"
							name="mail" placeholder="Email..." required="required"
							value="<?php if (isset($_SESSION['mailF'])){ echo $_SESSION['mailF']; } ?>" />
					</div>
					<div class="form-group">
						<label>Foto de perfil</label> <input type="file" name="foto"><input
							type="hidden" name="lim_tamano" value="10000000" />
					</div>
					<h3>¡Queremos saber más de ti!</h3>
					<div class="form-group">
						<label>Libro favorito</label> <input type="text"
							name="libro_favorito" placeholder="Libro favorito..."
							value="<?php if (isset($_SESSION['libro_favoritoF'])){ echo $_SESSION['libro_favoritoF']; } ?>" />
					</div>
					<div class="form-group">
						<label>Libro que menos te ha gustado</label> <input type="text"
							name="libro_odiado" placeholder="Libro que menos te gustó..."
							value="<?php if (isset($_SESSION['libro_odiadoF'])){ echo $_SESSION['libro_odiadoF']; } ?>" />
					</div>
					<div class="form-group">
						<label>Autor favorito</label> <input type="text"
							name="autor_favorito" placeholder="Autor favorito..."
							value="<?php if (isset($_SESSION['autor_favoritoF'])){ echo $_SESSION['autor_favoritoF']; } ?>" />
					</div>
					<div class="form-group">
						<p>
							<label>Género favorito</label>
						</p>
						<select name="genero">
							<option
								value="<?php if (isset($_SESSION['generoF'])){ echo $_SESSION['generoF']; }else{ echo "cualquiera";} ?>"
								selected><?php if (isset($_SESSION['generoF'])){ echo $_SESSION['generoF']; } ?></option>
							<option value="Autoayuda">Autoayuda</option>
							<option value="Aventuras">Aventuras</option>
							<option value="Bélico">Bélico</option>
							<option value="Biográfico">Biográfico</option>
							<option value="Ciencia Ficción">Ciencia Ficción</option>
							<option value="Comedia">Comedia</option>
							<option value="Cómic">Cómic</option>
							<option value="Drama">Drama</option>
							<option value="Erótico">Erótico</option>
							<option value="Espionaje">Espionaje</option>
							<option value="Fantástico">Fantástico</option>
							<option value="Filosófico">Filosófico</option>
							<option value="Histórico">Histórico</option>
							<option value="Misterio">Misterio</option>
							<option value="Narrativa">Narrativa</option>
							<option value="Novela">Novela</option>
							<option value="Policíaco">Policíaco</option>
							<option value="Romántico">Romántico</option>
							<option value="Satírico">Satírico</option>
							<option value="Suspense">Suspense</option>
							<option value="Terror">Terror</option>
							<option value="Utópico">Utópico</option>
						</select>
					</div>
					<div class="form-group">
						<label>¿Tienes código de registro?</label> <input type="text"
							name="codigo" placeholder="Introduce el código" />
					</div>
					<div class="form-group">
						<input type="checkbox" name="condiciones" id="condiciones"><label>Acepta
							el <a href="../AvisoLegal/4" title="Aviso Legal">Aviso Legal y la
								Política de Privacidad</a>
						</label>
					</div>
					<div class="botones">
						<button type="submit" name='enviar' class="btn">¡Regístrate!</button>
						<button type="button" name='inicio'
							onclick=" location.href='../Inicio' " class="btn">Volver a Inicio</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
