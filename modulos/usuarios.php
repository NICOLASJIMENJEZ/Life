<?php
$host = "dpg-d24l0l15pdvs73bvvmq0-a";
$port = "5432";
$dbname = "life_gym_db";
$username = "life_gym_db_user";
$password = "0BaR53ptUeZaLHwtIBbMtuZ6cvYtCu3p";

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $conexion = new PDO($dsn, $username, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexion->exec("SET NAMES 'UTF8'");
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
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

    try {
        $resultado = $conexion->query($sql);

        if ($resultado->rowCount() > 0) {
            while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                        <td>{$fila['id']}</td>
                        <td>{$fila['nombre']}</td>
                        <td>{$fila['apellido']}</td>
                        <td>{$fila['telefono']}</td>
                        <td>{$fila['identificacion']}</td>
                        <td>{$fila['email']}</td>
                      <td>{$fila['fechanacimiento']}</td>
                        <td>{$fila['rol_id']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No hay usuarios registrados.</td></tr>";
        }
    } catch (PDOException $e) {
        echo "<tr><td colspan='8'>Error al consultar usuarios: " . $e->getMessage() . "</td></tr>";
    }

    // Cerrar conexión
    $conexion = null;
    ?>
  </tbody>
</table>

<a href="dashboard.php" class="btn btn-success">Volver al Dashboard</a>

</body>
</html>