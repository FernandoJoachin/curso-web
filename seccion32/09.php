<?php include "includes/header.php";
/**Consultar la BD con POO y MySQLi */
$db = new mysqli("localhost", "root", "root", "bienesraices_crud"); //Conectar a la BD con MySQLi
$query = "SELECT titulo,precio,imagen FROM propiedades"; //Creamos el query
/**Metodo normal */
// $resultado = $db->query($query);
// while($row = $resultado->fetch_assoc()){
//     echo "<br>";
//     var_dump($row);
//     echo "</br>";
// }

/**Metodo con sentencias preparadas - Mejor en cuestion de seguridad y performan */
$stmt = $db->prepare($query);//Lo preparamos
$stmt->execute();//Lo ejecutamos
$stmt->bind_result($titulo,$precio,$img);//Creamos la variable

while($stmt->fetch()){ //Asignamos el resultado
    echo "<br>";
    var_dump($titulo);
    echo "</br>";
    echo "<br>";
    var_dump($precio);
    echo "</br>";
    echo "<br>";
    var_dump($img);
    echo "</br>";
    echo "<hr>";
}
include "includes/footer.php";