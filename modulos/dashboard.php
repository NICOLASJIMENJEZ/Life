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
        body { background: var(--dark); color: #fff; font-family: 'Plus Jakarta Sans', sans-serif; }
        .sidebar { background: var(--card); height: 100vh; border-right: 1px solid #222; }
        .nav-link { color: #999; border-radius: 10px; margin: 5px 0; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { background: var(--brand); color: #000; font-weight: bold; }
        .stat-card { background: var(--card); border-radius: 20px; padding: 20px; border: 1px solid #222; }
        .btn-brand { background: var(--brand); color: #000; font-weight: 700; border-radius: 12px; }
        .form-control-custom { background: #1f1f1f; border: 1px solid #333; color: #fff; border-radius: 12px; }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block sidebar p-4">
            <h4 class="fw-bold mb-5">LIFE<span style="color:var(--brand)">ADMIN</span></h4>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link active" href="#"><i class="fas fa-home me-2"></i> Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-users me-2"></i> Usuarios</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-dumbbell me-2"></i> Rutinas</a></li>
                <li class="nav-item"><a class="nav-link text-danger" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i> Salir</a></li>
            </ul>
        </nav>

        <main class="col-md-10 p-5">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h2>Bienvenido, Nicolás Jiménez</h2>
                <span class="badge bg-success p-2">Sistema Online</span>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="stat-card">
                        <small class="text-muted text-uppercase">Total Usuarios</small>
                        <h2 class="mb-0">128</h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <small class="text-muted text-uppercase">Clases para Hoy</small>
                        <h2 class="mb-0">5</h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <small class="text-muted text-uppercase">Ingresos Mes</small>
                        <h2 class="mb-0 text-success">$4.2M</h2>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="stat-card">
                        <h5 class="mb-4">Asignar Clase Personalizada</h5>
                        <form id="claseForm">
                            <div class="mb-3">
                                <label class="small text-muted">Seleccionar Usuario</label>
                                <select class="form-select form-control-custom">
                                    <option>Todos los usuarios</option>
                                    <option>Juan Pérez</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="small text-muted">Nombre de la Clase</label>
                                <input type="text" class="form-control form-control-custom" placeholder="Ej: Powerlifting Intenso">
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label class="small text-muted">Fecha</label>
                                    <input type="date" class="form-control form-control-custom">
                                </div>
                                <div class="col">
                                    <label class="small text-muted">Hora</label>
                                    <input type="time" class="form-control form-control-custom">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-brand w-100 mt-4">PUBLICAR CLASE</button>
                        </form>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="stat-card">
                        <h5 class="mb-4">Actualizar Rutina del Día (General)</h5>
                        <textarea class="form-control form-control-custom" rows="8" placeholder="Escribe aquí los ejercicios del día... Ej: 4x12 Sentadillas..."></textarea>
                        <button class="btn btn-brand w-100 mt-3">ACTUALIZAR RUTINA</button>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Aquí puedes usar AJAX para conectar con PHP y actualizar la base de datos sin recargar la página
    document.getElementById('claseForm').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('¡Clase enviada! El usuario la verá ahora en su cuenta.');
    });
</script>
</body>
</html>
