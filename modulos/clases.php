<?php
$host = "dpg-d2410115pdvs73bvvnq0-a.oregon-postgres.render.com";
$port = "5432";
$dbname = "smart_gym";
$user = "smart_gym_user";
$password = "XKfNZf5rmTttbQYqV4Q8cK3O7mF5ttIb";

// Conexión usando PDO con SSL forzado
try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    echo "✅ Conexión exitosa a PostgreSQL en Render con SSL";
} catch (PDOException $e) {
    echo "❌ Error de conexión: " . $e->getMessage();
    exit;
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

    $stmt->bindValue(':imagen1', $imagen1 !== null ? $imagen1 : null, $imagen1 !== null ? PDO::PARAM_LOB : PDO::PARAM_NULL);
    $stmt->bindValue(':imagen2', $imagen2 !== null ? $imagen2 : null, $imagen2 !== null ? PDO::PARAM_LOB : PDO::PARAM_NULL);
    $stmt->bindValue(':imagen3', $imagen3 !== null ? $imagen3 : null, $imagen3 !== null ? PDO::PARAM_LOB : PDO::PARAM_NULL);

    $stmt->bindParam(':video', $video, PDO::PARAM_STR);

    $stmt->execute();

    echo "<p style='color:lime;'>✅ Rutina guardada con éxito!</p>";
    echo "<p><a href='dashboard.php'>⬅ Volver al Dashboard</a></p>";
} catch (PDOException $e) {
    echo "<p style='color:red;'>❌ Error al guardar la rutina: " . $e->getMessage() . "</p>";
}
?>
