<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function pagina_actual($path){
    return str_contains($_SERVER["PATH_INFO"], $path) ? true : false;
}

function esAdmin(){
    if(!isset($_SESSION["admin"])){
        header("Location: /");
    }
}