<?php
session_start();
if (!isset($_SESSION['rol_id']) || $_SESSION['rol_id'] != 2) {
    header("Location: login.php"); // Redirige si no es el admin
    exit();
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard | Life Gym</title>
  <link rel="stylesheet" href="style.css">


  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Íconos Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  
  
</head>
<body>

  <!-- Navbar superior -->
<nav class="navbar navbar-dark">
  <div class="container-fluid">
    <span class="navbar-brand mb-0 h1">Life Gym - Panel de Administrador</span>
    <a href="logout.php" class="btn btn-danger">Cerrar sesión</a>
  </div>
</nav>


  <div class="container-fluid">
    <div class="row">
      
      <!-- Barra lateral -->
      <div class="col-md-2 sidebar">
        <a href="#"><i class="bi bi-house"></i> Inicio</a>
        <a href="#"><i class="bi bi-chat-left-text"></i> Contactos</a>
        <a href="#"><i class="bi bi-bar-chart"></i> Reportes</a>
        <a href="clases.php"><i class="bi bi-gear"></i> Clases</a>
      </div>
      
      <!-- Contenido principal -->
      <div class="col-md-10 content">
        <h2>Bienvenido, Administrador</h2>
        <p>Desde este panel puedes gestionar usuarios, revisar contactos, ver reportes y más.</p>

        <div class="row mt-4">
          <div class="col-md-4">
            <div class="card bg-dark text-white shadow">
              <div class="card-body">
                <h5 class="card-title"><a href="usuarios.php"><i class="bi bi-person-fill"></i> Total Usuarios</a></h5>
                <p class="card-text" id="totalUsuarios">--</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card bg-dark text-white shadow">
              <div class="card-body">
                <h5 class="card-title"><a href="mensajes.php"><i class="bi bi-envelope-fill"></i> Mensajes Recibidos</a></h5>
                <p class="card-text" id="totalContactos">--</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card bg-dark text-white shadow">
              <div class="card-body">
                <h5 class="card-title"><a href="reportes.php"><i class="bi bi-graph-up-arrow"></i> Actividad</a></h5>
                <p class="card-text">Estadísticas recientes</p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Script cierre de sesión -->
  <script>
    document.getElementById('logoutBtn').addEventListener('click', function () {
      window.location.href = 'logout.php';
    });
  </script>

</body>
</html>