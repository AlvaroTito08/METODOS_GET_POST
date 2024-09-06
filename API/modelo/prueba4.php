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

$data = json_decode(
    file_get_contents("php://input"), true
);

if (isset($data['nombre']) && isset($data['primer_apellido']) && isset($data['segundo_apellido'])) {
    $nombre = $data['nombre'];
    $primer_apellido = $data['primer_apellido'];
    $segundo_apellido = $data['segundo_apellido'];
    $sql_verificar = "SELECT * FROM persona WHERE nombre = :nombre AND primer_apellido = :primer_apellido AND segundo_apellido = :segundo_apellido";
    $stmt_verificar = $conexion->prepare($sql_verificar);
    $stmt_verificar->execute([
        ':nombre' => $nombre,
        ':primer_apellido' => $primer_apellido,
        ':segundo_apellido' => $segundo_apellido
    ]);
    if ($stmt_verificar->rowCount() > 0) {
        echo json_encode(array(
            "mensaje" => "Persona existente"
        ));
    } else {
        $sql_insertar = "INSERT INTO persona (nombre, primer_apellido, segundo_apellido) 
                         VALUES (:nombre, :primer_apellido, :segundo_apellido)";
        $stmt_insertar = $conexion->prepare($sql_insertar);
        
        if ($stmt_insertar->execute([
            ':nombre' => $nombre,
            ':primer_apellido' => $primer_apellido,
            ':segundo_apellido' => $segundo_apellido
        ])) {
            echo json_encode(array(
                "mensaje" => "Persona registrada correctamente"
            ));
        } else {
            echo json_encode(array(
                "mensaje" => "Error al guardar los datos"
            ));
        }
    }
} else {
    echo json_encode(array(
        "mensaje" => "Faltan datos en la solicitud"
    ));
}
?>
