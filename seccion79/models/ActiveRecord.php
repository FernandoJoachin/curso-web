<?php
namespace Model;
class ActiveRecord {

    // Base DE DATOS
    protected static $db;
    protected static $tabla = '';
    protected static $columnasDB = [];

    // Alertas y Mensajes
    protected static $alertas = [];
    
    // Definir la conexión a la BD - includes/database.php
    public static function setDB($database) {
        self::$db = $database;
    }

    // Setear un tipo de Alerta
    public static function setAlerta($tipo, $mensaje) {
        static::$alertas[$tipo][] = $mensaje;
    }

    // Obtener las alertas
    public static function getAlertas() {
        return static::$alertas;
    }

    // Validación que se hereda en modelos
    public function validar() {
        static::$alertas = [];
        return static::$alertas;
    }

    // Consulta SQL para crear un objeto en Memoria (Active Record)
    public static function consultarSQL($query) {
        // Consultar la base de datos
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        // liberar la memoria
        $resultado->free();

        // retornar los resultados
        return $array;
    }

    // Crea el objeto en memoria que es igual al de la BD
    protected static function crearObjeto($registro) {
        $objeto = new static;

        foreach($registro as $key => $value ) {
            if(property_exists( $objeto, $key  )) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    // Identificar y unir los atributos de la BD
    public function atributos() {
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    // Sanitizar los datos antes de guardarlos en la BD
    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value ) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    // Sincroniza BD con Objetos en memoria
    public function sincronizar($args=[]) { 
        foreach($args as $key => $value) {
          if(property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;
          }
        }
    }

    // Registros - CRUD
    public function guardar() {
        $resultado = '';
        if(!is_null($this->id)) {
            // actualizar
            $resultado = $this->actualizar();
        } else {
            // Creando un nuevo registro
            $resultado = $this->crear();
        }
        return $resultado;
    }

    // Obtener todos los Registros
    public static function all($orden = "DESC") {
        $query = "SELECT * FROM " . static::$tabla . " ORDER BY id {$orden}";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // Busca un registro por su id
    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla  ." WHERE id = {$id}";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }

    // Obtener Registros con cierta cantidad
    public static function get($limite) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT {$limite} ORDER BY id DESC" ;
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }

    // Busqueda Where con Columna 
    public static function where($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE {$columna} = '{$valor}'";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }

    public static function paginar($por_pagina, $offset){
        $query = "SELECT * FROM " . static::$tabla . " ORDER BY id DESC LIMIT {$por_pagina} OFFSET {$offset}" ;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // Obtener el total de registros
    public static function total(){
        $query = "SELECT COUNT(*) FROM " . static::$tabla;
        $resultado = self::$db->query($query);
        $total = $resultado->fetch_array();
        return array_shift($total);
    }

    //Crea un nuevo registro
    public function crear() {
        $atributos = $this->atributos();

        // Insertar en la base de datos
        $columnas = implode(', ', array_keys($atributos));
        $atributosMarcadores = implode(', ', array_fill(0, count($atributos), '?'));
    
        $query = "INSERT INTO " . static::$tabla . " ($columnas) VALUES ($atributosMarcadores)";

        $stmt = self::$db->prepare($query); 
        if (!$stmt) {
            // Error en la preparación de la consulta
            return [
                'resultado' => false,
                'id' => null
            ];
        }

        $valores = array_values($atributos);
        $tipos = $this->obtenerTipoDeDatos($atributos); 
        $stmt->bind_param($tipos, ...$valores);

        //Ejecutar la consulta
        $resultado = $stmt->execute();

        //Cerrar la consulta y la conexión
        $stmt->close();

        return [
           'resultado' =>  $resultado,
           'id' => self::$db->insert_id
        ];
    }

    public function obtenerTipoDeDatos($atributos){
        $tipo = '';
        foreach ($atributos as $valor) {
            if (is_int($valor)) {
                $tipo .= 'i';  // Entero
            } elseif (is_float($valor)) {
                $tipo .= 'd';  // Número de punto flotante (double)
            } elseif (is_string($valor)) {
                $tipo .= 's';  // Cadena (string)
            } else {
                $tipo .= 's';  // Por defecto, trata todo como cadena
            }
        }
        return $tipo;
    }

    public function actualizar() {
        $atributos = $this->atributos();

        // Iterar para ir agregando cada campo de la BD
        $campo = [];
        foreach($atributos as $key => $value) {
            $campo[] = "{$key} = ?";
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= implode(', ', $campo);
        $query .= " WHERE id = " . $this->id . " LIMIT 1";

        $stmt = self::$db->prepare($query);
        if (!$stmt) {
            // Error en la preparación de la consulta
            return false;
        }

        $valores = array_values($atributos);
        $tipos = $this->obtenerTipoDeDatos($atributos); 
        // Vincular los valores a los marcadores de posición
        $stmt->bind_param($tipos, ...$valores);

        // Ejecutar la consulta
        $resultado = $stmt->execute();

        // Cerrar la declaración
        $stmt->close();

        return $resultado;
    }

    // Eliminar un registro - Toma el ID de Active Record
    public function eliminar() {
        $query = "DELETE FROM "  . static::$tabla . " WHERE id = ? LIMIT 1";
        $stmt = self::$db->prepare($query);
        if (!$stmt) {
            // Error en la preparación de la consulta
            return false;
        }
        $stmt->bind_param('i', $this->id);
        $resultado = $stmt->execute();
        $stmt->close();
        return $resultado;
    }
}