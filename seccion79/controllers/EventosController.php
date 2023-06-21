<?php

namespace Controllers;

use Model\Categoria;
use Model\Dia;
use Model\Hora;
use MVC\Router;

class EventosController{
    public static function index(Router $router){
        session_start();
        esAdmin();
        $router->render("admin/eventos/index",[
            "titulo" => "Conferencias y Workshops"

        ]);
    }

    public static function crear(Router $router){
        session_start();
        esAdmin();
        $alertas = [];
        $categorias = Categoria::all();
        $dias = Dia::all("ASC");
        $horas = Hora::all("ASC");
        $router->render("admin/eventos/crear",[
            "titulo" => "Registrar Evento",
            "alertas" => $alertas,
            "categorias" => $categorias,
            "dias" => $dias,
            "horas" => $horas
        ]);
    }

    public static function editar(Router $router){
        session_start();
        esAdmin();
        $router->render("admin/eventos/index",[
            "titulo" => "Conferencias y Workshops"

        ]);
    }

    public static function eliminar(Router $router){
        session_start();
        esAdmin();
        $router->render("admin/eventos/index",[
            "titulo" => "Conferencias y Workshops"

        ]);
    }
}