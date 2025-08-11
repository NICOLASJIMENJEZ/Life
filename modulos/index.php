<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Life Gym</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome CORRECTO -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" referrerpolicy="no-referrer" />

  <!-- Tus estilos -->
  <link rel="stylesheet" href="estilos.css">
</head>




  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <h1  class="text-green">LIFE</h1>
      <h1 class="text-white">GYM</h1>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarMenu">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item"><a class="nav-link" href="planes.php">Planes</a></li>
          <li class="nav-item"><a class="nav-link" href="#contact">Contacto</a></li>
          <li class="nav-item"><a class="nav-link" href="mision vision.html">Misión y Visión</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Calendario</a>
            <ul class="dropdown-menu bg-dark">
              <li><a class="dropdown-item text-white" href="clases_usuario.php">Clases</a></li>
              <li><a class="dropdown-item text-white" href="ver_avance_cliente.php">Reportes</a></li>
            </ul>
          </li>
        </ul>
    <a href="logout.php" class="btn btn-success">Cerrar Sesión</a>


      </div>
    </div>
  </nav>

  <!-- Slogan -->
  <div class="slogan">
    <div class="slogan-text">DESPIERTA TU FUERZA INTERIOR, ALCANZA LO IMPOSIBLE</div>
    
    <!--<img  src="principal1.png" alt="Imagen inspiradora" />
  </div>

  <-- Carrusel -->
  <div id="carouselExampleAutoplaying" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active"><img src="imagenes/life.png" class="d-block w-100" alt="Entrenamiento 1"></div>
      <div class="carousel-item"><img src="imagenes/gym.png" class="d-block w-100" alt="Entrenamiento 2"></div>
     <div class="carousel-item"><img src="imagenes/gym1.png" class="d-block w-100" alt="Entrenamiento 3"></div>
      <div class="carousel-item"><img src="imagenes/mancuerna1.png" class="d-block w-100" alt="Entrenamiento 4"></div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button> <br>
      <p>Bienvenidos a nuestro espacio de bienestar y salud. En Espacio Life encontrarás un ambiente moderno y confortable 
        donde podrás disfrutar de nuestras instalaciones de última tecnología, diseñadas para ayudarte a alcanzar
         tus objetivos físicos. Ya sea que estés buscando mejorar tu fuerza, flexibilidad o resistencia,
          en Life Gym contamos con los mejores equipos y profesionales para apoyarte en tu viaje fitness.</p>
  </div>

  <!-- Instructores -->
<section id="instructors" class="py-5 text-center bg-dark text-white">
  <div class="container">
    <h2 class="section-title mb-5 text-green">Life Gym: Transformamos tu vida con instructores calificados.</h2>
    <div class="row justify-content-center g-4">

      <!-- Instructor 1 -->
      <div class="col-md-4">
        <div class="card bg-black border-success h-100 text-white">
          <img src="imagenes/profenico.png" class="instructor-image mx-auto mt-4" alt="Coach Nicolás">
          <div class="card-body">
            <h4 class="card-title text-green">Coach Nicolás</h4>
            <ul class="list-unstyled text-start ps-3">
              <li>✔️ Entrenador deportivo y preparador físico certificado</li> <br>
              <li>✔️ Especialista en métodos de entrenamiento</li> <br>
              <li>✔️ 9 años de experiencia</li> <br>
              <li>✔️ Atleta de fisicoculturismo y fitness</li> <br>
              <a href="https://instagram.com/jozefnicolas_" target="_blank">
              <i class="fab fa-instagram"></i> Sígueme en Instagra</a>

            </ul>
          </div>
        </div>
      </div>

      <!-- Instructor 2 -->
      <div class="col-md-4">
        <div class="card bg-black border-success h-100 text-white">
          <img src="imagenes/profepipe.png" class="instructor-image mx-auto mt-4" alt="Coach Pipe">
          <div class="card-body">
            <h4 class="card-title text-green">Coach Pipe</h4>
            <ol>✔️ Educador fisico certificado</ol> 
            <ol>✔️ Cross trainer</ol> 
            <ol>✔️ Entrenador en psicologia deportiva</ol> 
            <ol>✔️ Coach personalizado</ol> 
            <ol>✔️ 5 Años de experiencia</ol> 
            <ol>✔️ Atleta de condicion fisica</ol> 
          </div>
        </div>
      </div>

      <!-- Instructor 3 -->
      <div class="col-md-4">
        <div class="card bg-black border-success h-100 text-white">
          <img src="imagenes/profemario.png" class="instructor-image mx-auto mt-4" alt="Coach Mario">
          <div class="card-body">
            <h4 class="card-title text-green">Coach Mario</h4>
            <ol>✔️ Licenciado en educacion fisica</ol> 
            <ol>✔️ Entrenador deportivo</ol> 
            <ol>✔️ Diplomado en actividad fisica en adulto mayor </ol> 
            <ol>✔️ Certificado en planificacion control y evalucion del entrenamiento deportivo metodologia agil micovid</ol> 
            
         
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
<!--carousel motivacional-->

<section class="carrusel-semanal">
  <h3 class="titulo-carrusel">Motivación Semanal</h3>
  <div class="container-fluid position-relative">
    <div class="galeria-scroll-auto d-flex" id="galeriaScroll">
      <div class="item-dia">
