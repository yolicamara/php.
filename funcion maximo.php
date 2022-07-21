<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


function maximo($aVector){
   $valorMaximo = 0;
    foreach($aVector as $valor){
         if($valorMaximo < $valor){
            $valorMaximo = $valor;
         }
    }
    return $valorMaximo;

}




$aNotas = array(8, 4, 5, 3, 9, 1);
$aSueldos = array(800.30, 400.87, 500.45, 300, 900.70, 100, 900, 1800);

echo "La nota maxima es:" .maximo($aNotas) . "<br>";
echo "El sueldo maximo es:" . maximo($aSueldos);