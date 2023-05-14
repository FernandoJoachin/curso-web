<?php
namespace MVC;
class Router{
    public $rutasGet = [];
    public $rutasPOST = [];

    public function get($url, $funcion){
        $this->rutasGet[$url] = $funcion;
    }

    public function comprobarRutas(){
        $urlActual = $_SERVER["PATH_INFO"] ?? "/";
        $metodo = $_SERVER["REQUEST_METHOD"];
        if($metodo === "GET"){
            $funcion = $this->rutasGet[$urlActual] ?? null;
        }

        if($funcion){
            call_user_func($funcion,$this); // Llama a una función definida por el usuario
        }else{
            echo "Pagina no encontrada";
        }
    }

    //Muestra una vista
    public function render($view){
        ob_start();//Permite almacenar temporalmente la salida generada por el script en un búfer en lugar de enviarla al navegador o al cliente que realiza la solicitud.
        include __DIR__ . "/view/{$view}.php";
        $contenido = ob_get_clean();//Limpia el buffer
        include __DIR__ . "/view/layout.php";
    }
}