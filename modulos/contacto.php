<?php
// modulos/contacto.php

// Ruta al archivo de conexión usando __DIR__ para evitar problemas de rutas
$rutaConexion = __DIR__ . "/../modelo/conexion.php";

if (file_exists($rutaConexion)) {
    require_once($rutaConexion);

    // Validar que la variable $conexion exista y sea un objeto PDO
    if (!isset($conexion) || !$conexion instanceof PDO) {
        die("❌ Error: La conexión a la base de datos no está disponible.");
    }
} else {
    die("❌ Error: No se puede incluir el archivo de conexión.");
}

// Capturar y limpiar datos del formulario
$nombre  = trim($_POST['nombre'] ?? '');
$email   = trim($_POST['email'] ?? '');
$mensaje = trim($_POST['mensaje'] ?? '');

// Validación básica de campos
if ($nombre && $email && $mensaje) {
    // Validar formato de email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("⚠️ El correo electrónico no es válido.");
    }

    try {
        // Insertar datos en la tabla contactos
        $sql = "INSERT INTO contactos (nombre, email, mensaje) 
                VALUES (:nombre, :email, :mensaje)";
        $stmt = $conexion->prepare($sql);

        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mensaje', $mensaje);

        $stmt->execute();

        echo "✅ Mensaje enviado correctamente.";
    } catch (PDOException $e) {
        echo "❌ Error al insertar el mensaje: " . $e->getMessage();
    }
} else {
    echo "⚠️ Todos los campos son obligatorios.";
}
