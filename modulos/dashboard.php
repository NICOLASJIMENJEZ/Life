<?php
/**
 * LIFE GYM - DASHBOARD FINAL
 * Ajustado para corregir errores de conexión SSL y variables indefinidas.
 */

// 1. CREDENCIALES (Copiadas exactamente de tu panel de Render)
$host     = "dpg-d7k1offavr4c73esdbeg-a.oregon-postgres.render.com"; 
$port     = "5432";
$dbname   = "life_gym_db_hvmq";
$user     = "life_gym_db_hvmq_user";
$password = "lEovCr88qgiz5REW4MwUPePidNosjc1";

// Inicializamos variables con valores por defecto para evitar "Undefined variable"
$db_users = [];
$total_users = 0;
$stats = [];
$planes = [];

try {
    // DSN con sslmode=require para evitar el error de conexión externa
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";
    
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_TIMEOUT            => 5 // Tiempo de espera de 5 segundos
    ];

    $pdo = new PDO($dsn, $user, $password, $options);

    // EXTRACCIÓN DE DATOS
    $stmt = $pdo->query("SELECT nombre, apellido, email, identificacion, fecha_registro FROM usuarios ORDER BY id ASC");
    $db_users = $stmt->fetchAll();
    $total_users = count($db_users);

    // DEFINICIÓN DE ESTADÍSTICAS (Solo si la conexión funciona)
    $stats = [
        ['label' => 'Usuarios totales', 'val' => $total_users, 'class' => 's1', 'sub' => 'Sincronizado'],
        ['label' => 'Ingresos / mes', 'val' => '$80K', 'class' => 's2', 'sub' => 'Proyección'],
        ['label' => 'Clases activas', 'val' => '4', 'class' => 's3', 'sub' => 'Hoy'],
        ['label' => 'Mensajes hoy', 'val' => '12', 'class' => 's4', 'sub' => 'GymBot']
    ];

    $planes = [
        ['name' => 'Plan Básico', 'price' => '50.000', 'fill' => '33%', 'color' => 'var(--muted)', 'desc' => 'Lunes a Viernes'],
        ['name' => 'Plan Pro', 'price' => '80.000', 'fill' => '53%', 'color' => 'var(--blue)', 'desc' => 'Acceso completo'],
        ['name' => 'Plan Elite', 'price' => '150.000', 'fill' => '100%', 'color' => 'var(--accent)', 'desc' => 'VIP']
    ];

} catch (PDOException $e) {
    $error_msg = "Error de conexión: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Life Gym - Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root{--bg:#0a0a0a;--bg2:#111111;--accent:#e8ff00;--accent2:#ff4d00;--text:#f0f0f0;--muted:#777;--border:#252525;--green:#00c47d;--blue:#4da6ff;}
        *{margin:0;padding:0;box-sizing:border-box;}
        body{background:var(--bg);color:var(--text);font-family:'DM Sans',sans-serif;}
        .nav{display:flex;align-items:center;justify-content:space-between;padding:0 24px;height:56px;background:var(--bg2);border-bottom:1px solid var(--border);}
        .nav-logo{font-family:'Bebas Neue',sans-serif;font-size:26px;letter-spacing:3px;color:var(--accent);}
        .panel{padding:22px 24px;}
        .stats-row{display:grid;grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));gap:12px;margin-bottom:18px;}
        .stat-card{background:var(--bg2);border:1px solid var(--border);border-radius:14px;padding:18px 16px;}
        .stat-val{font-family:'Bebas Neue',sans-serif;font-size:36px;color:var(--accent);}
        .two-col{display:grid;grid-template-columns:1.4fr 1fr;gap:16px;}
        .card{background:var(--bg2);border:1px solid var(--border);border-radius:14px;overflow:hidden;}
        .card-head{padding:14px 18px;border-bottom:1px solid var(--border);display:flex;justify-content:space-between;}
        .utbl{width:100%;border-collapse:collapse;}
        .utbl th, .utbl td{padding:12px 18px; text-align:left; font-size:13px;}
        .error-banner{background:#ff4d4d; color:white; padding:15px; border-radius:8px; margin-bottom:20px; font-size:14px;}
        .bar-track{height:6px;background:#222;border-radius:3px;margin:8px 0;}
        .bar-fill{height:100%;border-radius:3px;}
    </style>
</head>
<body>

<div class="nav">
    <div class="nav-logo">GYMCORE</div>
</div>

<div class="panel">
    <?php if(isset($error_msg)): ?>
        <div class="error-banner">⚠️ <strong>Error detectado:</strong> <?= htmlspecialchars($error_msg) ?></div>
    <?php endif; ?>

    <div class="stats-row">
        <?php foreach($stats as $s): ?>
        <div class="stat-card">
            <div style="font-size:12px;color:var(--muted)"><?= $s['label'] ?></div>
            <div class="stat-val"><?= $s['val'] ?></div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="two-col">
        <div class="card">
            <div class="card-head">
                <span>Usuarios en Base de Datos</span>
                <span style="color:var(--green)">● <?= $total_users ?> Activos</span>
            </div>
            <table class="utbl">
                <thead>
                    <tr><th>Nombre</th><th>Identificación</th><th>Registro</th></tr>
                </thead>
                <tbody>
                    <?php foreach($db_users as $u): ?>
                    <tr>
                        <td><?= htmlspecialchars($u['nombre'] . ' ' . $u['apellido']) ?></td>
                        <td><?= htmlspecialchars($u['identificacion']) ?></td>
                        <td><?= htmlspecialchars($u['fecha_registro']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="card">
            <div class="card-head"><span>Planes</span></div>
            <?php foreach($planes as $p): ?>
            <div style="padding:15px; border-bottom:1px solid #222;">
                <div style="display:flex; justify-content:space-between; font-size:13px;">
                    <span><?= $p['name'] ?></span>
                    <span style="color:var(--accent)">$<?= $p['price'] ?></span>
                </div>
                <div class="bar-track"><div class="bar-fill" style="width:<?= $p['fill'] ?>; background:<?= $p['color'] ?>;"></div></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

</body>
</html>
