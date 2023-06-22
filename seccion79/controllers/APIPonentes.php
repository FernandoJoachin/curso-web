<?php

namespace Controllers;

use Model\Ponente;

class APIPonentes{
    public static function index(){
        $ponentes = Ponente::all();
        header('Content-Type: application/json');
        echo json_encode($ponentes, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}