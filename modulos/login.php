<?php
session_start();

// Config DB (Se mantiene tu configuración de Render)
$host = "dpg-d7k1offavr4c73esdbeg-a.oregon-postgres.render.com";
$port = "5432";
$dbname = "life_gym_db_hvmq";
$user = "life_gym_db_hvmq_user";
$password = "lEovCr88q2giz5REW4MwUPePidNosjc1";

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;";
    $conexion = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("❌ Error de conexión");
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
                header("Location: modulos/dashboard.php");
            } else {
                header("Location: cuenta.php"); // Redirigimos a la nueva cuenta que creamos
            }
            exit();
        } else {
            $error_message = "Contraseña incorrecta.";
        }
    } else {
        $error_message = "El correo no está registrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Elite | Life Gym</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;700&family=Outfit:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <style>
        :root { 
            --brand-green: #A3E635; 
            --bg-dark: #0A0A0A; 
            --card-bg: #141414;
            --input-bg: #1F1F1F;
        }

        body { 
            background-color: var(--bg-dark); 
            color: #E5E7EB; 
            font-family: 'Plus Jakarta Sans', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            background-image: radial-gradient(circle at 10% 20%, rgba(163, 230, 53, 0.05) 0%, transparent 40%);
        }

        .login-card {
            background: var(--card-bg);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 32px;
            padding: 45px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.4);
        }

        .brand-logo {
            font-family: 'Outfit', sans-serif;
            font-size: 1.8rem;
            text-align: center;
            margin-bottom: 30px;
            letter-spacing: -1px;
        }

        .form-label {
            font-size: 0.85rem;
            color: #9CA3AF;
            margin-bottom: 8px;
            margin-left: 4px;
        }

        .form-control {
            background-color: var(--input-bg);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff;
            padding: 14px 18px;
            border-radius: 16px;
            transition: 0.3s;
        }

        .form-control:focus {
            background-color: var(--input-bg);
            border-color: var(--brand-green);
            box-shadow: 0 0 0 4px rgba(163, 230, 53, 0.1);
            color: #fff;
        }

        .btn-login {
            background-color: var(--brand-green);
            color: #000;
            font-weight: 700;
            border-radius: 16px;
            padding: 14px;
            border: none;
            width: 100%;
            margin-top: 20px;
            transition: 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(163, 230, 53, 0.3);
            background-color: var(--brand-green);
        }

        .error-alert {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #FCA5A5;
            padding: 12px;
            border-radius: 12px;
            font-size: 0.85rem;
            text-align: center;
            margin-bottom: 20px;
        }

        .footer-link {
            text-align: center;
            margin-top: 25px;
            font-size: 0.9rem;
            color: #9CA3AF;
        }

        .footer-link a {
            color: var(--brand-green);
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="brand-logo">
            <span style="color: #fff">LIFE</span><span style="color: var(--brand-green)">GYM</span>
        </div>

        <?php if ($error_message): ?>
            <div class="error-alert">
                <i class="fas fa-exclamation-circle me-2"></i> <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="nombre@ejemplo.com" required>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn-login">Entrar al Panel</button>
        </form>

        <div class="footer-link">
            ¿Nuevo en el club? <a href="modulos/registro.php">Crea tu cuenta</a>
        </div>
    </div>

</body>
</html>
