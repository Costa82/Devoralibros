<!--
- Formulario de edición de listas de libros.
- @author Miguel Costa.
-
-->
<?php
require_once '../inc/funciones.php';
sesion();
require_once '../inc/validaciones.inc.php';
include_once ("../clases/Lista.php");
$lista = new Lista();
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type"
	content="application/xhtml+xml; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Modifica tu lista</title>
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
					<h2>Modifica tu lista</h2>
					<p>
						<span>*</span> Campos obligatorios.
					</p>
                <?php
                if (isset($_REQUEST['modificar'])) {
                    if (isset($_REQUEST['nombrelista']) and isset($_REQUEST['descripcion'])) {
                        $nombrelista = $_REQUEST['nombrelista'];
                        $descripcion = $_REQUEST['descripcion'];
                        
                        $id_usuario = $_SESSION['datos']['id_usuario'];
                        $id_lista = $_GET['idlista'];
                        
                        if (! $lista->modificarLista($id_lista, $nombrelista, $descripcion)) {
                            echo "<h3 class='noerror'>Lista actualizada</h3>";
                        } else {
                            echo "<h3 class='error'>NO SE HA PODIDO ACTUALIZAR LA LISTA</h3>";
                        }
                    } else {
                        echo "<h3 class='error'>NO SE HA PODIDO ACTUALIZAR LA LISTA</h3>";
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
            $id_lista = $_GET['idlista'];
            $nombrelista = $lista->nombreLista($id_lista);
            $descripcion = $lista->get_descripcion($id_lista);
            ?>
             <div class="form-group">
						<label><span>* </span>Nombre</label> <input type="text"
							name="nombrelista" size="25" value="<?php echo $nombrelista; ?>"
							required="required" />
					</div>
					<div class="form-group">
						<label><span>* </span>Descripcion</label>
						<textarea name="descripcion" rows="10" cols="40"
							required="required"><?php echo strip_tags($descripcion); ?></textarea>
					</div>


					<div class="botones">
						<button type="submit" name="modificar" class='btn'>Modificar datos</button>
            <?php
            $tipo_usuario = $_SESSION['datos']['tipo_usuario'];
            switch ($tipo_usuario) {
                case 1:
                    $destino = "../Usuario/?pagina=3#mi-ancla";
                    break;
                case 2:
                    $destino = "../Administrador/?pagina=3#mi-ancla";
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

