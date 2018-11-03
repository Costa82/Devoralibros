<!--
-
- Archivo index principal con toda la estructura de la página.
-
- @author   Miguel Costa.
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

$cadena = "El nick del usuario es: " . $nick;
$error = null;
$tipo = "INFO";
$separacion = "*";
$log->write_log($desdeDonde, $cadena, $error, $tipo, $separacion);

$id_usuario = $_SESSION['datos']['id_usuario'];

$cadena = "El id del usuario es: " . $id_usuario;
$error = null;
$tipo = "INFO";
$separacion = "*";
$log->write_log($desdeDonde, $cadena, $error, $tipo, $separacion);

$puntosMes = $usuario->getPuntosMensual($id_usuario);

$cadena = "Los puntos mensuales del usuario son: " . $puntosMes;
$error = null;
$tipo = "INFO";
$separacion = "*";
$log->write_log($desdeDonde, $cadena, $error, $tipo, $separacion);

$puntos = $usuario->getPuntos($id_usuario);

$cadena = "Los puntos totales del usuario son: " . $puntos;
$error = null;
$tipo = "INFO";
$separacion = "*";
$log->write_log($desdeDonde, $cadena, $error, $tipo, $separacion);

$foto = $_SESSION['datos']['foto'];

$cadena = "La foto del usuario es: " . $foto;
$error = null;
$tipo = "INFO";
$separacion = "*";
$log->write_log($desdeDonde, $cadena, $error, $tipo, $separacion);
?>
<!DOCTYPE html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Página perfil</title>
<link type="text/css" rel="stylesheet" href="../css/font-awesome.css" />
<script>
			var rutacss1 = "../css/main.css?" + Math.random();
			var rutacss2 = "../css/main_perfil.css?" + Math.random();
			var rutacss3 = "../css/main_libros.css?" + Math.random();
			document.write('<link rel="stylesheet" href="' + rutacss1 + '" type="text/css" media="screen" />'); 
			document.write('<link rel="stylesheet" href="' + rutacss2 + '" type="text/css" media="screen" />'); 
			document.write('<link rel="stylesheet" href="' + rutacss3 + '" type="text/css" media="screen" />'); 
		</script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah"
	rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Pathway+Gothic+One'
	rel='stylesheet' type='text/css' />
<script src="../jquery/jquery-3.1.1.min.js"></script>
<script src="../jquery/jquery_listaDeslizante.js"></script>
<script src="../jquery/jquery_busqueda_avanzada.js"></script>
<script src="../jquery/jquery_acordeon.js"></script>
<script src="../jquery/parallax.js"></script>
<script src="../jquery/jquery_scroll_menuNavegacion.js"></script>
<script>
            function confirmarBaja() {
                if(confirm('¿Estás seguro de darte de baja de Devoralibros?Te echaremos de menos...'))
                    return true;
                else
                    return false;
            }
		</script>
