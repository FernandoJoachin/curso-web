<?php
namespace Model;

class Usuario extends ActiveRecord{
    //DB
    protected static $tabla = "usuarios";
    protected static $columnaDB = ["id","nombre","apellido","email","password","telefono","admin","confirmado","token"];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->nombre = $args["nombre"] ?? "";
        $this->apellido = $args["apellido"] ?? "";
        $this->email = $args["email"] ?? "";
        $this->password = $args["password"] ?? "";
        $this->telefono = $args["telefono"] ?? "";
        $this->admin = $args["admin"] ?? null;
        $this->confirmado = $args["confirmado"] ?? null;
        $this->token = $args["token"] ?? "";
    }

    public function validarNuevaCuenta(){
        if(!$this->nombre){
            self::$alertas["error"][] = "El nombre es obligatorio";
        }
        if(!$this->apellido){
            self::$alertas["error"][] = "El apellido es obligatorio";
        }
        if(!$this->telefono){
            self::$alertas["error"][] = "El telefono es obligatorio";
        }
        if(!$this->email){
            self::$alertas["error"][] = "El email es obligatorio";
        }
        if(!$this->password){
            self::$alertas["error"][] = "El password es obligatorio";
        }
        if($this->password){
            if(strlen($this->password) < 6){
                self::$alertas["error"][] = "El password es vulnerable";
                self::$alertas["error"][] = "Debe tener una extension mayor a 6 carácteres";
            }
        }

        return self::$alertas;
    }

    public function comprobarExisteUsuario(){
        $query = "SELECT * FROM " . self::$tabla ." WHERE email = '" . $this->email . "' LIMIT 1";
        $resultado = self::$db->query($query);
        if($resultado->num_rows){
            self::$alertas["error"][] = "El usuario ya existe";
        }else{
            echo "No esta registrado";
        }
        return $resultado;
    }
}
