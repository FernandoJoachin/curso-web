<?php

namespace Controllers;

use MVC\Router;

class RegistradosController{
    public static function index(Router $router){
        if(!esAdmin()){
            header("Location: /login");
            return;
        }
        $router->render("admin/registrados/index",[
            "titulo" => "Usuarios registrados"

        ]);
    }
}