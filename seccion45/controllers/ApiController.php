<?php
namespace Controllers;

use Model\Servicio;
use Model\Cita;
use Model\CitaServicio;
use MVC\Router;

class ApiController{
    public static function index(){
        $servicios = Servicio::all();
        header('Content-Type: application/json');
        echo json_encode($servicios, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    public static function guardar(){
        //Almacena la cita y devuelve el id
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();
        $id = $resultado["id"];

        //Almacena la cita y el servicio
        $servicios_id = explode(",", $_POST["servicios"]);
        foreach($servicios_id as $servicio_id){
            $args = [
                "cita_id" => $id,
                "servicio_id" => $servicio_id
            ];
            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }
     
        echo json_encode(["resultado" => $resultado], JSON_UNESCAPED_UNICODE);
    }
}