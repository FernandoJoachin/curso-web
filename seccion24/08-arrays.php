<?php include 'includes/header.php';
//Formas de definir un array
$carrito = ["Tablet", "Television", "Computadora"];
$clientes = array("Cliente1, Cliente2, Cliente3 ");

//Util para ver los contenidos de un array
echo "<pre>";
var_dump($carrito);
echo "<pre>";

//Acceder a un elemento de un array
echo $carrito[1];

//Añade un elemento en el indice indicado (solo sirve si conozco la extensión)
$carrito[3] = "Nuevo producto";

//Añade un nuevo elemento al final del arreglo
array_push($carrito,"Audifonos");

//Añade un nuevo elemento al principio del arreglo
array_unshift($carrito, "Smartwach");

echo "<pre>";
var_dump($carrito);
echo "<pre>";
include 'includes/footer.php';