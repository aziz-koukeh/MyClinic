<?php $__env->startSection('print'); ?>

<div class=" h-100 p-1" style="direction: rtl;text-align:right ;font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">
    <!-- Card Header - Dropdown -->

    <div class=" pt-2 pb-4 " style="display:flex">
        <a href="<?php echo e(route('Clinic.index')); ?>"  class="text-center" style="width:30%;">
            <div>
                <p class="text-xs text-gray-700 p-0 m-0">عيادة الدكتور <?php echo e($patient->user->name); ?></p>
                <p class="text-xs text-gray-700 p-0 m-0">
                    <?php if($patient->user->doctor_info->university): ?>
                        جامعة <?php echo e($patient->user->doctor_info->university); ?>

                    <?php endif; ?>
                    <?php if($patient->user->doctor_info->med_specialty): ?>
                        - <?php echo e($patient->user->doctor_info->med_specialty); ?>

                    <?php endif; ?>
                </p>
                <p class="text-xs text-gray-700 p-0 m-0" style="direction:ltr"><?php echo e($patient->user->mobile); ?>

                    <?php if($patient->user->doctor_info->address): ?>
                        / <?php echo e($patient->user->doctor_info->address); ?>

                    <?php endif; ?>
                </p>
            </div>
        </a>
        <div  class="text-center" style="width:50%;">
            <p class="h5 text-gray-900 p-0 m-0">&nbsp;</p>
            <a href="<?php echo e(route('Clinic.patientProfile',$patient->patient_slug)); ?>">
                <p class="h5 text-gray-900 p-0 m-0">اسم المريض : <b><?php echo e($patient->patient_name); ?></b></p>
            </a>
        </div>
        <div style="text-align: center;width: 20%;">
            <p class="text-xs text-gray-700 p-0 m-0">تاريخ الطباعة : <?php echo e(Carbon\Carbon::today()->format('D d-m-Y')); ?></p>
            <p class=" text-xs text-gray-900  p-0 m-0"></p>
            <p class="text-xs text-gray-700 p-0 m-0">تاريخ الإدخال : <?php echo e($patient->created_at->format('D d-m-Y')); ?></p>
            <p class=" text-xs text-gray-900  p-0 m-0"></p>


        </div>
    </div>

    <div class="table-responsive"  style="border-radius: 10px; border: 1px solid;" >
        <table class="table table-bordered mb-0">
            <thead>
                <tr>
                    <th>الجنس</th>
                    <th>العمر</th>
                    <th>زمرة الدم</th>
                    <th>التدخين</th>
                    <th>الحالة الإجتماعية</th>
                    <th>عدد الأولاد</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php if($patient->gender): ?>
                        <td class=" text-gray-900"><?php if($patient->gender == 'male'): ?> <?php echo e('ذكر'); ?> <?php elseif($patient->gender == 'female'): ?> <?php echo e('أنثى'); ?> <?php endif; ?></td>
                    <?php else: ?>
                        <td class=" text-gray-900" style="direction:rtl;line-height: 46px;">---------------------</td>
                    <?php endif; ?>
                    <?php if($patient->age && $patient->age!= date('Y') ): ?>
                        <td class=" text-gray-900" style="direction:rtl"><?php echo e(date('Y') - $patient->age .' سنة'); ?></td>
                    <?php else: ?>
                        <td class=" text-gray-900" style="direction:rtl;line-height: 46px;">---------------------</td>
                    <?php endif; ?>
                    <?php if($patient->blood_type): ?>
                        <td class=" text-gray-900" style="direction:rtl"><?php echo e($patient->blood_type); ?></td>
                    <?php else: ?>
                        <td class=" text-gray-900" style="direction:rtl;line-height: 46px;">---------------------</td>
                    <?php endif; ?>
                    <?php if($patient->smoking): ?>
                        <td class=" text-gray-900" style="direction:rtl"><?php if($patient->smoking == 'negative'): ?> <?php echo e('سلبي'); ?> <?php elseif($patient->smoking == 'positive'): ?>  <?php echo e('إيجابي'); ?> <?php endif; ?></td>
                    <?php else: ?>
                        <td class=" text-gray-900" style="direction:rtl;line-height: 46px;">---------------------</td>
                    <?php endif; ?>
                    <?php if($patient->relationship): ?>
                        <td class=" text-gray-900" style="direction:rtl"><?php if($patient->relationship == 'married'): ?> <?php echo e('متزوج'); ?> <?php elseif($patient->relationship == 'single'): ?>  <?php echo e('أعزب'); ?> <?php endif; ?></td>
                    <?php else: ?>
                        <td class=" text-gray-900" style="direction:rtl;line-height: 46px;">---------------------</td>
                    <?php endif; ?>
                    <?php if($patient->child_count): ?>
                        <td class=" text-gray-900" style="direction:rtl"><?php echo e($patient->child_count); ?></td>
                    <?php else: ?>
                        <td class=" text-gray-900" style="direction:rtl;line-height: 46px;">---------------------</td>
                    <?php endif; ?>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="pt-2">
        <div class="w-100 d-inline-flex px-4">
            <div class="w-100 text-center d-inline-flex" style="width: 30%;">
                <p class="  text-gray-700 p-0 m-0">رقم الهاتف :&nbsp; </p>
                <?php if($patient->phone): ?>
                    <p class="  text-gray-900  p-0 m-0" style=" direction:ltr"><?php echo e($patient->phone); ?></p>
                <?php else: ?>
                    <p class="  text-gray-900  p-0 m-0" style=" direction:ltr;line-height: 46px;">---------------------------------</p>
                <?php endif; ?>
            </div>
            <div class="w-100 text-center d-inline-flex" style="width: 20%;">
                <p class="  text-gray-700 p-0 m-0">المهنة : &nbsp;</p>
                <?php if($patient->patient_job): ?>
                    <p class="  text-gray-900  p-0 m-0" style=" direction:ltr"><?php echo e($patient->patient_job); ?></p>
                <?php else: ?>
                    <p class="  text-gray-900  p-0 m-0" style=" direction:ltr;line-height: 46px;"> ---------------------------------</p>
                <?php endif; ?>
            </div>
            <div class="w-100 text-center d-inline-flex" style="width: 50%;">
                <p class="  text-gray-700 p-0 m-0">العنوان : &nbsp;</p>
                <?php if($patient->patient_address): ?>
                    <p class="  text-gray-900  p-0 m-0" style=" direction:ltr;"><?php echo e($patient->patient_address); ?></p>
                <?php else: ?>
                    <p class="  text-gray-900  p-0 m-0" style=" direction:ltr;line-height: 46px;"> ----------------------------------------</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <hr class="p-0 mb-3 mt-0">


    <div class="table-responsive"  style="border-radius: 10px; border: 1px solid;" >
        <table class="table table-bordered  mb-0">
            <thead>
                <tr >
                    <th  class="border-right-secondary" width="20%">
                        السوابق الجراحية
                    </th >
                    <th  class="border-right-secondary" width="20%">
                        السوابق المرضية
                    </th>
                    <th  class="border-right-secondary" width="20%">
                        السوابق التحسسية
                    </th>
                    <th  class="border-right-secondary" width="20%">
                        الأدوية الدائمة
                    </th>
                    <th  class="border-right-secondary" width="20%">
                        ملاحظات حول المريض
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr style="height: 150px" >
                    <td class="border-right-secondary">
                        <?php echo e($patient->older_surgery); ?>

                    </td>
                    <td  class="border-right-secondary">
                        <?php echo e($patient->older_sicky); ?>

                    </td>
                    <td  class="border-right-secondary">
                        <?php echo e($patient->older_sensitive); ?>

                    </td>
                    <td  class="border-right-secondary">
                        <?php echo e($patient->permanent_medic); ?>

                    </td>
                    <td  class="border-right-secondary">
                        <?php echo e($patient->patient_state); ?>

                    </td>
                </tr>
            </tbody>
        </table>
    </div>


    <hr class="p-0 my-3">

    <?php $__currentLoopData = $patientReviews->whereNull('patient_review_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patientReview): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card my-3" style="border: 2px solid;">
            <div class="card-header p-1">
                <div class=" p-2" style="display:flex">
                    <div class="text-right" style="width:50%;">
                        <h6 class="mt-2"><b>معلومات ال<?php echo e($patientReview->review_type); ?></b></h6>
                    </div>
                    <div class="text-left" style="width:50%;">
                        <p class=" text-xs text-gray-700  p-0 my-0 ml-3">تاريخ ال<?php echo e($patientReview->review_type); ?></p>
                        <p class=" text-xs  text-gray-900  p-0 m-0"><?php echo e($patientReview->created_at->format('D d-m-Y')); ?></p>
                    </div>
                </div>
            </div>
            <div class="card-body p-1">
                <?php if($patientReview->outsideReviews): ?>
                    <div class="card my-2 p-1 border-top-dark border-bottom-dark" >
                        <div class="card-header p-1">
                            <div  style="display:flex">
                                <div class="text-right" style="width:50%;">
                                    <h6 class="mt-2"><b>معلومات ال<?php echo e($patientReview->outsideReviews->review_type); ?> الرئيسية</b></h6>
                                </div>
                                <div class="text-left" style="width:50%;">
                                    <p class=" text-xs text-gray-700  p-0 my-0 ml-3">تاريخ ال<?php echo e($patientReview->outsideReviews->review_type); ?></p>
                                    <p class=" text-xs  text-gray-900  p-0 m-0"><?php echo e($patientReview->outsideReviews->created_at->format('D d-m-Y')); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-6 mb-2">
                                <div class="card  h-100 mb-2 p-1 border-right-secondary" style="border: 1px solid;">
                                    <div class="text-md text-dark text-uppercase mb-1"><b>سبب الزيارة الرئيسي:</b></div>
                                    <?php if($patientReview->outsideReviews->main_complaint): ?>
                                        <div class="h6 mb-0  text-gray-900">
                                            <?php echo e($patientReview->outsideReviews->main_complaint); ?>

                                        </div>

                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-6 mb-2">
                                <div class="card h-100 mb-2 p-1 border-right-secondary"  style="border: 1px solid;">
                                    <div class="text-md text-dark text-uppercase mb-1"><b>القصة المرضية:</b></div>
                                    <?php if($patientReview->outsideReviews->pain_story): ?>
                                        <div class="h6 mb-0  text-gray-900">
                                            <?php echo e($patientReview->outsideReviews->pain_story); ?>

                                        </div>

                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="text-md text-dark text-uppercase mb-1"><b>رأي الطبيب:</b></div>
                        <div class="h6 mb-0  text-gray-900">
                            <?php echo e($patientReview->outsideReviews->medical_report); ?>

                        </div>

                        <div class="text-md text-dark text-uppercase mb-1"><b>خطة العلاج:</b></div>
                        <div class="h6 mb-0  text-gray-900">
                            <?php echo e($patientReview->outsideReviews->treatment_plan); ?>

                        </div>

                    </div>
                <?php endif; ?>
                <div class="form-row">
                    <div class="col-6 mb-2">
                        <div class="card  h-100 mb-2 p-1 border-right-secondary" style="border: 1px solid;">
                            <div class="text-md text-dark text-uppercase mb-1"><b>سبب الزيارة:</b></div>
                            <?php if($patientReview->main_complaint): ?>
                                <div class="h6 mb-0  text-gray-900">
                                    <?php echo e($patientReview->main_complaint); ?>

                                </div>

                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-6 mb-2">
                        <div class="card h-100 mb-2 p-1 border-right-secondary"  style="border: 1px solid;">
                            <div class="text-md text-dark text-uppercase mb-1"><b>القصة المرضية:</b></div>
                            <?php if($patientReview->pain_story): ?>
                                <div class="h6 mb-0  text-gray-900">
                                    <?php echo e($patientReview->pain_story); ?>

                                </div>

                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="card mb-2 p-1 border-right-secondary"  style="border: 1px solid;">
                    <div class="text-md text-dark text-uppercase mb-1"><b>رأي الطبيب:</b></div>
                    <?php if($patientReview->medical_report): ?>
                        <div class="h6 mb-0  text-gray-900">
                            <?php echo e($patientReview->medical_report); ?>

                        </div>

                    <?php endif; ?>
                </div>
                <div class="card mb-2 p-1 border-right-secondary"  style="border: 1px solid;">
                    <div class="text-md text-dark text-uppercase mb-1"><b>خطة العلاج:</b></div>
                    <?php if($patientReview->treatment_plan): ?>
                        <div class="h6 mb-0  text-gray-900">
                            <?php echo e($patientReview->treatment_plan); ?>

                        </div>

                    <?php endif; ?>
                </div>
                <div class="form-row">
                    <div class="col-6 mb-2">
                        <div class="card h-100 mb-2 p-1 border-right-secondary"  style="border: 1px solid;">
                            <div class="text-md text-dark text-uppercase mb-1"><b>نص التحليل:</b></div>
                            <?php if($patientReview->med_analysis_T): ?>
                                <div class="h6 mb-0  text-gray-900">
                                    <?php echo e($patientReview->med_analysis_T); ?>

                                </div>

                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-6 mb-2">
                        <div class="card h-100 mb-2 p-1 border-right-secondary"  style="border: 1px solid;">
                            <div class="text-md text-dark text-uppercase mb-1"><b>محتوى الصورة:</b></div>
                            <?php if($patientReview->med_photo_T): ?>
                                <div class="h6 mb-0  text-gray-900">
                                    <?php echo e($patientReview->med_photo_T); ?>

                                </div>

                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="card mb-2 p-1 border-right-secondary" >
                    <div class="text-md text-dark text-uppercase mb-1"><b>ملاحظات الطبيب:</b></div>
                    <?php if($patientReview->doctor_notes): ?>
                        <div class="h6 mb-0  text-gray-900">
                            <?php echo e($patientReview->doctor_notes); ?>

                        </div>

                    <?php endif; ?>
                </div>
                <?php if($patientReview->insideReviews): ?>
                    <?php $__currentLoopData = $patientReview->insideReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $insideReview): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="card mb-2 p-1 border-top-dark" >
                            <div class="card-header p-1">
                                <div  style="display:flex">
                                    <div class="text-right" style="width:50%;">
                                        <h6 class="mt-2"><b>معلومات ال<?php echo e($insideReview->review_type); ?> التابعة</b></h6>
                                    </div>
                                    <div class="text-left" style="width:50%;">
                                        <p class=" text-xs text-gray-700  p-0 my-0 ml-3">تاريخ ال<?php echo e($insideReview->review_type); ?></p>
                                        <p class=" text-xs  text-gray-900  p-0 m-0"><?php echo e($insideReview->created_at->format('D d-m-Y')); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-6 mb-2">
                                    <div class="card  h-100 mb-2 p-1 border-right-secondary" style="border: 1px solid;">
                                        <div class="text-md text-dark text-uppercase mb-1"><b>سبب الزيارة التابعة:</b></div>
                                        <?php if($insideReview->main_complaint): ?>
                                            <div class="h6 mb-0  text-gray-900">
                                                <?php echo e($insideReview->main_complaint); ?>

                                            </div>

                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-6 mb-2">
                                    <div class="card h-100 mb-2 p-1 border-right-secondary"  style="border: 1px solid;">
                                        <div class="text-md text-dark text-uppercase mb-1"><b>المستجدات المرضية:</b></div>
                                        <?php if($insideReview->pain_story): ?>
                                            <div class="h6 mb-0  text-gray-900">
                                                <?php echo e($insideReview->pain_story); ?>

                                            </div>

                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card h-100 mb-2 p-1 border-right-secondary"  style="border: 1px solid;">
                                <div class="text-md text-dark text-uppercase mb-1"><b>رأي الطبيب:</b></div>
                                <div class="h6 mb-0  text-gray-900">
                                    <?php echo e($insideReview->medical_report); ?>

                                </div>
                            </div>
                            <div class="card h-100 mb-2 p-1 border-right-secondary"  style="border: 1px solid;">
                                <div class="text-md text-dark text-uppercase mb-1"><b>العلاج:</b></div>
                                <div class="h6 mb-0  text-gray-900">
                                    <?php echo e($insideReview->treatment_plan); ?>

                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-6 mb-2">
                                    <div class="card h-100 mb-2 p-1 border-right-secondary"  style="border: 1px solid;">
                                        <div class="text-md text-dark text-uppercase mb-1"><b>نص التحليل الجديد:</b></div>
                                        <?php if($insideReview->med_analysis_T): ?>
                                            <div class="h6 mb-0  text-gray-900">
                                                <?php echo e($insideReview->med_analysis_T); ?>

                                            </div>

                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-6 mb-2">
                                    <div class="card h-100 mb-2 p-1 border-right-secondary"  style="border: 1px solid;">
                                        <div class="text-md text-dark text-uppercase mb-1"><b>محتوى الصورة الجديدة:</b></div>
                                        <?php if($insideReview->med_photo_T): ?>
                                            <div class="h6 mb-0  text-gray-900">
                                                <?php echo e($insideReview->med_photo_T); ?>

                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-10 mb-2">
                                    <div class="card h-100 mb-2 p-1 border-right-secondary"  style="border: 1px solid;">
                                        <div class="text-md text-dark text-uppercase mb-1"><b>ملاحظات الطبيب:</b></div>
                                        <?php if($insideReview->doctor_notes): ?>
                                            <div class="h6 mb-0  text-gray-900">
                                                <?php echo e($insideReview->doctor_notes); ?>

                                            </div>

                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-2 mb-2">
                                    <div class="card h-100 mb-2 p-1 border-right-secondary px-2" style="border: 1px solid;">
                                        <div class="text-center w-100" >
                                            <p class=" text-md text-dark text-uppercase mb-1"><b>تاريخ الموعد القادم</b></p>
                                            <?php if($insideReview->date_expecting): ?>
                                                <p class=" text-xs  text-gray-900  p-0 m-0"><b><?php echo e(Carbon\Carbon::parse($insideReview->date_expecting)->format('D d-m-Y')); ?></b></p>
                                            <?php else: ?>
                                                <p class="  text-gray-900  p-0 m-0" style=" direction:ltr;line-height: 46px;"> ----------------------------</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
            <?php if($patientReview->date_expecting): ?>
                <div class="card-footer p-1">
                    <div class=" px-2" style="display:flex">
                        <div class="text-left w-100" >
                            <p class=" text-xs text-gray-700  p-0 my-0">تاريخ الموعد القادم</p>
                            <p class=" text-xs  text-gray-900  p-0 m-0"><?php echo e(Carbon\Carbon::parse($patientReview->date_expecting)->format('D d-m-Y')); ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>






</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        window.print();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.print', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Projects\xampp\htdocs\MyClinicApp8\resources\views/myClinic/patients/printPatientProfile.blade.php ENDPATH**/ ?>