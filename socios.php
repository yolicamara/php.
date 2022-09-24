<?php

use Alumno as GlobalAlumno;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set('America/Argentina/Buenos_Aires');

class Persona{
    protected $dni;
    protected $nombre;
    protected $correo;
    protected $celular;




    public function __get($propiedad)
    {
        return $this->$propiedad; //aca se lo definimos
    }
    public function __set($propiedad, $valor)
    {
        $this->$propiedad = $valor; //aca se lo definimos
    }
    abstract public function imprimir();
}



class Cliente extends Persona{
    private $aTarjetas;
    private $bActivo;
    private $fechaAlta;
    private $fechaBaja;

    public function __construct(){
        $this->aTarjetas = array();
        $this->bActivo = true;
        $this->fechaAlta = date("d/m/y");
        # code...
    }

    public function __get($propiedad)
    {
        return $this->$propiedad; //aca se lo definimos
    }
    public function __set($propiedad, $valor)
    {
        $this->$propiedad = $valor; //aca se lo definimos
    }

    public function agregarTarjeta($tarjeta){
        $this->aTarjetas [] =$tarjeta;
    }

    public function darDeBaja($fecha){
        $this->fechaBaja = $fecha;
        $this->bActivo = false;//baja logica

    }

    public function imprimir(){

    }
}


class Tarjeta {

    private $numero;
    private $fechaEmision;
    private $fechaVto;
    private $tipo;
    private $cvv;

    const VISA = "Visa";
    const MASTERCARD = "Mastercard";
    const AMEX = "American Express";

public function __construct($tipo, $numero, $fechaEmision, $fechaVto, $cvv){
    $this->numero = $numero;
    $this->fechaEmision = $fechaEmision;
    $this->fechaVto = $fechaVto;
    $this->tipo = $tipo;
    $this->cvv = $cvv;
}





    public function __get($propiedad)
    {
        return $this->$propiedad; //aca se lo definimos
    }
    public function __set($propiedad, $valor)
    {
        $this->$propiedad = $valor; //aca se lo definimos
    }


}


//desarrollo del programa
$cliente1 = new Cliente();
$cliente1->dni = "35123789";
$cliente1->nombre = "Ana Valle";
$cliente1->correo = "ana@correo.com";
$cliente1->celular = "1156781234";
$terjeta1 = new Tarjeta(Tarjeta::VISA, "4223750778806383", "06/2022", "01/2023", "275");
$tarjeta2 = new Tarjeta(Tarjeta::AMEX, "347572886751981", "05/2020", "01/2027", "136");
$tarjeta3 = new Tarjeta(Tarjeta::MASTERCARD, "5415620495970009", "07/2021", "12/2024", "742");
$cliente1 ->agregarTarjeta($tarjeta1);
$cliente1->agregarTarjeta($tarjeta2);
$cliente1->agregarTarjeta($tarjeta3);

$cliente2 = new Cliente();
$cliente2->dni = "48456876";
$cliente2->nombre = "Bernabe Paz";
$cliente2->correo= "bernabe@correo.com";
$cliente2->celular = "114526787";
$cliente2->agregarTarjeta(new Tarjeta(Tarjeta::VISA, "4969508071710316", "06/2021", "08/2025","865"));
$cliente2->agregarTarjeta(new Tarjeta(Tarjeta::MASTERCARD,"51491076695522238", "03/2022", "04/2025", "554"));
$cliente2->darDeBaja(Date(24/8/2022));

print_r($cliente1);
print_r($cliente2);



































?>