<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <?php echo $__env->make('partials.head', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </head>
    <body class="min-h-screen antialiased" style="background: linear-gradient(80deg, #EDEDED 100%, #F5F5F5 60%, #EDEDED 100%);">
        <?php echo e($slot); ?>

        <?php app('livewire')->forceAssetInjection(); ?>
<?php echo app('flux')->scripts(); ?>

    </body>
</html>
<?php /**PATH C:\laragon\www\theindonesianpress-app\resources\views/components/layouts/app.blade.php ENDPATH**/ ?>