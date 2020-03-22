<!--
- Visor de un amigo.
- @author Miguel Costa.
-
-->
<?php
require_once '../inc/funciones.php';
require_once '../inc/validaciones.inc.php';
require_once '../clases/Connection.php';
include_once ('../clases/Usuario.php');
include_once ('../clases/Lista.php');
$nickAmigo = $_REQUEST['nickAmigo'];
$tipo_usuario = $_REQUEST['tipo_usuario'];
$id1 = $_REQUEST['id1'];
if (isset($_REQUEST['id_mensaje'])) {
    $id_mensaje = $_REQUEST['id_mensaje'];
}
$usuario = new Usuario();
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
<title>Ver amigo</title>
<!-- CSS -->
<link type="text/css" rel="stylesheet" href="../css/font-awesome.css" />
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
    var rutacss4 = "../css/style.css?" + Math.random();
    var rutacss5 = "../css/form-elements.css?" + Math.random();
    var rutajs1 = "../jquery/jquery_acordeon.js?" + Math.random();
    var rutajs2 = "../jquery/jquery_vaciarTextArea.js?" + Math.random();
    var rutajs3 = "../jquery/jquery_scroll_menuNavegacion.js?" + Math.random();
    var script = "script";
    
    document.write('<link rel="stylesheet" href="' + rutacss1 + '" type="text/css" media="screen" />'); 
    document.write('<link rel="stylesheet" href="' + rutacss2 + '" type="text/css" media="screen" />'); 
    document.write('<link rel="stylesheet" href="' + rutacss3 + '" type="text/css" media="screen" />');
    document.write('<link rel="stylesheet" href="' + rutacss4 + '" type="text/css" media="screen" />'); 
    document.write('<link rel="stylesheet" href="' + rutacss5 + '" type="text/css" media="screen" />');
    document.write('<script src="' + rutajs1 + '"></' + script + '>');
    document.write('<script src="' + rutajs2 + '"></' + script + '>');
    document.write('<script src="' + rutajs3 + '"></' + script + '>');
</script>

</head>
<body>
	<div class='contenedorAmigo'>
        <?php
        if (isset($id_mensaje)) {
            $bd1 = Connection::dameInstancia();
            $c1 = $bd1->dameConexion();
            $sql1 = "UPDATE usuarios_mensajes SET leido = 2 WHERE id_mensaje = ?";
            $sentencia1 = $c1->prepare($sql1);
            $sentencia1->bind_param("i", $id_mensaje);
            $sentencia1->execute();
        }
        $bd = Connection::dameInstancia();
        $c = $bd->dameConexion();
        $sql = "SELECT nick FROM usuarios";
        $sentencia = $c->prepare($sql);
        $sentencia->execute();
        $sentencia->bind_result($nick);
        while ($campo = $sentencia->fetch()) {
            if (md5($nick) == $nickAmigo) {
                $nick_encontrado = $nick;
            }
        }
        $usuario->muestraUsuario($nick_encontrado);
        ?>        
        <h2>Libros Subidos</h2>
		<div class="librosComentados">
        <?php
        $usuario = new Usuario();
        $id = $usuario->getIdusuario($nick_encontrado);
        $sql = "SELECT id_libro,titulo,img_portada FROM libros WHERE id_usuario='" . $id . "'";
        if ($c->real_query($sql)) {
            if ($resul = $c->store_result()) {
                if ($resul->num_rows > 0) {
                    echo "<div class='contenido1'>";
                    while ($mostrar = $resul->fetch_assoc()) {
                        $myvar = str_replace(" ", "-", $mostrar["titulo"]);
                        echo "<div class='imagen3'>
                                     <a href='../Libro/" . $myvar . "'><img src='../img_libros/" . $mostrar['img_portada'] . "' alt='" . $mostrar["titulo"] . "'  title='" . $mostrar["titulo"] . "'/></a></div>";
                    }
                    $resul->free_result();
                    echo "</div>";
                } else {
                    $resul->free_result();
                    echo "<h4>Aún no ha comentado ningún libro</h4>";
                }
            }
        } else {
            echo $c->errno . " -> " . $c->error;
        }
        ?>
        </div>
		<h2>Listas de libros</h2>        
        <?php
        $lista->mostrarListasVisorAmigo($id);
        ?>
        <h2>Envía un mensaje</h2>
        <?php
        if (isset($_REQUEST['enviarMail'])) {
            $usuario = new Usuario();
            if (isset($_REQUEST['mensaje'])) {
                if ($_REQUEST['mensaje'] == '' || $_REQUEST['mensaje'] == 'Escribe un mensaje a tu amigo...') {
                    echo "<h3 class='error'>No has escrito ningún mensaje para enviar</h3>";
                } else {
                    $mensaje = $_REQUEST['mensaje'];
                    $usuario->enviarMail($id1, $id, $mensaje);
                    $usuario->enviarMensaje($id1, $id, $mensaje);
                    echo "<h3 class='noerror'>Mensaje enviado</h3>";
                }
            }
        }
        ?>
        <form action="#" method="POST" class="login-form">
			<textarea name="mensaje" rows="10" cols="40">Escribe un mensaje a tu amigo...</textarea>
			<div class="botones">            
            <?php
            switch ($tipo_usuario) {
                case 1:
                    $destino = "../Usuario/?pagina=2#mi-ancla";
                    break;
                case 2:
                    $destino = "../Administrador/?pagina=2#mi-ancla";
                    break;
                default:
                    $destino = "../Inicio";
                    break;
            }
            ?>
            <button type="submit" name="enviarMail" class="boton"
					title='Enviar mensaje'>Enviar mensaje</button>
				<button type="button"
					onclick=" location.href='<?php echo $destino;?>' " title='Volver'
					class="boton">Volver</button>
			</div>
		</form>
	</div>
</body>
</html>

