<?php

class producto
{
    private $idproducto;
    private $nombre;
    private $cantidad;
    private $precio;
    private $descripcion;
    private $imagen;
    private $fk_idtipoproducto;
    

      public function __construct() {
        $this->cantidad = 0;
        $this->precio = 0.0;

    }

    public function __get($atributo) {
        return $this->$atributo;
    }

    public function __set($atributo, $valor){
        $this->$atributo = $valor;
        return $this;
    }
    public function cargarformulario(){
        $this->idproducto = isset($request["id"])? $request["id"] :"";
        $this->nombre = isset(request["txtnombre"]) ? $request["txtnombre"] : "";
        $this->fk_idtipoproducto = isset($request["lstTipoProducto"]) ? $request["litTipoProducto"] :"";
        $this->cantidad = isset($request["txtCantidad"]) ? $request["txtCantidad"] : 0;
        $this->precio = isset($request["txtPrecio"]) ? $request["txtPrecio"] : 0;
        $this->descripcion = isset($request["txtDescripcion"]) ? $request["txtDescripcion"] : "";
    }

    public function insertar(){
        //Instancia la clase mysqli con el constructor parametrizado
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
        //Arma la query
        $sql = "INSERT INTO productos (
                    nombre,
                    cantidad,
                    precio,
                    descripcion,
                    imagen,
                    fk_idtipoproducto
                ) VALUES (
                    '$this->nombre',
                    '$this->cantidad',
                    '$this->precio',
                    '$this->descrpcion',
                    '$this->imagen',
                     '$this->fk_idtipoproducto'
                );";
        // print_r($sql);exit;
        //Ejecuta la query
        if (!$mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }
        //Obtiene el id generado por la inserción
        $this->idProducto = $mysqli->insert_id;
        //Cierra la conexión
        $mysqli->close();
    }

     public function actualizar()
    {

        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
        $sql = "UPDATE clientes SET
                nombre = '$this->nombre',
                cantidad = '$this->cantidad',
                precio = '$this->precio',
                descripcion = '$this->descripcion',
                imagen =  '$this->imagen',
                fk_idtipoproducto =  '$this->fk_idtipoproducto',
                fk_idlocalidad =  '$this->fk_idlocalidad',
                domicilio =  '$this->domicilio'
                WHERE idproducto = $this->idproducto";

        if (!$mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }
        $mysqli->close();
    }

    public function eliminar()
    {
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
        $sql = "DELETE FROM productos WHERE idproducto = " . $this->idproducto;
        //Ejecuta la query
        if (!$mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }
        $mysqli->close();
    }

        public function obtenerPorId()
    {
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
        $sql = "SELECT idproducto,
                        nombre,
                        cantidad,
                        precio,
                        descripcion,
                        imagen,
                        fk_idtipoproducto,
                      
                FROM productos
                WHERE idproducto = " .$this->idproducto;
        if (!$resultado = $mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }

        //Convierte el resultado en un array asociativo
        if ($fila = $resultado->fetch_assoc()) {
            $this->idproducto - $fila["idproducto"];
            $this->nombre = $fila["nombre"];
            $this->cantidad = $fila["cantidad"];
            $this->precio = $fila["precio"];
            $this->descripcion = $fila["descripcion"];
            $this->fk_idtipoproducto = $fila["fk_idtipoproducto"];
            $this->imagen = $fila["imagen"];
          
        }
        $mysqli->close();
        return $this;

    }

    public function obtenerPorTipo($idTipoProducto){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
        $sql = "SELECT idproducto,
                        nombre,
                        cantidad,
                        precio,
                        descripcion,
                        imagen,
                        fk_idtipoproducto,
                      
                FROM productos
                WHERE idtipoproducto = " . $this->idTipoProducto;
        if (!$resultado = $mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);

    }
        //convierte el resultado en un array asociativo
        $aResultado = array();
        if ($resultado) {
            //Convierte el resultado en un array asociativo

            while ($fila = $resultado->fetch_assoc()) {
                $entidadAux = new Producto();
                $entidadAux->idproducto = $fila["idproducto"];
                $entidadAux->nombre = $fila["nombre"];
                $entidadAux->cantidad = $fila["cantidad"];
                $entidadAux->precio = $fila["precio"];
                $entidadAux->descripcion = $fila["descripcion"];
                $entidadAux->fk_tipoproducto = $fila["fk_idtipoproducto"];
                $entidadAux->imagen = $fila["imagen"];
                $aResultado[] = $entidadAux;
            }
        }
        $mysqli->close();
        return $aResultado;
   
    }

     public function obtenerTodos(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
        $sql = "SELECT 
                    idproducto,
                    nombre,
                    cantidad,
                    precio,
                    descripcion,
                    imagen,
                    fk_idtipoproducto,
                  
                FROM productos ORDER BY idproducto DESC";
     
        if (!$resultado = $mysqli->query($sql)) {
           printf("Error en query: %s\n", $mysqli->error . " " . $sql);
       }

        $aResultado = array();
        if($resultado){
            //Convierte el resultado en un array asociativo

            while($fila = $resultado->fetch_assoc()){
                $entidadAux = new Producto();
                $entidadAux->idproducto = $fila["idproducto"];
                $entidadAux->nombre = $fila["nombre"];
                $entidadAux->cantidad = $fila["cantidad"];
                $entidadAux->precio = $fila["precio"];
                $entidadAux->descripcion = $fila["descripcion"];
                $entidadAux->fk_tipoproducto = $fila["fk_idtipoproducto"];
             
                $aResultado[] = $entidadAux;
            }
        }
        $mysqli->close();
        return $aResultado;
    }

}
?>

