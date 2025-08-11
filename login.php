<?php
session_start(); // Debe ir al inicio

// Mostrar errores para depuración (puedes quitarlo en producción)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Config DB (Render PostgreSQL)
$host     = 'dpg-d24l0l15pdvs73bvvmq0-a';
$port     = '5432';
$dbname   = 'life_gym_db';
$user     = 'life_gym_db_user';
$password = '0BaR53ptUeZaLHwtIBbMtuZ6cvYtCu3p';

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;";
    $conexion = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    // echo "✅ Conexión exitosa";
} catch (PDOException $e) {
    die("❌ Error de conexión: " . $e->getMessage());
}

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password_input = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE email = :email";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        if (password_verify($password_input, $usuario['password'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_email'] = $usuario['email'];
            $_SESSION['rol_id'] = $usuario['rol_id'];

            if ($usuario['rol_id'] == 2) {
                header("Location: modulos/dashboard.php"); // Admin
            } else {
                header("Location: modulos/index.php"); // Usuario normal
            }
            exit();
        } else {
            $error_message = "❌ Contraseña incorrecta.";
        }
    } else {
        $error_message = "❌ El correo no está registrado.";
    }
}
?>





<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Life Gym</title>
    <link rel="stylesheet" href="modulos/estilo.css">
    
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
        <p>¿No tienes cuenta? <a href="modulos/registro.php">Regístrate aquí</a></p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>