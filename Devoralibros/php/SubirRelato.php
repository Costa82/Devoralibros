<!--
- Formulario de subir relatos de escritores.
- @author Miguel Costa.
-
-->

<?php
require_once '../inc/funciones.php';
include_once ("../clases/Relato.php");

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
<title>Formulario de Subida de Relatos</title>
<!-- CSS -->
<link href='https://fonts.googleapis.com/css?family=Pathway+Gothic+One'
	rel='stylesheet' type='text/css' />
<link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah"
	rel="stylesheet">
<script src="../jquery/jquery-3.1.1.min.js"></script>

<!-- Metemos un aleatorio para el css y el jss -->
<script>
    var rutacss1 = "../css/font-awesome.css?" + Math.random();
    var rutacss2 = "../css/main.css?" + Math.random();
    var rutacss3 = "../css/form-elements.css?" + Math.random();
    var rutacss4 = "../css/style.css?" + Math.random();
    var rutajs1 = "../jquery/jquery_vaciarTextArea.js?" + Math.random();
    var script = "script";
    
    document.write('<link rel="stylesheet" href="' + rutacss1 + '" type="text/css" media="screen" />'); 
    document.write('<link rel="stylesheet" href="' + rutacss2 + '" type="text/css" media="screen" />'); 
    document.write('<link rel="stylesheet" href="' + rutacss3 + '" type="text/css" media="screen" />'); 
    document.write('<link rel="stylesheet" href="' + rutacss4 + '" type="text/css" media="screen" />'); 
    document.write('<script src="' + rutajs1 + '"></' + script + '>');
</script>

</head>
<body>
        <?php
        require_once '../inc/definesRelato.inc.php';
        require_once '../inc/validacionesRelato.inc.php';
        require_once "../clases/Relato.php";
        
        $relato = new Relato();
        $id_usuario = $_SESSION['datos']['id_usuario'];
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
						<h2>Sube un Relato</h2>
						<p>
							<span>*</span> Campos obligatorios.
						</p>
					</div>
					
            <?php
            if (isset($_REQUEST['addRelato'])) {
                
                if (isset($_REQUEST['titulo']) and isset($_REQUEST['escritor']) and isset($_REQUEST['relato'])) {
                    $titulo = $_REQUEST['titulo'];
                    $escritor = $_REQUEST['escritor'];
                    $relatoEscritor = $_REQUEST['relato'];
                    
                    if ($_REQUEST['urlExtra'] != "") {
                        $urlExtra = $_REQUEST['urlExtra'];
                    }
                    
                    $fecha_subida = date("Y-m-d");
                    $num = $relato->addRelato($id_usuario, $titulo, $escritor, $relatoEscritor, $urlExtra, $fecha_subida);
                    $resultado = validacionAddRelato($num);
                    if ($num == - 402) {
                        echo "<h3 class='noerror'>" . $resultado . "</h3>";
                    } elseif ($num == - 400) {
                        echo "<h3 class='error'>" . $resultado . "</h3>";
                    } elseif ($num == - 401) {
                        echo "<h3 class='error'>" . $resultado . "</h3>";
                    }
                } else {
                    echo "<h3 class='error'>NO SE HA PODIDO SUBIR EL RELATO</h3>";
                }
            }
            ?>
            </div>
			</div>
			<div class="form-bottom">
				<form action="#" method="post" enctype="multipart/form-data"
					id="formSubirNoticia">
					<div class="form-group">
						<label><span>* </span>Título del relato</label> <input type="text"
							name="titulo" size="25" required="required" />
					</div>
					<div class="form-group">
						<label><span>* </span>Escritor</label> <input type="text"
							name="escritor" size="100" required="required" />
					</div>
					<div class="form-group">
						<label><span>* </span>Relato</label>
						<textarea name="relato" rows="10" cols="40" required="required">Escribe el relato...</textarea>
					</div>
					<div class="form-group">
						<label>Añade una url</label> <input type="url" name="urlExtra"
							size="500">
					</div>

					<div class="botones">
						<button type="submit" name="addRelato" class="btn">Aceptar</button>
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