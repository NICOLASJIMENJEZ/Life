<?php

$host = "dpg-d24l0l15pdvs73bvvmq0-a.oregon-postgres.render.com";
$port = 5432;
$db = "life_gym_db";
$user = "life_gym_db_user";
$pass = "0BaR53ptUeZaLHwtIBbMtuZ6cvYtCu3p";

try {
    $conexion = new PDO("pgsql:host=$host;port=$port;dbname=$db;sslmode=require", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}



try {
    $conexion = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

$nombreCliente = isset($_GET['nombre']) ? urldecode($_GET['nombre']) : '';

// Eliminar
if (isset($_POST['eliminar_id'])) {
    $idEliminar = intval($_POST['eliminar_id']);
    $stmt = $conexion->prepare("DELETE FROM reportes WHERE id = :id");
    $stmt->execute([':id' => $idEliminar]);
}

// Actualizar
if (isset($_POST['actualizar_id'])) {
    $id = intval($_POST['actualizar_id']);
    $peso = $_POST['peso'];
    $estatura = $_POST['estatura'];
    $edad = $_POST['edad'];
    $pecho = $_POST['carga_pecho'];
    $sentadilla = $_POST['carga_sentadilla'];
    $biceps = $_POST['carga_biceps'];
    $triceps = $_POST['carga_triceps'];
    $hombro = $_POST['carga_hombro'];

$stmt = $conexion->prepare("SELECT * FROM reportes WHERE nombre = :nombre ORDER BY fecha_reporte DESC");
$stmt->execute([':nombre' => $nombreCliente]);
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!empty($resultado)) {
    foreach ($resultado as $fila) {
        echo "<tr>
                <td>{$fila['fecha_reporte']}</td>
                <td>{$fila['peso']}</td>
                <td>{$fila['estatura']}</td>
                <td>{$fila['edad']}</td>
                <td>{$fila['carga_pecho']}</td>
                <td>{$fila['carga_sentadilla']}</td>
                <td>{$fila['carga_biceps']}</td>
                <td>{$fila['carga_triceps']}</td>
                <td>{$fila['carga_hombro']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='9'>No hay reportes para este cliente.</td></tr>";
}

// Cerrar conexión correctamente
$conexion = null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reporte de <?php echo htmlspecialchars($nombreCliente); ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>Reporte físico de: <?php echo htmlspecialchars($nombreCliente); ?></h2>

<table class="table table-bordered table-striped mt-4">
  <thead class="table-dark">
    <tr>
      <th>Fecha</th>
      <th>Peso</th>
      <th>Estatura</th>
      <th>Edad</th>
      <th>Pecho</th>
      <th>Sentadilla</th>
      <th>Bíceps</th>
      <th>Tríceps</th>
      <th>Hombro</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            echo "
            <form method='POST' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "?nombre=" . urlencode($nombreCliente) . "'>
            <tr>
                <td>{$fila['fecha_reporte']}</td>
                <td><input type='number' step='0.1' name='peso' value='{$fila['peso']}' class='form-control'></td>
                <td><input type='number' step='0.01' name='estatura' value='{$fila['estatura']}' class='form-control'></td>
                <td><input type='number' name='edad' value='{$fila['edad']}' class='form-control'></td>
                <td><input type='number' name='carga_pecho' value='{$fila['carga_pecho']}' class='form-control'></td>
                <td><input type='number' name='carga_sentadilla' value='{$fila['carga_sentadilla']}' class='form-control'></td>
                <td><input type='number' name='carga_biceps' value='{$fila['carga_biceps']}' class='form-control'></td>
                <td><input type='number' name='carga_triceps' value='{$fila['carga_triceps']}' class='form-control'></td>
                <td><input type='number' name='carga_hombro' value='{$fila['carga_hombro']}' class='form-control'></td>
                <td class='d-flex flex-column gap-1'>
                    <input type='hidden' name='actualizar_id' value='{$fila['id']}'>
                    <button type='submit' class='btn btn-sm btn-primary'>Guardar</button>
            </form>
            <form method='POST' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "?nombre=" . urlencode($nombreCliente) . "'>
                    <input type='hidden' name='eliminar_id' value='{$fila['id']}'>
                    <button type='submit' class='btn btn-sm btn-danger' onclick='return confirm(\"¿Eliminar este reporte?\")'>Eliminar</button>
                </form>
                </td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='10'>No hay reportes disponibles.</td></tr>";
    }

    $conexion->close();
    ?>
  </tbody>
</table>

<a href="reportes_cliente.php" class="btn btn-secondary">Volver</a>

</body>
</html>
