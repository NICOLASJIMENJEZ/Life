<?php
$host = "dpg-d7k1offavr4c73esdbeg-a.oregon-postgres.render.com";
$port = "5432";
$dbname = "life_gym_db_hvmq";
$user = "life_gym_db_hvmq_user";
$password = "lEovCr88q2giz5REW4MwUPePidNosjc1";

// Forzamos SSL obligatorio
$dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";

try {
    echo "⏳ Intentando conectar...\n";
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_TIMEOUT => 10 // 10 segundos de espera
    ]);
    echo "✅ Conexión exitosa a la base de datos\n";

    // Verificar versión de PostgreSQL
    $stmt = $pdo->query("SELECT version()");
    $version = $stmt->fetchColumn();
    echo "📌 Versión del servidor: $version\n";

} catch (PDOException $e) {
    echo "❌ Error de conexión a la base de datos\n";
    echo "🔍 Detalle: " . $e->getMessage() . "\n";
    echo "📋 DSN usado: $dsn\n";
    echo "💡 Posibles causas:\n";
    echo "1. Render exige SSL y no se está negociando correctamente.\n";
    echo "2. El puerto 5432 está bloqueado en tu hosting o red.\n";
    echo "3. Tu PHP/libpq está desactualizado y no soporta el cifrado.\n";
}
?>
