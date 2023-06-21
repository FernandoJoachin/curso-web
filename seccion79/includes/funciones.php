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
    if(empty($_SESSION) || $_SESSION["admin"] === "0"){
        header("Location: /login");
    }
}