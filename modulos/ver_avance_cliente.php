<?php

$host = "dpg-d24l0l15pdvs73bvvmq0-a.oregon-postgres.render.com";
$port = "5432";
$db = "life_gym_db"; // Asegúrate que el nombre esté bien escrito
$user = "life_gym_db_user";
$pass = "0BaR53ptUeZaLHwtIBbMtuZ6cvYtCu3p";

try {
    $conexion = new PDO("pgsql:host=$host;port=$port;dbname=$db;sslmode=require", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}


$nombreCliente = isset($_GET['nombre']) ? $_GET['nombre'] : '';

$fechas = [];
$peso = [];
$pecho = [];
$sentadilla = [];
$biceps = [];
$triceps = [];
$hombro = [];
$estatura = [];
$edad = [];
$resultado = [];

if ($nombreCliente !== '') {
    $stmt = $conexion->prepare("SELECT * FROM reportes WHERE nombre = :nombre ORDER BY fecha_reporte ASC");
    $stmt->execute([':nombre' => $nombreCliente]);
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($resultado as $fila) {
        $fechas[] = $fila['fecha_reporte'];
        $peso[] = $fila['peso'];
        $pecho[] = $fila['carga_pecho'];
        $sentadilla[] = $fila['carga_sentadilla'];
        $biceps[] = $fila['carga_biceps'];
        $triceps[] = $fila['carga_triceps'];
        $hombro[] = $fila['carga_hombro'];
        $estatura[] = $fila['estatura'];
        $edad[] = $fila['edad'];
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Avance Físico de <?= htmlspecialchars($nombreCliente) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="container mt-5">

<h2>Visualización de Progreso Físico</h2>

<form method="GET" class="mb-4">
  <label for="nombre">Buscar por nombre:</label>
  <div class="input-group">
    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ej: Nicolas" required>
    <button type="submit" class="btn btn-primary">Ver Reportes</button>
  </div>
</form>

<?php if ($nombreCliente !== '' && count($fechas) > 0): ?>
  <h4 class="mt-4">Resultados para: <strong><?= htmlspecialchars($nombreCliente) ?></strong></h4>

  <!-- GRÁFICA DE BARRAS -->
  <canvas id="grafico" height="100"></canvas>

  <script>
    const ctx = document.getElementById('grafico').getContext('2d');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: <?= json_encode($fechas); ?>,
        datasets: [
          {
            label: 'Peso (kg)',
            data: <?= json_encode($peso); ?>,
            backgroundColor: 'rgba(54, 162, 235, 0.6)'
          },
          {
            label: 'Pecho (kg)',
            data: <?= json_encode($pecho); ?>,
            backgroundColor: 'rgba(255, 99, 132, 0.6)'
          },
          {
            label: 'Sentadilla (kg)',
            data: <?= json_encode($sentadilla); ?>,
            backgroundColor: 'rgba(75, 192, 192, 0.6)'
          },
          {
            label: 'Bíceps (kg)',
            data: <?= json_encode($biceps); ?>,
            backgroundColor: 'rgba(255, 206, 86, 0.6)'
          },
          {
            label: 'Tríceps (kg)',
            data: <?= json_encode($triceps); ?>,
            backgroundColor: 'rgba(153, 102, 255, 0.6)'
          },
          {
            label: 'Hombro (kg)',
            data: <?= json_encode($hombro); ?>,
            backgroundColor: 'rgba(255, 159, 64, 0.6)'
          }
        ]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { position: 'bottom' }
        },
        scales: {
          y: {
            beginAtZero: true,
            title: {
              display: true,
              text: 'Kilogramos'
            }
          },
          x: {
            title: {
              display: true,
              text: 'Fechas del Reporte'
            }
          }
        }
      }
    });
  </script>

  <!-- TABLA DE DATOS -->
  <table class="table table-bordered table-striped mt-5">
    <thead class="table-dark">
      <tr>
        <th>Fecha</th>
        <th>Peso (kg)</th>
        <th>Estatura (m)</th>
        <th>Edad</th>
        <th>Pecho (kg)</th>
        <th>Sentadilla (kg)</th>
        <th>Bíceps (kg)</th>
        <th>Tríceps (kg)</th>
        <th>Hombro (kg)</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($resultado as $fila): ?>
        <tr>
          <td><?= htmlspecialchars($fila['fecha_reporte']); ?></td>
          <td><?= htmlspecialchars($fila['peso']); ?></td>
          <td><?= htmlspecialchars($fila['estatura']); ?></td>
          <td><?= htmlspecialchars($fila['edad']); ?></td>
          <td><?= htmlspecialchars($fila['carga_pecho']); ?></td>
          <td><?= htmlspecialchars($fila['carga_sentadilla']); ?></td>
          <td><?= htmlspecialchars($fila['carga_biceps']); ?></td>
          <td><?= htmlspecialchars($fila['carga_triceps']); ?></td>
          <td><?= htmlspecialchars($fila['carga_hombro']); ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

<?php elseif ($nombreCliente !== ''): ?>
  <div class="alert alert-warning mt-4">
    No hay reportes registrados para <strong><?= htmlspecialchars($nombreCliente); ?></strong>.
  </div>
<?php endif; ?>

<a href="index.php" class="btn btn-secondary mt-3">Volver al Inicio</a>
<a href="ver_avance_cliente.php" class="btn btn-secondary mt-3">Volver a Reportes</a>

</body>
</html>