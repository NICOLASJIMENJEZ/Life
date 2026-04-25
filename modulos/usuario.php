<?php
// Configuración de conexión (Tu lógica original)
$databaseUrl = "postgresql://life_gym_db_hvmq_user:lEovCr88q2giz5REW4MwUPePidNosjc1@dpg-d7k1offavr4c73esdbeg-a.oregon-postgres.render.com/life_gym_db_hvmq";
$db_users = [];
$total_users = 0;
$error_msg = null;

try {
    $db = parse_url($databaseUrl);
    $dsn = "pgsql:host={$db['host']};port=5432;dbname=".ltrim($db['path'], '/').";sslmode=require";
    $pdo = new PDO($dsn, $db['user'], $db['pass'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $stmt = $pdo->query("SELECT nombre, apellido, email, identificacion, fecha_registro FROM usuarios ORDER BY id DESC");
    $db_users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $total_users = count($db_users);
} catch (Exception $e) { $error_msg = $e->getMessage(); }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>GYMCORE | Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #0a0a0a; color: #fff; font-family: 'Segoe UI', sans-serif; }
        .card-custom { background: #111; border: 1px solid #333; border-radius: 12px; margin-bottom: 20px; }
        .neon-text { color: #d4ff00; }
        .btn-neon { background: #d4ff00; color: #000; font-weight: bold; border: none; }
        .btn-neon:hover { background: #b8e600; }
        .table { color: #fff; border-color: #333; }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-black border-bottom border-secondary mb-4">
    <div class="container">
        <span class="navbar-brand fw-bold neon-text">GYMCORE ADMIN</span>
        <a href="usuario.php" target="_blank" class="btn btn-outline-light btn-sm">Abrir Vista Usuario ↗</a>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-5">
            <div class="card card-custom p-4">
                <h4 class="neon-text mb-3">Publicar Nueva Clase</h4>
                <div class="mb-3">
                    <label class="form-label text-muted">Tipo de Clase</label>
                    <select id="tipoClase" class="form-select bg-dark text-white border-secondary">
                        <option value="Tren Superior">🏋️ Tren Superior</option>
                        <option value="Tren Inferior">🦵 Tren Inferior</option>
                        <option value="Cardio/Box">🔥 Cardio / Box</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted">Detalle de la Rutina (Ejercicios, series, reps)</label>
                    <textarea id="detalleClase" class="form-control bg-dark text-white border-secondary" rows="5" placeholder="Ej: Press Banca 4x12..."></textarea>
                </div>
                <button onclick="enviarClase()" class="btn btn-neon w-100">PUBLICAR CLASE</button>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card card-custom p-4">
                <h4 class="mb-3">Usuarios Registrados (<?= $total_users ?>)</h4>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Atleta</th>
                                <th>Email</th>
                                <th>Registro</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($db_users as $u): ?>
                            <tr>
                                <td><?= htmlspecialchars($u['nombre']." ".$u['apellido']) ?></td>
                                <td class="text-muted small"><?= htmlspecialchars($u['email']) ?></td>
                                <td class="small"><?= date('d/m/Y', strtotime($u['fecha_registro'])) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function enviarClase() {
        const titulo = document.getElementById('tipoClase').value;
        const contenido = document.getElementById('detalleClase').value;
        
        if(!contenido) return alert("Escribe los ejercicios primero");

        const claseData = {
            titulo: titulo,
            contenido: contenido,
            fecha: new Date().toLocaleTimeString()
        };

        // Guardamos en LocalStorage para que el otro archivo lo reciba
        localStorage.setItem('ultima_clase', JSON.stringify(claseData));
        alert("¡Clase enviada al muro de los usuarios!");
        document.getElementById('detalleClase').value = "";
    }
</script>

</body>
</html>
