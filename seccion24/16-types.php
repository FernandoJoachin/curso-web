<?php 
declare(strict_types=1);
include 'includes/header.php';

function usuarioAutenticado(bool $autenticado) : void {
    if($autenticado) {
        echo "El Usuario esta autenticado";
    } else {
        echo "El usuario no esta autenticado";
    }
}

function usuarioAutenticado1(bool $autenticado) : string {
    if($autenticado) {
        return "El Usuario esta autenticado";
    } else {
        return "El usuario no esta autenticado";
    }
}

function usuarioAutenticado2(bool $autenticado) : ?string {
    if($autenticado) {
        return "El Usuario esta autenticado";
    } else {
        return null;
    }
}

function usuarioAutenticado3(bool $autenticado) : string|int {
    if($autenticado) {
        return "El Usuario esta autenticado";
    } else {
        return 10;
    }
}

usuarioAutenticado(true);
echo "<br>";

$usuario = usuarioAutenticado1(false);
echo $usuario;
echo "<br>";

$usuario = usuarioAutenticado2(false);
echo $usuario;
echo "<br>";

$usuario = usuarioAutenticado3(false);
echo $usuario;
echo "<br>";
include 'includes/footer.php';