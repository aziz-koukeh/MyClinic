<?php $__env->startSection('style'); ?>
    <!-- Custom styles for this page -->
    <link href="<?php echo e(asset('assets/MyClinicApp/vendor/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <div class="pb-5">
        <!-- DataTales Example -->

        <div class="card shadow my-3">
            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary text-center">نتائج البحث</h5>
            </div>

            <div class="card-body p-2" >
                <div class="table-responsive" style="direction:ltr">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم الزائر</th>
                                <th>تاريخ الإدخال</th>
                                <th>الرقم</th>
                                <th>العمر</th>
                                <th>الجنس</th>
                                <th>الإجراء</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $num=0;
                            ?>
                            <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="text-gray-900">
                                    <td><?php echo e(++$num); ?></td>
                                    <td class="text-xs" ><b><?php echo e($patient->patient_name); ?></b></td>
                                    <td class="text-xs"><b><?php echo e($patient->created_at->format('Y-m-d')); ?></b></td>
                                    <td class="text-xs"><b>
                                        <?php if($patient->phone): ?>
                                            <?php echo e($patient->phone); ?>

                                        <?php else: ?>
                                            ----
                                        <?php endif; ?>
                                    </b></td>
                                    <td class="text-xs"><b>
                                        <?php if($patient->age && $patient->age != date('Y')): ?>
                                            <?php echo e(date('Y') -$patient->age); ?> سنة
                                        <?php else: ?>
                                            ----
                                        <?php endif; ?>
                                    </b></td>
                                    <td class="text-xs"><b>
                                        <?php if($patient->gender): ?>
                                            <?php if($patient->gender == 'male'): ?> <?php echo e('ذكر'); ?> <?php elseif($patient->gender == 'female'): ?> <?php echo e('أنثى'); ?> <?php endif; ?>
                                        <?php else: ?>
                                            ----
                                        <?php endif; ?>

                                    </b></td>
                                    <td>
                                        <a href="<?php echo e(route('Clinic.patientProfile',$patient->patient_slug)); ?>" class="btn btn-primary btn-circle btn-sm mx-1">
                                            <i class="fas fa-sign-in-alt text-light"></i>
                                        </a>
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

<?php echo $__env->make('layouts.myClinic', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Projects\xampp\htdocs\MyClinicApp8\resources\views/myClinic/mangement/ResultSearchPatients.blade.php ENDPATH**/ ?>