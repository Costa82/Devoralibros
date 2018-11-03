<!--
- Formulario de edición del resumen personal.
-
- @author   Miguel Costa.
-
-->
<?php
    require_once '../inc/funciones.php';
    sesion();
    require_once '../inc/validaciones.inc.php';
    include_once("../clases/Libro.php");
    $libro=new Libro();
?>
<!DOCTYPE html>
<html>
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Añade tu resumen personal</title>
      <!-- CSS -->
      <link rel="stylesheet" href="../css/main.css" />
      <link href='https://fonts.googleapis.com/css?family=Pathway+Gothic+One' rel='stylesheet' type='text/css' />
      <link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah" rel="stylesheet">
      <link rel="stylesheet" href="../css/form-elements.css">
      <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
      <body>
        <div class="container">
          <div class="form-box">
            <div class="form-top">
              <div class="form-top-left">
                <h2>Añade tu resumen <?php echo $_SESSION['datos']['nick'];?></h2>
                <p><span>*</span> Campos obligatorios.</p>
                <?php
                           if(isset($_REQUEST['modificar'])){
                              $libro=new Libro();
                              if(isset($_REQUEST['resumen'])){                                
                                $resumen=$_REQUEST['resumen'];
                                
                                $id_usuario=$_SESSION['datos']['id_usuario'];
                                $id_libro=$_GET['libro'];
                                
                                if(!$libro->modificarLibroResumen($id_libro,$id_usuario,$resumen)){
                                    echo "<h3 class='noerror'>Libro actualizado</h3>";
                                }else{
                                    echo "<h3 class='error'>NO SE HA PODIDO ACTUALIZAR EL LIBRO</h3>";
                                }                                              
                                 
                          }else{
                            echo "<h3 class='error'>NO SE HA PODIDO ACTUALIZAR EL LIBRO</h3>"; 
                          }
                        }
                      ?>
              </div>
            </div>
            <div class="form-bottom">
                <form enctype="multipart/form-data" action="#" method="POST" class="login-form">
             <?php
             $id_usuario=$_SESSION['datos']['id_usuario'];
             $tipo_usuario=$_SESSION['datos']['tipo_usuario'];
             $id_libro=$_GET['libro']; 
             ?>
             <div class="form-group">
                        
                      <div class="form-group">
                        <label><span>* </span>Resumen personal</label>
                        <textarea name="resumen" rows="10" cols="40" required="required"><?php echo strip_tags($resumen); ?></textarea>
                      </div>
                      
               <div class="botones">
               <button type="submit" name="modificar" class='btn'>Añadir resumen</button>
            <?php
             $titulo=$libro->nombreLibro($_GET['libro']);
			 $myvar = str_replace(" ", "-", $titulo);
             switch ($tipo_usuario){
               case 1:
                   $destino="../Libro/".$myvar;
               break;
               case 2:
                   $destino="../Libro/".$myvar;
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

	