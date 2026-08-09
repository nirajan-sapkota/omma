<?php $__env->startSection('title', 'Omma Health Center — Vision & Hearing Care'); ?>

<?php $__env->startSection('content'); ?>
<section class="view" id="view-home">
  <div class="hero">
    <div class="container hero-grid">
      <div>
        <span class="eyebrow">Omma · Greek for "eye"</span>
        <h1>Vision, hearing &amp; doctor care, tested and booked in one place.</h1>
        <p class="lead">Take a free eye, colour‑vision and hearing screening, then book a video consultation with our doctor — you'll get a unique meeting link instantly.</p>
        <div class="cta-row">
            <a href="<?php echo e(route('register')); ?>" class="btn btn-primary">Create an account</a>
            <a href="<?php echo e(route('login')); ?>" class="btn btn-outline">Login</a>
          
        </div>
      </div>
      <div class="hero-visual">
        <div class="snellen-card">
          <div class="row">O M M A</div>
          <div class="row">E F P T</div>
          <div class="row">D E C F P</div>
          <div class="row">L E F O D P C T</div>
          <div class="row">F E L O P Z D</div>
          <div class="snellen-caption">SNELLEN‑STYLE ACUITY CHART · SAMPLE</div>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="services">
      <div class="svc-card">
        <div class="ico">👁️</div>
        <h3>Eye Test</h3>
        <p>A quick Snellen‑style acuity check to estimate how clearly you're seeing today.</p>
        <?php if(auth()->guard()->check()): ?>
          <a class="btn btn-ghost" href="#">Take test →</a>
        <?php else: ?>
          <a class="btn btn-ghost" href="<?php echo e(route('login')); ?>">Sign in to take test →</a>
        <?php endif; ?>
      </div>
      <div class="svc-card">
        <div class="ico">🎨</div>
        <h3>Colourblindness Test</h3>
        <p>Ishihara‑style plates that screen for red‑green colour vision deficiency.</p>
        <?php if(auth()->guard()->check()): ?>
          <a class="btn btn-ghost" href="#">Take test →</a>
        <?php else: ?>
          <a class="btn btn-ghost" href="<?php echo e(route('login')); ?>">Sign in to take test →</a>
        <?php endif; ?>
      </div>
      <div class="svc-card">
        <div class="ico">👂</div>
        <h3>Hearing Test</h3>
        <p>Tone‑based screening across frequencies for each ear, right in your browser.</p>
        <?php if(auth()->guard()->check()): ?>
          <a class="btn btn-ghost" href="#">Take test →</a>
        <?php else: ?>
          <a class="btn btn-ghost" href="<?php echo e(route('login')); ?>">Sign in to take test →</a>
        <?php endif; ?>
      </div>
      <div class="svc-card">
        <div class="ico">🩺</div>
        <h3>Doctor Video Visit</h3>
        <p>Book a slot and receive a unique video‑call link to meet your doctor.</p>
        <?php if(auth()->guard()->check()): ?>
          <a class="btn btn-ghost" href="#">Book now →</a>
        <?php else: ?>
          <a class="btn btn-ghost" href="<?php echo e(route('register')); ?>">Register to book →</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Lenovo Loq\OneDrive\Desktop\xampp\htdocs\omma-health-center\resources\views/home.blade.php ENDPATH**/ ?>