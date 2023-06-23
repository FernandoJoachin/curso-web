<?php

namespace Controllers;

use MVC\Router;

class DashboardController{
    public static function index(Router $router){
        if(!esAdmin()){
            header("Location: /login");
            return;
        }

        $router->render("admin/dashboard/index",[
            "titulo" => "Panel de administración"
        ]);
    }
}