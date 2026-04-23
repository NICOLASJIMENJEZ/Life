<?php
// admin/dashboard.php
session_start();
// Simulación de login para pruebas
$admin_email = "nicolasestebanjimenezguzman@gmail.com";
$pass_master = "903135";

// Aquí procesaríamos la lógica de "Publicar"
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['clase_nombre'])) {
    // En producción esto iría a la base de datos
    $_SESSION['ultima_clase'] = [
        'nombre' => $_POST['clase_nombre'],
        'fecha' => $_POST['fecha'],
        'hora' => $_POST['hora'],
        'estado' => 'activo'
    ];
}
?>
<main class="col-md-10 p-5">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h2 class="outfit fw-black">MASTER ADMIN</h2>
            <p class="text-muted">Gestión Centralizada: Nicolas Esteban Jimenez Guzman</p>
        </div>
        <div class="text-end">
            <span class="badge bg-success border-0 p-2 px-3">SERVIDOR ACTIVO</span>
            <p class="small mt-2 text-white-50">Modo: Full Stack Developer</p>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="stat-card text-center border-brand-glow">
                <i class="fas fa-user-check mb-3 text-brand fs-4"></i>
                <small class="d-block text-muted">USUARIOS TOTALES</small>
                <h2 class="fw-bold">128</h2>
            </div>
        </div>
        </div>

    <div class="stat-card mb-5" style="border-left: 5px solid var(--brand)">
        <h5><i class="fas fa-robot me-2 text-brand"></i> Consultar a Gemini (Asistente Técnico)</h5>
        <div class="input-group mt-3">
            <input type="text" id="ai-query" class="form-control form-control-custom" placeholder="Pregunta sobre logística de clases o código...">
            <button class="btn btn-brand" onclick="askGemini()">CONSULTAR</button>
        </div>
        <div id="ai-response" class="mt-3 small text-white-50"></div>
    </div>
</main>
