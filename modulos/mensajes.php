<?php
$host = "dpg-d24l0l15pdvs73bvvmq0-a.oregon-postgres.render.com";// Ej: dpg-xxxxxxx.oregon-postgres.render.com
$port = 5432;
$dbname = 'life_gym_db';
$username = 'life_gym_db_user';
$password = '0BaR53ptUeZaLHwtIBbMtuZ6cvYtCu3p';

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $conexion = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    // echo "✅ Conexión exitosa a PostgreSQL.";
} catch (PDOException $e) {
    die("❌ Error de conexión: " . $e->getMessage());
}
?>





<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mensajes de Contacto | Life Gym</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #000;
      color: #fff;
    }
    .table-dark th, .table-dark td {
      color: #fff;
    }
  </style>
</head>
<body class="container mt-5">

<h2>Mensajes de Contacto</h2>

<table class="table table-dark table-striped mt-4">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Email</th>
      <th>Mensaje</th>
      <th>Fecha de Envío</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sql = "SELECT id, nombre, email, mensaje, fecha_envio FROM contactos";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>
                    <td>{$fila['id']}</td>
                    <td>{$fila['nombre']}</td>
                    <td>{$fila['email']}</td>
                    <td>{$fila['mensaje']}</td>
                    <td>{$fila['fecha_envio']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No hay mensajes registrados.</td></tr>";
    }

    $conexion->close();
    ?>
  </tbody>
</table>

<a href="dashboard.php" class="btn btn-success">Volver al Dashboard</a>

</body>
</html>
