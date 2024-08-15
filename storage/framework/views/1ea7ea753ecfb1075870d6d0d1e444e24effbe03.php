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


        <!-- the SummerNotes plugin styling CSS file -->
        <link href="<?php echo e(asset('assets/SummerNotes/summernote-bs4.min.css')); ?>" rel="stylesheet">

        <!-- the fileinput plugin styling CSS file -->

        <link rel="stylesheet" href="<?php echo e(asset('assets/BootstrapFileInput/themes/explorer-fa5/theme.min.css')); ?>" crossorigin="anonymous">

        <link href="<?php echo e(asset('assets/BootstrapFileInput/css/fileinput.min.css')); ?>" media="all" rel="stylesheet" type="text/css" />

        <?php echo $__env->yieldContent('style'); ?>
    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo e(asset('assets/MyClinicApp/vendor/jquery/jquery.min.js')); ?>"></script>
    


    <!-- PWA  -->

    <body id="page-top" class="sidebar-toggled">
        <div id="app">
            <div id="wrapper" style="direction: rtl">
                
                    <?php echo $__env->make('partial.myClinic.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                
                <!-- Content Wrapper -->
                <div id="content-wrapper" class="d-flex flex-column">

                    <!-- Main Content -->
                    <div id="content">

                        <?php echo $__env->make('partial.myClinic.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <main class="mt-4 px-0" style="direction:rtl ;text-align:left">
                            <div > <?php echo $__env->make('partial.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> </div>
                            <br>
                            <?php echo $__env->yieldContent('content'); ?>
                        </main>

                        <div class="mt-3">
                         <?php echo $__env->make('partial.myClinic.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>


        </div>




        <!-- Scripts -->
        
        <!-- Bootstrap core JavaScript-->
        
        <script src="<?php echo e(asset('assets/MyClinicApp/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
        <!-- Core plugin JavaScript-->
        <script src="<?php echo e(asset('assets/MyClinicApp/vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>
        <!-- Custom scripts for all pages-->
        <script src="<?php echo e(asset('assets/MyClinicApp/js/sb-admin-2.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/MyClinicApp/js/custom.js')); ?>" ></script>
        <!-- the BootstrapFileInput plugin JavaScript -->
        <script src="<?php echo e(asset('assets/BootstrapFileInput/js/plugins/buffer.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/BootstrapFileInput/js/plugins/filetype.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/BootstrapFileInput/js/plugins/piexif.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/BootstrapFileInput/js/plugins/sortable.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/BootstrapFileInput/js/fileinput.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/BootstrapFileInput/themes/fa5/theme.js')); ?>"></script>


        <?php echo $__env->yieldContent('script'); ?>

    </body>
</html><?php /**PATH E:\Projects\xampp\htdocs\MyClinicApp8\resources\views/layouts/myClinic.blade.php ENDPATH**/ ?>