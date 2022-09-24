<?php

class venta
{
    
    private $idventa;
    private $fecha;
    private $cantidad;
    private $preciounitario;
    private $total;
    private $fk_idcliente;
    private $fk_idproducto;
    private $nombre_cliente;
    private $nombre_producto;

    public function __construct(){
        $this->cantidad = 0;
        $this->preciounitario = 0.0;
        $this->total = 0.0;

    }
    public function __get($atributo)
    {
    return $this->$atributo;
    }
    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
        return $this;
    }
    public function cargarFormulario($rerequest){
    $this->idventa = isset($request["id"]) ? $request["id"] : "";
    $this->fk_idcliente = isset($request["lstCliente"]) ? $request["lstCliente"]: "";
    $this->fk_idproducto = isset($request["lstProducto"]) ? $request["lstProducto"]: "";
    if(isset($request["txtAnio"]) && isset($request["txtMes"]) && isset($request["txtDia"])){
        $this->fecha = $request["txtAnio"] . "-" . $request["txtMes"] . "-" . $request["txtDia"];
    }
    $this->cantidad = isset($equest["txtCantidad"])?$request["txtCantidad"] :0;
    $this->preciounitario = isset($request["txtPrecioUni"])? $request["txtPrecioUni"] : 0.0;
    $this->total = isset($request["txtTotal"])? $request["txtTotal"] : 0.0;
    }
    public function insertar(){
        //Instancia la clase mysqli con el constructor parametrizado
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
        //Arma la query
        $sql = "INSERT INTO ventas (
                    fecha,
                    cantidad,
                    preciounitario,
                    total,
                    fk_idcliente,
                    fk_idproducto
                ) VALUES (
                    '$this->fecha',
                    '$this->cantidad',
                    '$this->preciounitario',
                    '$this->total',
                    '$this->fk_cliente',
                    '$this->fk_idproducto'
                );";
        // print_r($sql);exit;
        //Ejecuta la query
        if (!$mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }
        //Obtiene el id generado por la inserción
        $this->idventa = $mysqli->insert_id;
        //Cierra la conexión
        $mysqli->close();
    }

     public function actualizar()
    {

        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
        $sql = "UPDATE clientes SET
                fecha = '$this->fecha',
                cantidad = '$this->cantidad',
                preciounitario = '$this->preciounitario',
                total = '$this->total',
                fk_idcliente =  '$this->fk_idcliente',
                fk_idproducto =  '$this->fk_idproducto',
                
                WHERE idventa = $this->idventa";

        if (!$mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }
        $mysqli->close();
    }
      public function eliminar()
    {
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
        $sql = "DELETE FROM ventas WHERE idventas = " . $this->idventas;
        //Ejecuta la query
        if (!$mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }
        $mysqli->close();
    }
         public function obtenerPorId()
    {
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
        $sql = "SELECT idventas,
                        fecha,
                        cantidad,
                        preciounitario,
                        total,
                        fk_idcliente,
                        fk_idproducto
                      
                FROM ventas
                WHERE idventa = $this->idventa";
        if (!$resultado = $mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }

        //Convierte el resultado en un array asociativo
        if ($fila = $resultado->fetch_assoc()) {
            $this->idventa = $fila["idventa"];
            $this->fecha = $fila["fecha"];
            $this->cantidad = $fila["cantidad"];
            $this->preciounitario = $fila["preciounitario"];
            $this->total = $fila["total"];
            $this->fk_idcliente = $fila["fk_idcliente"];
            $this->fk_idproducto = $fila["fk_idproducto"];
          
        }
        $mysqli->close();

    }
     public function obtenerVentasPorCliente($idCliente){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE, Config::BBDD_PORT);
        $sql = "SELECT idventa
                    fecha,
                    cantidad,
                    preciounitario,
                    total,
                    fk_idcliente,
                    fk_idproducto
                  
                FROM ventas WHERE fk_idcliente = $idCliente";
        if (!$resultado = $mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }

        $aResultado = array();
        if($resultado){
            //Convierte el resultado en un array asociativo

            while($fila = $resultado->fetch_assoc()){
                $entidadAux = new Venta();
                $entidadAux->idventa = $fila["idventa"];
                $entidadAux->fecha = $fila["fecha"];
                $entidadAux->cantidad = $fila["cantidad"];
                $entidadAux->preciounitario = $fila["preciounitario"];
                $entidadAux->total =$fila["total"];
                $entidadAux->fk_idcliente = $fila["fk_idcliente"];
                $entidadAux->fk_producto = $fila["fk_idproducto"];
             
                $aResultado[] = $entidadAux;
            }
        }
        $mysqli->close();
        return $aResultado;
    }

    public function cargarGrilla(){
        $mysqli = new mysqli(config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE<Config::BBDD_NOMBRE, Config::BBDD_PORT);

        $sql = "SELECT
        A.idventa,
        A.fecha,
        A.cantidad,
        A.fk_idcliente,
        B.nombre as nombre_cliente,
        A.fk_idproducto,
        A.total,
        A.preciounitario,
        C.nombre as nombre_producto
        FROM ventas A
        INNER JOIN clientes B ON A. fk_idcliente = B.idcliente
        INNER JOIN productos C ON A. fk_idproducto = C.idproducto
        ORDER BY A.fecha DESC";

        if(!$resultado = $mysqli->query($sql)){
            printf("error en query: %s\n", $mysqli->error . " " . $sql);
        }
        $aResultado = array();
        if ($resultado) {
            //Convierte el resultado en un array asociativo

            while ($fila = $resultado->fetch_assoc()) {
                $entidadAux = new Venta();
                $entidadAux->idventa = $fila["idventa"];
                $entidadAux->fecha = $fila["fecha"];
                $entidadAux->cantidad = $fila["cantidad"];
                $entidadAux->preciounitario = $fila["preciounitario"];
                $entidadAux->fk_idcliente = $fila["fk_idcliente"];
                $entidadAux->fk_producto = $fila["fk_idproducto"];
                $entidadAux->nombre_cliente = $fila["nombre_cliente"];
                $entidadAux->nombre_producto = $fila["nombre_producto"];
                $entidadAux->total = $fila["total"];

                $aResultado[] = $entidadAux;

    }

}
        $mysqli->close();
        return $aResultado;
    }
}
?>
