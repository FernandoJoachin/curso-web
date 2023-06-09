<?php
namespace Model;

class Proyecto extends ActiveRecord{
    protected static $tabla = "proyectos";
    protected static $columnasDB = ["id","proyecto", "url", "usuario_id"];

    public $id;
    public $proyecto;
    public $url;
    public $usuario_id;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->proyecto = $args["proyecto"] ?? "";
        $this->url = $args["url"] ?? "";
        $this->usuario_id = $args["usuario_id"] ?? "";
    }

    public function validarProyecto(){
        if(!$this->proyecto){
            self::$alertas["error"][] = "El nombre del proyecto es obligatorio";
        }
        return self::$alertas;
    }
}