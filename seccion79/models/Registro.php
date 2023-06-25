<?php

namespace Model;

class Registro extends ActiveRecord {
    protected static $tabla = 'registros';
    protected static $columnasDB = ['id', 'paquete_id', 'pago_id', 'token', 'usuario_id'];
    
    public $id;
    public $paquete_id;
    public $paquete;
    public $pago_id;
    public $token;
    public $usuario_id;
    public $usuario;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->paquete_id = $args['paquete_id'] ?? null;
        $this->paquete = $args['paquete'] ?? null;
        $this->pago_id = $args['pago_id'] ?? "";
        $this->token = $args['token'] ?? '';
        $this->usuario_id = $args['usuario_id'] ?? null;
        $this->usuario = $args['usuario'] ?? null;
    }
}