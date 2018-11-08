<!--
- Formulario de subir reseña.
- @author Miguel Costa.
-
-->

<?php
require_once '../inc/funciones.php';
require_once '../inc/validaciones.inc.php';
include_once ("../clases/Libro.php");
$libro = new Libro();
sesion();

// nos aseguramos que pertenece al tipo 2 de administradores
if (isset($_SESSION['id_usuario']) and (isset($_SESSION['datos']['tipo_usuario']) == 2)) {
    $nick = $_SESSION['datos']['nick'];
    $id_usuario = $_SESSION['datos']['id_usuario'];
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Type"
    	content="application/xhtml+xml; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Formulario de Subida de Libros</title>
    <!-- CSS -->
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
    <script src="../jquery/jquery-3.1.1.min.js"></script>
    <script src="../jquery/jquery_vaciarTextArea.js"></script>
    <script src="../jquery/jquery_acordeon.js"></script>
</head>
<body>
        <?php
        require_once '../inc/definesLibro.inc.php';
        require_once '../inc/validacionesLibro.inc.php';
        require_once "../clases/Libro.php";
        
        $libro = new Libro();
        $id_usuario = $_SESSION['datos']['id_usuario'];
        $tipo_usuario = $_SESSION['datos']['tipo_usuario'];
        ?>
        
        <div class="container">
		<div class="form-box">
			<div class="form-top">
				<div class="form-top-left">
					<div class="derecha">
						<a href='../Inicio' title='Inicio'><img
							src='../img/DEVORALIBROS_8_72ppi.png' alt='Devoralibros' /></a>
					</div>
					<div>
						<h2>Sube un libro</h2>
						<p>
							<span>*</span> Campos obligatorios.
						</p>
					</div>
					
                <?php
                if (isset($_REQUEST['addLib'])) {
                    $libro = new Libro();
                    
                    if (isset($_REQUEST['titulo']) and isset($_REQUEST['autor']) and isset($_REQUEST['sinopsis']) and isset($_REQUEST['genero']) and isset($_REQUEST['resumen']) and isset($_REQUEST['serie']) and isset($_REQUEST['pelicula'])) {
                        
                        // Imagen
                        $img = $_FILES['img'];
                        
                        // Titulo
                        $titulo = $_REQUEST['titulo'];
                        
                        // Isbn. Ya no guardamos el numero Isbn, guardamos por defecto el 123. Futura mejora??
                        $isbn = 123;
                        
                        // Autor
                        $autor = $_REQUEST['autor'];
                        
                        // Es el autor del libro
                        if (isset($_REQUEST['autorLibro'])) {
                            $autorLibro = 1;
                        } else {
                            $autorLibro = 0;
                        }
                        
                        // Sinopsis
                        $sinopsis = $_REQUEST['sinopsis'];
                        
                        // Genero
                        $genero = $_REQUEST['genero'];
                        
                        // Genero2
                        if ($_REQUEST['genero2'] == "") {
                            $genero2 = NULL;
                        } elseif ($_REQUEST['genero2'] == $genero) {
                            $genero2 = NULL;
                        } else {
                            $genero2 = $_REQUEST['genero2'];
                        }
                        
                        // Resumen
                        $resumenTrim = trim($_REQUEST['resumen']);
                        
                        if ($resumenTrim == "Novedad" || $resumenTrim == "NOVEDAD" || $resumenTrim == "novedad") {
                            $resumen = "¡Sé el primero en leerte el libro y subir tu resumen personal!";
                        } else {
                            $resumen = $_REQUEST['resumen'];
                        }
                        
                        // Votacion
                        if ($_REQUEST['votacion'] == "" || empty($_REQUEST['votacion']) || $_REQUEST['votacion'] == "Voto") {
                            $votacion = NULL;
                        } else {
                            $votacion = $_REQUEST['votacion'];
                        }
                        
                        // Banner de Amazon
                        if (isset($_REQUEST['banner'])) {
                            if ($_REQUEST['banner'] == "" || $_REQUEST['banner'] == "Banner de Amazon...") {
                                $banner = NULL;
                            } else {
                                $banner = $_REQUEST['banner'];
                            }
                        } else {
                            $banner = NULL;
                        }
                        
                        // Tiene serie
                        if (empty($_REQUEST['serie'])) {
                            $serie = "NULL";
                        } else {
                            if ( strtoupper($_REQUEST['serie']) == "NO") {
                                $serie = "NULL";
                            } else {
                                $serie = $_REQUEST['serie'];
                            }
                        }
                        
                        // Tiene pelicula
                        if (empty($_REQUEST['pelicula'])) {
                            $pelicula = "NULL";
                        } else {
                            if ( strtoupper($_REQUEST['pelicula']) == "NO") {
                                $pelicula = "NULL";
                            } else {
                                $pelicula = $_REQUEST['pelicula'];
                            }
                        }
                        
                        // Fecha subida
                        $fecha_subida = date("Y-m-d");
                        
                        // AddLibro
                        $num = $libro->addLibro($id_usuario, $titulo, $isbn, $autor, $autorLibro, $sinopsis, $genero, $genero2, $resumen, $serie, $pelicula, $fecha_subida, $img, $banner, $votacion);
                        // $num=$_REQUEST['mensaje'];
                        $resultado = validacionAddLibro($num);
                        if ($num == - 402) {
                            echo "<h3 class='noerror'>" . $resultado . "</h3>";
                        } elseif ($num == - 400) {
                            echo "<h3 class='error'>" . $resultado . "</h3>";
                        } elseif ($num == - 401) {
                            echo "<h3 class='error'>" . $resultado . "</h3>";
                        }
                    } else {
                        echo "<h3 class='error'>NO SE HA PODIDO SUBIR EL LIBRO</h3>";
                    }
                }
                ?>
                
              </div>
			</div>
			<div class="form-bottom">

				<iframe width=102% height="315"
					src="https://www.youtube.com/embed/O66XHvaslOo?disablekb=1"
					allowfullscreen></iframe>

				<form action="#" method="post" enctype="multipart/form-data"
					id="formSubirLibro">

					<div class="form-group">
						<label><span>* </span>Título</label> <input type="text"
							name="titulo" size="25" required="required" />
					</div>

					<div class="form-group">
						<label><span>* </span>Autor</label> <input type="text"
							name="autor" size="50" required="required" />
					</div>

					<div class="form-group">
						<label>¿Eres el escritor del libro?</label> <input type="checkbox"
							name="autorLibro" value="No" />
					</div>

					<div class="form-group">
						<p>
							<label><span>* </span>Género/s</label>
						</p>
						<select name="genero">
							<option value="cualquiera" selected></option>
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
							<option value="cualquiera" selected></option>
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
						<textarea name="sinopsis" rows="10" cols="40" required="required">Escribe la sinopsis...</textarea>
					</div>

					<div class="form-group">
						<label><span>* </span>Resumen personal</label>
						<textarea name="resumen" rows="10" cols="40" required="required"></textarea>
					</div>

					<div class="form-group">
						<p>
							<label>Votación</label>
						</p>
						<select name="votacion">
							<option value="Voto" selected>Voto</option>
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
						</select>
					</div>

					<div class="form-group">
						<label>¿Tiene serie? (Pon su título)</label> <input type="text"
							name="serie" size="25" />
					</div>

					<div class="form-group">
						<label>¿Tiene película? (Pon su título)</label> <input type="text"
							name="pelicula" size="25" />
					</div>

					<div class="form-group">
						<label>Añade una imagen <i class="fa fa-question-circle"
							aria-hidden="true"
							title="Si decides subir una imagen (puedes subir un libro sin imagen, luego nos encargaremos nosotros de añadirla) la puedes descargar desde google. Tan solo tienes que buscarla por el título, ir a 'Imágenes', hacer click con el botón derecho encima de ella y seleccionar 'Guardar imagen como...'. Cuidado con subir imágenes giradas y de mala calidad"></i></label>
						<input type="file" name="img" /><input type="hidden"
							name="lim_tamano" value="1000000" />
					</div>
                  <?php
                
                if ($tipo_usuario == 2) {
                    echo "<div class='form-group'>
                        <label>Banner Amazon</label>
                          <textarea name='banner' rows='10' cols='40'>Banner de Amazon...</textarea>
                      </div>";
                }
                ?>
                
                <div class="botones">
						<button type="submit" name="addLib" class="btn">Aceptar</button>
                  <?php
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
