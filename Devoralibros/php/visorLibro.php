<!--
- Visor de los libros.
- @author Miguel Costa.
-
-->

<?php
require_once '../inc/funciones.php';
sesion();
require_once '../inc/validaciones.inc.php';
include_once ("../clases/Libro.php");
include_once ("../clases/Lista.php");
include_once ('../clases/Usuario.php');
$usuario = new Usuario();

if (isset($_SESSION['datos'])) {
    $nick = $_SESSION['datos']['nick'];
    $id_usuario = $_SESSION['datos']['id_usuario'];
    $foto = $usuario->getFoto($id_usuario);
}

$libro = new Libro();

if (! isset($_GET['titulo'])) {
    header("Location:../index.php");
}

$titulo = str_replace("-", " ", $_GET['titulo']);
$idlibro = $libro->get_id($titulo);
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $libro->nombreLibro($idlibro) ;?></title>
<link type="text/css" rel="stylesheet" href="../css/font-awesome.css" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah"
	rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Pathway+Gothic+One'
	rel='stylesheet' type='text/css' />
<script src="../jquery/jquery-3.1.1.min.js"></script>

<!-- Metemos un aleatorio para el css y el jss -->
<script>
    var rutacss1 = "../css/main.css?" + Math.random();
    var rutacss2 = "../css/main_libros.css?" + Math.random();
    var rutacss3 = "../css/main_perfil.css?" + Math.random();
    var rutajs1 = "../jquery/jquery_menuMoviles_desplegable.js?" + Math.random();
    var rutajs2 = "../jquery/jquery_listaDeslizante.js?" + Math.random();
    var rutajs3 = "../jquery/jquery_scroll_menuNavegacion.js?" + Math.random();
    var rutajs4 = "../jquery/jquery_busqueda_avanzada.js?" + Math.random();
    var rutajs5 = "../jquery/jquery_boton_comprar.js?" + Math.random();
    var script = "script";
    
    document.write('<link rel="stylesheet" href="' + rutacss1 + '" type="text/css" media="screen" />'); 
    document.write('<link rel="stylesheet" href="' + rutacss2 + '" type="text/css" media="screen" />'); 
    document.write('<link rel="stylesheet" href="' + rutacss3 + '" type="text/css" media="screen" />');
    document.write('<script src="' + rutajs1 + '"></' + script + '>');
    document.write('<script src="' + rutajs2 + '"></' + script + '>');
    document.write('<script src="' + rutajs3 + '"></' + script + '>');
    document.write('<script src="' + rutajs4 + '"></' + script + '>');
    document.write('<script src="' + rutajs5 + '"></' + script + '>');
</script>

</head>
<body>
	<header>
		<nav>
              <?php include_once("menuNavVisores.php");?>		
      </nav>
		<div class="busqueda_avanzada">
			<div class="pestana">
				<p>Búsqueda avanzada</p>
			</div>
          <?php include_once("formulario_avanzado.php");?>
      </div>
		<div class="devoralibros_mensual">               
          <?php include_once("ganador_mes_index.php");?>
      </div>
	</header>

	<center>
		<script async
			src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js">
        <!-- Adaptable -->
        <ins class="adsbygoogle"
           style="display:block"
           data-ad-client="ca-pub-6841941891904085"
           data-ad-slot="5370628212"
           data-ad-format="auto"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
      </script>
	</center>
	
	<?php

// TODO
// ******************************************************************************************************************
// Hay que arreglar esto, los libros no tienen id consecutivo y si no lo encuentra vuelve a la pantalla inicial
// ******************************************************************************************************************

// Mostramos el título del libro con las flechas para ir al libro siguiente o al anterior. Nos guiamos por el id del libro.
// Si nos pasamos por arriba volvemos al primero, si nos pasamos por abajo volvemos al último.

// $numLibros = $libro->numLibros();
// $idIzq = ($idlibro - 1);
// if ($idIzq == 0) {
// $idIzq = $numLibros;
// }

// $idDcha = ($idlibro + 1);
// if ($idDcha > $numLibros) {
// $idDcha = 1;
// }

// $tituloIzq = $libro->nombreLibro($idIzq);
// $tituloDcha = $libro->nombreLibro($idDcha);

// $myvarIzq = str_replace(" ", "-", $tituloIzq);
// $myvarDcha = str_replace(" ", "-", $tituloDcha);

// echo "<a href='../Libro/" . $myvarIzq . "' title='libro anterior'><i class='izquierda fa fa-angle-left'></i></a>";
echo "<h1>" . $titulo . "</h1>";
// echo "<a href='../Libro/" . $myvarDcha . "' title='libro siguiente'><i class='derecha fa fa-angle-right'></i></a>";

// ******************************************************************************************************************
?>
	
    <div class='contenido'>
		<div class='imagen'>
			<img
				<?php echo "src='../img_libros/".$libro->get_imagen($idlibro)."' alt='".$libro->nombreLibro($idlibro)."'  title='".$libro->nombreLibro($idlibro)."'" ; ?>>
		</div>
      
    <?php
    $libro->mostrarLibro($idlibro);
    ?>
    
    <h2>Comentarios</h2>
    
    <?php
    $libro->mostrarComentarios($idlibro);
    
    $lista = new Lista();
    if (isset($_SESSION['id_usuario'])) {
        $idusuario = $_SESSION['datos']['id_usuario'];
        $idlibro = $libro->get_id($titulo);
        echo "<div class='botones botonComentar'>" . "<a href='../FormularioComentarLibro/?libro=" . $idlibro . "' class='boton separado' title='Comenta el libro'>¡Comenta!</a>" . "<a href='' class='boton separado botonLista' title='Añade a tus listas'>¡Añade a tus listas!</a>";
        if (isset($_GET['noerror'])) {
            $error = $_GET['noerror'];
            echo "<p class='error'>" . $error . "</p>";
        } elseif (isset($_GET['noerror'])) {
            $noerror = $_GET['noerror'];
            echo "<p class='noerror'>" . $noerror . "</p>";
        }
        echo "<div class='addLista'>";
        $lista->mostrarListasUsuario($idusuario, $idlibro);
        echo "</div></div>";
    } else {
        echo "<div class='botones botonComentar'><a href='../FormularioRegistro/' class='boton separado' title='Registrate'>Regístrate y comenta</a></div>";
    }
    
    $genero = $libro->get_genero($idlibro);
    $genero2 = $libro->get_genero2($idlibro);
    $autor = $libro->get_autor($idlibro);
    $libro->mostrarLibrosRelacionados($genero, $genero2, $autor, $idlibro);
    ?>
      
  </div>

	<a name="mi-ancla"></a>
    <?php include_once("infografia.php");?>
    <center>
		<script async
			src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- Adaptable -->
		<ins class="adsbygoogle" style="display: block"
			data-ad-client="ca-pub-6841941891904085" data-ad-slot="5370628212"
			data-ad-format="auto"></ins>
		<script>
      	(adsbygoogle = window.adsbygoogle || []).push({});
      </script>
	</center>

	<footer>
        <?php include_once("footer.php");?>        
    </footer>

</body>
</html>

