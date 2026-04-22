<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Life Gym | Elite Fitness Pasto</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Syncopate:wght@400;700&family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root { 
            --neon-green: #39FF14; 
            --deep-black: #080808; 
            --glass: rgba(255, 255, 255, 0.05);
        }
        
        body { 
            background-color: var(--deep-black); 
            color: #fff; 
            font-family: 'Inter', sans-serif; 
            overflow-x: hidden;
        }

        h1, h2, .nav-link { font-family: 'Syncopate', sans-serif; }

        /* --- Ticker de Anuncios --- */
        .announcement-bar {
            background: var(--neon-green);
            color: black;
            font-weight: bold;
            padding: 5px 0;
            font-size: 0.8rem;
            text-transform: uppercase;
        }

        /* --- Navbar Futurista --- */
        .navbar {
            backdrop-filter: blur(15px);
            background: rgba(0,0,0,0.7);
            border-bottom: 1px solid rgba(57, 255, 20, 0.3);
            padding: 1rem 0;
        }

        /* --- Hero Section Revamped --- */
        .hero-v2 {
            height: 90vh;
            display: flex;
            align-items: center;
            background: linear-gradient(to right, rgba(0,0,0,0.9) 30%, transparent), url('imagenes/life.png');
            background-size: cover;
            background-position: center;
        }

        .text-glow {
            text-shadow: 0 0 20px rgba(57, 255, 20, 0.6);
        }

        /* --- Cards de Planes (Glassmorphism) --- */
        .plan-card {
            background: var(--glass);
            border: 1px solid rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            transition: 0.4s;
            position: relative;
            overflow: hidden;
        }

        .plan-card:hover {
            border-color: var(--neon-green);
            transform: scale(1.03);
            box-shadow: 0 0 30px rgba(57, 255, 20, 0.2);
        }

        .plan-card.popular::before {
            content: "RECOMENDADO";
            position: absolute;
            top: 20px;
            right: -30px;
            background: var(--neon-green);
            color: black;
            font-size: 0.7rem;
            padding: 5px 40px;
            transform: rotate(45deg);
            font-weight: bold;
        }

        /* --- Footer --- */
        .footer-elite {
            border-top: 1px solid rgba(57, 255, 20, 0.2);
            background: #000;
            padding-top: 50px;
        }
        
        .btn-neon {
            background: transparent;
            border: 2px solid var(--neon-green);
            color: var(--neon-green);
            font-weight: bold;
            letter-spacing: 2px;
            transition: 0.3s;
        }

        .btn-neon:hover {
            background: var(--neon-green);
            color: black;
            box-shadow: 0 0 20px var(--neon-green);
        }
    </style>
</head>

<body>

    <div class="announcement-bar">
        <marquee scrollamount="10">
            🔥 NUEVA SEDE EN SECTOR PANAMERICANA - ¡MATRICÚLATE YA! ⚡ COACH NICOLÁS DISPONIBLE PARA ASESORÍAS ⚡ HORARIO 24/7 PRÓXIMAMENTE 🔥
        </marquee>
    </div>

    <nav class="navbar navbar-expand-lg sticky-top navbar-dark">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <span class="text-white fw-bold h3 m-0">LIFE</span><span class="text-green h3 m-0" style="color:var(--neon-green)">GYM</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <i class="fas fa-bars text-white"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link px-3" href="#planes">PLANES</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="#instructores">COACHES</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="#espacios">SALA</a></li>
                    <li class="nav-item ms-lg-4">
                        <a href="login.php" class="btn btn-neon btn-sm">LOGIN <i class="fas fa-user-circle"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero-v2">
        <div class="container">
            <div class="row">
                <div class="col-lg-6" data-aos="fade-right">
                    <h1 class="display-1 fw-bold mb-0">HUSTLE</h1>
                    <h1 class="display-1 fw-bold text-green text-glow" style="color:var(--neon-green)">HARDER</h1>
                    <p class="lead my-4 text-secondary">No somos solo un gimnasio. Somos un centro de transformación física y mental en Pasto.</p>
                    <div class="d-flex gap-3">
                        <a href="#planes" class="btn btn-neon px-4 py-3">VER PLANES</a>
                        <a href="#registro" class="btn btn-outline-light px-4 py-3">REGISTRO</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section id="planes" class="py-5">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="h1">ELIGE TU <span style="color:var(--neon-green)">DESTINO</span></h2>
                <p class="text-secondary">Inversión en tu salud y futuro.</p>
            </div>
            
            <div class="row g-4 justify-content-center">
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
                    <div class="plan-card p-5 text-center">
                        <h4>MENSAL</h4>
                        <h2 class="display-4 fw-bold">$80k</h2>
                        <ul class="list-unstyled my-4 text-secondary">
                            <li>Acceso Full máquinas</li>
                            <li>Duchas y Lockers</li>
                            <li>Evaluación inicial</li>
                        </ul>
                        <a href="#registro" class="btn btn-outline-success w-100">SELECCIONAR</a>
                    </div>
                </div>

                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
                    <div class="plan-card p-5 text-center popular">
                        <h4 style="color:var(--neon-green)">TRIMESTRAL</h4>
                        <h2 class="display-4 fw-bold">$210k</h2>
                        <ul class="list-unstyled my-4 text-secondary">
                            <li>Acceso a todas las clases</li>
                            <li>App de seguimiento</li>
                            <li>1 Sesión con Coach Nicolás</li>
                        </ul>
                        <a href="#registro" class="btn btn-success w-100 text-black fw-bold">MATRICULARME</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-dark">
        <div class="container text-center" data-aos="fade-up">
            <h2 class="mb-5">TU PROGRESO EN LA PALMA DE TU MANO</h2>
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <img src="imagenes/dashboard_mockup.png" class="img-fluid" alt="App Preview"> </div>
                <div class="col-lg-6 text-start">
                    <div class="d-flex mb-4">
                        <div class="h1 me-3 text-green"><i class="fas fa-dumbbell"></i></div>
                        <div>
                            <h5>Rutinas Personalizadas</h5>
                            <p class="text-secondary">Accede a tus planes de entrenamiento desde cualquier lugar.</p>
                        </div>
                    </div>
                    <div class="d-flex mb-4">
                        <div class="h1 me-3 text-green"><i class="fas fa-calendar-check"></i></div>
                        <div>
                            <h5>Reserva de Clases</h5>
                            <p class="text-secondary">No te quedes sin cupo en las sesiones de Cardio y Box.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer-elite text-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <h3 style="color:var(--neon-green)">LIFEGYM</h3>
                    <p class="text-secondary small">El estándar de entrenamiento en Pasto. <br> Calle 18 #XX-XX, Pasto, Nariño.</p>
                </div>
                </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Inicializar animaciones
        AOS.init({
            duration: 1000,
            once: true
        });

        // Efecto scroll para navbar
        window.onscroll = function() {
            var nav = document.querySelector('.navbar');
            if (window.pageYOffset > 100) {
                nav.style.background = "rgba(0,0,0,0.95)";
                nav.style.padding = "0.5rem 0";
            } else {
                nav.style.background = "rgba(0,0,0,0.7)";
                nav.style.padding = "1rem 0";
            }
        };
    </script>
</body>
</html>
