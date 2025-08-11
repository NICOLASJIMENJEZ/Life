<?php
// modulos/contacto.php

// Ruta al archivo de conexión
$rutaConexion = __DIR__ . "/../modelo/conexion.php";

if (!file_exists($rutaConexion)) {
    die("❌ Error: No se puede incluir el archivo de conexión.");
}

require_once($rutaConexion);

// Verificar que $conexion exista y sea PDO
if (!isset($conexion) || !$conexion instanceof PDO) {
    die("❌ Error: La conexión a la base de datos no está disponible.");
}

// Capturar datos del formulario con limpieza básica
$nombre  = trim($_POST['nombre'] ?? '');
$email   = trim($_POST['email'] ?? '');
$mensaje = trim($_POST['mensaje'] ?? '');

// Validar campos obligatorios
if (empty($nombre) || empty($email) || empty($mensaje)) {
    die("⚠️ Todos los campos son obligatorios.");
}

// Validar formato de email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("⚠️ El correo electrónico no es válido.");
}

try {
    // Preparar e insertar en la base de datos
    $sql = "INSERT INTO contactos (nombre, email, mensaje) VALUES (:nombre, :email, :mensaje)";
    $stmt = $conexion->prepare($sql);

    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':mensaje', $mensaje, PDO::PARAM_STR);

    $stmt->execute();

    echo "✅ Mensaje enviado correctamente.";
} catch (PDOException $e) {
    echo "❌ Error al guardar el mensaje: " . $e->getMessage();
}

