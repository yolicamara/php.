<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function concatenar ($cadena1, $cadena2){
    return"$cadena1 $cadena2";
}
$resultado = concatenar("El libro", "de la SElva");
echo $resultado;





?>