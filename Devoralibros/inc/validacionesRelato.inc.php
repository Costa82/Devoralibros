<?php
require_once 'definesRelato.inc.php';
 
/**
 *  Parametro=Numero para mostrar los mensajes
 *  return: String
 *  Cogera los mensajes guardados en definesRelato.inc.php
 */
function validacionAddRelato($num){
    global $mensaje;
    if($num==-400){
        return $mensaje[REL_EXIST];
    }elseif ($num==-401) {
          return $mensaje[REL_ERR];  
    }elseif ($num==-402) {
        return $mensaje[REL_ADD];  
    }
}
?>

