<?php include 'includes/header.php';
$productos = [
    [
        "nombre" => "Tablet", 
        "precio" => 200,
        "disponible" => true
    ],
    [
        "nombre" => "Television 24", 
        "precio" => 300,
        "disponible" => true
    ],
    [
        "nombre" => "Monitor Curvo", 
        "precio" => 400,
        "disponible" => false
    ]
];

foreach($productos as $producto){
    ?>
    <li>
        <p>
            <?php echo "El producto es: " . $producto["nombre"]; ?>
        </p>
        <p>
            <?php echo "El precio es: $" . $producto["precio"]; ?>
        </p>
        <p>
            <?php echo ($producto["disponible"]) ? "Disponible" : "No Disponible"; ?>
        </p>
    </li> 
    <?php
}
include 'includes/footer.php';