<?php
// 1. CONFIGURACIÓN DE DATOS (Simulación de DB - Aquí conectarías tu DB de Render)
// Ejemplo de cómo conectarías: $pdo = new PDO("pgsql:host=tu_host_externo;dbname=life_gym_db_hvmq", "user", "pass");

$stats = [
    ['label' => 'Usuarios totales', 'val' => '2', 'sub' => '↑ Activos este mes', 'class' => 's1'],
    ['label' => 'Ingresos / mes', 'val' => '$80K', 'sub' => 'Plan Pro activo', 'class' => 's2'],
    ['label' => 'Clases activas', 'val' => '4', 'sub' => 'Listas para hoy', 'class' => 's3'],
    ['label' => 'Mensajes hoy', 'val' => '12', 'sub' => 'Consultas GymBot', 'class' => 's4'],
];

$usuarios = [
    [
        'nombre' => 'Nicolas Guzman',
        'iniciales' => 'NG',
        'email' => 'nicolasjimenezguzman1@gmail.com',
        'id' => '1193228149',
        'registro' => '22 Abr 2026',
        'estado' => 'Activo',
        'av_class' => 'av-y'
    ],
    [
        'nombre' => 'Nicolas Jimenez',
        'iniciales' => 'NJ',
        'email' => 'nicoezguzman1@gmail.com',
        'id' => '15651561541',
        'registro' => '22 Abr 2026',
        'estado' => 'Activo',
        'av_class' => 'av-b'
    ]
];

