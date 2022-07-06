<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//if($stock > 0){
//  echo "hay stock";
//} else{
//    echo"No hay stock";
//}
?>





<?php
date_default_timezone_set("America/Argentina/Cordoba");

$nombre = "Yolanda Mafalda Camara";
$edad = 53;
$aPeliculas = array("Volver al Futuro","Minions" ,"Top Gun");


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ficha personal</title>
    <link href=" https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">"
</head>

<body>
    <main class="container">
        <div class="row">
            <div class="col-12 text center py-5">
                <h1>Ficha Personal</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table Class="table table-hover border">
                    <tr>
                        <th>Fecha:</th>
                        <td><?php echo date("d/m/y"); ?></td>
                    </tr>
                    <tr>
                        <th>Nombre y apellido:</th>
                        <td><?php echo $nombre; ?></td>

                    </tr>
                    <tr>
                        <th>Edad:</th>
                        <td><?php echo $edad; ?></td>

                    </tr>
                    </tr>

                    <th>Peliculas favoritas</th>
                    <td><?php echo $aPeliculas[0]; ?><br>
                        <?php echo $aPeliculas[1]; ?><br>
                        <?php echo $aPeliculas[2]; ?>
                    </td>
                    </tr>
                </table>
            </div>
        </div>
    </main>
</body>

</html>