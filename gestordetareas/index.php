<?php
ini_set('display_errors', 1);
ini_set('porting(E_ALL);display_startup_errors', 1);
error_re

if (file_exists("archivo.txt")) {
    //Si el archivo existe,cargo las tareas en la variable aTareas
    $strJson = file_get_contents("archivo.txt");
    $aTareas = json_decode($strJson, true);
} else {
    //Si el archivo no existe es porque na hay tareas
    $aTareas = array();
}


if (isset($_GET["id"])  && $_GET["id"] >= 0) {
    $id = $_GET["id"];
} else {
    $id = "";
}
if ($_POST) {
    $titulo = $_POST["txtTitulo"];
    $prioridad = $_POST["lstPrioridad"];
    $usuario = $_POST["lstUsuario"];
    $estado = $_POST["lstEstado"];
    $descripcion = $_POST["txtDescripcion"];

    if ($id >= 0) {
        //Estoy editando una tarea
        $aTareas[$id] = array(
            "fecha" => $aTareas[$id]["fecha"],
            "prioridad" => $prioridad,
            "usuario" => $usuario,
            "estado" => $estado,
            "titulo" => $titulo,
            "descripcion" => $descripcion

        );
    } else {
        //estoy insertando una tarea
        $aTareas[] = array(
            "fecha" => date("d/m/Y"),
            "prioridad" => $prioridad,
            "usuario" => $usuario,
            "estado" => $estado,
            "titulo" => $titulo,
            "descripcion" => $descripcion
        );
    }
    //convertir el array de tareas json
    $strjson = json_encode($aTareas);

    //almacenar en un archivo.txt el json con file_put_contens
    file_put_contents("archivo.txt", $strJson);
}
if (isset($_GET["do"]) && $_GET["do"] == "eliminar") {
    unset($aTareas["id"]);

    //Convertir aTareas en json
    $strJson = json_encode($aTareas);

    //Almacenar el json en el archivo
    file_put_contents("archivo.txt", $strJson);

    header("Location: index.php");
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
            <div class="col-12 pt-5 pb-3 text-center">
                <h1>Gestor de tareas</h1>
            </div>
        </div>
        <div class="row pb-3">
            <div>
                <form action="" method="POST">
                    <div class="row">
                        <div class="py-1 col-4">
                            <label for="lstPrioridad">Prioridad</label>
                            <select name="lstPrioridad" id="lstPrioridad" class="form-control" required>
                                <option value="" disabled selected>Seleccionar</option>
                                <option value="Alta" <?php echo isset($aTareas[$id]) && $aTareas[$id]["prioridad"] == "Alta" ? "selected" : ""; ?>>Alta</option>
                                <option value="Media" <?php echo isset($aTareas[$id]) && $aTareas[$id]["prioridad"] == "Media" ? "selected" : ""; ?>>Media</option>
                                <option value="Baja" <?php echo isset($aTareas[$id]) && $aTareas[$id]["prioridad"] == "Baja" ? "selected" : ""; ?>>Baja</option>
                            </select>
                        </div>
                        <div class="py-1 col-4">
                            <label for="lstUsuario">Usuario</label>
                            <select name="lstUsuario" id="lstUsuario" class="form-control" requerid>
                                <option value="" disabled selected>Seleccionar</option>
                                <option value="Ana" <?php echo isset($aTareas[$id]) && $aTareas[$id]["usuario"] == "Ana" ? "selected" : ""; ?>>Ana</option>
                                <option value="Bernabe" <?php echo isset($aTareas[$id]) && $aTareas[$id]["usuario"] == "Bernabe" ? "selected" : ""; ?>>Bernabe</option>
                                <option value="Daniela" <?php echo isset($aTareas[$id]) && $aTareas[$id]["usuario"] == "Daniela" ? "selected" : ""; ?>>Daniela</option>
                            </select>
                        </div>
                        <div class="py-1 col-4">
                            <label for="lstEstado">Estado</label>
                            <select name="lstEstado" id="lstEstado" class="form-control" requerid>
                                <option value="" disabled selected>Seleccionar</option>
                                <option value="Sin asignar" <?php echo isset($aTareas[$id]) && $aTareas[$id]["prioridad"] == "sin asignar" ? "selected" : ""; ?>>Sin Asignar</option>
                                <option value="Asignado" <?php echo isset($aTareas[$id]) && $aTareas[$id]["prioridad"] == "asignado" ? "selected" : ""; ?>>Asignado</option>
                                <option value="En proceso" <?php echo isset($aTareas[$id]) && $aTareas[$id]["prioridad"] == "en proceso" ? "selected" : ""; ?>>En proceso</option>
                                <option value="Terminado" <?php echo isset($aTareas[$id]) && $aTareas[$id]["estado"] == "terminado" ? "selected" : ""; ?>>Terminado</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 py-1">
                            <label for="txtTitulo">Titulo</label>
                            <Input type="text" id="txtTitulo" name="txtTitulo" class="form-control"></Input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 py-1">
                            <label for="txtDescripcion">Descripcion</label>
                            <textarea name="txtDescripcion" id="txtDescripcion" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 py-1 text-center">
                            <button type="submit" name="btnEnviar" class="btn btn-primary">ENVIAR</button>
                            <a href="index.php" class="btn btn-secondary">CANCELAR</a>

                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php if (count($aTareas)) : ?>
            <div class="row">
                <div class="col-12 pt-3">
                    <table class="table table-hover border">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Fecha de insercion</th>
                                <th>Titulo</th>
                                <th>Prioridad</th>
                                <th>Usuario</th>
                                <th>Estado</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($aTareas as $pos => $tarea): ?>
                                <tr>
                                    <td><?php echo $pos?></td>
                                    <td><?php echo $tarea["fecha"]; ?></td>
                                    <td><?php echo $tarea["titulo"]; ?></td>
                                    <td><?php echo $tarea["prioridad"]; ?></td>
                                    <td><?php echo $tarea["usuario"]; ?>></td>
                                    <td><?php echo $tarea["estado"]; ?></td>
                                    <td>
                                        <a href="?id=<?php echo $pos ?>&do=editar" class="btn btn-secondary"><i class="bi bi-pencil-fill"></i></a>
                                        <a href="?id=<?php echo $pos ?>&do=eliminar" class="btn btn-danger"><i class="bi bi-trash-fill"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php else : ?>
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-info" role="alert">
                        aun no se han cargado tareas.
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </main>
</body>

</html>