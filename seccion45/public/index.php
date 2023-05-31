<?php //Proporcionado en el curso

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;

use MVC\Router;

$router = new Router();

//Iniciar sesion
$router->get("/",[LoginController::class,"login"]);
$router->post("/",[LoginController::class,"login"]);
$router->get("/logout",[LoginController::class,"logout"]);

//Recuperar Password
$router->get("/olvidar",[LoginController::class,"olvidarPassword"]);
$router->post("/olvidar",[LoginController::class,"olvidarPassword"]);
$router->get("/recuperar",[LoginController::class,"recuperarPassword"]);
$router->post("/recuperar",[LoginController::class,"recuperarPassword"]);

//Crear cuenta
$router->get("/crear-cuenta",[LoginController::class,"crearCuenta"]);
$router->post("/crear-cuenta",[LoginController::class,"crearCuenta"]);



// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();