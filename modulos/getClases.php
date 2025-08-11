<?php
// Configuración de conexión PostgreSQL
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

    $sql = "SELECT id, titulo, fecha_creacion FROM clases";
    $stmt = $conexion->query($sql);

    $eventos = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $eventos[] = [
            'id' => $row['id'],
            'title' => $row['titulo'],
            'start' => $row['fecha_creacion']
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($eventos);
} catch (PDOException $e) {
    echo "❌ Error de conexión o consulta: " . $e->getMessage();
}
?>