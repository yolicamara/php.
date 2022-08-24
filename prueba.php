<?php
use Alumno as GlobalAlumno;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



class Persona{
    protected $dni;
    protected $nombre;
    protected $edad;
    protected $nacionalidad;

    public function __construct($dni="", $nombre="", $edad="", $nacionalidad=""){
        $this->dni = $dni;

    }
    public function setDni($dni){$this->din = $dni;}
    public function getDni(){return $this->dni;}

    public function setNombre($nombre){$this->nombre = $nombre;}
    public function getNombre(){ return $this->nombre;}

    public function setEdad($edad){$this->edad = $edad;}
    public function getEdad(){ return $this->edad;}

    public function setNacionalidad($nacionalidad){$this->nacionalidad = $nacionalidad;}
    public function getNacionalidad(){ return $this->nacionalidad;}
    
        
    

    public function imprimir(){}
}

class Alumno extends Persona
{
    public $legajo;
    public $notaPorfolio;
    public $notaPhp;
    public $notaProyecto;


    public function __construct()
    {
        $this->notaPorfolio = 0.0;
        $this->notaPhp= 0.0;
        $this->notaProyecto= 0.0;
    }
    public function __destruct()
    {
        echo "Destruyendo el objeto" .$this->nombre ."<br>";
    }
    public function __get($propiedad){
        return $this->$propiedad;//aca se lo definimos
    }
    public function __set($propiedad, $valor){
        $this->$propiedad = $valor;//aca se lo definimos
    }

    public function imprimir(){
        echo "DNI:" . $this->dni ."<br>";
        echo "Nombre:" . $this->nombre ."<br>";
        echo "edad:" . $this->edad ."<br>";
        echo "Nacionalidad:" . $this->nacionalidad ."<br>";
        echo"Nota Porfolio:" . $this->notaPorfolio ."<br>";
        echo "Nota PHP:" . $this->notaPhp ."<br>";
        echo "Nota Proyecto:" . $this->notaProyecto ."<br>";
        echo "Promedio:" . number_format ($this->calcularPromedio(), 2, ".", "."). "<br><br>;";
    }
    public function calcularPromedio(){
    
        return ($this->notaPhp + $this->notaPorfolio +$this->notaProyecto)/3;

        
    }
}

class Docente extends Persona
{
    public $especialidad;
    const ESPECIALIDAD_WP = "wordpress";
    const ESPECIALIDAD_ECO = "Economia aplicada";
    const ESPECIALIDAD_BBDD = "Base de datos";

    public function __destruct(){
        echo "Destruyendo el objeto" . $this->nombre . "<br>";
    }

    public function imprimir() {}
    public function imprimirEspecialidadesHabilitadas() {
        echo "Un docente puede tener las siguientes especialidades:<br>";
        echo "Especialidad 1:" . self::ESPECIALIDAD_WP . "<br>";
        echo "Especialidad 1:" . self::ESPECIALIDAD_ECO . "<br>";
        echo "especialidad 3:" . self::ESPECIALIDAD_BBDD . "<br>";

    }
}


//Programa
$alumno1 = new Alumno();
$alumno1->setDni("33964567");
$alumno1->setnombre("Ana Valle");
echo "El nombre es" . $alumno1->getNombre();
$alumno1->notaPhp ="8";
$alumno1->notaPorfolio ="9";
$alumno1->notaProyecto ="10";
$alumno1-> imprimir();



$alumno2 = new Alumno();
$alumno2->setDni("56964567");
$alumno2->setNombre("Bernabe");
$alumno2->notaPhp ="7";
$alumno2->notaPorfolio ="8";
$alumno2->notaProyecto ="9";
$alumno2-> imprimir();

$docente1 = new Docente();
$docente1->nombre = "Juan Perez";
$docente1->especialidad = Docente::ESPECIALIDAD_BBDD;

$docente1->imprimirEspecialidadesHabilitadas();




?>