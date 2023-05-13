<?php
define("TEMPLATES_URL", __DIR__ ."/template");
define("FUNCIONES_URL", __DIR__ . "funciones.php");
define("CARPETA_IMG", __DIR__ . "/../imagenes/");
function incluirTemplate(string $nombre, bool $inicio = false){
    include TEMPLATES_URL . "/{$nombre}.php";
}

function estaAutenticado() : void {
    session_start();

    if(!$_SESSION["login"]){
        header("Location: /");
    }
}

function debuguear($debug){
    echo "<pre>";
    var_dump($debug);
    echo "</pre>";
    exit;
}

//Escapar/Sanitizar del HTML
function SanitizarHTML($html){
    $sanitizado = htmlspecialchars($html);
    return $sanitizado;
}