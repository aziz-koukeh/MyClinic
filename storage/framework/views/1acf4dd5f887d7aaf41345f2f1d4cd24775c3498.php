<?php $__env->startSection('content'); ?>


<div class="container-fluid pb-5 mt-3 mb-5">
        <?php if(count($errors)>0): ?>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="alert alert-secondary" role="alert">
                    <?php echo e($item); ?>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <?php if(count($patientReviews)>0): ?>

            <a type="button"  class="btn btn-primary btn-sm rounded-left px-1 d-lg-none d-xl-none d-md-none"
                style="position: fixed;right:0%;top:11%;overflow:visible;z-index:2;"  role="button"  data-toggle="modal" data-target="#ourPatients">
                الموجودين<br>( <?php echo e(count($patientReviews)); ?> )
            </a>

        <?php endif; ?>


    <div class="row" >
        <div class="col-md-4 d-none d-lg-block d-md-block card o-hidden  border-right-primary border-bottom-primary border-top-primary border-0 py-2 px-1"
             style="direction:ltr;">
             <div style="min-height: calc(100vh - 95px)" >
                <div class="h6 d-flex text-primary font-weight-bold text-center py-1 px-1" style="text-align: right ;direction:rtl">
                    <?php if(count($patientReviews)>0): ?>
                        - العدد الموجود :  ( <?php echo e(count($patientReviews)); ?> )
                    <?php else: ?>
                        لا يوجد بعد
                    <?php endif; ?>
                </div>
                <hr class="my-1">
                <div class="pb-4" style="overflow-y:auto ;height: 100%;">

                        <?php
                            $pantientNum=count($patientReviews);
                        ?>
                        <?php $__empty_1 = true; $__currentLoopData = $patientReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php if($review->review_type == 'معاينة'): ?>
                                <?php
                                $type ='success'
                                ?>
                            <?php elseif($review->review_type == 'مراجعة'): ?>
                                <?php
                                $type ='warning'
                                ?>
                            <?php elseif($review->review_type == 'اسعافية'  || $review->review_type == 'عمل جراحي'): ?>
                                <?php
                                $type ='danger'
                                ?>
                            <?php else: ?>
                                <?php
                                $type ='info'
                                ?>
                            <?php endif; ?>
                            <div class="card border-bottom-<?php echo e($type); ?> py-2 px-1
                                <?php if($review->leave_off == 0): ?>
                                bg-gray-200
                                <?php endif; ?> ">

                                <div class="d-flex" >
                                    <div class="d-block"  style="width:12% ;direction: rtl">
                                        <?php if($review->leave_off == 1): ?>
                                            <a class="btn btn-light btn-circle btn-sm mb-1" type="button" onclick="document.getElementById('button<?php echo e($review->id); ?>').submit();" name="leave_off" >
                                                <i class="fa-solid fa-link fa-xl text-dark"></i>
                                            </a>
                                        <?php else: ?>
                                            <a class="btn btn-dark btn-circle btn-sm mb-1" class="ml-2" type="button" onclick="document.getElementById('button<?php echo e($review->id); ?>').submit();" name="leave_off" >
                                                <i class="fa-solid fa-link-slash text-light"></i>
                                            </a>
                                        <?php endif; ?>

                                        <form id="button<?php echo e($review->id); ?>" action="<?php echo e(route('Clinic.tasksReview',$review->id)); ?>" method="post" class="d-none">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="leave_off" <?php if($review->leave_off == 1): ?>
                                            value="0"
                                            <?php else: ?>
                                            value="1"
                                            <?php endif; ?> >
                                        </form>
                                        <a class="btn btn-light btn-circle btn-sm" type="button" href="<?php echo e(route('Clinic.destroyReviewEmployee',$review->id)); ?>"  data-toggle="tooltip" title=" حذف الزيارة ">
                                            <i class="fas fa-trash fa-lg text-danger"></i>
                                        </a>
                                    </div>

                                    <div class="d-block " style="width:80% ;direction: rtl">
                                        <p class="text-center text-gray-800 p-0 m-0"><a class="text-center text-gray-800 p-0 m-0"  role="button" data-toggle="modal" data-target="#sidepatientNum<?php echo e($review->id); ?>"><b class="text-xs text-gray-900">اسم المريض: </b><b><?php echo e($review->patient->patient_name); ?></b></a></p>
                                        <p class="text-center text-xs text-gray-800 p-0 m-0"><a class="text-center text-gray-800 p-0 m-0"  role="button" data-toggle="modal" data-target="#sidepatientNum<?php echo e($review->id); ?>"><b class="text-xs text-gray-900">سبب الزيارة: </b><?php echo \Illuminate\Support\Str::limit($review->main_complaint, 40 , '...'); ?></a></p>
                                        <p class="text-center text-xs text-gray-800 p-0 m-0"><b >وقت الزيارة</b><span> <?php echo e($review->created_at->format('h:i a')); ?></span></p>
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
                            <!-- Modal Patient Number -->
                            <div class="modal fade" id="sidepatientNum<?php echo e($review->id); ?>" tabindex="-1" aria-labelledby="patientNum<?php echo e($review->id); ?>" aria-hidden="true">
                                <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content border-right-<?php echo e($type); ?>" style="width: 95%;height: 95%;">
                                        <div class="modal-header py-1">
                                            <div class="text-center  w-100">
                                                <h1 class="h6 font-weight-bold text-gray-900 my-2 text-center" style="direction:rtl;">تعديل على زيارة <?php echo e($review->patient->patient_name); ?></h1>
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-body p-0" style="direction:ltr">
                                                <!-- Nested Row within Card Body -->
                                                <div  style="overflow-y:auto ;height: 100%;">
                                                    <form  class="user px-2" method="POST" action="<?php echo e(route('Clinic.updateReview_insert',$review->id)); ?>" enctype="multipart/form-data">
                                                        <?php echo csrf_field(); ?>

                                                        <div class="form-group mb-2" style="direction: rtl;margin-bottom: 0.5rem;">
                                                            <div class="form-row card px-0 mx-0 d-inine-block" style="flex-direction: unset;">
                                                                <div class="form-group mb-0 col-md-12 col-sm-12 " style="direction:rtl;text-align:right">
                                                                    <div class="custom-radio custom-control-inline mr-1">
                                                                        <label class="text-xs">حجز الموعد : </label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline mr-2">
                                                                        <input type="radio" id="editbyPhoneSide<?php echo e($review->id); ?>" name="leave_off" value="0" class="custom-control-input" <?php if($review->leave_off == 0): ?> checked  <?php endif; ?>>
                                                                        <label class="text-xs custom-control-label" for="editbyPhoneSide<?php echo e($review->id); ?>">هاتفي</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline mr-2">
                                                                        <input type="radio" id="editinClinicSide<?php echo e($review->id); ?>" name="leave_off" <?php if($review->leave_off == 1): ?> checked  <?php endif; ?>  value="1" class="custom-control-input">
                                                                        <label class="text-xs custom-control-label" for="editinClinicSide<?php echo e($review->id); ?>">في العيادة</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group mb-2 position-relative" style="direction: rtl;margin-bottom: 0.5rem;">
                                                                <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">اسم الزائر : </label>
                                                                <input class="VoiceToText form-control <?php $__errorArgs = ['patient_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text" id="patient_name<?php echo e($review->id); ?>" value="<?php echo e($review->patient->patient_name); ?>" name="patient_name" required placeholder=" أكتب الاسم والكنية "
                                                                style="padding: 0.375rem 0.75rem;height:38px;font-size: 75%;text-align:center;" >
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
                                                                <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:38px;" for="patient_name<?php echo e($review->id); ?>">
                                                                    <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                </button>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group mb-2 col-6" style="direction: rtl;margin-bottom: 0.5rem;">
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
                                                                <div class="form-group mb-2 col-6" style="direction: rtl;margin-bottom: 0.5rem;">
                                                                    <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">العمر : </label>
                                                                    <input type="tel" max="99" min="1" class="form-control form-control <?php $__errorArgs = ['age'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php if($review->patient->age != null): ?><?php echo e(date('Y') -$review->patient->age); ?> <?php endif; ?>" name="age" placeholder="1~99"
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
                                                                <div class="form-group mb-2 col-6" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                                    <div class="custom-radio custom-control-inline">
                                                                        <label class="text-xs mr-3">الجنس : </label>
                                                                    </div>
                                                                    <div class="card d-block" style="height: 38px">
                                                                        <div class="custom-control custom-radio custom-control-inline">
                                                                            <input type="radio" id="editgenderMaleSide<?php echo e($review->id); ?>" name="gender" <?php if($review->patient->gender == 'male'): ?> checked  <?php endif; ?>  value="male" class="custom-control-input">
                                                                            <label class="text-xs custom-control-label" for="editgenderMaleSide<?php echo e($review->id); ?>">ذكر</label>
                                                                        </div>
                                                                        <div class="custom-control custom-radio custom-control-inline">
                                                                            <input type="radio" id="editgenderFemaleSide<?php echo e($review->id); ?>" name="gender" <?php if($review->patient->gender == 'female'): ?> checked  <?php endif; ?>  value="female" class="custom-control-input">
                                                                            <label class="text-xs custom-control-label" for="editgenderFemaleSide<?php echo e($review->id); ?>">أنثى</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group mb-2 col-6" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                                    <div class="custom-radio custom-control-inline">
                                                                        <label class="text-xs mr-3">التدخين : </label>
                                                                    </div>
                                                                    <div class="card d-block" style="height: 38px">
                                                                        <div class="custom-control custom-radio custom-control-inline">
                                                                            <input type="radio" id="editnegativeSide<?php echo e($review->id); ?>" name="smoking" value="negative" <?php if($review->patient->smoking == 'negative'): ?> checked  <?php endif; ?> class="custom-control-input">
                                                                            <label class="text-xs custom-control-label" for="editnegativeSide<?php echo e($review->id); ?>">سلبي</label>
                                                                        </div>
                                                                        <div class="custom-control custom-radio custom-control-inline">
                                                                            <input type="radio" id="editpositiveSide<?php echo e($review->id); ?>" name="smoking"  value="positive" <?php if($review->patient->smoking == 'positive'): ?> checked  <?php endif; ?> class="custom-control-input">
                                                                            <label class="text-xs custom-control-label" for="editpositiveSide<?php echo e($review->id); ?>">إيجابي</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- collapseCardMoreDetailsPatients -->
                                                            <div class="card mb-2">
                                                                <!-- Card Header - Accordion -->
                                                                <a href="#collapseCardMoreDetailsPatientssidepatientNum<?php echo e($review->id); ?>" class="d-block card-header py-3" data-toggle="collapse" style=""
                                                                    role="button" aria-expanded="true" aria-controls="collapseCardMoreDetailsPatientssidepatientNum<?php echo e($review->id); ?>">
                                                                    <h6 class="m-0 text-xs font-weight-bold text-primary text-center">المزيد ...</h6>
                                                                </a>
                                                                <!-- Card Content - Collapse -->
                                                                <div class="collapse" id="collapseCardMoreDetailsPatientssidepatientNum<?php echo e($review->id); ?>">
                                                                    <div class="card-body px-1 py-3">
                                                                        <div class="form-row">
                                                                            <div class="form-group mb-2 col-6" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                                                <label class="text-xs mb-0 mr-3" style="padding-bottom: 0.2rem;text-align:right;direction:rtl;">الحالة الإجتماعية : </label>
                                                                                <div class="card d-block" style="height: 38px">
                                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                                        <input type="radio" id="editRelationshipMarriedSide<?php echo e($review->id); ?>" name="relationship" value="married" <?php if( $review->patient->relationship == 'married'): ?> checked  <?php endif; ?>  class="custom-control-input">
                                                                                        <label class="text-xs custom-control-label" for="editRelationshipMarriedSide<?php echo e($review->id); ?>">متزوج</label>
                                                                                    </div>
                                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                                        <input type="radio" id="editRelationshipSingleSide<?php echo e($review->id); ?>" name="relationship"  value="single" <?php if( $review->patient->relationship == 'single'): ?> checked  <?php endif; ?> class="custom-control-input">
                                                                                        <label class="text-xs custom-control-label" for="editRelationshipSingleSide<?php echo e($review->id); ?>">أعزب</label>
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
unset($__errorArgs, $__bag); ?>" value="<?php echo e($review->patient->patient_job); ?>" id="patient_job<?php echo e($review->id); ?>" name="patient_job"
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
                                                                                <button class="btn btn-white speake" type="button" style="position:absolute;right:4px; bottom:0;height:38px;" for="patient_job<?php echo e($review->id); ?>">
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
unset($__errorArgs, $__bag); ?>" id="patient_address<?php echo e($review->id); ?>" value="<?php echo e($review->patient->patient_address); ?>" name="patient_address"
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
                                                                                <button class="btn btn-white speake" type="button" style="position:absolute;right:4px; bottom:0;height:38px;" for="patient_address<?php echo e($review->id); ?>">
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
                                                            </div><!-- collapseCardMoreDetails -->
                                                        </div>


                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer py-1">
                                            <button type="submit" class="btn btn-primary btn-user">تعديل</button>
                                            <a class="btn btn-secondary btn-user"  data-dismiss="modal">عودة</a>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- Modal Patient Number -->
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
        <div class="col-md-8 card o-hidden border-left-primary border-right-primary  border-bottom-primary border-top-primary border-0 px-0 py-2" style="min-height: calc(100vh - 200px)">
            <div class="card-body p-0" style="min-height: calc(100vh - 200px);direction:ltr">
                <!-- Nested Row within Card Body -->
                <div  style="overflow-y:auto ;min-height: calc(100vh - 200px)">
                    <div class="d-flex mx-2" style="direction: rtl">

                        <a href="<?php echo e(route('Clinic.newPatientFully')); ?>" class="btn btn-outline-primary text-xs font-weight-bold mt-1" style="width: 100px">إدخال كامل</a>
                        <div class="text-center" style="width: 100%">
                            <h1 class="h5 text-gray-900 my-2" ><b>إدخال سريع</b></h1>
                        </div>
                    </div>



                    <form  class="user px-2" method="POST" action="<?php echo e(route('Clinic.storePatient')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <hr class="my-1 p-0">
                        <div class="form-group mb-2" style="direction: rtl;margin-bottom: 0.5rem;">
                            <div class="form-row card px-0 mx-0 d-inine-block" style="flex-direction: unset;">
                                <div class="form-group mb-0 col-md-6 col-sm-12 " style="direction:rtl;text-align:right">
                                    <div class="custom-radio custom-control-inline">
                                        <label class="text-xs">حجز الموعد : </label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="byPhone" name="leave_off" value="0" class="custom-control-input">
                                        <label class="text-xs custom-control-label" for="byPhone">هاتفي</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="inClinic" name="leave_off" checked value="1" class="custom-control-input">
                                        <label class="text-xs custom-control-label" for="inClinic">في العيادة</label>
                                    </div>
                                </div>
                                <div class="form-row mx-0 mb-0 col-md-6 col-sm-12 px-0">
                                    <div class="form-group mb-0 col-4 px-0 " style="direction:rtl;text-align:right">
                                        
                                            <a type="button" class="text-xs btn" style="text-decoration-line:underline"
                                                role="button"  data-toggle="modal" data-target="#nextReview">
                                                -المواعيد :
                                                <?php if(count($nextReviews) >0): ?>
                                                    <span><b>( <?php echo e(count($nextReviews)); ?> )</b></span>
                                                <?php endif; ?>
                                            </a>
                                        
                                    </div>
                                    <div class="form-group mb-0 col-8 px-0 " style="direction:rtl;text-align:right">
                                        <input type="date" min="<?php echo e(Carbon\Carbon::tomorrow()->format('Y-m-d')); ?>" class="form-control form-control <?php $__errorArgs = ['review_forDay'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="review_forDay" placeholder="حجز موعد"
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
                                </div>
                            </div>
                            <div class="form-group mb-2" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                <div class="custom-radio custom-control-inline">
                                    <label class="text-xs">سبب الزيارة : </label>
                                </div>
                                <div class="card d-block">
                                    <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                        <input type="radio" id="view" name="main_complaint[]" value="معاينة جديدة"  class="custom-control-input">
                                        <label class="text-xs text-success font-weight-bold custom-control-label" for="view" >معاينة</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                        <input type="radio" id="newreview" name="main_complaint[]"  value="مراجعة" checked class="custom-control-input">
                                        <label class="text-xs text-warning font-weight-bold custom-control-label" for="newreview" >مراجعة</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                        <input type="radio" id="Emergency" name="main_complaint[]"  value="اسعافية" class="custom-control-input">
                                        <label class="text-xs text-danger font-weight-bold custom-control-label" for="Emergency" >اسعافية</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                        <input type="radio" id="selectSergray" name="main_complaint[]"  value="تحديد عملية" class="custom-control-input">
                                        <label class="text-xs text-info font-weight-bold custom-control-label" for="selectSergray">تحديد عملية</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                        <input type="radio" id="reviewSergray" name="main_complaint[]"  value="مراجعة عملية" class="custom-control-input">
                                        <label class="text-xs text-info font-weight-bold custom-control-label" for="reviewSergray">مراجعة عملية</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline" style="direction:ltr;text-align:right">
                                        <input type="radio" id="nulls" name="main_complaint[]" value="" class="custom-control-input">
                                        <label class="text-xs text-dark font-weight-bold custom-control-label" for="nulls">زيارة</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline" style="direction:ltr;text-align:right">
                                        <input type="checkbox" id="forPhoto" name="main_complaint[]" value="صورة" class="custom-control-input">
                                        <label class="text-xs text-info font-weight-bold custom-control-label" for="forPhoto" >صورة</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline" style="direction:ltr;text-align:right">
                                        <input type="checkbox" id="forAnalysis" name="main_complaint[]"  value="تحليل" class="custom-control-input">
                                        <label class="text-xs text-info font-weight-bold custom-control-label" for="forAnalysis" >تحليل</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-2 position-relative" style="direction: rtl;margin-bottom: 0.5rem;">
                                <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">اسم الزائر : </label>
                                <input class="VoiceToText form-control <?php $__errorArgs = ['patient_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text" id="patient_name"  name="patient_name" required placeholder=" أكتب الاسم والكنية "
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
                                <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:38px;" for="patient_name">
                                    <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                </button>
                            </div>
                            <div class="form-row">
                                <div class="form-group mb-2 col-6" style="direction: rtl;margin-bottom: 0.5rem;">
                                    <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">رقم الهاتف : </label>
                                    <input type="tel" class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="phone" placeholder=" أكتب رقم الهاتف"
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
                                <div class="form-group mb-2 col-6" style="direction: rtl;margin-bottom: 0.5rem;">
                                    <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">العمر : </label>
                                    <input type="tel" max="99" min="1" class="form-control form-control <?php $__errorArgs = ['age'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="age" placeholder=""
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
                                <div class="form-group mb-2 col-6" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                    <div class="custom-radio custom-control-inline">
                                        <label class="text-xs">الجنس : </label>
                                    </div>
                                    <div class="card d-block" style="height: 38px">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="genderMale" name="gender" value="male" class="custom-control-input">
                                            <label class="text-xs custom-control-label" for="genderMale">ذكر</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="genderFemale" name="gender" value="female" class="custom-control-input">
                                            <label class="text-xs custom-control-label" for="genderFemale">أنثى</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-2 col-6" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                    <div class="custom-radio custom-control-inline">
                                        <label class="text-xs">التدخين : </label>
                                    </div>
                                    <div class="card d-block" style="height: 38px">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="negative" name="smoking" value="negative"  class="custom-control-input">
                                            <label class="text-xs custom-control-label" for="negative">سلبي</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="positive" name="smoking"  value="positive" class="custom-control-input">
                                            <label class="text-xs custom-control-label" for="positive">إيجابي</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- collapseCardMoreDetails -->
                            <div class="card mb-2">
                                <!-- Card Header - Accordion -->
                                <a href="#collapseCardMoreDetails" class="d-block card-header py-3" data-toggle="collapse" style=""
                                    role="button" aria-expanded="true" aria-controls="collapseCardMoreDetails">
                                    <h6 class="m-0 text-xs font-weight-bold text-primary text-center">المزيد ...</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse " id="collapseCardMoreDetails">
                                    <div class="card-body px-1 py-3">
                                        <div class="form-row">
                                            <div class="form-group mb-2 col-6" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                <label class="text-xs mb-0 mr-3" style="padding-bottom: 0.2rem;text-align:right;direction:rtl;">الحالة الإجتماعية : </label>
                                                <div class="card d-block" style="height: 38px">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="relationshipMarried" name="relationship" value="married" class="custom-control-input">
                                                        <label class="text-xs custom-control-label" for="relationshipMarried">متزوج</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="relationshipSingle" name="relationship"  value="single" class="custom-control-input">
                                                        <label class="text-xs custom-control-label" for="relationshipSingle">أعزب</label>
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
unset($__errorArgs, $__bag); ?>" name="child_count"
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
unset($__errorArgs, $__bag); ?>" id="patient_job" name="patient_job"
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
                                                <button class="btn btn-white speake" type="button" style="position:absolute;right:4px; bottom:0;height:38px;" for="patient_job">
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
unset($__errorArgs, $__bag); ?>" id="patient_address"  name="patient_address"
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
                                                <button class="btn btn-white speake" type="button" style="position:absolute;right:4px; bottom:0;height:38px;" for="patient_address">
                                                    <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="form-group mb-2"  style="direction:rtl;margin-bottom: 0.5rem;">
                                            <label class="text-xs mr-3" style="text-align:right;float: right; direction:rtl;">السوابق الجراحية : </label>
                                            <textarea  class="form-control" name="older_surgery" rows="2" style="height:38px;font-size: 75%;padding: 0.375rem 0.75rem;text-align:center" placeholder=" أكتب السوابق الجراحية في حال وجودها"></textarea>
                                        </div>
                                        <div class="form-group mb-2"  style="direction:rtl;margin-bottom: 0.5rem;">
                                            <label class="text-xs mr-3" style="text-align:right;float: right; direction:rtl;">السوابق المرضية : </label>
                                            <textarea  class="form-control" name="older_sicky" rows="2" style="padding: 0.375rem 0.75rem;text-align:center;height:38px;font-size: 75%" placeholder=" أكتب السوابق المرضية في حال وجودها"></textarea>
                                        </div>
                                        <div class="form-group mb-2"  style="direction:rtl;margin-bottom: 0.5rem;">
                                            <label class="text-xs mr-3" style="text-align:right;float: right; direction:rtl;">السوابق التحسسية : </label>
                                            <textarea  class="form-control" name="older_sensitive" rows="2" style="padding: 0.375rem 0.75rem;text-align:center;height:38px;font-size: 75%" placeholder=" أكتب السوابق التحسسية في حال وجودها"></textarea>
                                        </div>
                                        <div class="form-group mb-2"  style="direction:rtl;margin-bottom: 0.5rem;">
                                            <label class="text-xs mr-3" style="text-align:right;float: right; direction:rtl;">الأدوية الدائمة : </label>
                                            <textarea  class="form-control" name="permanent_medic" rows="1" style="height:38px;font-size: 75%;padding: 0.375rem 0.75rem;text-align:center" placeholder=" أكتب الأدوية الدائمة في حال وجودها"></textarea>
                                        </div>
                                        <div class="form-group mb-2"  style="direction:rtl;margin-bottom: 0.5rem;">
                                            <label class="text-xs mr-3" style="text-align:right;float: right; direction:rtl;">ملاحظات حول المريض : </label>
                                            <input type="text" class="form-control " name="patient_state" placeholder=" أكتب ملاحظات في حال وجودها" style="padding: 0.375rem 0.75rem;height:38px;font-size: 75%;text-align:center">
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
                            </div><!-- collapseCardMoreDetails -->
                        </div>
                        <div class="form-group mb-2" style="direction:ltr">
                            <button type="submit" class="btn btn-primary btn-block">
                                إضافة
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ourPatients" tabindex="-1" aria-labelledby="ourPatients" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content" style="width: 95%;height: 95%;">
                <div class="modal-header py-1">
                    <div class="h6 d-flex text-xs text-primary font-weight-bold text-center py-1 px-1" style="text-align: right ;direction:rtl">
                        <?php if(count($patientReviews)>0): ?>
                            - العدد الموجود :  ( <?php echo e(count($patientReviews)); ?> )

                        <?php else: ?>
                            لا يوجد بعد
                        <?php endif; ?>
                    </div>
                </div>
                <div class="modal-body p-1" style="direction:ltr;" >
                    <div class="py-2">
                        <?php
                            $pantientNum=count($patientReviews);
                        ?>
                        <?php $__empty_1 = true; $__currentLoopData = $patientReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php if($review->review_type == 'معاينة'): ?>
                                <?php
                                $type ='success'
                                ?>
                            <?php elseif($review->review_type == 'مراجعة'): ?>
                                <?php
                                $type ='warning'
                                ?>
                            <?php elseif($review->review_type == 'اسعافية'  || $review->review_type == 'عمل جراحي'): ?>
                                <?php
                                $type ='danger'
                                ?>
                            <?php else: ?>
                                <?php
                                $type ='info'
                                ?>
                            <?php endif; ?>
                            <div class="card border-bottom-<?php echo e($type); ?> py-2 px-1
                            <?php if($review->leave_off == 0): ?>
                            bg-gray-200
                            <?php endif; ?> ">
                                <div class="d-flex" >
                                    <div class="d-block"  style="width:12% ;direction: rtl">
                                        <?php if($review->leave_off == 1): ?>
                                            <a class="btn btn-light btn-circle btn-sm mb-1" type="button" onclick="document.getElementById('button<?php echo e($review->id); ?>').submit();" name="leave_off" >
                                                <i class="fa-solid fa-link fa-xl text-dark"></i>
                                            </a>
                                        <?php else: ?>
                                            <a class="btn btn-dark btn-circle btn-sm mb-1" class="ml-2" type="button" onclick="document.getElementById('button<?php echo e($review->id); ?>').submit();" name="leave_off" >
                                                <i class="fa-solid fa-link-slash text-light"></i>
                                            </a>
                                        <?php endif; ?>

                                        <form id="button<?php echo e($review->id); ?>" action="<?php echo e(route('Clinic.tasksReview',$review->id)); ?>" method="post" class="d-none">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="leave_off" <?php if($review->leave_off == 1): ?>
                                            value="0"
                                            <?php else: ?>
                                            value="1"
                                            <?php endif; ?> >
                                        </form>
                                        <a class="btn btn-light btn-circle btn-sm" type="button" href="<?php echo e(route('Clinic.destroyReviewEmployee',$review->id)); ?>"  data-toggle="tooltip" title=" حذف الزيارة ">
                                            <i class="fas fa-trash fa-lg text-danger"></i>
                                        </a>
                                    </div>

                                    <div class="d-block " style="width:80% ;direction: rtl">
                                        <p class="text-center text-gray-800 p-0 m-0"><a class="text-center text-gray-800 p-0 m-0" role="button" data-toggle="modal" data-target="#patientNum<?php echo e($review->id); ?>"><b class="text-xs text-gray-900">اسم المريض: </b><b><?php echo e($review->patient->patient_name); ?></b></a></p>
                                        <p class="text-center text-xs text-gray-800 p-0 m-0"><a class="text-center text-gray-800 p-0 m-0" role="button" data-toggle="modal" data-target="#patientNum<?php echo e($review->id); ?>"><b class="text-xs text-gray-900">سبب الزيارة: </b><?php echo \Illuminate\Support\Str::limit($review->main_complaint, 40 , '...'); ?></a></p>
                                        <p class="text-center text-xs text-gray-800 p-0 m-0"><b >وقت الزيارة</b><span> <?php echo e($review->created_at->format('h:i a')); ?></span></p>
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

                                                <?php if($review->patient->age  && $review->patient->age != date('Y')): ?> <br> العمر : <?php echo e(date('Y') - $review->patient->age); ?>  <?php endif; ?>
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
                            <!-- Modal Patient Number -->
                            <div class="modal fade" id="patientNum<?php echo e($review->id); ?>" tabindex="-1" aria-labelledby="patientNum<?php echo e($review->id); ?>" aria-hidden="true">
                                <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content border-right-<?php echo e($type); ?>" style="width: 95%;height: 95%;">
                                        <div class="modal-header py-1">
                                            <div class="text-center  w-100">
                                                <h1 class="h6 font-weight-bold text-gray-900 my-2 text-center" style="direction:rtl;">تعديل على زيارة <?php echo e($review->patient->patient_name); ?></h1>
                                            </div>
                                        </div>
                                        <div class="modal-body p-1">
                                            <div class="card-body p-0" style="height: 530px;direction:ltr">
                                                <!-- Nested Row within Card Body -->
                                                <div  style="overflow-y:auto ;height: 100%;">

                                                    <form  class="user px-2" method="POST" action="<?php echo e(route('Clinic.updateReview_insert',$review->id)); ?>" enctype="multipart/form-data">
                                                        <?php echo csrf_field(); ?>
                                                        <div class="form-group mb-2" style="direction: rtl;margin-bottom: 0.5rem;">

                                                            <div class="form-row card px-0 mx-0 d-inine-block" style="flex-direction: unset;">
                                                                <div class="form-group mb-0 col-md-12 col-sm-12 " style="direction:rtl;text-align:right">
                                                                    <div class="custom-radio custom-control-inline mr-1">
                                                                        <label class="text-xs">حجز الموعد : </label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline mr-2">
                                                                        <input type="radio" id="editbyPhone<?php echo e($review->id); ?>" name="leave_off" value="0" class="custom-control-input" <?php if($review->leave_off == 0): ?> checked  <?php endif; ?>>
                                                                        <label class="text-xs custom-control-label" for="editbyPhone<?php echo e($review->id); ?>">هاتفي</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline mr-2">
                                                                        <input type="radio" id="editinClinic<?php echo e($review->id); ?>" name="leave_off" <?php if($review->leave_off == 1): ?> checked  <?php endif; ?>  value="1" class="custom-control-input">
                                                                        <label class="text-xs custom-control-label" for="editinClinic<?php echo e($review->id); ?>">في العيادة</label>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            
                                                            <div class="form-group mb-2 position-relative" style="direction: rtl;margin-bottom: 0.5rem;">
                                                                <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">اسم الزائر : </label>
                                                                <input class="VoiceToText form-control <?php $__errorArgs = ['patient_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text" id="patient_name<?php echo e($review->id); ?>" value="<?php echo e($review->patient->patient_name); ?>" name="patient_name" required placeholder=" أكتب الاسم والكنية "
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
                                                                <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:38px;" for="patient_name<?php echo e($review->id); ?>">
                                                                    <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                </button>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group mb-2 col-6" style="direction: rtl;margin-bottom: 0.5rem;">
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
                                                                <div class="form-group mb-2 col-6" style="direction: rtl;margin-bottom: 0.5rem;">
                                                                    <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">العمر : </label>
                                                                    <input type="tel" max="99" min="1" class="form-control form-control <?php $__errorArgs = ['age'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php if($review->patient->age !=null): ?><?php echo e(date('Y') -$review->patient->age); ?> <?php endif; ?>" name="age" placeholder="1~99"
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
                                                                <div class="form-group mb-2 col-6" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                                    <div class="custom-radio custom-control-inline">
                                                                        <label class="text-xs mr-3">الجنس : </label>
                                                                    </div>
                                                                    <div class="card d-block" style="height: 38px">
                                                                        <div class="custom-control custom-radio custom-control-inline">
                                                                            <input type="radio" id="editgenderMale<?php echo e($review->id); ?>" name="gender" <?php if($review->patient->gender == 'male'): ?> checked  <?php endif; ?>  value="male" class="custom-control-input">
                                                                            <label class="text-xs custom-control-label" for="editgenderMale<?php echo e($review->id); ?>">ذكر</label>
                                                                        </div>
                                                                        <div class="custom-control custom-radio custom-control-inline">
                                                                            <input type="radio" id="editgenderFemale<?php echo e($review->id); ?>" name="gender" <?php if($review->patient->gender == 'female'): ?> checked  <?php endif; ?>  value="female" class="custom-control-input">
                                                                            <label class="text-xs custom-control-label" for="editgenderFemale<?php echo e($review->id); ?>">أنثى</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group mb-2 col-6" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                                    <div class="custom-radio custom-control-inline">
                                                                        <label class="text-xs mr-3">التدخين : </label>
                                                                    </div>
                                                                    <div class="card d-block" style="height: 38px">
                                                                        <div class="custom-control custom-radio custom-control-inline">
                                                                            <input type="radio" id="editnegative<?php echo e($review->id); ?>" name="smoking" value="negative" <?php if($review->patient->smoking == 'negative'): ?> checked  <?php endif; ?> class="custom-control-input">
                                                                            <label class="text-xs custom-control-label" for="editnegative<?php echo e($review->id); ?>">سلبي</label>
                                                                        </div>
                                                                        <div class="custom-control custom-radio custom-control-inline">
                                                                            <input type="radio" id="editpositive<?php echo e($review->id); ?>" name="smoking"  value="positive" <?php if( $review->patient->smoking == 'positive'): ?> checked  <?php endif; ?> class="custom-control-input">
                                                                            <label class="text-xs custom-control-label" for="editpositive<?php echo e($review->id); ?>">إيجابي</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- collapseCardMoreDetailsPatients -->
                                                            <div class="card mb-2">
                                                                <!-- Card Header - Accordion -->
                                                                <a href="#collapseCardMoreDetailsPatientspatientNum<?php echo e($review->id); ?>" class="d-block card-header py-3" data-toggle="collapse" style=""
                                                                    role="button" aria-expanded="true" aria-controls="collapseCardMoreDetailsPatientspatientNum<?php echo e($review->id); ?>">
                                                                    <h6 class="m-0 text-xs font-weight-bold text-primary text-center">المزيد ...</h6>
                                                                </a>
                                                                <!-- Card Content - Collapse -->
                                                                <div class="collapse" id="collapseCardMoreDetailsPatientspatientNum<?php echo e($review->id); ?>">
                                                                    <div class="card-body px-1 py-3">
                                                                        <div class="form-row">
                                                                            <div class="form-group mb-2 col-6" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                                                <label class="text-xs mb-0 mr-3" style="padding-bottom: 0.2rem;text-align:right;direction:rtl;">الحالة الإجتماعية : </label>
                                                                                <div class="card d-block" style="height: 38px">
                                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                                        <input type="radio" id="editRelationshipMarried<?php echo e($review->id); ?>" name="relationship" value="married" <?php if( $review->patient->relationship == 'married'): ?> checked  <?php endif; ?>  class="custom-control-input">
                                                                                        <label class="text-xs custom-control-label" for="editRelationshipMarried<?php echo e($review->id); ?>">متزوج</label>
                                                                                    </div>
                                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                                        <input type="radio" id="editRelationshipSingle<?php echo e($review->id); ?>" name="relationship"  value="single" <?php if( $review->patient->relationship == 'single'): ?> checked  <?php endif; ?> class="custom-control-input">
                                                                                        <label class="text-xs custom-control-label" for="editRelationshipSingle<?php echo e($review->id); ?>">أعزب</label>
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
unset($__errorArgs, $__bag); ?>" value="<?php echo e($review->patient->patient_job); ?>" id="patient_job<?php echo e($review->id); ?>" name="patient_job"
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
                                                                                <button class="btn btn-white speake" type="button" style="position:absolute;right:4px; bottom:0;height:38px;" for="patient_job<?php echo e($review->id); ?>">
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
unset($__errorArgs, $__bag); ?>" id="patient_address<?php echo e($review->id); ?>" value="<?php echo e($review->patient->patient_address); ?>" name="patient_address"
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
                                                                                <button class="btn btn-white speake" type="button" style="position:absolute;right:4px; bottom:0;height:38px;" for="patient_address<?php echo e($review->id); ?>">
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
                                                            </div><!-- collapseCardMoreDetails -->
                                                        </div>


                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer py-1">
                                            <button type="submit" class="btn btn-primary btn-user">تعديل</button>
                                            <a class="btn btn-secondary btn-user" role="button" data-toggle="modal"  data-dismiss="modal" data-target="#ourPatients">عودة</a>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- Modal Patient Number -->
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class=" text-center text-gray-500">لا يوجد بعد</p>

                        <?php endif; ?>
                    </div>
                </div>
                <div class="modal-footer py-1" style="direction:ltr">
                    <button type="button" style="float: right" class="btn btn-primary btn-user" data-dismiss="modal">عودة</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Next -->
    <div class="modal fade" id="nextReview" tabindex="-1" aria-labelledby="nextReview" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content" style="width: 95%;height: 95%;">
                <div class="modal-header py-1">
                    <div class="h6 d-flex text-primary font-weight-bold text-center py-1 px-1" style="text-align: right ;direction:rtl">
                        <?php if(count($nextReviews)>0): ?>
                            - الزيارات القادمة :  ( <?php echo e(count($nextReviews)); ?> )

                        <?php else: ?>
                            لا يوجد بعد
                        <?php endif; ?>
                    </div>
                </div>
                <div class="modal-body p-1" style="direction:ltr;" >
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
                            <?php elseif($review->review_type == 'اسعافية'  || $review->review_type == 'عمل جراحي'): ?>
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


                                </div>
                            </div>

                            <hr class="my-1">
                            <?php
                            --$pantientNum;
                            ?>
                            <!-- Modal Next -->
                            <div class="modal fade" id="nextReview<?php echo e($review->id); ?>" tabindex="-1" aria-labelledby="nextReview<?php echo e($review->id); ?>" aria-hidden="true">
                                <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content" style="width: 95%;height: 95%;">
                                        <div class="modal-header py-1">
                                            <div class="text-center w-100">
                                                <h1 class="h6 font-weight-bold text-gray-900 my-2 text-center" style="direction:rtl;">تعديل على موعد <?php echo e($review->patient->patient_name); ?></h1>
                                            </div>
                                        </div>
                                        <div class="modal-body py-0">
                                            <div class="card-body p-0" style="direction:ltr">
                                                <!-- Nested Row within Card Body -->

                                                <form  class="user" method="POST" action="<?php echo e(route('Clinic.updateReview_insert',$review->id)); ?>" enctype="multipart/form-data">
                                                    <?php echo csrf_field(); ?>
                                                    <div class="form-group mb-3" style="direction: rtl;margin-bottom: 0.5rem;">
                                                        <div class="form-group mb-2" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
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
unset($__errorArgs, $__bag); ?>" value="<?php if($review->patient->age != null): ?><?php echo e(date('Y') -$review->patient->age); ?> <?php endif; ?>" name="age" placeholder="1~99"
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
                                                        </div><!-- collapseCardMoreDetails -->
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer py-1">
                                            <button type="submit" class="btn btn-primary btn-user">تعديل</button>
                                            <a class="btn btn-secondary btn-user" role="button" data-toggle="modal"  data-dismiss="modal" data-target="#nextReview">عودة</a>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- Modal Next -->
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class=" text-center text-gray-500">لا يوجد بعد</p>
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
<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
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

<?php echo $__env->make('layouts.myClinic', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Projects\xampp\htdocs\MyClinicApp8\resources\views/myClinic/patients/newPatient.blade.php ENDPATH**/ ?>