<?php include 'includes/header.php';
$productos = [
    [
        "nombre" => "Tablet", 
        "precio" => 200,
        "disponible" => true
    ],
    [
        "nombre" => "Televisión 24", 
        "precio" => 300,
        "disponible" => true
    ],
    [
        "nombre" => "Monitor Curvo", 
        "precio" => 400,
        "disponible" => false
    ]
];

echo "<pre>";
var_dump($productos);
echo "</pre>";

//json_encode - convierte un arreglo a un string
$json = json_encode($productos, JSON_UNESCAPED_UNICODE); //JSON_UNESCAPED_UNICODE - Permite que se acepten los acentos
echo "<pre>";
var_dump($json);
echo "</pre>";

//json_decode - convierte un string a un arreglo
$json_array = json_decode($json);
echo "<pre>";
var_dump($json_array);
echo "</pre>";
include 'includes/footer.php';