$planes = [
    ['name' => 'Plan Básico', 'price' => '50.000', 'fill' => '33%', 'color' => 'var(--muted)', 'desc' => 'Lunes a Viernes'],
    ['name' => 'Plan Pro', 'price' => '80.000', 'fill' => '53%', 'color' => 'var(--blue)', 'desc' => 'Acceso completo + grupales'],
    ['name' => 'Plan Elite', 'price' => '150.000', 'fill' => '100%', 'color' => 'var(--accent)', 'desc' => 'Acceso + Entrenador']
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymCore - Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        /* Mantengo tu CSS intacto para no perder el diseño */
        :root{
            --bg:#0a0a0a;--bg2:#111111;--bg3:#181818;--bg4:#222222;
            --accent:#e8ff00;--accent2:#ff4d00;
            --text:#f0f0f0;--muted:#777;--border:#252525;
            --green:#00c47d;--red:#ff4d4d;--blue:#4da6ff;--purple:#a78bfa;
        }
        *{margin:0;padding:0;box-sizing:border-box;}
        body{background:var(--bg);color:var(--text);font-family:'DM Sans',sans-serif;min-height:100vh;overflow:hidden;}
        
        .nav{display:flex;align-items:center;justify-content:space-between;padding:0 24px;height:56px;background:var(--bg2);border-bottom:1px solid var(--border);}
        .nav-logo{font-family:'Bebas Neue',sans-serif;font-size:26px;letter-spacing:3px;color:var(--accent);}
        .nav-logo span{color:var(--accent2);}
        .nav-tabs{display:flex;gap:4px;}
        .tab-btn{padding:7px 18px;border:none;border-radius:8px;cursor:pointer;font-size:13px;font-weight:500;background:transparent;color:var(--muted);transition:all .2s;}
        .tab-btn.active{background:var(--accent);color:#000;}

        .panel{display:none;height:calc(100vh - 56px);overflow-y:auto;padding:22px 24px;}
        .panel.active{display:block;}

        /* ADMIN COMPONENTS */
        .stats-row{display:grid;grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));gap:12px;margin-bottom:18px;}
        .stat-card{background:var(--bg2);border:1px solid var(--border);border-radius:14px;padding:18px 16px;position:relative;}
        .stat-card::before{content:'';position:absolute;top:0;left:0;right:0;height:3px;border-radius:14px 14px 0 0;}
        .s1::before{background:var(--accent);} .s2::before{background:var(--green);} .s3::before{background:var(--blue);} .s4::before{background:var(--accent2);}
        .stat-val{font-family:'Bebas Neue',sans-serif;font-size:36px;line-height:1;margin:4px 0;}
        .s1 .stat-val{color:var(--accent);} .s2 .stat-val{color:var(--green);}

        .two-col{display:grid;grid-template-columns:1.4fr 1fr;gap:16px;}
        .card{background:var(--bg2);border:1px solid var(--border);border-radius:14px;overflow:hidden;}
        .card-head{padding:14px 18px;border-bottom:1px solid var(--border);display:flex;justify-content:space-between;align-items:center;}
        
        .utbl{width:100%;border-collapse:collapse;}
        .utbl th{font-size:11px;color:var(--muted);text-transform:uppercase;padding:10px 18px;text-align:left;border-bottom:1px solid var(--border);}
        .utbl td{font-size:13px;padding:11px 18px;border-bottom:1px solid rgba(255,255,255,.03);}
        .av{width:30px;height:30px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;}
        .av-y{background:rgba(232,255,0,.15);color:var(--accent);}
        .av-b{background:rgba(77,166,255,.15);color:var(--blue);}

        .plan-row{padding:13px 18px;border-bottom:1px solid rgba(255,255,255,.03);}
        .bar-track{height:4px;background:var(--bg3);border-radius:2px;margin:8px 0;}
        .bar-fill{height:100%;border-radius:2px;}

        /* USER COMPONENTS */
        .user-hero{background:var(--bg2);border-bottom:1px solid var(--border);padding:20px 24px;display:flex;align-items:center;gap:16px;margin:-22px -24px 20px -24px;}
        .hero-av{width:54px;height:54px;border-radius:50%;background:var(--accent);color:#000;font-family:'Bebas Neue',sans-serif;font-size:22px;display:flex;align-items:center;justify-content:center;}
        .user-body{display:grid;grid-template-columns:1fr 1fr;gap:16px;}
        .class-card{background:var(--bg3);border:1px solid var(--border);border-radius:10px;padding:13px;margin-bottom:8px;}
        
        .wa-btn{display:flex;align-items:center;gap:10px;padding:14px 16px;background:#25D366;border-radius:10px;color:#fff;text-decoration:none;font-weight:500;margin-bottom:12px;}
        .chat-box{background:var(--bg2);border:1px solid var(--border);border-radius:12px;height:300px;display:flex;flex-direction:column;}
        .chat-msgs{flex:1;padding:12px;overflow-y:auto;display:flex;flex-direction:column;gap:8px;}
        .msg{max-width:85%;padding:8px 12px;border-radius:10px;font-size:12px;}
        .bot-msg{background:var(--bg3);align-self:flex-start;}
        .usr-msg{background:var(--accent);color:#000;align-self:flex-end;}
        .chat-form{padding:8px;display:flex;gap:5px;border-top:1px solid var(--border);}
        .chat-input{flex:1;background:var(--bg3);border:1px solid var(--border);border-radius:8px;padding:8px;color:#fff;outline:none;}
        .chat-send{background:var(--accent);border:none;padding:0 15px;border-radius:8px;font-weight:700;cursor:pointer;}
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
                <span class="card-title">Usuarios registrados</span>
                <span style="color:var(--green); font-size:11px;">● <?= count($usuarios) ?> activos</span>
            </div>
            <table class="utbl">
                <thead>
                    <tr><th>Usuario</th><th>Email</th><th>Registro</th><th>Estado</th></tr>
                </thead>
                <tbody>
                    <?php foreach($usuarios as $u): ?>
                    <tr>
                        <td>
                            <div style="display:flex;align-items:center;gap:9px;">
                                <div class="av <?= $u['av_class'] ?>"><?= $u['iniciales'] ?></div>
                                <span><?= $u['nombre'] ?></span>
                            </div>
                        </td>
                        <td style="color:var(--muted)"><?= $u['email'] ?></td>
                        <td style="color:var(--muted)"><?= $u['registro'] ?></td>
                        <td><span style="color:var(--green)"><?= $u['estado'] ?></span></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="card">
            <div class="card-head"><span class="card-title">Planes</span></div>
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

<div id="panel-usuario" class="panel">
    <div class="user-hero">
        <div class="hero-av">NG</div>
        <div>
            <div style="font-family:'Bebas Neue'; font-size:24px;">Hola, Nicolas Guzman</div>
            <div style="font-size:12px; color:var(--muted)">Plan Pro • Vence en 28 días</div>
        </div>
    </div>

    <div class="user-body">
        <div>
            <p style="font-size:11px; color:var(--muted); margin-bottom:10px; text-transform:uppercase;">Mis Clases</p>
            <div class="class-card"><strong>🏋️ Musculación</strong><br><small>Lun - Mié - Vie</small></div>
            <div class="class-card"><strong>🤸 Crossfit</strong><br><small>Mar - Jue</small></div>
        </div>

        <div class="right-col">
            <a href="https://wa.me/573168771073" class="wa-btn">WhatsApp Soporte</a>
            <div class="chat-box">
                <div class="chat-msgs" id="chatMsgs">
                    <div class="msg bot-msg">¡Hola! Soy GymBot. ¿En qué puedo ayudarte hoy?</div>
                </div>
                <div class="chat-form">
                    <input type="text" id="chatInput" class="chat-input" placeholder="Escribe...">
                    <button class="chat-send" onclick="sendChat()">></button>
                </div>
            </div>
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

function sendChat() {
    const input = document.getElementById('chatInput');
    const msgs = document.getElementById('chatMsgs');
    if(!input.value.trim()) return;

    const userDiv = document.createElement('div');
    userDiv.className = 'msg usr-msg';
    userDiv.textContent = input.value;
    msgs.appendChild(userDiv);
    
    input.value = '';
    msgs.scrollTop = msgs.scrollHeight;
    
    // Aquí podrías añadir la lógica de Fetch para tu IA
}
</script>

</body>
</html>
