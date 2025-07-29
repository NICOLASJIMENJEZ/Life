<?php
$conexion = new mysqli("switchyard.proxy.rlwy.net", "root", "yHVACjdVpisuiHXnOqKCEfWbkJuktloQ", "life_gym");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $peso = $_POST['peso'];
    $estatura = $_POST['estatura'];
    $edad = $_POST['edad'];
    $pecho = $_POST['carga_pecho'];
    $sentadilla = $_POST['carga_sentadilla'];
    $biceps = $_POST['carga_biceps'];
    $triceps = $_POST['carga_triceps'];
    $hombro = $_POST['carga_hombro'];

    $sql = "INSERT INTO reportes (nombre, peso, estatura, edad, carga_pecho, carga_sentadilla, carga_biceps, carga_triceps, carga_hombro)
            VALUES ('$nombre', '$peso', '$estatura', '$edad', '$pecho', '$sentadilla', '$biceps', '$triceps', '$hombro')";

    if ($conexion->query($sql) === TRUE) {
        echo "<script>alert('Reporte guardado con éxito'); window.location.href='reportes.php';</script>";
    } else {
        echo "Error: " . $conexion->error;
    }

    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Crear Reporte Físico | Instructor</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>Generar Reporte Físico del Cliente</h2>

<form method="POST" class="row g-3">
  <div class="col-md-6">
    <label>Nombre del Cliente</label>
    <input type="text" name="nombre" class="form-control" required>
  </div>
  <div class="col-md-3">
    <label>Peso (kg)</label>
    <input type="number" step="0.1" name="peso" class="form-control" required>
  </div>
  <div class="col-md-3">
    <label>Estatura (m)</label>
    <input type="number" step="0.01" name="estatura" class="form-control" required>
  </div>
  <div class="col-md-2">
    <label>Edad</label>
    <input type="number" name="edad" class="form-control" required>
  </div>
  <div class="col-md-2">
    <label>Carga Pecho (kg)</label>
    <input type="number" name="carga_pecho" class="form-control" required>
  </div>
  <div class="col-md-2">
    <label>Carga Sentadilla (kg)</label>
    <input type="number" name="carga_sentadilla" class="form-control" required>
  </div>
  <div class="col-md-2">
    <label>Carga Bíceps (kg)</label>
    <input type="number" name="carga_biceps" class="form-control" required>
  </div>
  <div class="col-md-2">
    <label>Carga Tríceps (kg)</label>
    <input type="number" name="carga_triceps" class="form-control" required>
  </div>
  <div class="col-md-2">
    <label>Carga Hombro (kg)</label>
    <input type="number" name="carga_hombro" class="form-control" required>
  </div>
<div class="col-12 d-flex gap-2">
  <button type="submit" class="btn btn-primary">Guardar Reporte</button>
  <a href="dashboard.php" class="btn btn-secondary">Volver</a>
  <a href="reportes_cliente.php" class="btn btn-info text-white">Ver Reportes</a>
</div>

</form>

</body>
</html>
