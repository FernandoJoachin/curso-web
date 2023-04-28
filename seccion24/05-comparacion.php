<?php include 'includes/header.php';
$numero1 = "30";
$numero2 = 30;
$numero3 = 20;
$numero4 = 20;

var_dump($numero2 < $numero3);
echo "<br>";

var_dump($numero2 > $numero3);
echo "<br>";

var_dump($numero3 <= $numero4);
echo "<br>";

var_dump($numero1 == $numero2);
echo "<br>";

var_dump($numero1 === $numero2);
echo "<br>";

//-1 si el primer elemento es menor, 0 si son igulaes y 1 si el primer elemento es mayor
var_dump($numero3 <=> $numero2);
echo "<br>";
var_dump($numero4 <=> $numero3);
echo "<br>";
var_dump($numero2 <=> $numero3);
echo "<br>";
include 'includes/footer.php';