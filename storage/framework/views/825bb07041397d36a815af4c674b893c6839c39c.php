<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class=" mb-5 pb-5 mt-3">
    

        <div class=" card border-right-info shadow p-2 my-3">
            <div class="card-header py-2">
                <h5 class="text-center text-dark p-0 m-0"><b>الزيارات المميزة بنجمة</b><i class="fa-solid fa-star" style="color: #f2df0d;"></i><span class="h6" > : / <?php echo e(count($patientReviews)); ?> /</span></h5>
            </div>
            <?php $__empty_1 = true; $__currentLoopData = $patientReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patientReview): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php if($patientReview->review_type == 'معاينة'): ?>
                    <?php
                    $type ='success'
                    ?>
                <?php elseif($patientReview->review_type == 'مراجعة'): ?>
                    <?php
                    $type ='warning'
                    ?>
                <?php elseif($patientReview->review_type == 'اسعافية'): ?>
                    <?php
                    $type ='danger'
                    ?>
                <?php else: ?>
                    <?php
                    $type ='info'
                    ?>
                <?php endif; ?>
                <div class="card border-bottom-<?php echo e($type); ?> mb-2">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header p-2 " style="display:inline-flex;direction:rtl">
                        <div class="d-sm-block d-md-inline-flex" style="width:12% ;">
                            <div>
                                <a class="card_dropdown" href="#collapseCardExample<?php echo e($patientReview->id); ?>" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample<?php echo e($patientReview->id); ?>">
                                </a>
                            </div>
                            <p class="text-xs text-gray-800 font-weight-bold p-0 m-0"><?php echo e($patientReview->review_type); ?></p>
                        </div>
                        <div class="text-center" style="width:70% ;">
                            <p class="text-xs text-gray-900 p-0 m-0">اسم الزائر :</p>
                            <h6 class="text-primary p-0 m-0"><a href="<?php echo e(route('Clinic.patientProfile',$patientReview->patient->patient_slug)); ?>"><b><?php echo e($patientReview->patient->patient_name); ?></b></a></h6>
                        </div>
                        <div class="" style="width: 20%;">
                            <p class="text-xs text-gray-800 p-0 m-0"><?php echo e($patientReview->created_at->format('D d-m-Y')); ?></p>
                            <p class="text-xs text-gray-800 p-0 m-0"  style="direction:ltr"><?php echo e($patientReview->created_at->format('h:i a')); ?></p>
                        </div>
                    </div>
                    <div class="collapse" id="collapseCardExample<?php echo e($patientReview->id); ?>">
                        <div class="card-body p-2">
                            <div class="form-row">
                                <div class="col-lg-8" style="direction:ltr">
                                    <table class="table table-bordered text-center">
                                        <thead>
                                            <tr>
                                                <th>الجنس</th>
                                                <th>العمر</th>
                                                <th>التدخين</th>
                                                <?php if($patientReview->patient->blood_type): ?>
                                                    <th>زمرة الدم</th>
                                                <?php endif; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-gray-800"><?php if($patientReview->patient->gender == 'male'): ?> <?php echo e('ذكر'); ?> <?php elseif($patientReview->patient->gender == 'female'): ?> <?php echo e('أنثى'); ?> <?php else: ?> لم يتم الإدخال <?php endif; ?></td>
                                                <?php if($patientReview->patient->age && $patientReview->patient->age!=date('Y')): ?>
                                                <td class="text-gray-800" style="direction:rtl"><?php echo e(date('Y') - $patientReview->patient->age .' سنة'); ?></td>
                                                <?php else: ?>
                                                <td class="text-gray-800" style="direction:rtl">لم يتم الإدخال</td>
                                                <?php endif; ?>
                                                <?php if($patientReview->patient->smoking): ?>
                                                <td class="text-gray-800" style="direction:rtl"><?php if($patientReview->patient->smoking == 'negative'): ?> <?php echo e('سلبي'); ?> <?php elseif($patientReview->patient->smoking == 'positive'): ?>  <?php echo e('إيجابي'); ?> <?php endif; ?></td>
                                                <?php else: ?>
                                                    <td class="text-gray-800" style="direction:rtl">لم يتم الإدخال</td>
                                                <?php endif; ?>
                                                <?php if($patientReview->patient->blood_type): ?>
                                                    <td class="text-gray-800" style="direction:rtl"><?php echo e($patientReview->patient->blood_type); ?></td>
                                                <?php endif; ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="card  border-right-dark p-2 my-2" style="direction:rtl;text-align:right">
                                        <div class="text-primary text-uppercase mb-1">سبب الزيارة</div>
                                        <div class="mb-0 text-gray-800"><?php echo e($patientReview->main_complaint); ?></div>
                                        <?php if($patientReview->pain_story): ?>
                                            <div class="text-primary text-uppercase mb-1">القصة المرضية</div>
                                            <div class="mb-0 text-gray-800"><?php echo e($patientReview->pain_story); ?></div>
                                        <?php endif; ?>
                                        <?php if($patientReview->medical_report): ?>
                                            <div class="text-primary text-uppercase mb-1 px-3">رأي الطبيب</div>
                                            <div class="mb-0 text-gray-800"><?php echo e($patientReview->medical_report); ?></div>
                                        <?php endif; ?>
                                        <?php if($patientReview->treatment_plan): ?>
                                            <div class="text-primary text-uppercase mb-1 px-3">خطة العلاج</div>
                                            <div class="mb-0 text-gray-800"><?php echo e($patientReview->treatment_plan); ?></div>
                                        <?php endif; ?>
                                        <?php if($patientReview->med_analysis_T): ?>
                                            <div class="text-primary text-uppercase mb-1 px-3">التحليل مكتوب</div>
                                            <div class="mb-0 text-gray-800"><?php echo e($patientReview->med_analysis_T); ?></div>
                                        <?php endif; ?>
                                        <?php if($patientReview->med_photo_T): ?>
                                            <div class="text-primary text-uppercase mb-1 px-3">الصورة مكتوب</div>
                                            <div class="mb-0 text-gray-800"><?php echo e($patientReview->med_photo_T); ?></div>
                                        <?php endif; ?>
                                        <?php if($patientReview->doctor_notes): ?>
                                            <div class="text-primary text-uppercase mb-1">ملاحظات الطبيب</div>
                                            <div class="mb-0 text-gray-800"><?php echo e($patientReview->doctor_notes); ?></div>
                                        <?php endif; ?>
                                        <?php if($patientReview->date_expecting && (Carbon\Carbon::today() > Carbon\Carbon::parse($patientReview->date_expecting))): ?>
                                            <div class="text-primary text-uppercase mb-1">
                                                <?php if($patientReview->main_complaint ==' - تحديد عملية - تحليل' || $patientReview->main_complaint =='تحديد عملية' || $patientReview->main_complaint ==' - تحديد عملية - صورة - تحليل' || $patientReview->main_complaint ==' - تحديد عملية - صورة'): ?>
                                                    موعد العملية
                                                <?php else: ?>
                                                    الموعد القادم
                                                <?php endif; ?>
                                            </div>
                                            <div class="mb-0 text-gray-800"><?php echo e($patientReview->date_expecting); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                    <?php if($patientReview->reviewMedias->count() > 0): ?>
                                    <div class="col-lg-4 bg-gradient-dark my-1" style="direction:rtl;height:360px;border-radius: 0.35rem;">
                                        <div id="carouselIndicatorsReview<?php echo e($patientReview->id); ?>" class="carousel slide" data-ride="carousel">
                                            <ol class="carousel-indicators">
                                                <?php $__currentLoopData = $patientReview->reviewMedias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li data-target="#carouselIndicatorsReview<?php echo e($patientReview->id); ?>" data-slide-to="<?php echo e($loop->index); ?>" class="<?php echo e($loop->index == 0 ? 'active' : ''); ?>"></li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ol>
                                            <div class="carousel-inner">
                                                <?php $__currentLoopData = $patientReview->reviewMedias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="carousel-item <?php echo e($loop->index == 0 ? 'active' : ''); ?>">
                                                        <img src="<?php echo e(asset('assets/Clinic/'.auth()->user()->doctor_id.'/'.$media->file_name)); ?>" class="d-block" style="border-radius: 0.35rem;height:360px;object-fit:contain;width:100%;" alt="...">
                                                        <a class="position-absolute text-danger" style="right: 40px;bottom: 10px; border:1px solid;border-radius: 100%" href="<?php echo e(route('Clinic.destroyReviewMedia',$media->id)); ?>"><i class=" fas fa-fw  fa-2x fa-trash-alt"></i></a>

                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                            <?php if($patientReview->reviewMedias->count() > 1): ?>
                                            <button class="carousel-control-prev" type="button" data-target="#carouselIndicatorsReview<?php echo e($patientReview->id); ?>" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-target="#carouselIndicatorsReview<?php echo e($patientReview->id); ?>" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only  text-primary">Next</span>
                                            </button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php else: ?>
                                    <div class="col-lg-4 bg-review-image"></div>
                                    <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="card border-bottom-info shadow py-3 my-3">
                    <div class="card-body text-center text-info" >
                        <b>لا يوجد</b>
                    </div>
                </div>
            <?php endif; ?>

        </div>


    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.myClinic', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Projects\xampp\htdocs\MyClinicApp8\resources\views/myClinic/patients/specialWithStar.blade.php ENDPATH**/ ?>