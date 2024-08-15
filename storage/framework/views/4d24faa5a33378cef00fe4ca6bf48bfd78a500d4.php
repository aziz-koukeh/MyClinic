<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo e(asset('assets/MyClinicApp/css/all.css')); ?>" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo e(asset('assets/MyClinicApp/css/sb-admin-2.css')); ?>" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card bg-gray-100 o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row px-4">
                    <div class="col-lg-6 d-none d-lg-block /*bg-building-image*/ my-5">
                    <img src="<?php echo e(asset('assets/MyClinicApp/image/dr.jpg')); ?>" alt="" style="object-fit:contain ;height:100%;width: 100%;border-radius: 100%">
                    </div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">عيادة الدكتور طارق وجيه دعاس</h1>
                                
                            </div>

                            <hr>
                            <?php if($doctor_info->opentime || $doctor_info->opentime): ?>
                            <div class="text-xs my-1 font-weight-bold text-gray-900 text-center"><?php if($doctor_info->opentime): ?> - بداية الدوام : الساعة <?php echo e(\Carbon\Carbon::parse($doctor_info->opentime)->format('h:i a')); ?> <?php endif; ?> <?php if($doctor_info->closetime): ?> - نهاية الدوام : الساعة <?php echo e(\Carbon\Carbon::parse($doctor_info->closetime)->format('h:i a')); ?> <?php endif; ?> .</div>
                            <hr>
                            <?php endif; ?>
                            <div class="d-flex py-1 justify-content-center" style="direction:ltr">
                                <?php if($doctor_info->facepage): ?><a class="btn btn-social" href="<?php echo e($doctor_info->facepage); ?>"><i class="fab fa-facebook-f"></i></a> <?php endif; ?>
                                <?php if($doctor_info->whatsapp): ?><a class="btn btn-social" href="<?php echo e($doctor_info->whatsapp); ?>"><i class='bx bxl-whatsapp' style="font-size:150%"></i></a> <?php endif; ?>
                                <?php if($doctor_info->telegram): ?><a class="btn btn-social" href="<?php echo e($doctor_info->telegram); ?>"><i class='bx bxl-telegram'  style="font-size:120%"></i></a> <?php endif; ?>
                                <?php if($doctor_info->instagram): ?><a class="btn btn-social" href="<?php echo e($doctor_info->instagram); ?>"><i class="fab fa-instagram"></i></a> <?php endif; ?>
                                <?php if($doctor_info->youtube): ?><a class="btn btn-social" href="<?php echo e($doctor_info->youtube); ?>"><i class="fab fa-youtube"></i></a> <?php endif; ?>
                                <?php if($doctor_info->twitter): ?><a class="btn btn-social" href="<?php echo e($doctor_info->twitter); ?>"><i class="fab fa-twitter"></i></a> <?php endif; ?>
                                <?php if($doctor_info->linked_in): ?><a class="btn btn-social" href="<?php echo e($doctor_info->linked_in); ?>"><i class="fab fa-linkedin-in"></i></a> <?php endif; ?>
                            </div>
                            <div class="text-center">
                                <?php if(auth()->guard()->guest()): ?>
                                    <a class="small" href="<?php echo e(route('Clinic.show_login_form')); ?>">تسجيل الدخول</a>
                                <?php else: ?>
                                    <a class="small" href="<?php echo e(route('Clinic.index')); ?>">الصفحة الرئيسية</a>
                                <?php endif; ?>
                                
                                <a class="small" href="<?php echo e(route('Clinic.AboutUs')); ?>">- حول العيادة</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>

</html>

<?php /**PATH E:\Projects\xampp\htdocs\MyClinicApp8\resources\views/myClinic/welcome.blade.php ENDPATH**/ ?>