<?php
$db = mysqli_connect("localhost", "root", "root", "appsalon");
if(!$db){
    echo "Error de conexión" . "<br>";
    exit; //Deja de ejecutar las siguiente lineas del archivo
}