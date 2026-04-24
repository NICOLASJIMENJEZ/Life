<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>GymCore - Dashboard</title>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,400&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box;}
:root{
  --bg:#0a0a0a;--bg2:#111111;--bg3:#181818;--bg4:#222222;
  --accent:#e8ff00;--accent2:#ff4d00;
  --text:#f0f0f0;--muted:#777;--border:#252525;
  --green:#00c47d;--red:#ff4d4d;--blue:#4da6ff;--purple:#a78bfa;
}
body{background:var(--bg);color:var(--text);font-family:'DM Sans',sans-serif;min-height:100vh;overflow:hidden;}
 
/* ── NAV ── */
.nav{
  display:flex;align-items:center;justify-content:space-between;
  padding:0 24px;height:56px;
  background:var(--bg2);border-bottom:1px solid var(--border);
}
.nav-logo{font-family:'Bebas Neue',sans-serif;font-size:26px;letter-spacing:3px;color:var(--accent);}
.nav-logo span{color:var(--accent2);}
.nav-tabs{display:flex;gap:4px;}
.tab-btn{
  padding:7px 18px;border:none;border-radius:8px;
  cursor:pointer;font-size:13px;font-weight:500;font-family:'DM Sans',sans-serif;
  background:transparent;color:var(--muted);transition:all .2s;
}
.tab-btn.active{background:var(--accent);color:#000;}
.tab-btn:hover:not(.active){background:var(--bg3);color:var(--text);}
 
/* ── PANELS ── */
.panel{display:none;height:calc(100vh - 56px);overflow-y:auto;overflow-x:hidden;}
.panel.active{display:block;}
 
/* ────────────────────────────────
   ADMIN PANEL
──────────────────────────────── */
.admin-wrap{padding:22px 24px;display:flex;flex-direction:column;gap:18px;}
 
/* Stats */
.stats-row{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;}
.stat-card{
  background:var(--bg2);border:1px solid var(--border);border-radius:14px;
  padding:18px 16px;position:relative;overflow:hidden;
}
.stat-card::before{content:'';position:absolute;top:0;left:0;right:0;height:3px;border-radius:14px 14px 0 0;}
.s1::before{background:var(--accent);}
.s2::before{background:var(--green);}
.s3::before{background:var(--blue);}
.s4::before{background:var(--accent2);}
.stat-label{font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:1px;margin-bottom:8px;}
.stat-val{font-family:'Bebas Neue',sans-serif;font-size:36px;line-height:1;}
.s1 .stat-val{color:var(--accent);}
.s2 .stat-val{color:var(--green);}
.s3 .stat-val{color:var(--blue);}
.s4 .stat-val{color:var(--accent2);}
.stat-sub{font-size:11px;color:var(--muted);margin-top:6px;}
.stat-sub.up{color:var(--green);}
 
/* Two col */
.two-col{display:grid;grid-template-columns:1.4fr 1fr;gap:16px;}
 
/* Card base */
.card{background:var(--bg2);border:1px solid var(--border);border-radius:14px;overflow:hidden;}
.card-head{
  padding:14px 18px;border-bottom:1px solid var(--border);
  display:flex;align-items:center;justify-content:space-between;
}
.card-title{font-size:13px;font-weight:500;letter-spacing:.3px;}
.badge{padding:3px 10px;border-radius:20px;font-size:11px;font-weight:500;}
.bg-green{background:rgba(0,196,125,.12);color:var(--green);}
.bg-yellow{background:rgba(232,255,0,.1);color:#c8dd00;}
.bg-blue{background:rgba(77,166,255,.12);color:var(--blue);}
.bg-red{background:rgba(255,77,77,.12);color:var(--red);}
 
/* Users table */
.utbl{width:100%;border-collapse:collapse;}
.utbl th{
  font-size:11px;color:var(--muted);text-transform:uppercase;
  letter-spacing:.8px;padding:10px 18px;text-align:left;
  border-bottom:1px solid var(--border);
}
.utbl td{font-size:13px;padding:11px 18px;border-bottom:1px solid rgba(255,255,255,.03);}
.utbl tr:last-child td{border:none;}
.utbl tr:hover td{background:rgba(255,255,255,.015);}
.av{
  width:30px;height:30px;border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  font-size:11px;font-weight:500;flex-shrink:0;
}
.av-y{background:rgba(232,255,0,.15);color:var(--accent);}
.av-b{background:rgba(77,166,255,.15);color:var(--blue);}
.av-g{background:rgba(0,196,125,.15);color:var(--green);}
.av-p{background:rgba(167,139,250,.15);color:var(--purple);}
 
/* Plan bars */
.plan-row{padding:13px 18px;border-bottom:1px solid rgba(255,255,255,.03);}
.plan-row:last-child{border:none;}
.plan-top{display:flex;justify-content:space-between;align-items:center;margin-bottom:7px;}
.plan-name{font-size:13px;font-weight:500;}
.plan-price{font-size:13px;color:var(--accent);font-weight:500;}
.bar-track{height:4px;background:var(--bg3);border-radius:2px;}
.bar-fill{height:4px;border-radius:2px;transition:width .4s ease;}
.plan-meta{display:flex;justify-content:space-between;font-size:11px;color:var(--muted);margin-top:5px;}
 
/* ────────────────────────────────
   USER PANEL
──────────────────────────────── */
.user-hero{
  background:var(--bg2);border-bottom:1px solid var(--border);
  padding:20px 24px;display:flex;align-items:center;gap:16px;
}
.hero-av{
  width:54px;height:54px;border-radius:50%;
  background:var(--accent);color:#000;
  font-family:'Bebas Neue',sans-serif;font-size:22px;
  display:flex;align-items:center;justify-content:center;flex-shrink:0;
}
.hero-name{font-family:'Bebas Neue',sans-serif;font-size:26px;letter-spacing:1px;}
.hero-plan{font-size:12px;color:var(--muted);margin-top:3px;}
.hero-plan em{color:var(--accent);font-style:normal;font-weight:500;}
.hero-actions{margin-left:auto;display:flex;gap:8px;}
 
.user-body{padding:18px 24px;display:grid;grid-template-columns:1fr 1fr;gap:16px;}
 
/* Class cards */
.section-label{font-size:11px;text-transform:uppercase;letter-spacing:1px;color:var(--muted);margin-bottom:10px;}
.classes-grid{display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-bottom:4px;}
.class-card{
  background:var(--bg3);border:1px solid var(--border);border-radius:10px;
  padding:13px;cursor:pointer;transition:all .2s;position:relative;overflow:hidden;
}
.class-card::after{
  content:'';position:absolute;bottom:0;left:0;right:0;height:2px;
  background:var(--accent);transform:scaleX(0);transition:.25s;
}
.class-card:hover{border-color:rgba(232,255,0,.3);background:rgba(232,255,0,.03);}
.class-card:hover::after{transform:scaleX(1);}
.class-emoji{font-size:20px;margin-bottom:6px;display:block;}
.class-name{font-size:12px;font-weight:500;}
.class-sched{font-size:11px;color:var(--muted);margin-top:3px;}
.class-badge{display:inline-block;margin-top:6px;font-size:10px;padding:2px 7px;border-radius:10px;}
 
/* Coach */
.coach-box{background:var(--bg2);border:1px solid var(--border);border-radius:12px;padding:16px;}
.coach-top{display:flex;align-items:center;gap:12px;margin-bottom:12px;}
.coach-av{
  width:46px;height:46px;border-radius:50%;flex-shrink:0;
  background:linear-gradient(135deg,var(--accent),var(--accent2));
  display:flex;align-items:center;justify-content:center;
  font-weight:500;color:#000;font-size:15px;
}
.coach-name-lbl{font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.8px;}
.coach-name{font-size:15px;font-weight:500;margin-top:2px;}
.coach-role{font-size:11px;color:var(--accent);margin-top:1px;}
.coach-bio{font-size:12px;color:var(--muted);line-height:1.7;border-top:1px solid var(--border);padding-top:10px;}
.coach-stats{display:grid;grid-template-columns:1fr 1fr 1fr;gap:8px;margin-top:12px;}
.cstat{text-align:center;background:var(--bg3);border-radius:8px;padding:8px;}
.cstat-val{font-size:16px;font-weight:500;color:var(--accent);}
.cstat-lbl{font-size:10px;color:var(--muted);margin-top:1px;}
 
/* Quick actions col */
.right-col{display:flex;flex-direction:column;gap:12px;}
 
/* WA */
.wa-btn{
  display:flex;align-items:center;gap:10px;
  padding:14px 16px;background:#25D366;border-radius:10px;
  cursor:pointer;border:none;color:#fff;
  font-size:13px;font-weight:500;font-family:'DM Sans',sans-serif;
  width:100%;transition:.2s;text-decoration:none;
}
.wa-btn:hover{background:#20bd5a;}
.wa-icon{width:22px;height:22px;flex-shrink:0;}
.wa-text{text-align:left;}
.wa-label{font-size:13px;font-weight:500;}
.wa-sub{font-size:11px;opacity:.8;margin-top:1px;}
 
/* Chat */
.chat-box{
  background:var(--bg2);border:1px solid var(--border);border-radius:12px;
  overflow:hidden;display:flex;flex-direction:column;flex:1;min-height:240px;
}
.chat-head{
  padding:11px 14px;border-bottom:1px solid var(--border);
  display:flex;align-items:center;gap:8px;
}
.chat-dot{width:7px;height:7px;border-radius:50%;background:var(--green);animation:pulse 2s infinite;}
@keyframes pulse{0%,100%{opacity:1;}50%{opacity:.35;}}
.chat-hname{font-size:12px;font-weight:500;}
.chat-hstatus{font-size:10px;color:var(--green);}
.chat-msgs{flex:1;overflow-y:auto;padding:12px;display:flex;flex-direction:column;gap:8px;}
.msg{max-width:82%;padding:8px 11px;border-radius:10px;font-size:12px;line-height:1.55;}
.bot-msg{background:var(--bg3);color:var(--text);align-self:flex-start;border-bottom-left-radius:2px;}
.usr-msg{background:var(--accent);color:#000;align-self:flex-end;border-bottom-right-radius:2px;font-weight:500;}
.typing-dot{display:inline-block;width:5px;height:5px;border-radius:50%;background:var(--muted);margin:0 2px;animation:bounce .8s infinite;}
.typing-dot:nth-child(2){animation-delay:.15s;}
.typing-dot:nth-child(3){animation-delay:.3s;}
@keyframes bounce{0%,80%,100%{transform:translateY(0);}40%{transform:translateY(-5px);}}
.chat-form{padding:8px;border-top:1px solid var(--border);display:flex;gap:6px;}
.chat-input{
  flex:1;background:var(--bg3);border:1px solid var(--border);
  border-radius:8px;padding:8px 12px;
  color:var(--text);font-size:12px;font-family:'DM Sans',sans-serif;outline:none;
}
.chat-input:focus{border-color:rgba(232,255,0,.4);}
.chat-send{
  padding:8px 13px;background:var(--accent);color:#000;
  border:none;border-radius:8px;cursor:pointer;
  font-size:12px;font-weight:500;font-family:'DM Sans',sans-serif;
  transition:.15s;flex-shrink:0;
}
.chat-send:hover{background:#d4e800;}
.chat-send:disabled{opacity:.5;cursor:not-allowed;}
 
/* Scrollbar */
::-webkit-scrollbar{width:4px;}
::-webkit-scrollbar-track{background:transparent;}
::-webkit-scrollbar-thumb{background:var(--border);border-radius:2px;}
</style>
</head>
<body>
 
<!-- NAV -->
<div class="nav">
  <div class="nav-logo">GYM<span>CORE</span></div>
  <div class="nav-tabs">
    <button class="tab-btn active" onclick="showPanel('admin')">Panel Admin</button>
    <button class="tab-btn" onclick="showPanel('usuario')">Mi Espacio</button>
  </div>
</div>
 
<!-- ═══════════ ADMIN PANEL ═══════════ -->
<div id="panel-admin" class="panel active">
  <div class="admin-wrap">
 
    <!-- Stats -->
    <div class="stats-row">
      <div class="stat-card s1">
        <div class="stat-label">Usuarios totales</div>
        <div class="stat-val">2</div>
        <div class="stat-sub up">↑ Activos este mes</div>
      </div>
      <div class="stat-card s2">
        <div class="stat-label">Ingresos / mes</div>
        <div class="stat-val">$80K</div>
        <div class="stat-sub up">Plan Pro activo</div>
      </div>
      <div class="stat-card s3">
        <div class="stat-label">Clases activas</div>
        <div class="stat-val">0</div>
        <div class="stat-sub">Sin clases aún</div>
      </div>
      <div class="stat-card s4">
        <div class="stat-label">Mensajes hoy</div>
        <div class="stat-val">0</div>
        <div class="stat-sub">Sin mensajes</div>
      </div>
    </div>
 
    <!-- Two col -->
    <div class="two-col">
 
      <!-- Usuarios -->
      <div class="card">
        <div class="card-head">
          <span class="card-title">Usuarios registrados</span>
          <span class="badge bg-green">2 activos</span>
        </div>
        <table class="utbl">
          <thead>
            <tr>
              <th>Usuario</th>
              <th>Email</th>
              <th>Identificación</th>
              <th>Registro</th>
              <th>Estado</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <div style="display:flex;align-items:center;gap:9px;">
                  <div class="av av-y">NG</div>
                  <span>Nicolas GuzmN</span>
                </div>
              </td>
              <td style="color:var(--muted);font-size:12px;">nicolasjimenezguzman1@gmail.com</td>
              <td style="color:var(--muted);font-size:12px;">1193228149</td>
              <td style="color:var(--muted);font-size:12px;">22 Abr 2026</td>
              <td><span class="badge bg-green">Activo</span></td>
            </tr>
            <tr>
              <td>
                <div style="display:flex;align-items:center;gap:9px;">
                  <div class="av av-b">NJ</div>
                  <span>Nicolas Jimenez</span>
                </div>
              </td>
              <td style="color:var(--muted);font-size:12px;">nicoezguzman1@gmail.com</td>
              <td style="color:var(--muted);font-size:12px;">15651561541541</td>
              <td style="color:var(--muted);font-size:12px;">22 Abr 2026</td>
              <td><span class="badge bg-green">Activo</span></td>
            </tr>
          </tbody>
        </table>
      </div>
 
      <!-- Planes -->
      <div class="card">
        <div class="card-head">
          <span class="card-title">Planes disponibles</span>
          <span class="badge bg-yellow">3 planes</span>
        </div>
        <div class="plan-row">
          <div class="plan-top">
            <span class="plan-name">Plan Básico</span>
            <span class="plan-price">$50.000/mes</span>
          </div>
          <div class="bar-track"><div class="bar-fill" style="width:33%;background:var(--muted);"></div></div>
          <div class="plan-meta"><span>Lunes a Viernes</span><span>30 días</span></div>
        </div>
        <div class="plan-row">
          <div class="plan-top">
            <span class="plan-name">Plan Pro</span>
            <span class="plan-price">$80.000/mes</span>
          </div>
          <div class="bar-track"><div class="bar-fill" style="width:53%;background:var(--blue);"></div></div>
          <div class="plan-meta"><span>Acceso completo + clases grupales</span><span>30 días</span></div>
        </div>
        <div class="plan-row">
          <div class="plan-top">
            <span class="plan-name">Plan Elite</span>
            <span class="plan-price">$150.000/mes</span>
          </div>
          <div class="bar-track"><div class="bar-fill" style="width:100%;background:var(--accent);"></div></div>
          <div class="plan-meta"><span>Acceso ilimitado + entrenador personal</span><span>30 días</span></div>
        </div>
      </div>
 
    </div>
  </div>
</div>
 
<!-- ═══════════ USER PANEL ═══════════ -->
<div id="panel-usuario" class="panel">
 
  <!-- Hero -->
  <div class="user-hero">
    <div class="hero-av">NG</div>
    <div>
      <div class="hero-name">Nicolas GuzmN</div>
      <div class="hero-plan">Plan activo: <em>Plan Pro</em> &nbsp;·&nbsp; Vence: 22 May 2026</div>
    </div>
  </div>
 
  <!-- Body -->
  <div class="user-body">
 
    <!-- Left col -->
    <div>
      <div class="section-label">Mis clases</div>
      <div class="classes-grid">
        <div class="class-card">
          <span class="class-emoji">🏋️</span>
          <div class="class-name">Musculación</div>
          <div class="class-sched">Lun · Mié · Vie</div>
          <div class="class-badge bg-green">Incluida</div>
        </div>
        <div class="class-card">
          <span class="class-emoji">🤸</span>
          <div class="class-name">Crossfit</div>
          <div class="class-sched">Mar · Jue</div>
          <div class="class-badge bg-green">Incluida</div>
        </div>
        <div class="class-card">
          <span class="class-emoji">🧘</span>
          <div class="class-name">Yoga / Stretch</div>
          <div class="class-sched">Sábados 8am</div>
          <div class="class-badge bg-blue">Opcional</div>
        </div>
        <div class="class-card">
          <span class="class-emoji">🚴</span>
          <div class="class-name">Spinning</div>
          <div class="class-sched">Lun · Mié 7am</div>
          <div class="class-badge bg-blue">Opcional</div>
        </div>
      </div>
 
      <!-- Coach -->
      <div style="margin-top:14px;">
        <div class="section-label">Tu entrenador</div>
        <div class="coach-box">
          <div class="coach-top">
            <div class="coach-av">JR</div>
            <div>
              <div class="coach-name-lbl">Entrenador principal</div>
              <div class="coach-name">Jorge Ramírez</div>
              <div class="coach-role">Certificado ISSA · Nutrición deportiva</div>
            </div>
          </div>
          <div class="coach-bio">
            Especialista en hipertrofia y rendimiento funcional con más de 8 años de experiencia. 
            Trabaja con metodología progresiva adaptada a cada usuario, combinando fuerza, movilidad y nutrición.
          </div>
          <div class="coach-stats">
            <div class="cstat"><div class="cstat-val">8+</div><div class="cstat-lbl">Años exp.</div></div>
            <div class="cstat"><div class="cstat-val">120</div><div class="cstat-lbl">Alumnos</div></div>
            <div class="cstat"><div class="cstat-val">4.9</div><div class="cstat-lbl">Rating</div></div>
          </div>
        </div>
      </div>
    </div>
 
    <!-- Right col -->
    <div class="right-col">
 
      <!-- WA -->
      <div>
        <div class="section-label">Contacto rápido</div>
        <a class="wa-btn" href="https://wa.me/573168771073?text=Hola!%20Quiero%20información%20sobre%20el%20gimnasio" target="_blank">
          <svg class="wa-icon" viewBox="0 0 24 24" fill="white">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
          </svg>
          <div class="wa-text">
            <div class="wa-label">Contactar por WhatsApp</div>
            <div class="wa-sub">3168771073 · Respuesta inmediata</div>
          </div>
        </a>
      </div>
 
      <!-- Chat IA -->
      <div style="flex:1;display:flex;flex-direction:column;">
        <div class="section-label">Asistente del gimnasio</div>
        <div class="chat-box" style="flex:1;">
          <div class="chat-head">
            <div class="chat-dot"></div>
            <div>
              <div class="chat-hname">GymBot IA</div>
              <div class="chat-hstatus">En línea</div>
            </div>
          </div>
          <div class="chat-msgs" id="chatMsgs">
            <div class="msg bot-msg">¡Hola Nicolas! 👋 Soy el asistente de GymCore. Puedo responderte sobre horarios, planes, rutinas o lo que necesites del gimnasio.</div>
          </div>
          <div class="chat-form">
            <input class="chat-input" id="chatInput" type="text" placeholder="Pregunta algo..." onkeydown="if(event.key==='Enter')sendChat()"/>
            <button class="chat-send" id="chatSendBtn" onclick="sendChat()">Enviar</button>
          </div>
        </div>
      </div>
 
    </div>
  </div>
</div>
 
<script>
// ── Panel switch ──
function showPanel(name) {
  document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
  document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
  document.getElementById('panel-' + name).classList.add('active');
  event.currentTarget.classList.add('active');
}
 
// ── Chat IA (Claude API) ──
const SYSTEM_PROMPT = `Eres GymBot, el asistente virtual de GymCore, un gimnasio moderno.
Responde SIEMPRE en español, de forma amigable, breve y directa (máximo 3 oraciones).
Información del gimnasio:
- Planes: Básico ($50.000/mes, lunes a viernes), Pro ($80.000/mes, acceso completo + clases grupales), Elite ($150.000/mes, acceso ilimitado + entrenador personal).
- Entrenador principal: Jorge Ramírez, certificado ISSA, especialista en hipertrofia.
- Clases: Musculación, Crossfit, Yoga/Stretch, Spinning.
- Contacto WhatsApp: 3168771073.
- Horario general: Lunes a sábado 5am - 10pm, domingos 7am - 2pm.
Si no sabes algo, sugiere contactar por WhatsApp al 3168771073.`;
 
const chatHistory = [];
 
async function sendChat() {
  const input = document.getElementById('chatInput');
  const btn = document.getElementById('chatSendBtn');
  const msgs = document.getElementById('chatMsgs');
  const text = input.value.trim();
  if (!text) return;
 
  // User message
  input.value = '';
  btn.disabled = true;
  appendMsg(text, 'usr-msg');
  chatHistory.push({ role: 'user', content: text });
 
  // Typing indicator
  const typingId = 'typing-' + Date.now();
  msgs.innerHTML += `<div class="msg bot-msg" id="${typingId}">
    <span class="typing-dot"></span><span class="typing-dot"></span><span class="typing-dot"></span>
  </div>`;
  msgs.scrollTop = msgs.scrollHeight;
 
  try {
    const res = await fetch('https://api.anthropic.com/v1/messages', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        model: 'claude-sonnet-4-20250514',
        max_tokens: 1000,
        system: SYSTEM_PROMPT,
        messages: chatHistory
      })
    });
    const data = await res.json();
    const reply = data.content?.map(b => b.text || '').join('') || 'No pude responder en este momento.';
    chatHistory.push({ role: 'assistant', content: reply });
 
    document.getElementById(typingId)?.remove();
    appendMsg(reply, 'bot-msg');
  } catch(e) {
    document.getElementById(typingId)?.remove();
    appendMsg('Error de conexión. Por favor intenta de nuevo.', 'bot-msg');
  }
 
  btn.disabled = false;
  msgs.scrollTop = msgs.scrollHeight;
}
 
function appendMsg(text, cls) {
  const msgs = document.getElementById('chatMsgs');
  const div = document.createElement('div');
  div.className = 'msg ' + cls;
  div.textContent = text;
  msgs.appendChild(div);
  msgs.scrollTop = msgs.scrollHeight;
}
</script>
</body>
</html>
