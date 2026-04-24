<?php
session_start();
// Configuración centralizada
$db_config = [
    "host" => "dpg-d7k1offavr4c73esdbeg-a.oregon-postgres.render.com",
    "db"   => "life_gym_db_hvmq",
    "user" => "life_gym_db_hvmq_user",
    "pass" => "lEovCr88q2giz5REW4MwUPePidNosjc1"
];

try {
    $dsn = "pgsql:host={$db_config['host']};port=5432;dbname={$db_config['db']};";
    $pdo = new PDO($dsn, $db_config['user'], $db_config['pass'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    // Error silencioso
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LIFE GYM ELITE | POTENCIA TU VIDA</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;700;900&family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root { 
            --brand: #A3E635; 
            --dark-bg: #050505; 
            --surface: #0f0f0f;
            --border: rgba(163, 230, 53, 0.2);
            --text-main: #f8fafc;
        }

        body { 
            background-color: var(--dark-bg); 
            color: var(--text-main); 
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }

        h1, h2, h3, .nav-link { font-family: 'Outfit', sans-serif; font-weight: 900; letter-spacing: -1px; }

        /* Navbar Mejorada */
        .navbar {
            background: rgba(5, 5, 5, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            padding: 15px 0;
        }
        .nav-link { 
            font-size: 0.85rem; 
            text-transform: uppercase; 
            letter-spacing: 1px; 
            margin: 0 10px;
            transition: 0.3s;
        }
        .nav-link:hover { color: var(--brand) !important; }

        /* Hero */
        .hero-section {
            height: 90vh;
            position: relative;
            display: flex;
            align-items: center;
            overflow: hidden;
        }
        .hero-video-bg {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            object-fit: cover;
            opacity: 0.35;
            filter: grayscale(100%);
        }
        .hero-content { position: relative; z-index: 10; }
        .glitch-text {
            font-size: clamp(2.5rem, 8vw, 5.5rem);
            line-height: 0.9;
            text-transform: uppercase;
            background: linear-gradient(to bottom, #fff 60%, var(--brand) 100%);
            -webkit-background-clip: text;
            -webkit-fill-color: transparent;
            font-weight: 900;
        }

        /* Zonas (Grid de 5) */
        .zone-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr); /* Grid de 6 para acomodar 5 */
            gap: 1rem;
            margin-top: 40px;
        }
        .zone-card {
            position: relative;
            height: 400px;
            overflow: hidden;
            border-radius: 8px;
            background: #111;
        }
        /* Ajuste para que las 5 zonas se distribuyan bien */
        .zone-card:nth-child(1), .zone-card:nth-child(2) { grid-column: span 3; }
        .zone-card:nth-child(3), .zone-card:nth-child(4), .zone-card:nth-child(5) { grid-column: span 2; }

        @media (max-width: 768px) {
            .zone-card { grid-column: span 6 !important; }
        }

        .zone-card img {
            width: 100%; height: 100%; object-fit: cover;
            transition: 0.8s transform ease;
            filter: grayscale(1);
        }
        .zone-card:hover img { transform: scale(1.05); filter: grayscale(0.5); }
        .zone-overlay {
            position: absolute; bottom: 0; left: 0; width: 100%;
            padding: 20px;
            background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
        }

        /* Botones Elite */
        .btn-elite {
            background: var(--brand);
            color: #000;
            font-weight: 900;
            padding: 12px 25px;
            border: none;
            text-transform: uppercase;
            clip-path: polygon(10% 0, 100% 0, 90% 100%, 0% 100%);
            transition: 0.3s;
            font-size: 0.8rem;
        }
        .btn-elite:hover { background: #fff; transform: scale(1.05); }

        .btn-outline-elite {
            border: 1px solid var(--brand);
            color: var(--brand);
            padding: 10px 20px;
            text-transform: uppercase;
            font-weight: 700;
            font-size: 0.75rem;
            transition: 0.3s;
        }
        .btn-outline-elite:hover { background: var(--brand); color: #000; }

        /* Animación de imágenes con JS */
        .floating-img {
            animation: floating 6s infinite ease-in-out;
        }
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        /* Formulario */
        .contact-integration {
            display: flex;
            flex-wrap: wrap;
            background: var(--surface);
            border-top: 1px solid var(--border);
        }
        .contact-img { flex: 1 1 400px; min-height: 350px; background: url('https://images.unsplash.com/photo-1540497077202-7c8a3999166f?q=80&w=1470') center/cover; filter: grayscale(1); }
        .contact-form-area { flex: 1 1 400px; padding: 50px; }

        input.form-control {
            background: transparent !important;
            border: none !important;
            border-bottom: 2px solid #222 !important;
            border-radius: 0 !important;
            color: white !important;
            padding: 15px 0 !important;
        }
        input.form-control:focus { border-bottom-color: var(--brand) !important; box-shadow: none !important; }

        .wa-float {
            position: fixed; bottom: 30px; right: 30px; background: #25D366;
            color: white; width: 60px; height: 60px; border-radius: 50px;
            display: flex; align-items: center; justify-content: center; font-size: 30px;
            box-shadow: 0 10px 25px rgba(37,211,102,0.3); z-index: 1000;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-black fs-2" href="#">LIFE<span style="color:var(--brand)">GYM</span></a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navMain">
              <ul class="navbar-nav mx-auto">
    <li class="nav-item">
        <a class="nav-link" href="index.php">Inicio</a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link" href="modulos/zonas.html">Zonas</a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link" href="modulos/planes.php">Planes</a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link" href="#contacto">Contacto</a>
    </li>
</ul>
                
                <div class="d-flex align-items-center gap-2">
                    <?php if (isset($_SESSION['usuario_id'])): ?>
                        <a href="cuenta.php" class="btn btn-outline-elite">Mi Perfil</a>
                    <?php else: ?>
                        <a href="registro.php" class="btn btn-outline-elite">Regístrate</a>
                        <a href="login.php" class="btn btn-elite">Iniciar Sesión</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <section class="hero-section">
            <img src="imagenes/444.jpg" class="hero-video-bg" alt="Fondo">
            <div class="container hero-content">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <h1 class="glitch-text" id="hero-title">TU CUERPO ES<br>TU TEMPLO</h1>
                        <p class="lead text-uppercase fw-bold mt-3 mb-4" style="color:var(--brand); letter-spacing: 2px;">No te detengas hasta sentirte orgulloso.</p>
                        <div class="d-flex gap-3">
                            <a href="#zonas" class="btn btn-elite">Ver Espacios</a>
                            <a href="#contacto" class="btn btn-outline-light px-4" style="border-radius:0">Comenzar Hoy</a>
                        </div>
                    </div>
                    <div class="col-lg-5 d-none d-lg-block">
                        <img src="https://images.unsplash.com/photo-1517836357463-d25dfeac3438?q=80&w=1470" class="img-fluid floating-img" style="border-radius: 20px; border: 1px solid var(--border);" alt="Motivación">
                    </div>
                </div>
            </div>
        </section>

        <section class="py-4 bg-brand text-black text-center fw-bolder">
            <div class="container">
                <h4 class="mb-0 text-uppercase" id="motivation-text">"EL DOLOR ES TEMPORAL, EL ORGULLO ES PARA SIEMPRE"</h4>
            </div>
        </section>

        <section id="zonas" class="py-5 bg-black">
            <div class="container py-5">
                <h2 class="display-5 mb-5">ZONAS <span style="color:var(--brand)">ELITE</span></h2>
                
                <div class="zone-grid">
                    <div class="zone-card" data-aos="zoom-in">
                        <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=1470" alt="Pesas">
                        <div class="zone-overlay"><h3 class="h5">MUSCULACIÓN</h3></div>
                    </div>
                    <div class="zone-card" data-aos="zoom-in" data-aos-delay="100">
                        <img src="https://images.unsplash.com/photo-1593079831268-3381b0db4a77?q=80&w=1469" alt="Cardio">
                        <div class="zone-overlay"><h3 class="h5">CARDIO PRO</h3></div>
                    </div>
                    <div class="zone-card" data-aos="zoom-in" data-aos-delay="200">
                        <img src="https://images.unsplash.com/photo-1544033527-b192daee1f5b?q=80&w=1470" alt="Funcional">
                        <div class="zone-overlay"><h3 class="h5">BOX FUNCIONAL</h3></div>
                    </div>
                    <div class="zone-card" data-aos="zoom-in" data-aos-delay="300">
                        <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?q=80&w=1470" alt="Combate">
                        <div class="zone-overlay"><h3 class="h5">SALA DE COMBATE</h3></div>
                    </div>
                    <div class="zone-card" data-aos="zoom-in" data-aos-delay="400">
                        <img src="https://images.unsplash.com/photo-1594882645126-14020914d58d?q=80&w=1485" alt="Relax">
                        <div class="zone-overlay"><h3 class="h5">RECOVERY ZONE</h3></div>
                    </div>
                </div>
            </div>
        </section>

        <section id="contacto" class="container-fluid px-0">
            <div class="contact-integration">
                <div class="contact-img"></div>
                <div class="contact-form-area">
                    <h2 class="display-6 mb-4">¿LISTO PARA TU <br><span style="color:var(--brand)">MEJOR VERSIÓN?</span></h2>
                    <p class="text-muted small mb-4">Déjanos tus datos y un asesor se comunicará contigo vía WhatsApp.</p>
                    <form id="proContactForm">
                        <input type="text" id="p_name" class="form-control mb-3" placeholder="NOMBRE COMPLETO" required>
                        <input type="email" id="p_email" class="form-control mb-3" placeholder="CORREO" required>
                        <input type="tel" id="p_phone" class="form-control mb-3" placeholder="WHATSAPP" required>
                        <button type="submit" class="btn btn-elite w-100 mt-4">ENVIAR SOLICITUD</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <footer class="py-4 bg-black text-center border-top border-secondary">
        <p class="small text-muted mb-0">LIFE GYM ELITE &copy; 2026 | PASTO, NARIÑO</p>
    </footer>

    <a href="https://wa.me/573168771073" class="wa-float" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    
    <script>
        AOS.init({ duration: 800, once: true });

        // GSAP: Animación de entrada del título
        gsap.from("#hero-title", { 
            duration: 1.5, 
            x: -200, 
            opacity: 0, 
            ease: "power4.out",
            skewX: 10
        });

        // Rotación de mensajes motivadores
        const mensajes = [
            '"EL DOLOR ES TEMPORAL, EL ORGULLO ES PARA SIEMPRE"',
            '"TU ÚNICO LÍMITE ERES TÚ MISMO"',
            '"EL ÉXITO COMIENZA CON LA DECISIÓN DE INTENTARLO"',
            '"NO ES FITNESS, ES ESTILO DE VIDA"'
        ];
        let index = 0;
        setInterval(() => {
            index = (index + 1) % mensajes.length;
            const textElem = document.getElementById('motivation-text');
            gsap.to(textElem, { opacity: 0, duration: 0.5, onComplete: () => {
                textElem.innerText = mensajes[index];
                gsap.to(textElem, { opacity: 1, duration: 0.5 });
            }});
        }, 5000);

        // Formulario WhatsApp
        document.getElementById('proContactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const n = document.getElementById('p_name').value;
            const p = document.getElementById('p_phone').value;
            const msg = `HOLA LIFE GYM! Mi nombre es ${n}. Quiero inscribirme y recibir información de los planes. Mi WhatsApp es ${p}.`;
            window.open(`https://wa.me/573168771073?text=${encodeURIComponent(msg)}`, '_blank');
        });
    </script>
</body>
</html>
