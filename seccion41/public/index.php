<?php
require_once __DIR__ . "/../includes/app.php";
use MVC\Router;
use Controllers\PropiedadController;

$router = New Router();
//NombreClase::class - Obtiene el nombre completo de la clase en tiempo de ejecución, sin tener que escribir el nombre de la clase directamente en el código.
$router->get("/admin", [PropiedadController::class, "index"]);
$router->get("/propiedades/crear", [PropiedadController::class, "crear"]);
$router->get("/propiedades/actualizar", [PropiedadController::class, "actualizar"]);
$router->comprobarRutas();
