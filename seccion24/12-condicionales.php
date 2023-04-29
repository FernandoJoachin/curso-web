<?php include 'includes/header.php';
$autenticado = true;
$admin = false;

if($autenticado && $admin ) {
    echo "Usuario autenticado correctamente";
} else {
    echo "Usuario no autenticado, inicia sesión";
}
echo "<br>";

if($autenticado || $admin) {
    echo "Usuario2 autenticado correctamente";
} else {
    echo "Usuario2 no autenticado, inicia sesión";
}
echo "<br>";

//If anidados
$cliente = [
    "nombre" => "Fer",
    "saldo" => 320,
    "informacion" => [
        "tipo" => "Premium"
    ]
];

if(!empty($cliente)) {
    echo "El arreglo de cliente no esta vacio";
    echo "<br>";

    if($cliente["saldo"] > 0) {
        echo "El cliente tiene saldo disponible";
    } else {
        echo "No hay saldo";
    }
}
echo "<br>";

//Else if
if($cliente["saldo"] > 0 ) {
    echo "El cliente tiene saldo";
} else if ($cliente["informacion"]["tipo"] === 'Premium') {
    echo "El cliente es Premium";
} else {
    echo "No hay cliente definido o no tiene saldo o no es Premium";
}
echo "<br>";

//Switch
$tecnologia = 'HTML';
switch ($tecnologia) {
    case "PHP":
        echo "PHP, un excelente lenguaje!";
        break;
    case "C":
        echo "C, el padre de los lenguajes";
        break;
    case 'HTML':
        echo 'HTML, no es un lenguaje';
        break;
    default:
        echo "Lenguaje no encontrado";
        break;
}
include 'includes/footer.php';