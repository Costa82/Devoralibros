<!--
- Formulario de edición de relatos.
- @author   Miguel Costa.
-
-->
<?php
    require_once '../inc/funciones.php';
    sesion();
    require_once '../inc/validaciones.inc.php';
    include_once("../clases/Relato.php");
    $relato=new Relato();
?>
<!DOCTYPE html>
<html>
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Modifica el Relato</title>
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
                  <h2>Modifica el relato</h2>
                  <p><span>*</span> Campos obligatorios.</p>
                </div>
                <?php
                   if(isset($_REQUEST['modificar'])){
                      $relato=new Relato();
                      if(isset($_REQUEST['titulo']) AND isset($_REQUEST['escritor']) AND isset($_REQUEST['relato'])){
                        $titulo=$_REQUEST['titulo'];
                        $escritor=$_REQUEST['escritor']; 
                        $rel=$_REQUEST['relato']; 
                        
                        if ($_REQUEST['urlExtra']!=""){
                            $urlExtra=$_REQUEST['urlExtra'];
                        } else {
                            $urlExtra=null;
                        }
                        
                        $id_usuario=$_SESSION['datos']['id_usuario'];
                        $id_relato=$_GET['relato'];
                        
                        if(!$relato->modificarRelato($id_relato, $titulo, $escritor, $rel, $urlExtra)){
                            echo "<h3 class='noerror'>Relato actualizado</h3>";
                        }else{
                            echo "<h3 class='error'>NO SE HA PODIDO ACTUALIZAR EL RELATO</h3>";
                        }


                  }else{
                    echo "<h3 class='error'>NO SE HA PODIDO ACTUALIZAR EL RELATO</h3>"; 
                  }
                }
              ?>
              </div>
            </div>
            <div class="form-bottom">
                <form enctype="multipart/form-data" action="#" method="POST" class="login-form">
                
                     <?php 
                        $id_usuario=$_SESSION['datos']['id_usuario'];
                        $id_relato=$_GET['relato'];
                        $titulo=$relato->nombreRelato($id_relato);
                        $escritor=$relato->get_escritor($id_relato);
                        $rel=$relato->get_relato($id_relato);
                        $url=$relato->get_url($id_relato);
                     ?>
                     
                     <div class="form-group">
                     <label><span>* </span>Título</label>
                         <input type="text" name="titulo" size="25" value="<?php echo $titulo; ?>" required="required"/>
                     </div>
                     <div class="form-group">
                       <label><span>* </span>Escritor</label>
                         <input type="text" name="escritor" size="100" value="<?php echo $escritor; ?>" required="required"/>
                     </div> 
                     <div class="form-group">
                       <label><span>* </span>Relato</label>
                         <textarea name="relato" rows="10" cols="40" required="required"><?php echo strip_tags($rel); ?></textarea>
                     </div>   
                     <div class="form-group">
                       <label>Url</label>
                         <input type="url" name="urlExtra" size="500" value="<?php echo $url; ?>"/>
                     </div> 
                       <div class="botones">
                       <button type="submit" name="modificar" class='btn'>Modificar datos</button>   
                       <button type="button" onclick=" location.href='../Relatos/<?php $myvar = str_replace(" ", "-", $titulo); echo $myvar; ?>' " class="btn">Volver</button>
                  </div>
                </form>
      </div>
      </div>
    </div>
    </body>
</html>

