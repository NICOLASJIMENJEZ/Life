<?php
$conexion = new mysqli("localhost", "root", "903135Nicolas", "life_gym");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Clientes con Reportes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #000;
      color: #fff;
    }
    .card {
      background-color: #222;
      color: white;
      border: 1px solid #444;
      transition: 0.3s;
    }
    .card:hover {
      background-color: #333;
      transform: scale(1.03);
    }
  </style>
</head>
<body class="container mt-5">

<h2 class="mb-4">Clientes con Reportes Registrados</h2>

<div class="row">
   <a href="dashboard.php" class="btn btn-secondary">Volver</a>
  <?php
  $sql = "SELECT DISTINCT nombre FROM reportes ORDER BY nombre ASC";
  $resultado = $conexion->query($sql);

  if ($resultado->num_rows > 0) {
      while ($fila = $resultado->fetch_assoc()) {
          $nombre = urlencode($fila['nombre']);
          echo "
          <div class='col-md-4 mb-4'>
            <a href='ver_reporte_clientes.php?nombre=$nombre' style='text-decoration:none;'>
              <div class='card p-3 text-center'>
                <img src='https://cdn-icons-png.flaticon.com/512/149/149071.png' alt='icono' width='60'>
                <h4 class='mt-2'>{$fila['nombre']}</h4>
              </div>
            </a>
          </div>";
      }
  } else {
      echo "<p>No hay clientes con reportes aún.</p>";
  }
  $conexion->close();
  ?>
</div>

</body>
</html>
