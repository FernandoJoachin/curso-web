<?php
namespace App;
class Vendedor extends ActiveRecord{
    protected static $columnasDB = ["id","nombre","apellido","telefono"];
    protected static $nombreTabla = "vendedores";

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = []){
        $this->id = $args["id"] ?? null;   
        $this->nombre = $args["nombre"] ?? "";   
        $this->apellido = $args["apellido"] ?? "";   
        $this->telefono = $args["telefono"] ?? "";   
    }

    public function validar(){
        if(!$this->nombre) {
            self::$errores[] = "Es obligatorio añadir un nombre";
        }

        if(!$this->apellido) {
            self::$errores[] = "Es obligatorio añadir un apellido";
        }

        if(!$this->telefono) {
            self::$errores[] = "Es obligatorio añadir un telefono";
        }

        if(!preg_match("/[0-9]{10}/", $this->telefono)){
            self::$errores[] = "Formato de telefono inválido";
        }

        return self::$errores;
    }
} 