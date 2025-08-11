<?php
// modulos/contacto.php

// Incluir conexión PDO
if (file_exists("/modelo/conexion.php")) {
    require_once("/modelo/conexion.php");

    // Validación para asegurarse de que $conexion esté definido
    if (!isset($conexion) || !$conexion instanceof PDO) {
        die("❌ Error: La conexión a la base de datos no está disponible.");
    }

} else {
    die("❌ Error: No se puede incluir el archivo de conexión.");
}

// Captura segura de datos POST
$nombre = trim($_POST['nombre'] ?? '');
$email = trim($_POST['email'] ?? '');
$mensaje = trim($_POST['mensaje'] ?? '');

// Validación básica
if ($nombre && $email && $mensaje) {
    try {
        $sql = "INSERT INTO contactos (nombre, email, mensaje) VALUES (:nombre, :email, :mensaje)";
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
?>