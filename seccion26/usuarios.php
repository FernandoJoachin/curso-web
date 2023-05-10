<?php
//Importar la base de datos
require "includes/app.php";
$db = conectarDB();
//Crear email y password
$email = "correo@correo.com";
$password = "123456";
$passwordHash = password_hash($password, PASSWORD_BCRYPT);
//Query para crear el usuario
$query = "INSERT INTO usuarios (email,password) VALUES ('{$email}','{$passwordHash}')";
//echo $query;
//Agregar a la base de datos
mysqli_query($db,$query);