<?php
require_once '../modelo/conexion.php';

if (!isset($conexion)) { // Asegúrate de que se usa la variable $conexion
    die("Error: la conexión no está definida.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['cliente_id']) && isset($_POST['monto'])) {
        $cliente_id = intval($_POST['cliente_id']);
        $monto = floatval($_POST['monto']);
        $fecha_pago = date('Y-m-d H:i:s');

        // Aquí puedes establecer valores por defecto si no vienen del formulario
        $metodo_pago = "Pendiente"; // Por defecto si no se envía
        $estado_pago = "En proceso";
        $plan_id = null; // Si no se usa aún

        // Asegúrate de que estás usando la variable $conexion en lugar de $mysqli
        $stmt = $conexion->prepare("INSERT INTO pagos (cliente_id, monto, metodo_pago, fecha_pago, estado_pago, plan_id) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("idsssi", $cliente_id, $monto, $metodo_pago, $fecha_pago, $estado_pago, $plan_id);

        if ($stmt->execute()) {
            echo "✅ Pago registrado exitosamente.";
        } else {
            echo "❌ Error al registrar el pago: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "❌ Datos incompletos del formulario.";
    }
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesar Pago</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #000000;  /* Fondo negro */
            font-family: 'Arial', sans-serif;
            color: #ffffff;  /* Texto blanco */
        }
        .container {
            max-width: 700px;
            padding: 20px;
            margin-top: 50px;
            background-color: #333333;
            border-radius: 12px;
        }
        .btn-primary {
            background-color: #39FF14;  /* Verde fluorescente */
            border-color: #39FF14;
        }
        .btn-primary:hover {
            background-color: #32CD32;
            border-color: #32CD32;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2 class="text-center">Formulario de Pago</h2>
        <form action="procesar_pago.php" method="POST">
            <div class="form-group">
                <label for="cliente_id">ID del Cliente:</label>
                <input type="text" id="cliente_id" name="cliente_id" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="monto">Monto del Pago:</label>
                <input type="text" id="monto" name="monto" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="metodo_pago">Método de Pago:</label>
                <input type="text" id="metodo_pago" name="metodo_pago" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="plan_id">ID del Plan:</label>
                <input type="text" id="plan_id" name="plan_id" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Simular Pago</button>
        </form>
    </div>

</body>
</html>