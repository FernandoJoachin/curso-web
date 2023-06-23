<?php

namespace Controllers;

use Model\Ponente;

class APIPonentes{
    public static function index(){
        $ponentes = Ponente::all();
        header('Content-Type: application/json');
        echo json_encode($ponentes, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    public static function ponente(){
        $id = filter_var($_GET["id"] ?? "", FILTER_VALIDATE_INT);

        if(!$id || $id < 1){
            echo json_encode([]);
            return;
        }

        $ponente = Ponente::find($id);
        header('Content-Type: application/json');
        echo json_encode($ponente, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

    }
}