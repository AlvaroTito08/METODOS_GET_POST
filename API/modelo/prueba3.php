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
$correo = $data->correo;
if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(array(
        "mensaje" => "El correo $correo es valido"
    ));
} else {
    echo json_encode(array(
        "mensaje" => "El correo  $correo no es valido"
    ));
}
