<?php

$host     = "dpg-d7k1offavr4c73esdbeg-a.oregon-postgres.render.com"; 
$port     = "5432";
$dbname   = "life_gym_db_hvmq";
$user     = "life_gym_db_hvmq_user";
$password = "lEovCr88qgiz5REW4MwUPePidNosjc1";
try {
    
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

  
    $stmt = $pdo->query("SELECT nombre, apellido, email, identificacion, fecha_registro FROM usuarios ORDER BY id ASC");
    $db_users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 2. CÁLCULO DE ESTADÍSTICAS DINÁMICAS
    $total_users = count($db_users);
    
    $stats = [
        ['label' => 'Usuarios totales', 'val' => $total_users, 'sub' => 'Sincronizado con BD', 'class' => 's1'],
        ['label' => 'Ingresos / mes', 'val' => '$80K', 'sub' => 'Plan Pro activo', 'class' => 's2'],
        ['label' => 'Clases activas', 'val' => '4', 'sub' => 'Listas para hoy', 'class' => 's3'],
        ['label' => 'Mensajes hoy', 'val' => '12', 'sub' => 'Consultas GymBot', 'class' => 's4'],
    ];

    // Datos estáticos para planes (puedes crear una tabla 'planes' luego para dinamizar esto también)
    $planes = [
        ['name' => 'Plan Básico', 'price' => '50.000', 'fill' => '33%', 'color' => 'var(--muted)', 'desc' => 'Lunes a Viernes'],
        ['name' => 'Plan Pro', 'price' => '80.000', 'fill' => '53%', 'color' => 'var(--blue)', 'desc' => 'Acceso completo + grupales'],
        ['name' => 'Plan Elite', 'price' => '150.000', 'fill' => '100%', 'color' => 'var(--accent)', 'desc' => 'Acceso + Entrenador']
    ];

} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>GymCore - Dashboard Realtime</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        /* [Tu CSS previo aquí...] */
        :root{--bg:#0a0a0a;--bg2:#111111;--bg3:#181818;--accent:#e8ff00;--accent2:#ff4d00;--text:#f0f0f0;--muted:#777;--border:#252525;--green:#00c47d;--blue:#4da6ff;}
        *{margin:0;padding:0;box-sizing:border-box;}
        body{background:var(--bg);color:var(--text);font-family:'DM Sans',sans-serif;min-height:100vh;overflow:hidden;}
        .nav{display:flex;align-items:center;justify-content:space-between;padding:0 24px;height:56px;background:var(--bg2);border-bottom:1px solid var(--border);}
        .nav-logo{font-family:'Bebas Neue',sans-serif;font-size:26px;letter-spacing:3px;color:var(--accent);}
        .nav-tabs{display:flex;gap:4px;}
        .tab-btn{padding:7px 18px;border:none;border-radius:8px;cursor:pointer;font-size:13px;font-weight:500;background:transparent;color:var(--muted);transition:all .2s;}
        .tab-btn.active{background:var(--accent);color:#000;}
        .panel{display:none;height:calc(100vh - 56px);overflow-y:auto;padding:22px 24px;}
        .panel.active{display:block;}
        .stats-row{display:grid;grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));gap:12px;margin-bottom:18px;}
        .stat-card{background:var(--bg2);border:1px solid var(--border);border-radius:14px;padding:18px 16px;position:relative;}
        .stat-card::before{content:'';position:absolute;top:0;left:0;right:0;height:3px;border-radius:14px 14px 0 0;}
        .s1::before{background:var(--accent);} .s2::before{background:var(--green);}
        .stat-val{font-family:'Bebas Neue',sans-serif;font-size:36px;line-height:1;margin:4px 0;}
        .two-col{display:grid;grid-template-columns:1.4fr 1fr;gap:16px;}
        .card{background:var(--bg2);border:1px solid var(--border);border-radius:14px;overflow:hidden;}
        .card-head{padding:14px 18px;border-bottom:1px solid var(--border);display:flex;justify-content:space-between;align-items:center;}
        .utbl{width:100%;border-collapse:collapse;}
        .utbl th{font-size:11px;color:var(--muted);text-transform:uppercase;padding:10px 18px;text-align:left;border-bottom:1px solid var(--border);}
        .utbl td{font-size:13px;padding:11px 18px;border-bottom:1px solid rgba(255,255,255,.03);}
        .av{width:30px;height:30px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;background:rgba(232,255,0,0.1);color:var(--accent);}
        .plan-row{padding:13px 18px;border-bottom:1px solid rgba(255,255,255,.03);}
        .bar-track{height:4px;background:var(--bg3);border-radius:2px;margin:8px 0;}
        .bar-fill{height:100%;border-radius:2px;}
    </style>
</head>
<body>

<div class="nav">
    <div class="nav-logo">GYM<span>CORE</span></div>
    <div class="nav-tabs">
        <button class="tab-btn active" onclick="showPanel('admin', this)">Panel Admin</button>
        <button class="tab-btn" onclick="showPanel('usuario', this)">Mi Espacio</button>
    </div>
</div>

<div id="panel-admin" class="panel active">
    <div class="stats-row">
        <?php foreach($stats as $s): ?>
        <div class="stat-card <?= $s['class'] ?>">
            <div class="stat-label"><?= $s['label'] ?></div>
            <div class="stat-val"><?= $s['val'] ?></div>
            <div class="stat-sub"><?= $s['sub'] ?></div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="two-col">
        <div class="card">
            <div class="card-head">
                <span class="card-title">Usuarios en Base de Datos</span>
                <span style="color:var(--green); font-size:11px;">● <?= $total_users ?> registros</span>
            </div>
            <table class="utbl">
                <thead>
                    <tr><th>Usuario</th><th>Email / ID</th><th>Fecha Registro</th><th>Estado</th></tr>
                </thead>
                <tbody>
                    <?php foreach($db_users as $u): 
                        // Generamos iniciales dinámicas
                        $iniciales = strtoupper(substr($u['nombre'], 0, 1) . substr($u['apellido'], 0, 1));
                    ?>
                    <tr>
                        <td>
                            <div style="display:flex;align-items:center;gap:9px;">
                                <div class="av"><?= $iniciales ?></div>
                                <span><?= htmlspecialchars($u['nombre'] . ' ' . $u['apellido']) ?></span>
                            </div>
                        </td>
                        <td style="color:var(--muted)">
                            <?= htmlspecialchars($u['email']) ?><br>
                            <small>ID: <?= $u['identificacion'] ?></small>
                        </td>
                        <td style="color:var(--muted)"><?= $u['fecha_registro'] ?></td>
                        <td><span style="color:var(--green)">Activo</span></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="card">
            <div class="card-head"><span class="card-title">Planes Vigentes</span></div>
            <?php foreach($planes as $p): ?>
            <div class="plan-row">
                <div style="display:flex; justify-content:space-between; font-size:13px;">
                    <span><?= $p['name'] ?></span>
                    <span style="color:var(--accent)">$<?= $p['price'] ?></span>
                </div>
                <div class="bar-track"><div class="bar-fill" style="width:<?= $p['fill'] ?>; background:<?= $p['color'] ?>;"></div></div>
                <div style="font-size:10px; color:var(--muted)"><?= $p['desc'] ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>
function showPanel(name, btn) {
    document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('panel-' + name).classList.add('active');
    btn.classList.add('active');
}
</script>

</body>
</html>
