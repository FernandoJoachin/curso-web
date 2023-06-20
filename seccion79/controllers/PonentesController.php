<?php

namespace Controllers;

use MVC\Router;

class PonentesController{
    public static function index(Router $router){
        esAdmin();
        $router->render("admin/ponentes/index",[
            "titulo" => "Ponentes / Conferencias"
        ]);
    }

    public static function crear(Router $router){
        esAdmin();
        $alertas = [];
        $router->render("admin/ponentes/crear",[
            "titulo" => "Registrar Ponente",
            "alertas" =>$alertas
        ]);
    }
}