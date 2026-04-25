<?php
// 🔐 URL DE RENDER
$databaseUrl = "postgresql://life_gym_db_hvmq_user:lEovCr88q2giz5REW4MwUPePidNosjc1@dpg-d7k1offavr4c73esdbeg-a.oregon-postgres.render.com/life_gym_db_hvmq";

// 🔥 INICIALIZACIÓN SEGURA
$db_users = [];
$total_users = 0;
$error_msg = null;

try {

    $db = parse_url($databaseUrl);

    if (!$db) {
        throw new Exception("Error parseando la URL de la base de datos");
    }

    $host = $db['host'];
    $port = $db['port'] ?? 5432;
    $dbname = ltrim($db['path'], '/');
    $user = $db['user'];
    $password = $db['pass'];

    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";

    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    // 🔥 CONSULTA
    $stmt = $pdo->query("
        SELECT nombre, apellido, email, identificacion, fecha_registro 
        FROM usuarios
        ORDER BY id DESC
    ");

    $db_users = $stmt->fetchAll();
    $total_users = count($db_users);

} catch (Exception $e) {
    $error_msg = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>GYMCORE</title>

<style>
body{background:#0a0a0a;color:#fff;font-family:sans-serif;margin:0}
.nav{padding:15px;background:#111}
button{margin-right:10px;padding:8px;cursor:pointer}
.card{background:#111;margin:20px;padding:15px;border-radius:10px}
.class-card{display:block;background:#181818;margin:5px;padding:10px;border:none;color:#fff;width:100%;text-align:left}
</style>

<script>
function showPanel(p){
    document.getElementById('admin').style.display = (p==='admin')?'block':'none';
    document.getElementById('user').style.display = (p==='user')?'block':'none';
}
</script>

</head>

<body>

<div class="nav">
    <h2>GYMCORE</h2>
    <button onclick="showPanel('admin')">Admin</button>
    <button onclick="showPanel('user')">Usuario</button>
</div>

<!-- ERROR -->
<?php if(!empty($error_msg)): ?>
<div style="background:red;padding:10px;">
⚠️ <?= htmlspecialchars($error_msg) ?>
</div>
<?php endif; ?>

<!-- ================= ADMIN ================= -->
<div id="admin" class="card">

<h3>Usuarios (<?= $total_users ?>)</h3>

<table border="1" width="100%">
<tr>
<th>Nombre</th>
<th>Email</th>
<th>ID</th>
<th>Registro</th>
</tr>

<?php if($total_users > 0): ?>
    <?php foreach($db_users as $u): ?>
    <tr>
        <td><?= htmlspecialchars($u['nombre']." ".$u['apellido']) ?></td>
        <td><?= htmlspecialchars($u['email']) ?></td>
        <td><?= htmlspecialchars($u['identificacion']) ?></td>
        <td><?= htmlspecialchars($u['fecha_registro']) ?></td>
    </tr>
    <?php endforeach; ?>
<?php else: ?>
<tr><td colspan="4">Sin usuarios registrados</td></tr>
<?php endif; ?>

</table>

</div>

<!-- ================= USUARIO ================= -->
<div id="user" class="card" style="display:none;">

<h3>Seleccionar Clase</h3>

<form action="cuenta.php" method="POST">

<button class="class-card" name="clase" value="Musculacion">🏋️ Musculación</button>
<button class="class-card" name="clase" value="Crossfit">🤸 Crossfit</button>
<button class="class-card" name="clase" value="Yoga">🧘 Yoga</button>
<button class="class-card" name="clase" value="Spinning">🚴 Spinning</button>

</form>

</div>

</body>
</html>
