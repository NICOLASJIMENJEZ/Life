<?php
$host = 'dpg-d24l0l15pdvs73bvvmq0-a.oregon-postgres.render.com';
$port = 5432;
$user = 'life_gym_db_user';
$pass = '0BaR53ptUeZaLHwtIBbMtuZ6cvYtCu3p';
$db   = 'life_gym_db';

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$db;sslmode=require";
    $conn = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    echo "✅ Conectado a PostgreSQL con éxito";
} catch (PDOException $e) {
    die("❌ Error de conexión: " . $e->getMessage());
}
?>
