<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/modelo/conexion.php';

$error   = "";
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre          = htmlspecialchars(trim($_POST['nombre']));
    $apellido        = htmlspecialchars(trim($_POST['apellido']));
    $telefono        = htmlspecialchars(trim($_POST['telefono']));
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $identificacion  = intval($_POST['identificacion']);
    $email           = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password        = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $rol_id          = 1; // Siempre usuario normal
    $fechaRegistro   = date('Y-m-d');

    try {
        $sql = "INSERT INTO usuarios 
            (nombre, apellido, telefono, fechaNacimiento, identificacion, email, password, fecha_registro, rol_id) 
            VALUES (:nombre, :apellido, :telefono, :fechaNacimiento, :identificacion, :email, :password, :fechaRegistro, :rol_id)";

        $stmt = $pdo->prepare(...);
        $stmt->execute([
            ':nombre'          => $nombre,
            ':apellido'        => $apellido,
            ':telefono'        => $telefono,
            ':fechaNacimiento' => $fechaNacimiento,
            ':identificacion'  => $identificacion,
            ':email'           => $email,
            ':password'        => $password,
            ':fechaRegistro'   => $fechaRegistro,
            ':rol_id'          => $rol_id,
        ]);
        $mensaje = "✅ Registro exitoso. Redirigiendo...";
        header("refresh:2;url=../login.php");
    } catch (PDOException $e) {
        $error = "❌ El correo o identificación ya están registrados.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro - Life Gym</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&display=swap" rel="stylesheet">
  <style>
    body { background-color: #000; color: #ccc; font-family: 'Orbitron', sans-serif; padding-top: 50px; }
    .container { background-color: #1a1a1a; padding: 40px; border-radius: 20px; box-shadow: 0 0 25px rgba(0,255,0,0.2); max-width: 600px; }
    h2 { color: #00ff88; text-shadow: 0 0 10px #00ff88; }
    .form-control { background-color: #111; border: 1px solid #00ff88; color: #fff; }
    .form-control:focus { border-color: #00ff88; box-shadow: 0 0 10px #00ff88; background-color: #111; color: #fff; }
    .btn-submit { background-color: #00ff88; border: none; color: #000; font-weight: bold; width: 100%; padding: 12px; margin-top: 20px; border-radius: 25px; }
  </style>
</head>
<body>
  <div class="container">
    <h2 class="text-center mb-4">Registro en Life Gym</h2>
    <form action="" method="POST">
      <div class="mb-3"><label class="form-label">Nombre</label>
        <input type="text" class="form-control" name="nombre" required></div>
      <div class="mb-3"><label class="form-label">Apellido</label>
        <input type="text" class="form-control" name="apellido" required></div>
      <div class="mb-3"><label class="form-label">Teléfono</label>
        <input type="tel" class="form-control" name="telefono" required></div>
      <div class="mb-3"><label class="form-label">Fecha de nacimiento</label>
        <input type="date" class="form-control" name="fechaNacimiento" required></div>
      <div class="mb-3"><label class="form-label">Identificación N°</label>
        <input type="number" class="form-control" name="identificacion" required></div>
      <div class="mb-3"><label class="form-label">Correo electrónico</label>
        <input type="email" class="form-control" name="email" required></div>
      <div class="mb-3"><label class="form-label">Contraseña</label>
        <input type="password" class="form-control" name="password" required minlength="6"></div>
      <button type="submit" class="btn-submit">Registrarse</button>
    </form>
    <?php if ($mensaje): ?><div class="alert alert-success mt-3 text-center"><?= htmlspecialchars($mensaje) ?></div><?php endif; ?>
    <?php if ($error): ?><div class="alert alert-danger mt-3 text-center"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <div class="mt-3 text-center"><a href="../login.php" style="color:#aaa;">¿Ya tienes cuenta? Inicia sesión</a></div>
  </div>
</body>
</html>

