<?php
include '../modelo/conexion.php';
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $identificacion = $_POST['identificacion'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $rol_id = $_POST['rol_id'];

    if (empty($rol_id)) {
        echo "❌ Debes seleccionar un rol.";
        exit();
    }

    $sql = "INSERT INTO usuarios (nombre, apellido, telefono, fechaNacimiento, identificacion, email, password, rol_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param("sssssssi", $nombre, $apellido, $telefono, $fechaNacimiento, $identificacion, $email, $password, $rol_id);

        if ($stmt->execute()) {
            header("Location: login.php");
            exit();
        } else {
            echo "❌ Error al registrar: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "❌ Error al preparar la consulta: " . $conexion->error;
    }

    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro - Life Gym</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap & Google Fonts -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&display=swap" rel="stylesheet">

  <style>
    body {
      background-color: #000;
      color: #ccc;
      font-family: 'Orbitron', sans-serif;
      padding-top: 50px;
    }

    .container {
      background-color: #1a1a1a;
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 0 25px rgba(0, 255, 0, 0.2);
      max-width: 600px;
    }

    h2 {
      color: #00ff88;
      text-shadow: 0 0 10px #00ff88;
    }

    label {
      color: #ccc;
    }

    .form-control, .form-select {
      background-color: #111;
      border: 1px solid #00ff88;
      color: #fff;
    }

    .form-control:focus, .form-select:focus {
      border-color: #00ff88;
      box-shadow: 0 0 10px #00ff88;
      background-color: #111;
      color: #fff;
    }

    .btn-submit {
      background-color: #00ff88;
      border: none;
      color: #000;
      font-weight: bold;
      width: 100%;
      padding: 12px;
      margin-top: 20px;
      border-radius: 25px;
      box-shadow: 0 0 15px #00ff88;
      transition: 0.3s ease;
    }

    .btn-submit:hover {
      background-color: #00cc6a;
      box-shadow: 0 0 30px #00ff88;
      transform: scale(1.03);
    }

    a.text-white {
      color: #aaa !important;
      text-decoration: none;
      transition: color 0.3s;
    }

    a.text-white:hover {
      color: #00ff88 !important;
    }
  </style>
</head>
<body>

  <div class="container">
    <h2 class="text-center mb-4">Registro en Life Gym</h2>
    <form action="" method="POST">
      <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required>
      </div>
      <div class="mb-3">
        <label for="apellido" class="form-label">Apellido</label>
        <input type="text" class="form-control" id="apellido" name="apellido" required>
      </div>
      <div class="mb-3">
        <label for="telefono" class="form-label">Teléfono</label>
        <input type="tel" class="form-control" id="telefono" name="telefono" required>
      </div>
      <div class="mb-3">
        <label for="fechaNacimiento" class="form-label">Fecha de nacimiento</label>
        <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" required>
      </div>
      <div class="mb-3">
        <label for="identificacion" class="form-label">Identificación N°</label>
        <input type="number" class="form-control" id="identificacion" name="identificacion" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Correo electrónico</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <div class="mb-3">
        <label for="rol_id" class="form-label">Rol</label>
        <select class="form-select" id="rol_id" name="rol_id" required>
          <option value="">Seleccione un rol</option>
          <option value="1">Usuario</option>
          <option value="2">Administrador</option>
        </select>
      </div>
      <button type="submit" class="btn-submit">Registrarse</button>
    </form>

    <div class="mt-3 text-center">
      <a href="login.php" class="text-white">¿Ya tienes cuenta? Inicia sesión aquí</a>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
