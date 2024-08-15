<?php $__env->startSection('style'); ?>

<link href="<?php echo e(asset('assets/MyClinicApp/calender/css/tempusdominus-bootstrap-4.css')); ?>" rel="stylesheet">

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<div class=" mb-5 pb-5 ">
    <?php if(count($errors)>0): ?>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="alert alert-secondary" role="alert">
                <?php echo e($item); ?>

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    
    <div class="modal fade" id="calenderModal" tabindex="-1" aria-labelledby="calenderModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-left-primary ">
                <div class="modal-body">
                    <div class="card-body">
                        <div id="calender" style="direction: ltr"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="clinicTasks" tabindex="-1" aria-labelledby="clinicTasks" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-left-primary ">
                <div class="modal-header d-block text-center text-primary p-1">
                    <p class="p-0 m-0"><b>جدول المهام</b> <span>عدد  : ( <?php echo e($tasks->where('forUser_id','<>',auth()->user()->doctor_id)->count()); ?> )</span>

                    <button type="button" style="float:right" class="btn btn-secondary btn-sm p-1" data-dismiss="modal">
                        <i class="fa-solid fa-close fa-lg text-light"></i>
                    </button></p>
                    <p class="text-xs p-0 m-0"><?php echo e(Carbon\Carbon::now()->format('D d-m-Y')); ?></p>

                </div>
                <div class="modal-body p-1" style="direction: ltr">
                    <div class="card-body p-2" >
                        <?php $__empty_1 = true; $__currentLoopData = $tasks->where('forUser_id','<>',auth()->user()->doctor_id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php if($task->read_at == null ): ?>
                                <?php
                                $typetask ='info'
                                ?>
                            <?php else: ?>
                                <?php
                                $typetask ='success'
                                ?>
                            <?php endif; ?>
                            <div class="card border-bottom-<?php echo e($typetask); ?> p-1">
                                <div class="d-flex" >
                                    

                                    <div class="d-block " style="width:100% ; text-align:right;direction: rtl">
                                        <div class="d-inline-flex w-100">
                                            <button type="submit" style="float:right" class="btn btn-primary btn-user text-xs p-1" onclick="document.getElementById('task<?php echo e($task->slug); ?>').submit();">إنجاز</button>
                                            <form id="task<?php echo e($task->slug); ?>" action="<?php echo e(route('Clinic.taskDone',$task->slug)); ?>" method="post" class="d-none">
                                                <?php echo csrf_field(); ?>
                                            </form>
                                            <p class="text-center text-gray-800 p-0 m-0 w-100"><b class="text-xs font-weight-bold text-gray-900">المهمة : </b><?php if($task->forDay): ?>
                                                <span class=" text-xs text-dark"><b> لتاريخ  <?php echo e(\Carbon\Carbon::parse($task->forDay)->format('D d/m/Y - h:i a')); ?></b></span>
                                                <?php endif; ?>
                                            </p>
                                        </div>
                                        <?php if($task->forDay): ?>
                                            <p class=" text-xs text-gray-800 p-0 px-3 mb-2 w-100" style="text-align:left"><?php echo e(\Carbon\Carbon::parse($task->forDay)->diffForHumans()); ?>

                                            </p>
                                        <?php endif; ?>
                                        <p class="text-center text-xs text-gray-800 card p-1 my-1"><b class="text-xs text-gray-900"><?php echo \Illuminate\Support\Str::limit($task->contant, 100 , '...'); ?></b></p>
                                        <div class="d-block text-center" style="width:100% ; text-align:right;direction: rtl">
                                            <p class="text-center text-xs text-gray-800 p-0 m-0"><b class="text-xs text-gray-900">
                                                <?php if($task->forUser_id == null): ?>
                                                    مهمة عامة
                                                <?php else: ?>
                                                    <?php if($task->foruser && $task->foruser->doctor_id == $task->forGroup_id): ?>
                                                        مهمة لـ <?php echo e($task->foruser->name); ?>

                                                    <?php else: ?>
                                                        مهمة لموظف سابق
                                                    <?php endif; ?>

                                                <?php endif; ?>
                                            </b> -
                                            <span class=" text-xs text-dark"><b>وقت الإنشاء : <?php echo e($task->created_at->format('D d/m/Y - h:i a')); ?> </b></span></p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <hr class="my-2">
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="d-flex" >
                                <div class="d-block " style="width:100% ;">
                                    <p class="text-center text-gray-800 p-0 m-0"><b>لا يوجد مهام للتنفيذ</b></p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if(count($tasks->where('forUser_id','<>',auth()->user()->doctor_id))>0): ?>
        <a type="button"  class="btn btn-primary shadow btn-circle rounded-left py-2 px-3"  style="position: fixed;left:0;bottom:50px;overflow:visible;z-index:1;height: 40px"  role="button"  data-toggle="modal" data-target="#clinicTasks">
            <i class="fa-regular fa-clipboard fa-lg text-light"  data-toggle="tooltip" title="مهام العيادة"></i>
        </a>
    <?php endif; ?>
    <a type="button"  class="btn btn-primary shadow btn-circle rounded-left py-2 px-3"  style="position: fixed;left:0;bottom:100px;overflow:visible;z-index:1;height: 40px"  role="button"  data-toggle="modal" data-target="#calenderModal">
        <i class="fa-solid fa-calendar-days fa-lg text-light"  data-toggle="tooltip" title="الروزنامة"></i>
    </a>
    <a type="button"  class="btn btn-primary shadow btn-circle rounded-left py-2 px-3 nav-link"  style="position: fixed;left:0;bottom:150px;overflow:visible;z-index:1;height: 40px;"  role="button"  data-toggle="modal" data-target="#nextReview">
        
        <i class="fa-solid fa-clock-rotate-left fa-lg text-light" style="position:relative"  data-toggle="tooltip" title="المواعيد القادمة"></i>
        <?php if(count($nextReviews) > 0): ?>
            <span class="badge badge-success badge-counter"  style="position: absolute;right: 0;border: 2px solid;font-size: xx-small;">
                <?php echo e(count($nextReviews)); ?>

            </span>
        <?php endif; ?>
    </a>

    <div class="form-row mx-2" style="direction:ltr">

        <div class="col-lg-12">
            <div class="card border-left-primary shadow  my-3" style="min-height: calc(100vh - 80px)" >
                <div class="text-primary py-2 px-3"><b style="float:right">زوار في العيادة   <?php if(count($patientReviews) >0): ?><span class="text-xs" >عدد :  <?php echo e(count($patientReviews)); ?></span> <?php endif; ?></b><b style="float:left"><?php echo e(Carbon\Carbon::now()->format('D d-m-Y')); ?> </b>
                    
                </div><hr class="p-0 m-0">
                <div class="card-body p-2 my-2" style="overflow-y:auto">
                    <?php $__empty_1 = true; $__currentLoopData = $patientReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php if($review->review_type == 'معاينة'): ?>
                            <?php
                            $type ='success'
                            ?>
                        <?php elseif($review->review_type == 'مراجعة'): ?>
                            <?php
                            $type ='warning'
                            ?>
                        <?php elseif($review->review_type == 'اسعافية'): ?>
                            <?php
                            $type ='danger'
                            ?>
                        <?php else: ?>
                            <?php
                            $type ='info'
                            ?>
                        <?php endif; ?>
                        <div class="card border-bottom-<?php echo e($type); ?> p-2">
                            <div class="d-flex" >
                                <div class="d-block " style="width:10% ;float: left">
                                    <!-- Default dropright button -->
                                    <div class="btn-group dropright d-md-block ">
                                        <button type="button"  class="btn btn-light btn-circle btn-sm mb-1 rounded-circle" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-regular fa-lightbulb  fa-xl text-warning"></i>
                                        </button>
                                        <div class="dropdown-menu p-1" style="direction: rtl;text-align:right;width:250px">
                                            معلومات ال<?php echo e($review->review_type); ?> :
                                            <?php if($review->outsideReviews): ?>
                                                <br>عائدة إلى  <?php echo e($review->outsideReviews->review_type); ?>

                                                <br>سبب ال<?php echo e($review->outsideReviews->review_type); ?> السابقة :  <br><?php echo e($review->outsideReviews->main_complaint); ?>

                                                <br>التشخيص :  <br><?php echo e($review->outsideReviews->medical_report); ?>

                                                <?php if($review->outsideReviews->doctor_notes): ?>
                                                    <br>ملاحظات حول الزيارة :  <br><?php echo e($review->outsideReviews->doctor_notes); ?>

                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <br> سبب الزيارة :  <?php echo e($review->main_complaint); ?>

                                            <?php if($review->leave_off == 1): ?> <br> موجود في العيادة <?php else: ?> <br> حجز هاتفي <?php endif; ?>
                                            <br>  الاسم : <?php echo e($review->patient->patient_name); ?>

                                            <?php if($review->patient->age && $review->patient->age != date('Y')): ?> <br> العمر : <?php echo e(date('Y') -$review->patient->age); ?>  <?php endif; ?>
                                            <?php if($review->patient->blood_type): ?> <br> زمرة الدم : <?php echo e($review->patient->blood_type); ?>  <?php endif; ?>
                                            <?php if($review->patient->gender == 'male'): ?> <br> الجنس :  ذكر <?php elseif($review->patient->gender == 'female'): ?> <br> الجنس :  أنثى <?php endif; ?>
                                            <?php if($review->patient->smoking == 'negative'): ?> <br> مدخن :  سلبي <?php elseif($review->patient->smoking == 'positive'): ?> <br> مدخن :  إيجابي <?php endif; ?>
                                            <?php if($review->patient->relationship == 'married'): ?> <br> الحالة الإجتماعية :  متزوج <?php elseif($review->patient->relationship == 'single'): ?> <br> الحالة الإجتماعية :  عازب <?php endif; ?>
                                            <?php if($review->pain_story): ?><br> القصة المرضية :  <?php echo e($review->pain_story); ?>  <?php endif; ?>
                                            <?php if($review->patient->child_count): ?> <br> الأولاد : <?php echo e($review->patient->child_count); ?>  <?php endif; ?>
                                            <?php if($review->patient->older_surgery): ?> <br> السوابق الجراحية :  <?php echo e($review->patient->older_surgery); ?>  <?php endif; ?>
                                            <?php if($review->patient->older_sicky): ?> <br> السوابق المرضية :  <?php echo e($review->patient->older_sicky); ?>  <?php endif; ?>
                                            <?php if($review->patient->older_sensitive): ?> <br> السوابق التحسسية :  <?php echo e($review->patient->older_sensitive); ?>  <?php endif; ?>
                                            <?php if($review->patient->permanent_medic): ?> <br> الأدوية الدائمة :  <?php echo e($review->patient->permanent_medic); ?>  <?php endif; ?>
                                            <?php if($review->patient->patient_state): ?> <br> حول المريض :  <?php echo e($review->patient->patient_state); ?>  <?php endif; ?>
                                            <?php if($review->patient->phone): ?> <br> رقم الهاتف : <?php echo e($review->patient->phone); ?>  <?php endif; ?>
                                        </div>
                                    </div><!-- Default dropright button -->
                                </div>
                                <div class="d-block " style="width:80% ;direction: rtl">

                                    <p class="text-center text-gray-800 p-0 m-0"><a class="text-center text-gray-800 p-0 m-0" href="<?php echo e(route('Clinic.patientProfile',$review->patient->patient_slug)); ?>"><b class="text-xs text-gray-900">اسم المريض: </b><b><?php echo e($review->patient->patient_name); ?></b></a></p>
                                    <p class="text-center text-xs text-gray-800 p-0 m-0"><a class="text-center text-gray-800 p-0 m-0" href="<?php echo e(route('Clinic.patientProfile',$review->patient->patient_slug)); ?>"><b class="text-xs text-gray-900">سبب الزيارة: </b><?php echo \Illuminate\Support\Str::limit($review->main_complaint, 40 , '...'); ?></a></p>
                                    <p class="text-center text-xs text-gray-800 p-0 m-0"><b >وقت الزيارة</b><span> <?php echo e($review->created_at->format('h:i a')); ?></span></p>

                                </div>
                                
                                <div class="d-block "  style="width:10% ">
                                    <?php if(auth()->user()->id == auth()->user()->doctor_id): ?>
                                        <button class="btn btn-primary btn-sm mb-1 rounded-circle" style="float: right"  data-toggle="modal" data-target="#EditReview<?php echo e($review->id); ?>">
                                            <span class="d-none d-lg-block text-xs">تشخيصي</span>
                                            
                                            <i class="fa-solid fa-stethoscope  fa-lg text-light"></i>
                                        </button>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>

                        

                        <!-- Modal Doctor Repory -->
                        <div class="modal fade" id="EditReview<?php echo e($review->id); ?>" tabindex="-1" aria-labelledby="EditReview<?php echo e($review->id); ?>" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-body py-1">
                                        <form action="<?php echo e(route('Clinic.updateReview_doctor',$review->id)); ?>" method="post" enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <div class="d-block py-2" style="width:100% ;direction: rtl">


                                                
                                                <p class="text-center text-gray-800 p-0 m-0"><span class="text-<?php echo e($type); ?> font-weight-bold"><?php echo e($review->review_type); ?> للمريض :  </span><a class="text-center text-gray-800 p-0 m-0" href="<?php echo e(route('Clinic.patientProfile',$review->patient->patient_slug)); ?>"><b><?php echo e($review->patient->patient_name); ?></b></a></p>
                                                <p class="text-center text-xs text-gray-800 p-0 m-0"><a class="text-center text-gray-800 p-0 m-0" href="<?php echo e(route('Clinic.patientProfile',$review->patient->patient_slug)); ?>"><b class="text-xs text-gray-900">وقت الزيارة : </b> <?php echo e($review->created_at->format('D d/m - h:i a')); ?></a></p>
                                                <p class="text-center text-xs text-gray-800 p-0 m-0">سبب الزيارة : <b><?php echo e($review->main_complaint); ?></b></p>
                                            </div>
                                        <hr class="m-0">
                                            <div class="row">
                                                <div class="col-lg-4 bg-new-image"></div>
                                                <div class="col-lg-8">
                                                    <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                        <label class="text-xs">رأي الطبيب : </label>
                                                        <textarea id="editReview-medical_report" class="VoiceToText form-control <?php $__errorArgs = ['medical_report'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="medical_report" rows="3" style="padding: 0.375rem 0.75rem;text-align:center" ><?php echo e($review->medical_report); ?></textarea>
                                                            <?php $__errorArgs = ['medical_report'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                <span class="invalid-feedback text-center" role="alert">
                                                                    <strong ><?php echo e($message); ?></strong>
                                                                </span>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="editReview-medical_report">
                                                            <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                        </button>
                                                    </div>

                                                    <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                        <label class="text-xs">خطة العلاج : </label>
                                                        <textarea id="editReview-treatment_plan" class="VoiceToText form-control <?php $__errorArgs = ['treatment_plan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="treatment_plan" rows="3" style="padding: 0.375rem 0.75rem;text-align:center" ><?php echo e($review->treatment_plan); ?></textarea>
                                                            <?php $__errorArgs = ['treatment_plan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                <span class="invalid-feedback text-center" role="alert">
                                                                    <strong ><?php echo e($message); ?></strong>
                                                                </span>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="editReview-treatment_plan">
                                                            <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                        </button>
                                                    </div>
                                                    <!-- Collapse Modal InsideReviews InsideEmergency -->
                                                    <div class="card mb-2">
                                                        <!-- Card Header - Accordion -->
                                                        <a href="#CollapseEditViewReviewEmergency" class="d-block card-header py-3" data-toggle="collapse" style=""
                                                            role="button" aria-expanded="true" aria-controls="CollapseEditViewReviewEmergency">
                                                            <h6 class="m-0 text-xs font-weight-bold text-gray-600 text-center">المزيد  :
                                                                <span class=" <?php if($review->main_complaint): ?>
                                                                text-primary
                                                                <?php endif; ?>">سبب الزيارة</span>
                                                                - <span class=" <?php if($review->pain_story): ?>
                                                                text-primary
                                                                <?php endif; ?>">القصة المرضية</span>
                                                                - <span class=" <?php if($review->med_analysis_T): ?>
                                                                text-primary
                                                                <?php endif; ?>">نص التحليل</span>
                                                                - <span class=" <?php if($review->med_photo_T): ?>
                                                                text-primary
                                                                <?php endif; ?>">محتوى الصورة</span>
                                                                - <span class=" <?php if($review->doctor_notes): ?>
                                                                text-primary
                                                                <?php endif; ?>">ملاحظات الزيارة</span>
                                                                <?php if(Carbon\Carbon::today() < Carbon\Carbon::parse($review->date_expecting)): ?>
                                                                    - <span class=" <?php if($review->date_expecting): ?>
                                                                        text-primary
                                                                        <?php endif; ?>">
                                                                        <?php if($review->main_complaint ==' - تحديد عملية - تحليل' || $review->main_complaint =='تحديد عملية' || $review->main_complaint ==' - تحديد عملية - صورة - تحليل' || $review->main_complaint ==' - تحديد عملية - صورة'): ?>
                                                                            موعد العملية
                                                                        <?php else: ?>
                                                                            الموعد القادم
                                                                        <?php endif; ?>
                                                                    </span>
                                                                <?php endif; ?>

                                                            </h6>
                                                        </a>
                                                        <!-- Card Content - Collapse -->
                                                        <div class="collapse" id="CollapseEditViewReviewEmergency">
                                                            <div class="card-body px-1 py-1">
                                                                <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                    <label class="text-xs">نص التحليل : </label>
                                                                    <textarea id="editReview-med_analysis_T" class="VoiceToText form-control <?php $__errorArgs = ['med_analysis_T'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="med_analysis_T" rows="1" style="padding: 0.375rem 0.75rem;text-align:center" ><?php echo e($review->med_analysis_T); ?></textarea>
                                                                        <?php $__errorArgs = ['med_analysis_T'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                            <span class="invalid-feedback text-center" role="alert">
                                                                                <strong ><?php echo e($message); ?></strong>
                                                                            </span>
                                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                    <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:39px;" for="editReview-med_analysis_T">
                                                                        <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                    <label class="text-xs">محتوى الصورة : </label>
                                                                    <textarea id="editReview-med_photo_T" class="VoiceToText form-control <?php $__errorArgs = ['med_photo_T'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="med_photo_T" rows="1" style="padding: 0.375rem 0.75rem;text-align:center" ><?php echo e($review->med_photo_T); ?></textarea>
                                                                        <?php $__errorArgs = ['med_photo_T'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                            <span class="invalid-feedback text-center" role="alert">
                                                                                <strong ><?php echo e($message); ?></strong>
                                                                            </span>
                                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                    <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:39px;" for="editReview-med_photo_T">
                                                                        <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="form-group mb-2" style="direction:rtl;text-align:right" >
                                                                    <label class="text-xs">
                                                                        <?php if($review->main_complaint ==' - تحديد عملية - تحليل' || $review->main_complaint =='تحديد عملية' || $review->main_complaint ==' - تحديد عملية - صورة - تحليل' || $review->main_complaint ==' - تحديد عملية - صورة'): ?>
                                                                             موعد العملية
                                                                        <?php else: ?>
                                                                             الموعد القادم
                                                                        <?php endif; ?>
                                                                        : </label>
                                                                    

                                                                        
                                                                    
                                                                    <input type="date" min="<?php echo e(Carbon\Carbon::tomorrow()->format('Y-m-d')); ?>" <?php if($review->date_expecting): ?>
                                                                        value="<?php echo e(Carbon\Carbon::parse($review->date_expecting)->format('Y-m-d')); ?>"
                                                                    <?php endif; ?>  class="form-control <?php $__errorArgs = ['date_expecting'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="date_expecting" style="padding: 0.375rem 0.75rem;height:50px;text-align:center">
                                                                    <?php $__errorArgs = ['date_expecting'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                        <span class="invalid-feedback text-center" role="alert">
                                                                            <strong ><?php echo e($message); ?></strong>
                                                                        </span>
                                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                </div>
                                                                <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                    <label class="text-xs">ملاحظات الزيارة : </label>
                                                                    <textarea id="editReview-doctor_notes" class=" VoiceToText form-control <?php $__errorArgs = ['doctor_notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="doctor_notes" rows="3" style="padding: 0.375rem 0.75rem;text-align:center"><?php echo e($review->doctor_notes); ?></textarea>
                                                                        <?php $__errorArgs = ['doctor_notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                            <span class="invalid-feedback text-center" role="alert">
                                                                                <strong ><?php echo e($message); ?></strong>
                                                                            </span>
                                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                    <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="editReview-doctor_notes">
                                                                        <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                    </button>
                                                                </div>

                                                                
                                                                <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                    <label class="text-xs">القصة المرضية : </label>
                                                                    <textarea id="editReview-pain_story" class=" VoiceToText form-control <?php $__errorArgs = ['pain_story'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="pain_story" rows="3" style="padding: 0.375rem 0.75rem;text-align:center" ><?php echo e($review->pain_story); ?></textarea>
                                                                        <?php $__errorArgs = ['pain_story'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                            <span class="invalid-feedback text-center" role="alert">
                                                                                <strong ><?php echo e($message); ?></strong>
                                                                            </span>
                                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                    <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="editReview-pain_story">
                                                                        <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                    </button>
                                                                </div>

                                                                
                                                                <div class="form-group mb-2" style="direction:ltr;text-align:right" >
                                                                    <label class="text-xs" style="text-align:right;direction: rtl;">صور مرفقة : </label>
                                                                    <input type="file" class="input_image form-control <?php $__errorArgs = ['images'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="images[]" multiple style="padding: 0.375rem 0.75rem;height:50px;text-align:center">
                                                                    <?php $__errorArgs = ['images'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                        <span class="invalid-feedback text-center" role="alert">
                                                                            <strong ><?php echo e($message); ?></strong>
                                                                        </span>
                                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- Collapse Modal View Review Emergency -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer py-1">
                                            <button type="button" class="btn btn-secondary btn-user" data-dismiss="modal">إلغاء</button>
                                            <button type="submit" class="btn btn-primary btn-user">حفظ</button>
                                        </form>
                                        </div>
                                </div>
                            </div>
                        </div><!-- Modal Doctor Repory -->
                        <hr class="my-1">

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="d-flex" >
                            <div class="d-block " style="width:100% ;">
                                <p class="text-center text-gray-800 p-0 m-0"><b>لايوجد</b></p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <!-- Modal Next -->
    <div class="modal fade" id="nextReview" tabindex="-1" aria-labelledby="nextReview" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content" style="width: 95%;height: 95%;">
                <div class="modal-header py-1">
                    <div class="h6 d-flex w-100 text-primary font-weight-bold text-center py-1 px-1" style="text-align: right ;direction:rtl">
                        <?php if(count($nextReviews)>0): ?>
                            - الزيارت القادمة :  ( <?php echo e(count($nextReviews)); ?> )

                        <?php else: ?>
                            لا يوجد بعد
                        <?php endif; ?>
                    </div>
                </div>
                <div class="modal-body py-1" style="direction:ltr;" >
                    <div class="py-2">
                        <?php
                            $pantientNum=count($nextReviews);
                        ?>
                        <?php $__empty_1 = true; $__currentLoopData = $nextReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php if($review->review_type == 'معاينة'): ?>
                                <?php
                                $type ='success'
                                ?>
                            <?php elseif($review->review_type == 'مراجعة'): ?>
                                <?php
                                $type ='warning'
                                ?>
                            <?php elseif($review->review_type == 'اسعافية'): ?>
                                <?php
                                $type ='danger'
                                ?>
                            <?php else: ?>
                                <?php
                                $type ='info'
                                ?>
                            <?php endif; ?>
                            <div class="card bg-gray-200 border-bottom-<?php echo e($type); ?> py-2 px-1">
                                <div class="d-flex" >
                                    <div class="d-block"  style="width:12% ;direction: rtl">

                                        <a class="btn btn-light btn-circle btn-sm" type="button" href="<?php echo e(route('Clinic.destroyReviewEmployee',$review->id)); ?>"  data-toggle="tooltip" title=" حذف الزيارة ">
                                            <i class="fas fa-trash fa-lg text-danger"></i>
                                        </a>
                                    </div>

                                    <div class="d-block " style="width:80% ;direction: rtl">
                                        <p class="text-center text-gray-800 p-0 m-0"><a class="text-center text-gray-800 p-0 m-0" type="button" data-toggle="modal"   data-target="#nextReview<?php echo e($review->id); ?>"><b class="text-xs text-gray-900">اسم المريض: </b><b><?php echo e($review->patient->patient_name); ?></b></a></p>
                                        <p class="text-center text-xs text-gray-800 p-0 m-0"><a class="text-center text-gray-800 p-0 m-0" type="button" data-toggle="modal" data-target="#nextReview<?php echo e($review->id); ?>"><b class="text-xs text-gray-900">سبب الزيارة: </b><?php echo \Illuminate\Support\Str::limit($review->main_complaint, 40 , '...'); ?></a></p>
                                        <p class="text-center font-weight-bold text-gray-800 p-0 m-0"><b >لتاريخ :</b><span> <?php echo e(Carbon\Carbon::parse($review->review_forDay)->format('D d-m-Y')); ?></span></p>
                                    </div>
                                    <div class="d-block " style="width:12%;">
                                        <p class="text-center text-xs text-gray-800 p-0 m-0"><b>#</b></p>
                                        <p class="text-center text-xs text-gray-800 p-0 m-0"><b><?php echo e($pantientNum); ?></b></p>
                                        <!-- Default dropright button -->
                                        <div class="btn-group dropleft text-center d-md-block ">
                                            <button type="button"  class="btn btn-light btn-circle btn-sm mb-1 rounded-circle" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-regular fa-lightbulb  fa-xl text-warning"></i>
                                            </button>
                                            <div class="dropdown-menu p-1" style="direction: rtl;text-align:right;width:250px">
                                                معلومات ال<?php echo e($review->review_type); ?> :
                                                <?php if($review->outsideReviews): ?>
                                                    <br>عائدة إلى  <?php echo e($review->outsideReviews->review_type); ?>

                                                    <br>سبب ال<?php echo e($review->outsideReviews->review_type); ?> السابقة :  <br><?php echo e($review->outsideReviews->main_complaint); ?>

                                                    <br>التشخيص :  <br><?php echo e($review->outsideReviews->medical_report); ?>

                                                    <?php if($review->outsideReviews->doctor_notes): ?>
                                                        <br>ملاحظات حول الزيارة :  <br><?php echo e($review->outsideReviews->doctor_notes); ?>

                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <br> سبب الزيارة :  <?php echo e($review->main_complaint); ?>

                                                <?php if($review->leave_off == 1): ?> <br> موجود في العيادة <?php else: ?> <br> حجز هاتفي <?php endif; ?>
                                                <br>  الاسم : <?php echo e($review->patient->patient_name); ?>

                                                <?php if($review->patient->age && $review->patient->age != date('Y')): ?> <br> العمر : <?php echo e(date('Y') -$review->patient->age); ?>  <?php endif; ?>
                                                <?php if($review->patient->blood_type): ?> <br> زمرة الدم : <?php echo e($review->patient->blood_type); ?>  <?php endif; ?>
                                                <?php if($review->patient->gender == 'male'): ?> <br> الجنس :  ذكر <?php elseif($review->patient->gender == 'female'): ?> <br> الجنس :  أنثى <?php endif; ?>
                                                <?php if($review->patient->smoking == 'negative'): ?> <br> مدخن :  سلبي <?php elseif($review->patient->smoking == 'positive'): ?> <br> مدخن :  إيجابي <?php endif; ?>
                                                <?php if($review->patient->relationship == 'married'): ?> <br> الحالة الإجتماعية :  متزوج <?php elseif($review->patient->relationship == 'single'): ?> <br> الحالة الإجتماعية :  عازب <?php endif; ?>
                                                <?php if($review->pain_story): ?><br> القصة المرضية :  <?php echo e($review->pain_story); ?>  <?php endif; ?>
                                                <?php if($review->patient->child_count): ?> <br> الأولاد : <?php echo e($review->patient->child_count); ?>  <?php endif; ?>
                                                <?php if($review->patient->older_surgery): ?> <br> السوابق الجراحية :  <?php echo e($review->patient->older_surgery); ?>  <?php endif; ?>
                                                <?php if($review->patient->older_sicky): ?> <br> السوابق المرضية :  <?php echo e($review->patient->older_sicky); ?>  <?php endif; ?>
                                                <?php if($review->patient->older_sensitive): ?> <br> السوابق التحسسية :  <?php echo e($review->patient->older_sensitive); ?>  <?php endif; ?>
                                                <?php if($review->patient->permanent_medic): ?> <br> الأدوية الدائمة :  <?php echo e($review->patient->permanent_medic); ?>  <?php endif; ?>
                                                <?php if($review->patient->patient_state): ?> <br> حول المريض :  <?php echo e($review->patient->patient_state); ?>  <?php endif; ?>
                                                <?php if($review->patient->phone): ?> <br> رقم الهاتف : <?php echo e($review->patient->phone); ?>  <?php endif; ?>
                                            </div>
                                        </div><!-- Default dropright button -->
                                    </div>


                                </div>
                            </div>

                            <hr class="my-1">
                            <?php
                            --$pantientNum;
                            ?>
                            <!-- Modal Next -->
                            <div class="modal fade" id="nextReview<?php echo e($review->id); ?>" tabindex="-1" aria-labelledby="nextReview<?php echo e($review->id); ?>" aria-hidden="true">
                                <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header py-1">
                                            <div class="text-center w-100">
                                                <h1 class="h6 font-weight-bold text-gray-900 my-2 text-center" style="direction:rtl;">تعديل على موعد <?php echo e($review->patient->patient_name); ?></h1>
                                            </div>
                                        </div>
                                        <div class="modal-body py-0">
                                            <div class="card-body p-0" style="direction:ltr">
                                                <!-- Nested Row within Card Body -->

                                                <form  class="user" method="POST" action="<?php echo e(route('Clinic.updateReview_insert',$review->id)); ?>">
                                                    <?php echo csrf_field(); ?>
                                                    <div class="form-group mb-3" style="direction: rtl;margin-bottom: 0.5rem;">
                                                        <div class="form-row">
                                                            <div class="form-group mb-2 col-6" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                                <label class="text-xs">تاريخ الحجز القادم :</label>
                                                                <input type="date" min="<?php echo e(Carbon\Carbon::tomorrow()->format('Y-m-d')); ?>"
                                                                class="form-control form-control <?php $__errorArgs = ['review_forDay'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(Carbon\Carbon::parse($review->review_forDay)->format('Y-m-d')); ?>" name="review_forDay" placeholder="حجز موعد"
                                                                    style="padding: 0.375rem 0.75rem;height:38px;text-align:center;font-size: 75%;">
                                                                <?php $__errorArgs = ['review_forDay'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <span class="invalid-feedback text-center" role="alert">
                                                                        <strong ><?php echo e($message); ?></strong>
                                                                    </span>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </div>
                                                            <div class="form-group mb-3 col-6" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                                <div class="custom-radio custom-control-inline">
                                                                    <label class="text-xs mr-3">سبب الزيارة : </label>
                                                                </div>
                                                                <div class="card d-block" style="height: 38px;">
                                                                    <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                                                        <input type="radio" id="editviewNext<?php echo e($review->id); ?>" name="main_complaint[]" <?php if($review->review_type == "معاينة"): ?> checked  <?php endif; ?> value="معاينة جديدة" class="custom-control-input">
                                                                        <label class="text-xs text-success font-weight-bold custom-control-label" for="editviewNext<?php echo e($review->id); ?>" >معاينة</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                                                        <input type="radio" id="editnewreviewNext<?php echo e($review->id); ?>" name="main_complaint[]" <?php if($review->review_type == "مراجعة"): ?> checked  <?php endif; ?>  value="مراجعة" class="custom-control-input">
                                                                        <label class="text-xs text-warning font-weight-bold custom-control-label" for="editnewreviewNext<?php echo e($review->id); ?>" >مراجعة</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-3 position-relative" style="direction: rtl;margin-bottom: 0.5rem;">
                                                            <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">اسم الزائر : </label>
                                                            <input class="VoiceToText form-control <?php $__errorArgs = ['patient_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text" id="patient_nameNext<?php echo e($review->id); ?>" value="<?php echo e($review->patient->patient_name); ?>" name="patient_name" required placeholder=" أكتب الاسم والكنية "
                                                            style="padding: 0.375rem 0.75rem;height:38px;font-size: 75%;text-align:center;">
                                                                <?php $__errorArgs = ['patient_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <span class="invalid-feedback text-center" role="alert">
                                                                        <strong ><?php echo e($message); ?></strong>
                                                                    </span>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:38px;" for="patient_nameNext<?php echo e($review->id); ?>">
                                                                <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                            </button>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group mb-3 col-6" style="direction: rtl;margin-bottom: 0.5rem;">
                                                                <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">رقم الهاتف : </label>
                                                                <input type="tel" class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e($review->patient->phone); ?>" name="phone" placeholder=" أكتب رقم الهاتف"
                                                                style="padding: 0.375rem 0.75rem;height:38px;text-align:center;direction: ltr;font-size: 75%;">
                                                                <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <span class="invalid-feedback text-center" role="alert">
                                                                        <strong ><?php echo e($message); ?></strong>
                                                                    </span>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </div>
                                                            <div class="form-group mb-3 col-6" style="direction: rtl;margin-bottom: 0.5rem;">
                                                                <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">العمر : </label>
                                                                <input type="tel" max="99" min="1" class="form-control form-control <?php $__errorArgs = ['age'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(date('Y') -$review->patient->age); ?>" name="age" placeholder="1~99"
                                                                    style="padding: 0.375rem 0.75rem;height:38px;text-align:center;font-size: 75%;">
                                                                <?php $__errorArgs = ['age'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <span class="invalid-feedback text-center" role="alert">
                                                                        <strong ><?php echo e($message); ?></strong>
                                                                    </span>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </div>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="form-group mb-3 col-6" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                                <div class="custom-radio custom-control-inline">
                                                                    <label class="text-xs mr-3">الجنس : </label>
                                                                </div>
                                                                <div class="card d-block" style="height: 38px">
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="editgenderMaleNext<?php echo e($review->id); ?>" name="gender" <?php if($review->patient->gender == 'male'): ?> checked  <?php endif; ?>  value="male" class="custom-control-input">
                                                                        <label class="text-xs custom-control-label" for="editgenderMaleNext<?php echo e($review->id); ?>">ذكر</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="editgenderFemaleNext<?php echo e($review->id); ?>" name="gender" <?php if($review->patient->gender == 'female'): ?> checked  <?php endif; ?>  value="female" class="custom-control-input">
                                                                        <label class="text-xs custom-control-label" for="editgenderFemaleNext<?php echo e($review->id); ?>">أنثى</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-2 col-6" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                                <div class="custom-radio custom-control-inline">
                                                                    <label class="text-xs mr-3">التدخين : </label>
                                                                </div>
                                                                <div class="card d-block" style="height: 38px">
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="editnegativeNext<?php echo e($review->id); ?>" name="smoking" value="negative" <?php if($review->patient->smoking == 'negative'): ?> checked  <?php endif; ?> class="custom-control-input">
                                                                        <label class="text-xs custom-control-label" for="editnegativeNext<?php echo e($review->id); ?>">سلبي</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="editpositiveNext<?php echo e($review->id); ?>" name="smoking"  value="positive" <?php if( $review->patient->smoking == 'positive'): ?> checked  <?php endif; ?> class="custom-control-input">
                                                                        <label class="text-xs custom-control-label" for="editpositiveNext<?php echo e($review->id); ?>">إيجابي</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- collapseCardMoreDetailsPatients -->
                                                        <div class="card mb-1">
                                                            <!-- Card Header - Accordion -->
                                                            <a href="#collapseCardMoreDetailsNextReview<?php echo e($review->id); ?>" class="d-block card-header py-3" data-toggle="collapse" style=""
                                                                role="button" aria-expanded="true" aria-controls="collapseCardMoreDetailsNextReview<?php echo e($review->id); ?>">
                                                                <h6 class="m-0 text-xs font-weight-bold text-primary text-center">المزيد ...</h6>
                                                            </a>
                                                            <!-- Card Content - Collapse -->
                                                            <div class="collapse" id="collapseCardMoreDetailsNextReview<?php echo e($review->id); ?>">
                                                                <div class="card-body px-1 py-3">
                                                                    <div class="form-row">
                                                                        <div class="form-group mb-2 col-6" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                                            <label class="text-xs mb-0 mr-3" style="padding-bottom: 0.2rem;text-align:right;direction:rtl;">الحالة الإجتماعية : </label>
                                                                            <div class="card d-block" style="height: 38px">
                                                                                <div class="custom-control custom-radio custom-control-inline">
                                                                                    <input type="radio" id="editRelationshipMarriedNext<?php echo e($review->id); ?>" name="relationship" value="married" <?php if( $review->patient->relationship == 'married'): ?> checked  <?php endif; ?>  class="custom-control-input">
                                                                                    <label class="text-xs custom-control-label" for="editRelationshipMarriedNext<?php echo e($review->id); ?>">متزوج</label>
                                                                                </div>
                                                                                <div class="custom-control custom-radio custom-control-inline">
                                                                                    <input type="radio" id="editRelationshipSingleNext<?php echo e($review->id); ?>" name="relationship"  value="single" <?php if( $review->patient->relationship == 'single'): ?> checked  <?php endif; ?> class="custom-control-input">
                                                                                    <label class="text-xs custom-control-label" for="editRelationshipSingleNext<?php echo e($review->id); ?>">أعزب</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group mb-2 col-6" style="direction: rtl;margin-bottom: 0.5rem;">
                                                                            <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">عدد الأولاد : </label>
                                                                            <input type="tel" max="20" min="0" class="form-control form-control <?php $__errorArgs = ['child_count'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e($review->patient->child_count); ?>" name="child_count"
                                                                                style="padding: 0.375rem 0.75rem;height:38px;text-align:center;font-size: 75%;">
                                                                            <?php $__errorArgs = ['child_count'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                                <span class="invalid-feedback text-center" role="alert">
                                                                                    <strong ><?php echo e($message); ?></strong>
                                                                                </span>
                                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="form-group mb-2 col-md-6 col-sm-12 position-relative" style="direction: rtl;margin-bottom: 0.5rem;">
                                                                            <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">المهنة : </label>
                                                                            <input type="text"class="VoiceToText form-control form-control <?php $__errorArgs = ['patient_job'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e($review->patient->patient_job); ?>" id="patient_jobNext<?php echo e($review->id); ?>" name="patient_job"
                                                                                style="padding: 0.375rem 0.75rem;height:38px;text-align:center;font-size: 75%;">
                                                                                <?php $__errorArgs = ['patient_job'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                                    <span class="invalid-feedback text-center" role="alert">
                                                                                        <strong ><?php echo e($message); ?></strong>
                                                                                    </span>
                                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                            <button class="btn btn-white speake" type="button" style="position:absolute;right:4px; bottom:0;height:38px;" for="patient_jobNext<?php echo e($review->id); ?>">
                                                                                <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                            </button>
                                                                        </div>
                                                                            <div class="form-group mb-2 col-md-6 col-sm-12 position-relative" style="direction: rtl;margin-bottom: 0.5rem;">
                                                                            <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">العنوان : </label>
                                                                            <input type="text" class="VoiceToText form-control <?php $__errorArgs = ['patient_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="patient_addressNext<?php echo e($review->id); ?>" value="<?php echo e($review->patient->patient_address); ?>" name="patient_address"
                                                                            style="padding: 0.375rem 0.75rem;height:38px;text-align:center;direction: ltr;font-size: 75%;">
                                                                            <?php $__errorArgs = ['patient_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                                <span class="invalid-feedback text-center" role="alert">
                                                                                    <strong ><?php echo e($message); ?></strong>
                                                                                </span>
                                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                            <button class="btn btn-white speake" type="button" style="position:absolute;right:4px; bottom:0;height:38px;" for="patient_addressNext<?php echo e($review->id); ?>">
                                                                                <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group mb-2"  style="direction:rtl;margin-bottom: 0.5rem;">
                                                                        <label class="text-xs mr-3" style="text-align:right;float: right; direction:rtl;">السوابق الجراحية : </label>
                                                                        <textarea  class="form-control" name="older_surgery" rows="2" style="height:38px;font-size: 75%;padding: 0.375rem 0.75rem;text-align:center"
                                                                            placeholder=" أكتب السوابق الجراحية في حال وجودها"><?php echo e($review->patient->older_surgery); ?></textarea>
                                                                    </div>
                                                                    <div class="form-group mb-2"  style="direction:rtl;margin-bottom: 0.5rem;">
                                                                        <label class="text-xs mr-3" style="text-align:right;float: right; direction:rtl;">السوابق المرضية : </label>
                                                                        <textarea  class="form-control" name="older_sicky" rows="2" style="padding: 0.375rem 0.75rem;text-align:center;height:38px;font-size: 75%"
                                                                            placeholder=" أكتب السوابق المرضية في حال وجودها"><?php echo e($review->patient->older_sicky); ?></textarea>
                                                                    </div>
                                                                    <div class="form-group mb-2"  style="direction:rtl;margin-bottom: 0.5rem;">
                                                                        <label class="text-xs mr-3" style="text-align:right;float: right; direction:rtl;">السوابق التحسسية : </label>
                                                                        <textarea  class="form-control" name="older_sensitive" rows="2" style="padding: 0.375rem 0.75rem;text-align:center;height:38px;font-size: 75%"
                                                                            placeholder=" أكتب السوابق التحسسية في حال وجودها"><?php echo e($review->patient->older_sensitive); ?></textarea>
                                                                    </div>
                                                                    <div class="form-group mb-2"  style="direction:rtl;margin-bottom: 0.5rem;">
                                                                        <label class="text-xs mr-3" style="text-align:right;float: right; direction:rtl;">الأدوية الدائمة : </label>
                                                                        <textarea  class="form-control" name="permanent_medic" rows="1" style="height:38px;font-size: 75%;padding: 0.375rem 0.75rem;text-align:center"
                                                                            placeholder=" أكتب الأدوية الدائمة في حال وجودها"><?php echo e($review->patient->permanent_medic); ?></textarea>
                                                                    </div>
                                                                    <div class="form-group mb-2"  style="direction:rtl;margin-bottom: 0.5rem;">
                                                                        <label class="text-xs mr-3" style="text-align:right;float: right; direction:rtl;">ملاحظات حول المريض : </label>
                                                                        <input type="text" class="form-control " name="patient_state" value="<?php echo e($review->patient->patient_state); ?>" placeholder=" أكتب ملاحظات في حال وجودها"
                                                                            style="padding: 0.375rem 0.75rem;height:38px;font-size: 75%;text-align:center">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><!-- collapseCardMoreDetails -->
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer p-2">
                                            <button type="submit" class="btn btn-primary btn-user">تعديل</button>
                                            <a class="btn btn-secondary btn-user" role="button" data-toggle="modal"  data-dismiss="modal" data-target="#nextReview">عودة</a>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- Modal Next -->
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p class="text-center "> لا يوجد بعد</p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="modal-footer py-1" style="direction:ltr">
                    <button type="button" style="float: right" class="btn btn-primary btn-user" data-dismiss="modal">عودة</button>
                </div>
            </div>
        </div>
    </div><!-- Modal Next -->

        
        

    </div>
    <div class="form-row align-items-center justify-content-center mx-2" style="direction:ltr">
        <?php if($patientReviews->where('review_type','معاينة')->count()>0): ?>
            <div class="col-lg-6">
                <div class="card border-bottom-success shadow  mb-4"  style="height: 300px">
                    <div class="card-header py-2">
                        <p class="text-center text-success p-0 m-0"><b>المعاينات </b><span class="text-xs" >عدد :  <?php echo e(count($patientReviews->where('review_type','معاينة'))); ?></span></p>
                    </div>
                    <div class="card-body p-2 my-2" style="overflow-y:auto">
                        <?php $__empty_1 = true; $__currentLoopData = $patientReviews->where('review_type','معاينة'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="card border-right-success p-2">
                                <div class="d-flex" >
                                    <div class="d-block " style="width:5%; ;float: left">
                                        <!-- Default dropright button -->
                                        <div class="btn-group dropright d-md-block ">
                                            <button type="button"  class="btn btn-light btn-circle btn-sm mb-1 rounded-circle" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-regular fa-lightbulb  fa-xl text-warning"></i>
                                            </button>
                                            <div class="dropdown-menu p-1" style="direction: rtl;text-align:right;width:250px">
                                                معلومات ال<?php echo e($review->review_type); ?> :
                                                <?php if($review->outsideReviews): ?>
                                                    <br>عائدة إلى  <?php echo e($review->outsideReviews->review_type); ?>

                                                    <br>سبب ال<?php echo e($review->outsideReviews->review_type); ?> السابقة :  <br><?php echo e($review->outsideReviews->main_complaint); ?>

                                                    <br>التشخيص :  <br><?php echo e($review->outsideReviews->medical_report); ?>

                                                    <?php if($review->outsideReviews->doctor_notes): ?>
                                                        <br>ملاحظات حول الزيارة :  <br><?php echo e($review->outsideReviews->doctor_notes); ?>

                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <br> سبب الزيارة :  <?php echo e($review->main_complaint); ?>

                                                <?php if($review->leave_off == 1): ?> <br> موجود في العيادة <?php else: ?> <br> حجز هاتفي <?php endif; ?>
                                                <br>  الاسم : <?php echo e($review->patient->patient_name); ?>

                                                <?php if($review->patient->age && $review->patient->age != date('Y')): ?> <br> العمر : <?php echo e(date('Y') - $review->patient->age); ?>  <?php endif; ?>
                                                <?php if($review->patient->blood_type): ?> <br> زمرة الدم : <?php echo e($review->patient->blood_type); ?>  <?php endif; ?>
                                                <?php if($review->patient->gender == 'male'): ?> <br> الجنس :  ذكر <?php elseif($review->patient->gender == 'female'): ?> <br> الجنس :  أنثى <?php endif; ?>
                                                <?php if($review->patient->smoking == 'negative'): ?> <br> مدخن :  سلبي <?php elseif($review->patient->smoking == 'positive'): ?> <br> مدخن :  إيجابي <?php endif; ?>
                                                <?php if($review->patient->relationship == 'married'): ?> <br> الحالة الإجتماعية :  متزوج <?php elseif($review->patient->relationship == 'single'): ?> <br> الحالة الإجتماعية :  عازب <?php endif; ?>
                                                <?php if($review->pain_story): ?><br> القصة المرضية :  <?php echo e($review->pain_story); ?>  <?php endif; ?>
                                                <?php if($review->patient->child_count): ?> <br> الأولاد : <?php echo e($review->patient->child_count); ?>  <?php endif; ?>
                                                <?php if($review->patient->older_surgery): ?> <br> السوابق الجراحية :  <?php echo e($review->patient->older_surgery); ?>  <?php endif; ?>
                                                <?php if($review->patient->older_sicky): ?> <br> السوابق المرضية :  <?php echo e($review->patient->older_sicky); ?>  <?php endif; ?>
                                                <?php if($review->patient->older_sensitive): ?> <br> السوابق التحسسية :  <?php echo e($review->patient->older_sensitive); ?>  <?php endif; ?>
                                                <?php if($review->patient->permanent_medic): ?> <br> الأدوية الدائمة :  <?php echo e($review->patient->permanent_medic); ?>  <?php endif; ?>
                                                <?php if($review->patient->patient_state): ?> <br> حول المريض :  <?php echo e($review->patient->patient_state); ?>  <?php endif; ?>
                                                <?php if($review->patient->phone): ?> <br> رقم الهاتف : <?php echo e($review->patient->phone); ?>  <?php endif; ?>
                                            </div>
                                        </div><!-- Default dropright button -->
                                    </div>
                                    <div class="d-block px-1 text-center" style="width:80% ;">
                                        <p class="text-xs text-gray-900 p-0 m-0" style="direction:rtl"><a href="<?php echo e(route('Clinic.patientProfile',$review->patient->patient_slug)); ?>"><b>اسم الزائر :  <?php echo e($review->patient->patient_name); ?></b></a></p>
                                        <p class="text-xs text-gray-800 p-0 m-0" style="direction:rtl"><a href="<?php echo e(route('Clinic.patientProfile',$review->patient->patient_slug)); ?>"><b>سبب الزيارة :  </b><?php echo \Illuminate\Support\Str::limit($review->main_complaint, 40 , '...'); ?></a></p>
                                        <?php if($review->pain_story): ?>
                                            <p class="text-xs text-gray-800 p-0 m-0" style="direction:rtl"><a href="<?php echo e(route('Clinic.patientProfile',$review->patient->patient_slug)); ?>"><b>القصة المرضية  :  </b><?php echo \Illuminate\Support\Str::limit($review->pain_story, 40 , '...'); ?></a></p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="d-block " style="width:17%;">
                                        <p class="text-center text-xs text-gray-800 p-0 m-0"><b>وقت الزيارة</b></p>
                                        <p class="text-center text-xs text-gray-800 p-0 m-0"><?php echo e($review->created_at->format('h:i a')); ?></p>
                                        <p class="text-center text-xs text-gray-800 p-0 m-0"><?php echo e($review->created_at->format('D d-m-Y')); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if($patientReviews->where('review_type','مراجعة')->count()>0): ?>
            <div class="col-lg-6">
                <div class="card border-bottom-warning shadow  mb-4"  style="height: 300px">
                    <div class="card-header py-2">
                        <p class="text-center text-warning p-0 m-0"><b>المراجعات </b><span class="text-xs" >عدد :  <?php echo e(count($patientReviews->where('review_type','مراجعة'))); ?></span></p>
                    </div>
                    <div class="card-body p-2 my-2" style="overflow-y:auto">
                        <?php $__empty_1 = true; $__currentLoopData = $patientReviews->where('review_type','مراجعة'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="card border-right-warning p-2">
                                <div class="d-flex" >
                                    <div class="d-block " style="width:5%; ;float: left">
                                        <!-- Default dropright button -->
                                        <div class="btn-group dropright d-md-block ">
                                            <button type="button"  class="btn btn-light btn-circle btn-sm mb-1 rounded-circle" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-regular fa-lightbulb  fa-xl text-warning"></i>
                                            </button>
                                            <div class="dropdown-menu p-1" style="direction: rtl;text-align:right;width:250px">
                                                معلومات ال<?php echo e($review->review_type); ?> :
                                                <?php if($review->outsideReviews): ?>
                                                    <br>عائدة إلى  <?php echo e($review->outsideReviews->review_type); ?>

                                                    <br>سبب ال<?php echo e($review->outsideReviews->review_type); ?> السابقة :  <br><?php echo e($review->outsideReviews->main_complaint); ?>

                                                    <br>التشخيص :  <br><?php echo e($review->outsideReviews->medical_report); ?>

                                                    <?php if($review->outsideReviews->doctor_notes): ?>
                                                        <br>ملاحظات حول الزيارة :  <br><?php echo e($review->outsideReviews->doctor_notes); ?>

                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <br> سبب الزيارة :  <?php echo e($review->main_complaint); ?>

                                                <?php if($review->leave_off == 1): ?> <br> موجود في العيادة <?php else: ?> <br> حجز هاتفي <?php endif; ?>
                                                <br>  الاسم : <?php echo e($review->patient->patient_name); ?>

                                                <?php if($review->patient->age && $review->patient->age != date('Y')): ?> <br> العمر : <?php echo e(date('Y') - $review->patient->age); ?>  <?php endif; ?>
                                                <?php if($review->patient->blood_type): ?> <br> زمرة الدم : <?php echo e($review->patient->blood_type); ?>  <?php endif; ?>
                                                <?php if($review->patient->gender == 'male'): ?> <br> الجنس :  ذكر <?php elseif($review->patient->gender == 'female'): ?> <br> الجنس :  أنثى <?php endif; ?>
                                                <?php if($review->patient->smoking == 'negative'): ?> <br> مدخن :  سلبي <?php elseif($review->patient->smoking == 'positive'): ?> <br> مدخن :  إيجابي <?php endif; ?>
                                                <?php if($review->patient->relationship == 'married'): ?> <br> الحالة الإجتماعية :  متزوج <?php elseif($review->patient->relationship == 'single'): ?> <br> الحالة الإجتماعية :  عازب <?php endif; ?>
                                                <?php if($review->pain_story): ?><br> القصة المرضية :  <?php echo e($review->pain_story); ?>  <?php endif; ?>
                                                <?php if($review->patient->child_count): ?> <br> الأولاد : <?php echo e($review->patient->child_count); ?>  <?php endif; ?>
                                                <?php if($review->patient->older_surgery): ?> <br> السوابق الجراحية :  <?php echo e($review->patient->older_surgery); ?>  <?php endif; ?>
                                                <?php if($review->patient->older_sicky): ?> <br> السوابق المرضية :  <?php echo e($review->patient->older_sicky); ?>  <?php endif; ?>
                                                <?php if($review->patient->older_sensitive): ?> <br> السوابق التحسسية :  <?php echo e($review->patient->older_sensitive); ?>  <?php endif; ?>
                                                <?php if($review->patient->permanent_medic): ?> <br> الأدوية الدائمة :  <?php echo e($review->patient->permanent_medic); ?>  <?php endif; ?>
                                                <?php if($review->patient->patient_state): ?> <br> حول المريض :  <?php echo e($review->patient->patient_state); ?>  <?php endif; ?>
                                                <?php if($review->patient->phone): ?> <br> رقم الهاتف : <?php echo e($review->patient->phone); ?>  <?php endif; ?>
                                            </div>
                                        </div><!-- Default dropright button -->
                                    </div>
                                    <div class="d-block px-1 text-center" style="width:80% ;">
                                        <p class="text-xs text-gray-900 p-0 m-0" style="direction:rtl"><a href="<?php echo e(route('Clinic.patientProfile',$review->patient->patient_slug)); ?>"><b>اسم الزائر :  <?php echo e($review->patient->patient_name); ?></b></a></p>
                                        <p class="text-xs text-gray-800 p-0 m-0" style="direction:rtl"><a href="<?php echo e(route('Clinic.patientProfile',$review->patient->patient_slug)); ?>"><b>سبب الزيارة :  </b><?php echo \Illuminate\Support\Str::limit($review->main_complaint, 40 , '...'); ?></a></p>
                                        <?php if($review->pain_story): ?>
                                            <p class="text-xs text-gray-800 p-0 m-0" style="direction:rtl"><a href="<?php echo e(route('Clinic.patientProfile',$review->patient->patient_slug)); ?>"><b>الأعراض الجديدة :  </b><?php echo \Illuminate\Support\Str::limit($review->pain_story, 40 , '...'); ?></a></p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="d-block " style="width:17%;">
                                        <p class="text-center text-xs text-gray-800 p-0 m-0"><b>وقت الزيارة</b></p>
                                        <p class="text-center text-xs text-gray-800 p-0 m-0"><?php echo e($review->created_at->format('h:i a')); ?></p>
                                        <p class="text-center text-xs text-gray-800 p-0 m-0"><?php echo e($review->created_at->format('D d-m-Y')); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if($patientReviews->where('review_type','اسعافية')->count()>0): ?>
            <div class="col-lg-6">
                <div class="card border-bottom-danger shadow  mb-4"  style="height: 300px">
                    <div class="card-header py-2">
                        <p class="text-center text-danger p-0 m-0"><b>الإسعافيات </b><span class="text-xs" >عدد :  <?php echo e(count($patientReviews->where('review_type','اسعافية'))); ?></span></p>
                    </div>
                    <div class="card-body p-2 my-2" style="overflow-y:auto">
                        <?php $__empty_1 = true; $__currentLoopData = $patientReviews->where('review_type','اسعافية'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="card border-right-danger p-2">
                                <div class="d-flex" >
                                    <div class="d-block " style="width:5%; ;float: left">
                                        <!-- Default dropright button -->
                                        <div class="btn-group dropright d-md-block ">
                                            <button type="button"  class="btn btn-light btn-circle btn-sm mb-1 rounded-circle" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-regular fa-lightbulb  fa-xl text-warning"></i>
                                            </button>
                                            <div class="dropdown-menu p-1" style="direction: rtl;text-align:right;width:250px">
                                                معلومات ال<?php echo e($review->review_type); ?> :
                                                <?php if($review->outsideReviews): ?>
                                                    <br>عائدة إلى  <?php echo e($review->outsideReviews->review_type); ?>

                                                    <br>سبب ال<?php echo e($review->outsideReviews->review_type); ?> السابقة :  <br><?php echo e($review->outsideReviews->main_complaint); ?>

                                                    <br>التشخيص :  <br><?php echo e($review->outsideReviews->medical_report); ?>

                                                    <?php if($review->outsideReviews->doctor_notes): ?>
                                                        <br>ملاحظات حول الزيارة :  <br><?php echo e($review->outsideReviews->doctor_notes); ?>

                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <br> سبب الزيارة :  <?php echo e($review->main_complaint); ?>

                                                <?php if($review->leave_off == 1): ?> <br> موجود في العيادة <?php else: ?> <br> حجز هاتفي <?php endif; ?>
                                                <br>  الاسم : <?php echo e($review->patient->patient_name); ?>

                                                <?php if($review->patient->age && $review->patient->age != date('Y')): ?> <br> العمر : <?php echo e(date('Y') -$review->patient->age); ?>  <?php endif; ?>
                                                <?php if($review->patient->blood_type): ?> <br> زمرة الدم : <?php echo e($review->patient->blood_type); ?>  <?php endif; ?>
                                                <?php if($review->patient->gender == 'male'): ?> <br> الجنس :  ذكر <?php elseif($review->patient->gender == 'female'): ?> <br> الجنس :  أنثى <?php endif; ?>
                                                <?php if($review->patient->smoking == 'negative'): ?> <br> مدخن :  سلبي <?php elseif($review->patient->smoking == 'positive'): ?> <br> مدخن :  إيجابي <?php endif; ?>
                                                <?php if($review->patient->relationship == 'married'): ?> <br> الحالة الإجتماعية :  متزوج <?php elseif($review->patient->relationship == 'single'): ?> <br> الحالة الإجتماعية :  عازب <?php endif; ?>
                                                <?php if($review->pain_story): ?><br> القصة المرضية :  <?php echo e($review->pain_story); ?>  <?php endif; ?>
                                                <?php if($review->patient->child_count): ?> <br> الأولاد : <?php echo e($review->patient->child_count); ?>  <?php endif; ?>
                                                <?php if($review->patient->older_surgery): ?> <br> السوابق الجراحية :  <?php echo e($review->patient->older_surgery); ?>  <?php endif; ?>
                                                <?php if($review->patient->older_sicky): ?> <br> السوابق المرضية :  <?php echo e($review->patient->older_sicky); ?>  <?php endif; ?>
                                                <?php if($review->patient->older_sensitive): ?> <br> السوابق التحسسية :  <?php echo e($review->patient->older_sensitive); ?>  <?php endif; ?>
                                                <?php if($review->patient->permanent_medic): ?> <br> الأدوية الدائمة :  <?php echo e($review->patient->permanent_medic); ?>  <?php endif; ?>
                                                <?php if($review->patient->patient_state): ?> <br> حول المريض :  <?php echo e($review->patient->patient_state); ?>  <?php endif; ?>
                                                <?php if($review->patient->phone): ?> <br> رقم الهاتف : <?php echo e($review->patient->phone); ?>  <?php endif; ?>
                                            </div>
                                        </div><!-- Default dropright button -->
                                    </div>
                                    <div class="d-block px-1 text-center" style="width:80% ;">
                                        <p class="text-xs text-gray-900 p-0 m-0" style="direction:rtl"><a href="<?php echo e(route('Clinic.patientProfile',$review->patient->patient_slug)); ?>"><b>اسم الزائر :  <?php echo e($review->patient->patient_name); ?></b></a></p>
                                        <p class="text-xs text-gray-800 p-0 m-0" style="direction:rtl"><a href="<?php echo e(route('Clinic.patientProfile',$review->patient->patient_slug)); ?>"><b>سبب الزيارة :  </b><?php echo \Illuminate\Support\Str::limit($review->main_complaint, 40 , '...'); ?></a></p>
                                        <?php if($review->pain_story): ?>
                                            <p class="text-xs text-gray-800 p-0 m-0" style="direction:rtl"><a href="<?php echo e(route('Clinic.patientProfile',$review->patient->patient_slug)); ?>"><b>الأعراض :  </b><?php echo \Illuminate\Support\Str::limit($review->pain_story, 40 , '...'); ?></a></p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="d-block " style="width:17%;">
                                        <p class="text-center text-xs text-gray-800 p-0 m-0"><b>وقت الزيارة</b></p>
                                        <p class="text-center text-xs text-gray-800 p-0 m-0"><?php echo e($review->created_at->format('h:i a')); ?></p>
                                        <p class="text-center text-xs text-gray-800 p-0 m-0"><?php echo e($review->created_at->format('D d-m-Y')); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if($patientReviews->where('review_type','زيارة')->count()>0): ?>
            <div class="col-lg-6">
                <div class="card border-bottom-info shadow  mb-4"  style="height: 300px">
                    <div class="card-header py-2">
                        <p class="text-center text-info p-0 m-0"><b>الزيارات </b><span class="text-xs" >عدد :  <?php echo e(count($patientReviews->where('review_type','زيارة'))); ?></span></p>
                    </div>
                    <div class="card-body p-2 my-2" style="overflow-y:auto">
                        <?php $__empty_1 = true; $__currentLoopData = $patientReviews->where('review_type','زيارة'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="card border-right-info p-2">
                                <div class="d-flex" >
                                    <div class="d-block " style="width:5%; ;float: left">
                                        <!-- Default dropright button -->
                                        <div class="btn-group dropright d-md-block ">
                                            <button type="button"  class="btn btn-light btn-circle btn-sm mb-1 rounded-circle" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-regular fa-lightbulb  fa-xl text-warning"></i>
                                            </button>
                                            <div class="dropdown-menu p-1" style="direction: rtl;text-align:right;width:250px">
                                                معلومات ال<?php echo e($review->review_type); ?> :
                                                <?php if($review->outsideReviews): ?>
                                                    <br>عائدة إلى  <?php echo e($review->outsideReviews->review_type); ?>

                                                    <br>سبب ال<?php echo e($review->outsideReviews->review_type); ?> السابقة :  <br><?php echo e($review->outsideReviews->main_complaint); ?>

                                                    <br>التشخيص :  <br><?php echo e($review->outsideReviews->medical_report); ?>

                                                    <?php if($review->outsideReviews->doctor_notes): ?>
                                                        <br>ملاحظات حول الزيارة :  <br><?php echo e($review->outsideReviews->doctor_notes); ?>

                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <br> سبب الزيارة :  <?php echo e($review->main_complaint); ?>

                                                <?php if($review->leave_off == 1): ?> <br> موجود في العيادة <?php else: ?> <br> حجز هاتفي <?php endif; ?>
                                                <br>  الاسم : <?php echo e($review->patient->patient_name); ?>

                                                <?php if($review->patient->age && $review->patient->age != date('Y')): ?> <br> العمر : <?php echo e(date('Y') -$review->patient->age); ?>  <?php endif; ?>
                                                <?php if($review->patient->blood_type): ?> <br> زمرة الدم : <?php echo e($review->patient->blood_type); ?>  <?php endif; ?>
                                                <?php if($review->patient->gender == 'male'): ?> <br> الجنس :  ذكر <?php elseif($review->patient->gender == 'female'): ?> <br> الجنس :  أنثى <?php endif; ?>
                                                <?php if($review->patient->smoking == 'negative'): ?> <br> مدخن :  سلبي <?php elseif($review->patient->smoking == 'positive'): ?> <br> مدخن :  إيجابي <?php endif; ?>
                                                <?php if($review->patient->relationship == 'married'): ?> <br> الحالة الإجتماعية :  متزوج <?php elseif($review->patient->relationship == 'single'): ?> <br> الحالة الإجتماعية :  عازب <?php endif; ?>
                                                <?php if($review->pain_story): ?><br> القصة المرضية :  <?php echo e($review->pain_story); ?>  <?php endif; ?>
                                                <?php if($review->patient->child_count): ?> <br> الأولاد : <?php echo e($review->patient->child_count); ?>  <?php endif; ?>
                                                <?php if($review->patient->older_surgery): ?> <br> السوابق الجراحية :  <?php echo e($review->patient->older_surgery); ?>  <?php endif; ?>
                                                <?php if($review->patient->older_sicky): ?> <br> السوابق المرضية :  <?php echo e($review->patient->older_sicky); ?>  <?php endif; ?>
                                                <?php if($review->patient->older_sensitive): ?> <br> السوابق التحسسية :  <?php echo e($review->patient->older_sensitive); ?>  <?php endif; ?>
                                                <?php if($review->patient->permanent_medic): ?> <br> الأدوية الدائمة :  <?php echo e($review->patient->permanent_medic); ?>  <?php endif; ?>
                                                <?php if($review->patient->patient_state): ?> <br> حول المريض :  <?php echo e($review->patient->patient_state); ?>  <?php endif; ?>
                                                <?php if($review->patient->phone): ?> <br> رقم الهاتف : <?php echo e($review->patient->phone); ?>  <?php endif; ?>
                                            </div>
                                        </div><!-- Default dropright button -->
                                    </div>
                                    <div class="d-block px-1 text-center" style="width:80% ;">
                                        <p class="text-xs text-gray-900 p-0 m-0" style="direction:rtl"><a href="<?php echo e(route('Clinic.patientProfile',$review->patient->patient_slug)); ?>"><b>اسم الزائر :  <?php echo e($review->patient->patient_name); ?></b></a></p>
                                        <p class="text-xs text-gray-800 p-0 m-0" style="direction:rtl"><a href="<?php echo e(route('Clinic.patientProfile',$review->patient->patient_slug)); ?>"><b>سبب الزيارة :  </b><?php echo \Illuminate\Support\Str::limit($review->main_complaint, 40 , '...'); ?></a></p>
                                    </div>
                                    <div class="d-block " style="width:17%;">
                                        <p class="text-center text-xs text-gray-800 p-0 m-0"><b>وقت الزيارة</b></p>
                                        <p class="text-center text-xs text-gray-800 p-0 m-0"><?php echo e($review->created_at->format('h:i a')); ?></p>
                                        <p class="text-center text-xs text-gray-800 p-0 m-0"><?php echo e($review->created_at->format('D d-m-Y')); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>


</div>




<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    
    <script src="<?php echo e(asset('assets/MyClinicApp/calender/js/waypoints.min.js')); ?>" ></script>
    <script src="<?php echo e(asset('assets/MyClinicApp/calender/js/moment.min.js')); ?>" ></script>
    <script src="<?php echo e(asset('assets/MyClinicApp/calender/js/moment-timezone.min.js')); ?>" ></script>
    <script src="<?php echo e(asset('assets/MyClinicApp/calender/js/tempusdominus-bootstrap-4.min.js')); ?>" ></script>
    <script src="<?php echo e(asset('assets/MyClinicApp/calender/js/main.js')); ?>" ></script>
    
        <!-- the SummerNotes plugin JavaScript -->
        <script src="<?php echo e(asset('assets/SummerNotes/summernote-bs4.min.js')); ?>" ></script>

        <!-- the SummerNotes plugin JavaScript -->
        
        <script>
            $(function () {
                $('.summernote').summernote({
                    // placeholder: 'Hello stand alone ui',
                    tabsize: 2,
                    height: 120,
                    toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                    ]
                });
                // يوضع اسم ايدي للفايل انبوت مثلا (#input_image)
                $('.input_image').fileinput({
                    theme: "fa", // نوع الايقونات .. فونت اوسم
                    maxFileCount :  5 , // عدد الاقصى للصور
                    allowedFileTypes :  ['image'], // نوع الملفات المرفوعة
                    showCancel :  true , // إظهار زر الإلغاء
                    showRemove :  true , // إخفاء زر الإزالة
                    showUpload :  false, // عدم الرفع من نفس البلاجن
                    overwriteInitial :  false ,// عدم الكتابة على البلاجن شيئ
                });

            });
        </script>
        
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.myClinic', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Projects\xampp\htdocs\MyClinicApp8\resources\views/myClinic/index.blade.php ENDPATH**/ ?>