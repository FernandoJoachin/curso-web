<?php
$db = mysqli_connect("localhost", "root", "root", "appsalon");
//$db = mysqli_connect('localhost', 'root', '', 'appsalonjoachin');   FOR ADMINS TESTS
mysqli_set_charset($db, "utf8");
if(!$db){
    echo "Error de conexión" . "<br>";
    exit; //Deja de ejecutar las siguiente lineas del archivo
}