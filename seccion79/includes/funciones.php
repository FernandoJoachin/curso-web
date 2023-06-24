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
    return str_contains($_SERVER["PATH_INFO"] ?? "/", $path) ? true : false;
}

function esAdmin(){
    if(!isset($_SESSION)) {
        session_start();
    }
    return isset($_SESSION['admin']) && !empty($_SESSION['admin']);
}

function esta_Autenticado(){
    if(!isset($_SESSION)) {
        session_start();
    }
    return isset($_SESSION["nombre"]) && !empty($_SESSION);
}

function aos_animacion(){
    $efectos = ["fade-up", "fade-down", "fade-up-right", "fade-up-left", "fade-down-left", "fade-down-right", "flip-left", "flip-right", "flip-down", "flip-up", "zoom-in", "zoom-in-up", "zoom-in-down", "zoom-out"];
    $tipoEfecto = array_rand($efectos, 1);
    echo ' data-aos="' . $efectos[$tipoEfecto] . '" ';
}