<?php include 'includes/header.php';
$nombreCliente = "Roberto Fernando ";

//Extension de un String
echo strlen($nombreCliente);
echo "<br>";
var_dump($nombreCliente);
echo "<br>";

//Eliminar espacios
$texto = trim($nombreCliente); //Solo eliminas espacios al final o al comienzo del string
echo strlen($texto);
echo "<br>";

//Convertir en String en mayusculas
echo strtoupper($nombreCliente);
echo "<br>";

//Convertir el string en minusculas
echo strtolower($nombreCliente);
echo "<br>";

//Reemplazar carácteres en un String
echo str_replace(" ", "%", $nombreCliente);
echo "<br>";

//Revisar si existe un String
echo strpos($nombreCliente, "Fernando"); //Te da la posicion en donde se encuentra
echo strpos($nombreCliente, "Carlos"); //Si no lo encuentra no imprime nada
echo "<br>";

//Concatenar
$tipoCliente = "Premium";
echo "El cliente " . $nombreCliente . "es " . $tipoCliente;
echo "<br>";
echo "El cliente {$nombreCliente} es {$tipoCliente}";
include 'includes/footer.php';