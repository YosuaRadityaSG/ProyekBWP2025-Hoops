

<?php $__env->startSection('content'); ?>
    <h2>Langkah 1: Buat Akun</h2>
    <p>Ini adalah simulasi membuat akun Google baru.</p>

    <?php if(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    <form action="<?php echo e(route('register.email.handle')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?php echo e(old('username')); ?>">
            <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-message"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>">
            <div id="email-error" class="error-message"></div> <!-- Untuk pesan AJAX -->
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-message"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-message"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <button type="submit">Lanjutkan</button>
    </form>
    
    <script>
        document.getElementById('email').addEventListener('blur', function() {
            let email = this.value;
            let errorElement = document.getElementById('email-error');
            
            if (email.length > 0) {
                fetch('<?php echo e(route("ajax.checkEmail")); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    },
                    body: JSON.stringify({ email: email })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        errorElement.textContent = 'Email ini sudah terpakai!';
                    } else {
                        errorElement.textContent = '';
                    }
                });
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\KULIAH\SEMESTER 3\BWP\PROJEK\template_laravel_12\template_laravel_12\resources\views/auth/register_email.blade.php ENDPATH**/ ?>