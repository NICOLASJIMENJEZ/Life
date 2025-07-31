<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Agregar Rutina | SMART GYM</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&display=swap" rel="stylesheet">

  <style>
    body {
      background-color: #000;
      color: #fff;
      font-family: 'Orbitron', sans-serif;
    }

    h2 {
      text-shadow: 0 0 10px #ff0040;
    }

    .form-control, .form-select {
      background-color: #111;
      color: #fff;
      border: 1px solid #ff0033;
      transition: all 0.3s ease-in-out;
    }

    .form-control:focus, .form-select:focus {
      box-shadow: 0 0 15px #ff0033, 0 0 5px #fff;
      border-color: #ff0033;
    }

    .btn-danger {
      border-radius: 25px;
      padding: 12px 28px;
      font-size: 1.1rem;
      background: linear-gradient(145deg, #ff0033, #99001a);
      box-shadow: 0 0 15px #ff0033;
      border: none;
    }

    .btn-outline-light {
      border-radius: 25px;
      padding: 12px 28px;
      font-size: 1.1rem;
      transition: all 0.3s ease-in-out;
    }

    .btn-outline-light:hover {
      background-color: #fff;
      color: #000;
    }

    .bg-form {
      background: linear-gradient(145deg, #111, #1a1a1a);
      border-radius: 20px;
      padding: 40px;
      box-shadow: 0 0 35px rgba(255, 0, 55, 0.6), 0 0 10px rgba(255, 255, 255, 0.05);
      max-width: 900px;
    }

    label {
      font-size: 1rem;
      color: #ff3366;
    }

    ::placeholder {
      color: #ccc;
    }
  </style>
</head>
<body>

<div class="container py-5">
  <h2 class="text-center text-danger mb-4">Agregar Nueva Rutina</h2>

  <div class="bg-form mx-auto">
    <form action="guardar_clase.php" method="POST" enctype="multipart/form-data">

      <div class="mb-3">
        <label for="cliente" class="form-label">Nombre del cliente</label>
        <input type="text" name="cliente" id="cliente" class="form-control" placeholder="Nombre completo" required>
      </div>

      <div class="mb-3">
        <label for="grupo" class="form-label">Grupo Muscular</label>
        <select name="grupo" id="grupo" class="form-select" required>
          <option value="">Seleccione...</option>
          <option value="Torso">Torso</option>
          <option value="Inferior">Inferior</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="titulo" class="form-label">Parte del cuerpo</label>
        <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Ej: Bíceps, Cuádriceps..." required>
      </div>

      <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea name="descripcion" id="descripcion" rows="4" class="form-control" placeholder="Describe la rutina..." required></textarea>
      </div>

      <div class="mb-3">
        <label for="tiempo_descanso" class="form-label">Tiempo de descanso (ej: 30 segundos)</label>
        <input type="text" name="tiempo_descanso" id="tiempo_descanso" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Imágenes (opcional)</label>
        <input type="file" name="imagen1" class="form-control mb-2">
        <input type="file" name="imagen2" class="form-control mb-2">
        <input type="file" name="imagen3" class="form-control">
      </div>

      <div class="mb-3">
        <label for="video" class="form-label">Link del video de YouTube</label>
        <input type="url" name="video" id="video" class="form-control" placeholder="https://youtube.com/...">
      </div>

      <div class="text-center">
        <button type="submit" class="btn btn-danger">Guardar Rutina</button>
        <a href="dashboard.php" class="btn btn-outline-light ms-3">Ir al Dashboard</a>
      </div>

    </form>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
