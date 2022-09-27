<?php

include_once "config.php";
include_once "entidades/producto.php";
include_once "entidades/tipoproducto";

$producto = new Producto();

if ($_POST) {
    if (isset($_POST["btnGuardar"])) {
        $tipoProducto->cargarFormulario($_REQUEST);


        //estoy actualizando

        if (isset($_GET["id"]) && $_GET["id"] > 0) {
            if ($_FILES["archivo"]["error"] === UPLOAD_ERR_OK) {
                $nombreAleatorio = date("Ymdhmsi"); //2021011420453710
                $$archivo_tmp = $_FILES["archivo"]["tmp_name"];
                $nombreArchivo = $_FILES["archivo"]["name"];
                $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
                $nombreImagen = "$nombreAleatorio.$extension";


                if ($extension == "png" || $extension == "jpg" || $extension == "jpeg") {
                      //Elimino la imagen anterior
                    $productoAnt = new  Producto();
                    $productoAnt->idproducto = $_GET["id"];
                    $productoAnt->obtenerPorId();
                    //Elimino la imagen anterior
                    if (file_exists("files/$productoAnt->imagen")) {
                        unlink("files/$productoAnt->imagen");
                    }
                    //
                    move_uploaded_file($archivo_tmp, "files/$nombreImagen");
                }
                $producto->imagen = $nombreImagen;
            }else{

                    $productoAnt = new  Producto();
                    $productoAnt->idproducto = $_GET["id"];
                    $productoAnt->obtenerPorId();
                    $producto->imagen = $productoAnt->imagen;
            
                  
                    //subo la imagen nueva
            
            }

            $Producto->actualizar();
            $msg["texto"] = "Actualizado correctamente";
            $msg["codigo"] = "alert-success";
        } else {
            if ($_FILES["archivo"]["error"] === UPLOAD_ERR_OK) {
                $nombreAleatorio = date("Ymdhmsi"); //2021011420453710
                $$archivo_tmp = $_FILES["archivo"]["tmp_name"];
                $nombreArchivo = $_FILES["archivo"]["name"];
                $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
                $nombreImagen = "$nombreAleatorio.$extension";


                if ($extension == "jpg" || $extension == "jpeg" || $extension == "jpeg") {
                    $nombreImagen = "$nombreAleatorio.$extension";
                    move_uploaded_file($archivo_tmp, "img/$nombreImagen");
                }
                $producto->imagen = $nombreImagen;
            }
            $producto->insertar();
            $msg["texto"] = "Insertado correctamente";
            $msg["codigo"] = "alert-succers";
        }
    } else if (isset($_POST["btnBorrar"])) {
        $producto = new Producto();
        $Producto->cargarFormulario($_REQUEST);
        $producto->obtenerPorId();
        if (file_exists("files/$producto->$imagen")) {
            unlink("files/$producto->$imagen");
        }
        $Producto->eliminar();
        header("Location:producto-listado.php");
    }

    if (isset($_GET["id"]) && $_GET["id"] > 0) {
        $Producto->cargarFormulario($_REQUEST);
        $Producto->obtenerPorId();
    }

$tipoProducto = new TipoProducto();
$aTipoProductos = $tipoproducto->obtenerTodos();

include_once "header.php";

?>




<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Productos</h1>
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
        <div class="col-12 mb-3">
            <a href="producto-listado.php" class="btn btn-primary mr-2">Listado</a>
            <a href="producto-formulario.php" class="btn btn-primary mr-2">Nuevo</a>
            <button type="submit" class="btn btn-success mr-2" id="btnGuardar">Guardar</button>
            <button type="submit" class="btn btn-danger" id="btnBorrar">Borrar</button>
        </div>
    </div>
    <div class="row">
        <div class="col-6 form-group">
            <label for="txtNombre">Nombre:</label>
            <input type="text" required="" class="form-control" name="txtNombre" id="txtNombre" value="<?php echo $producto->nombre; ?>">
        </div>


        <div class="col-6 form-group">
            <label for="txtNombre">Tipo de producto:</label>
            <select name="lstTipoProducto" id="lstTipoProducto" class="form-control selectpicker" data-live-search="true" required>
                <option value="" disabled selected>Seleccionar</option>

                <?php foreach ($aTipoProductos as $tipoProducto) : ?>
                    <?php if ($producto->fk_idtipoproducto == $tipoProducto->idtipoproducto) : ?>
                        <option selected value="<?php echo $tipoProducto->idtipoproducto; ?>" <?php echo $tipoProducto->nombre; ?></option>
                        <?php else : ?>
                        <option value="<?php echo $tipoProducto->idtipoproducto; ?>" <?php echo $tipoProducto->nombre; ?></option>
                        <?php endif; ?>
                    <? endforeach; ?>
            </select>
        </div>


        <div class="col-6 form-group">
            <label for="txtCantidad">Cantidad:</label>
            <input type="number" required="" class="form-control" name="txtCantidad" id="txtCantidad" value="<?php echo $producto->cantidad; ?>">
        </div>
        <div class="col-6 form-group">
            <label for="txtPrecio">Precio:</label>
            <input type="text" class="form-control" name="txtPrecio" id="txtPrecio" value="<?php echo $producto->precio; ?>">
        </div>
        <div class="col-12 form-group">
            <label for="txtCorreo">Descripcion:</label>
            <textarea type="text" name="txtDescripcion" id="txtDescripcion"><?php echo $producto->descripcion; ?>></textarea>
        </div>
        <div class="col-6 form-group">
            <label for="fileImagen">Imagen:</label>
            <input type="file" class="form-control-file" name="archivo" id="imagen">
            <?php if ($producto->imagen != "") : ?>
                <img src="files/<?php echo $producto->imagen; ?>" class="img-thumbnail">
            <?php endif; ?>
        </div>
    </div>

</div>

<script>
    ClassicEditor
        .create(document.querySelector('#txtDescripcion'))
        .catch(error => {
            console.error(error);

        });
</script>
<?php include_once "footer.php"; ?>