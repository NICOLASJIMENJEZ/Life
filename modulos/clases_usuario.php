<?php
$host = "dpg-d24l0l15pdvs73bvvmq0-a.oregon-postgres.render.com";
$port = 5432;
$db = "life_gym_db";
$user = "life_gym_db_user";
$pass = "0BaR53ptUeZaLHwtIBbMtuZ6cvYtCu3p";

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$db";
    $conn = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("❌ Error de conexión: " . $e->getMessage());
}

$sql = "SELECT * FROM clases ORDER BY fecha_creacion DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

$torso = [];
$inferior = [];

foreach ($resultado as $fila) {
    $grupo = isset($fila['grupo']) ? strtolower($fila['grupo']) : 'otro';
    if ($grupo === 'torso') {
        $torso[] = $fila;
    } elseif ($grupo === 'inferior') {
        $inferior[] = $fila;
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Rutinas | SMART GYM</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&display=swap" rel="stylesheet">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- AOS -->
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

<style>
  body {
    background-color: #0a0a0a;
    color: #e0e0e0;
    font-family: 'Orbitron', sans-serif;
  }

  h1, h2 {
    font-family: 'Orbitron', sans-serif;
    text-align: center;
    font-weight: bold;
    margin-bottom: 2rem;
    color: #00cc66;
    text-shadow: 0 0 10px rgba(0, 204, 102, 0.3);
  }

  .section-title {
    font-size: 1.8rem;
    color: #88ffaa;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-bottom: 20px;
  }

  .rutina-card {
    background: linear-gradient(135deg, #121212, #1e1e1e);
    border: 1px solid #2ecc71;
    border-radius: 15px;
    box-shadow: 0 0 20px rgba(46, 204, 113, 0.1);
    padding: 20px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .rutina-card:hover {
    transform: scale(1.03);
    box-shadow: 0 0 30px rgba(46, 204, 113, 0.4);
  }

  .card-title {
    color: #2ecc71;
    font-size: 1.4rem;
    text-align: center;
    margin-bottom: 1rem;
  }

  .btn-ver-rutina {
    background-color: #2ecc71;
    color: #000;
    border-radius: 25px;
    font-weight: bold;
    transition: background-color 0.3s ease;
  }

  .btn-ver-rutina:hover {
    background-color: #27ae60;
    color: #fff;
  }

  .btn-outline-danger {
    color: #2ecc71;
    border-color: #2ecc71;
    border-radius: 20px;
  }

  .btn-outline-danger:hover {
    background-color: #2ecc71;
    color: #000;
  }

  .rutina-info img {
    width: 100px;
    border-radius: 10px;
    margin: 5px;
    border: 2px solid #2ecc71;
  }

  .rutina-info p {
    color: #bfbfbf;
  }

  .btn-outline-light {
    color: #ccc;
    border-color: #ccc;
    border-radius: 25px;
    font-weight: bold;
    padding: 12px 24px;
  }

  .btn-outline-light:hover {
    background-color: #ccc;
    color: #000;
  }

  .text-muted {
    color: #666 !important;
  }

  .container {
    max-width: 1200px;
  }
</style>


</head>
<body>

<div class="container py-5">
  <h1 class="text-center text-danger mb-5">🔥 Rutinas LIFE GYM 🔥</h1>

  <!-- Sección Torso -->
  <section class="mb-5">
    <h2 class="text-center text-warning mb-4">Rutinas Torso</h2>
    <div class="row g-4">
      <?php if (empty($torso)): ?>
        <p class="text-center text-muted">No hay rutinas de torso registradas.</p>
      <?php else: ?>
        <?php foreach ($torso as $i => $rutina): $id = 'torso_' . $i; ?>
          <div class="col-md-4" data-aos="fade-up">
            <div class="card rutina-card h-100">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title text-danger text-center"><?= htmlspecialchars($rutina['titulo']) ?></h5>
                <button class="btn btn-ver-rutina mt-2" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $id ?>">Ver rutina</button>
                <div class="collapse mt-3 rutina-info" id="<?= $id ?>">
                  <p><strong>Descripción:</strong> <?= nl2br(htmlspecialchars($rutina['descripcion'])) ?></p>
                  <p><strong>Tiempo de descanso:</strong> <?= htmlspecialchars($rutina['tiempo_descanso']) ?></p>
                  <div class="d-flex flex-wrap mb-2">
                    <?php if (!empty($rutina['imagen1'])): ?>
                      <img src="imagenes/<?= htmlspecialchars($rutina['imagen1']) ?>" alt="img1">
                    <?php endif; ?>
                    <?php if (!empty($rutina['imagen2'])): ?>
                      <img src="imagenes/<?= htmlspecialchars($rutina['imagen2']) ?>" alt="img2">
                    <?php endif; ?>
                    <?php if (!empty($rutina['imagen3'])): ?>
                      <img src="imagenes/<?= htmlspecialchars($rutina['imagen3']) ?>" alt="img3">
                    <?php endif; ?>
                  </div>
                  <?php if (!empty($rutina['video'])): ?>
                    <a href="<?= htmlspecialchars($rutina['video']) ?>" target="_blank" class="btn btn-outline-danger">Ver video</a>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </section>

  <!-- Sección Inferior -->
  <section>
    <h2 class="text-center text-warning mb-4">Rutinas Inferior</h2>
    <div class="row g-4">
      <?php if (empty($inferior)): ?>
        <p class="text-center text-muted">No hay rutinas de pierna registradas.</p>
      <?php else: ?>
        <?php foreach ($inferior as $i => $rutina): $id = 'inferior_' . $i; ?>
          <div class="col-md-4" data-aos="fade-up">
            <div class="card rutina-card h-100">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title text-danger text-center"><?= htmlspecialchars($rutina['titulo']) ?></h5>
                <button class="btn btn-ver-rutina mt-2" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $id ?>">Ver rutina</button>
                <div class="collapse mt-3 rutina-info" id="<?= $id ?>">
                  <p><strong>Descripción:</strong> <?= nl2br(htmlspecialchars($rutina['descripcion'])) ?></p>
                  <p><strong>Tiempo de descanso:</strong> <?= htmlspecialchars($rutina['tiempo_descanso']) ?></p>
                  <div class="d-flex flex-wrap mb-2">
                    <?php if (!empty($rutina['imagen1'])): ?>
                      <img src="imagenes/<?= htmlspecialchars($rutina['imagen1']) ?>" alt="img1">
                    <?php endif; ?>
                    <?php if (!empty($rutina['imagen2'])): ?>
                      <img src="imagenes/<?= htmlspecialchars($rutina['imagen2']) ?>" alt="img2">
                    <?php endif; ?>
                    <?php if (!empty($rutina['imagen3'])): ?>
                      <img src="imagenes/<?= htmlspecialchars($rutina['imagen3']) ?>" alt="img3">
                    <?php endif; ?>
                  </div>
                  <?php if (!empty($rutina['video'])): ?>
                    <a href="<?= htmlspecialchars($rutina['video']) ?>" target="_blank" class="btn btn-outline-danger">Ver video</a>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </section>

  <!-- Botón Volver al inicio -->
  <div class="text-center mt-5">
  <a href="index.php" class="btn btn-outline-light btn-lg">← Volver al inicio</a>
  </div>

</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>AOS.init();</script>

</body>
</html>