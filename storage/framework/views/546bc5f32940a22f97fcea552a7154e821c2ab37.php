<?php $__env->startSection('style'); ?>
    <!-- Custom styles for this page -->
    <link href="<?php echo e(asset('assets/MyClinicApp/vendor/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class=" mb-5 pb-5 mt-3">
        <!-- DataTales Example -->
        <div class="card shadow my-3">
            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary text-center">سجل الزوار </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive" style="direction:ltr">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>تاريخ الإدخال</th>
                                <th>اسم الزائر</th>
                                <th>التواصل</th>
                                
                                <th>العمر</th>
                                <th>الزيارة مفحوصة</th>
                                <th>الأرشفة</th>
                                <th>الإجراء</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i=count($patients) +1;
                                $num=0;
                            ?>
                            <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(count($patient->patientReviews)>0): ?>
                                    <tr class="text-gray-900">
                                        <td><?php echo e(++$num); ?></td>
                                        <td><?php echo e($patient->created_at->format('Y-m-d')); ?></td>
                                        <td><?php echo e($patient->patient_name); ?></td>
                                        <td>
                                            <?php if($patient->phone): ?>
                                                <?php echo e($patient->phone); ?>

                                            <?php else: ?>
                                                لم يتم الإدخال
                                            <?php endif; ?>
                                        </td>
                                        
                                        <td style="direction:rtl">
                                            <?php if($patient->age && $patient->age!= date('Y')): ?>
                                            <?php echo e(date('Y') - $patient->age .' سنة'); ?>

                                            <?php else: ?>
                                                لم يتم الإدخال
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e(count($patient->patientReviews)); ?></td>
                                        <td><?php echo e(--$i); ?></td>
                                        <td>
                                            <div class="d-sm-block d-lg-inlineflex">
                                                <a href="<?php echo e(route('Clinic.patientProfile',$patient->patient_slug)); ?>" class="btn btn-primary btn-circle btn-sm mx-1"  data-toggle="tooltip" title="الذهاب إلى ملف الزائر">
                                                    <i class="fas fa-sign-in-alt text-light"></i>
                                                </a>
                                                <a href="<?php echo e(route('Clinic.softDeletesPatient',$patient->patient_slug)); ?>" class="btn btn-danger btn-circle btn-sm mx-1"  data-toggle="tooltip" title="حذف ملف الزائر">
                                                    <i class="fas fa-fw fa-trash text-light"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>

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

<?php echo $__env->make('layouts.myClinic', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Projects\xampp\htdocs\MyClinicApp8\resources\views/myClinic/patients/patientsArchive.blade.php ENDPATH**/ ?>