</head>
<body>
	<header>
		<nav>
				<?php
    
    try {
        include_once ("menuNav.php");
        
        $cadena = "Se cargó correctamente menuNav.php";
        $error = null;
        $tipo = "INFO";
        $separacion = "*";
        $log->write_log($desdeDonde, $cadena, $error, $tipo, $separacion);
    } catch (Exception $e) {
        
        $cadena = "No se pudo cargar menuNav.php." . $e;
        $error = - 1000;
        $tipo = "ERROR";
        $separacion = "*";
        $log->write_log_error_general($desdeDonde, $cadena, $error, $tipo, $separacion);
    }
    ?>		
			</nav>
		<div class="busqueda_avanzada">
			<div class="pestana">
				<p>Búsqueda avanzada</p>
			</div>
				<?php
    
    try {
        include_once ("formulario_avanzado.php");
        
        $cadena = "Se cargó correctamente formulario_avanzado.php";
        $error = null;
        $tipo = "INFO";
        $separacion = "*";
        $log->write_log($desdeDonde, $cadena, $error, $tipo, $separacion);
    } catch (Exception $e) {
        
        $cadena = "No se pudo cargar formulario_avanzado.php." . $e;
        $error = - 1000;
        $tipo = "ERROR";
        $separacion = "*";
        $log->write_log_error_general($desdeDonde, $cadena, $error, $tipo, $separacion);
    }
    ?>
			</div>
		<div class="devoralibros_mensual">                
				<?php
    
    try {
        include_once ("ganador_mes_index.php");
        
        $cadena = "Se cargó correctamente ganador_mes_index.php";
        $error = null;
        $tipo = "INFO";
        $separacion = "*";
        $log->write_log($desdeDonde, $cadena, $error, $tipo, $separacion);
    } catch (Exception $e) {
        
        $cadena = "No se pudo cargar ganador_mes_index.php." . $e;
        $error = - 1000;
        $tipo = "ERROR";
        $separacion = "*";
        $log->write_log_error_general($desdeDonde, $cadena, $error, $tipo, $separacion);
    }
    ?>
			</div>
		<div id='slider'>
				<?php
    
    try {
        include_once ("mostrar_status.php");
        
        $cadena = "Se cargó correctamente mostrar_status.php";
        $error = null;
        $tipo = "INFO";
        $separacion = "*";
        $log->write_log($desdeDonde, $cadena, $error, $tipo, $separacion);
    } catch (Exception $e) {
        
        $cadena = "No se pudo cargar mostrar_status.php." . $e;
        $error = - 1000;
        $tipo = "ERROR";
        $separacion = "*";
        $log->write_log_error_general($desdeDonde, $cadena, $error, $tipo, $separacion);
    }
    ?>
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
        
        $cadena = "El usuario con id: " . $id_usuario . " tiene mensajes sin leer.";
        $error = null;
        $tipo = "INFO";
        $separacion = "*";
        $log->write_log($desdeDonde, $cadena, $error, $tipo, $separacion);
        
        echo '<li class="animated flash"><a href="../Administrador/?pagina=4#mi-ancla" title="Mis mensajes">Mis mensajes</a></li>';
    } else {
        
        $cadena = "El usuario con id: " . $id_usuario . " no tiene mensajes sin leer.";
        $error = null;
        $tipo = "INFO";
        $separacion = "*";
        $log->write_log($desdeDonde, $cadena, $error, $tipo, $separacion);
        
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
				<li><a href="../EditarUsuarios/" title="Subir Librerías">Usuarios</a></li>
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
            
            try {
                include ("libros_subidos.php");
                
                $cadena = "Se cargó correctamente libros_subidos.php";
                $error = null;
                $tipo = "INFO";
                $separacion = "*";
                $log->write_log($desdeDonde, $cadena, $error, $tipo, $separacion);
            } catch (Exception $e) {
                
                $cadena = "No se pudo cargar libros_subidos.php." . $e;
                $error = - 1000;
                $tipo = "ERROR";
                $separacion = "*";
                $log->write_log_error_general($desdeDonde, $cadena, $error, $tipo, $separacion);
            }
            
            break;
        
        case 2:
            
            try {
                include ("mis_amigos.php");
                
                $cadena = "Se cargó correctamente mis_amigos.php";
                $error = null;
                $tipo = "INFO";
                $separacion = "*";
                $log->write_log($desdeDonde, $cadena, $error, $tipo, $separacion);
            } catch (Exception $e) {
                
                $cadena = "No se pudo cargar mis_amigos.php." . $e;
                $error = - 1000;
                $tipo = "ERROR";
                $separacion = "*";
                $log->write_log_error_general($desdeDonde, $cadena, $error, $tipo, $separacion);
            }
            
            break;
        
        case 3:
            
            try {
                include ("mis_listas.php");
                
                $cadena = "Se cargó correctamente mis_listas.php";
                $error = null;
                $tipo = "INFO";
                $separacion = "*";
                $log->write_log($desdeDonde, $cadena, $error, $tipo, $separacion);
            } catch (Exception $e) {
                
                $cadena = "No se pudo cargar mis_listas.php." . $e;
                $error = - 1000;
                $tipo = "ERROR";
                $separacion = "*";
                $log->write_log_error_general($desdeDonde, $cadena, $error, $tipo, $separacion);
            }
            
            break;
        
        case 4:
            
            try {
                include ("mis_mensajes.php");
                
                $cadena = "Se cargó correctamente mis_mensajes.php";
                $error = null;
                $tipo = "INFO";
                $separacion = "*";
                $log->write_log($desdeDonde, $cadena, $error, $tipo, $separacion);
            } catch (Exception $e) {
                
                $cadena = "No se pudo cargar mis_mensajes.php." . $e;
                $error = - 1000;
                $tipo = "ERROR";
                $separacion = "*";
                $log->write_log_error_general($desdeDonde, $cadena, $error, $tipo, $separacion);
            }
            
            break;
        
        case 5:
            
            try {
                include ("libros_comentados.php");
                
                $cadena = "Se cargó correctamente libros_comentados.php";
                $error = null;
                $tipo = "INFO";
                $separacion = "*";
                $log->write_log($desdeDonde, $cadena, $error, $tipo, $separacion);
            } catch (Exception $e) {
                
                $cadena = "No se pudo cargar libros_comentados.php." . $e;
                $error = - 1000;
                $tipo = "ERROR";
                $separacion = "*";
                $log->write_log_error_general($desdeDonde, $cadena, $error, $tipo, $separacion);
            }
            
            break;
        
        default:
            // incluimos la pagina que por defecto aparecera si no se seleccionan alguna de las otras
            try {
                include ("libros_subidos.php");
                
                $cadena = "Se cargó correctamente libros_subidos.php";
                $error = null;
                $tipo = "INFO";
                $separacion = "*";
                $log->write_log($desdeDonde, $cadena, $error, $tipo, $separacion);
            } catch (Exception $e) {
                
                $cadena = "No se pudo cargar libros_subidos.php." . $e;
                $error = - 1000;
                $tipo = "ERROR";
                $separacion = "*";
                $log->write_log_error_general($desdeDonde, $cadena, $error, $tipo, $separacion);
            }
    }
} else {
    
    try {
        include ("libros_subidos.php");
        
        $cadena = "Se cargó correctamente libros_subidos.php";
        $error = null;
        $tipo = "INFO";
        $separacion = "*";
        $log->write_log($desdeDonde, $cadena, $error, $tipo, $separacion);
    } catch (Exception $e) {
        
        $cadena = "No se pudo cargar libros_subidos.php." . $e;
        $error = - 1000;
        $tipo = "ERROR";
        $separacion = "*";
        $log->write_log_error_general($desdeDonde, $cadena, $error, $tipo, $separacion);
    }
}

