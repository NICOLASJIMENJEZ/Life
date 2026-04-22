<?php
$host = "dpg-d7k1offavr4c73esdbeg-a.oregon-postgres.render.com";
$port = "5432";
$dbname = "life_gym_db_hvmq";
$user = "life_gym_db_hvmq_user";
$password = "lEovCr88q2giz5REW4MwUPePidNosjc1";

$dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";

try {
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_TIMEOUT => 10
    ]);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
