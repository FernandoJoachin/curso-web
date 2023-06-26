<?php

namespace Model;

class Tags extends ActiveRecord {
    protected static $tabla = 'tags';
    protected static $columnasDB = ['id', 'nombre'];
    
    public $id;
    public $nombre;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
    }
}