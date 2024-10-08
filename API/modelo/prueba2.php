<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Header: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE ");
header("Allow: GET, POST, OPTIONS, PUT, DELETE ");
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    die();
}
$data = json_decode(
    file_get_contents("php://input", true)
);
$fecha_nacimiento = $data->fecha_nacimiento;
$fechaNacimientoObj = new DateTime($fecha_nacimiento);
$fechaActual = new DateTime();
$edad = $fechaActual->diff($fechaNacimientoObj)->y;
if ($edad >= 18) {
    echo json_encode(array(
        "mensaje" => "Tu edad es: $edad anos"
    ));
} 
