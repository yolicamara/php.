<?php
include_once "config.php";
include_once "entidades/tipoproducto.php";
$pg = "Listado de tipo de productos";

$tipoproducto = new TipoProducto();
$aTipoProductos = $tipoproducto->obtenerTodos();

include_once("header.php");
?>
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Listado de tipo de productos</h1>
    <div class="row">
        <div class="col-12 mb-3">
            <a href="tipoproducto-formulario.php" class="btn btn-primary mr-2">Nuevo</a>
        </div>
    </div>


    <table class="table table-hover border">
        <tr>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>

        <?php foreach ($aTipoProductos as $tipoProducto) : ?>

            <tr>
                <td> <?php echo $tipoProducto->nombre; ?></td>
                <td>
                    <a href="tipoproducto-formulario.php?id<?php echo $tipoproducto->idtipoproducto; ?>"><i class="fas fa-seach"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php include_once("footer.php"); ?>