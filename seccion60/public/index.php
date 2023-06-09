<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use MVC\Router;
$router = new Router();

//Login
$router->get("/",[LoginController::class, "login"]);
$router->post("/",[LoginController::class,"login"]);
$router->get("/logout",[LoginController::class,"logout"]);

//Crear cuenta
$router->get("/crear",[LoginController::class,"crear"]);
$router->post("/crear",[LoginController::class,"crear"]);

//Formulario de olvidar el password
$router->get("/olvidar",[LoginController::class,"olvidarPassword"]);
$router->post("/olvidar",[LoginController::class,"olvidarPassword"]);

//Colocar el nuevo password
$router->get("/reestablecer",[LoginController::class,"reestablecerPassword"]);
$router->post("/reestablecer",[LoginController::class,"reestablecerPassword"]);

//Confirmar la cuenta creada
$router->get("/mensaje",[LoginController::class,"mensaje"]);
$router->get("/confirmar",[LoginController::class,"confirmar"]);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();