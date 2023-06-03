<?php
namespace Controllers;

use Model\Servicio;
use MVC\Router;

class ApiController{
    public static function index(){
        $servicios = Servicio::all();
        header('Content-Type: application/json');
        echo json_encode($servicios, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}