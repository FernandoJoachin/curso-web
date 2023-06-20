<?php

namespace Controllers;

use MVC\Router;

class EventosController{
    public static function index(Router $router){
        session_start();
        esAdmin();
        $router->render("admin/eventos/index",[
            "titulo" => "Conferencias y Workshops"

        ]);
    }
}