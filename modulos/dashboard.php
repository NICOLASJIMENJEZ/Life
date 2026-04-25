<?php
/**
 * LIFE GYM - DASHBOARD CORE (FIX DEFINITIVO)
 */

// 🔐 URL REAL DE RENDER (LA TUYA)
$databaseUrl = "postgresql://life_gym_db_hvmq_user:lEovCr88q2giz5REW4MwUPePidNosjc1@dpg-d7k1offavr4c73esdbeg-a.oregon-postgres.render.com/life_gym_db_hvmq";

// Inicialización
$db_users = [];
$total_users = 0;
$stats = [];
$planes = [];
$error_msg = null;

try {

    // 🔍 Parsear la URL
    $db = parse_url($databaseUrl);

    $host = $db['host'];
    $port = $db['port'] ?? 5432;
    $dbname = ltrim($db['path'], '/');
    $user = $db['user'];
    $password = $db['pass'];

    // 🔐 Conexión con SSL obligatorio (Render)
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    $pdo = new PDO($dsn, $user, $password, $options);

    // ✅ Test conexión
    $pdo->query("SELECT 1");

    // 📊 Consulta
    $stmt = $pdo->query("
        SELECT nombre, apellido, identificacion, fecha_registro 
        FROM usuarios 
        ORDER BY id ASC
    ");

    $db_users = $stmt->fetchAll();
    $total_users = count($db_users);

    // 📈 Stats
    $stats = [
        ['label' => 'Usuarios totales', 'val' => $total_users],
        ['label' => 'Ingresos / mes', 'val' => '$80K'],
        ['label' => 'Clases activas', 'val' => '4'],
        ['label' => 'Mensajes hoy', 'val' => '12'],
    ];

    $planes = [
        ['name' => 'Plan Básico', 'price' => '50.000', 'fill' => '33%', 'color' => '#777', 'desc' => 'Lunes a Viernes'],
        ['name' => 'Plan Pro', 'price' => '80.000', 'fill' => '53%', 'color' => '#4da6ff', 'desc' => 'Acceso completo'],
        ['name' => 'Plan Elite', 'price' => '150.000', 'fill' => '100%', 'color' => '#e8ff00', 'desc' => 'VIP']
    ];

} catch (Exception $e) {
    $error_msg = "Error de conexión: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>GYMCORE</title>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">

<style>
:root{--bg:#0a0a0a;--bg2:#111;--accent:#e8ff00;--text:#fff;--muted:#777;--border:#252525;--green:#00c47d;}
body{background:var(--bg);color:var(--text);font-family:'DM Sans',sans-serif;margin:0;}
.nav{padding:15px 20px;background:#111;border-bottom:1px solid var(--border);}
.nav-logo{font-family:'Bebas Neue';font-size:26px;color:var(--accent);}
.panel{padding:20px;}
.card{background:#111;border:1px solid var(--border);border-radius:12px;margin-bottom:20px;}
.card-head{padding:15px;border-bottom:1px solid var(--border);display:flex;justify-content:space-between;}
table{width:100%;border-collapse:collapse;}
th,td{padding:10px;text-align:left;font-size:13px;}
th{color:var(--muted);}
.error{background:red;padding:12px;border-radius:8px;margin-bottom:15px;}
.bar{height:6px;background:#222;border-radius:3px;margin-top:5px;}
.fill{height:100%;border-radius:3px;}
</style>
</head>

<body>

<div class="nav">
    <div class="nav-logo">GYMCORE</div>
</div>

<div class="panel">

<?php if($error_msg): ?>
<div class="error">⚠️ <?= htmlspecialchars($error_msg) ?></div>
<?php endif; ?>

<div class="card">
<div class="card-head">
    <span>Usuarios</span>
    <span style="color:var(--green)"><?= $total_users ?> activos</span>
</div>

<?php if($total_users > 0): ?>
<table>
<tr><th>Nombre</th><th>ID</th><th>Fecha</th></tr>
<?php foreach($db_users as $u): ?>
<tr>
<td><?= htmlspecialchars($u['nombre'].' '.$u['apellido']) ?></td>
<td><?= htmlspecialchars($u['identificacion']) ?></td>
<td><?= htmlspecialchars($u['fecha_registro']) ?></td>
</tr>
<?php endforeach; ?>
</table>
<?php else: ?>
<p style="padding:20px;color:#777;">Sin datos</p>
<?php endif; ?>

</div>

<div class="card">
<div class="card-head">Planes</div>

<?php foreach($planes as $p): ?>
<div style="padding:15px;">
<div style="display:flex;justify-content:space-between;">
<span><?= $p['name'] ?></span>
<span style="color:var(--accent)">$<?= $p['price'] ?></span>
</div>
<div class="bar">
<div class="fill" style="width:<?= $p['fill'] ?>;background:<?= $p['color'] ?>"></div>
</div>
<small style="color:#777;"><?= $p['desc'] ?></small>
</div>
<?php endforeach; ?>

</div>

</div>
</body>
</html>
