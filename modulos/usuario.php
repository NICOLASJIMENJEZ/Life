<?php
$databaseUrl = "postgresql://life_gym_db_hvmq_user:lEovCr88q2giz5REW4MwUPePidNosjc1@dpg-d7k1offavr4c73esdbeg-a.oregon-postgres.render.com/life_gym_db_hvmq";
$rutina = null;

if (isset($_GET['id'])) {
    try {
        $db = parse_url($databaseUrl);
        $dsn = "pgsql:host={$db['host']};port=5432;dbname=".ltrim($db['path'], '/').";sslmode=require";
        $pdo = new PDO($dsn, $db['user'], $db['pass'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        $stmt = $pdo->prepare("SELECT * FROM clases_asignadas WHERE identificacion_usuario = ? ORDER BY id DESC LIMIT 1");
        $stmt->execute([$_GET['id']]);
        $rutina = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) { }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Clase | GYMCORE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #050505; color: white; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .rutina-card { background: #111; border-left: 5px solid #d4ff00; padding: 40px; border-radius: 15px; width: 100%; max-width: 500px; }
        pre { white-space: pre-wrap; color: #ccc; font-size: 1.1rem; }
    </style>
</head>
<body>

<div class="container text-center">
    <?php if (!$rutina): ?>
        <div class="card bg-dark p-5">
            <h3 class="mb-4">Ingresa tu Identificación</h3>
            <form method="GET">
                <input type="text" name="id" class="form-control mb-3 text-center" placeholder="ID de Usuario" required>
                <button type="submit" class="btn btn-outline-warning w-100">Consultar Rutina</button>
            </form>
        </div>
    <?php else: ?>
        <div class="rutina-card text-start shadow-lg">
            <h5 class="text-muted small">RUTINA ASIGNADA</h5>
            <h1 style="color: #d4ff00;"><?= htmlspecialchars($rutina['titulo_clase']) ?></h1>
            <hr border-secondary>
            <pre><?= htmlspecialchars($rutina['contenido_rutina']) ?></pre>
            <p class="mt-4 small text-muted">Fecha: <?= $rutina['fecha_envio'] ?></p>
            <a href="usuario.php" class="btn btn-sm btn-link text-white mt-3">Volver</a>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
