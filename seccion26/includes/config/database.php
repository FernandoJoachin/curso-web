<?php

function conectarDB() : mysqli{
    $db = new mysqli("localhost", "root", "root", "bienesraices_crud");
    mysqli_set_charset($db, "utf8");
    if(!$db){
        echo "No se pudo conectar";
        exit;
    }

    return $db;
}