<?php include 'includes/header.php';
$cliente = [
    "nombre" => "Fernando", 
    "saldo" => 200,
    "informacion" => [
        "tipo" => "premium", 
        "disponible" => 100
    ]
];

//Acceder a un elemento de un array asociativo
echo "<pre>";
var_dump($cliente["nombre"]);
echo "</pre>";

echo "<pre>";
var_dump($cliente["informacion"]["tipo"]);
echo "</pre>";

//Agregar o cambiar la información de un elemento
$cliente["nombre"] = "Roberto";
$cliente['codigo'] = 1209192012;
echo "<pre>";
var_dump($cliente);
echo "</pre>";
include 'includes/footer.php';