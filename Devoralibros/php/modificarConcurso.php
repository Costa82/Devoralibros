<!--
- Proyecto Final DAW IES Galileo 2017
-
- Formulario de edición de concurso.
-
- @project  2ºDAW
- @author   Miguel Costa.
-
-->
<?php
    require_once '../inc/funciones.php';
    sesion();
    require_once '../inc/validaciones.inc.php';
    include_once("../clases/Concurso.php");
    $concurso=new Concurso();
?>
<!DOCTYPE html>
<html>
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Modifica el Concurso</title>
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
                <div class="derecha">
                	<a href='../Inicio' title='Inicio'><img src='../img/DEVORALIBROS_8_72ppi.png' alt='Devoralibros'/></a>
                </div>
                <div>
                  <h2>Modifica el concurso</h2>
                  <p><span>*</span> Campos obligatorios.</p>
                </div>
                <?php
                           if(isset($_REQUEST['modificar'])){
                              $concurso=new Concurso();
                              if(isset($_REQUEST['nombre']) AND isset($_REQUEST['descripcion'])){
                                $nombre=$_REQUEST['nombre'];
                                $descripcion=$_REQUEST['descripcion'];                                
                                $id_usuario=$_SESSION['datos']['id_usuario'];
                                $id_concurso=$_GET['concurso'];
                                $img_concurso=$_FILES['img_concurso'];
                                if($_FILES['img_concurso']['size']==0){
                                    //no cambiar la imagen
                                    $img_concurso=$concurso->get_imagen($id_concurso);
                                }else{
                                    $img_concurso=$_FILES['img_concurso'];
                                }
                                if(!$concurso->modificarConcurso($id_concurso,$nombre,$descripcion)){
                                    echo "<h3 class='noerror'>Concurso actualizado</h3>";
                                    if($_FILES['img_concurso']['size']!=0){
                                        $concurso->modificarImgConcurso($nombre,$img_concurso,$id_concurso);
                                    }
                                }else{
                                    echo "<h3 class='error'>NO SE HA PODIDO ACTUALIZAR EL CONCURSO</h3>";
                                }
                                                   
                                 
                          }else{
                            echo "<h3 class='error'>NO SE HA PODIDO ACTUALIZAR EL CONCURSO</h3>"; 
                          }
                        }
                      ?>
              </div>
            </div>
            <div class="form-bottom">
                <form enctype="multipart/form-data" action="#" method="POST" class="login-form">
             <?php
             $id_usuario=$_SESSION['datos']['id_usuario'];
             $id_concurso=$_GET['concurso'];
             $nombre=$concurso->nombreConcurso($id_concurso);
             $descripcion=$concurso->get_descripcion($id_concurso);             
             $img_concurso=$concurso->get_imagen($id_concurso);
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
                        <label>Cambia la imagen del concurso: <img src="../img_concursos/<?php echo $img_concurso; ?>" width="100px"/></label>
                    <input type="file" name="img_concurso"><input type="hidden" name="lim_tamano" value="12000000"/>
                </div>
               <div class="botones">
               <button type="submit" name="modificar" class='btn'>Modificar datos</button>          
               <button type="button" onclick=" location.href='../Concursos/' " class="btn">Volver</button>
          </div>
        </form>
      </div>
      </div>
    </div>
    </body>
</html>



