<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Life Gym | Despierta tu Fuerza</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;700&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="estilos.css">
  
  <style>
    :root { --main-green: #28a745; --dark-bg: #121212; }
    body { background-color: var(--dark-bg); color: white; font-family: 'Roboto', sans-serif; }
    h1, h2, h3, .nav-link { font-family: 'Oswald', sans-serif; text-transform: uppercase; }
    .text-green { color: var(--main-green) !综合; }
    .navbar { background: rgba(0,0,0,0.9); border-bottom: 2px solid var(--main-green); }
    .hero-section { padding: 100px 0; background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('imagenes/life.png'); background-size: cover; background-position: center; }
    .card-instructor { transition: transform 0.3s; border: 1px solid var(--main-green) !important; background: #000 !important; }
    .card-instructor:hover { transform: translateY(-10px); }
    .instructor-image { width: 150px; height: 150px; object-fit: cover; border-radius: 50%; border: 3px solid var(--main-green); }
    .item-dia img { border-radius: 10px; cursor: pointer; transition: 0.3s; width: 100%; max-width: 150px; }
    .item-dia img:hover { filter: brightness(1.2); scale: 1.05; }
    footer { border-top: 2px solid var(--main-green); padding: 40px 0; background: #000; }
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="#">
        <h1 class="text-green m-0">LIFE</h1><h1 class="text-white m-0">GYM</h1>
      </a>
      <button class="navbar-toggler btn-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarMenu">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link text-white" href="planes.php">Planes</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="#instructors">Instructores</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="mision vision.html">Nosotros</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" data-bs-toggle="dropdown">Mi Cuenta</a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="clases_usuario.php">Clases</a></li>
              <li><a class="dropdown-item" href="ver_avance_cliente.php">Mi Progreso</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item text-danger" href="logout.php border-top">Cerrar Sesión</a></li>
            </ul>
          </li>
        </ul>
        <a href="#registro" class="btn btn-success ms-lg-3">ÚNETE AHORA</a>
      </div>
    </div>
  </nav>

  <section class="hero-section text-center text-white" id="home">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-7 text-lg-start">
          <h2 class="display-3 fw-bold mb-4">DESPIERTA TU <span class="text-green">FUERZA INTERIOR</span></h2>
          <p class="lead mb-5">Bienvenido al espacio de bienestar más moderno de Pasto. Tecnología punta y los mejores coaches para alcanzar lo imposible.</p>
        </div>
        <div class="col-lg-5" id="registro">
          <div class="card bg-dark text-white border-success p-4 shadow-lg">
            <h3 class="text-green mb-3">REGÍSTRATE GRATIS</h3>
            <p class="small">Recibe una clase de cortesía y conoce nuestras instalaciones.</p>
            <form action="registro_proceso.php" method="POST">
              <div class="mb-3"><input type="text" class="form-control" placeholder="Nombre completo" required></div>
              <div class="mb-3"><input type="email" class="form-control" placeholder="Tu Correo" required></div>
              <div class="mb-3"><input type="tel" class="form-control" placeholder="Teléfono" required></div>
              <button type="submit" class="btn btn-success w-100 fw-bold">OBTENER MI PASE</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="container my-5">
    <div id="carouselExampleAutoplaying" class="carousel slide carousel-fade shadow rounded overflow-hidden" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active"><img src="imagenes/life.png" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="Entrenamiento 1"></div>
        <div class="carousel-item"><img src="imagenes/gym.png" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="Entrenamiento 2"></div>
        <div class="carousel-item"><img src="imagenes/gym1.png" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="Entrenamiento 3"></div>
      </div>
    </div>
  </div>

  <section id="instructors" class="py-5 bg-dark">
    <div class="container">
      <h2 class="text-center mb-5 text-green">Nuestros Coaches Expertos</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card card-instructor h-100 text-center p-3">
            <img src="imagenes/profenico.png" class="instructor-image mx-auto mt-3" alt="Coach Nicolás">
            <div class="card-body">
              <h4 class="card-title text-green">Coach Nicolás</h4>
              <p class="text-secondary">Fisicoculturista Atleta</p>
              <ul class="list-unstyled text-start small">
                <li><i class="fas fa-check text-green me-2"></i>Preparador Físico Certificado</li>
                <li><i class="fas fa-check text-green me-2"></i>Especialista en Biomecánica</li>
                <li><i class="fas fa-check text-green me-2"></i>9 Años de Experiencia</li>
              </ul>
              <a href="https://instagram.com/jozefnicolas_" class="btn btn-outline-success btn-sm"><i class="fab fa-instagram"></i> Instagram</a>
            </div>
          </div>
        </div>
        </div>
    </div>
  </section>

  <section class="py-5 bg-black">
    <div class="container text-center">
      <h3 class="text-green mb-4">Motivación Diaria</h3>
      <div class="d-flex justify-content-center flex-wrap gap-3">
        <div class="item-dia">
          <img src="imagenes/lunes.png" alt="Lunes" data-bs-toggle="modal" data-bs-target="#modalImagen" onclick="verImagen(this)">
          <p class="mt-2">Lunes</p>
        </div>
        </div>
    </div>
  </section>

  <section class="py-5">
    <div class="container text-center">
      <h2 class="text-green mb-5">Instalaciones de Alto Nivel</h2>
      <div class="row g-3">
        <div class="col-6 col-md-3">
          <img src="imagenes/barra.jpg" class="img-fluid rounded border border-success" alt="Peso libre">
          <h6 class="mt-2">Peso Libre</h6>
        </div>
        <div class="col-6 col-md-3">
          <img src="imagenes/barra1.jpg" class="img-fluid rounded border border-success" alt="Mancuernas">
          <h6 class="mt-2">Mancuernas</h6>
        </div>
        <div class="col-6 col-md-3">
          <img src="imagenes/barra 2.jpg" class="img-fluid rounded border border-success" alt="Cardio">
          <h6 class="mt-2">Zona Cardio</h6>
        </div>
        <div class="col-6 col-md-3">
          <img src="imagenes/barra 3.jpg" class="img-fluid rounded border border-success" alt="Elipticas">
          <h6 class="mt-2">Maquinaria</h6>
        </div>
      </div>
    </div>
  </section>

  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-4 mb-4">
          <h3 class="text-green">LIFE<span class="text-white">GYM</span></h3>
          <p>Transformando vidas en Pasto a través del deporte y la disciplina.</p>
          <div class="fs-4">
            <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
            <a href="#" class="text-white me-3"><i class="fab fa-facebook"></i></a>
            <a href="#" class="text-white"><i class="fab fa-tiktok"></i></a>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <h4 class="text-green">Horarios</h4>
          <ul class="list-unstyled small">
            <li>Lunes - Viernes: 5:00 AM - 10:00 PM</li>
            <li>Sábados: 7:00 AM - 7:00 PM</li>
            <li>Dom y Festivos: 8:00 AM - 12:00 PM</li>
          </ul>
        </div>
        <div class="col-md-4">
          <h4 class="text-green">¿Dudas?</h4>
          <form id="contact-form">
            <input type="email" class="form-control form-control-sm mb-2 bg-dark text-white border-secondary" placeholder="Tu Email">
            <textarea class="form-control form-control-sm mb-2 bg-dark text-white border-secondary" placeholder="Mensaje"></textarea>
            <button class="btn btn-success btn-sm w-100">Enviar</button>
          </form>
        </div>
      </div>
      <hr class="bg-success">
      <p class="text-center small mb-0">&copy; 2026 Life Gym. Todos los derechos reservados.</p>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function verImagen(img) {
      document.getElementById('SimagenGrande').src = img.src;
      document.getElementById('modalTitulo').innerText = img.alt;
    }
  </script>
</body>
</html>
