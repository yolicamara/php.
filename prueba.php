<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$aProductos = array();
$aProductos[] = array(
"nombre" => "Smart TV 55\" 4k UHD",
"marca" => "Hitachi",
"modelo" => "554KS20",
"stock" => 60,
"precio" => 58000,
);
$aProductos[] = array(
"nombre" => "Samsung Galaxy A30 Blanco",
"marca" => "Sansung",
"modelo" => "Galaxy A30",
"stock" => 0,
"precio" => 22000,
);
$aProductos[] = array(
"nombre" => "Aire Acondicionado Split Inverter frio/calor Surrey 200f",
"marca" => "Surrey",
"modelo" => "553AIQ1201E",
"stock" => 5,
"precio" => 45000,
);





?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href=" https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">"
</head>

<body>
    <main class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="py-5">Listado de Productos</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-hover border">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Stock</th>
                            <th>Precio</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($contador = 0; $contador < 3; $contador++) { ?>
                            <tr>
                                <td><?php echo $aProductos[$contador]["nombre"]; ?></td>
                                <td><?php echo $aProductos[$contador]["marca"]; ?></td>
                                <td><?php echo $aProductos[$contador]["modelo"]; ?></td>
                                <td><?php echo $aProductos[$contador]["stock"] > 10 ? "hay stock" : ($aProductos[$contador]["stock"] > 0 && $aProductos[$contador]["stock"] <= 10 ? "Poco stock" : "No hay Stock"); ?></td>
                                <td><?php echo $aProductos[$contador]["precio"]; ?></td>
                                <td><button class="btn btn-primary">Comprar</button></td>
                            </tr>
                        <?php

                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

</body>