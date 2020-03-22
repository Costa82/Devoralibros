<!--
- Formulario de edición de noticia.
- @author Miguel Costa.
-
-->
<?php
require_once '../inc/funciones.php';
sesion();
require_once '../inc/validaciones.inc.php';
include_once ("../clases/Noticia.php");
$noticia = new Noticia();
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type"
	content="application/xhtml+xml; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Modifica la Noticia</title>
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
						<h2>Modifica la noticia</h2>
						<p>
							<span>*</span> Campos obligatorios.
						</p>
					</div>
                <?php
                if (isset($_REQUEST['modificar'])) {
                    $noticia = new Noticia();
                    if (isset($_REQUEST['titulo']) and isset($_REQUEST['descripcion']) and isset($_REQUEST['fuente'])) {
                        $titulo = $_REQUEST['titulo'];
                        $descripcion = $_REQUEST['descripcion'];
                        if ($_REQUEST['fuente'] == "") {
                            $fuente = "Noticia de Devoralibros";
                        } else {
                            $fuente = $_REQUEST['fuente'];
                        }
                        if ($_REQUEST['urlExtra'] != "") {
                            $urlExtra = $_REQUEST['urlExtra'];
                        }
                        $id_usuario = $_SESSION['datos']['id_usuario'];
                        $id_noticia = $_GET['noticia'];
                        $img_noticia = $_FILES['img_noticia'];
                        if ($_FILES['img_noticia']['size'] == 0) {
                            // no cambiar la imagen
                            $img_noticia = $noticia->get_imagen($id_noticia);
                        } else {
                            $img_noticia = $_FILES['img_noticia'];
                        }
                        if (! $noticia->modificarNoticia($id_noticia, $titulo, $descripcion, $urlExtra, $fuente)) {
                            echo "<h3 class='noerror'>Noticia actualizada</h3>";
                            if ($_FILES['img_noticia']['size'] != 0) {
                                $noticia->modificarImgNoticia($titulo, $img_noticia, $id_noticia);
                            }
                        } else {
                            echo "<h3 class='error'>NO SE HA PODIDO ACTUALIZAR LA NOTICIA</h3>";
                        }
                    } else {
                        echo "<h3 class='error'>NO SE HA PODIDO ACTUALIZAR LA NOTICIA</h3>";
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
                    $id_noticia = $_GET['noticia'];
                    $titulo = $noticia->nombreNoticia($id_noticia);
                    $descripcion = $noticia->get_descripcion($id_noticia);
                    $url = $noticia->get_url($id_noticia);
                    $fuente = $noticia->get_fuente($id_noticia);
                    $img_noticia = $noticia->get_imagen($id_noticia);
                    ?>
                     
                     <div class="form-group">
						<label><span>* </span>Título</label> <input type="text"
							name="titulo" size="25" value="<?php echo $titulo; ?>"
							required="required" />
					</div>
					<div class="form-group">
						<label><span>* </span>Descripción</label>
						<textarea name="descripcion" rows="10" cols="40"
							required="required"><?php echo strip_tags($descripcion); ?></textarea>
					</div>
					<div class="form-group">
						<label>Url</label> <input type="url" name="urlExtra" size="500"
							value="<?php echo $url; ?>" />
					</div>
					<div class="form-group">
						<label>Fuente de la noticia</label> <input type="text"
							name="fuente" size="500" value="<?php echo $fuente; ?>" />
					</div>
					<div class="form-group">
						<label>Cambia la imagen de la noticia: <img
							src="../img_noticias/<?php echo $img_noticia; ?>" width="100px" /></label>
						<input type="file" name="img_noticia"><input type="hidden"
							name="lim_tamano" value="12000000" />
					</div>
					<div class="botones">
						<button type="submit" name="modificar" class='btn'>Modificar datos</button>
						<button type="button" onclick=" location.href='../Noticias/' "
							class="btn">Volver</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>

