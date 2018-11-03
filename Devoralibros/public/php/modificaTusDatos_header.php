<?php
require_once '../inc/funciones.php';
sesion();
include_once ('../clases/Usuario.php');
$usuario=new Usuario();
require_once '../inc/validaciones.inc.php';
require_once '../inc/defines.inc.php';
//Seguridad: existe el usuario
 if(isset($_SESSION['datos']['id_usuario'])){
     if(isset($_REQUEST['modificar'])){
        $errores=array();
        $num=-304; //"El usuario se ha modificado correctamente."-> '../inc/defines.inc.php'
        /*
         * Un usuario no puede modificar su NICK (es único y lo identifica)
         */
        $id_usuario=$_SESSION['datos']['id_usuario'];
        $nick=$_SESSION['datos']['nick'];
        /**
         * Si el usuario cambia el nombre ó el apellido, se comprueba si es válido,
         * y de ser así, se devuelve con la primera letra en mayúsculas.
         * Es válido para nombres (ó apellidos) simples ó compuestos
         */
       if(isset($_REQUEST['nombre'])){
           if(esNombreValido($_REQUEST['nombre'])){
               $nombre= ponerLetraEnMayuscula($_REQUEST['nombre']);//-> '../inc/validaciones.inc.php'
           }else{
               $num=-207;
               $errores[]=$num;
           }
            
       }else{
            $nombre=$_SESSION['datos']['nombre'];
       }
        if(!empty($_REQUEST['apellidos'])){
            if(esNombreValido($_REQUEST['apellidos'])){
            	$apellidos= ponerLetraEnMayuscula($_REQUEST['apellidos']);//-> '../inc/validaciones.inc.php'
            }else{
               $num=-208;
               $errores[]=$num;
            }
       }else{
            if($_REQUEST['apellidos']==""){
                $apellidos=NULL;
            }else {
                $apellidos=$_SESSION['datos']['apellidos'];
            }
       }
       if(isset($_REQUEST['mail'])){
           if(esMailValido($_REQUEST['mail'])){
               if($_REQUEST['mail']!=$_SESSION['datos']['mail']){
               if($usuario->esmailRepetido($_REQUEST['mail'])){
                   $num=-204;
                   $errores[]=$num;
               }else{
                   $mail=$_REQUEST['mail'];
               }
               }else{
                   $mail=$_SESSION['datos']['mail'];
               }
           }else{
               $num=-209;
               $errores[]=$num;
           }
       }else{
           $mail=$_SESSION['datos']['mail'];
       }    
       $archivo_foto=$_FILES['foto'];
       if($_FILES['foto']['size']==0){
            //no cambiar la imagen
            $archivo_foto=$usuario->getFoto($id_usuario);
       }else{
            $archivo_foto=$_FILES['foto'];
       }
       if(!empty($_REQUEST['libro_favorito'])){
            if(!tieneCaracteresEspeciales($_REQUEST['libro_favorito'])) {
              $libro_favorito= ponerLetraEnMayuscula($_REQUEST['libro_favorito']);//-> '../inc/validaciones.inc.php' 
            } else {
              $num=-217;
              $errores[]=$num;
            }
       }else{
            if($_REQUEST['libro_favorito']==""){
                $libro_favorito=NULL;
            }else {
                $libro_favorito=$_SESSION['datos']['libro_favorito'];
            }
       }       
       if(!empty($_REQUEST['libro_odiado'])){
            if(!tieneCaracteresEspeciales($_REQUEST['libro_odiado'])) {
              $libro_odiado= ponerLetraEnMayuscula($_REQUEST['libro_odiado']);//-> '../inc/validaciones.inc.php' 
            } else {
              $num=-217;
              $errores[]=$num;
            }
       }else{
            if($_REQUEST['libro_odiado']==""){
                $libro_odiado=NULL;
            }else {
                $libro_odiado=$_SESSION['datos']['libro_odiado'];
            }
       }     
       if(!empty($_REQUEST['autor_favorito'])){
            if(esNombreValido($_REQUEST['autor_favorito'])){
            $autor_favorito= ponerLetraEnMayuscula($_REQUEST['autor_favorito']);//-> '../inc/validaciones.inc.php'
            }else{
               $num=-214;
               $errores[]=$num;
            }
       }else{
            if($_REQUEST['autor_favorito']==""){
                $autor_favorito=NULL;
            }else {
                $autor_favorito=$_SESSION['datos']['autor_favorito'];
            }
       }       
       if(!empty($_REQUEST['genero_favorito'])){
            if(esNombreValido($_REQUEST['genero_favorito'])){
            $genero_favorito= ponerLetraEnMayuscula($_REQUEST['genero_favorito']);//-> '../inc/validaciones.inc.php'
            }else{
               $num=-215;
               $errores[]=$num;
            }
       }else{
            if($_REQUEST['genero_favorito']==""){
                $genero_favorito=NULL;
            }else {
                $genero_favorito=$_SESSION['datos']['genero_favorito'];
            }
       }
       if(!empty($_REQUEST['passNueva']) && !empty($_REQUEST['passRep'])){
           //4 y 8 caracteres, al menos un dígito, al menos una minúscula y al menos una mayúscula
          if(esContraseña($_REQUEST['passNueva'])){//-> '../inc/validaciones.inc.php'
            if(($_REQUEST['passNueva']) ==($_REQUEST['passRep'])){
                 $passNueva=$_REQUEST['passNueva'];
                 $pass=MD5($passNueva);
            }else{
                $num=-210;
                $errores[]=$num;
            }
           }else{
               $num=-305;
               $errores[]=$num;
           }
       }else{
            $pass=$_SESSION['datos']['pass'];
       }       
        // echo $num;
       if($num==-304){//Los datos de modificación son correctos
            $usuario->modificardatos($nombre,$apellidos,$mail,$pass,$libro_favorito,$libro_odiado,$autor_favorito,$genero_favorito,$id_usuario);
         	if($_FILES['foto']['size']!=0){
                 $usuario->modificarFoto($nick,$archivo_foto,$id_usuario);
            }
       //Actualizamos los datos, las sesiones
             $usuario=new Usuario();
             $_SESSION['datos']['nombre']= $nombre;
             $_SESSION['datos']['apellidos']=  $apellidos;
             $passNuevo=$usuario->getPassUsuario($id_usuario);
             $_SESSION['datos']['pass']=$passNuevo;
             $_SESSION['datos']['mail']=$mail;
         	 $_SESSION['datos']['foto']=$usuario->getFoto($id_usuario);
             $_SESSION['datos']['libro_favorito']=$libro_favorito;
             $_SESSION['datos']['libro_odiado']=$libro_odiado;
             $_SESSION['datos']['autor_favorito']=$autor_favorito;
             $_SESSION['datos']['genero_favorito']=$genero_favorito;
             //$mensaje=  validacionExisteUsuario($num);//'../inc/validaciones.inc.php';
             //print_r($mensaje);
            $tipo_usuario=$_SESSION['datos']['tipo_usuario'];
           switch ($tipo_usuario){
                case 1:
                    $destino="../Usuario/";
                break;
                case 2:
                    $destino="../Administrador/";
                break;
                
                default:
                    $num=-201;
                    $destino="../FormularioEditarUsuario/?num=$num";
                break;
            }
        }else{
            $strError=  serialize($errores);
            $error=  urlencode($strError);
            $destino="../FormularioEditarUsuario/?error=$error";
        }
     }
if (!headers_sent()) {
  header('Location:'.$destino);
exit;
}
}
?>
