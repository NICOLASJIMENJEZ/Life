<?php
session_start();
// Configuración de conexión (Ajustada a tu BD de Render para futuras consultas)
$host = "dpg-d7k1offavr4c73esdbeg-a.oregon-postgres.render.com";
$dbname = "life_gym_db_hvmq";
$user = "life_gym_db_hvmq_user";
$password = "lEovCr88q2giz5REW4MwUPePidNosjc1";

try {
    $dsn = "pgsql:host=$host;port=5432;dbname=$dbname;";
    $pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    // Silencioso para el usuario
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
            background: rgba(10, 10, 10, 0.8);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(255,255,255,0.05);
            padding: 15px 0;
        }

        /* --- Carrusel Full Screen --- */
        .carousel-item {
            height: 90vh;
            background-size: cover;
            background-position: center;
        }
        .carousel-overlay {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(to right, rgba(0,0,0,0.8), transparent);
        }
        .carousel-caption {
            text-align: left;
            top: 30%;
            left: 10%;
            max-width: 600px;
        }

        /* --- Secciones de Información --- */
        .section-title { font-family: 'Outfit', sans-serif; font-size: 2.5rem; margin-bottom: 40px; }
        .info-card {
            background: var(--card);
            border: 1px solid #222;
            padding: 40px;
            border-radius: 24px;
            height: 100%;
            transition: 0.3s;
        }
        .info-card:hover { border-color: var(--brand); transform: translateY(-5px); }
        
        .zone-img {
            border-radius: 20px;
            overflow: hidden;
            height: 300px;
            position: relative;
            margin-bottom: 20px;
        }
        .zone-img img { width: 100%; height: 100%; object-fit: cover; transition: 0.5s; }
        .zone-img:hover img { transform: scale(1.1); }

        /* --- LifeBot (IA) Flotante --- */
        #bot-container { position: fixed; bottom: 20px; right: 20px; z-index: 9999; }
        #bot-window {
            width: 350px; height: 500px; background: #111; border: 1px solid var(--brand);
            border-radius: 20px; display: none; flex-direction: column; overflow: hidden;
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
        }
        .bot-header { background: var(--brand); color: #000; padding: 15px; font-weight: bold; display: flex; justify-content: space-between; }
        #chat-box { flex: 1; padding: 15px; overflow-y: auto; background: #000; }
        .msg { margin-bottom: 10px; padding: 10px; border-radius: 10px; font-size: 0.9rem; }
        .msg.bot { background: #1a1a1a; color: #fff; border-left: 3px solid var(--brand); }
        .msg.user { background: var(--brand); color: #000; margin-left: 20%; }

        .btn-brand { background: var(--brand); color: #000; font-weight: bold; border-radius: 12px; padding: 12px 25px; border: none; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3" href="#">LIFE<span style="color:var(--brand)">GYM</span></a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="#nosotros">NOSOTROS</a></li>
                    <li class="nav-item"><a class="nav-link" href="#zonas">ZONAS</a></li>
                    <li class="nav-item"><a class="nav-link" href="#planes">PLANES</a></li>
                    <li class="nav-item ms-lg-3"><a href="/cuenta.php" class="btn btn-brand btn-sm">MI CUENTA</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="gymCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" style="background-image: url('https://images.unsplash.com/photo-1540497077202-7c8a3999166f?q=80&w=1470');">
                <div class="carousel-overlay"></div>
                <div class="carousel-caption">
                    <h1 class="display-2 fw-bold" data-aos="fade-right">ZONA <span style="color:var(--brand)">MUSCULACIÓN</span></h1>
                    <p class="lead text-light">Más de 50 máquinas de peso integrado y área de peso libre profesional.</p>
                    <a href="registro.php" class="btn btn-brand btn-lg">INICIAR AHORA</a>
                </div>
            </div>
            <div class="carousel-item" style="background-image: url('https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?q=80&w=1470');">
                <div class="carousel-overlay"></div>
                <div class="carousel-caption">
                    <h1 class="display-2 fw-bold">ZONA <span style="color:var(--brand)">CARDIO</span></h1>
                    <p class="lead text-light">Cintas de correr y elípticas con conexión inteligente y monitoreo.</p>
                </div>
            </div>
        </div>
    </div>

    <section id="nosotros" class="py-5 container">
        <div class="row g-5 py-5">
            <div class="col-md-6" data-aos="fade-up">
                <div class="info-card">
                    <h3 style="color:var(--brand)">MISIÓN</h3>
                    <p class="text-muted fs-5">Transformar la vida de los ciudadanos en Pasto a través del ejercicio físico asistido por tecnología, proporcionando un ambiente de alta motivación y resultados científicos.</p>
                </div>
            </div>
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="info-card">
                    <h3 style="color:var(--brand)">VISIÓN</h3>
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
                    <h4 class="text-center">ZONA DE DUCHAS & LOCKERS</h4>
                </div>
            </div>
        </div>
    </section>

    <div id="bot-container">
        <div id="bot-window">
            <div class="bot-header">
                <span><i class="fas fa-robot"></i> LifeBot IA</span>
                <span style="cursor:pointer" onclick="toggleBot()">−</span>
            </div>
            <div id="chat-box">
                <div class="msg bot">¡Hola! Soy la IA de Life Gym. ¿En qué puedo ayudarte hoy con tu nutrición o entrenamiento?</div>
            </div>
            <div class="p-2 d-flex gap-2 bg-dark">
                <input type="text" id="user-input" class="form-control form-control-sm bg-black text-white border-secondary" placeholder="Escribe tu duda...">
                <button class="btn btn-sm btn-brand" onclick="sendMsg()">ENVIAR</button>
            </div>
        </div>
        <button class="btn-brand" style="border-radius: 50%; width:60px; height:60px;" onclick="toggleBot()">
            <i class="fas fa-comment-dots fa-lg"></i>
        </button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ once: true });

        function toggleBot() {
            const win = document.getElementById('bot-window');
            win.style.display = (win.style.display === 'flex') ? 'none' : 'flex';
        }

        function sendMsg() {
            const input = document.getElementById('user-input');
            const chat = document.getElementById('chat-box');
            if(!input.value) return;

            chat.innerHTML += `<div class="msg user">${input.value}</div>`;
            const userText = input.value.toLowerCase();
            input.value = "";

            setTimeout(() => {
                let resp = "No estoy seguro de eso, pero puedes consultarlo con Nicolás, nuestro coach líder.";
                if(userText.includes("dieta")) resp = "Recuerda que para ganar músculo necesitas al menos 1.8g de proteína por kilo de peso.";
                if(userText.includes("hora")) resp = "Estamos abiertos de 5:00 AM a 10:00 PM.";
                if(userText.includes("rutina")) resp = "En tu sección de 'Mi Cuenta' tienes una rutina personalizada esperándote.";
                
                chat.innerHTML += `<div class="msg bot">${resp}</div>`;
                chat.scrollTop = chat.scrollHeight;
            }, 800);
        }
    </script>
</body>
</html>
