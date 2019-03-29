<?php

class Validaciones
{    
    
    public function validarTelefono($value)
    {
        $expresion = '/^((\+?34([ \t|\-])?)?[9|6|7]((\d{1}([ \t|\-])?[0-9]{3})|(\d{2}([ \t|\-])?[0-9]{2}))([ \t|\-])?[0-9]{2}([ \t|\-])?[0-9]{2})$/';
        
        if (preg_match($expresion, $value)) {
            return true;
        } else {
            return false;
        } 
    }
}

