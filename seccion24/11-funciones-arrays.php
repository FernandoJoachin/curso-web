<?php include 'includes/header.php';
//in_array - busca elementos en un arreglo
$carrito = ["Tablet","Xbox","Computadora"];

var_dump(in_array("Tablet", $carrito));
var_dump(in_array("Computadora", $carrito));

//Ordenar elementos de un arreglo
$numeros = array(1,4,2,75,9);
sort($numeros); //de menor a mayor
rsort($numeros); //de mayor a menor

echo "<pre>";
var_dump($numeros);
echo "</pre>";

//Ordenar arreglo asociativo
$clientes = array(
    "saldo" => 230,
    "saldo-impuesto" => 167,
    "tipo" => "Premium",
    "nombre" => "Fernando"
);

echo "<pre>";
var_dump($clientes);
echo "</pre>";

asort($clientes); //Ordena por valores(orden alfabetico)
arsort($clientes); //Ordena por valores de forma inversa al orden alfabetico
ksort($clientes); //Ordena por llaves(orden alfabetico);
krsort($clientes); //Ordena por llaves de forma inversa al orden alfabetico

echo "<pre>";
var_dump($clientes);
echo "</pre>";
include 'includes/footer.php';