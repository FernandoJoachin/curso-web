<?php include 'includes/header.php';
//While
$i = 0; // Inicializador
while($i < 10) {
    echo $i . "<br>";
    $i++; // Incremento
}
echo "<br>";

//Do While
$i = 0;
do {
    echo $i . "<br>";
    $i++;
} while($i < 10);
echo "<br>";

//For
for($i = 0; $i < 10; $i++){
    echo $i . "<br>";
}
echo "<br>";

/**
 * 3 imprimir Fizz
 * 5 imprimir Buzz
 * 3 y 5 Imprimir Fizz Buzz
 */

for($i = 1; $i < 20; $i++){
    if(($i % 3 === 0) && ($i % 5 === 0)){
        echo $i . "- Fizz Buzz" . "<br>";
    }else if ($i % 3 === 0){
        echo $i . "- Fizz" . "<br>";
    } else if ($i % 5 === 0){
        echo $i . "- Buzz" . "<br>";
    }
}
echo "<br>";

// For Each
$clientes = array("Fernando", "Roberto", "Carlos");

foreach( $clientes as $cliente ){
    echo $cliente . '<br/>';
}
echo "<br>";

$cliente = [
    "nombre" => "Fer",
    "saldo" => 100,
    "tipo" => "Regular"
];

foreach( $cliente as $key => $valor ){
    echo $key . " - " . $valor . '<br/>';
}
echo "<br>";

//Otra forma de escribir los Loops y los if
$valor = 1;
if($valor == 3):
    echo "Es 3";
elseif($valor == 2):
    echo "Es 2";
else:
    echo "Es un número diferente de 3 y 2";
endif;
echo "<br>";

$i = 0;
while($i < 3) :
    echo $i . "<br>";
    $i++;
endwhile;
echo "<br>";

for($i = 0; $i < 3; $i++):
    echo $i . "<br>";
endfor;
echo "<br>";

$clientes = array("Nando", "Robert", "Carlos");

foreach( $clientes as $cliente ):
    echo $cliente . '<br/>';
endforeach;
echo "<br>";
include 'includes/footer.php';