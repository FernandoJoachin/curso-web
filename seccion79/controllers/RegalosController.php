<?php

namespace Controllers;

use MVC\Router;

class RegalosController{
    public static function index(Router $router){
        if(!esAdmin()){
            header("Location: /login");
            return;
        }
        $router->render("admin/regalos/index",[
            "titulo" => "Regalos"

        ]);
    }
}