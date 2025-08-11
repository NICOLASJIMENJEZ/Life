<?php
$host     = 'dpg-d24l0l15pdvs73bvvmq0-a';
$port     = '5432';
$dbname   = 'life_gym_db';
$user     = 'life_gym_db_user';
$password = '0BaR53ptUeZaLHwtIBbMtuZ6cvYtCu3p';

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $conexion = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    // echo "✅ Conexión exitosa a PostgreSQL";
} catch (PDOException $e) {
    die("❌ Error de conexión: " . $e->getMessage());
}
?>