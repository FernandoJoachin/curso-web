<?php

namespace Controllers;

use Model\Evento;
use Model\Registro;
use Model\Usuario;
use MVC\Router;

class DashboardController{
    public static function index(Router $router){
        if(!esAdmin()){
            header("Location: /login");
            return;
        }

        //Obtener los últimos registros
        $registros = Registro::get(5);
        foreach($registros as $registro){
            $registro->usuario = Usuario::find($registro->usuario_id);
        }

        //Calcular ingresos
        $virtuales = Registro::total("paquete_id",2);
        $presenciales = Registro::total("paquete_id",1);
        $ingresos = ($virtuales * 46.41) + ($presenciales * 189.54);

        //Obtener eventos com más y menos lugares disponibles
        $mayor_disponibles = Evento::ordenarLimite("disponibles", "ASC", 5);
        $menor_disponibles = Evento::ordenarLimite("disponibles", "DESC", 5);

        $router->render("admin/dashboard/index",[
            "titulo" => "Panel de administración",
            "registros" => $registros,
            "ingresos" => $ingresos,
            "mayor_disponibles" => $mayor_disponibles,
            "menor_disponibles" => $menor_disponibles
        ]);
    }
}