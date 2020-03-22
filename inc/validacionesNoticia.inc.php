<?php
require_once 'definesNoticia.inc.php';
 
/**
 *  Parametro=Numero para mostrar los mensajes
 *  return: String
 *  Cogera los mensajes guardados en definesNoticia.inc.php
 */
function validacionAddNoticia($num){
    global $mensaje;
    if($num==-400){
        return $mensaje[NOT_EXIST];
    }elseif ($num==-401) {
          return $mensaje[NOT_ERR];  
    }elseif ($num==-402) {
        return $mensaje[NOT_ADD];  
    }
}
?>

