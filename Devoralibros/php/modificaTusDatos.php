<!--
- Formulario de edición de datos.
- @author Miguel Costa.
-
-->
<?php
require_once '../inc/funciones.php';
sesion();
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
<title>Modifica tus datos</title>
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
					<h2>Modifica tus datos <?php echo $_SESSION['datos']['nick'];?></h2>
					<p>
						<span>*</span> Campos obligatorios.
					</p>
					<div id="errores">
                  <?php
                if (isset($_REQUEST['error'])) {
                    ?>
                        <h3>NO SE HAN PODIDO MODIFICAR LOS DATOS.</h3>
						<p>Existen errores al rellenar los campos:</p>
                        <?php
                    $error = urldecode($_REQUEST['error']);
                    $errores = unserialize($error);
                    // print_r($errores);
                    foreach ($errores as $key => $value) {
                        echo "<p>" . ($key + 1) . "." . validacionExisteUsuario($value) . "</p>";
                    }
                }
                ?>
                </div>
				</div>
			</div>
			<div class="form-bottom">
				<form enctype="multipart/form-data"
					action="../php/modificaTusDatos_header.php" method="POST"
					class="login-form">
             <?php
            $nombre = $_SESSION['datos']['nombre'];
            $apellidos = $_SESSION['datos']['apellidos'];
            if ($_SESSION['datos']['apellidos'] == NULL || $_SESSION['datos']['apellidos'] == "") {
                $apellidos = "";
            } else {
                $apellidos = $_SESSION['datos']['apellidos'];
            }
            if ($_SESSION['datos']['libro_favorito'] == NULL || $_SESSION['datos']['libro_favorito'] == "") {
                $libro_favorito = "";
            } else {
                $libro_favorito = $_SESSION['datos']['libro_favorito'];
            }
            if ($_SESSION['datos']['libro_odiado'] == NULL || $_SESSION['datos']['libro_odiado'] == "") {
                $libro_odiado = "";
            } else {
                $libro_odiado = $_SESSION['datos']['libro_odiado'];
            }
            if ($_SESSION['datos']['autor_favorito'] == NULL || $_SESSION['datos']['autor_favorito'] == "") {
                $autor_favorito = "";
            } else {
                $autor_favorito = $_SESSION['datos']['autor_favorito'];
            }
            if ($_SESSION['datos']['genero_favorito'] == NULL || $_SESSION['datos']['genero_favorito'] == "") {
                $genero_favorito = "";
            } else {
                $genero_favorito = $_SESSION['datos']['genero_favorito'];
            }
            
            ?>
             <div class="form-group">
						<label><span>* </span>Nombre</label> <input type="text"
							name="nombre" value="<?php echo $nombre; ?>" required="required" />
					</div>
					<div class="form-group">
						<label>Apellidos</label> <input type="text" name="apellidos"
							value="<?php echo $apellidos; ?>" />
					</div>
					<div class="form-group">
						<label><span>* </span>Email</label> <input type="email"
							name="mail" value="<?php echo $_SESSION['datos']['mail']; ?>"
							required="required" />
					</div>
					<div class="form-group">
						<label>Cambia tu foto</label> <input type="file" name="foto"><input
							type="hidden" name="lim_tamano" value="10000000" />
					</div>
					<div class="form-group">
						<label>Libro favorito</label> <input type="text"
							name="libro_favorito" value="<?php echo $libro_favorito; ?>" />
					</div>
					<div class="form-group">
						<label>Libro que menos te gustó</label> <input type="text"
							name="libro_odiado" value="<?php echo $libro_odiado; ?>">
					</div>
					<div class="form-group">
						<label>Autor favorito</label> <input type="text"
							name="autor_favorito" value="<?php echo $autor_favorito; ?>">
					</div>
					<div class="form-group">
						<p>
							<label>Género favorito</label>
						</p>
						<select name="genero_favorito">
							<option value="<?php echo $genero_favorito; ?>" selected><?php echo $genero_favorito; ?></option>
							<option value="Aventuras">Aventuras</option>
							<option value="Bélico">Bélico</option>
							<option value="Biográfico">Biográfico</option>
							<option value="Ciencia Ficción">Ciencia Ficción</option>
							<option value="Comic">Cómic</option>
							<option value="Drama">Drama</option>
							<option value="Erótico">Erótico</option>
							<option value="Espionaje">Espionaje</option>
							<option value="Fantástico">Fantástico</option>
							<option value="Histórico">Histórico</option>
							<option value="Misterio">Misterio</option>
							<option value="Policíaco">Policíaco</option>
							<option value="Romántico">Romántico</option>
							<option value="Satírico">Satírico</option>
							<option value="Suspense">Suspense</option>
							<option value="Terror">Terror</option>
							<option value="Utópico">UtópicO</option>
						</select>
					</div>
					<h3>¿Quieres cambiar la contraseña?</h3>
					<div class="form-group">
						<label>Escriba nueva contraseña</label> <input type="password"
							name="passNueva" size="8" /><input type="hidden" name="pass"
							value="<?php echo $_SESSION['datos']['pass']; ?>" />
					</div>
					<div class="form-group">
						<label>Repita nueva contraseña</label> <input type="password"
							name="passRep" size="8" />
					</div>
					<div class="botones">
						<button type="submit" name="modificar" class='btn'>Modificar datos</button>
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
                    $destino = "../Inicio/";
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
