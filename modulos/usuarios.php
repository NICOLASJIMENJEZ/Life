<?php
$databaseUrl = "postgresql://life_gym_db_hvmq_user:lEovCr88q2giz5REW4MwUPePidNosjc1@dpg-d7k1offavr4c73esdbeg-a.oregon-postgres.render.com/life_gym_db_hvmq";
$mi_rutina = null;

if (isset($_GET['id_usuario'])) {
    try {
        $db = parse_url($databaseUrl);
        $dsn = "pgsql:host={$db['host']};port=5432;dbname=".ltrim($db['path'], '/').";sslmode=require";
        $pdo = new PDO($dsn, $db['user'], $db['pass'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        // Buscamos la última clase enviada específicamente a este ID
        $stmt = $pdo->prepare("SELECT * FROM clases_asignadas WHERE identificacion_usuario = ? ORDER BY fecha_envio DESC LIMIT 1");
        $stmt->execute([$_GET['id_usuario']]);
        $mi_rutina = $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (Exception $e) { $error_msg = $e->getMessage(); }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Rutina Personalizada | GYMCORE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #0a0a0a; color: #fff; min-height: 100vh; }
        .clase-card { 
            background: #111; 
            border: 1px solid #d4ff00; 
            border-radius: 20px; 
            padding: 30px;
            box-shadow: 0 0 20px rgba(212, 255, 0, 0.1);
        }
        .header-user { background: #000; padding: 20px 0; border-bottom: 1px solid #222; }
        pre { white-space: pre-wrap; font-family: 'Inter', sans-serif; font-size: 1.2rem; color: #efefef; }
    </style>
</head>
<body>

<div class="header-user text-center mb-5">
    <h3 class="fw-bold" style="color:#d4ff00">GYMCORE APP</h3>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            
            <?php if (!$mi_rutina): ?>
                <div class="card bg-dark p-4 border-secondary">
                    <h5>Ingresa tu Identificación</h5>
                    <form method="GET">
                        <input type="text" name="id_usuario" class="form-control mb-3 text-center" placeholder="Ej: 1085..." required>
                        <button type="submit" class="btn btn-outline-light w-100">VER MI RUTINA</button>
                    </form>
                </div>
            <?php else: ?>
                
                <div class="clase-card text-start">
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted small">RECIBIDO: <?= date('d/m/Y H:i', strtotime($mi_rutina['fecha_envio'])) ?></span>
                        <span class="badge bg-success">PERSONALIZADO</span>
                    </div>
                    <h2 style="color:#d4ff00" class="mb-4"><?= htmlspecialchars($mi_rutina['titulo_clase']) ?></h2>
                    <pre><?= htmlspecialchars($mi_rutina['contenido_rutina']) ?></pre>
                    <hr class="border-secondary mt-5">
                    <a href="clase_usuario.php" class="btn btn-sm btn-link text-muted">Cerrar sesión</a>
                </div>

            <?php endif; ?>

        </div>
    </div>
</div>

</body>
</html>
