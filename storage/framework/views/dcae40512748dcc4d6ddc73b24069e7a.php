<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $__env->yieldContent('title', 'Omma Health Center'); ?></title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
/* ============ TOKENS (from Omma Health Center design) ============ */
:root{
  --navy:#0b2545;
  --blue-900:#0e3a72;
  --blue-700:#1668dc;
  --blue-600:#2b7bf2;
  --blue-400:#7cb3ff;
  --blue-200:#c7e0ff;
  --blue-100:#eaf3ff;
  --blue-50:#f5f9ff;
  --white:#ffffff;
  --ink:#0b2545;
  --ink-soft:#4a5c7a;
  --ok:#1a9e6b;
  --warn:#e0562f;
  --ring: 0 0 0 3px rgba(22,104,220,0.28);
  --radius: 14px;
  --shadow: 0 10px 30px rgba(11,37,69,0.10);
  --shadow-lg: 0 20px 50px rgba(11,37,69,0.16);
  --font-display: 'Space Grotesk', 'Inter', sans-serif;
  --font-body: 'Inter', sans-serif;
}
*{box-sizing:border-box;}
html{scroll-behavior:smooth;}
body{margin:0; font-family:var(--font-body); color:var(--ink); background:var(--white); -webkit-font-smoothing:antialiased;}
h1,h2,h3,h4{font-family:var(--font-display); margin:0 0 .4em 0; color:var(--navy); letter-spacing:-0.01em;}
p{line-height:1.6; color:var(--ink-soft); margin:0 0 1em 0;}
a{color:inherit;}
button{font-family:var(--font-body); cursor:pointer;}
:focus-visible{outline:3px solid var(--blue-600); outline-offset:2px;}
.container{max-width:1120px; margin:0 auto; padding:0 24px;}

