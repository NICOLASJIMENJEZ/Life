<?php
$host = "switchyard.proxy.rlwy.net";
$user = "root";
$pass = "yHVACjdVpisuiHXnOqKCEfWbkJuktloQ";
$db = "life_gym";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("❌ Error de conexión: " . $conn->connect_error);
}

$sql = "SELECT * FROM clases ORDER BY fecha_creacion DESC";
$resultado = $conn->query($sql);

$torso = [];
$inferior = [];

while ($fila = $resultado->fetch_assoc()) {
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
    background-color: #000;
    color: #fff;
    font-family: 'Orbitron', sans-serif;
  }
  .rutina-card {
    background: linear-gradient(145deg, #1a1a1a, #0d0d0d);
    border: 2px solid #dc3545;
    border-radius: 15px;
    transition: transform 0.3s, box-shadow 0.3s;
    box-shadow: 0 0 15px rgba(255, 0, 0, 0.3);
  }
  .rutina-card:hover {
    transform: scale(1.05);
    box-shadow: 0 0 25px rgba(255, 0, 0, 0.6);
  }
  .btn-ver-rutina {
    background-color: #dc3545;
    color: #fff;
    border-radius: 20px;
  }
  .btn-ver-rutina:hover {
    background-color: #ff4444;
  }
  .rutina-info img {
    width: 100px;
    border-radius: 10px;
    margin: 5px;
  }
  .rutina-info p {
    color: #fff;
  }
</style>

</head>
<body>

<div class="container py-5">
  <h1 class="text-center text-danger mb-5">🔥 Rutinas SMART GYM 🔥</h1>

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
    <a href="AQUI_TU_LINK" class="btn btn-outline-light btn-lg">← Volver al inicio</a>
  </div>

</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>AOS.init();</script>

</body>
</html>
