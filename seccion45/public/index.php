<?php //Proporcionado en el curso

require_once __DIR__ . '/../includes/app.php';

use Controllers\CitaController;
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
$router->get("/reestablecer",[LoginController::class,"reestablecerPassword"]);
$router->post("/reestablecer",[LoginController::class,"reestablecerPassword"]);

//Crear cuenta
$router->get("/crear-cuenta",[LoginController::class,"crearCuenta"]);
$router->post("/crear-cuenta",[LoginController::class,"crearCuenta"]);

//Confirmar cuenta
$router->get("/confirmar-cuenta",[LoginController::class,"confirmarCuenta"]);
$router->get("/mensaje",[LoginController::class,"mensaje"]);

//Zona restringida
$router->get("/cita",[CitaController::class,"index"]);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();