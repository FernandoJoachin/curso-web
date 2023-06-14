<?php
namespace Model;

class Usuario extends ActiveRecord{
    protected static $tabla = "usuarios";
    protected static $columnasDB = ["id","nombre", "email", "password", "token", "confirmado"];

    public $id;
    public $nombre;
    public $email;
    public $password;
    public $repetirPassword;
    public $token;
    public $confirmado;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->nombre = $args["nombre"] ?? "";
        $this->email = $args["email"] ?? "";
        $this->password = $args["password"] ?? "";
        $this->repetirPassword = $args["repetirPassword"] ?? "";
        $this->token = $args["token"] ?? "";
        $this->confirmado = $args["confirmado"] ?? 0;
    }

    public function validarLogin(){
        if(!$this->email){
            self::$alertas["error"][] = "El email es obligatorio";
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alertas["error"][] = "El email no es válido";
        }
        if(!$this->password){
            self::$alertas["error"][] = "El password es obligatorio";
        }
        return self::$alertas;
    }

    public function validarNuevaCuenta(){
        if(!$this->nombre){
            self::$alertas["error"][] = "El nombre es obligatorio";
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

        if($this->password !== $this->repetirPassword){
            self::$alertas["error"][] = "Los password son diferentes";
        }
        return self::$alertas;
    }

    public function validarEmail(){
        if(!$this->email){
            self::$alertas["error"][] = "El email es obligatorio";
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alertas["error"][] = "El email no es válido";
        }
        return self::$alertas;
    }

    public function validarPassword(){
        if(!$this->password){
            self::$alertas["error"][] = "El password es obligatorio";
        }
        if($this->password){
            if(strlen($this->password) < 6){
                self::$alertas["error"][] = "El password es vulnerable";
                self::$alertas["error"][] = "Debe tener una extension mayor a 6 carácteres";
            }
        }

        if($this->password !== $this->repetirPassword){
            self::$alertas["error"][] = "Los password son diferentes";
        }
        return self::$alertas;
    }

    public function validarPerfil(){
        if(!$this->nombre){
            self::$alertas["error"][] = "El nombre es obligatorio";
        }
        if(!$this->email){
            self::$alertas["error"][] = "El email es obligatorio";
        }
        return self::$alertas;
    }

    public function hashearPassword(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken(){
        $this->token = uniqid();
    }

    public function comprobarPassword($password){
        $resultado = password_verify($password,$this->password);
        if(!$resultado){
            self::$alertas["error"][] = "Tu password es incorrecto";
            return false;
        }else{
            return true;
        }
    }
}