<?php $__env->startSection('title', 'Create an account — Omma Health Center'); ?>

<?php $__env->startSection('content'); ?>
<section class="view compact">
  <div class="container auth-wrap">
    <div class="section-title">
      <h2>Create your account</h2>
      <span class="tag">New patient</span>
    </div>

    <div class="panel">
      <?php if($errors->any()): ?>
        <div class="result-box warn">
          <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
      <?php endif; ?>

      <form method="POST" action="<?php echo e(route('register.store')); ?>">
        <?php echo csrf_field(); ?>

        <div class="field">
          <label for="name">Full name</label>
          <input id="name" type="text" name="name" value="<?php echo e(old('name')); ?>"
                 class="<?php echo e($errors->has('name') ? 'is-invalid' : ''); ?>"
                 placeholder="e.g. Aarav Sharma" required autofocus>
        </div>

        <div class="field">
          <label for="email">Email address</label>
          <input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>"
                 class="<?php echo e($errors->has('email') ? 'is-invalid' : ''); ?>"
                 placeholder="you@example.com" required>
        </div>

        <div class="field-row" style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
          <div class="field">
            <label for="password">Password</label>
            <input id="password" type="password" name="password"
                   class="<?php echo e($errors->has('password') ? 'is-invalid' : ''); ?>"
                   placeholder="••••••••" required>
          </div>
          <div class="field">
            <label for="password_confirmation">Confirm password</label>
            <input id="password_confirmation" type="password" name="password_confirmation"
                   placeholder="••••••••" required>
          </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Create account</button>
      </form>

      <div class="auth-foot">
        Already have an account? <a href="<?php echo e(route('login')); ?>">Sign in</a>
      </div>
    </div>
  </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Lenovo Loq\OneDrive\Desktop\xampp\htdocs\omma-health-center\resources\views/register.blade.php ENDPATH**/ ?>