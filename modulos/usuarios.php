<?php
$conexion = new mysqli("switchyard.proxy.rlwy.net", "root", "yHVACjdVpisuiHXnOqKCEfWbkJuktloQ", "life_gym");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Usuarios | Life Gym</title>
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

<h2>Usuarios Registrados</h2>

<table class="table table-dark table-striped mt-4">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Apellido</th>
      <th>Teléfono</th>
      <th>Identificación</th>
      <th>Email</th>
      <th>Fecha de Nacimiento</th>
      <th>Rol</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sql = "SELECT id, nombre, apellido, telefono, identificacion, email, fechaNacimiento, rol_id FROM usuarios";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>
                    <td>{$fila['id']}</td>
                    <td>{$fila['nombre']}</td>
                    <td>{$fila['apellido']}</td>
                    <td>{$fila['telefono']}</td>
                    <td>{$fila['identificacion']}</td>
                    <td>{$fila['email']}</td>
                    <td>{$fila['fechaNacimiento']}</td>
                    <td>{$fila['rol_id']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No hay usuarios registrados.</td></tr>";
    }

    $conexion->close();
    ?>
  </tbody>
</table>

<a href="dashboard.php" class="btn btn-success">Volver al Dashboard</a>

</body>
</html>
