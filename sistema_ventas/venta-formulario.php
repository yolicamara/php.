<?php
include_once("config.php");
include_once "entidades/cliente.php";
include_once "entidades/producto.php";
include_once "entidades/venta.php";

date_default_timezone_set('America/argentina/Buenos_Aires');


$venta = new Venta();



if ($_POST) {
    if (isset($_POST["btnGuardar"])) {
        $venta->cargarFormulario($_REQUEST);




        if (isset($_GET["id"]) && $_GET["id"] > 0) {

            $venta->actualizar();
            $msg["texto"] = "Actualizado correctamente";
            $msg["codigo"] = "alert-success";
        } else {
            $venta->insertar();
            $msg["texto"] = "Insertado correctamente";
            $msg["codigo"] = "alert-success";
        }
    } else if (isset($_POST["btnBorrar"])) {
        $tipoProducto->cargarFormulario($_REQUEST);
        $tipoProducto->eliminar();
        header("Location: venta-listado.php");
    }
}
if (isset($_GET["id"]) && $_GET["id"] > 0) {
    $venta->cargarFormulario($_REQUEST);
    $venta->obtenerPorId();
}

$cliente = new Cliente();
$aClientes = $cliente->obtenerTodos();

$producto = new Producto();
$aProductos = $producto->obtenerTodos();



include_once("header.php");

?>


<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Venta</h1>

    <div class="row">
        <div class="col-12 mb-3">
            <a href="venta-listado.php" class="btn btn-primary mr-2">Listado</a>
            <a href="venta-formulario.php" class="btn btn-primary mr-2">Nuevo</a>
            <button type="submit" class="btn btn-success mr-2" id="btnGuardar">Guardar</button>
            <button type="submit" class="btn btn-danger" id="btnBorrar">Borrar</button>
        </div>
    </div>
    <?php if (isset($msg)) : ?>
        <div class="row">
            <div class="col-12">
                <div class="alert <?php echo $msg["codigo"] ?>" role="alert">
                    <?php echo $msg["texto"]; ?>
                </div>
            </div>
        </div>
    
    <?php endif; ?>
    <div class="row">
        <div class="col-12 form-group">
    <label for="txtFechaNac" class="d-block">Fecha y hora:</label>
    <select class="form-control d-inline" name="txtDia" id="txtDia" style="width:80">
        <option selected="" disabled="">DD</option>
        <?php for ($i = 1; $i <= 31; $i++) : ?>
            <?php if (date("d") == $i) : ?>
                <option selected value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php else : ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?>"</option>
            <?php endif; ?>

        <?php endfor; ?>
    </select>
    <select class="form-control d-inline" name="txtMes" id="txtMes" style="width:80">
        <option selected="" disabled="">MM</option>
        <?php for ($i = 1; $i <= 12; $i++) : ?>
            <?php if (date("m") == $i) : ?>
                <option selected value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php else : ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?>"</option>
            <?php endif; ?>
        <?php endfor; ?>
    </select>
    <select class="form-control d-inline" name="txtAnio" id="txtAnio" style="width:80">
        <option selected="" disabled="">YYYY</option>
        <?php for ($i = 2020; $i <= date("y"); $i++) : ?>
            <?php if (date("Y") == $i) : ?>
                <option selected value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php else : ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?>"</option>
            <?php endif; ?>
        <?php endfor; ?>
    </select>
    <input type="time" required="" class="form-control d-inline" style="width: 120px" name="txtHora"  value="<?php echo date("H:i");?>">
    </div>
    <div class="col-6 form-group">
        <label for="lstcliente">Cliente</label>
        <select required="" class="form-control selectpicker" data-live-search="true" name="lstCliente" id="lstcliente">
            <option selected="" disabled="">Seleccionar</option>
            <?php foreach ($aClientes as $cliente) : ?>
                <?php if ($cliente->fk_idcliente == $venta->fk_idcliente) : ?>
                    <option selected value="<?php echo $cliente->idcliente; ?>" ><?php echo $cliente->nombre; ?></option>
                    <?php else : ?>
                    <option value="<?php echo $cliente->idcliente; ?>"> <?php echo $cliente->nombre; ?></option>
                    <?php endif; ?>
                <? endforeach; ?>
        </select>
    </div>
    <div class="col-6 form-group">
        <label for="lstproducto">Producto</label>
        <select required="" class="form-control selectpicker" data-live-search="true">
            <option selected="" disabled="">Seleccionar</option>
            <?php foreach ($aProductos as $producto) : ?>
                <?php if ($producto->fk_idproducto == $producto->idtipoproducto) : ?>
                    <option selected value="<?php echo $producto->idproducto; ?>" ><?php echo $producto->nombre; ?></option>
                    <?php else : ?>
                    <option value="<?php echo $producto->idproducto; ?>" ><?php echo $producto->nombre; ?></option>
                    <?php endif; ?>
                <? endforeach; ?>

        </select>
    </div>
    <div class="col-6 form-group">
        <label for="txtPrecioUni">Precio unitario:</label>
        <input type="text" class="form-control" name="txtPrecioUni" id="txtPrecioUni" value="" required>
    </div>
    <div class="col-6 form-group">
        <label for="txtCantidad">Cantidad</label>
        <input type="text" class="form-control" name="tstCantidad" id="txtCantidad" value="" onchange="fCalcularTotal();" required>
        <<span id="msgStock" class="text-danger" style="display:none;">No hay stock suficiente</span>
    </div>
    <div class="col-6 form-group">
        <label for="txtTotal">Total</label>
        <input type="text" class="form-control" name="txtTotal" id="txtTotal" value="" required>
    </div>
</div>
<script>

</script>
<?php include_once("footer.php");  ?>