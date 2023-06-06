<?php //Proporcionado en el curso

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

//Revisa si el usuario esta autenticado
function estaAutenticado(){
    if(!isset($_SESSION["login"])){
        header("Location: /");
    }
}