<?php
$conexion = new mysqli("switchyard.proxy.rlwy.net", "root", "yHVACjdVpisuiHXnOqKCEfWbkJuktloQ", "life_gym");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$sql = "SELECT id, titulo, fecha_creacion FROM clases";
$resultado = $conexion->query($sql);

$eventos = [];

while ($row = $resultado->fetch_assoc()) {
    $eventos[] = [
        'id' => $row['id'],
        'title' => $row['titulo'],
        'start' => $row['fecha_creacion']
    ];
}

header('Content-Type: application/json');
echo json_encode($eventos);
?>
