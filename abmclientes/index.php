<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Preguntar si existe el archivo
if (file_exists("archivo.txt")) {
    //Vamos a leerlo y almacenamos el contenido en jsonClientes
    $jsonClientes = file_get_contents("archivo.txt");

    //Convertir jsonClientes en un array llamado aClientes
    $aClientes = json_decode($jsonClientes, true);
} else {
    //Si no existe el archivo
    //Creamos un aClientes inicializado como un array vacio
    $aClientes = array();
}

$pos = isset($_GET["pos"]) && $_GET["pos"] >=  0 ? $_GET["pos"] : "";


if ($_POST) {
    $documento = trim($_POST["txtDocumento"]);
    $nombre = trim($_POST["txtNombre"]);
    $telefono = trim($_POST["txtTelefono"]);
    $correo = trim($_POST["txtCorreo"]);
    $nombreImagen = "";

    if($pos>=0){
        if ($_FILES["archivo"]["error"] === UPLOAD_ERR_OK){
            $nombreAleatorio = date("Ymdhmsi"); //2021011420453710
            $$archivo_tmp = $_FILES["archivo"]["tmp_name"];
            $extension = strtolower(pathinfo($_FILES["archivo"]["name"], PATHINFO_EXTENSION));
            if($extension == "jpg" || $extension == "jpeg" || $extension == "png"){
                $nombreImagen = "$nombreAleatorio.$extension";
                move_uploaded_file($archivo_tmp, "imagenes/$nombreImagen"); 
            }

            //eliminar la imagen anterior
            if($aClientes[$pos]["imagen"] != "" && file_exists("imagenes/".$aClientes[$pos]["imagen"])){
                unlink("imagenes".$aClientes[$pos]["imagen"]);
            }
        }else{
            //Mantener el nombreImagen que teniamos antes
            $nombreImagen = $aClientes[$pos]["imagen"];
        }



      //actualizar
        $aClientes[$pos] = array(
        "documento" => $documento,
        "nombre" => $nombre,
        "telefono" => $telefono,
        "correo" => $correo,
        "imagen" => $nombreImagen);

    }else{
       // $nombreAleatorio = date("Ymdhmsi"); //2021010420453710
        //$archivo_tmp = $_FILES["archivo"]["tmp_name"];
        //if($extension == "doc" || $extension =="docx" || $extension == "pdf"){   if($pos>=0){
            $nombreAleatorio = date("Ymdhmsi"); //2021011420453710
            $archivo_tmp = $_FILES["archivo"]["tmp_name"];
            $extension = pathinfo($_FILES["archivo"]["name"], PATHINFO_EXTENSION);
            if($extension == "jpg" || $extension == "jpeg" || $extension == "png"){
            $nombreImagen = "$nombreAleatorio.$extension";
                 move_uploaded_file($archivo_tmp, "imagenes/$nombreImagen"); 



        }
    }
   //insertar

    $aClientes[] = array(
        "documento" => $documento,
        "nombre" => $nombre,
        "telefono" => $telefono,
        "correo" => $correo,
        "imagen" =>$nombreImagen
    );

    //convertir el array de clientes a jsonClientes
    $jsonClientes = json_encode($aClientes);

    //Almacenar el string jsonClientes en el "archivo.txt"
    file_put_contents("archivo.txt", $jsonClientes);
} 

if(isset($_GET["do"]) && $_GET["do"] == "eliminar"){
    //eliminar del array aClientes la posicion a borrar unset()
    unset($aClientes[$pos]);


    //convertir el array en json
    $jsonClientes = json_encode($aClientes);



    //almacenar el json en el archivo
    file_put_contents("archivo.txt", $jsonClientes);
    header ("Location: index.php");

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
            <div class="col-12 py-5 text-center">
                <h1>Registro de clientes</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div>
                        <label for="">Documento: *</label>
                        <input type="text" name="txtDocumento" id="txtDocumento" class="form-control" required value="<?php echo isset($aClientes[$pos])? $aClientes[$pos]["documento"]: ""; ?>">
                    </div>
                    <div>

                        <label for="">Nombre: *</label>
                        <input type="text" name="txtNombre" id="txtNombre" class="form-control" required value="<?php echo isset($aClientes[$pos])? $aClientes[$pos]["nombre"]: ""; ?>">
                    </div>

                    <div>
                        <label for="">Telefono:</label>
                        <input type="namber" name="txtTelefono" id="txtTelefono" class="form-control" value="<?php echo isset($aClientes[$pos])? $aClientes[$pos]["telefono"]: ""; ?>">
                    </div>
                    <div>
                        <label for="">Correo: *</label>
                        <input type="Correo" name="txtCorreo" id="txtCorreo" class="form-control" required value="<?php echo isset($aClientes[$pos])? $aClientes[$pos]["correo"]: ""; ?>">
                    </div>
                    <div>
                        <label for="">Archivo adjunto</label>
                        <input type="file" name="archivo" id="archivo" accept=".jpg, .jpeg, .png">
                        <small class="d-block">Archivos admitidos: .jpg, .jpeg, .png </small>
                    </div>

                    <div>
                        <button type="submit" name="btnEnviar" class="btn btn-primary ">Guardar</button>
                        <a href="index.php" class="btn btn-danger my-2">NUEVO</a>
                    </div>
                </form>
            </div>
            <div class="col-6">
                <table class="table table-hover border">
                    <tr>

                        <th>Imagen</th>
                        <th>Documento</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Acciones</th>
                    </tr>
                    <?php foreach ($aClientes as $pos=> $cliente) : ?>


                        <tr>
                            <td>
                            <?php if($cliente["imagen"] != "") : ?>
                            <img src="imagenes/<?php echo $cliente["imagen"];?>" class="img-thumbnail">
                        <?php endif; ?>
                        </td>
                            <td><?php echo $cliente["documento"]; ?></td>
                            <td><?php echo $cliente["nombre"]; ?></td>
                            <td><?php echo $cliente["correo"]; ?></td>
                            <td>
                                <a href="index.php?pos=<?php echo $pos ?>&do=editar"><i class="bi bi-pencil-fill"></i></a>
                                <a href="index.php?pos=<?php echo $pos ?>&do=eliminar"><i class="bi bi-trash-fill"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </table>
            </div>
        </div>

    </main>


</body>

</html>