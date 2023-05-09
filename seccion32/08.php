<?php include "includes/header.php";
/*Autoload de Clases y Namespaces*/
require "vendor/autoload.php";
use App\Detalles;

/*Importar las clases una por una*
 * require "clases/Clientes.php";
 * require "clases/Detalles.php";
 */

/**Sustituido por Composer */
// function mi_autoload($clase){
//     $partes = explode("\\", $clase); //Divide el string en dos arreglos a través del carácter dado
//     require __DIR__ . "/clases/" . $partes[1] . ".php";
// }
//Carga clases o interfaces de manera dinámica
//spl_autoload_register("mi_autoload");

class Clientes{
    public function __construct(){
        echo "<br>";
        echo "Desde la clase: Clientes pero la version copia ";
        echo "</br>";
    }
}

$detalles = new Detalles();
$clientes = new App\Clientes();
$clientes2 = new Clientes();

/**Uso de la libreria firebase, ejemplo sacado de Composer */
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$key = 'example_key';
$payload = [
    'iss' => 'http://example.org',
    'aud' => 'http://example.com',
    'iat' => 1356999524,
    'nbf' => 1357000000
];

/**
 * IMPORTANT:
 * You must specify supported algorithms for your application. See
 * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
 * for a list of spec-compliant algorithms.
 */
$jwt = JWT::encode($payload, $key, 'HS256');
$decoded = JWT::decode($jwt, new Key($key, 'HS256'));

print_r($decoded);

/*
 NOTE: This will now be an object instead of an associative array. To get
 an associative array, you will need to cast it as such:
*/

$decoded_array = (array) $decoded;

/**
 * You can add a leeway to account for when there is a clock skew times between
 * the signing and verifying servers. It is recommended that this leeway should
 * not be bigger than a few minutes.
 *
 * Source: http://self-issued.info/docs/draft-ietf-oauth-json-web-token.html#nbfDef
 */
JWT::$leeway = 60; // $leeway in seconds
$decoded = JWT::decode($jwt, new Key($key, 'HS256'));
include "includes/footer.php";