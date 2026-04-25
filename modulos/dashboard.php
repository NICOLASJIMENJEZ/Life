<?php
$databaseUrl = "postgresql://life_gym_db_hvmq_user:lEovCr88q2giz5REW4MwUPePidNosjc1@dpg-d7k1offavr4c73esdbeg-a.oregon-postgres.render.com/life_gym_db_hvmq";

try {
    $db = parse_url($databaseUrl);
    $dsn = "pgsql:host={$db['host']};port=5432;dbname=".ltrim($db['path'], '/').";sslmode=require";
    $pdo = new PDO($dsn, $db['user'], $db['pass'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    // 1. LÓGICA DE ENVÍO DE CLASE PRIVADA
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enviar'])) {
        $user_id = $_POST['atleta_id'];
        $titulo = $_POST['tipo_clase'];
        $rutina = $_POST['rutina_texto'];

        $ins = $pdo->prepare("INSERT INTO clases_individuales (usuario_identificacion, titulo_clase, detalle_rutina) VALUES (?, ?, ?)");
        $ins->execute([$user_id, $titulo, $rutina]);
        $success = "¡Rutina enviada con éxito!";
    }

    // 2. OBTENER LISTA DE USUARIOS REALES DE LA DB
    $stmt = $pdo->query("SELECT nombre, apellido, email, identificacion FROM usuarios ORDER BY nombre ASC");
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) { $error = $e->getMessage(); }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>GYMCORE | Admin Master</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #0a0a0a; color: #fff; font-family: 'Segoe UI', sans-serif; }
        .neon-text { color: #d4ff00; }
        .card-gym { background: #111; border: 1px solid #333; border-radius: 15px; }
        .btn-neon { background: #d4ff00; color: #000; font-weight: bold; border: none; }
        .btn-neon:hover { background: #b8e600; box-shadow: 0 0 15px rgba(212, 255, 0, 0.4); }
        .form-control, .form-select { background: #1a1a1a; border: 1px solid #333; color: #fff; }
        .form-control:focus { background: #222; color: #fff; border-color: #d4ff00; box-shadow: none; }
    </style>
</head>
<body>

<div class="container py-5">
    <h2 class="fw-bold mb-4">GYMCORE <span class="neon-text">ADMIN</span></h2>

    <?php if(isset($success)): ?>
        <div class="alert alert-success bg-dark text-success border-success"><?= $success ?></div>
    <?php endif; ?>

    <div class="row g-4">
        <div class="col-md-5">
            <div class="card card-gym p-4 shadow-lg">
                <h4 class="neon-text mb-4">Publicar Clase Individual</h4>
                <form method="POST">
                    <div class="mb-3">
                        <label class="text-muted small">SELECCIONAR ATLETA DESTINO</label>
                        <select name="atleta_id" class="form-select" required>
                            <option value="">-- Elegir Usuario --</option>
                            <?php foreach($usuarios as $u): ?>
                                <option value="<?= $u['identificacion'] ?>">
                                    <?= htmlspecialchars($u['nombre']." ".$u['apellido']) ?> (ID: <?= $u['identificacion'] ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="text-muted small">TIPO DE CLASE</label>
                        <select name="tipo_clase" class="form-select">
                            <option>🏋️ Tren Superior</option>
                            <option>🦵 Tren Inferior</option>
                            <option>🥊 Cardio / Box</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="text-muted small">RUTINA (Series, Reps, Notas)</label>
                        <textarea name="rutina_texto" class="form-control" rows="6" required placeholder="Escribe los ejercicios aquí..."></textarea>
                    </div>

                    <button type="submit" name="enviar" class="btn btn-neon w-100 py-2">ENVIAR A CUENTA DE USUARIO</button>
                </form>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card card-gym p-4 h-100">
                <h4 class="text-muted mb-4">Usuarios Conectados</h4>
                <div class="table-responsive">
                    <table class="table table-dark table-hover">
                        <thead>
                            <tr class="text-muted small">
                                <th>Atleta</th>
                                <th>ID / Identificación</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($usuarios as $u): ?>
                            <tr>
                                <td><?= htmlspecialchars($u['nombre']." ".$u['apellido']) ?></td>
                                <td><span class="badge bg-dark border border-secondary text-info"><?= $u['identificacion'] ?></span></td>
                                <td class="text-muted small"><?= $u['email'] ?></td>
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
