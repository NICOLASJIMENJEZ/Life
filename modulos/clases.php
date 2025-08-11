<?php
$host = "dpg-d2410115pdvs73bvvnq0-a.oregon-postgres.render.com";
$port = "5432";
$dbname = "smart_gym";
$user = "smart_gym_user";
$password = "XKfNZf5rmTttbQYqV4Q8cK3O7mF5ttIb";

// Conexión usando PDO con SSL forzado
try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";
    $conexion = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    echo "✅ Conexión exitosa a PostgreSQL en Render con SSL";

} catch (PDOException $e) {
    echo "❌ Error de conexión: " . $e->getMessage();
}



// Recibir datos del formulario
$cliente = $_POST['cliente'] ?? '';
$grupo = $_POST['grupo'] ?? '';
$titulo = $_POST['titulo'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
$tiempo_descanso = $_POST['tiempo_descanso'] ?? '';
$video = $_POST['video'] ?? '';

// Función para leer imagen y convertirla a binario para BYTEA
function cargarImagen($inputName) {
    if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] === UPLOAD_ERR_OK) {
        return file_get_contents($_FILES[$inputName]['tmp_name']);
    }
    return null;
}

$imagen1 = cargarImagen('imagen1');
$imagen2 = cargarImagen('imagen2');
$imagen3 = cargarImagen('imagen3');

try {
    $sql = "INSERT INTO rutinas (cliente, grupo, titulo, descripcion, tiempo_descanso, imagen1, imagen2, imagen3, video) 
            VALUES (:cliente, :grupo, :titulo, :descripcion, :tiempo_descanso, :imagen1, :imagen2, :imagen3, :video)";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':cliente', $cliente, PDO::PARAM_STR);
    $stmt->bindParam(':grupo', $grupo, PDO::PARAM_STR);
    $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
    $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
    $stmt->bindParam(':tiempo_descanso', $tiempo_descanso, PDO::PARAM_STR);

    if ($imagen1 !== null) {
        $stmt->bindParam(':imagen1', $imagen1, PDO::PARAM_LOB);
    } else {
        $stmt->bindValue(':imagen1', null, PDO::PARAM_NULL);
    }

    if ($imagen2 !== null) {
        $stmt->bindParam(':imagen2', $imagen2, PDO::PARAM_LOB);
    } else {
        $stmt->bindValue(':imagen2', null, PDO::PARAM_NULL);
    }

    if ($imagen3 !== null) {
        $stmt->bindParam(':imagen3', $imagen3, PDO::PARAM_LOB);
    } else {
        $stmt->bindValue(':imagen3', null, PDO::PARAM_NULL);
    }

    $stmt->bindParam(':video', $video, PDO::PARAM_STR);

    $stmt->execute();

    echo "<p style='color:lime;'>✅ Rutina guardada con éxito!</p>";
    echo "<p><a href='dashboard.php'>⬅ Volver al Dashboard</a></p>";
} catch (PDOException $e) {
    echo "<p style='color:red;'>❌ Error al guardar la rutina: " . $e->getMessage() . "</p>";
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Agregar Rutina | LIFE GYM</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&display=swap" rel="stylesheet">
  <style>
    body { background-color: #000; color: #ccc; font-family: 'Orbitron', sans-serif; }
    h2 { text-shadow: 0 0 10px #00ff00; color: #00ff00; }
    .form-control, .form-select {
      background-color: #111; color: #ccc;
      border: 1px solid #28a745;
      transition: all 0.3s ease-in-out;
    }
    .form-control:focus, .form-select:focus {
      box-shadow: 0 0 15px #00ff00, 0 0 5px #ccc;
      border-color: #28a745;
    }
    .btn-danger {
      border-radius: 25px; padding: 12px 28px; font-size: 1.1rem;
      background: linear-gradient(145deg, #28a745, #1a4d1a);
      box-shadow: 0 0 15px #00ff00;
      border: none; color: #fff;
    }
    .btn-outline-light {
      border-radius: 25px; padding: 12px 28px; font-size: 1.1rem;
      border-color: #ccc; color: #ccc;
    }
    .btn-outline-light:hover {
      background-color: #ccc; color: #000;
    }
    .bg-form {
      background: linear-gradient(145deg, #111, #1a1a1a);
      border-radius: 20px;
      padding: 40px;
      box-shadow: 0 0 35px rgba(0, 255, 0, 0.6), 0 0 10px rgba(255, 255, 255, 0.05);
      max-width: 900px;
    }
    label { font-size: 1rem; color: #00ff00; }
    ::placeholder { color: #aaa; }
  </style>
</head>
<body>

<div class="container py-5">
  <h2 class="text-center mb-4">Agregar Nueva Rutina</h2>

  <div class="bg-form mx-auto">
    <form action="guardar_clase.php" method="POST" enctype="multipart/form-data">

      <div class="mb-3">
        <label class="form-label">Cliente</label>
        <select name="cliente" class="form-select" required>
          <option value="">Seleccione un cliente...</option>
          <?php while ($fila = pg_fetch_assoc($resultado)) { ?>
            <option value="<?= htmlspecialchars($fila['id']) ?>"><?= htmlspecialchars($fila['nombre']) ?></option>
          <?php } ?>
        </select>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
