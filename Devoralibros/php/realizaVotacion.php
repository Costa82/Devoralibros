<!--
- Formulario de votacion.
- @author Miguel Costa (HTML5).
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
<title>Vota el libro</title>
<!-- CSS -->
<link href='https://fonts.googleapis.com/css?family=Pathway+Gothic+One'
	rel='stylesheet' type='text/css' />
<link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah"
	rel="stylesheet">
<script src="../jquery/jquery-3.1.1.min.js"></script>

<!-- Metemos un aleatorio para el css y el jss -->
<script>
    var rutacss1 = "../css/style.css?" + Math.random();
    var rutacss2 = "../css/form-elements.css?" + Math.random();
    var rutacss3 = "../css/main.css?" + Math.random();
    var rutajs1 = "../jquery/jquery_vaciarTextArea.js?" + Math.random();
    var script = "script";
    
    document.write('<link rel="stylesheet" href="' + rutacss1 + '" type="text/css" media="screen" />'); 
    document.write('<link rel="stylesheet" href="' + rutacss2 + '" type="text/css" media="screen" />'); 
    document.write('<link rel="stylesheet" href="' + rutacss3 + '" type="text/css" media="screen" />');
    document.write('<script src="' + rutajs1 + '"></' + script + '>');
</script>

</head>

<body>
	<div class="container">
		<div class="form-box">
			<div class="form-top">
				<div class="form-top-left">
					<h2>Vota el libro <?php echo $_SESSION['datos']['nick'];?></h2>
					<p>
						<span>*</span> Campos obligatorios.
					</p>
                <?php
                if (isset($_REQUEST['votar'])) {
                    if (isset($_SESSION['id_usuario'])) {
                        $id_usuario = $_SESSION['datos']['id_usuario'];
                        $id_libro = $_GET['libro'];
                        if ($_REQUEST['votacion'] < 0 || $_REQUEST['votacion'] > 10) {
                            echo "<h3 class='error'>LA VOTACIÓN TIENE QUE ESTAR ENTRE 0 Y 10</h3>";
                        } else {
                            if (isset($_REQUEST['votacion'])) {
                                $votacion = $_REQUEST['votacion'];
                                $voto = $libro->addVoto($id_usuario, $id_libro, $votacion);
                                if ($voto) {
                                    echo "<h3 class='noerror'>VOTO REALIZADO</h3>";
                                } else {
                                    echo "<h3 class='error'>YA VOTASTE ESTE LIBRO</h3>";
                                }
                            } else {
                                echo "<h3 class='error'>EL VOTO NO SE HA PODIDO REALIZAR</h3>";
                            }
                        }
                    } else {
                        echo "<h3 class='error'>DEBES ESTAR REGISTRADO PARA PODER VOTAR</h3>" . "<p clarr='error'>Anímate y <a href='../FormularioRegistro/' title='Regístrate'>CONVIÉRTETE</a> en un devorador de libros o <a href='../FormularioInicioSesion/' title='Inicia sesión'>INICIA SESIÓN</a></p>";
                    }
                }
                ?>
                </div>
			</div>
		</div>
		<div class="form-bottom">
			<form action="#" method="POST" class="login-form">
				<div class="form-group">
					<label><span>* </span>Votación sobre 10</label> <select
						name="votacion">
						<option value="0" selected>0</option>
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

				<div class="botones">
					<button type="submit" name="votar" class='btn'>Votar</button>
            <?php
            $tipo_usuario = $_SESSION['datos']['tipo_usuario'];
            $titulo = $libro->nombreLibro($_GET['libro']);
            $myvar = str_replace(" ", "-", $titulo);
            switch ($tipo_usuario) {
                case 1:
                    $destino = "../Libro/" . $myvar;
                    break;
                case 2:
                    $destino = "../Libro/" . $myvar;
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