<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Planes Life Gym</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #000;
      color: #fff;
      font-family: 'Arial', sans-serif;
    }

    .card {
      background-color: #1a1a1a;
      color: #e0e0e0;
      border: 1px solid #333;
      border-radius: 15px;
      transition: transform 0.2s;
    }

    .card:hover {
      transform: scale(1.02);
      box-shadow: 0 0 20px #39ff14;
    }

    .card-title {
      color: #39ff14;
      font-weight: bold;
    }

    .price {
      font-size: 1.5rem;
      color: #fff;
    }

    .card-body {
      text-align: center;
    }

    .plan-container {
      margin-top: 40px;
    }

    .btn-custom {
      background-color: #39ff14;
      border: none;
      color: #000;
      font-weight: bold;
    }

    .btn-custom:hover {
      background-color: #2ecc71;
      color: #000;
    }
  </style>
</head>
<body>

  <div class="container plan-container">
    <h2 class="text-center mb-5 text-white">Nuestros Planes Life Gym</h2>
    <div class="row g-4">

      <?php
      $planes = [
        ['titulo' => 'Sesión Individual', 'precio' => '10.000', 'detalle' => '1 sesión'],
        ['titulo' => 'Semana Fit', 'precio' => '30.000', 'detalle' => '7 días de entrenamiento'],
        ['titulo' => 'Mensual', 'precio' => '75.000', 'detalle' => '30 días full acceso'],
        ['titulo' => 'Estudiante', 'precio' => '70.000', 'detalle' => 'Descuento con carné'],
        ['titulo' => 'Zumba + Fit + Gym', 'precio' => '85.000', 'detalle' => 'Acceso completo a todas las clases'],
        ['titulo' => 'Tiquetera 10', 'precio' => '60.000', 'detalle' => '10 sesiones a tu ritmo'],
        ['titulo' => 'Tiquetera 20', 'precio' => '100.000', 'detalle' => '20 sesiones libres'],
        ['titulo' => 'Tiquetera 30', 'precio' => '130.000', 'detalle' => '30 sesiones para ti'],
        ['titulo' => 'Plan Parejas', 'precio' => '140.000', 'detalle' => 'Entrena en pareja 30 días'],
        ['titulo' => 'Plan VIP', 'precio' => '200.000', 'detalle' => 'Todo incluido + asesoría privada']
      ];

      foreach ($planes as $plan): ?>
        <div class="col-md-6 col-lg-4 col-xl-3">
          <div class="card h-100 p-3">
            <div class="card-body d-flex flex-column justify-content-between">
              <h5 class="card-title"><?= $plan['titulo'] ?></h5>
              <p class="price">$<?= $plan['precio'] ?> COP</p>
              <p class="card-text"><?= $plan['detalle'] ?></p>
              <a href="#" class="btn btn-custom mt-3">Adquirir</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>