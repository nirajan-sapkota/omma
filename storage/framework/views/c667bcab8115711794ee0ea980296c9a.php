<?php $__env->startSection('title', 'Sign in — Omma Health Center'); ?>

<?php $__env->startSection('content'); ?>
<section class="view compact">
  <div class="container auth-wrap">
    <div class="section-title">
      <h2>Sign in</h2>
      <span class="tag">Patient login</span>
    </div>

    <div class="panel">
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('status')): ?>
        <div class="result-box good"><p><?php echo e(session('status')); ?></p></div>
      <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
        <div class="result-box warn">
          <ul>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
              <li><?php echo e($error); ?></li>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
          </ul>
        </div>
      <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

      <form method="POST" action="<?php echo e(route('login.attempt')); ?>">
        <?php echo csrf_field(); ?>

        <div class="field">
          <label for="email">Email address</label>
          <input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>"
                 class="<?php echo e($errors->has('email') ? 'is-invalid' : ''); ?>"
                 placeholder="you@example.com" required autofocus>
        </div>

        <div class="field">
          <label for="password">Password</label>
          <input id="password" type="password" name="password"
                 class="<?php echo e($errors->has('password') ? 'is-invalid' : ''); ?>"
                 placeholder="••••••••" required>
        </div>

        <div class="field-check">
          <input type="checkbox" id="remember" name="remember">
          <label for="remember" style="margin:0; font-weight:400; color:var(--ink-soft);">Remember me</label>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Sign in</button>
      </form>

      <div class="auth-foot">
        Don't have an account? <a href="<?php echo e(route('register')); ?>">Create one</a>
      </div>
    </div>
  </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\omma-health-center\resources\views/login.blade.php ENDPATH**/ ?>