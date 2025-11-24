<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Hooks</title>
    <style>
        body { font-family: sans-serif; margin: 40px; background-color: #f4f4f4; }
        .container { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: #fff; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="email"], input[type="password"], input[type="date"], select, textarea { width: 95%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        button { padding: 10px 15px; background-color: #007bff; color: white; border: none; cursor: pointer; border-radius: 4px; }
        a > button { width: 100%; }
        .alert { padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px; }
        .alert-danger { color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; }
        .alert-success { color: #155724; background-color: #d4edda; border-color: #c3e6cb; }
        .error-message { color: red; font-size: 0.8em; margin-top: 4px; }
    </style>
</head>
<body>
    <div class="container">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
</body>
</html><?php /**PATH D:\KULIAH\SEMESTER 3\BWP\PROJEK\template_laravel_12\template_laravel_12\resources\views/layouts/app.blade.php ENDPATH**/ ?>