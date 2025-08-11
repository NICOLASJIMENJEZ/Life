<?php
// ✅ Conexión PDO con PostgreSQL Render (asegúrate de usar el nombre de host completo)
$host     = 'dpg-d24l0l15pdvs73bvvmq0-a.oregon-postgres.render.com'; // <-- Corregido
$port     = '5432';
$dbname   = 'life_gym_db';
$user     = 'life_gym_db_user';
$password = '0BaR53ptUeZaLHwtIBbMtuZ6cvYtCu3p';

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require"; // <-- sslmode agregado
    $conexion = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("❌ Error de conexión: " . $e->getMessage());
}

// ✅ Recoger y sanitizar datos del formulario
$cliente         = $_POST['cliente']         ?? null;
$grupo           = $_POST['grupo']           ?? null;
$titulo          = $_POST['titulo']          ?? null;
$descripcion     = $_POST['descripcion']     ?? null;
$tiempo_descanso = $_POST['tiempo_descanso'] ?? null;
$video           = $_POST['video']           ?? null;
$fecha_creacion  = date('Y-m-d');

// ✅ Validar campos obligatorios
if (!$cliente || !$grupo || !$titulo || !$descripcion || !$tiempo_descanso) {
    die("⚠️ Error: Faltan campos obligatorios.");
}

// ✅ Manejo de imágenes
$imagen1 = $_FILES['imagen1']['name'] ?? null;
$imagen2 = $_FILES['imagen2']['name'] ?? null;
$imagen3 = $_FILES['imagen3']['name'] ?? null;

$carpeta_destino = "../imagenes/";
if (!file_exists($carpeta_destino)) {
    mkdir($carpeta_destino, 0777, true);
}

if ($imagen1) move_uploaded_file($_FILES['imagen1']['tmp_name'], $carpeta_destino . $imagen1);
if ($imagen2) move_uploaded_file($_FILES['imagen2']['tmp_name'], $carpeta_destino . $imagen2);
if ($imagen3) move_uploaded_file($_FILES['imagen3']['tmp_name'], $carpeta_destino . $imagen3);

// ✅ Insertar rutina sin especificar el ID (autogenerado por la secuencia en PostgreSQL)
try {
    $sql = "INSERT INTO clases (
        cliente, grupo, titulo, descripcion, tiempo_descanso,
        video, imagen1, imagen2, imagen3, fecha_creacion
    ) VALUES (
        :cliente, :grupo, :titulo, :descripcion, :tiempo_descanso,
        :video, :imagen1, :imagen2, :imagen3, :fecha_creacion
    )";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ':cliente'         => $cliente,
        ':grupo'           => $grupo,
        ':titulo'          => $titulo,
        ':descripcion'     => $descripcion,
        ':tiempo_descanso' => $tiempo_descanso,
        ':video'           => $video,
        ':imagen1'         => $imagen1,
        ':imagen2'         => $imagen2,
        ':imagen3'         => $imagen3,
        ':fecha_creacion'  => $fecha_creacion
    ]);

    echo "<script>alert('✅ Rutina guardada correctamente'); window.location.href='dashboard.php';</script>";
} catch (PDOException $e) {
    echo "❌ Error al guardar: " . $e->getMessage();
}
?>