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
    // Registro interno de errores
}
?>
<!DOCTYPE html>
<html lang="es" data-scroll-container>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LIFE GYM ELITE | PERFORMANCE HUB</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;700;900&family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/locomotive-scroll@4.1.4/dist/locomotive-scroll.min.css">

    <style>
        :root { 
            --brand: #A3E635; 
            --brand-inner: #86efac;
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

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--dark-bg); }
        ::-webkit-scrollbar-thumb { background: var(--brand); border-radius: 10px; }

        /* Glass Navbar */
        .navbar {
            background: rgba(5, 5, 5, 0.9);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            padding: 20px 0;
        }

        /* Hero Section Agresiva */
        .hero-section {
            height: 100vh;
            position: relative;
            display: flex;
            align-items: center;
            overflow: hidden;
        }
        .hero-video-bg {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            object-fit: cover;
            opacity: 0.4;
            filter: grayscale(100%);
        }
        .hero-content { position: relative; z-index: 10; }
        .glitch-text {
            font-size: clamp(3rem, 8vw, 6rem);
            line-height: 0.9;
            text-transform: uppercase;
            background: linear-gradient(to bottom, #fff 50%, var(--brand) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Grid de Zonas */
        .zone-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 50px;
        }
        .zone-card {
            position: relative;
            height: 450px;
            overflow: hidden;
            border-radius: 4px;
            border: 1px solid rgba(255,255,255,0.05);
            transition: 0.5s transform cubic-bezier(0.2, 1, 0.3, 1);
        }
        .zone-card img {
            width: 100%; height: 100%; object-fit: cover;
            transition: 1.2s scale cubic-bezier(0.2, 1, 0.3, 1);
            filter: saturate(0.2) contrast(1.2);
        }
        .zone-card:hover img { scale: 1.1; filter: saturate(1) contrast(1); }
        .zone-overlay {
            position: absolute; bottom: 0; left: 0; width: 100%;
            padding: 30px;
            background: linear-gradient(to top, rgba(0,0,0,0.9), transparent);
        }

        /* Formulario Integrado Full-Width */
        .contact-integration {
            display: flex;
            flex-wrap: wrap;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 0;
            overflow: hidden;
            margin-top: 100px;
        }
        .contact-img {
            flex: 1 1 500px;
            min-height: 400px;
            background: url('https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=1470') center/cover;
            filter: grayscale(1);
        }
        .contact-form-area {
            flex: 1 1 500px;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .btn-elite {
            background: var(--brand);
            color: #000;
            font-weight: 900;
            padding: 18px 35px;
            border: none;
            text-transform: uppercase;
            letter-spacing: 1px;
            clip-path: polygon(10% 0, 100% 0, 90% 100%, 0% 100%);
            transition: 0.3s;
        }
        .btn-elite:hover { background: #fff; transform: skewX(-5deg); }

        /* WhatsApp Widget */
        .wa-float {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #25D366;
            color: white;
            width: 60px; height: 60px;
            border-radius: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            box-shadow: 0 10px 25px rgba(37,211,102,0.3);
            z-index: 1000;
            transition: 0.3s;
        }
        .wa-float:hover { transform: scale(1.1) rotate(10deg); color: white; }

        input.form-control {
            background: transparent !important;
            border: none !important;
            border-bottom: 2px solid #333 !important;
            border-radius: 0 !important;
            color: white !important;
            padding: 15px 0 !important;
            margin-bottom: 20px;
        }
        input.form-control:focus { border-bottom-color: var(--brand) !important; box-shadow: none !important; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-black fs-2" href="#">LIFE<span style="color:var(--brand)">GYM</span></a>
            <div class="ms-auto d-flex align-items-center">
                <a href="#contacto" class="btn btn-outline-light btn-sm px-4 d-none d-md-inline-block me-3">SOPORTE</a>
                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <a href="cuenta.php" class="btn btn-brand btn-sm">DASHBOARD</a>
                <?php else: ?>
                    <a href="modulos/login.php" class="btn btn-elite btn-sm">ACCESS</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <main>
        <section class="hero-section">
            <img src="imagenes/444.jpg" class="hero-video-bg" alt="Fondo">
            <div class="container hero-content">
                <div class="row">
                    <div class="col-lg-8">
                        <h1 class="glitch-text" data-aos="fade-right">ENGINEERING<br>RESULTS</h1>
                        <p class="lead text-uppercase fw-bold mb-5 mt-3" style="color:var(--brand); letter-spacing: 4px;">Pasto / Suroccidente Col</p>
                        <div class="d-flex gap-3">
                            <a href="#zonas" class="btn btn-elite">Explorar Zonas</a>
                            <a href="#nosotros" class="btn btn-outline-light px-5" style="border-radius:0">ADN</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="zonas" class="py-5 bg-black">
            <div class="container py-5">
                <div class="d-flex justify-content-between align-items-end mb-5">
                    <div>
                        <h2 class="display-4 mb-0">AREAS <span style="color:var(--brand)">ELITE</span></h2>
                        <p class="text-muted mt-2">Distribución técnica para entrenamiento de alto rendimiento.</p>
                    </div>
                    <div class="text-brand fw-bold">01 / 06</div>
                </div>

                <div class="zone-grid">
                    <div class="zone-card" data-aos="fade-up">
                        <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=1470" alt="Musculación">
                        <div class="zone-overlay">
                            <h3 class="h4 mb-1">STRENGTH ZONE</h3>
                            <p class="small text-muted mb-0">Biometría avanzada y peso libre.</p>
                        </div>
                    </div>
                    <div class="zone-card" data-aos="fade-up" data-aos-delay="100">
                        <img src="imagenes/musculacion.png" alt="Cardio">
                        <div class="zone-overlay">
                            <h3 class="h4 mb-1">HYPER CARDIO</h3>
                            <p class="small text-muted mb-0">Monitoreo en tiempo real.</p>
                        </div>
                    </div>
                    <div class="zone-card" data-aos="fade-up" data-aos-delay="200">
                        <img src="imagenes/salon.png" alt="Combat">
                        <div class="zone-overlay">
                            <h3 class="h4 mb-1">WAR ROOM</h3>
                            <p class="small text-muted mb-0">Box funcional y artes marciales.</p>
                        </div>
                    </div>
                    <div class="zone-card" data-aos="fade-up">
                        <img src="https://images.unsplash.com/photo-1574673139084-c2a1df476242?q=80&w=1470" alt="Recuperación">
                        <div class="zone-overlay">
                            <h3 class="h4 mb-1">RECOVERY LAB</h3>
                            <p class="small text-muted mb-0">Crioterapia y relax muscular.</p>
                        </div>
                    </div>
                    <div class="zone-card" data-aos="fade-up" data-aos-delay="100">
                        <img src="https://images.unsplash.com/photo-1518611012118-29606d53012f?q=80&w=1470" alt="Yoga">
                        <div class="zone-overlay">
                            <h3 class="h4 mb-1">ZEN STUDIO</h3>
                            <p class="small text-muted mb-0">Yoga y movilidad articular.</p>
                        </div>
                    </div>
                    <div class="zone-card" data-aos="fade-up" data-aos-delay="200">
                        <img src="https://images.unsplash.com/photo-1594882645126-14020914d58d?q=80&w=1485" alt="Outdoor">
                        <div class="zone-overlay">
                            <h3 class="h4 mb-1">OUTDOOR DECK</h3>
                            <p class="small text-muted mb-0">Entrenamiento al aire libre.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="contacto" class="container-fluid px-0">
            <div class="contact-integration">
                <div class="contact-img"></div>
                <div class="contact-form-area">
                    <h2 class="display-5 mb-4">ÚNETE A LA <br><span style="color:var(--brand)">RESISTENCIA</span></h2>
                    <form id="proContactForm">
                        <input type="text" id="p_name" class="form-control" placeholder="NOMBRE COMPLETO" required>
                        <input type="email" id="p_email" class="form-control" placeholder="CORREO ELECTRÓNICO" required>
                        <input type="tel" id="p_phone" class="form-control" placeholder="WHATSAPP" required>
                        <button type="submit" class="btn btn-elite w-100 mt-4">INICIAR TRANSFORMACIÓN</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <footer class="py-5 bg-black border-top border-secondary">
        <div class="container text-center">
            <p class="small text-muted">LIFE GYM ELITE &copy; 2026 | ARCHITECTED BY NJG</p>
        </div>
    </footer>

    <a href="https://wa.me/573168771073" class="wa-float" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    
    <script>
        AOS.init({ duration: 1000, once: true });

        // GSAP Hero Animation
        gsap.from(".glitch-text", { opacity: 0, y: 100, duration: 1.5, ease: "power4.out" });

        // Logic Form
        document.getElementById('proContactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const n = document.getElementById('p_name').value;
            const p = document.getElementById('p_phone').value;
            const msg = `SOLICITUD ELITE: ${n} | TEL: ${p} | Quiero información sobre la membresía.`;
            window.open(`https://wa.me/573168771073?text=${encodeURIComponent(msg)}`, '_blank');
        });
    </script>
</body>
</html>
