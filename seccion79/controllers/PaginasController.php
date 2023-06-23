<?php

namespace Controllers;

use MVC\Router;
use Model\Evento;
use Model\Categoria;
use Model\Dia;
use Model\Hora;
use Model\Ponente;

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
        $eventos = Evento::ordenar("hora_id", "ASC");
        $eventosFormateados = [];

        foreach($eventos as $evento){
            $evento->categoria = Categoria::find($evento->categoria_id);
            $evento->dia = Dia::find($evento->dia_id);
            $evento->hora = Hora::find($evento->hora_id);
            $evento->ponente = Ponente::find($evento->ponente_id);

            if($evento->dia_id === "1" && $evento->categoria_id === "1"){
                $evento_formateados["conferencias_v"][] = $evento;
            }
            if($evento->dia_id === "2" && $evento->categoria_id === "1"){
                $evento_formateados["conferencias_s"][] = $evento;
            }

            if($evento->dia_id === "1" && $evento->categoria_id === "2"){
                $evento_formateados["workshops_v"][] = $evento;
            }
            if($evento->dia_id === "2" && $evento->categoria_id === "2"){
                $evento_formateados["workshops_s"][] = $evento;
            }
        }

        $router->render("paginas/conferencias",[
            "titulo" => "Conferencias & Workshops",
            "eventos" => $evento_formateados
        ]);
    }
}