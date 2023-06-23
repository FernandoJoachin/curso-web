<?php

namespace Controllers;

use MVC\Router;

class PaginasController{
    public static function index(Router $router){
        $router->render("paginas/index",[
            "titulo" => "Inicio"

        ]);
    }

    public static function evento(Router $router){
        $router->render("paginas/devwebcamp",[
            "titulo" => "Sobre DevWebcamp"

        ]);
    }

    public static function paquetes(Router $router){
        $router->render("paginas/paquetes",[
            "titulo" => "Paquetes DevWebcamp"

        ]);
    }

    public static function conferencias(Router $router){
        $router->render("paginas/conferencias",[
            "titulo" => "Conferencias & Workshops"

        ]);
    }
}