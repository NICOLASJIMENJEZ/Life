<?php
session_start();
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol_id'] != 1) {
    header("Location: login.php");
    exit();
}

include '../modelo/conexion.php';

try {
    $stmt = $conexion->prepare("SELECT c.*, u.nombre AS nombre_instructor 
                                FROM clases c 
                                INNER JOIN usuarios u ON c.instructor_id = u.id 
                                ORDER BY c.fecha ASC");
    $stmt->execute();
    $clases = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("❌ Error al obtener clases: " . $e->getMessage());
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Clases - Life Gym</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container py-5">
    <h1 class="mb-4 text-success">Clases Programadas</h1>

    <table class="table table-bordered table-striped table-dark">
        <thead>
            <tr>
                <th>Título</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Instructor</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($clase = $clases->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($clase['titulo']) ?></td>
                    <td><?= htmlspecialchars($clase['descripcion']) ?></td>
                    <td><?= $clase['fecha'] ?></td>
                    <td><?= $clase['hora'] ?></td>
                    <td><?= htmlspecialchars($clase['nombre_instructor']) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <a href="inicio.php" class="btn btn-outline-light mt-3">← Volver al inicio</a>
</div>
</body>
</html>