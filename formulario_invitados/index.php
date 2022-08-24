<?
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_reporting', E_ALL);
//Siexiste el archivo invitados lo abrimos y cargamos en una variable del tipo array
//los dnis permitidos
if (file_exists("invitados.txt")) {
$archivo = fopen("invitados.txt", "r");
$aDocumentos = fgetcsv($archivo, 0, ",");
} else {

//Sino el erray queda como un array vacio
$aDocumentos = array();
}
if ($_POST) {
if (isset($_POST["btnProcesar"])) {
$documento = $_REQUEST["txtDocumento"];

//Si el dni ingresado se encuentra en la lista se mostrara un mensaje de bienvenida
if (in_array($documento, $aDocumentos)) {
$mensaje = "Bienvenido.";
} else {
$mensaje = "No se encuentra en la lista de invitados.";
}
}

//Sino un mensaje de no se encuentra en la lista de invitados

if (isset($_POST["btnVip"])) {
$codigo = $_REQUEST["txtCodigo"];
//Si el codigo es "verde" entonces mostrara su codigo de acceso es......
if ($codigo == "verde") {
$mensaje = "Su codigo de acceso es" . rand(1000, 9999);
} else {
$mensaje = "Sino Ud. no tiene pase Vip";
}
//Sino ud. no tiene pase Vip
}
}



?>





<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABM Clientes</title>
    <link href=" https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/fontawesome/fontawesome-free-6.1.1-web/css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome/fontawesome-free-6.1.1-web/css/fontawesome.min.css">
</head>

<body>


    <main class="container">
        <div class="row">
            <div class="col-12 py-3">
                <h1>Lista de invitados</h1>
            </div>
            <?php if (isset($Mensaje)) : ?>
                <div class="col-12">
                    <div class="alert alert-<?php echo $aMensaje["estado"]; ?>" role="alert">
                        <?php echo $aMensaje["texto"]; ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="col-12">
                <p>Complete el siguiente formulario:</p>
            </div>
            <div class="col-6">
                <form method="POST" action="">
                    <div class="row">
                        <div class="col-12">
                            <p>Ingrese el DNI:</p><input type="text" name="txtDocumento" class="form-control">
                            <Input type="submit" name="btnProcesar" value="Verificar invitado" class="btn'primary">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 bm-3">
                            <p>Ingresa el codigo secreto para el pase Vip:</p>
                            <input type="text" name="txtPregunta" class="form-control">
                            <input type="submit" name="btnVip" value="verificar codigo" class="btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>


</body>

</html>