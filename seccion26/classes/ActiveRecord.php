<?php
namespace App;

class ActiveRecord{
    //DB
    protected static $db;
    protected static $columnasDB = [];
    protected static $nombreTabla = "";

    //Errores
    protected static $errores = [];

    //Lista todo los registro
    public static function all(){
        $query = "SELECT * FROM " . static::$nombreTabla; //static::$variable - Permite que el método acceda a la propiedad estática de la clase en la que se encuentra la línea de código
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //Busca un registro
    public static function find($id){
        $query = "SELECT * FROM " . static::$nombreTabla . " WHERE id={$id}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado); //Devuelve el primer elemento del arreglo
    }

    public static function get($cantidad){
        $query = "SELECT * FROM " . static::$nombreTabla . " LIMIT " . $cantidad; //static::$variable - Permite que el método acceda a la propiedad estática de la clase en la que se encuentra la línea de código
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public function guardar(){
        if(!is_null($this->id)){
            $this->actualizar();
        }else{
            $this->crear();
        }
    }

    public function actualizar(){
        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach($atributos as $key => $value){
            $valores[] = "{$key}='{$value}'";
        }
        $setInfo = join(", ", $valores);
        $query = "UPDATE " . static::$nombreTabla . " SET {$setInfo}";
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "'";
        $query .= " LIMIT 1";
        $resultado = self::$db->query($query);
        
        if($resultado){
            //Redireccionar al usuario;
            header("Location: /admin?resultado=2");
        }
    }

    public function crear(){
        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        $keys = join(", ", array_keys($atributos));
        $values = join("', '", array_values($atributos));
        $query = "INSERT INTO " . static::$nombreTabla . " ({$keys}) VALUES ('{$values}')";
        $resultado = self::$db->query($query);

        if($resultado){
            //Redireccionar al usuario;
            header("Location: /admin?resultado=1");
        }
    }

    public function eliminar(String $tipo = ""){
        //Eliminar registro
        $query = "DELETE FROM " . static::$nombreTabla . " WHERE id="  . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        if($resultado){
            if($tipo === "propiedad"){
                $this->borrarImagen();
            }
            //Redireccionar al usuario;
            header("Location: /admin?resultado=3");
        }
    }

    //Sanitiza los atributos de la clase
    public function sanitizarAtributos(){
        $atributos = $this->atributos();
        $sanitizar = [];
        foreach($atributos as $key => $value){
            $sanitizar[$key] = self::$db->escape_string($value); 
        }
        return $sanitizar;
    }

    //Identificar y unir los atributos de la DB
    public function atributos(){
        $atributos = [];
        foreach(static::$columnasDB as $columna){
            if($columna === "id"){
                continue;
            }
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function validar(){
        static::$errores = []; 
        return static::$errores;
    }

    public static function setDB($database){
        self::$db = $database;
    }

    public static function getErrores(){
        return static::$errores;
    }

    //Subida de archivos
    public function setImagen($imagen){
        //Eliminar imagen previa
        if(!is_null($this->id)){
            $this->borrarImagen();
        }

        if($imagen){
            $this->imagen = $imagen;
        }
    }

    //Borrar Imagen
    public function borrarImagen(){
        //Comprobar si existe el archivo
        $existeArchivo = file_exists(CARPETA_IMG . $this->imagen);
        if($existeArchivo){
            unlink(CARPETA_IMG . $this->imagen);
        }
    }

    public static function consultarSQL($query){
        //Consultar DB
        $resultado = self::$db->query($query);
        $array = [];
        //Iterar los resultados
        while($registro = $resultado->fetch_assoc()){
            $array[] = static::crearObjetos($registro); 
        }
        //Liberar la memoria
        $resultado->free();
        return $array;
    }

    public static function crearObjetos($registro){
        $objeto = new static();
        foreach($registro as $key => $value){
            if(property_exists($objeto, $key)){
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    //Sincronizar el objeto con los cambios realizados
    public function sincronizar($args = []){
        foreach($args as $key => $value){
            if(property_exists($this,$key) && !is_null($value)){
                $this->$key = $value;
            }
        }
    }
}