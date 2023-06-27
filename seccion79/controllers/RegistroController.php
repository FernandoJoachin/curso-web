<?php

namespace Controllers;

use Model\Categoria;
use Model\Dia;
use Model\Evento;
use Model\Hora;
use Model\Paquete;
use Model\Ponente;
use Model\Regalo;
use Model\Registro;
use Model\Usuario;
use MVC\Router;


class RegistroController{
    public static function crear(Router $router){
        if(!esta_Autenticado()){
            header("Location: /");
        }

        $registro = Registro::where("usuario_id", $_SESSION["id"]);
        if(isset($registro) && $registro->paquete_id === "3" ) {
            header("Location: /boleto?id=" . urlencode($registro->token));
            return;
        }

        $router->render("registro/crear",[
            "titulo" => "Finalizar Registro",
        ]);
    }

    public static function gratis(Router $router){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            if(!esta_Autenticado()){
                header("Location: /login");
            }

            $registro = Registro::where("usuario_id", $_SESSION["id"]);
            if(isset($registro) && $registro->paquete_id === "3" ) {
                header("Location: /boleto?id=" . urlencode($registro->token));
                return;
            }

            $token = substr(md5(uniqid(rand(),true)), 0, 8);
            
            //Crear registro
            $datos = array(
                "paquete_id" => 3,
                "pago_id" => "",
                "token" => $token,
                "usuario_id" => $_SESSION["id"]
            );

            $registro = new Registro($datos);
            $resultado = $registro->guardar();

            if($resultado){
                header("Location: /boleto?id=" . urlencode($registro->token));
            }
        }
    }

    public static function pagar(Router $router){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            if(!esta_Autenticado()){
                header("Location: /login");
            }

            //Validar que el POST no llegue vacion
            if(empty($_POST)){
                echo json_encode([]);
                return;
            }

            //Crear registro
            $datos = $_POST;
            $datos["token"] = substr(md5(uniqid(rand(),true)), 0, 8);
            $datos["usuario_id"] = $_SESSION["id"];

            try {
                $registro = new Registro($datos);
                $resultado = $registro->guardar();
                echo json_encode($resultado);

            } catch (\Throwable $th) {
                echo json_encode([
                    "resultado" => "error"
                ]);
            }
        }
    }

    public static function boleto(Router $router){
        //Validar url
        $id = $_GET["id"];
        if(!$id || !strlen($id) === 8){
            header("Location: /");
        }

        $registro = Registro::where("token", $id);
        if(!$registro){
            header("Location: /");
        }
        $registro->usuario = Usuario::find($registro->usuario_id);
        $registro->paquete = Paquete::find($registro->paquete_id);
        $router->render("registro/boleto",[
            "titulo" => "Asistencia a DevWebcamp",
            "registro" => $registro
        ]);
    }

    public static function conferencias(Router $router){
        if(!esta_Autenticado()){
            header("Location: /login");
        }

        //Validar que el usuario tenga el plan presencial
        $usuario_id = $_SESSION["id"];
        $registro = Registro::where("usuario_id", $usuario_id);

        if($registro->paquete_id !== "1"){
            //header("Location: /");
        }

        $eventos = Evento::ordenar("hora_id", "ASC");
        $evento_formateados = [];

        foreach($eventos as $evento){
            $evento->categoria = Categoria::find($evento->categoria_id);
            $evento->dia = Dia::find($evento->dia_id);
            $evento->hora = Hora::find($evento->hora_id);
            $evento->ponente = Ponente::find($evento->ponente_id);

            if($evento->dia_id === "1" && $evento->categoria_id === "1"){
                $evento_formateados["conferencias_v"][] = $evento;
            }
            if($evento->dia_id === "2" && $evento->categoria_id === "1"){
                $evento_formateados["conferencias_s"][] = $evento;
            }

            if($evento->dia_id === "1" && $evento->categoria_id === "2"){
                $evento_formateados["workshops_v"][] = $evento;
            }
            if($evento->dia_id === "2" && $evento->categoria_id === "2"){
                $evento_formateados["workshops_s"][] = $evento;
            }
        }

        $regalos = Regalo::all("ASC");

        $router->render("registro/conferencias",[
            "titulo" => "Elije Workshops y Conferencias",
            "eventos" => $evento_formateados,
            "regalos" => $regalos
        ]);
    }
}