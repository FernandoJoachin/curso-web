<?php
namespace Controllers;

use Model\Proyecto;
use Model\Tarea;

class TareaController{
    public static function index(){
        $proyecto_url = $_GET["id"];
        if(!$proyecto_url){
            header("Location: /dashboard");
            exit;
        }

        $proyecto = Proyecto::where("url", $proyecto_url);
        session_start();
        if(!$proyecto || $proyecto->usuario_id !== $_SESSION["id"]){
            header("Location: /404");
            exit;
        }

        $tareas = Tarea::belongsTo("proyecto_id", $proyecto->id);
        header('Content-Type: application/json');
        echo json_encode(["tareas" => $tareas], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    public static function crear(){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            session_start();
            $proyecto_url = $_POST["url"];
            $proyecto = Proyecto::where("url", $proyecto_url);
            if(!$proyecto || $proyecto->usuario_id !== $_SESSION["id"]){
                $respuesta = [
                    "tipo" => "error",
                    "mensaje" => "Oopps. Hubo un error al agregar la tarea"
                ];
                echo json_encode($respuesta);
                return;
            }

            $tarea = new Tarea($_POST);
            $tarea->proyecto_id = $proyecto->id;
            $resultado = $tarea->guardar();
            $respuesta = [
                "tipo" => "exito",
                "id" => $resultado["id"],
                "mensaje" => "Tarea creada correctamente",
                "proyecto_id" => $proyecto->id
            ];
            echo json_encode($respuesta);
        }
    }

    public static function actualizar(){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $proyecto_url = $_POST["url"];
            $proyecto = Proyecto::where("url", $proyecto_url);

            session_start();
            if(!$proyecto || $proyecto->usuario_id !== $_SESSION["id"]) {
                $respuesta = [
                    "tipo" => "error",
                    "mensaje" => "Oopps. Hubo un error al actualizar la tarea"
                ];
                echo json_encode($respuesta);
                return;
            }

            $tarea = new Tarea($_POST);
            $tarea->proyecto_id = $proyecto->id;
            $resultado = $tarea->guardar();
            if($resultado){
                $respuesta = [
                    "tipo" => "exito",
                    "id" => $tarea->id,
                    "mensaje" => "Actualizado correctamente",
                    "proyecto_id" => $proyecto->id
                ];
                echo json_encode(["respuesta" => $respuesta]);
            }
        }
    }

    public static function eliminar(){
        if($_SERVER["REQUEST_METHOD"] === "POST"){}
    }
}