<?php
$databaseUrl = "postgresql://life_gym_db_hvmq_user:lEovCr88q2giz5REW4MwUPePidNosjc1@dpg-d7k1offavr4c73esdbeg-a.oregon-postgres.render.com/life_gym_db_hvmq";
$mi_clase = null;

// Lógica de "Login" por ID
if (isset($_GET['id'])) {
    try {
        $db = parse_url($databaseUrl);
        $dsn = "pgsql:host={$db['host']};port=5432;dbname=".ltrim($db['path'], '/').";sslmode=require";
        $pdo = new PDO($dsn, $db['user'], $db['pass'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        // Buscamos solo la última clase enviada a ESTE usuario
        $stmt = $pdo->prepare("SELECT * FROM clases_individuales WHERE usuario_identificacion = ? ORDER BY fecha_publicacion DESC LIMIT 1");
        $stmt->execute([$_GET['id']]);
        $mi_clase = $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (Exception $e) { $error = $e->getMessage(); }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Entrenamiento | GYMCORE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #050505; color: #fff; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .user-card { background: #111; border: 1px solid #d4ff00; border-radius: 20px; padding: 35px; width: 100%; max-width: 500px; box-shadow: 0 0 30px rgba(212, 255, 0, 0.1); }
        .neon-text { color: #d4ff00; }
        pre { white-space: pre-wrap; font-family: sans-serif; font-size: 1.1rem; color: #ccc; line-height: 1.6; }
    </style>
</head>
<body>

<div class="container text-center">
    
    <?php if (!$mi_clase): ?>
        <div class="user-card mx-auto">
            <h2 class="mb-4 fw-bold">GYM<span class="neon-text">CORE</span></h2>
            <p class="text-muted">Ingresa tu ID para ver tu rutina personalizada</p>
            <form method="GET">
                <input type="text" name="id" class="form-control mb-3 text-center py-2" placeholder="Tu número de Identificación" required>
                <button type="submit" class="btn btn-outline-warning w-100 py-2">ACCEDER A MI CLASE</button>
            </form>
        </div>
    <?php else: ?>
        <div class="user-card text-start mx-auto">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <span class="badge bg-dark text-success border border-success">CLASE PERSONALIZADA</span>
                <small class="text-muted"><?= date('H:i', strtotime($mi_clase['fecha_publicacion'])) ?></small>
            </div>
            <h1 class="neon-text h2 mb-4"><?= htmlspecialchars($mi_clase['titulo_clase']) ?></h1>
            <div class="bg-black p-3 rounded border border-secondary mb-4">
                <pre><?= htmlspecialchars($mi_clase['detalle_rutina']) ?></pre>
            </div>
            <button onclick="window.print()" class="btn btn-sm btn-outline-secondary w-100">Imprimir Rutina</button>
            <div class="text-center mt-4">
                <a href="usuario.php" class="text-muted small text-decoration-none">← Cerrar sesión</a>
            </div>
        </div>
    <?php endif; ?>

</div>

</body>
</html>
