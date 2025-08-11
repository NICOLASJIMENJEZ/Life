<?php
include_once(__DIR__ . "/../modelo/conexion.php");

// Consulta para mostrar las rutinas
$sql = "SELECT * FROM rutinas";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($resultados as $fila) {
    echo $fila['titulo'] . "<br>";
}  // <-- Cerrar el foreach aquí

// Ahora recibimos datos del formulario (POST)
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

