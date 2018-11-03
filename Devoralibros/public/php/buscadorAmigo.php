<?php
require_once '../clases/Connection.php';
include_once ('../clases/Usuario.php');
$bd= Connection::dameInstancia();
$c=$bd->dameConexion();
$usuario=new Usuario();    
// Variable de búsqueda
$consultaBusqueda = $_POST['valorBusqueda'];
$id1= $_POST['id1'];
$nickUsuario=$usuario::getNick($id1);
// Filtro anti-XSS
$caracteres_malos = array("<", ">", "\"", "'", "/", "<", ">", "'", "/");
$caracteres_buenos = array("&lt;", "&gt;", "&quot;", "&#x27;", "&#x2F;", "&#060;", "&#062;", "&#039;", "&#047;");
$consultaBusqueda = str_replace($caracteres_malos, $caracteres_buenos, $consultaBusqueda);
// Variable vacía (para evitar los E_NOTICE)
$mensaje = "";
// Comprueba si $consultaBusqueda está seteado
if (isset($consultaBusqueda)) {
    // Busca todos los usuarios que coincidan con la cadena y no sea él mismo, no sean amigos y no se haya enviado ya la solicitud
    $sql= "SELECT nick FROM usuarios WHERE nick LIKE '%$consultaBusqueda%'";
        if($c->real_query($sql)){
            if($resul=$c->store_result()){
                if($resul->num_rows>0){
                    echo '<ul>';
                    while($mostrar=$resul->fetch_assoc()){
                        $nick=$mostrar["nick"];
                        $id2=Usuario::getIdusuario($nick);
                        $amigos= Usuario::sonAmigos($id1,$id2);
                        $solicitud= Usuario::solicitudEnviada($id1,$id2);
                        if (!$amigos&&$nick!=$nickUsuario&&!$solicitud){
                            echo "<li><a href='../php/buscadorAmigo_header.php?id1=".$id1."&id2=".$id2."'><i class='fa fa-plus' aria-hidden='true' title='enviar solicitud de amistad'></i></i>
                                </a>".$nick."</li>";   
                        }
                    }
                    $resul->free_result();
                     }else{
                    $resul->free_result();
                    echo '</ul>';
                    }
                }
         }else{
                 echo $c->errno." -> ".$c->error;
         }
};