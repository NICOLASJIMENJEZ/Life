<?php
// modulos/contacto.php

// ===== CONFIGURACIÓN DE CONEXIÓN =====
$host = "dpg-d24l0l15pdvs73bvvmq0-a";     // Cambia si tu servidor es diferente
$dbname = "life_gym_db"; // Cambia por el nombre de tu base de datos
$usuario = "life_gym_db_user";       // Usuario de la base de datos
$password = "0BaR53ptUeZaLHwtIBbMtuZ6cvYtCu3p";          // Contraseña (si tienes)

// Crear conexión con PDO
try {
    $conexion = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $usuario, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("❌ Error de conexión: " . $e->getMessage());
}

// ===== CAPTURA DE DATOS =====
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

// ===== INSERTAR EN LA BASE DE DATOS =====
try {
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

