<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if(isset($_SESSION["listadoClientes"])){
    //si existe la variable de session listadoClientes asigno su condicion a aClientes
    $aClientes = $_SESSION["listadoClientes"];

} else{

$aClientes = array();
}

if ($_POST) {
    //si hace click en Enviar entonces:actua el array y se cumple todo lo de abajo, pero (sigue abajo*)
    //asignamos en variables los datos que vienen del formulario

    $nombre = $_POST["txtNombre"];
    $dni = $_POST["txtDni"];
    $telefono = $_POST["txtTelefono"];
    $edad = $_POST["txtEdad"];

// creamos un arry que contendra el estado de clientes
    $aClientes[] = array("nombre" => $nombre,
                         "dni" => $dni,
                         "telefono" => $telefono,
                         "edad" => $edad,
    );
    //actualiza el contenido de variable de session
    $_SESSION["listadoClientes"] = $aClientes;
    //(viene de arriba*) si hace click en eliminar: se produce esto
    //session_destroy();
}






?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de clientes</title>
    <link href=" https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">"
</head>

<body>
    <main class="container">
        <div class="row">
            <div class="col-12 text-center py-5">
                <h1>Listado de clientes</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-3 offset-1 me-5">
                <form action="" method="POST" class="form">
                    
                        <label for="txtNombre">Nombre:</label>
                        <input type="text" id="txtNombre" name="txtNombre" class="form-control my-2" placeholder="ingrese su nombre">
                    
                
                        <label for="txtDni">DNI:</label>
                        <input type="text" id="txtDni" name="txtDni" class="form-control my-2">
                
        
                        <label for="txtTelefono">Telefono:</label>
                        <input type="text" id="txtTelefono" name="txtTelefono" class="form-control my-2">
        
                    
                        <label for="txtEdad">Edad:</label>
                        <input type="texto" id="txtEdad" name="txtEdad" class="form-control my-2">
                    
                    
                        <button type="submit" name="btnEnviar" class="btn bg-primary text-white">Enviar</button>
                        <Button type="submit" name="btnEliminar" class="btn bg-danger text-white">Eliminar</Button>
                    
                </form>
            </div>
            <div class="col-6 px-5">
                <table class="table table-hover border shadow">
                    <thead>
                        <th>Nombre:</th>
                        <th>DNI:</th>
                        <th>Telefono:</th>
                        <th>Edad:</th>
                    </thead>
                    <tbody>
                        <?php foreach ($aClientes as $cliente): ?>
                            <tr>
                                <td><?php echo $cliente["nombre"]; ?></td>
                                <td><?php echo $cliente["dni"]; ?></td>
                                <td><?php echo $cliente["telefono"]; ?></td>
                                <td><?php echo $cliente["edad"]; ?></td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>

                </table>
            </div>

            
        </div>
    </main>
</body>

</html>