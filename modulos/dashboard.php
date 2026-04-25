<?php
/**
 * LIFE GYM - DASHBOARD CORE
 * Conexión optimizada para PostgreSQL en Render
 */

// 1. CONFIGURACIÓN DE CREDENCIALES
$host     = "dpg-d7k1offavr4c73esdbeg-a.oregon-postgres.render.com"; 
$port     = "5432";
$dbname   = "life_gym_db_hvmq";
$user     = "life_gym_db_hvmq_user";
$password = "lEovCr88qgiz5REW4MwUPePidNosjc1";

try {
    // DSN con SSL forzado para evitar el error "SSL/TLS required"
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";
    
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    $pdo = new PDO($dsn, $user, $password, $options);

    // 2. EXTRACCIÓN DE DATOS
    $stmt = $pdo->query("SELECT nombre, apellido, email, identificacion, fecha_registro FROM usuarios ORDER BY id ASC");
    $db_users = $stmt->fetchAll();

    // 3. ESTADÍSTICAS DINÁMICAS
    $total_users = count($db_users);
    
    $stats = [
        ['label' => 'Usuarios totales', 'val' => $total_users, 'sub' => 'Sincronizado con BD', 'class' => 's1'],
        ['label' => 'Ingresos / mes', 'val' => '$80K', 'sub' => 'Proyección actual', 'class' => 's2'],
        ['label' => 'Clases activas', 'val' => '4', 'sub' => 'Listas para hoy', 'class' => 's3'],
        ['label' => 'Mensajes hoy', 'val' => '12', 'sub' => 'GymBot Activo', 'class' => 's4'],
    ];

    $planes = [
        ['name' => 'Plan Básico', 'price' => '50.000', 'fill' => '33%', 'color' => 'var(--muted)', 'desc' => 'Lunes a Viernes'],
        ['name' => 'Plan Pro', 'price' => '80.000', 'fill' => '53%', 'color' => 'var(--blue)', 'desc' => 'Acceso completo'],
        ['name' => 'Plan Elite', 'price' => '150.000', 'fill' => '100%', 'color' => 'var(--accent)', 'desc' => 'VIP + Entrenador']
    ];

} catch (PDOException $e) {
    // Error controlado para no exponer credenciales en el navegador
    error_log("Fallo de conexión: " . $e->getMessage());
    $error_msg = "Error de conexión con la base de datos. Verifica el modo SSL.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymCore - Life Gym Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root{
            --bg:#0a0a0a;--bg2:#111111;--bg3:#181818;--bg4:#222222;
            --accent:#e8ff00;--accent2:#ff4d00;
            --text:#f0f0f0;--muted:#777;--border:#252525;
            --green:#00c47d;--red:#ff4d4d;--blue:#4da6ff;
        }
        *{margin:0;padding:0;box-sizing:border-box;}
        body{background:var(--bg);color:var(--text);font-family:'DM Sans',sans-serif;min-height:100vh;overflow-x:hidden;}
        
        /* NAVBAR */
        .nav{display:flex;align-items:center;justify-content:space-between;padding:0 24px;height:56px;background:var(--bg2);border-bottom:1px solid var(--border);position:sticky;top:0;z-index:100;}
        .nav-logo{font-family:'Bebas Neue',sans-serif;font-size:26px;letter-spacing:3px;color:var(--accent);cursor:default;}
        .nav-logo span{color:var(--accent2);}
        .nav-tabs{display:flex;gap:4px;}
        .tab-btn{padding:7px 18px;border:none;border-radius:8px;cursor:pointer;font-size:13px;font-weight:500;background:transparent;color:var(--muted);transition:all .2s;}
        .tab-btn.active{background:var(--accent);color:#000;}

        .panel{display:none;padding:22px 24px;}
        .panel.active{display:block;}

        /* CARDS & STATS */
        .stats-row{display:grid;grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));gap:12px;margin-bottom:18px;}
        .stat-card{background:var(--bg2);border:1px solid var(--border);border-radius:14px;padding:18px 16px;position:relative;}
        .stat-card::before{content:'';position:absolute;top:0;left:0;right:0;height:3px;border-radius:14px 14px 0 0;}
        .s1::before{background:var(--accent);} .s2::before{background:var(--green);} .s3::before{background:var(--blue);} .s4::before{background:var(--accent2);}
        .stat-val{font-family:'Bebas Neue',sans-serif;font-size:36px;line-height:1;margin:4px 0;}
        .s1 .stat-val{color:var(--accent);} .s2 .stat-val{color:var(--green);}

        .two-col{display:grid;grid-template-columns:1.4fr 1fr;gap:16px;}
        .card{background:var(--bg2);border:1px solid var(--border);border-radius:14px;overflow:hidden;}
        .card-head{padding:14px 18px;border-bottom:1px solid var(--border);display:flex;justify-content:space-between;align-items:center;}
        
        /* TABLE */
        .utbl{width:100%;border-collapse:collapse;}
        .utbl th{font-size:11px;color:var(--muted);text-transform:uppercase;padding:12px 18px;text-align:left;background:rgba(255,255,255,0.02);}
        .utbl td{font-size:13px;padding:12px 18px;border-bottom:1px solid rgba(255,255,255,.03);}
        .av{width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;background:rgba(232,255,0,0.1);color:var(--accent);border:1px solid rgba(232,255,0,0.2);}

        /* PLAN BARS */
        .plan-row{padding:13px 18px;border-bottom:1px solid rgba(255,255,255,.03);}
        .bar-track{height:6px;background:var(--bg3);border-radius:3px;margin:8px 0;}
        .bar-fill{height:100%;border-radius:3px;transition:width 1s ease-in-out;}

        /* ERROR MESSAGE */
        .error-banner{background:var(--red);color:white;padding:10px;text-align:center;font-size:14px;margin-bottom:10px;border-radius:8px;}
    </style>
