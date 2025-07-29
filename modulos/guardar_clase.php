<?php
// Conexión a la base de datos
$conexion = new mysqli("switchyard.proxy.rlwy.net", "root", "yHVACjdVpisuiHXnOqKCEfWbkJuktloQ", "life_gym");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Recoger y sanitizar los datos del formulario
$cliente = $_POST['cliente'] ?? null;
$grupo = $_POST['grupo'] ?? null;
$titulo = $_POST['titulo'] ?? null;
$descripcion = $_POST['descripcion'] ?? null;
$tiempo_descanso = $_POST['tiempo_descanso'] ?? null;
$video = $_POST['video'] ?? null;
$fecha_creacion = date('Y-m-d'); // Fecha actual

// Validar que campos obligatorios existan
if (!$cliente || !$grupo || !$titulo || !$descripcion || !$tiempo_descanso) {
    die("Error: Faltan campos obligatorios.");
}

// Manejo de imágenes (se pueden guardar en base de datos o mover a una carpeta)
$imagen1 = $_FILES['imagen1']['name'] ?? null;
$imagen2 = $_FILES['imagen2']['name'] ?? null;
$imagen3 = $_FILES['imagen3']['name'] ?? null;

// Opcional: guardar imágenes en carpeta
$carpeta_destino = "../imagenes/";
if (!file_exists($carpeta_destino)) {
    mkdir($carpeta_destino, 0777, true);
}

if ($imagen1) move_uploaded_file($_FILES['imagen1']['tmp_name'], $carpeta_destino . $imagen1);
if ($imagen2) move_uploaded_file($_FILES['imagen2']['tmp_name'], $carpeta_destino . $imagen2);
if ($imagen3) move_uploaded_file($_FILES['imagen3']['tmp_name'], $carpeta_destino . $imagen3);

// Preparar y ejecutar la consulta
$stmt = $conexion->prepare("INSERT INTO clases (cliente, grupo, titulo, descripcion, tiempo_descanso, video, imagen1, imagen2, imagen3, fecha_creacion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssss", $cliente, $grupo, $titulo, $descripcion, $tiempo_descanso, $video, $imagen1, $imagen2, $imagen3, $fecha_creacion);

if ($stmt->execute()) {
    echo "<script>alert('Rutina guardada correctamente'); window.location.href='dashboard.php';</script>";
} else {
    echo "Error al guardar: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>
