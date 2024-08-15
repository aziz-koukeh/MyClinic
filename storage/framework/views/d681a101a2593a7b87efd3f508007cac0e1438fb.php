<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class=" mb-5 pb-5 mt-3">
        <ul class="nav nav-tabs font-weight-bold pr-1" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <?php
                    $lastday=0;
                    $lastweek=0;
                    $lastmonth=0;
                ?>
                <?php $__currentLoopData = $patientReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patientReview): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($patientReview->created_at->format('Y-m-d') == Carbon\Carbon::today()->format('Y-m-d')): ?>
                        <?php
                            ++$lastday;
                        ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <button class="nav-link text-xs px-2" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true"><b>الحديث</b></button>
            </li>
            <li class="nav-item" role="presentation">
                <?php $__currentLoopData = $patientReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patientReview): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($patientReview->created_at->diffInWeeks() == 0 && $patientReview->created_at->format('Y-m-d') < Carbon\Carbon::today() && $patientReview->created_at->diffInHours() >=24): ?>
                        <?php
                            ++$lastweek;
                        ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <button class="nav-link text-xs px-2" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false"><b>هذا الأسبوع</b></button>
            </li>
            <li class="nav-item" role="presentation">
                <?php $__currentLoopData = $patientReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patientReview): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($patientReview->created_at->diffInMonths() == 0 && $patientReview->created_at->format('Y-m-d') < Carbon\Carbon::today() && $patientReview->created_at->diffInHours() >=24): ?>
                        <?php
                            ++$lastmonth;
                        ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <button class="nav-link text-xs px-2" id="month-tab" data-toggle="tab" data-target="#month" type="button" role="tab" aria-controls="month" aria-selected="false"><b>هذا الشهر</b></button>
            </li>
            <li class="nav-item" role="presentation">

            <button class="nav-link text-xs px-2  active" id="unWriteReport-tab" data-toggle="tab" data-target="#unWriteReport" type="button" role="tab" aria-controls="unWriteReport" aria-selected="false"><b>بدون تشخيص</b></button>
            </li>
            <li class="nav-item" role="presentation">

            <button class="nav-link text-xs px-2" id="phoneTurn-tab" data-toggle="tab" data-target="#phoneTurn" type="button" role="tab" aria-controls="phoneTurn" aria-selected="false"><b>حجوزات هاتفية</b></button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">

            <div class="tab-pane fade " id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class=" card border-right-dark shadow p-2 my-3">
                    <div class="card-header p-3">
                        <h5 class="text-center text-dark p-0 m-0"><b>الحديث</b><span class="badge btn-light btn-circle text-dark badge-counter"><?php echo e($lastday); ?></span></h5>
                    </div>
                    <?php $__empty_1 = true; $__currentLoopData = $patientReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patientReview): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php if($patientReview->created_at->format('Y-m-d') == Carbon\Carbon::today()->format('Y-m-d')): ?>
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
                                    <div class="d-sm-block d-md-inline-flex" style="width:10% ;">
                                        <div>
                                            <a class="card_dropdown" href="#collapseCardExample<?php echo e($patientReview->id); ?>" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample<?php echo e($patientReview->id); ?>">
                                            </a>
                                        </div>
                                        <div class="d-inline-block w-100 text-center">
                                            <p class="text-xs text-gray-800 font-weight-bold p-0 m-0"><?php echo e($patientReview->review_type); ?></p>
                                            <p class="text-xs text-gray-800 font-weight-bold p-0 m-0">#<?php echo e($lastday--); ?></p>
                                        </div>
                                    </div>
                                    <div class="text-center" style="width:70% ;">
                                        <p class="text-xs text-gray-900 p-0 m-0">اسم الزائر :</p>
                                        <h6 class="text-primary p-0 m-0"><a href="<?php echo e(route('Clinic.patientProfile',$patientReview->patient->patient_slug)); ?>"><b><?php echo e($patientReview->patient->patient_name); ?></b></a></h6>
                                    </div>
                                    <div class="" style="width: 20%;float: left;">
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
                                                            <?php if($patientReview->patient->age && $patientReview->patient->age != date('Y') ): ?>
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
                                                    <?php if($patientReview->date_expecting && (Carbon\Carbon::today() < Carbon\Carbon::parse($patientReview->date_expecting))): ?>
                                                        <div class="text-primary text-uppercase mb-1">
                                                            <?php if($patientReview->main_complaint ==' - تحديد عملية - تحليل' || $patientReview->main_complaint =='تحديد عملية' || $patientReview->main_complaint ==' - تحديد عملية - صورة - تحليل' || $patientReview->main_complaint ==' - تحديد عملية - صورة'): ?>
                                                                    موعد العملية
                                                                <?php else: ?>
                                                                    الموعد القادم
                                                                <?php endif; ?>
                                                            </div>
                                                        <div class="mb-0 text-gray-800"><?php echo e(Carbon\Carbon::parse($patientReview->date_expecting)->format('D d-m-Y')); ?></div>
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
                        <?php endif; ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="card border-bottom-info shadow py-1 my-1">
                            <div class="card-body text-center text-info" >
                                <b>لا يوجد</b>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

            <div class="tab-pane fade " id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class=" card border-right-dark shadow p-2 my-3">
                    <div class="card-header p-3">
                        <h5 class="text-center text-dark p-0 m-0"><b>هذا الأسبوع</b><span class="badge btn-light btn-circle text-dark badge-counter"><?php echo e($lastweek); ?></span></h5>
                    </div>
                    <?php $__empty_1 = true; $__currentLoopData = $patientReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patientReview): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php if($patientReview->created_at->diffInWeeks() == 0 && $patientReview->created_at->format('Y-m-d') < Carbon\Carbon::today() && $patientReview->created_at->diffInHours() >=24): ?>
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
                                    <div class="d-sm-block d-md-inline-flex" style="width:10% ;">
                                        <div>
                                            <a class="card_dropdown" href="#collapseCardExample<?php echo e($patientReview->id); ?>" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample<?php echo e($patientReview->id); ?>">
                                            </a>
                                        </div>
                                        <div class="d-inline-block w-100 text-center">
                                            <p class="text-xs text-gray-800 font-weight-bold p-0 m-0"><?php echo e($patientReview->review_type); ?></p>
                                            <p class="text-xs text-gray-800 font-weight-bold p-0 m-0">#<?php echo e($lastweek--); ?></p>
                                        </div>
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
                                                            <?php if($patientReview->patient->age && $patientReview->patient->age != date('Y') ): ?>
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
                                                    <?php if($patientReview->date_expecting && (Carbon\Carbon::today() < Carbon\Carbon::parse($patientReview->date_expecting))): ?>
                                                        <div class="text-primary text-uppercase mb-1">
                                                            <?php if($patientReview->main_complaint ==' - تحديد عملية - تحليل' || $patientReview->main_complaint =='تحديد عملية' || $patientReview->main_complaint ==' - تحديد عملية - صورة - تحليل' || $patientReview->main_complaint ==' - تحديد عملية - صورة'): ?>
                                                                موعد العملية
                                                            <?php else: ?>
                                                                الموعد القادم
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="mb-0 text-gray-800"><?php echo e(Carbon\Carbon::parse($patientReview->date_expecting)->format('D d-m-Y')); ?></div>
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
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="card border-bottom-info shadow py-1 my-1">
                            <div class="card-body text-center text-info" >
                                <b>لا يوجد</b>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

            <div class="tab-pane fade" id="month" role="tabpanel" aria-labelledby="month-tab">
                <div class=" card border-right-dark shadow p-2 my-3">
                    <div class="card-header p-3">
                        <h5 class="text-center text-dark p-0 m-0"><b>هذا الشهر</b><span class="badge btn-light btn-circle text-dark badge-counter"><?php echo e($lastmonth); ?></span></h5>
                    </div>
                    <?php $__empty_1 = true; $__currentLoopData = $patientReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patientReview): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php if($patientReview->created_at->diffInMonths() == 0 && $patientReview->created_at->format('Y-m-d') < Carbon\Carbon::today()  &&  $patientReview->created_at->diffInHours() >=24): ?>
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
                                    <div class="d-sm-block d-md-inline-flex" style="width:10% ;">
                                        <div>
                                            <a class="card_dropdown" href="#collapseCardExample<?php echo e($patientReview->id); ?>" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample<?php echo e($patientReview->id); ?>">
                                            </a>
                                        </div>
                                        <div class="d-inline-block w-100 text-center">
                                            <p class="text-xs text-gray-800 font-weight-bold p-0 m-0"><?php echo e($patientReview->review_type); ?></p>
                                            <p class="text-xs text-gray-800 font-weight-bold p-0 m-0">#<?php echo e($lastmonth--); ?></p>
                                        </div>
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
                                                            <?php if($patientReview->patient->age && $patientReview->patient->age !=date('Y') ): ?>
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
                                                    <?php if($patientReview->date_expecting && (Carbon\Carbon::today() < Carbon\Carbon::parse($patientReview->date_expecting))): ?>
                                                        <div class="text-primary text-uppercase mb-1">
                                                            <?php if($patientReview->main_complaint ==' - تحديد عملية - تحليل' || $patientReview->main_complaint =='تحديد عملية' || $patientReview->main_complaint ==' - تحديد عملية - صورة - تحليل' || $patientReview->main_complaint ==' - تحديد عملية - صورة'): ?>
                                                                موعد العملية
                                                            <?php else: ?>
                                                                الموعد القادم
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="mb-0 text-gray-800"><?php echo e(Carbon\Carbon::parse($patientReview->date_expecting)->format('D d-m-Y')); ?></div>
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
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="card border-bottom-info shadow py-1 my-1">
                            <div class="card-body text-center text-info" >
                                <b>لا يوجد</b>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

            <div class="tab-pane fade show active" id="unWriteReport" role="tabpanel" aria-labelledby="unWriteReport-tab">
                <div class=" card border-right-dark shadow p-2 my-3">
                    <div class="card-header p-3">
                        <?php
                            $countUnReporteds =$unReporteds->count();
                        ?>
                        <h5 class="text-center text-dark p-0 m-0"><b>الزيارات بدون تشخيص </b><span class="badge btn-light btn-circle text-dark badge-counter"><?php echo e($countUnReporteds); ?></span></h5>
                    </div>
                    <?php $__empty_1 = true; $__currentLoopData = $unReporteds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unReported): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                            <?php if($unReported->review_type == 'معاينة'): ?>
                                <?php
                                $type ='success'
                                ?>
                            <?php elseif($unReported->review_type == 'مراجعة'): ?>
                                <?php
                                $type ='warning'
                                ?>
                            <?php elseif($unReported->review_type == 'اسعافية'): ?>
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
                                    <div class="d-sm-block d-md-inline-flex" style="width:10% ;">
                                        <div>
                                            <a class="card_dropdown" href="#collapseCardExample<?php echo e($unReported->id); ?>" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample<?php echo e($unReported->id); ?>">
                                            </a>
                                        </div>
                                        <div class="d-inline-block w-100 text-center">
                                            <p class="text-xs text-gray-800 font-weight-bold p-0 m-0"><?php echo e($unReported->review_type); ?></p>
                                            <p class="text-xs text-gray-800 font-weight-bold p-0 m-0">#<?php echo e($countUnReporteds--); ?></p>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-sm mb-1 rounded-circle" style="float: right"  data-toggle="modal" data-target="#EditReview<?php echo e($unReported->id); ?>">
                                        
                                        
                                        <i class="fa-solid fa-stethoscope  fa-xl text-light"></i>
                                    </button>
                                    <div class="text-center" style="width:65% ;">
                                        <p class="text-xs text-gray-900 p-0 m-0">اسم الزائر :</p>
                                        <h6 class="text-primary p-0 m-0"><a href="<?php echo e(route('Clinic.patientProfile',$unReported->patient->patient_slug)); ?>"><b><?php echo e($unReported->patient->patient_name); ?></b></a></h6>
                                    </div>
                                    <div class="" style="width: 20%;">
                                        <p class="text-xs text-gray-800 p-0 m-0"><?php echo e($unReported->created_at->format('D d-m-Y')); ?></p>
                                        <p class="text-xs text-gray-800 p-0 m-0"  style="direction:ltr"><?php echo e($unReported->created_at->format('h:i a')); ?></p>
                                    </div>
                                </div>
                                <div class="collapse" id="collapseCardExample<?php echo e($unReported->id); ?>">
                                    <div class="card-body p-2">
                                        <div class="form-row">
                                            <div class="col-lg-8" style="direction:ltr">
                                                <table class="table table-bordered text-center">
                                                    <thead>
                                                        <tr>
                                                            <th>الجنس</th>
                                                            <th>العمر</th>
                                                            <th>التدخين</th>
                                                            <?php if($unReported->patient->blood_type): ?>
                                                                <th>زمرة الدم</th>
                                                            <?php endif; ?>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-gray-800"><?php if($unReported->patient->gender == 'male'): ?> <?php echo e('ذكر'); ?> <?php elseif($unReported->patient->gender == 'female'): ?> <?php echo e('أنثى'); ?> <?php else: ?> لم يتم الإدخال <?php endif; ?></td>
                                                            <?php if($unReported->patient->age && $unReported->patient->age != date('Y') ): ?>
                                                            <td class="text-gray-800" style="direction:rtl"><?php echo e(date('Y') - $unReported->patient->age .' سنة'); ?></td>
                                                            <?php else: ?>
                                                            <td class="text-gray-800" style="direction:rtl">لم يتم الإدخال</td>
                                                            <?php endif; ?>
                                                            <?php if($unReported->patient->smoking): ?>
                                                            <td class="text-gray-800" style="direction:rtl"><?php if($unReported->patient->smoking == 'negative'): ?> <?php echo e('سلبي'); ?> <?php elseif($unReported->patient->smoking == 'positive'): ?>  <?php echo e('إيجابي'); ?> <?php endif; ?></td>
                                                            <?php else: ?>
                                                                <td class="text-gray-800" style="direction:rtl">لم يتم الإدخال</td>
                                                            <?php endif; ?>
                                                            <?php if($unReported->patient->blood_type): ?>
                                                                <td class="text-gray-800" style="direction:rtl"><?php echo e($unReported->patient->blood_type); ?></td>
                                                            <?php endif; ?>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="card  border-right-dark p-2 my-2" style="direction:rtl;text-align:right">
                                                    <div class="text-primary text-uppercase mb-1">سبب الزيارة</div>
                                                    <div class="mb-0 text-gray-800"><?php echo e($unReported->main_complaint); ?></div>
                                                    <?php if($unReported->pain_story): ?>
                                                        <div class="text-primary text-uppercase mb-1">القصة المرضية</div>
                                                        <div class="mb-0 text-gray-800"><?php echo e($unReported->pain_story); ?></div>
                                                    <?php endif; ?>
                                                    <?php if($unReported->medical_report): ?>
                                                        <div class="text-primary text-uppercase mb-1 px-3">رأي الطبيب</div>
                                                        <div class="mb-0 text-gray-800"><?php echo e($unReported->medical_report); ?></div>
                                                    <?php endif; ?>
                                                    <?php if($unReported->treatment_plan): ?>
                                                        <div class="text-primary text-uppercase mb-1 px-3">خطة العلاج</div>
                                                        <div class="mb-0 text-gray-800"><?php echo e($unReported->treatment_plan); ?></div>
                                                    <?php endif; ?>
                                                    <?php if($unReported->med_analysis_T): ?>
                                                        <div class="text-primary text-uppercase mb-1 px-3">التحليل مكتوب</div>
                                                        <div class="mb-0 text-gray-800"><?php echo e($unReported->med_analysis_T); ?></div>
                                                    <?php endif; ?>
                                                    <?php if($unReported->med_photo_T): ?>
                                                        <div class="text-primary text-uppercase mb-1 px-3">الصورة مكتوب</div>
                                                        <div class="mb-0 text-gray-800"><?php echo e($unReported->med_photo_T); ?></div>
                                                    <?php endif; ?>
                                                    <?php if($unReported->doctor_notes): ?>
                                                        <div class="text-primary text-uppercase mb-1">ملاحظات الطبيب</div>
                                                        <div class="mb-0 text-gray-800"><?php echo e($unReported->doctor_notes); ?></div>
                                                    <?php endif; ?>
                                                    <?php if($unReported->date_expecting && (Carbon\Carbon::today() > Carbon\Carbon::parse($unReported->date_expecting))): ?>
                                                        <div class="text-primary text-uppercase mb-1">
                                                            <?php if($unReported->main_complaint ==' - تحديد عملية - تحليل' || $unReported->main_complaint =='تحديد عملية' || $unReported->main_complaint ==' - تحديد عملية - صورة - تحليل' || $unReported->main_complaint ==' - تحديد عملية - صورة'): ?>
                                                                    موعد العملية
                                                            <?php else: ?>
                                                                    الموعد القادم
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="mb-0 text-gray-800"><?php echo e(Carbon\Carbon::parse($unReported->date_expecting)->format('D d-m-Y')); ?></div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                        <?php if($unReported->reviewMedias->count() > 0): ?>
                                        <div class="col-lg-4 bg-gradient-dark my-1" style="direction:rtl;height:360px;border-radius: 0.35rem;">
                                            <div id="carouselIndicatorsReview<?php echo e($unReported->id); ?>" class="carousel slide" data-ride="carousel">
                                                <ol class="carousel-indicators">
                                                    <?php $__currentLoopData = $unReported->reviewMedias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li data-target="#carouselIndicatorsReview<?php echo e($unReported->id); ?>" data-slide-to="<?php echo e($loop->index); ?>" class="<?php echo e($loop->index == 0 ? 'active' : ''); ?>"></li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ol>
                                                <div class="carousel-inner">
                                                    <?php $__currentLoopData = $unReported->reviewMedias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="carousel-item <?php echo e($loop->index == 0 ? 'active' : ''); ?>">
                                                            <img src="<?php echo e(asset('assets/Clinic/'.auth()->user()->doctor_id.'/'.$media->file_name)); ?>" class="d-block" style="border-radius: 0.35rem;height:360px;object-fit:contain;width:100%;" alt="...">
                                                            <a class="position-absolute text-danger" style="right: 40px;bottom: 10px; border:1px solid;border-radius: 100%" href="<?php echo e(route('Clinic.destroyReviewMedia',$media->id)); ?>"><i class=" fas fa-fw  fa-2x fa-trash-alt"></i></a>

                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                                <?php if($unReported->reviewMedias->count() > 1): ?>
                                                <button class="carousel-control-prev" type="button" data-target="#carouselIndicatorsReview<?php echo e($unReported->id); ?>" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-target="#carouselIndicatorsReview<?php echo e($unReported->id); ?>" data-slide="next">
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
                            <!-- Modal Doctor Repory -->
                        <div class="modal fade" id="EditReview<?php echo e($unReported->id); ?>" tabindex="-1" aria-labelledby="EditReview<?php echo e($unReported->id); ?>" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content" style="direction: ltr">
                                    <div class="modal-body py-1" style="direction: rtl">
                                        <form action="<?php echo e(route('Clinic.updateReview_doctor',$unReported->id)); ?>" method="post" enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <div class="d-block py-2" style="width:100% ;direction: rtl">


                                                
                                                <p class="text-center text-gray-800 p-0 m-0"><span class="text-<?php echo e($type); ?> font-weight-bold"><?php echo e($unReported->review_type); ?> للمريض :  </span><a class="text-center text-gray-800 p-0 m-0" href="<?php echo e(route('Clinic.patientProfile',$unReported->patient->patient_slug)); ?>"><b><?php echo e($unReported->patient->patient_name); ?></b></a></p>
                                                <p class="text-center text-xs text-gray-800 p-0 m-0"><a class="text-center text-gray-800 p-0 m-0" href="<?php echo e(route('Clinic.patientProfile',$unReported->patient->patient_slug)); ?>"><b class="text-xs text-gray-900">وقت الزيارة : </b> <?php echo e($unReported->created_at->format('D d/m - h:i a')); ?></a></p>
                                                <p class="text-center text-xs text-gray-800 p-0 m-0">سبب الزيارة : <b><?php echo e($unReported->main_complaint); ?></b></p>
                                            </div>
                                        <hr class="m-0">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                        <label class="text-xs">رأي الطبيب : </label>
                                                        <textarea id="editReview-medical_report<?php echo e($unReported->id); ?>" class="VoiceToText form-control <?php $__errorArgs = ['medical_report'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="medical_report" rows="3" style="padding: 0.375rem 0.75rem;text-align:center" ><?php echo e($unReported->medical_report); ?></textarea>
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
                                                        <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="editReview-medical_report<?php echo e($unReported->id); ?>">
                                                            <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                        </button>
                                                    </div>

                                                    <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                        <label class="text-xs">خطة العلاج : </label>
                                                        <textarea id="editReview-treatment_plan<?php echo e($unReported->id); ?>" class="VoiceToText form-control <?php $__errorArgs = ['treatment_plan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="treatment_plan" rows="3" style="padding: 0.375rem 0.75rem;text-align:center" ><?php echo e($unReported->treatment_plan); ?></textarea>
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
                                                        <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="editReview-treatment_plan<?php echo e($unReported->id); ?>">
                                                            <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                        </button>
                                                    </div>
                                                    <!-- Collapse Modal InsideReviews InsideEmergency -->
                                                    <div class="card mb-2">
                                                        <!-- Card Header - Accordion -->
                                                        <a href="#CollapseEditViewReviewEmergency<?php echo e($unReported->id); ?>" class="d-block card-header py-3" data-toggle="collapse" style=""
                                                            role="button" aria-expanded="true" aria-controls="CollapseEditViewReviewEmergency<?php echo e($unReported->id); ?>">
                                                            <h6 class="m-0 text-xs font-weight-bold text-gray-600 text-center">المزيد  :
                                                                <span class=" <?php if($unReported->main_complaint): ?>
                                                                text-primary
                                                                <?php endif; ?>">سبب الزيارة</span>
                                                                - <span class=" <?php if($unReported->pain_story): ?>
                                                                text-primary
                                                                <?php endif; ?>">القصة المرضية</span>
                                                                - <span class=" <?php if($unReported->med_analysis_T): ?>
                                                                text-primary
                                                                <?php endif; ?>">نص التحليل</span>
                                                                - <span class=" <?php if($unReported->med_photo_T): ?>
                                                                text-primary
                                                                <?php endif; ?>">محتوى الصورة</span>
                                                                - <span class=" <?php if($unReported->doctor_notes): ?>
                                                                text-primary
                                                                <?php endif; ?>">ملاحظات الزيارة</span>
                                                                <?php if(Carbon\Carbon::today() < Carbon\Carbon::parse($unReported->date_expecting)): ?>
                                                                    - <span class=" <?php if($unReported->date_expecting): ?>
                                                                        text-primary
                                                                        <?php endif; ?>"><?php if($unReported->main_complaint ==' - تحديد عملية - تحليل' || $unReported->main_complaint =='تحديد عملية' || $unReported->main_complaint ==' - تحديد عملية - صورة - تحليل' || $unReported->main_complaint ==' - تحديد عملية - صورة'): ?>
                                                                             موعد العملية
                                                                        <?php else: ?>
                                                                             الموعد القادم
                                                                        <?php endif; ?></span>
                                                                <?php endif; ?>

                                                            </h6>
                                                        </a>
                                                        <!-- Card Content - Collapse -->
                                                        <div class="collapse" id="CollapseEditViewReviewEmergency<?php echo e($unReported->id); ?>">
                                                            <div class="card-body px-1 py-1">
                                                                <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                    <label class="text-xs">نص التحليل : </label>
                                                                    <textarea id="editReview-med_analysis_T<?php echo e($unReported->id); ?>" class="VoiceToText form-control <?php $__errorArgs = ['med_analysis_T'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="med_analysis_T" rows="1" style="padding: 0.375rem 0.75rem;text-align:center" ><?php echo e($unReported->med_analysis_T); ?></textarea>
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
                                                                    <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:39px;" for="editReview-med_analysis_T<?php echo e($unReported->id); ?>">
                                                                        <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                    <label class="text-xs">محتوى الصورة : </label>
                                                                    <textarea id="editReview-med_photo_T<?php echo e($unReported->id); ?>" class="VoiceToText form-control <?php $__errorArgs = ['med_photo_T'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="med_photo_T" rows="1" style="padding: 0.375rem 0.75rem;text-align:center" ><?php echo e($unReported->med_photo_T); ?></textarea>
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
                                                                    <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:39px;" for="editReview-med_photo_T<?php echo e($unReported->id); ?>">
                                                                        <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="form-group mb-2" style="direction:rtl;text-align:right" >
                                                                    <label class="text-xs"><?php if($unReported->main_complaint ==' - تحديد عملية - تحليل' || $unReported->main_complaint =='تحديد عملية' || $unReported->main_complaint ==' - تحديد عملية - صورة - تحليل' || $unReported->main_complaint ==' - تحديد عملية - صورة'): ?>
                                                                             موعد العملية
                                                                        <?php else: ?>
                                                                             الموعد القادم
                                                                        <?php endif; ?> : </label>
                                                                    

                                                                        
                                                                    
                                                                    <input type="date" min="<?php echo e(Carbon\Carbon::tomorrow()->format('Y-m-d')); ?>" <?php if($unReported->date_expecting): ?>
                                                                        value="<?php echo e(Carbon\Carbon::parse($unReported->date_expecting)->format('Y-m-d')); ?>"
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
                                                                    <textarea id="editReview-doctor_notes<?php echo e($unReported->id); ?>" class=" VoiceToText form-control <?php $__errorArgs = ['doctor_notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="doctor_notes" rows="3" style="padding: 0.375rem 0.75rem;text-align:center"><?php echo e($unReported->doctor_notes); ?></textarea>
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
                                                                    <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="editReview-doctor_notes<?php echo e($unReported->id); ?>">
                                                                        <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                    </button>
                                                                </div>

                                                                
                                                                <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                    <label class="text-xs">القصة المرضية : </label>
                                                                    <textarea id="editReview-pain_story<?php echo e($unReported->id); ?>" class=" VoiceToText form-control <?php $__errorArgs = ['pain_story'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="pain_story" rows="3" style="padding: 0.375rem 0.75rem;text-align:center" ><?php echo e($unReported->pain_story); ?></textarea>
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
                                                                    <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="editReview-pain_story<?php echo e($unReported->id); ?>">
                                                                        <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                    </button>
                                                                </div>

                                                                
                                                                
                                                            </div>
                                                        </div>
                                                    </div><!-- Collapse Modal View Review Emergency -->
                                                </div>
                                                <div class="col-lg-4 bg-new-image"></div>

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
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="card border-bottom-info shadow py-1 my-1">
                            <div class="card-body text-center text-info" >
                                <b>لا يوجد</b>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

            <div class="tab-pane fade" id="phoneTurn" role="tabpanel" aria-labelledby="phoneTurn-tab">
                <div class=" card border-right-dark shadow p-2 my-3">
                    <div class="card-header p-3">
                        <?php
                            $countPhoneTurns =$phoneTurns->count();
                        ?>
                        <h5 class="text-center text-dark p-0 m-0 " ><b>حجوزات هاتفية</b><span class="badge btn-light btn-circle text-dark badge-counter"><?php echo e($countPhoneTurns); ?></span></h5>
                        <?php if($countPhoneTurns>0): ?>
                            <a href="<?php echo e(route('Clinic.destroyReviewPhoneTurns')); ?>" class="text-danger" type="button" style="float:right"><i class="fas fa-fw fa-trash-alt"></i><b class="d-none d-md-inline-block">حذف الجميع</b></a>
                        <?php endif; ?>
                    </div>
                    <?php $__empty_1 = true; $__currentLoopData = $phoneTurns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patientReview): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
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
                                    <div class="d-sm-block d-md-inline-flex" style="width:10% ;">
                                        <div>
                                            <a class="card_dropdown" href="#collapseCardExample<?php echo e($patientReview->id); ?>" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample<?php echo e($patientReview->id); ?>">
                                            </a>
                                        </div>
                                        <div class="d-inline-block w-100 text-center">
                                            <p class="text-xs text-gray-800 font-weight-bold p-0 m-0"><?php echo e($patientReview->review_type); ?></p>
                                            <p class="text-xs text-gray-800 font-weight-bold p-0 m-0">#<?php echo e($countPhoneTurns--); ?></p>
                                        </div>
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
                                                            <?php if($patientReview->patient->age  && $patientReview->patient->age != date('Y')): ?>
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
                                                    <?php if($patientReview->date_expecting && (Carbon\Carbon::today() < Carbon\Carbon::parse($patientReview->date_expecting))): ?>
                                                        <div class="text-primary text-uppercase mb-1">
                                                            <?php if($patientReview->main_complaint ==' - تحديد عملية - تحليل' || $patientReview->main_complaint =='تحديد عملية' || $patientReview->main_complaint ==' - تحديد عملية - صورة - تحليل' || $patientReview->main_complaint ==' - تحديد عملية - صورة'): ?>
                                                                موعد العملية
                                                            <?php else: ?>
                                                                الموعد القادم
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="mb-0 text-gray-800"><?php echo e(Carbon\Carbon::parse($patientReview->date_expecting)->format('D d-m-Y')); ?></div>
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
                        <div class="card border-bottom-info shadow py-1 my-1">
                            <div class="card-body text-center text-info" >
                                <b>لا يوجد</b>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.myClinic', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Projects\xampp\htdocs\MyClinicApp8\resources\views/myClinic/patients/patientsInClinic.blade.php ENDPATH**/ ?>