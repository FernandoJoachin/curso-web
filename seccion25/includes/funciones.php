<?php
function obtenerServicios() : array {

    try{
        //Importar servicios
        require "includes/database.php";
        //Escribir el codigo SQL
        $sql = "SELECT * FROM servicios";
        $consulta = mysqli_query($db, $sql);
        //Arreglo vacio
        $servicios = [];
        //Obtener los resultados
        $i = 0;
        while($row = mysqli_fetch_assoc($consulta)){
            $servicios[$i]["id"] = $row["id"];
            $servicios[$i]["nombre"] = $row["nombre"];
            $servicios[$i]["precio"] = $row["precio"];
            $i++;
        }
        return $servicios;

    }catch(\Throwable $th){
        header('Content-Type: application/json');
        echo json_encode($th);
        exit;
    }
}
