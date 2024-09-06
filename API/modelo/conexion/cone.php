<?php
$host = 'localhost';
$dbname = 'informacion';  
$username = 'root';  
$password = '';  

try {
    $conexion = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo json_encode(array(
        "mensaje" => "Error de conexión: " . $e->getMessage()
    ));
    exit();
}
?>
