<?php include "includes/header.php";
/**Consultar la BD con POO y PDO */
$db = new PDO("mysql:host=localhost; dbname=bienesraices_crud","root","root"); //Conectar a la BD con PDO
$query = "SELECT titulo,precio,imagen FROM propiedades"; //Creamos el query
$stmt = $db->prepare($query);//Lo preparamos
$stmt->execute();//Lo ejecutamos
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);//Obtener los resultados
foreach($resultado as $propiedad){ //Iterar
    echo "<br>";
    var_dump($propiedad["titulo"]);
    echo "</br>";
    echo "<br>";
    var_dump($propiedad["precio"]);
    echo "</br>";
    echo "<br>";
    var_dump($propiedad["imagen"]);
    echo "</br>";
    echo "<hr>";
}

include "includes/footer.php";