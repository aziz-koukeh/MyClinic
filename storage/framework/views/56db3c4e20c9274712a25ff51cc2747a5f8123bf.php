<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Laravel')); ?></title>

        <!-- Styles -->
        <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">

        <!-- Custom fonts for this template-->
        <link href="<?php echo e(asset('assets/MyClinicApp/css/all.css')); ?>" rel="stylesheet">


        <!-- Custom styles for this template-->
        <link href="<?php echo e(asset('assets/MyClinicApp/css/sb-admin-2.css')); ?>" rel="stylesheet">



        <?php echo $__env->yieldContent('style'); ?>

    </head>
    <body>
        <div >

        <main>
            <div > <?php echo $__env->make('partial.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> </div>
            <br>
            <?php echo $__env->yieldContent('print'); ?>
        </main>




        </div>


        <?php echo $__env->yieldContent('script'); ?>

    </body>
</html>
<?php /**PATH E:\Projects\xampp\htdocs\MyClinicApp8\resources\views/layouts/print.blade.php ENDPATH**/ ?>