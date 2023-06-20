<?php

namespace Controllers;

use MVC\Router;

class DashboardController{
    public static function index(Router $router){
        session_start();
        esAdmin();

        $router->render("admin/dashboard/index",[
            "titulo" => "Panel de administración"
        ]);
    }
}