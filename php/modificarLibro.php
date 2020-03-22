<!--
- Formulario de edición de libro.
- @author Miguel Costa.
-
-->
<?php
require_once '../inc/funciones.php';
sesion();
require_once '../inc/validaciones.inc.php';
include_once ("../clases/Libro.php");
$libro = new Libro();
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type"
	content="application/xhtml+xml; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Modifica tu libro</title>
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
						<h2>Modifica el libro</h2>
						<p>
							<span>*</span> Campos obligatorios.
						</p>
					</div>
                <?php
                if (isset($_REQUEST['modificar'])) {
                    
                    $libro = new Libro();
                    if (isset($_REQUEST['titulo']) and isset($_REQUEST['autor']) and isset($_REQUEST['sinopsis']) and isset($_REQUEST['genero']) and isset($_REQUEST['resumen'])) {
                        
                        $titulo = $_REQUEST['titulo'];
                        $isbn = 123;
                        $autor = $_REQUEST['autor'];
                        $sinopsis = $_REQUEST['sinopsis'];
                        $genero = $_REQUEST['genero'];
                        $resumen = $_REQUEST['resumen'];
                        if (isset($_REQUEST['banner'])) {
                            if ($_REQUEST['banner'] == "" || $_REQUEST['banner'] == "Banner de Amazon...") {
                                $banner = NULL;
                            } else {
                                $banner = str_replace("style", "stile", $_REQUEST['banner']);
                            }
                        } else {
                            $banner = NULL;
                        }
                        if ($_REQUEST['genero2'] == "") {
                            $genero2 = "NULL";
                        } elseif ($_REQUEST['genero2'] == $genero) {
                            $genero2 = "NULL";
                        } else {
                            $genero2 = $_REQUEST['genero2'];
                        }
                        if (empty($_REQUEST['serie'])) {
                            $serie = "NULL";
                        } else {
                            $serie = $_REQUEST['serie'];
                        }
                        if (empty($_REQUEST['pelicula'])) {
                            $pelicula = "NULL";
                        } else {
                            $pelicula = $_REQUEST['pelicula'];
                        }
                        $id_usuario = $_SESSION['datos']['id_usuario'];
                        $id_libro = $_GET['libro'];
                        $img_portada = $_FILES['img_portada'];
                        if ($_FILES['img_portada']['size'] == 0) {
                            // no cambiar la imagen
                            $img_portada = $libro->get_imagen($id_libro);
                        } else {
                            $img_portada = $_FILES['img_portada'];
                        }
                        if (! $libro->modificarLibro($id_libro, $titulo, $isbn, $autor, $sinopsis, $genero, $genero2, $resumen, $serie, $pelicula, $banner)) {
                            echo "<h3 class='noerror'>Libro actualizado</h3>";
                            if ($_FILES['img_portada']['size'] != 0) {
                                $libro->modificarImgLibro($titulo, $img_portada, $id_libro);
                            }
                        } else {
                            echo "<h3 class='error'>NO SE HA PODIDO ACTUALIZAR EL LIBRO</h3>";
                        }
                    } else {
                        echo "<h3 class='error'>NO SE HA PODIDO ACTUALIZAR EL LIBRO</h3>";
                    }
                }
                ?>
              </div>
			</div>
			<div class="form-bottom">
				<form enctype="multipart/form-data" action="#" method="POST"
					class="login-form">
             <?php
            $id_usuario = $_SESSION['datos']['id_usuario'];
            $tipo_usuario = $_SESSION['datos']['tipo_usuario'];
            $id_libro = $_GET['libro'];
            $titulo = $libro->nombreLibro($id_libro);
            $isbn = 123;
            $autor = $libro->get_autor($id_libro);
            $genero = $libro->get_genero($id_libro);
            $genero2 = $libro->get_genero2($id_libro);
            if ($genero2 == "NULL") {
                $genero2 = "";
            }
            $sinopsis = $libro->get_sinopsis($id_libro);
            $resumen = $libro->get_resumen($id_libro);
            $banner = str_replace("style", "stile", $libro->get_banner($id_libro));
            $serie = $libro->get_serie($id_libro);
            if ($serie == "NULL") {
                $serie = "";
            }
            $pelicula = $libro->get_pelicula($id_libro);
            if ($pelicula == "NULL") {
                $pelicula = "";
            }
            $img_portada = $libro->get_imagen($id_libro);
            ?>
             <div class="form-group">
						<label><span>* </span>Título</label> <input type="text"
							name="titulo" size="25" value="<?php echo $titulo; ?>"
							required="required" />
					</div>
					<div class="form-group">
						<label><span>* </span>Autor</label> <input type="text"
							name="autor" size="50" value="<?php echo $autor; ?>"
							required="required" />
					</div>
					<div class="form-group">
						<p>
							<label><span>* </span>Género/s</label>
						</p>
						<select name="genero">
							<option value="<?php echo $genero; ?>" selected><?php echo $genero; ?></option>
							<option value="Autoayuda">Autoayuda</option>
							<option value="Aventuras">Aventuras</option>
							<option value="Bélico">Bélico</option>
							<option value="Biográfico">Biográfico</option>
							<option value="Ciencia Ficción">Ciencia Ficción</option>
							<option value="Comedia">Comedia</option>
							<option value="Cómic">Cómic</option>
							<option value="Drama">Drama</option>
							<option value="Ensayo">Ensayo</option>
							<option value="Erótico">Erótico</option>
							<option value="Espionaje">Espionaje</option>
							<option value="Fantástico">Fantástico</option>
							<option value="Filosófico">Filosófico</option>
							<option value="Histórico">Histórico</option>
							<option value="Infantil">Infantil</option>
							<option value="Juvenil">Juvenil</option>
							<option value="Misterio">Misterio</option>
							<option value="Narrativa">Narrativa</option>
							<option value="Novela">Novela</option>
							<option value="Poesía">Poesía</option>
							<option value="Policíaco">Policíaco</option>
							<option value="Romántico">Romántico</option>
							<option value="Satírico">Satírico</option>
							<option value="Suspense">Suspense</option>
							<option value="Teatro">Teatro</option>
							<option value="Terror">Terror</option>
							<option value="Utópico">Utópico</option>
						</select> <select name="genero2">
							<option value="<?php echo $genero2; ?>" selected><?php echo $genero2; ?></option>
							<option value="Autoayuda">Autoayuda</option>
							<option value="Aventuras">Aventuras</option>
							<option value="Bélico">Bélico</option>
							<option value="Biográfico">Biográfico</option>
							<option value="Ciencia Ficción">Ciencia Ficción</option>
							<option value="Comedia">Comedia</option>
							<option value="Cómic">Cómic</option>
							<option value="Drama">Drama</option>
							<option value="Ensayo">Ensayo</option>
							<option value="Erótico">Erótico</option>
							<option value="Espionaje">Espionaje</option>
							<option value="Fantástico">Fantástico</option>
							<option value="Filosófico">Filosófico</option>
							<option value="Histórico">Histórico</option>
							<option value="Infantil">Infantil</option>
							<option value="Juvenil">Juvenil</option>
							<option value="Misterio">Misterio</option>
							<option value="Narrativa">Narrativa</option>
							<option value="Novela">Novela</option>
							<option value="Poesía">Poesía</option>
							<option value="Policíaco">Policíaco</option>
							<option value="Romántico">Romántico</option>
							<option value="Satírico">Satírico</option>
							<option value="Suspense">Suspense</option>
							<option value="Teatro">Teatro</option>
							<option value="Terror">Terror</option>
							<option value="Utópico">Utópico</option>
						</select>
					</div>
					<div class="form-group">
						<label><span>* </span>Sinopsis</label>
						<textarea name="sinopsis" rows="10" cols="40" required="required"><?php echo strip_tags($sinopsis); ?></textarea>
					</div>

					<div class="form-group">
						<label><span>* </span>Resumen personal</label>
						<textarea name="resumen" rows="10" cols="40" required="required"><?php echo strip_tags($resumen); ?></textarea>
					</div>
                      <?php
                    if ($tipo_usuario == 2) {
                        echo "<div class='form-group'>
                            <label>Banner Amazon</label>
                              <textarea name='banner' rows='10' cols='40'>" . $banner . "</textarea>
                          </div>";
                    }
                    ?>
                      <div class="form-group">
						<label>¿Tiene serie?</label> <input type="text" name="serie"
							value="<?php echo $serie; ?>" size="25" />
					</div>
					<div class="form-group">
						<label>¿Tiene película?</label> <input type="text" name="pelicula"
							value="<?php echo $pelicula; ?>" size="25" />
					</div>
					<div class="form-group">
						<label>Cambia la imagen del libro: <img
							src="../img_libros/<?php echo $img_portada; ?>" width="100px" /></label>
						<input type="file" name="img_portada"><input type="hidden"
							name="lim_tamano" value="12000000" />
					</div>
					<div class="botones">
						<button type="submit" name="modificar" class='btn'>Modificar datos</button>
            <?php
            
            $titulo = str_replace(" ", "-", $titulo);
            switch ($tipo_usuario) {
                case 1:
                    $destino = "../Libro/" . $titulo;
                    break;
                case 2:
                    $destino = "../Libro/" . $titulo;
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

