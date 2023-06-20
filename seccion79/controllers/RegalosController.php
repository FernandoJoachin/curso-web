<?php

namespace Controllers;

use MVC\Router;

class RegalosController{
    public static function index(Router $router){
        session_start();
        esAdmin();
        $router->render("admin/regalos/index",[
            "titulo" => "Regalos"

        ]);
    }
}