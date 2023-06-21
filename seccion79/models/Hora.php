<?php

namespace Model;

class Hora extends ActiveRecord {
    protected static $tabla = 'horas';
    protected static $columnasDB = ['id', 'hora'];
    
    public $id;
    public $hora;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->hora = $args['hora'] ?? '';
    }
}