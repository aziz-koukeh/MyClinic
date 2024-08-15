<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Fonts -->
    

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">

    <!-- Custom fonts for this template-->

    <link href="<?php echo e(asset('assets/MyClinicApp/vendor/fontawesome-free/css/all.min.css')); ?>" rel="stylesheet" type="text/css">
    


    <!-- Custom styles for this template-->
    <link href="<?php echo e(asset('assets/MyClinicApp/css/sb-admin-2.css')); ?>" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

                <!-- Begin Page Content -->
                <div class="container">

                    <div class="card o-hidden border-0 shadow-lg mt-5 py-5">
                        <div class="card-body p-1">
                            <!-- 404 Error Text -->
                            <div class="text-center">
                                <div class="error mx-auto" data-text="404" style="width: 13.5rem;">404</div>
                                <p class="lead text-gray-800 mb-5">Page Not Found</p>
                                <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
                                <a href="<?php echo e(route('Clinic.index')); ?>">&larr; Back to Home</a>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->



    <script src="<?php echo e(asset('assets/MyClinicApp/vendor/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/MyClinicApp/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?php echo e(asset('assets/MyClinicApp/vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?php echo e(asset('assets/MyClinicApp/js/sb-admin-2.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/MyClinicApp/js/custom.js')); ?>" ></script>



</body>

</html>
<?php /**PATH E:\Projects\xampp\htdocs\MyClinicApp8\resources\views/errors/404.blade.php ENDPATH**/ ?>