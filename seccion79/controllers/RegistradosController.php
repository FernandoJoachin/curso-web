<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Paquete;
use Model\Registro;
use Model\Usuario;
use MVC\Router;

class RegistradosController{
    public static function index(Router $router){
        if(!esAdmin()){
            header("Location: /login");
            return;
        }

        $pagina_actual = filter_var($_GET["page"] ?? "", FILTER_VALIDATE_INT);
        if(!$pagina_actual || $pagina_actual < 1){
            header("Location: /admin/registrados?page=1");
        }

        $registros_por_pagina = 5;
        $total_registros = Registro::total();
        $paginacion = new Paginacion($pagina_actual,  $registros_por_pagina, $total_registros);

        if($paginacion->total_paginas() < $pagina_actual){
            header("Location: /admin/registrados?page=1");
            return;
        }

        $registros = Registro::paginar($registros_por_pagina, $paginacion->offset());
        foreach($registros as $registro){
            $registro->usuario = Usuario::find($registro->usuario_id);
            $registro->paquete = Paquete::find($registro->paquete_id);
        }
        
        $router->render("admin/registrados/index",[
            "titulo" => "Usuarios registrados",
            "registrados" => $registros,
            "paginacion" => $paginacion->paginacion()

        ]);
    }
}