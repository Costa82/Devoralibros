<!--
- Formulario de crear noticia.
- @author   Miguel Costa.
-
-->
<?php
    require_once '../inc/funciones.php';
    include_once("../clases/Noticia.php");
    sesion();
    //nos aseguramos que pertenece al tipo 2 de administradores
    if(isset($_SESSION['id_usuario']) AND (isset($_SESSION['datos']['tipo_usuario'])==2)){
        $nick=$_SESSION['datos']['nick'];
        $id_usuario=$_SESSION['datos']['id_usuario'];
    }
?>
<!DOCTYPE html>
<html>
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Formulario de Subida de Noticias</title>
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
    </head>
    <body>
        <?php  
        require_once '../inc/definesNoticia.inc.php';
        require_once '../inc/validacionesNoticia.inc.php';
        require_once "../clases/Noticia.php";
        $noticia=new Noticia();
        $id_usuario=$_SESSION['datos']['id_usuario'];
        ?>
        <div class="container">
         <div class="form-box">
          <div class="form-top">
            <div class="form-top-left">
              <div class="derecha">
                	<a href='../Inicio' title='Inicio'><img src='../img/DEVORALIBROS_8_72ppi.png' alt='Devoralibros'/></a>
                </div>
                <div>
                  <h2>Sube una Noticia</h2>
                  <p><span>*</span> Campos obligatorios.</p>
                </div>
              <?php
                   if(isset($_REQUEST['addNot'])){
                   if(isset($_REQUEST['titulo']) AND isset($_REQUEST['descripcion'])){
                        $img=$_FILES['img'];
                        $titulo=$_REQUEST['titulo'];
                        $descripcion = $_REQUEST['descripcion']; 
                     
                     	if ($_REQUEST['urlExtra']!="") {
                          	$urlExtra = $_REQUEST['urlExtra'];
                        }
                                             
                        $fecha_subida=date("Y-m-d");
                        if ($_REQUEST['fuente']==""){
                            $fuente="Noticia de Devoralibros";
                        }else{
                            $fuente=$_REQUEST['fuente'];
                        }
                        $num=$noticia->addNoticia($id_usuario,$titulo,$descripcion,$urlExtra,$fecha_subida,$img,$fuente);
                        $resultado= validacionAddNoticia($num);
                        if ($num==-402){
                            echo "<h3 class='noerror'>".$resultado."</h3>";
                        }
                        elseif ($num==-400){
                            echo "<h3 class='error'>".$resultado."</h3>";
                        }
                        elseif ($num==-401) {
                            echo "<h3 class='error'>".$resultado."</h3>";
                        }
                  }else{
                    echo "<h3 class='error'>NO SE HA PODIDO SUBIR LA NOTICIA</h3>"; 
                  }
                }
              ?>
            </div>
          </div>
          <div class="form-bottom">
            <form  action="#" method="post" enctype="multipart/form-data" id="formSubirNoticia">
              <div class="form-group">
                <label><span>* </span>Título</label>
                  <input type="text" name="titulo" size="25" required="required"/>
              </div>
              <div class="form-group">
                <label><span>* </span>Descripción</label>
                  <textarea name="descripcion" rows="10" cols="40" required="required">Escribe la noticia...</textarea>
              </div>
              <div class="form-group">
                <label>Añade una url</label>
                  <input type="url" name="urlExtra" size="500">
              </div>
              <div class="form-group">
                <label>Fuente de la noticia</label>
                  <input type="url" name="fuente" size="500">
              </div>
              <div class="form-group">
                <label>Añade una imagen</label>
                  <input type="file" name="img"/><input type="hidden" name="lim_tamano" value="1000000"/>
              </div>

              <div class="botones">
                <button type="submit" name="addNot" class="btn">Aceptar</button>
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

