<?php
require_once 'definesConcurso.inc.php';
 
/**
 *  Parametro=Numero para mostrar los mensajes
 *  return: String
 *  Cogera los mensajes guardados en definesConcurso.inc.php
 */
function validacionAddConcurso($num){
    global $mensaje;
    if($num==-400){
        return $mensaje[CONC_EXIST];
    }elseif ($num==-401) {
        return $mensaje[CONC_ERR];  
    }elseif ($num==-402) {
        return $mensaje[CONC_ADD];  
    }
}
?>

