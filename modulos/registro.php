<?php
session_start();
// Asegúrate de que la ruta a conexión sea correcta según tu estructura
require_once $_SERVER['DOCUMENT_ROOT'] . '/modelo/conexion.php';

$status = ""; 
$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre          = htmlspecialchars(trim($_POST['nombre']));
    $apellido        = htmlspecialchars(trim($_POST['apellido']));
    $telefono        = htmlspecialchars(trim($_POST['telefono']));
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $identificacion  = intval($_POST['identificacion']);
    $email           = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password        = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $rol_id          = 1;
    $fechaRegistro   = date('Y-m-d');

    try {
        $sql = "INSERT INTO usuarios 
            (nombre, apellido, telefono, fechaNacimiento, identificacion, email, password, fecha_registro, rol_id) 
            VALUES (:nombre, :apellido, :telefono, :fechaNacimiento, :identificacion, :email, :password, :fechaRegistro, :rol_id)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nombre'          => $nombre,
            ':apellido'        => $apellido,
            ':telefono'        => $telefono,
            ':fechaNacimiento' => $fechaNacimiento,
            ':identificacion'  => $identificacion,
            ':email'           => $email,
            ':password'        => $password,
            ':fechaRegistro'   => $fechaRegistro,
            ':rol_id'          => $rol_id,
        ]);

        $status = "success";
    } catch (PDOException $e) {
        $status = "error";
        $error_msg = "El correo o identificación ya están registrados en nuestro sistema.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Elite | Life Gym</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;700&family=Outfit:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 0;
        }

        .reg-card {
            background: var(--card-bg);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 28px;
            padding: 40px;
            width: 100%;
            max-width: 550px;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5);
        }

        .brand-logo {
            font-family: 'Outfit', sans-serif;
            font-size: 1.5rem;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Progress Bar */
        .step-indicator {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .step {
            width: 32%;
            height: 4px;
            background: #2D2D2D;
            border-radius: 2px;
            transition: 0.4s;
        }
        .step.active { background: var(--brand-green); shadow: 0 0 10px var(--brand-green); }

        .form-section { display: none; }
        .form-section.active { display: block; animation: fadeIn 0.5s ease; }

        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

        .form-control {
            background-color: var(--input-bg);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff;
            padding: 12px 15px;
            border-radius: 12px;
        }

        .form-control:focus {
            background-color: var(--input-bg);
            border-color: var(--brand-green);
            color: #fff;
            box-shadow: none;
        }

        .btn-brand {
            background-color: var(--brand-green);
            color: #000;
            font-weight: 700;
            border-radius: 12px;
            padding: 12px;
            border: none;
            width: 100%;
        }

        .btn-outline-custom {
            border: 1px solid rgba(255,255,255,0.1);
            color: #fff;
            border-radius: 12px;
            padding: 12px;
            width: 100%;
        }

        .btn-outline-custom:hover { background: rgba(255,255,255,0.05); color: #fff; }
    </style>
</head>
<body>

    <div class="reg-card">
        <div class="brand-logo">
            <span style="color: #fff">LIFE</span><span style="color: var(--brand-green)">GYM</span>
        </div>

        <div class="step-indicator">
            <div class="step active" id="s1"></div>
            <div class="step" id="s2"></div>
            <div class="step" id="s3"></div>
        </div>

        <form action="" method="POST" id="regForm">
            <div class="form-section active" id="section1">
                <h5 class="mb-4">Datos Personales</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="small mb-1 text-muted">Nombre</label>
                        <input type="text" class="form-control" name="nombre" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="small mb-1 text-muted">Apellido</label>
                        <input type="text" class="form-control" name="apellido" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="small mb-1 text-muted">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" name="fechaNacimiento" required>
                </div>
                <button type="button" class="btn btn-brand mt-3" onclick="nextStep(2)">Siguiente</button>
            </div>

            <div class="form-section" id="section2">
                <h5 class="mb-4">Identidad y Contacto</h5>
                <div class="mb-3">
                    <label class="small mb-1 text-muted">Identificación (C.C)</label>
                    <input type="number" class="form-control" name="identificacion" required>
                </div>
                <div class="mb-3">
                    <label class="small mb-1 text-muted">Teléfono Celular</label>
                    <input type="tel" class="form-control" name="telefono" required>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <button type="button" class="btn btn-outline-custom" onclick="nextStep(1)">Atrás</button>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-brand" onclick="nextStep(3)">Siguiente</button>
                    </div>
                </div>
            </div>

            <div class="form-section" id="section3">
                <h5 class="mb-4">Seguridad de la Cuenta</h5>
                <div class="mb-3">
                    <label class="small mb-1 text-muted">Correo Electrónico</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="mb-3">
                    <label class="small mb-1 text-muted">Contraseña</label>
                    <input type="password" class="form-control" name="password" required minlength="6">
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <button type="button" class="btn btn-outline-custom" onclick="nextStep(2)">Atrás</button>
                    </div>
                    <div class="col-6">
                        <button type="submit" class="btn btn-brand">FINALIZAR</button>
                    </div>
                </div>
            </div>
        </form>

        <div class="text-center mt-4">
            <a href="../login.php" class="small text-muted text-decoration-none">¿Ya eres socio? <span style="color:var(--brand-green)">Inicia Sesión</span></a>
        </div>
    </div>

    <script>
        // Lógica de pasos del formulario
        function nextStep(step) {
            document.querySelectorAll('.form-section').forEach(s => s.classList.remove('active'));
            document.querySelectorAll('.step').forEach((s, idx) => {
                if(idx < step) s.classList.add('active');
                else s.classList.remove('active');
            });
            document.getElementById('section' + step).classList.add('active');
        }

        // Alertas de PHP
        document.addEventListener('DOMContentLoaded', function() {
            const status = "<?php echo $status; ?>";
            if (status === "success") {
                Swal.fire({
                    title: '¡Registro Exitoso!',
                    text: 'Bienvenido a la familia Life Gym. Redirigiendo...',
                    icon: 'success',
                    background: '#141414',
                    color: '#fff',
                    confirmButtonColor: '#A3E635',
                    timer: 2500,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = "../login.php";
                });
            } else if (status === "error") {
                Swal.fire({
                    title: 'Error en el Registro',
                    text: "<?php echo $error_msg; ?>",
                    icon: 'error',
                    background: '#141414',
                    color: '#fff',
                    confirmButtonColor: '#ff4b4b'
                });
            }
        });
    </script>
</body>
</html>
