<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Categoria;
use Model\Dia;
use Model\Evento;
use Model\Hora;
use Model\Ponente;
use MVC\Router;

class EventosController{
    public static function index(Router $router){
        session_start();
        esAdmin();

        $pagina_actual = filter_var($_GET["page"] ?? "", FILTER_VALIDATE_INT);
        if(!$pagina_actual || $pagina_actual < 1){
            header("Location: /admin/eventos?page=1");
        }

        $registros_por_pagina = 5;
        $total_registros = Evento::total();
        $paginacion = new Paginacion($pagina_actual,  $registros_por_pagina, $total_registros);

        if($paginacion->total_paginas() < $pagina_actual){
            header("Location: /admin/eventos?page=1");
        }

        $eventos = Evento::paginar($registros_por_pagina, $paginacion->offset());
        foreach($eventos as $evento){
            $evento->categoria = Categoria::find($evento->categoria_id);
            $evento->dia = Dia::find($evento->dia_id);
            $evento->hora = Hora::find($evento->hora_id);
            $evento->ponente = Ponente::find($evento->ponente_id);
        }
        $router->render("admin/eventos/index",[
            "titulo" => "Conferencias y Workshops",
            "eventos" => $eventos,
            "paginacion" => $paginacion->paginacion()

        ]);
    }

    public static function crear(Router $router){
        session_start();
        esAdmin();

        $alertas = [];
        $categorias = Categoria::all("ASC");
        $dias = Dia::all("ASC");
        $horas = Hora::all("ASC");
        $evento = new Evento();

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $evento->sincronizar($_POST);
            $alertas = $evento->validar();
            if(empty($alertas)){
                $resultado = $evento->guardar();
                if($resultado){
                    header("Location: /admin/eventos?page=1");
                }
            }
        }

        $router->render("admin/eventos/crear",[
            "titulo" => "Registrar Evento",
            "alertas" => $alertas,
            "categorias" => $categorias,
            "dias" => $dias,
            "horas" => $horas,
            "evento" => $evento
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