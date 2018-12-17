<?php
require_once 'definesLibreria.inc.php';
 
/**
 *  Parametro=Numero para mostrar los mensajes
 *  return: String
 *  Cogera los mensajes guardados en definesLibreria.inc.php
 */
function validacionAddLibreria($num){
    global $mensaje;
    if($num==-400){
        return $mensaje[LIBRE_EXIST];
    }elseif ($num==-401) {
          return $mensaje[LIBRE_ERR];  
    }elseif ($num==-402) {
        return $mensaje[LIBRE_ADD];  
    }
}
?>

