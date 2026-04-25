<?php
$databaseUrl = "postgresql://life_gym_db_hvmq_user:lEovCr88q2giz5REW4MwUPePidNosjc1@dpg-d7k1offavr4c73esdbeg-a.oregon-postgres.render.com/life_gym_db_hvmq";

try {
    $db = parse_url($databaseUrl);
    $dsn = "pgsql:host={$db['host']};port=5432;dbname=".ltrim($db['path'], '/').";sslmode=require";
    $pdo = new PDO($dsn, $db['user'], $db['pass'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    // LÓGICA DE ENVÍO DE CLASE
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enviar_clase'])) {
        $id_user = $_POST['usuario_destino'];
        $titulo = $_POST['tipoClase'];
        $rutina = $_POST['mensajeClase'];

        $ins = $pdo->prepare("INSERT INTO clases_asignadas (identificacion_usuario, titulo_clase, contenido_rutina) VALUES (?, ?, ?)");
        $ins->execute([$id_user, $titulo, $rutina]);
        $success = "✅ Clase enviada correctamente al usuario $id_user";
    }

    // LISTAR USUARIOS PARA EL SELECT Y LA TABLA
    $stmt = $pdo->query("SELECT nombre, apellido, email, identificacion FROM usuarios ORDER BY id DESC");
    $db_users = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) { $error_msg = $e->getMessage(); }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>GYMCORE | Panel de Control Profesional</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #080808; color: #fff; font-family: 'Inter', sans-serif; }
        .card-gym { background: #111; border: 1px solid #222; border-radius: 15px; height: 100%; }
        .neon-border { border-top: 3px solid #d4ff00; }
        .btn-neon { background: #d4ff00; color: #000; font-weight: bold; }
        .form-control, .form-select { background: #1a1a1a; border: 1px solid #333; color: #fff; }
        .form-control:focus { background: #222; color: #fff; border-color: #d4ff00; box-shadow: none; }
    </style>
</head>
<body>

<div class="container py-5">
    <h2 class="mb-4 fw-bold"><span style="color:#d4ff00">GYM</span>CORE MASTER DASHBOARD</h2>

    <?php if(isset($success)): ?>
        <div class="alert alert-success bg-dark text-success border-success"><?= $success ?></div>
    <?php endif; ?>

    <div class="row g-4">
        <div class="col-lg-5">
            <div class="card card-gym neon-border p-4">
                <h4 class="mb-4">Asignar Rutina Personalizada</h4>
                <form method="POST">
                    <div class="mb-3">
                        <label class="small text-muted">SELECCIONAR ATLETA</label>
                        <select name="usuario_destino" class="form-select" required>
                            <option value="">-- Seleccione un usuario --</option>
                            <?php foreach($db_users as $u): ?>
                                <option value="<?= $u['identificacion'] ?>">
                                    <?= htmlspecialchars($u['nombre'] . " " . $u['apellido']) ?> (ID: <?= $u['identificacion'] ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="small text-muted">TIPO DE CLASE</label>
                        <select name="tipoClase" class="form-select">
                            <option>Tren Superior 🏋️</option>
                            <option>Tren Inferior 🦵</option>
                            <option>Resistencia/HIIT 🔥</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="small text-muted">RUTINA (Series y Repeticiones)</label>
                        <textarea name="mensajeClase" class="form-control" rows="6" required placeholder="Escribe aquí el entrenamiento..."></textarea>
                    </div>

                    <button type="submit" name="enviar_clase" class="btn btn-neon w-100 py-3">ENVIAR RUTINA AL USUARIO</button>
                </form>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card card-gym p-4">
                <h4 class="mb-4">Usuarios en el Sistema</h4>
                <div class="table-responsive">
                    <table class="table table-dark table-hover">
                        <thead>
                            <tr class="text-muted">
                                <th>Nombre</th>
                                <th>Identificación</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($db_users as $u): ?>
                            <tr>
                                <td><?= htmlspecialchars($u['nombre']) ?></td>
                                <td><span class="badge bg-secondary"><?= htmlspecialchars($u['identificacion']) ?></span></td>
                                <td class="text-muted small"><?= htmlspecialchars($u['email']) ?></td>
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
