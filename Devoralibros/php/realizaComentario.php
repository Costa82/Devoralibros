<!--
- Formulario de comentarios.
-
- @author   Miguel Costa (HTML5).
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
      <title>Realiza tu comentario</title>
      <!-- CSS -->
      <link rel="stylesheet" href="../css/main.css" />
      <link href='https://fonts.googleapis.com/css?family=Pathway+Gothic+One' rel='stylesheet' type='text/css' />
      <link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah" rel="stylesheet">
      <link rel="stylesheet" href="../css/form-elements.css">
      <link rel="stylesheet" href="../css/style.css">
      <script src="../jquery/jquery-3.1.1.min.js" ></script>
      <script src="../jquery/jquery_vaciarTextArea.js" ></script>
    </head>
    <body>
      <body>
        <div class="container">
          <div class="form-box">
            <div class="form-top">
              <div class="form-top-left">
                <h2>Realiza tu comentario <?php echo $_SESSION['datos']['nick'];?></h2>
                <p><span>*</span> Campos obligatorios.</p>
                <?php
                   if(isset($_REQUEST['comentar'])){
                      
                      $id_usuario=$_SESSION['datos']['id_usuario'];
                      $id_libro=$_GET['libro'];
                      if(isset($_REQUEST['comentario'])){
                               $comentario=$_REQUEST['comentario'];                       
                               $fecha_comentario=date("Y-m-d");
                               $com=$libro->addComentario($id_usuario,$id_libro,$comentario,$fecha_comentario);

                               if ($com){
                                  echo "<h3 class='noerror'>COMENTARIO REALIZADO</h3>";
                               }
                               else{
                                  echo "<h3 class='error'>YA HAS REALIZADO UN COMENTARIO PARA ESTE LIBRO</h3>";
                               }
                        }else{
                          echo "<h3 class='error'>EL COMENTARIO NO SE HA PODIDO REALIZAR</h3>"; 
                        }
                    
                }
              ?>
                </div>
              </div>
            </div>
            <div class="form-bottom">
            <form action="#" method="POST" class="login-form">
             
             <div class="form-group">
               <label><span>* </span>Comentario</label>
                 <textarea name="comentario" rows="10" cols="40" required="required">Escribe tu comentario...</textarea>
             </div>
             
            <div class="botones">
            <button type="submit" name="comentar" class='btn'>Realizar comentario</button>
            <?php
             $tipo_usuario=$_SESSION['datos']['tipo_usuario'];
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

