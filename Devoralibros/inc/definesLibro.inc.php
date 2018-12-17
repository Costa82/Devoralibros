<?php
// Validación del registro del libro
define("LIBRO_EXIST",-400);  //El libro ya existe
define("LIBRO_ERR",-401);  //No se pudo subir correctamente el libro
define("LIBRO_ADD",-402);  //Libro subido con éxito
define("VERERR_LIB",-403); //No hay ningún libro que mostrar    

$mensaje[LIBRO_EXIST]="El libro ya existe";
$mensaje[LIBRO_ERR]="No se pudo subir correctamente el libro";
$mensaje[LIBRO_ADD]="Libro subido con éxito";
$mensaje[VERERR_LIB]="No hay ningún libro que mostrar";
?>