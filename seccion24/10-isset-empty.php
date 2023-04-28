<?php include 'includes/header.php';
$clientes1 = [];
$clientes2 = array();
$clientes3 = array("Pedro", "Fer", "Karen");
$cliente = [
    "nombre" => "Fernando",
    "saldo" => 200
];

// Empty - Revisa si un arreglo esta vacio
var_dump(empty($clientes1));
var_dump(empty($clientes2));
var_dump(empty($clientes3));
echo "<br>";

// Isset - Revisar si un arreglo esta creado o una propiedad esta definida
var_dump(isset($clientes1));
var_dump(isset($clientes2));
var_dump(isset($clientes3) );
var_dump(isset($clientes4));
echo "<br>";

// Isset - Permite revisar si una propiedad de un arreglo asociativo, existe!
var_dump(isset($cliente["nombre"]));
var_dump(isset($cliente["codigo"]));
include 'includes/footer.php';