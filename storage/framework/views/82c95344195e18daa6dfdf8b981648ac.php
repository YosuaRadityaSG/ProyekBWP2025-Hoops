

<?php $__env->startSection('content'); ?>
    <h2>Selamat Datang di Halaman Utama, <?php echo e($user->nickname); ?>!</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <p>Ini adalah data profil yang berhasil kamu daftarkan:</p>

    <ul style="list-style-type: none; padding: 0;">
        <li style="margin-bottom: 10px;"><strong>Email:</strong> <?php echo e($user->email); ?></li>
        <li style="margin-bottom: 10px;"><strong>Nickname:</strong> <?php echo e($user->nickname); ?></li>
        <li style="margin-bottom: 10px;"><strong>Tanggal Lahir:</strong> <?php echo e($user->birth_date); ?></li>
        <li style="margin-bottom: 10px;"><strong>Gender:</strong> <?php echo e($user->gender); ?></li>
        <li style="margin-bottom: 10px;"><strong>Negara:</strong> <?php echo e($user->country); ?></li>
        <li style="margin-bottom: 10px;"><strong>Mencari Teman:</strong> <?php echo e($user->friend_preference_gender); ?> di lokasi <?php echo e($user->friend_preference_location); ?></li>
        <li style="margin-bottom: 10px;"><strong>Minat:</strong>
            <?php $__currentLoopData = $user->interests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $interest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span style="background-color: #eee; padding: 2px 5px; border-radius: 3px; margin-right: 5px;"><?php echo e($interest->name); ?></span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </li>
    </ul>

    <hr>
    
    <a href="<?php echo e(route('logout')); ?>">
        <button>Logout</button>
    </a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\KULIAH\SEMESTER 3\BWP\PROJEK\template_laravel_12\template_laravel_12\resources\views/dashboard.blade.php ENDPATH**/ ?>