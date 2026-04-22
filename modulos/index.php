<?php
session_start();
// Configuración de conexión (Ajustada a tu BD de Render)
$host = "dpg-d7k1offavr4c73esdbeg-a.oregon-postgres.render.com";
$dbname = "life_gym_db_hvmq";
$user = "life_gym_db_hvmq_user";
$password = "lEovCr88q2giz5REW4MwUPePidNosjc1";

try {
    $dsn = "pgsql:host=$host;port=5432;dbname=$dbname;";
    $pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    // Silencioso para el usuario en producción
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Life Gym Elite | Innovación en Pasto</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;600;800&family=Plus+Jakarta+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root { --brand: #A3E635; --dark: #0A0A0A; --card: #141414; --gray: #9CA3AF; }
        
        body { 
            background-color: var(--dark); 
            color: #E5E7EB; 
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow-x: hidden;
        }

        /* --- Navbar Estilo Glassmorphism --- */
        .navbar {
            background: rgba(10, 10, 10, 0.85);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(255,255,255,0.05);
            padding: 15px 0;
            transition: 0.3s;
        }

        /* --- Carrusel Full Screen con imagen 444.jpg --- */
        .carousel-item {
            height: 90vh;
            background-size: cover;
            background-position: center;
        }
        .carousel-overlay {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(to right, rgba(0,0,0,0.8), rgba(0,0,0,0.2));
        }
        .carousel-caption {
            text-align: left;
            top: 35%;
            left: 10%;
            max-width: 650px;
        }

        /* --- Secciones de Información --- */
        .section-title { font-family: 'Outfit', sans-serif; font-size: 2.5rem; margin-bottom: 40px; text-transform: uppercase; }
        .info-card {
            background: var(--card);
            border: 1px solid #222;
            padding: 40px;
            border-radius: 24px;
            height: 100%;
            transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .info-card:hover { border-color: var(--brand); transform: translateY(-10px); box-shadow: 0 10px 30px rgba(163, 230, 53, 0.1); }
        
        .zone-img {
            border-radius: 20px;
            overflow: hidden;
            height: 300px;
            position: relative;
            margin-bottom: 20px;
            border: 1px solid #333;
        }
        .zone-img img { width: 100%; height: 100%; object-fit: cover; transition: 0.6s; filter: grayscale(30%); }
        .zone-img:hover img { transform: scale(1.1); filter: grayscale(0%); }

        /* --- LifeBot (IA) Flotante --- */
        #bot-container { position: fixed; bottom: 25px; right: 25px; z-index: 9999; }
        #bot-window {
            width: 350px; height: 500px; background: #111; border: 1px solid var(--brand);
            border-radius: 24px; display: none; flex-direction: column; overflow: hidden;
            box-shadow: 0 25px 50px rgba(0,0,0,0.6);
        }
        .bot-header { background: var(--brand); color: #000; padding: 18px; font-weight: 800; display: flex; justify-content: space-between; align-items: center; }
        #chat-box { flex: 1; padding: 20px; overflow-y: auto; background: #050505; }
        .msg { margin-bottom: 15px; padding: 12px; border-radius: 15px; font-size: 0.9rem; line-height: 1.4; }
        .msg.bot { background: #1a1a1a; color: #fff; border-left: 4px solid var(--brand); align-self: flex-start; }
        .msg.user { background: var(--brand); color: #000; font-weight: 600; align-self: flex-end; margin-left: 15%; }

        .btn-brand { background: var(--brand); color: #000; font-weight: 800; border-radius: 12px; padding: 14px 28px; border: none; transition: 0.3s; text-transform: uppercase; }
        .btn-brand:hover { background: #bef264; transform: scale(1.05); color: #000; }
        
        .form-control { background: #000 !important; color: #fff !important; border: 1px solid #333 !important; }
        .form-control:focus { border-color: var(--brand) !important; box-shadow: none !important; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3" href="#">LIFE<span style="color:var(--brand)">GYM</span></a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="#nosotros">NOSOTROS</a></li>
                    <li class="nav-item"><a class="nav-link" href="#zonas">ESPACIOS</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contacto">CONTACTO</a></li>
                    <li class="nav-item ms-lg-3">
                        <?php if (isset($_SESSION['usuario_id'])): ?>
                            <a href="cuenta.php" class="btn btn-brand btn-sm px-4">MI CUENTA</a>
                        <?php else: ?>
                            <a href="modulos/login.php" class="btn btn-brand btn-sm px-4">INGRESAR</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="gymCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#gymCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#gymCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#gymCarousel" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" style="background-image: url('imagenes/444.jpg');">
                <div class="carousel-overlay"></div>
                <div class="carousel-caption">
                    <h1 class="display-1 fw-bold" data-aos="fade-right">SUPERA TUS <br><span style="color:var(--brand)">LÍMITES</span></h1>
                    <p class="lead text-light fs-4">Bienvenido a la nueva era del fitness en Pasto. Tecnología y potencia en un solo lugar.</p>
                    <a href="#contacto" class="btn btn-brand btn-lg mt-3">OBTENER CORTESÍA</a>
                </div>
            </div>
            <div class="carousel-item" style="background-image: url('imagenes/life.png');">
                <div class="carousel-overlay"></div>
                <div class="carousel-caption">
                    <h1 class="display-2 fw-bold">ZONA <span style="color:var(--brand)">MUSCULACIÓN</span></h1>
                    <p class="lead text-light">Equipamiento de alto nivel para resultados profesionales.</p>
                </div>
            </div>
            <div class="carousel-item" style="background-image: url('https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?q=80&w=1470');">
                <div class="carousel-overlay"></div>
                <div class="carousel-caption">
                    <h1 class="display-2 fw-bold">ZONA <span style="color:var(--brand)">CARDIO</span></h1>
                    <p class="lead text-light">Quema calorías con la mejor vista y tecnología de monitoreo.</p>
                </div>
            </div>
        </div>
    </div>

    <section id="nosotros" class="py-5 container">
        <div class="row g-5 py-5 text-center text-md-start">
            <div class="col-md-6" data-aos="fade-up">
                <div class="info-card">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-rocket fa-2x me-3" style="color:var(--brand)"></i>
                        <h3 class="mb-0">MISIÓN</h3>
                    </div>
                    <p class="text-muted fs-5">Transformar la vida de los ciudadanos en Pasto a través del ejercicio físico asistido por tecnología, proporcionando un ambiente de alta motivación y resultados científicos.</p>
                </div>
            </div>
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="info-card">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-eye fa-2x me-3" style="color:var(--brand)"></i>
                        <h3 class="mb-0">VISIÓN</h3>
                    </div>
                    <p class="text-muted fs-5">Para el 2027, ser el gimnasio líder en el suroccidente colombiano, reconocido por la integración de IA en planes de nutrición y entrenamiento personalizado.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="zonas" class="py-5 bg-black">
        <div class="container py-5">
            <h2 class="section-title text-center">NUESTROS <span style="color:var(--brand)">ESPACIOS</span></h2>
            <div class="row g-4">
                <div class="col-md-4" data-aos="zoom-in">
                    <div class="zone-img">
                        <img src="https://images.unsplash.com/photo-1593079831268-3381b0db4a77?q=80&w=1469" alt="Pesas">
                    </div>
                    <h4 class="text-center">ÁREA DE PESO LIBRE</h4>
                </div>
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
                    <div class="zone-img">
                        <img src="imagenes/musculacion.png" alt="Funcional">
                    </div>
                    <h4 class="text-center">BOX FUNCIONAL</h4>
                </div>
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
                    <div class="zone-img">
                        <img src="imagenes/salon.png" alt="Duchas">
                    </div>
                    <h4 class="text-center">ZONA DE DUCHAS & RELAX</h4>
                </div>
            </div>
        </div>
    </section>

    <section id="contacto" class="py-5" style="background: linear-gradient(180deg, #0A0A0A 0%, #111 100%);">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-6" data-aos="zoom-in">
                    <div class="info-card" style="border: 1px solid var(--brand);">
                        <h2 class="section-title text-center mb-2" style="font-size: 1.8rem;">¿LISTO PARA EL <span style="color:var(--brand)">CAMBIO?</span></h2>
                        <p class="text-center text-muted mb-4">Déjanos tus datos y te contactaremos de inmediato.</p>
                        
                        <form id="contactForm">
                            <div class="mb-3">
                                <label class="small text-muted">Nombre Completo</label>
                                <input type="text" id="c_nombre" class="form-control p-3" placeholder="Tu nombre" required>
                            </div>
                            <div class="mb-3">
                                <label class="small text-muted">Correo Electrónico</label>
                                <input type="email" id="c_correo" class="form-control p-3" placeholder="nicolas@gmail.com" required>
                            </div>
                            <div class="mb-4">
                                <label class="small text-muted">Teléfono / WhatsApp</label>
                                <input type="tel" id="c_telefono" class="form-control p-3" placeholder="301 687 1731" required>
                            </div>
                            <button type="submit" class="btn btn-brand w-100 py-3 shadow-lg">
                                <i class="fab fa-whatsapp me-2"></i> ENVIAR AL WHATSAPP
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-4 border-top border-secondary mt-5">
        <div class="container text-center">
            <p class="text-muted small mb-0">&copy; 2026 Life Gym Elite | Desarrollado por Nicolas Jimenez Guzman</p>
            <p class="text-muted x-small">Pasto, Nariño, Colombia</p>
        </div>
    </footer>

    <div id="bot-container">
        <div id="bot-window">
            <div class="bot-header">
                <span><i class="fas fa-robot me-2"></i> LifeBot AI</span>
                <span style="cursor:pointer" onclick="toggleBot()">−</span>
            </div>
            <div id="chat-box" class="d-flex flex-column">
                <div class="msg bot">¡Hola Nicolás! Soy tu asistente de Life Gym. ¿Quieres saber cuánta proteína necesitas según tus 83kg o prefieres ver tu rutina?</div>
            </div>
            <div class="p-3 bg-black d-flex gap-2">
                <input type="text" id="user-input" class="form-control form-control-sm" placeholder="Escribe aquí...">
                <button class="btn btn-sm btn-brand" onclick="sendMsg()">IR</button>
            </div>
        </div>
        <button class="btn-brand shadow-lg" style="border-radius: 50%; width:65px; height:65px;" onclick="toggleBot()">
            <i class="fas fa-heartbeat fa-lg"></i>
        </button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ once: true, duration: 1000 });

        // Función del Bot
        function toggleBot() {
            const win = document.getElementById('bot-window');
            win.style.display = (win.style.display === 'flex') ? 'none' : 'flex';
        }

        function sendMsg() {
            const input = document.getElementById('user-input');
            const chat = document.getElementById('chat-box');
            if(!input.value) return;

            chat.innerHTML += `<div class="msg user">${input.value}</div>`;
            const text = input.value.toLowerCase();
            input.value = "";

            setTimeout(() => {
                let resp = "Para una respuesta personalizada sobre nutrición, recuerda que estamos en el sector de Pasto con pesaje InBody.";
                if(text.includes("proteina") || text.includes("dieta")) resp = "Como pesas 83kg, tu consumo ideal son 166g de proteína al día.";
                if(text.includes("hola")) resp = "¡Hola! ¿Listo para entrenar hoy en Life Gym?";
                
                chat.innerHTML += `<div class="msg bot">${resp}</div>`;
                chat.scrollTop = chat.scrollHeight;
            }, 600);
        }

        // Lógica de Formulario y WhatsApp
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const nombre = document.getElementById('c_nombre').value;
            const correo = document.getElementById('c_correo').value;
            const tel = document.getElementById('c_telefono').value;
            
            const miNum = "573016871731"; 
            const msg = `Hola Nicolás! Mi nombre es ${nombre}. Mi correo es ${correo} y mi tel es ${tel}. Quiero información de Life Gym.`;
            const url = `https://wa.me/${miNum}?text=${encodeURIComponent(msg)}`;
            
            alert('¡Excelente elección! Te estamos conectando con nuestro equipo.');
            window.open(url, '_blank');
        });
    </script>
</body>
</html>