</head>
<body>

<div class="nav">
    <div class="nav-logo">GYM<span>CORE</span></div>
    <div class="nav-tabs">
        <button class="tab-btn active" onclick="showPanel('admin', this)">Panel Admin</button>
        <button class="tab-btn" onclick="showPanel('usuario', this)">Vista Cliente</button>
    </div>
</div>

<div id="panel-admin" class="panel active">
    <?php if(isset($error_msg)): ?>
        <div class="error-banner"><?= $error_msg ?></div>
    <?php endif; ?>

    <div class="stats-row">
        <?php foreach($stats as $s): ?>
        <div class="stat-card <?= $s['class'] ?>">
            <div style="font-size:12px; color:var(--muted)"><?= $s['label'] ?></div>
            <div class="stat-val"><?= $s['val'] ?></div>
            <div style="font-size:11px; color:var(--muted)"><?= $s['sub'] ?></div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="two-col">
        <div class="card">
            <div class="card-head">
                <span style="font-weight:700;">Usuarios Registrados</span>
                <span style="color:var(--green); font-size:11px; background:rgba(0,196,125,0.1); padding:2px 8px; border-radius:10px;">
                    ● <?= $total_users ?> Activos
                </span>
            </div>
            <div style="overflow-x:auto;">
                <table class="utbl">
                    <thead>
                        <tr><th>Usuario</th><th>Contacto / Doc</th><th>Registro</th><th>Estado</th></tr>
                    </thead>
                    <tbody>
                        <?php if($total_users > 0): ?>
                            <?php foreach($db_users as $u): 
                                $nom = htmlspecialchars($u['nombre']);
                                $ape = htmlspecialchars($u['apellido']);
                                $ini = strtoupper(substr($nom, 0, 1) . substr($ape, 0, 1));
                            ?>
                            <tr>
                                <td>
                                    <div style="display:flex;align-items:center;gap:10px;">
                                        <div class="av"><?= $ini ?></div>
                                        <div style="display:flex; flex-direction:column;">
                                            <span><?= $nom . " " . $ape ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td style="color:var(--muted)">
                                    <?= htmlspecialchars($u['email']) ?><br>
                                    <small>CC: <?= htmlspecialchars($u['identificacion']) ?></small>
                                </td>
                                <td style="color:var(--muted)"><?= htmlspecialchars($u['fecha_registro']) ?></td>
                                <td><span style="color:var(--green)">Activo</span></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="4" style="text-align:center; padding:30px; color:var(--muted);">No hay usuarios registrados en la base de datos.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-head"><span style="font-weight:700;">Rendimiento de Planes</span></div>
            <?php foreach($planes as $p): ?>
            <div class="plan-row">
                <div style="display:flex; justify-content:space-between; font-size:13px; margin-bottom:4px;">
                    <span><?= $p['name'] ?></span>
                    <span style="color:var(--accent); font-weight:700;">$<?= $p['price'] ?></span>
                </div>
                <div class="bar-track">
                    <div class="bar-fill" style="width:<?= $p['fill'] ?>; background:<?= $p['color'] ?>;"></div>
                </div>
                <div style="font-size:10px; color:var(--muted);"><?= $p['desc'] ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div id="panel-usuario" class="panel">
    <div style="background:var(--bg2); padding:40px; border-radius:14px; border:1px dashed var(--border); text-align:center;">
        <h2 style="font-family:'Bebas Neue'; font-size:32px; color:var(--accent); margin-bottom:10px;">Área de Cliente</h2>
        <p style="color:var(--muted);">Esta sección está vinculada al perfil de <strong><?= htmlspecialchars($db_users[0]['nombre'] ?? 'Usuario') ?></strong>.</p>
    </div>
</div>

<script>
/**
 * Lógica de navegación del Dashboard
 */
function showPanel(name, btn) {
    document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    
    const target = document.getElementById('panel-' + name);
    if(target) {
        target.classList.add('active');
        btn.classList.add('active');
    }
}
</script>

</body>
</html>