if (isset($_REQUEST['num'])) {
    echo "<p style='color:red'>" . validacionExisteUsuario($_REQUEST['num']) . "</p>";
}

try {
    include_once ("infografia.php");
    
    $cadena = "Se cargó correctamente infografia.php";
    $error = null;
    $tipo = "INFO";
    $separacion = "*";
    $log->write_log($desdeDonde, $cadena, $error, $tipo, $separacion);
} catch (Exception $e) {
    
    $cadena = "No se pudo cargar infografia.php." . $e;
    $error = - 1000;
    $tipo = "ERROR";
    $separacion = "*";
    $log->write_log_error_general($desdeDonde, $cadena, $error, $tipo, $separacion);
}
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
			function confirmar()
			{
				if(confirm('¿Estás seguro de eliminarlo?'))
				return true;
				else
				return false;
			}
		</script>

	<footer>
			<?php

try {
    include_once ("footer.php");
    
    $cadena = "Se cargó correctamente footer.php";
    $error = null;
    $tipo = "INFO";
    $separacion = "*";
    $log->write_log($desdeDonde, $cadena, $error, $tipo, $separacion);
} catch (Exception $e) {
    
    $cadena = "No se pudo cargar footer.php." . $e;
    $error = - 1000;
    $tipo = "ERROR";
    $separacion = "*";
    $log->write_log_error_general($desdeDonde, $cadena, $error, $tipo, $separacion);
}
?>        
		</footer>

</body>
</html>

