<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    die();
}
include_once "conexion/cone.php";
$data = json_decode(file_get_contents("php://input"), true);
if (isset($data['operacion']) && $data['operacion'] === 'listarPersonas') {
    $sql = "SELECT * FROM persona";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $personas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($personas) {
        echo json_encode(array(
            "mensaje" => "Lista de personas",
            "personas" => $personas
        ));
    } else {
        echo json_encode(array(
            "mensaje" => "No hay personas registradas"
        ));
    }
    
} else {
    echo json_encode(array(
        "mensaje" => "Operacion no valida"
    ));
}
?>