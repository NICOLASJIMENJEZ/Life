<?php
// 🔐 CONEXIÓN RENDER (CORRECTA)
$databaseUrl = "postgresql://life_gym_db_hvmq_user:lEovCr88q2giz5REW4MwUPePidNosjc1@dpg-d7k1offavr4c73esdbeg-a.oregon-postgres.render.com/life_gym_db_hvmq";

try {

    $db = parse_url($databaseUrl);

    if (!$db) {
        throw new Exception("Error parseando DATABASE_URL");
    }

    $host = $db['host'];
    $port = isset($db['port']) ? $db['port'] : 5432; // 🔥 FIX
    $dbname = ltrim($db['path'], '/');
    $user = $db['user'];
    $password = $db['pass'];

    // 🔐 DSN correcto
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";

    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    // TEST
    $pdo->query("SELECT 1");

    echo "✅ Conectado correctamente";

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>GYMCORE</title>
<style>
/* (dejé tu CSS intacto resumido) */
body{background:#0a0a0a;color:#fff;font-family:sans-serif;}
.nav{padding:15px;background:#111;}
.card{background:#111;margin:10px;padding:15px;border-radius:10px;}
.class-card{background:#181818;padding:10px;margin:5px;border-radius:8px;cursor:pointer;}
button{cursor:pointer;}
</style>
</head>

<body>

<div class="nav">
<h2>GYMCORE</h2>
<button onclick="showPanel('admin')">Admin</button>
<button onclick="showPanel('usuario')">Usuario</button>
</div>

<?php if($error_msg): ?>
<div style="background:red;padding:10px;">⚠️ <?= $error_msg ?></div>
<?php endif; ?>

<!-- 🔥 ADMIN -->
<div id="panel-admin">

<div class="card">
<h3>Usuarios (<?= $total_users ?>)</h3>

<table border="1" width="100%">
<tr><th>Nombre</th><th>Email</th><th>ID</th><th>Registro</th></tr>

<?php foreach($db_users as $u): ?>
<tr>
<td><?= $u['nombre']." ".$u['apellido'] ?></td>
<td><?= $u['email'] ?></td>
<td><?= $u['identificacion'] ?></td>
<td><?= $u['fecha_registro'] ?></td>
</tr>
<?php endforeach; ?>

</table>
</div>

</div>

<!-- 🔥 USUARIO -->
<div id="panel-usuario" style="display:none;">

<div class="card">
<h3>Clases disponibles</h3>

<!-- ✅ CADA CLASE ENVÍA A cuenta.php -->
<form action="cuenta.php" method="POST">
<button class="class-card" name="clase" value="Musculacion">🏋️ Musculación</button>
<button class="class-card" name="clase" value="Crossfit">🤸 Crossfit</button>
<button class="class-card" name="clase" value="Yoga">🧘 Yoga</button>
<button class="class-card" name="clase" value="Spinning">🚴 Spinning</button>
</form>

</div>

</div>

<script>
function showPanel(p){
document.getElementById('panel-admin').style.display = p==='admin'?'block':'none';
document.getElementById('panel-usuario').style.display = p==='usuario'?'block':'none';
}
</script>

</body>
</html>
