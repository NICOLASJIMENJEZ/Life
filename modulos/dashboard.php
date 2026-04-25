<?php
$databaseUrl = "postgresql://life_gym_db_hvmq_user:lEovCr88q2giz5REW4MwUPePidNosjc1@dpg-d7k1offavr4c73esdbeg-a.oregon-postgres.render.com/life_gym_db_hvmq";

try {
    $db = parse_url($databaseUrl);
    $dsn = "pgsql:host={$db['host']};port=5432;dbname=".ltrim($db['path'], '/').";sslmode=require";
    $pdo = new PDO($dsn, $db['user'], $db['pass'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    // LÓGICA DE ENVÍO: Se activa al presionar "PUBLICAR CLASE"
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['publicar'])) {
        $id_destinatario = $_POST['usuario_id'];
        $tipo = $_POST['tipo_clase'];
        $rutina = $_POST['detalle_rutina'];

        $ins = $pdo->prepare("INSERT INTO clases_asignadas (identificacion_usuario, titulo_clase, contenido_rutina) VALUES (?, ?, ?)");
        $ins->execute([$id_destinatario, $tipo, $rutina]);
        $msg_exito = "Clase enviada con éxito.";
    }

    // CONSULTA PARA LA TABLA DE USUARIOS
    $stmt = $pdo->query("SELECT nombre, apellido, email, identificacion, fecha_registro FROM usuarios ORDER BY id DESC");
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) { $error = $e->getMessage(); }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>GYMCORE ADMIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #0a0a0a; color: white; font-family: sans-serif; }
        .navbar { background-color: #000; padding: 15px; border-bottom: 1px solid #333; }
        .neon-brand { color: #d4ff00; font-weight: bold; font-size: 1.5rem; }
        .card-dark { background-color: #111; border: 1px solid #222; border-radius: 10px; padding: 25px; }
        .btn-neon { background-color: #d4ff00; color: black; font-weight: bold; border: none; width: 100%; padding: 12px; }
        .btn-neon:hover { background-color: #f1ff9d; }
        .form-control, .form-select { background-color: #1a1a1a; border: 1px solid #333; color: white; }
        .table { color: white; background-color: #111; }
        th { color: #888; font-size: 0.8rem; text-transform: uppercase; }
    </style>
</head>
<body>

<nav class="navbar d-flex justify-content-between align-items-center">
    <div class="neon-brand ms-4">GYMCORE ADMIN</div>
    <a href="usuario.php" class="btn btn-outline-light btn-sm me-4">Abrir Vista Usuario ↗</a>
</nav>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-5">
            <div class="card card-dark">
                <h3 style="color: #d4ff00;">Publicar Nueva Clase</h3>
                <form method="POST">
                    <div class="mb-3 mt-4">
                        <label class="text-muted small">Seleccionar Atleta</label>
                        <select name="usuario_id" class="form-select" required>
                            <?php foreach($usuarios as $u): ?>
                                <option value="<?= $u['identificacion'] ?>"><?= htmlspecialchars($u['nombre']) ?> (<?= $u['identificacion'] ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small">Tipo de Clase</label>
                        <select name="tipo_clase" class="form-select">
                            <option>🏋️ Tren Superior</option>
                            <option>🦵 Tren Inferior</option>
                            <option>🔥 Cardio / HIIT</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small">Detalle de la Rutina (Ejercicios, series, reps)</label>
                        <textarea name="detalle_rutina" class="form-control" rows="6" required></textarea>
                    </div>
                    <button type="submit" name="publicar" class="btn btn-neon">PUBLICAR CLASE</button>
                </form>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card card-dark">
                <h4 class="text-muted mb-4">Usuarios Registrados (<?= count($usuarios) ?>)</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Atleta</th>
                                <th>Email</th>
                                <th>Registro</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($usuarios as $u): ?>
                            <tr>
                                <td><?= htmlspecialchars($u['nombre']." ".$u['apellido']) ?></td>
                                <td class="text-muted small"><?= htmlspecialchars($u['email']) ?></td>
                                <td><?= date('d/m/Y', strtotime($u['fecha_registro'])) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
