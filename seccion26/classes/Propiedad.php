<?php
namespace App;
class Propiedad{
    //DB
    protected static $db;
    protected static $columnasDB = ["id","titulo","precio","imagen","descripcion","habitaciones","wc","estacionamiento","creado","vendedores_id"];

    //Errores
    protected static $errores = [];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedores_id;

    public function __construct($args = []){
        $this->id = $args["id"] ?? null;   
        $this->titulo = $args["titulo"] ?? "";   
        $this->precio = $args["precio"] ?? "";   
        $this->imagen = $args["imagen"] ?? "";   
        $this->descripcion = $args["descripcion"] ?? "";   
        $this->habitaciones = $args["habitaciones"] ?? "";   
        $this->wc = $args["wc"] ?? "";   
        $this->estacionamiento = $args["estacionamiento"] ?? "";   
        $this->creado = date("Y/m/d");  
        $this->vendedores_id = $args["vendedores_id"] ?? 1;    
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
        $query = "UPDATE propiedades SET {$setInfo}";
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
        $query = "INSERT INTO propiedades ({$keys}) VALUES ('{$values}')";
        $resultado = self::$db->query($query);

        if($resultado){
            //Redireccionar al usuario;
            header("Location: /admin?resultado=1");
        }
    }

    public function eliminar(){
        //Eliminar propiedad
        $query = "DELETE FROM propiedades WHERE id="  . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        if($resultado){
            $this->borrarImagen();
            //Redireccionar al usuario;
            header("Location: /admin?resultado=3");
        }
    }


    public static function setDB($database){
        self::$db = $database;
    }

    //Identificar y unir los atributos de la DB
    public function atributos(){
        $atributos = [];
        foreach(self::$columnasDB as $columna){
            if($columna === "id"){
                continue;
            }
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
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

    public static function getErrores(){
        return self::$errores;
    }

    public function validar(){
        if(!$this->titulo) {
            self::$errores[] = "Debes añadir un titulo";
        }

        if(!$this->precio) {
            self::$errores[] = "El precio es obligatorio";
        }

        if(strlen($this->descripcion) < 50) {
            self::$errores[] = "La descripción es obligatoria y debe tener al menos 50 caracteres";
        }

        if(!$this->habitaciones) {
            self::$errores[] = "El número de habitaciones es obligatorio";
        }
        
        if(!$this->wc) {
            self::$errores[] = "El número de baños es obligatorio";
        }

        if(!$this->estacionamiento) {
            self::$errores[] = "El número de lugares de estacionamiento es obligatorio";
        }
        
        if(!$this->vendedores_id) {
            self::$errores[] = 'Elige un vendedor';
        }

        if(!$this->imagen){
            self::$errores[] = "La imagen es obligatoria";
        }
        
        return self::$errores;
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

    //Lista todo los registro
    public static function all(){
        $query = "SELECT * FROM propiedades";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //Busca un registro
    public static function find($id){
        $query = "SELECT * FROM propiedades WHERE id={$id}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado); //Devuelve el primer elemento del arreglo
    }

    public static function consultarSQL($query){
        //Consultar DB
        $resultado = self::$db->query($query);
        $array = [];
        //Iterar los resultados
        while($registro = $resultado->fetch_assoc()){
            $array[] = self::crearObjetos($registro); 
        }
        //Liberar la memoria
        $resultado->free();
        return $array;
    }

    public static function crearObjetos($registro){
        $objeto = new self();
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