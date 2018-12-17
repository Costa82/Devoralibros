<!--
- Proyecto Fin de Ciclo DAW IES Galileo 2017
-
- Visor de las librerías.
-
- @project  2ºDAW
- @author   Miguel Costa.
-
-->
<?php
    require_once '../inc/funciones.php';
    sesion();
    require_once '../inc/validaciones.inc.php';
    include_once("../clases/Libreria.php");
	include_once ('../clases/Usuario.php');
    $usuario=new Usuario();
    $nick=$_SESSION['datos']['nick'];
    $id_usuario=$_SESSION['datos']['id_usuario'];
	$foto=$usuario->getFoto($id_usuario);
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Página de Curiosidades</title>  
    <link type="text/css" rel="stylesheet" href="../css/font-awesome.css" />
    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/main_perfil.css" />
    <link rel="stylesheet" href="../css/main_libros.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Pathway+Gothic+One' rel='stylesheet' type='text/css' />
    <script src="../jquery/jquery-3.1.1.min.js" ></script>
    <script src="../jquery/jquery-3.1.1.min.js" ></script>
    <script src="../jquery/jquery_menuMoviles_desplegable.js" ></script>
    <script src="../jquery/jquery_listaDeslizante.js" ></script>
    <script src="../jquery/jquery_busqueda_avanzada.js" ></script>
 	<script src="../jquery/jquery_scroll_menuNavegacion.js" ></script>
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
    <?php
        $libreria = new Libreria();
    ?>
    <h1>Curiosidades</h1>
    <?php $libreria->mostrarLibrerias();?>
    <?php include_once("infografia.php");?>
    <footer>
        <?php include_once("footer.php");?>        
    </footer>
</body>
</html>


