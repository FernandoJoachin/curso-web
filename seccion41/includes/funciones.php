<?php
define("TEMPLATES_URL", __DIR__ ."/template");
define("FUNCIONES_URL", __DIR__ . "funciones.php");
define("CARPETA_IMG", $_SERVER["DOCUMENT_ROOT"] . "/imagenes/");
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

//Validar contenido
function validarTipoContenido($tipo){
    $tipos = ["vendedor","propiedad"];
    return in_array($tipo,$tipos);
}

//Mostrar mensaje
function mostrarNotificacion($codigo){
    $mensaje = "";
    switch ($codigo) {
        case 1:
            $mensaje = "Creado correctamente";
            break;
        case 2:
            $mensaje = "Actualizado correctamente";
            break;
        case 3:
            $mensaje = "Eliminado correctamente";
            break;
        default:
            $mensaje = false;
            break;
    }
    
    return $mensaje;
}

function validar_o_Redireccionar(String $url){
    //Validar la URL por un ID válido
    $id = $_GET["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if(!$id) {
        header("Location: {$url}");
    }

    return $id;
}
