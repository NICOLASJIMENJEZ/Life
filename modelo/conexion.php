<?php
// conexion.php

// Parámetros de conexión
$host = "dpg-d2410115pdvs73bvvnq0-a.oregon-postgres.render.com";
$port = "5432";
$dbname = "life_gym_db";
$user = "life_gym_db_user";
$password = "0BaR53ptUeZaLHwtIBbMtuZ6cvYtCu3p";

// Cadena DSN para PDO con SSL obligatorio
$dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";

try {
    // Crear instancia PDO para conexión
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION  // Para que lance excepciones en errores
    ]);
    // echo "Conexión exitosa";  // Opcional, quitar para producción
} catch (PDOException $e) {
    // Si falla la conexión, detener el script mostrando el error
    die("❌ Error de conexión a la base de datos: " . $e->getMessage());
}
?>
