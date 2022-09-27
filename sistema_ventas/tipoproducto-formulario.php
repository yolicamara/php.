<?php
include_once "config.php";
include_once "entidades/tipoproducto.php";
include_once "entidades/producto.php";
 $tipoProducto = new TipoProducto();



if($_POST){
if(isset($_POST["btnGuardar"])){
        $tipoProducto->cargarFormulario($_REQUEST);
        
    


if(isset($_GET["id"]) && $_GET["id"] > 0){

    $tipoProducto->actualizar(); 
    $msg["texto"] = "Actualizado correctamente";
    $msg["codigo"] = "alert-success";
    }else{
        $tipoproducto->insertar();
        $msg["texto"] = "Insertado correctamente";
        $msg["codigo"] = "alert-success";
}
}
   else if (isset($_POST["btnBorrar"])){
    $tipoProducto->cargarFormulario($_REQUEST);
    //Busco aquellos productos que tengan este tipo de producto
    $producto = new Producto();
    if($producto->obtenerPorTipo($tipoProducto->idtipoproducto)){
        $msg["texto"] = "No se puede eliminarun tipo de producto con productos asociados.";
        $msg["codigo"] = "alert_danger";
 }else{
    //sino
    //elimino
    
 
    $tipoProducto->eliminar();
    header("Location: tipoproducto-listado.php");
   } 
 }
}
if (isset($_GET["id"]) && $_GET["id"] > 0) {
    $tipoProducto->cargarFormulario($_REQUEST);
    $tipoProducto->obtenerPorId();
}


include_once "header.php";

?>


<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tipo de productos</h1>
    <?php if (isset($msg)) : ?>
        <div class="row">
            <div class="col-12">
                <div class="alert <?php echo $msg["codigo"]; ?>" role="alert">
                    <?php echo $msg["texto"]; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-12 mb-3">
            <a href="tipoproducto-listado.php" class="btn btn-primary mr-2">Listado</a>
            <a href="tipoproducto-formulario.php" class="btn btn-primary mr-2">Nuevo</a>
            <button type="submit" class="btn btn-success mr-2" id="btnGuardar">Guardar</button>
            <button type="submit" class="btn btn-danger" id="btnBorrar">Borrar</button>
        </div>
    </div>
    <div class="row">
        <div class="col-6 form-group">
            <label for="txtNombre">Nombre</label>
            <input type="text" required class="form-control" name="txtNombre" id="txtNombre" value="<?php echo $tipoProducto->nombre; ?>">
        </div>
    </div>
    </div>
    <?php include_once("footer.php"); ?>