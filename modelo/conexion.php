
<?php
$host = "dpg-d2410115pdvs73bvvnq0-a.oregon-postgres.render.com";
$port = "5432";
$dbname = "life_gym_db";
$user = "life_gym_db_user";
$password = "0BaR53ptUeZaLHwtIBbMtuZ6cvYtCu3p";

$dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";

try {
    $conexion = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    echo "✅ Conexión exitosa";
} catch (PDOException $e) {
    echo "❌ Error de conexión: " . $e->getMessage();
}
