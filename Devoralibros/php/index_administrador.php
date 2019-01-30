<!--
- Archivo index_administrador con toda la estructura de la página.
- @author Miguel Costa.
-
-->
<?php
require_once '../inc/funciones.php';
require_once '../inc/validaciones.inc.php';
include_once ('../clases/Usuario.php');
include_once ('../clases/Log.php');

sesion();
$usuario = new Usuario();
$log = new Log();
$desdeDonde = "index_administrador.php";

$nick = $_SESSION['datos']['nick'];
$id_usuario = $_SESSION['datos']['id_usuario'];
$puntosMes = $usuario->getPuntosMensual($id_usuario);
$puntos = $usuario->getPuntos($id_usuario);
$foto = $_SESSION['datos']['foto'];

// Variable de sesion para saber en qué página estamos y podamos volver a ella
$_SESSION['pagina'] = "index_administrador";

?>

<!DOCTYPE html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Página perfil</title>
<link type="text/css" rel="stylesheet" href="../css/font-awesome.css" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah"
	rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Pathway+Gothic+One'
	rel='stylesheet' type='text/css' />
<script src="../jquery/jquery-3.1.1.min.js"></script>
<script>
       function confirmarBaja() {
           if(confirm('¿Estás seguro de darte de baja de Devoralibros?Te echaremos de menos...'))
               return true;
           else
               return false;
       }
</script>

<!-- Metemos un aleatorio para el css y el jss -->
<script>
    var rutacss1 = "../css/main.css?" + Math.random();
    var rutacss2 = "../css/main_libros.css?" + Math.random();
    var rutacss3 = "../css/main_perfil.css?" + Math.random();
    var rutajs1 = "../jquery/jquery_listaDeslizante.js?" + Math.random();
    var rutajs2 = "../jquery/jquery_busqueda_avanzada.js?" + Math.random();
    var rutajs3 = "../jquery/jquery_scroll_menuNavegacion.js?" + Math.random();
    var rutajs4 = "../jquery/jquery_acordeon.js?" + Math.random();
    var rutajs5 = "../jquery/parallax.js?" + Math.random();
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
			<?php include_once ("menuNav.php"); ?>		
		</nav>
		
		<div class="busqueda_avanzada">
		
			<div class="pestana">
				<p>Búsqueda avanzada</p>
			</div>
			
			<?php include_once ("formulario_avanzado.php"); ?>
			
		</div>
		
		<div class="devoralibros_mensual">
		                
			<?php include_once ("ganador_mes_index.php");  ?>
			
		</div>
		
		<div id='slider'>
		
			<?php include_once ("mostrar_status.php"); ?>
			
			<center>
				<input class="botonInvitacion" type="button"
					onclick="location.href='../FormularioEnviarInvitacion/';"
					value="Enviar Invitación" />
			</center>
			
		</div>
		
		<a name="mi-ancla"></a>
		<div class="navegacion">
		
			<ul id='navegacion_secundaria'>
				<li><a href="../Administrador/?pagina=1#mi-ancla"
					title="Reseñas subidas">Reseñas subidas</a></li>
				<li><a href="../Administrador/?pagina=5#mi-ancla"
					title="Libros comentados">Libros comentados</a></li>
				<li><a href="../Administrador/?pagina=2#mi-ancla" title="Mis amigos">Mis
						amigos</a></li>
				<li><a href="../Administrador/?pagina=3#mi-ancla" title="Mis listas">Mis
						listas</a></li>
				<?php
                    if ($usuario->mensajesSinLeer($id_usuario) === true) {
                        
                        echo '<li class="animated flash"><a href="../Administrador/?pagina=4#mi-ancla" title="Mis mensajes">Mis mensajes</a></li>';
                    } else {
                        
                        echo '<li><a href="../Administrador/?pagina=4#mi-ancla" title="Mis mensajes">Mis mensajes</a></li>';
                    }
                ?>					
			</ul>
			
			<ul id='navegacion_secundaria'>
				<li><a href="../FormularioSubirLibro/" title="Subir reseñas">Subir
						reseñas</a></li>
				<li><a href="../FormularioSubirNoticia/" title="Subir noticias">Subir
						noticias</a></li>
				<li><a href="../FormularioSubirRelato/" title="Subir relatos">Subir
						relatos</a></li>
				<!--li><a href="../FormularioSubirConcurso/" title="Crear concurso">Crear concurso</a></li-->
				<li><a href="../EditarUsuarios/" title="Usuarios">Usuarios</a></li>
				<li><a href="../FormularioEditarUsuario/" title="Editar usuario">Editar
						usuario</a></li>
				<li class="invitacion"><a href="../FormularioEnviarInvitacion/"
					title="Enviar Invitacion">Enviar Invitación</a></li>
			</ul>
			
		</div>
		
	</header>

	<?php
        if (isset($_GET['pagina'])) {
            
            $recibe_pagina = $_GET['pagina'];
            
            switch ($recibe_pagina) {
                
                case 1:
                    
                    include ("libros_subidos.php");
                    
                    // Variable de sesion para saber en qué página estamos y podamos volver a ella
                    $_SESSION['pagina'] = "index_administrador_libros_subidos";
                    
                    break;
                
                case 2:
                    
                    include ("mis_amigos.php");
                    break;
                
                case 3:
                    
                    include ("mis_listas.php");
                    break;
                
                case 4:
                    
                    include ("mis_mensajes.php");
                    break;
                
                case 5:
                    
                    include ("libros_comentados.php");
                    
                    // Variable de sesion para saber en qué página estamos y podamos volver a ella
                    $_SESSION['pagina'] = "index_administrador_libros_comentados";
                    
                    break;
                
                default:
                    // incluimos la pagina que por defecto aparecera si no se seleccionan alguna de las otras
                    include ("libros_subidos.php");
            }
            
        } else {
            
            include ("libros_subidos.php");
        }
        
        if (isset($_REQUEST['num'])) {
            echo "<p style='color:red'>" . validacionExisteUsuario($_REQUEST['num']) . "</p>";
        }
        
        include_once ("infografia.php");
    ?>
		
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

	<script>
    	function confirmar() {
    		if(confirm('¿Estás seguro de eliminarlo?'))
    		return true;
    		else
    		return false;
    	}
	</script>

	<footer>
		<?php include_once ("footer.php"); ?>        
	</footer>

</body>
</html>

