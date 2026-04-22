<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Cuenta | Life Gym Elite</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;700&family=Outfit:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    
    <style>
        :root { 
            --brand-green: #A3E635; 
            --bg-dark: #0A0A0A; 
            --card-bg: #141414;
            --input-bg: #1F1F1F;
            --gray-text: #9CA3AF;
        }

        body { 
            background-color: var(--bg-dark); 
            color: #E5E7EB; 
            font-family: 'Plus Jakarta Sans', sans-serif;
            padding-bottom: 50px;
        }

        /* Navbar específica de cuenta */
        .nav-account {
            background: rgba(10, 10, 10, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        /* Tarjetas estilo "Bento" */
        .bento-card {
            background: var(--card-bg);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 24px;
            padding: 25px;
            height: 100%;
            transition: transform 0.3s ease;
        }

        .bento-card:hover {
            border-color: rgba(163, 230, 53, 0.3);
        }

        .profile-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--brand-green);
        }

        .status-badge {
            background: rgba(163, 230, 53, 0.1);
            color: var(--brand-green);
            padding: 5px 15px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .icon-box {
            width: 45px;
            height: 45px;
            background: var(--input-bg);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--brand-green);
            margin-bottom: 15px;
        }

        .btn-action {
            background: var(--input-bg);
            color: white;
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            width: 100%;
            padding: 10px;
            transition: 0.3s;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-action:hover {
            background: var(--brand-green);
            color: black;
        }
    </style>
</head>
<body>

    <nav class="navbar nav-account sticky-top mb-4">
        <div class="container">
            <a class="navbar-brand text-white fw-bold" href="index.php">LIFE<span style="color:var(--brand-green)">GYM</span></a>
            <div class="dropdown">
                <a href="#" class="text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fas fa-bell me-3"></i>
                    <img src="https://via.placeholder.com/40" class="rounded-circle" alt="User">
                </a>
                <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Editar Perfil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="logout.php">Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row g-4">
            
            <div class="col-lg-4">
                <div class="bento-card text-center">
                    <img src="https://via.placeholder.com/150" class="profile-img mb-3" alt="Socio">
                    <h3 class="h5 mb-1">Nicolás Jiménez</h3>
                    <p class="text-muted small mb-3">Socio desde: Marzo 2026</p>
                    <div class="status-badge mb-4">PLAN TRIMESTRAL ACTIVO</div>
                    
                    <div class="text-start border-top border-secondary pt-3 mt-2">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="small text-muted">Próximo pago:</span>
                            <span class="small fw-bold">20 de Junio, 2026</span>
                        </div>
                        <a href="renovar.php" class="btn btn-action mt-2">Renovar Membresía</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="bento-card">
                            <div class="icon-box"><i class="fas fa-user-clock"></i></div>
                            <h5>Sesiones Personalizadas</h5>
                            <p class="small text-muted">Tu coach te ha asignado 3 sesiones esta semana.</p>
                            <ul class="list-unstyled small">
                                <li class="mb-2"><i class="fas fa-calendar-day me-2"></i> Martes - 4:00 PM</li>
                                <li class="mb-2"><i class="fas fa-calendar-day me-2"></i> Jueves - 4:00 PM</li>
                            </ul>
                            <a href="clases.php" class="btn-action">Ver todas mis clases</a>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="bento-card">
                            <div class="icon-box"><i class="fas fa-dumbbell"></i></div>
                            <h5>Mi Rutina Actual</h5>
                            <p class="small text-muted">Foco: Hipertrofia - Semana 2</p>
                            <div class="progress mb-3" style="height: 8px; background: #2D2D2D;">
                                <div class="progress-bar" style="width: 65%; background: var(--brand-green);"></div>
                            </div>
                            <span class="small">65% completado</span>
                            <a href="rutinas.php" class="btn-action mt-3">Continuar Entrenamiento</a>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="bento-card d-flex align-items-center justify-content-between">
                            <div>
                                <h5 class="mb-1">Evolución Corporal</h5>
                                <p class="small text-muted mb-0">Último pesaje: 83 kg | Grasa: 14%</p>
                            </div>
                            <div class="text-end">
                                <a href="progreso.php" class="btn-action" style="width: auto; padding: 10px 25px;">Ver Gráficas</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="bento-card text-center" style="border: 1px dashed var(--brand-green);">
                            <p class="small mb-2">Usa este código para ingresar a las instalaciones</p>
                            <i class="fas fa-qrcode fa-5x mb-2" style="color: var(--brand-green)"></i>
                            <p class="small fw-bold">ID: LG-2026-X99</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
