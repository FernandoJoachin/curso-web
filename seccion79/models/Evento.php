<?php

namespace Model;

class Evento extends ActiveRecord {
    protected static $tabla = 'eventos';
    protected static $columnasDB = ['id', 'nombre', 'descripcion', 'disponibles','categoria_id', 'dia_id', 'hora_id', 'ponente_id'];
    
    public $id;
    public $nombre;
    public $descripcion;
    public $disponibles;
    public $categoria_id;
    public $categoria;
    public $dia_id;
    public $dia;
    public $hora_id;
    public $hora;
    public $ponente_id;
    public $ponente;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->disponibles = $args['disponibles'] ?? null;
        $this->categoria_id = $args['categoria_id'] ?? null;
        $this->categoria = $args['categoria'] ?? null;
        $this->dia_id = $args['dia_id'] ?? null;
        $this->dia = $args['dia'] ?? null;
        $this->hora_id = $args['hora_id'] ?? null;
        $this->hora = $args['hora'] ?? null;
        $this->ponente_id = $args['ponente_id'] ?? null;
        $this->ponente= $args['ponente'] ?? null;
    }
    
    public function validar() {
        //Codigo proporcionado
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre es Obligatorio';
        }
        if(!$this->descripcion) {
            self::$alertas['error'][] = 'La descripción es Obligatoria';
        }
        if(!$this->categoria_id  || !filter_var($this->categoria_id, FILTER_VALIDATE_INT)) {
            self::$alertas['error'][] = 'Elige una Categoría';
        }
        if(!$this->dia_id  || !filter_var($this->dia_id, FILTER_VALIDATE_INT)) {
            self::$alertas['error'][] = 'Elige el Día del evento';
        }
        if(!$this->hora_id  || !filter_var($this->hora_id, FILTER_VALIDATE_INT)) {
            self::$alertas['error'][] = 'Elige la hora del evento';
        }
        if(!$this->disponibles  || !filter_var($this->disponibles, FILTER_VALIDATE_INT)) {
            self::$alertas['error'][] = 'Añade una cantidad de Lugares Disponibles';
        }
        if(!$this->ponente_id || !filter_var($this->ponente_id, FILTER_VALIDATE_INT) ) {
            self::$alertas['error'][] = 'Selecciona la persona encargada del evento';
        }

        return self::$alertas;
    }
}