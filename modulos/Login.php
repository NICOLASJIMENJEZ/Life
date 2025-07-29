<?php
session_start(); // <-- Esto debe ir al principio (solo una vez)

// Mostrar errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Config DB
$host = 'switchyard.proxy.rlwy.net';
$db = 'life_gym';
$user = 'root';
$pass = 'yHVACjdVpisuiHXnOqKCEfWbkJuktloQ';

$conexion = new mysqli($host, $user, $pass, $db);

if ($conexion->connect_error) {
    die('Error en la conexión a la base de datos: ' . $conexion->connect_error);
}

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conexion->prepare($sql);

    if (!$stmt) {
        die('Error en la preparación de la consulta: ' . $conexion->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();

        if (password_verify($password, $usuario['password'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_email'] = $usuario['email'];
            $_SESSION['rol_id'] = $usuario['rol_id'];

            if ($usuario['rol_id'] == 2) {
                header("Location: dashboard.php"); // Admin
            } else {
                header("Location: index.php"); // Usuario normal
            }
            exit();
        } else {
            $error_message = "Contraseña incorrecta para el correo: " . htmlspecialchars($email);
        }
    } else {
        $error_message = "El correo no está registrado: " . htmlspecialchars($email);
    }

    $stmt->close();
    $conexion->close();
}
?>




<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Life Gym</title>
    <link rel="stylesheet" href="estilo.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    
</head>
<body>

    <div class="login-container">
        <div class="login-header">Iniciar Sesión</div>

        <!-- Mostrar mensaje de error si existe -->
        <?php if ($error_message): ?>
            <div class="error-message">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn-login">Iniciar Sesión</button>
        </form>

        <div class="footer-link">
            <p>¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>