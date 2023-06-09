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

    public static function setAlerta($tipo, $mensaje) {
        static::$alertas[$tipo][] = $mensaje;
    }
    // Validación
    public static function getAlertas() {
        return static::$alertas;
    }

    public function validar() {
        static::$alertas = [];
        return static::$alertas;
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

    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // Busca un registro por su id
    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla  ." WHERE id = {$id}";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }

    // Obtener Registro
    public static function get($limite) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT {$limite}";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }

    // Busqueda Where con Columna 
    public static function where($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE {$columna} = '{$valor}'";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }

    // SQL para Consultas Avanzadas.
    public static function SQL($consulta) {
        $query = $consulta;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // crea un nuevo registro
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

    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value ) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    public function sincronizar($args=[]) { 
        foreach($args as $key => $value) {
          if(property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;
          }
        }
    }
}