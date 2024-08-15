<?php $__env->startSection('style'); ?>
    <!-- Custom styles for this page -->
    <link href="<?php echo e(asset('assets/MyClinicApp/vendor/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class=" mb-5 pb-5 mt-3">
        <!-- DataTales Example -->
        <div class="card shadow my-3">
            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary text-center">سجل الزيارات</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive" style="direction:ltr">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم الزائر</th>
                                <th>نوع الزيارة</th>
                                <th>سبب الزيارة</th>
                                <th>تاريخ الزيارة</th>
                                <th>الأرشفة</th>
                                
                                <th>الإجراء</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i=count($patientReviews) +1;
                                $num=0;
                            ?>
                            <?php $__currentLoopData = $patientReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="text-gray-900">
                                    <td><?php echo e(++$num); ?></td>
                                    <td><?php echo e($review->patient->patient_name); ?></td>
                                    <td><?php echo e($review->review_type); ?></td>
                                    <td  data-toggle="tooltip" title="<?php echo e($review->main_complaint); ?>" style="direction:rtl"><?php echo \Illuminate\Support\Str::limit($review->main_complaint, 40 , '...'); ?></td>
                                    <td><?php echo e($review->created_at->format('Y-m-d')); ?></td>
                                    <td><?php echo e(--$i); ?></td>
                                    <td>
                                        <div class="d-sm-block d-lg-inlineflex">
                                            <a href="<?php echo e(route('Clinic.patientProfile',$review->patient->patient_slug)); ?>" class="btn btn-primary btn-circle btn-sm mx-1" data-toggle="tooltip" title="الذهاب إلى ملف الزائر" >
                                                <i class="fas fa-sign-in-alt text-light"></i>
                                            </a>
                                            <a href="<?php echo e(route('Clinic.softDeleteReview',$review->id)); ?>" class="btn btn-danger btn-circle btn-sm mx-1"  data-toggle="tooltip" title="حذف الزيارة">
                                                <i class="fas fa-fw fa-trash text-light"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/MyClinicApp/vendor/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/MyClinicApp/vendor/datatables/dataTables.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/MyClinicApp/js/demo/datatables-demo.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.myClinic', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Projects\xampp\htdocs\MyClinicApp8\resources\views/myClinic/patients/reviewsArchive.blade.php ENDPATH**/ ?>