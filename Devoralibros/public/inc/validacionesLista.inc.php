<?php
require_once 'definesLista.inc.php';
 
/**
 *  Parametro=Numero para mostrar los mensajes
 *  return: String
 *  Cogera los mensajes guardados en definesLista.inc.php
 */
function validacionAddLista($num){
    global $mensaje;
    if($num==-400){
        return $mensaje[LIST_EXIST];
    }elseif ($num==-401) {
        return $mensaje[LIST_ERR];  
    }elseif ($num==-402) {
        return $mensaje[LIST_ADD];  
    }
}
?>

