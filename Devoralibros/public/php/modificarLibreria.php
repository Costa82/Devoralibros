<!--
- Proyecto Final DAW IES Galileo 2017
-
- Formulario de edición de librería.
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
    $libreria=new Libreria();
?>
<!DOCTYPE html>
<html>
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Modifica la Librería</title>
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
                <h2>Modifica la Librería</h2>
                <p><span>*</span> Campos obligatorios.</p>
                <?php
                           if(isset($_REQUEST['modificar'])){
                              $libreria=new Libreria();
                              if(isset($_REQUEST['nombre']) AND isset($_REQUEST['descripcion'])){
                                $nombre=$_REQUEST['nombre'];
                                $descripcion=$_REQUEST['descripcion'];                                
                                $id_usuario=$_SESSION['datos']['id_usuario'];
                                $id_libreria=$_GET['libreria'];
                                $img_libreria=$_FILES['img_libreria'];
                                if($_FILES['img_libreria']['size']==0){
                                    //no cambiar la imagen
                                    $img_libreria=$libreria->get_imagen($id_libreria);
                                }else{
                                    $img_libreria=$_FILES['img_libreria'];
                                }
                                if(!$libreria->modificarLibreria($id_libreria,$nombre,$descripcion)){
                                    echo "<h3 class='noerror'>Librería actualizada</h3>";
                                    if($_FILES['img_libreria']['size']!=0){
                                        $libreria->modificarImgLibreria($nombre,$img_libreria,$id_libreria);
                                    }
                                }else{
                                    echo "<h3 class='error'>NO SE HA PODIDO ACTUALIZAR LA LIBRERÍA</h3>";
                                }
                                                   
                                 
                          }else{
                            echo "<h3 class='error'>NO SE HA PODIDO ACTUALIZAR LA LIBRERÍA</h3>"; 
                          }
                        }
                      ?>
              </div>
            </div>
            <div class="form-bottom">
                <form enctype="multipart/form-data" action="#" method="POST" class="login-form">
             <?php
                $id_usuario=$_SESSION['datos']['id_usuario'];
                $id_libreria=$_GET['libreria'];
                $nombre=$libreria->nombreLibreria($id_libreria);
                $descripcion=$libreria->get_descripcion($id_libreria);             
                $img_libreria=$libreria->get_imagen($id_libreria);
             ?>
             <div class="form-group">
                        <label><span>* </span>Nombre</label>
                          <input type="text" name="nombre" size="25" value="<?php echo $nombre; ?>" required="required"/>
                      </div>
                      <div class="form-group">
                        <label><span>* </span>Descripción</label>
                          <textarea name="descripcion" rows="10" cols="40" required="required"><?php echo strip_tags($descripcion); ?></textarea>
                      </div>                      
                    <div class="form-group">
                        <label>Cambia la imagen de la librería: <img src="../img_librerias/<?php echo $img_libreria; ?>" width="100px"/></label>
                    <input type="file" name="img_libreria"><input type="hidden" name="lim_tamano" value="12000000"/>
                </div>
               <div class="botones">
               <button type="submit" name="modificar" class='btn'>Modificar datos</button>         
               <button type="button" onclick=" location.href='../Librerias/' " class="btn">Volver</button>
          </div>
        </form>
      </div>
      </div>
    </div>
    </body>
</html>
