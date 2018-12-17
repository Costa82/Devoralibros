<?php
require_once 'definesLibro.inc.php';
 
/**
 *  Parametro=Numero para mostrar los mensajes
 *  return: String
 *  Cogera los mensajes guardados en definesLibro.inc.php
 */
function validacionAddLibro($num){
    global $mensaje;
    if($num==-400){
        return $mensaje[LIBRO_EXIST];
    }elseif ($num==-401) {
          return $mensaje[LIBRO_ERR];  
    }elseif ($num==-402) {
        return $mensaje[LIBRO_ADD];  
    }elseif ($num==-403) {
        return $mensaje[VERERR_LIB];
    }
}
?>