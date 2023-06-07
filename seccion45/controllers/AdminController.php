<?php
namespace Controllers;

use MVC\Router;
use Model\AdminCita;

class AdminController{
    public static function index(Router $router){
        session_start();
        //Consultar la base de datos (Codigo SQL proporcionado en el curso)
        $consulta = "SELECT citas.id, citas.hora, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        $consulta .= " usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio  ";
        $consulta .= " FROM citas  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON citas.usuario_id=usuarios.id  ";
        $consulta .= " LEFT OUTER JOIN citasservicios ";
        $consulta .= " ON citasservicios.cita_id=citas.id ";
        $consulta .= " LEFT OUTER JOIN servicios ";
        $consulta .= " ON servicios.id=citasservicios.servicio_id ";
        //$consulta .= " WHERE fecha =  '{$fecha}' ";

        $citas = AdminCita::SQL($consulta);
        //debuguear($citas);
        $router->render("admin/index",[
            "nombre" => $_SESSION["nombre"],
            "citas" => $citas
        ]);
    }
}