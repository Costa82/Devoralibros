<!--
-Formulario para editar usuarios.
-
- @author   Miguel Costa.
-
-->
<?php
    require_once '../inc/funciones.php';
    include_once("../clases/Usuario.php");
    sesion();
    //nos aseguramos que pertenece al tipo 2 de administradores
    if(isset($_SESSION['id_usuario']) AND (isset($_SESSION['datos']['tipo_usuario'])==2)){
        $nick=$_SESSION['datos']['nick'];
        $id_usuario=$_SESSION['datos']['id_usuario'];
    	$tipo_usuario=$_SESSION['datos']['tipo_usuario'];
    }
?>
<!DOCTYPE html>
<html>
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Edición de usuarios</title>
      <!-- CSS -->
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
      <link href='https://fonts.googleapis.com/css?family=Pathway+Gothic+One' rel='stylesheet' type='text/css' />
      <link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah" rel="stylesheet">
      <script src="../jquery/jquery-3.1.1.min.js" ></script>
      <script src="../jquery/jquery_vaciarTextArea.js" ></script>
      <script>
        function confirmar() {
            if(confirm('¿Estás seguro de eliminar este usuario?'))
                return true;
            else
                return false;
        }
      </script>
    </head>
    <body>
        <?php  
          require_once '../inc/definesLibreria.inc.php';
          require_once '../inc/validacionesLibreria.inc.php';
          require_once "../clases/Libreria.php";
          $usuario=new Usuario();
      	  $numUsuarios=$usuario->numUsuarios();
          $id_usuario=$_SESSION['datos']['id_usuario'];
        ?>
        <div class="container">
         <div class="form-box">
          <div class="form-top">
            <div class="form-top-left">
              <div class="derecha">
                	<a href='../Inicio' title='Inicio'><img src='../img/DEVORALIBROS_8_72ppi.png' alt='Devoralibros'/></a>
              </div>
              <div class="izquierda">
                <h2>Editar usuarios</h2>
                <p>Número de usuarios registrados: <?php echo $numUsuarios; ?></p>
                <div id='errores'>
                        <?php
                            if(isset($_REQUEST['err'])){
                                $error= $_REQUEST['err'];
                              	if($error == 'ERROR') {
                                	echo "<p>- No se ha podido eliminar el usuario.</p>";
                                } else {
                                  	echo "<p class='azul'>- El usuario se eliminó correctamente.</p>";
                                }                                                                                                
                            }
                        ?>
                    </div>
              </div>              
            </div>
          </div>
          <div class="form-bottom">
            <form  action="#" method="post" enctype="multipart/form-data" id="formSubirNoticia">
              <?php
                $usuario->mostrarUsuarios($id_usuario, $tipo_usuario);
              ?>
              <div class="botones">
                <?php
                 $tipo_usuario=$_SESSION['datos']['tipo_usuario'];
                 switch ($tipo_usuario){
                   case 1:
                       $destino="../Usuario/";
                   break;
                   case 2:
                       $destino="../Administrador/";
                   break;

                   default:
                       $destino="../Inicio";
                   break;
               }
                ?>
                <button type="button" onclick=" location.href='<?php echo $destino;?>' " class="btn">Volver</button>
              </div>
        </form>
        </div>
      </div>
    </div>
    </body>
</html>

