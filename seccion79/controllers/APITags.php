<?php

namespace Controllers;

use Model\Tags;

class APITags{
    public static function index(){
        if(!esAdmin()){
            echo json_encode([]);
            return;
        }
        
        $tags = Tags::all();
        header('Content-Type: application/json');
        echo json_encode($tags, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}