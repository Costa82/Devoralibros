<!--
- Formulario de modificación de comentarios.
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
<title>Modifica tu comentario</title>
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
						<h2>Modifica el comentario</h2>
						<p>
							<span>*</span> Campos obligatorios.
						</p>
					</div>
                <?php
                if (isset($_REQUEST['modificar'])) {
                    $libro = new Libro();
                    if (isset($_REQUEST['comentario'])) {
                        
                        if ($_REQUEST['comentario'] == "") {
                            echo "<h3 class='error'>TIENES QUE ESCRIBIR UN COMENTARIO</h3>";
                        } else {
                            $comentario = $_REQUEST['comentario'];
                        }
                        $id_usuario = $_SESSION['datos']['id_usuario'];
                        $id_libro = $_GET['libro'];
                        $libro->modificarComentario($id_libro, $id_usuario, $comentario);
                        if ($libro) {
                            echo "<h3 class='noerror'>Comentario actualizado</h3>";
                        } else {
                            echo "<h3 class='error'>NO SE HA PODIDO ACTUALIZAR EL COMENTARIO</h3>";
                        }
                    } else {
                        echo "<h3 class='error'>NO SE HA PODIDO ACTUALIZAR EL COMENTARIO</h3>";
                    }
                }
                ?>
              </div>
			</div>
			<div class="form-bottom">
				<form action="#" method="POST" class="login-form">
             <?php
            $id_usuario = $_SESSION['datos']['id_usuario'];
            $comentario = libro::get_comentario($_GET['libro'], $id_usuario);
            ?>
             <div class="form-group">
						<label><span>* </span>Comentario</label>
						<textarea name="comentario" rows="10" cols="40"
							required="required"><?php echo strip_tags($comentario); ?></textarea>
					</div>
					<div class="botones">
						<button type="submit" name="modificar" class='btn'>Modificar
							comentario</button>
            <?php
            $tipo_usuario = $_SESSION['datos']['tipo_usuario'];
            switch ($tipo_usuario) {
                case 1:
                    $destino = "../Usuario/?pagina=1#mi-ancla";
                    break;
                case 2:
                    $destino = "../Administrador/?pagina=5#mi-ancla";
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

