<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Life Gym | Alto Rendimiento</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;500;800&family=Plus+Jakarta+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root { 
            --brand-green: #A3E635; /* Verde lima mate, no saturado */
            --bg-dark: #121212; 
            --light-gray: #E5E7EB; 
            --muted-text: #9CA3AF;
            --card-bg: #1C1C1C;
        }
        
        body { 
            background-color: var(--bg-dark); 
            color: var(--light-gray); 
            font-family: 'Plus Jakarta Sans', sans-serif;
            line-height: 1.6;
        }

        h1, h2, h3, .navbar-brand { 
            font-family: 'Outfit', sans-serif; 
            font-weight: 800;
            letter-spacing: -1px;
            text-transform: uppercase;
        }

        /* --- Navbar Minimalista --- */
        .navbar {
            background: rgba(18, 18, 18, 0.95);
            padding: 20px 0;
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            padding: 12px 0;
            border-bottom: 1px solid rgba(163, 230, 53, 0.2);
        }

        .nav-link {
            color: var(--light-gray) !important;
            font-weight: 500;
            margin: 0 15px;
            font-size: 0.9rem;
            transition: color 0.3s;
        }

        .nav-link:hover { color: var(--brand-green) !important; }

        /* --- Hero Section --- */
        .hero-clean {
            padding: 160px 0 100px;
            background: radial-gradient(circle at top right, rgba(163, 230, 53, 0.05), transparent), var(--bg-dark);
        }

        .text-gradient {
            background: linear-gradient(to right, #fff, var(--brand-green));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* --- Cards de Planes (Clean Tech) --- */
        .plan-card-new {
            background: var(--card-bg);
            border-radius: 24px;
            padding: 40px;
            border: 1px solid rgba(255,255,255,0.05);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .plan-card-new:hover {
            border-color: var(--brand-green);
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.4);
        }

        .btn-brand {
            background-color: var(--brand-green);
            color: #000;
            font-weight: 700;
            border-radius: 12px;
            padding: 12px 30px;
            border: none;
            transition: transform 0.2s;
        }

        .btn-brand:hover {
            transform: scale(1.05);
            background-color: #bef264;
        }

        /* --- Galería --- */
        .img-grid {
            border-radius: 20px;
            filter: grayscale(40%);
            transition: 0.4s;
            object-fit: cover;
            border: 1px solid rgba(255,255,255,0.1);
        }

        .img-grid:hover {
            filter: grayscale(0%);
            border-color: var(--brand-green);
        }

        /* --- Footer --- */
        footer {
            background: #0D0D0D;
            padding: 80px 0 30px;
            border-top: 1px solid rgba(255,255,255,0.05);
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg fixed-top navbar-dark">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <span style="color: #fff">LIFE</span><span style="color: var(--brand-green)">GYM</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navMain">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="#planes">PLANES</a></li>
                    <li class="nav-item"><a class="nav-link" href="#galeria">ESPACIOS</a></li>
                    <li class="nav-item"><a class="nav-link" href="#dashboard">MI CUENTA</a></li>
                    <li class="nav-item ms-lg-3">
                        <a href="registro.php" class="btn btn-brand btn-sm px-4">EMPEZAR</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero-clean">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7" data-aos="fade-up">
                    <span class="badge bg-dark border border-secondary mb-3 px-3 py-2 text-uppercase fw-bold">Training Experience Pasto</span>
                    <h1 class="display-2 mb-4">TRANSFORMA TU <br><span class="text-gradient">REALIDAD FÍSICA</span></h1>
                    <p class="lead text-muted mb-5 w-75">Entrena con instructores certificados en un entorno diseñado para el progreso real. Sin distracciones, solo resultados.</p>
                    
                    <div class="d-flex align-items-center gap-4">
                        <a href="#planes" class="btn btn-brand">VER MEMBRESÍAS</a>
                        <a href="mision.html" class="text-white text-decoration-none fw-bold small">NUESTRA FILOSOFÍA <i class="fas fa-arrow-right ms-2"></i></a>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block" data-aos="zoom-in">
                    <img src="imagenes/life.png" class="img-fluid rounded-4 shadow-lg" alt="Gym">
                </div>
            </div>
        </div>
    </header>

    <section id="planes" class="py-5">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="plan-card-new h-100">
                        <h6 class="text-uppercase text-muted fw-bold small">Plan Mensual</h6>
                        <h2 class="my-3">$80.000 <span class="fs-6 text-muted fw-normal">/mes</span></h2>
                        <ul class="list-unstyled mb-5">
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Zona de musculación</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Área de cardio</li>
                            <li class="mb-2"><i class="fas fa-times-circle text-muted me-2"></i> Clases dirigidas</li>
                        </ul>
                        <button class="btn btn-outline-light w-100 py-3 rounded-3">ADQUIRIR PLAN</button>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="plan-card-new h-100 border-success" style="background: linear-gradient(145deg, #1C1C1C, #121212);">
                        <h6 class="text-uppercase fw-bold small" style="color: var(--brand-green)">Plan Trimestral</h6>
                        <h2 class="my-3">$210.000 <span class="fs-6 text-muted fw-normal">/3 meses</span></h2>
                        <ul class="list-unstyled mb-5">
                            <li class="mb-2"><i class="fas fa-check-circle style="color: var(--brand-green)" me-2"></i> Todo lo del Básico</li>
                            <li class="mb-2"><i class="fas fa-check-circle style="color: var(--brand-green)" me-2"></i> Clases de Box y Cardio</li>
                            <li class="mb-2"><i class="fas fa-check-circle style="color: var(--brand-green)" me-2"></i> Seguimiento en App</li>
                        </ul>
                        <button class="btn btn-brand w-100 py-3 rounded-3">EL MÁS POPULAR</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer-minimal text-muted mt-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-4">
                    <h3 class="text-white mb-4">LIFE<span style="color: var(--brand-green)">GYM</span></h3>
                    <p class="small">Llevando el fitness en Pasto al siguiente nivel tecnológico y profesional.</p>
                </div>
                <div class="col-md-4 text-center">
                    <h6 class="text-white text-uppercase mb-4">Redes</h6>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="#" class="text-muted fs-4"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-muted fs-4"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-muted fs-4"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>
                <div class="col-md-4 text-md-end">
                    <h6 class="text-white text-uppercase mb-4">Horario</h6>
                    <p class="small mb-0">L-V: 05:00 - 22:00</p>
                    <p class="small">S-D: 08:00 - 12:00</p>
                </div>
            </div>
            <p class="text-center x-small">&copy; 2026 Life Gym. Código optimizado para rendimiento.</p>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true });
        
        window.addEventListener('scroll', function() {
            const nav = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                nav.classList.add('scrolled shadow-lg');
            } else {
                nav.classList.remove('scrolled shadow-lg');
            }
        });
    </script>
</body>
</html>