<img src="imagenes/lunes.png" alt="Lunes" data-bs-toggle="modal" data-bs-target="#modalImagen" onclick="verImagen(this)">
        <p>Lunes</p>
      </div>
      <div class="item-dia">
        <img src="imagenes/martes.png" alt="Martes" data-bs-toggle="modal" data-bs-target="#modalImagen" onclick="verImagen(this)">
        <p>Martes</p>
      </div>
      <div class="item-dia">
        <img src="imagenes/miercoles.png" alt="Miércoles" data-bs-toggle="modal" data-bs-target="#modalImagen" onclick="verImagen(this)">
        <p>Miércoles</p>
      </div>
      <div class="item-dia">
        <img src="imagenes/jueves.png" alt="Miércoles" data-bs-toggle="modal" data-bs-target="#modalImagen" onclick="verImagen(this)">
        <p>Miércoles</p>
      </div>
      <div class="item-dia">
        <img src="imagenes/viernes.png" alt="Miércoles" data-bs-toggle="modal" data-bs-target="#modalImagen" onclick="verImagen(this)">
        <p>Miércoles</p>
      </div>
      <div class="item-dia">
        <img src="imagenes/sabado.png" alt="Miércoles" data-bs-toggle="modal" data-bs-target="#modalImagen" onclick="verImagen(this)">
        <p>Miércoles</p>
      </div>
      <div class="item-dia">
        <img src="imagenes/domingo.png" alt="Miércoles" data-bs-toggle="modal" data-bs-target="#modalImagen" onclick="verImagen(this)">
        <p>Miércoles</p>
      </div>
     
    </div>
  </div>
</section>

<!-- Modal de imagen ampliada -->
<div class="modal fade" id="modalImagen" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-dark text-white border border-success">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="modalTitulo"></h5>
        <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body text-center">
        <img id="SimagenGrande" src="" class="img-fluid rounded border border-success" alt="Imagen grande">
      </div>
    </div>
  </div>
</div>
<!--secciones de entrenamiento-->

<section class="espacio-life">
        <h1 id="titulo">Descubre Life Gym: innovación, bienestar y entrenamiento de alto nivel.</h1> <br>
      
        <div class="foto-container">
            <div class="foto-item">
                <img src="imagenes/barra.jpg" alt="Foto del gimnasio 1" class="foto">
                <h2>Equipos de peso librel</h2>
            </div>
            <div class="foto-item">
                <img src="imagenes/barra1.jpg" alt="Foto del gimnasio 2" class="foto">
                <h2>Mancuernas Bancos</h2>
            </div>
            <div class="foto-item">
                <img src="imagenes/barra 2.jpg" alt="Foto del gimnasio 3" class="foto">
                <h2>Zona de cardio y boz</h2>
            </div>
            <div class="foto-item">
                <img src="imagenes/barra 3.jpg" alt="Foto del gimnasio 4" class="foto">
                <h2>Bandas elipticas</h2>
            </div>
        </div>
    </section>



  <!-- Contacto -->
  <div id="contact" class="container my-5">
    <h2 class="contact-header text-center">Contáctanos</h2>
    <p class="contact-text text-center">¡Déjanos tu mensaje!</p>

    <form id="contact-form">
      <div class="mb-3"><input type="text" class="form-control" name="nombre" placeholder="Nombre" required></div>
      <div class="mb-3"><input type="email" class="form-control" name="email" placeholder="Correo electrónico" required></div>
      <div class="mb-3"><textarea class="form-control" name="mensaje" rows="5" placeholder="Mensaje" required></textarea></div>
      <button type="submit" class="btn-submit btn btn-primary">Enviar</button>
    </form>

    <div id="mensaje-estado" class="text-center mt-3"></div>
  </div>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $("#contact-form").submit(function (event) {
            event.preventDefault(); // Evita recarga
    
            var formData = $(this).serialize(); // Serializa el formulario
    
            $.ajax({
                type: "POST",
                url: "contacto.php", // ✅ Ruta corregida
                data: formData,
                success: function (response) {
                    $('#contact-form')[0].reset(); // Limpia el formulario
                    $('#mensaje-estado').html('<div class="alert alert-success">' + response + '</div>');
                },
                error: function () {
                    $('#mensaje-estado').html('<div class="alert alert-danger">Hubo un error al enviar el mensaje.</div>');
                }
            });
        });
    });
</script>
 <div class="creedenciales">
  <h1 class="text-green">LIFE</h1>
  <h1 class="text-white">GYM</h1>
</div> <hr>
  
<div>
  <h3>Síguenos</h3> <br>
  <a href="https://www.instagram.com/lifegympasto/" target="_blank">
    <i class="fab fa-instagram"></i>
  </a> 

  <a href="https://www.facebook.com/profile.php?id=61558048774333" target="_blank">
    <i class="fab fa-facebook-f"></i>
  </a>

  <a href="https://www.tiktok.com/@life_gym_pasto" target="_blank">
    <i class="fab fa-tiktok"></i>
  </a> 

</div> <br> <hr>
<!--horario-->
<div class="horario">
  <h3>Horario de Atención</h3>
  <ul>
    <ol><strong>Lunes a viernes:</strong> 5:00 a.m. - 10:00 p.m. (Jornada continua)</ol>
    <ol><strong>Sábados:</strong> 7:00 a.m. - 7:00 p.m.</ol>
    <ol><strong>Domingos y festivos:</strong> 8:00 a.m. - 12:00 p.m.</ol>
  </ul> <br>
</div>


    
    <footer>
        <p>&copy; 2024 Life Gym. Todos los derechos reservados.</p>
    </footer>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
      <script src="index.js"></script>
</body>
</html>
