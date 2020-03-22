<?php
// Validación del registro del concurso
define("CONC_EXIST",-400);  //El concurso ya existe
define("CONC_ERR",-401);  //No se pudo subir correctamente el concurso
define("CONC_ADD",-402);  //Concurso subido con éxito  

$mensaje[CONC_EXIST]="El concurso ya existe";
$mensaje[CONC_ERR]="No se pudo subir correctamente el concurso";
$mensaje[CONC_ADD]="Concurso subido con éxito";
?>

