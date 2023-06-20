<?php

namespace Controllers;

use MVC\Router;

class RegistradosController{
    public static function index(Router $router){
        esAdmin();
        $router->render("admin/registrados/index",[
            "titulo" => "Usuarios registrados"

        ]);
    }
}