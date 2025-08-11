<?php
// Configuración de conexión a PostgreSQL (Render)
$host = "dpg-d2410115pdvs73bvvnq0-a.oregon-postgres.render.com";
$port = 5432;
$dbname = "life_gym_db";
$user = "life_gym_db_user";
$pass = "0BaR53ptUeZaLHwtIBbMtuZ6ovYtCu3p";

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";
    $conexion = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("❌ Error de conexión: " . $e->getMessage());
}

// Capturar y limpiar datos del formulario
$nombre  = trim($_POST['nombre'] ?? '');
$email   = trim($_POST['email'] ?? '');
$mensaje = trim($_POST['mensaje'] ?? '');

if ($nombre && $email && $mensaje) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("⚠️ El correo electrónico no es válido.");
    }

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
} else {
    echo "⚠️ Todos los campos son obligatorios.";
}

