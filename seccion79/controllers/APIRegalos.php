<?php

namespace Controllers;

use Model\EventoHorario;
use Model\Regalo;
use Model\Registro;

class APIRegalos{
    public static function index(){
        if(!esAdmin()){
            echo json_encode([]);
            return;
        }

        $regalos = Regalo::all();
        foreach($regalos as $regalo){
            $regalo->total = Registro::totalArgs(["regalo_id" => $regalo->id, "paquete_id" => "1"]); 
        }

        header('Content-Type: application/json');
        echo json_encode($regalos, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        return;
    }
}