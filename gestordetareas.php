<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
            <div class="col-12 py-5 text-center">
                <h1>Gestor de tareas</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <form method="POST">
                    <div class="pb-3">
                        <label for="">Prioridad</label>
                        <select name="lstPrioridad" id="lstPrioridad">
                            <option value="Sin asignar">Sin asignar</option>
                            <option value="Asignado">Asignado</option>
                            <option value="En proceso">En proceso</option>
                            <option value="Terminado">Terminado</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>


        <div class="row">
            <div class="col-3">
                <form method="POST">
                    <div class="pb-3">
                        <label for="">Usuario</label>
                        <select name="lstPrioridad" id="lstUsuario">
                            <option value="Sin asignar">Sin asignar</option>
                            <option value="Asignado">Asignado</option>
                            <option value="En proceso">En proceso</option>
                            <option value="Terminado">Terminado</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <form method="POST">
                    <div class="pb-3">
                        <label for="">Estado</label>
                        <select name="lstPrioridad" id="lstEstado">
                            <option value="Sin asignar">Sin asignar</option>
                            <option value="Asignado">Asignado</option>
                            <option value="En proceso">En proceso</option>
                            <option value="Terminado">Terminado</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>


        <div class="pb-3">
            <label for="">Titulo</label>
            <Input type="text" id="txtTitulo" name="txtTitulo" class="form-control"></Input>
        </div>
        <div class="pb-2 b-5">
            <label for="">Descripcion</label>
            <Input type="text" id="txtDescripcion" name="txtDescripcion" class="form-control"></Input>
        </div>
        <div class="text-center">
            <button type="submit"  name="btnEnviar" class="btn btn-primary">ENVIAR</button>
            <button type="submit" name="btnCancelar" class="btn bg-gray">CANCELAR</button>

        </div>
        </div>

        
        
        
    </main>
</body>

</html>