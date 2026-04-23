<?php
// admin_dashboard.php
// 1. Conexión a la base de datos
$host = "localhost"; $user = "root"; $pass = ""; $db = "life_gym";
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) { die("Error de conexión: " . $conn->connect_error); }

// 2. Obtener estadísticas reales
$total_users = $conn->query("SELECT COUNT(*) as total FROM usuarios")->fetch_assoc()['total'];
$total_clases = $conn->query("SELECT COUNT(*) as total FROM clases WHERE fecha = CURDATE()")->fetch_assoc()['total'];

// 3. Obtener lista de usuarios para el panel
$usuarios_res = $conn->query("SELECT * FROM usuarios ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Life Gym | Master Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        :root { --brand: #A3E635; --dark: #0A0A0A; --card: #141414; }
        body { background: var(--dark); color: #fff; font-family: 'Plus Jakarta Sans', sans-serif; overflow-x: hidden; }
        
        .sidebar { background: var(--card); height: 100vh; border-right: 1px solid #222; position: fixed; width: 250px; }
        .main-content { margin-left: 250px; padding: 40px; }
        
        .nav-link { color: #999; border-radius: 10px; margin: 5px 0; padding: 12px; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { background: var(--brand); color: #000; font-weight: bold; }
        
        .stat-card { background: var(--card); border-radius: 20px; padding: 25px; border: 1px solid #222; position: relative; overflow: hidden; }
        .stat-card::after { content: ""; position: absolute; top: -50%; right: -20%; width: 100px; height: 100px; background: var(--brand); opacity: 0.05; border-radius: 50%; }
        
        .user-table { background: var(--card); border-radius: 20px; border: 1px solid #222; overflow: hidden; }
        .user-table thead { background: rgba(163, 230, 53, 0.05); }
        .form-control-custom { background: #1f1f1f; border: 1px solid #333; color: #fff; border-radius: 12px; padding: 12px; }
        .btn-brand { background: var(--brand); color: #000; font-weight: 700; border-radius: 12px; padding: 12px; border: none; }
        
        .user-avatar { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid var(--brand); }
    </style>
</head>
<body>

<nav class="sidebar p-4">
    <h4 class="fw-bold mb-5">LIFE<span style="color:var(--brand)">ADMIN</span></h4>
    <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link active" href="#"><i class="fas fa-home me-2"></i> Inicio</a></li>
        <li class="nav-item"><a class="nav-link" href="#section-users"><i class="fas fa-users me-2"></i> Gestión Usuarios</a></li>
        <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-dumbbell me-2"></i> Rutinas Master</a></li>
        <li class="nav-item mt-5"><a class="nav-link text-danger" href="logout.php"><i class="fas fa-power-off me-2"></i> Cerrar Sesión</a></li>
    </ul>
</nav>

<div class="main-content">
    <header class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h2 class="fw-bold">Bienvenido, <span style="color:var(--brand)">Nicolás Jiménez</span></h2>
            <p class="text-muted small uppercase tracking-widest">Master Dashboard | Control Total</p>
        </div>
        <div class="text-end">
            <span class="badge bg-dark border border-success text-success p-3">SISTEMA CONECTADO A DB</span>
        </div>
    </header>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="stat-card">
                <small class="text-muted text-uppercase fw-bold">Usuarios en Base de Datos</small>
                <h1 class="display-5 fw-bold mb-0"><?= $total_users ?></h1>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <small class="text-muted text-uppercase fw-bold">Clases Programadas Hoy</small>
                <h1 class="display-5 fw-bold mb-0 text-info"><?= $total_clases ?></h1>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <small class="text-muted text-uppercase fw-bold">Estado de API Gemini</small>
                <h5 class="mt-2 text-success"><i class="fas fa-brain me-2"></i> Activa / Conectada</h5>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-lg-6">
            <div class="stat-card">
                <h5 class="mb-4">Asignar Clase Personalizada</h5>
                <form action="procesar_clase.php" method="POST">
                    <div class="mb-3">
                        <label class="small text-muted">Seleccionar Alumno</label>
                        <select name="usuario_id" class="form-select form-control-custom">
                            <?php 
                            $users_select = $conn->query("SELECT id, nombre FROM usuarios");
                            while($u = $users_select->fetch_assoc()): 
                            ?>
                                <option value="<?= $u['id'] ?>"><?= $u['nombre'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="small text-muted">Nombre de la Clase</label>
                        <input type="text" name="nombre_clase" class="form-control form-control-custom" placeholder="Ej: Hipertrofia de Pierna">
                    </div>
                    <div class="row">
                        <div class="col"><input type="date" name="fecha" class="form-control form-control-custom"></div>
                        <div class="col"><input type="time" name="hora" class="form-control form-control-custom"></div>
                    </div>
                    <button type="submit" class="btn btn-brand w-100 mt-4">ENVIAR CLASE AL USUARIO</button>
                </form>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="stat-card h-100">
                <h5 class="mb-4">Asistente Gemini AI</h5>
                <div id="ai-chat" class="mb-3 p-3 bg-dark rounded-4" style="height: 180px; overflow-y: auto; font-size: 0.9rem; color: #ccc;">
                    Escribe una pregunta para analizar el progreso de los usuarios...
                </div>
                <div class="input-group">
                    <input type="text" class="form-control form-control-custom" placeholder="Consultar a la IA...">
                    <button class="btn btn-brand px-4"><i class="fas fa-paper-plane"></i></button>
                </div>
            </div>
        </div>
    </div>

    <div class="user-table p-4" id="section-users">
        <h5 class="mb-4">Panel de Control de Usuarios</h5>
        <div class="table-responsive">
            <table class="table table-dark table-hover align-middle">
                <thead>
                    <tr class="text-muted small">
                        <th>USUARIO</th>
                        <th>EMAIL</th>
                        <th>EDAD</th>
                        <th>ESTATURA/PESO</th>
                        <th>FECHA INICIO</th>
                        <th class="text-end">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $usuarios_res->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?= $row['foto'] ?>" class="user-avatar me-3" alt="User">
                                <span class="fw-bold"><?= $row['nombre'] ?></span>
                            </div>
                        </td>
                        <td class="text-muted"><?= $row['email'] ?></td>
                        <td><?= $row['edad'] ?> años</td>
                        <td>
                            <span class="badge bg-dark border border-secondary"><?= $row['estatura'] ?>m</span>
                            <span class="badge bg-dark border border-secondary text-brand"><?= $row['peso_inicio'] ?>kg</span>
                        </td>
                        <td class="small"><?= date('d M, Y', strtotime($row['fecha_registro'])) ?></td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-outline-light border-0"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger border-0"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
