<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


//definicion
function print_f($variable)
{//no sabemos si es un array o un string
    if (is_array($variable)) {
        $archivo = fopen('datos.txt' , 'a+');

         //si es un array ,lo recorro y guardo el contenido en el archivp "datos.txt"
         fwrite($archivo, "Datos del array ==>\n");

         foreach ($variable as $item){
            fwrite($archivo, $item ."\n");
              }
         
         fclose($archivo);


    } else {
          //entonces es string, guardo el contenido en el archivo "datos.txt"
          $contenido = "Datos de la variable ==>\n" . $variable;
           file_put_contents("datos.txt", $variable);
        }
  echo "archivo generado.";
}

//uso
$aNotas = array(8,5,7,9,10);//crea un array
$msg = "Este es un mensaje!";//crea un string
print_f($aNotas);





?>