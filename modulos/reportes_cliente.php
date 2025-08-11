<?php
// ✅ Conexión correcta a PostgreSQL con Render y SSL
try {
    $conexion = new PDO(
        "pgsql:host=dpg-d24l0l15pdvs73bvvmq0-a.oregon-postgres.render.com;port=5432;dbname=life_gym_db;sslmode=require",
        "life_gym_db_user",
        "0BaR53ptUeZaLHwtIBbMtuZ6cvYtCu3p",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    // echo "✅ Conectado correctamente";
} catch (PDOException $e) {
    die("❌ Error de conexión: " . $e->getMessage());
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
   <a href="dashboard.php" class="btn btn-secondary mb-4">Volver</a>
  <?php
  try {
      $stmt = $conexion->query("SELECT DISTINCT nombre FROM reportes ORDER BY nombre ASC");
      $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if (count($clientes) > 0) {
          foreach ($clientes as $fila) {
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
  } catch (PDOException $e) {
      echo "❌ Error al consultar los reportes: " . $e->getMessage();
  }

  $conexion = null; // Cierra la conexión PDO
  ?>
</div>

</body>
</html>