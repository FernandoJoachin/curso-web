<?php
namespace MVC;
class Router{
    public $rutasGet = [];
    public $rutasPOST = [];
    protected static $rutasProtegidas = ["/admin","/propiedades/crear","/propiedades/actualizar","/propiedades/eliminar","/vendedores/crear","/vendedores/actualizar","/vendedores/eliminar"];

    public function get($url, $funcion){
        $this->rutasGet[$url] = $funcion;
    }

    public function post($url, $funcion){
        $this->rutasPOST[$url] = $funcion;
    }

    public function comprobarRutas(){
        session_start();
        $auth = $_SESSION["login"] ?? false;
        $urlActual = $_SERVER["PATH_INFO"] ?? "/";
        $metodo = $_SERVER["REQUEST_METHOD"];

        if($metodo === "GET"){
            $funcion = $this->rutasGet[$urlActual] ?? null;
        }else{
            $funcion = $this->rutasPOST[$urlActual] ?? null;
        }

        if(in_array($urlActual, self::$rutasProtegidas) && !$auth){
            header("Location: /public");
        }

        if($funcion){
            call_user_func($funcion,$this); // Llama a una función definida por el usuario
        }else{
            echo "Pagina no encontrada";
        }
    }

    //Muestra una vista
    public function render($view, $datos=[]){
        foreach($datos as $key => $value){
            $$key = $value;
        }
        ob_start();//Permite almacenar temporalmente la salida generada por el script en un búfer en lugar de enviarla al navegador o al cliente que realiza la solicitud.
        include __DIR__ . "/view/{$view}.php";
        $contenido = ob_get_clean();//Limpia el buffer
        include __DIR__ . "/view/layout.php";
    }
}