/* ============ TOPBAR ============ */
.topbar{position:sticky; top:0; z-index:50; background:rgba(255,255,255,0.92); backdrop-filter:blur(10px); border-bottom:1px solid var(--blue-100);}
.topbar-inner{display:flex; align-items:center; justify-content:space-between; padding:14px 24px; max-width:1120px; margin:0 auto; gap:16px; flex-wrap:wrap;}
.brand{display:flex; align-items:center; gap:10px; font-family:var(--font-display); font-weight:700; font-size:1.25rem; color:var(--navy); text-decoration:none;}
.brand .iris{width:34px; height:34px; flex:0 0 auto;}
nav.mainnav{display:flex; gap:4px; flex-wrap:wrap;}
nav.mainnav a, nav.mainnav button{background:transparent; border:none; padding:9px 14px; border-radius:999px; font-weight:600; font-size:0.88rem; color:var(--blue-900); text-decoration:none; display:inline-block;}
nav.mainnav a:hover, nav.mainnav button:hover{background:var(--blue-100);}
nav.mainnav a.active{background:var(--blue-700); color:#fff;}
.patient-chip{font-size:0.78rem; background:var(--blue-50); border:1px solid var(--blue-200); padding:6px 12px; border-radius:999px; color:var(--blue-900); font-weight:600; display:flex; align-items:center; gap:8px;}
.patient-chip form button{background:transparent; border:none; color:var(--blue-700); font-weight:700; cursor:pointer; padding:0; font-size:0.78rem;}

/* ============ SECTIONS ============ */
section.view{padding:56px 0 80px;}
section.view.compact{padding-top:36px;}

/* ============ HERO ============ */
.hero{
  background:
    radial-gradient(circle at 85% -10%, var(--blue-200) 0%, transparent 45%),
    linear-gradient(180deg, var(--blue-50) 0%, #ffffff 70%);
  padding:64px 0 40px;
  border-bottom:1px solid var(--blue-100);
}
.hero-grid{display:grid; grid-template-columns:1.1fr 0.9fr; gap:48px; align-items:center;}
.eyebrow{display:inline-flex; align-items:center; gap:8px; font-size:0.75rem; font-weight:700; letter-spacing:.08em; text-transform:uppercase; color:var(--blue-700); background:var(--blue-100); padding:6px 12px; border-radius:999px; margin-bottom:16px;}
.hero h1{font-size:2.6rem; line-height:1.08; margin-bottom:16px;}
.hero p.lead{font-size:1.08rem; max-width:46ch;}
.cta-row{display:flex; gap:12px; margin-top:22px; flex-wrap:wrap;}
.btn{border:none; padding:13px 22px; border-radius:10px; font-weight:600; font-size:0.95rem; transition:transform .15s ease, box-shadow .15s ease, background .15s ease; display:inline-block; text-decoration:none;}
.btn-primary{background:var(--blue-700); color:#fff; box-shadow:0 8px 20px rgba(22,104,220,0.28);}
.btn-primary:hover{background:var(--navy); transform:translateY(-1px);}
.btn-outline{background:#fff; color:var(--blue-700); border:1.5px solid var(--blue-200);}
.btn-outline:hover{border-color:var(--blue-700); background:var(--blue-50);}
.btn-ghost{background:transparent; color:var(--blue-700); padding:10px 6px;}
.btn-ghost:hover{text-decoration:underline;}
.btn-sm{padding:8px 14px; font-size:0.85rem; border-radius:8px;}
.btn-block{width:100%; text-align:center;}

.hero-visual{position:relative; display:flex; align-items:center; justify-content:center;}
.snellen-card{background:var(--navy); color:#fff; border-radius:20px; padding:30px 26px; box-shadow:var(--shadow-lg); width:100%; max-width:360px;}
.snellen-card .row{font-family:var(--font-display); text-align:center; letter-spacing:0.2em; color:#eaf3ff;}
.snellen-card .row:nth-child(1){font-size:2.6rem; margin-bottom:14px;}
.snellen-card .row:nth-child(2){font-size:2.0rem; margin-bottom:12px; opacity:.9;}
.snellen-card .row:nth-child(3){font-size:1.5rem; margin-bottom:10px; opacity:.8;}
.snellen-card .row:nth-child(4){font-size:1.05rem; margin-bottom:8px; opacity:.65;}
.snellen-card .row:nth-child(5){font-size:0.75rem; opacity:.5;}
.snellen-caption{text-align:center; font-size:.72rem; color:#9fc6ff; margin-top:16px; letter-spacing:.05em;}

/* service cards */
.services{display:grid; grid-template-columns:repeat(4,1fr); gap:18px; margin-top:48px;}
.svc-card{background:#fff; border:1px solid var(--blue-100); border-radius:var(--radius); padding:24px 20px; box-shadow:var(--shadow); transition:transform .15s ease, box-shadow .15s ease; text-align:left;}
.svc-card:hover{transform:translateY(-4px); box-shadow:var(--shadow-lg);}
.svc-card .ico{width:44px; height:44px; border-radius:10px; background:var(--blue-100); display:flex; align-items:center; justify-content:center; margin-bottom:14px;}
.svc-card h3{font-size:1.05rem; margin-bottom:6px;}
.svc-card p{font-size:0.88rem; margin-bottom:14px;}

/* ============ FORM ELEMENTS / AUTH PANELS ============ */
.auth-wrap{max-width:440px; margin:0 auto;}
.panel{background:#fff; border:1px solid var(--blue-100); border-radius:var(--radius); box-shadow:var(--shadow); padding:32px;}
.field{margin-bottom:18px;}
.field label{display:block; font-weight:600; font-size:0.85rem; margin-bottom:6px; color:var(--navy);}
.field input, .field select, .field textarea{width:100%; padding:11px 13px; border-radius:9px; border:1.5px solid var(--blue-200); font-size:0.95rem; font-family:var(--font-body); color:var(--ink); background:#fff;}
.field input:focus, .field select:focus, .field textarea:focus{border-color:var(--blue-600); box-shadow:var(--ring); outline:none;}
.field input.is-invalid{border-color:var(--warn);}
.field .error{color:var(--warn); font-weight:600; font-size:0.78rem; margin-top:6px;}
.field-check{display:flex; align-items:center; gap:8px; font-size:0.85rem; color:var(--ink-soft); margin-bottom:18px;}
.field-check input{width:auto;}
.section-title{display:flex; align-items:baseline; justify-content:space-between; margin-bottom:28px; flex-wrap:wrap; gap:10px;}
.section-title .tag{font-size:0.75rem; font-weight:700; color:var(--blue-700); text-transform:uppercase; letter-spacing:.07em; background:var(--blue-100); padding:5px 10px; border-radius:999px;}
.auth-foot{text-align:center; font-size:0.85rem; color:var(--ink-soft); margin-top:18px;}
.auth-foot a{color:var(--blue-700); font-weight:600; text-decoration:none;}
.auth-foot a:hover{text-decoration:underline;}

.result-box{border-radius:12px; padding:16px 18px; margin-bottom:18px; border:1.5px solid var(--blue-200); background:var(--blue-50);}
.result-box.good{border-color:#bfe8d6; background:#f1fbf6;}
.result-box.warn{border-color:#f6cdb9; background:#fdf3ee;}
.result-box p{margin:0; color:var(--ink);}
.result-box ul{margin:0; padding-left:18px; color:var(--ink);}

footer{background:var(--navy); color:#c7e0ff; padding:34px 0; margin-top:40px;}
footer .container{display:flex; justify-content:space-between; flex-wrap:wrap; gap:12px; font-size:0.85rem;}
footer a{color:#fff; text-decoration:none;}

@media (max-width:880px){
  .hero-grid{grid-template-columns:1fr;}
  .services{grid-template-columns:repeat(2,1fr);}
  nav.mainnav{display:none;}
  nav.mainnav.open{display:flex; flex-direction:column; position:absolute; top:64px; left:0; right:0; background:#fff; padding:12px; box-shadow:var(--shadow-lg); border-radius:0 0 14px 14px;}
  .menu-toggle{display:block !important;}
}
.menu-toggle{display:none; background:var(--blue-100); border:none; padding:10px 12px; border-radius:9px; font-size:1.1rem;}

/* ============ BOOK NOW HERO (dashboard) ============ */
.book-cta{
  background: radial-gradient(circle at 92% -20%, var(--blue-700) 0%, var(--navy) 65%);
  border-radius: 18px; padding: 30px 32px; margin-bottom: 40px;
  display:flex; align-items:center; justify-content:space-between; gap:20px; flex-wrap:wrap;
  box-shadow: var(--shadow-lg);
}
.book-cta .eyebrow{background:rgba(255,255,255,0.14); color:#eaf3ff;}
.book-cta h2{color:#fff; font-size:1.4rem; margin:0;}
.book-cta .btn-primary{background:#fff; color:var(--blue-900); box-shadow:none;}
.book-cta .btn-primary:hover{background:var(--blue-50); transform:translateY(-1px);}

/* ============ APPOINTMENT LIST ============ */
.appt-list{display:flex; flex-direction:column; gap:12px;}
.appt-card{
  background:#fff; border:1px solid var(--blue-100); border-radius:var(--radius);
  padding:16px 20px; display:flex; align-items:center; justify-content:space-between; gap:14px; flex-wrap:wrap;
}
.appt-left{display:flex; align-items:flex-start; gap:14px;}
.appt-ico{width:42px; height:42px; border-radius:10px; background:var(--blue-100); display:flex; align-items:center; justify-content:center; font-size:1.1rem; flex:0 0 auto;}
.appt-left h4{margin:0 0 3px 0; font-size:0.98rem; color:var(--navy);}
.appt-left span.when{font-size:0.84rem; color:var(--ink-soft);}
.empty-state{border:1.5px dashed var(--blue-200); border-radius:var(--radius); padding:26px; text-align:center; color:var(--ink-soft); font-size:0.9rem;}

/* ============ BOOKING STEPS ============ */
.step-nav{display:flex; gap:22px; flex-wrap:wrap; margin-bottom:30px;}
.step-nav .step{display:flex; align-items:center; gap:8px; font-size:0.85rem; font-weight:600; color:var(--ink-soft);}
.step-num{width:22px; height:22px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:0.72rem; font-weight:700; background:var(--blue-100); color:var(--blue-700); flex:0 0 auto;}
.step-label{display:block; font-size:0.72rem; font-weight:700; letter-spacing:.06em; text-transform:uppercase; color:var(--blue-700); margin:28px 0 12px;}

.pick-grid{display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-bottom:8px;}
.pick-card{
  text-align:left; background:#fff; border:1.5px solid var(--blue-200); border-radius:var(--radius);
  padding:18px 20px; cursor:pointer; font-family:var(--font-body);
}
.pick-card .pick-ico{font-size:1.3rem; margin-bottom:10px; display:block;}
.pick-card h4{margin:0 0 3px 0; font-size:0.98rem; color:var(--navy);}
.pick-card p{margin:0; font-size:0.82rem; color:var(--ink-soft);}
.pick-card.selected{border-color:var(--blue-700); background:var(--blue-50); box-shadow:var(--ring);}
input[name="category"]:checked + .pick-card,
input[name="service"]:checked + .pick-card{border-color:var(--blue-700); background:var(--blue-50); box-shadow:var(--ring);}

.svc-pick-grid{display:grid; grid-template-columns:1fr 1fr; gap:12px;}

.day-strip{display:flex; gap:8px; overflow-x:auto; padding-bottom:4px;}
.day-chip{
  min-width:60px; text-align:center; border-radius:12px; padding:10px 4px; cursor:pointer;
  border:1.5px solid var(--blue-200); background:#fff; flex:0 0 auto; font-family:var(--font-body);
}
.day-chip .dow{display:block; font-size:0.68rem; font-weight:700; color:var(--ink-soft); text-transform:uppercase; margin-bottom:3px;}
.day-chip .dom{display:block; font-size:1.05rem; font-weight:700; color:var(--navy);}
input[name="appointment_date"]:checked + .day-chip{background:var(--navy); border-color:var(--navy);}
input[name="appointment_date"]:checked + .day-chip .dow{color:#9fc6ff;}
input[name="appointment_date"]:checked + .day-chip .dom{color:#fff;}

.time-grid{display:grid; grid-template-columns:repeat(4,1fr); gap:10px;}
.time-slot{
  text-align:center; padding:10px 4px; border-radius:10px; font-size:0.85rem; font-weight:600;
  border:1.5px solid var(--blue-200); background:#fff; color:var(--ink); cursor:pointer; font-family:var(--font-body);
}
input[name="appointment_time"]:checked + .time-slot{border-color:var(--blue-700); background:var(--blue-700); color:#fff;}
.time-slot.is-booked{background:var(--blue-50); color:#b7c3d6; border-color:var(--blue-100); text-decoration:line-through; cursor:not-allowed;}

.book-summary{
  position:sticky; bottom:0; background:#fff; border-top:1px solid var(--blue-100);
  margin-top:34px; padding:18px 0 4px; display:flex; align-items:center; justify-content:space-between; gap:14px; flex-wrap:wrap;
}
.book-summary p{margin:0; font-size:0.85rem; color:var(--ink-soft);}

/* ============ CONFIRMATION ============ */
.confirm-wrap{max-width:480px; margin:0 auto; text-align:center;}
.confirm-check{width:54px; height:54px; border-radius:50%; background:#e6f7ee; color:var(--ok); display:flex; align-items:center; justify-content:center; font-size:1.5rem; margin:0 auto 18px;}
.meet-box{background:var(--navy); border-radius:16px; padding:22px 24px; text-align:left; margin-bottom:16px;}
.meet-box .meet-label{font-size:0.72rem; font-weight:700; color:#9fc6ff; text-transform:uppercase; letter-spacing:.06em; margin-bottom:10px;}
.meet-link-row{display:flex; align-items:center; justify-content:space-between; gap:10px; background:rgba(255,255,255,0.08); border-radius:10px; padding:12px 14px; margin-bottom:14px;}
.meet-link-row code{color:#eaf3ff; font-size:0.92rem; word-break:break-all;}
.meet-link-row a{color:#9fc6ff; font-size:0.8rem; font-weight:700; text-decoration:none; flex:0 0 auto;}
.address-box{background:#fff; border:1.5px solid var(--blue-200); border-radius:16px; padding:22px 24px; text-align:left; margin-bottom:16px;}
.address-box .addr-label{font-size:0.72rem; font-weight:700; color:var(--warn); text-transform:uppercase; letter-spacing:.06em; margin-bottom:8px;}

@media (max-width:640px){
  .pick-grid, .svc-pick-grid{grid-template-columns:1fr 1fr;}
  .time-grid{grid-template-columns:repeat(2,1fr);}
}
</style>
<?php echo $__env->yieldContent('head'); ?>
</head>
<body>

<div class="topbar">
  <div class="topbar-inner">
    <a href="<?php echo e(url('/')); ?>" class="brand">
      <svg class="iris" viewBox="0 0 40 40"><path d="M2 20C2 20 10 6 20 6C30 6 38 20 38 20C38 20 30 34 20 34C10 34 2 20 2 20Z" fill="#eaf3ff" stroke="#1668dc" stroke-width="2"/><circle cx="20" cy="20" r="7" fill="#0b2545"/><circle cx="17.5" cy="17" r="2" fill="#fff"/></svg>
      Omma Health Center
    </a>
    <button class="menu-toggle" onclick="document.querySelector('nav.mainnav').classList.toggle('open')">☰</button>
    <nav class="mainnav" id="mainnav">
      <a href="<?php echo e(url('/')); ?>" class="<?php echo e(request()->is('/') ? 'active' : ''); ?>">Home</a>
      <?php if(auth()->guard()->check()): ?>
        <a href="<?php echo e(url('/dashboard')); ?>" class="<?php echo e(request()->is('dashboard') ? 'active' : ''); ?>">Dashboard</a>
        <a href="<?php echo e(route('booking.create')); ?>" class="<?php echo e(request()->is('book') ? 'active' : ''); ?>">Book now</a>
      <?php else: ?>
        <a href="<?php echo e(route('login')); ?>" class="<?php echo e(request()->routeIs('login') ? 'active' : ''); ?>">Login</a>
        <a href="<?php echo e(route('register')); ?>" class="<?php echo e(request()->routeIs('register') ? 'active' : ''); ?>">Register</a>
      <?php endif; ?>
    </nav>
    <div class="patient-chip">
      <?php if(auth()->guard()->check()): ?>
        👤 <?php echo e(Auth::user()->name); ?>

        <form method="POST" action="<?php echo e(route('logout')); ?>" style="display:inline;">
          <?php echo csrf_field(); ?>
          <button type="submit">logout</button>
        </form>
      <?php else: ?>
        <a href="<?php echo e(route('login')); ?>" class="btn btn-ghost btn-sm" style="padding:2px 4px;">Sign in</a>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php echo $__env->yieldContent('content'); ?>

<footer>
  <div class="container">
    <div>© <?php echo e(date('Y')); ?> Omma Health Center — demo application, not a substitute for professional medical diagnosis.</div>
    <div><a href="<?php echo e(route('register')); ?>">Book an appointment</a></div>
  </div>
</footer>

<?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\Lenovo Loq\OneDrive\Desktop\xampp\htdocs\omma-health-center\resources\views/layouts/app.blade.php ENDPATH**/ ?>