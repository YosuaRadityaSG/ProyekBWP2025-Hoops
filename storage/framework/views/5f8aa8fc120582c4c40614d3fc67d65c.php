

<?php $__env->startSection('content'); ?>
    <h2>Selamat Datang di Hooks!</h2>
    <p>Silahkan masuk dengan akun yang sudah terdaftar atau buat akun baru.</p>

    
    <?php if(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <hr>
    <h4>Pilih Akun:</h4>
    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <form action="<?php echo e(route('login.handle')); ?>" method="POST" style="margin-bottom:10px;">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="email" value="<?php echo e($user->email); ?>">
            <button type="submit">
                Masuk sebagai <?php echo e($user->nickname); ?> (<?php echo e($user->email); ?>)
            </button>
        </form>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <hr>
    <h4>Belum punya akun?</h4>
    <a href="<?php echo e(route('register.email')); ?>">
        <button>Buat Akun Baru</button>
    </a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\KULIAH\SEMESTER 3\BWP\PROJEK\template_laravel_12\template_laravel_12\resources\views/auth/login_register.blade.php ENDPATH**/ ?>