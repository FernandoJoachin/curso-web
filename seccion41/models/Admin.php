<?php
namespace Model;

class Admin extends ActiveRecord{
    protected static $tabla = "usuarios";
    protected static $columnasDB = ["id","email","password"];

    public $id;
    public $email; //correo@correo.com
    public $password; //123456

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->email = $args["email"] ?? "";
        $this->password = $args["password"] ?? "";
    }

    public function validar(){
        if(!$this->email) {
            self::$errores[] = "El email es obligatorio";
        }

        if(!$this->password) {
            self::$errores[] = "El password es obligatorio";
        }

        return self::$errores;
    }

    public function comprobarUsuario(){
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
        $resultado = self::$db->query($query);
        if(!$resultado->num_rows){
            self::$errores[] = "El usuario no existe";
            return false;
        }
        return $resultado;
    }

    
    public function comprobarPassWord($resultado){
        $usuario = $resultado->fetch_object();
        $autenticado = password_verify($this->password, $usuario->password); //Checa si un password hasheado es el mismo que el password dado 
        if(!$autenticado){
            self::$errores[] = "El password es incorrecto"; 
        }
        return$autenticado;
    }

    public function autenticar(){
        session_start();// Inicia una sesión nueva o se reanuda una sesión existente para el usuario actual. Una vez llamada, se pueden utilizar las variables de sesión para almacenar y recuperar datos específicos del usuario

        //Llenar el arreglo de session
        $_SESSION["usuario"] = $this->email;
        $_SESSION["login"] = true;

        header("Location: /public/admin");
    }
}