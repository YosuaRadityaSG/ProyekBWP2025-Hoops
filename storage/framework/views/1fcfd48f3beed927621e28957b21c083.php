

<?php $__env->startSection('content'); ?>
    <h2>Langkah 2: Lengkapi Profil Anda</h2>
    
    <form action="<?php echo e(route('register.profile.handle')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="nickname">Nickname</label>
            <input type="text" id="nickname" name="nickname" required>
        </div>
        <div class="form-group">
            <label for="birth_date">Tanggal Lahir</label>
            <input type="date" id="birth_date" name="birth_date" required>
        </div>
        <div class="form-group">
            <label for="gender">Gender Anda</label>
            <select id="gender" name="gender" required>
                <option value="man">Man</option>
                <option value="woman">Woman</option>
            </select>
        </div>
        <div class="form-group">
            <label for="country">Negara</label>
            <input type="text" id="country" name="country" required value="Indonesia">
        </div>
         <div class="form-group">
            <label for="friend_preference_gender">Preferensi Teman (Gender)</label>
            <select id="friend_preference_gender" name="friend_preference_gender" required>
                <option value="man">Man</option>
                <option value="woman">Woman</option>
                <option value="everyone">Everyone</option>
            </select>
        </div>
        <div class="form-group">
            <label for="friend_preference_location">Preferensi Teman (Lokasi)</label>
            <select id="friend_preference_location" name="friend_preference_location" required>
                <option value="local">Negara Sendiri</option>
                <option value="worldwide">Seluruh Dunia</option>
            </select>
        </div>
        <div class="form-group">
            <label for="profile_picture_url">URL Foto Profil (opsional)</label>
            <input type="text" id="profile_picture_url" name="profile_picture_url">
        </div>
        <div class="form-group">
            <label>Minat Anda (Pilih minimal 1)</label>
            <?php $__currentLoopData = $interests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $interest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div>
                    <input type="checkbox" name="interests[]" value="<?php echo e($interest->id); ?>" id="interest_<?php echo e($interest->id); ?>">
                    <label for="interest_<?php echo e($interest->id); ?>" style="font-weight:normal;"><?php echo e($interest->name); ?> (<?php echo e($interest->category); ?>)</label>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php $__errorArgs = ['interests'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-message"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <button type="submit">Selesai & Masuk</button>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\KULIAH\SEMESTER 3\BWP\PROJEK\template_laravel_12\template_laravel_12\resources\views/auth/register_profile.blade.php ENDPATH**/ ?>