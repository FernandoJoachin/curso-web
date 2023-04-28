<?php
declare(strict_types = 1);
include 'includes/header.php';
function sumar(int $numero1 = 0, int $numero2 = 0 ) {
    echo $numero1 - $numero2 . "<br>";
}

sumar(10);
sumar(10,2);
sumar(numero2 : 10, numero1 : 3);
include 'includes/footer.php';