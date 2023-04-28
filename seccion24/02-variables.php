<?php include 'includes/header.php';
$nombre = "Fernando"; //Definir una variable
$_apellido = "Joachin"; //Se acepta el guión bajo como primer carácter del nombre del identificador
echo $nombre;
$nombre = "Roberto";
echo $nombre;
var_dump($_apellido);

define("constante", "El valor de la constante"); //Definir una constante
echo constante; //Imprimir una constante
var_dump(constante);

const nueva_variable = "Valor";//Otra forma de definir variables pero poco común
echo nueva_variable;
include 'includes/footer.php';