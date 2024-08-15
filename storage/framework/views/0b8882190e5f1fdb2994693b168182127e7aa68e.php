<?php $__env->startSection('content'); ?>
    <div class="mb-5 pb-5 mt-3" style="direction:ltr;text-align:right">
        <?php if(count($errors)>0): ?>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="alert alert-secondary" role="alert">
                    <?php echo e($item); ?>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <div class="row" >
            <div class="col-lg-4 bg-profile-image"></div>
            <div class="col-lg-8">
                <div class="card border-left-primary shadow h-100">
                    <!-- Card Header - Dropdown -->

                    <?php if($patient->deleted_at == null): ?>
                        <div class="card-header p-3 " style="display:inline-flex;direction:rtl">
                    <?php else: ?>
                        <div class="card-header bg-gradient-danger p-3 " style="display:inline-flex;direction:rtl">
                    <?php endif; ?>
                        <div class="d-sm-block d-md-inline-flex">
                            <?php if($patient->deleted_at == null): ?>
                                <div class="dropdown no-arrow ml-2" style="line-height :normal;">
                                    <a class="dropdown-toggle px-1" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                        aria-labelledby="dropdownMenuLink" style="text-align:right">
                                        <div class="dropdown-header text-gray-800 bg-gray-300"><h6><b>الإجراءات</b></h6></div>
                                        
                                        <a href="<?php echo e(route('Clinic.printPatientProfile' ,$patient->patient_slug)); ?>" class="dropdown-item " type="button"><i class="fa-solid fa-lg fa-print"></i> طباعة ملف الزائر</a>
                                        <a class="dropdown-item " type="button" data-toggle="modal" data-target="#Edit">تعديل ملف الزائر</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item " type="button" data-toggle="modal" data-target="#Delete">حذف الملف</a>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div>
                                    <a class="btn btn-primary btn-circle btn-sm" type="button" href="<?php echo e(route('Clinic.restorePatient',$patient->patient_slug)); ?>"  data-toggle="tooltip" title="استعادة ملف الزائر">
                                        <i class="fa-solid fa-retweet"></i>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div>
                                <a class="card_dropdown" href="#collapseCardExample" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                </a>
                            </div>
                        </div>
                        <div class="text-center" style="width:100%;">
                            <p class="text-xs text-gray-900 p-0 m-0">اسم الزائر :</p>
                            <h6 class="text-primary p-0 m-0"><b><?php echo e($patient->patient_name); ?></b></h6>
                        </div>
                        <div style="text-align: left;width: 30%;">
                            <p class="text-xs text-gray-900 p-0 m-0">تاريخ الإدخال :</p>
                            <p class="text-xs text-gray-800  p-0 m-0"><?php echo e($patient->created_at->format('D d-m-Y')); ?></p>
                            <p class="text-xs text-gray-800  p-0 m-0" style="direction: ltr"><?php echo e($patient->created_at->format('h:i a')); ?></p>

                        </div>
                    </div>
                    <div class="collapse show" id="collapseCardExample">
                        <div class="card-body pb-2 pt-4" style="direction: rtl">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" >
                                    <thead>
                                        <tr>
                                            <th>الجنس</th>
                                            <th>العمر</th>
                                            <th>الحالة الإجتماعية</th>
                                            <th>عدد الأولاد</th>
                                            <th>التدخين</th>
                                            <?php if($patient->blood_type): ?>
                                            <th>زمرة الدم</th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php if($patient->gender): ?>
                                                <td class="text-gray-800"><?php if($patient->gender == 'male'): ?> <?php echo e('ذكر'); ?> <?php elseif($patient->gender == 'female'): ?> <?php echo e('أنثى'); ?> <?php endif; ?></td>
                                            <?php else: ?>
                                                <td class="text-gray-800" style="direction:rtl">لم يتم الإدخال</td>
                                            <?php endif; ?>
                                            <?php if($patient->age && $patient->age!= date('Y') ): ?>
                                                <td class="text-gray-800" style="direction:rtl"><?php echo e(date('Y') - $patient->age .' سنة'); ?></td>
                                            <?php else: ?>
                                                <td class="text-gray-800" style="direction:rtl">لم يتم الإدخال</td>
                                            <?php endif; ?>
                                            <?php if($patient->relationship): ?>
                                                <td class="text-gray-800" style="direction:rtl"><?php if($patient->relationship == 'married'): ?> <?php echo e('متزوج'); ?> <?php elseif($patient->relationship == 'single'): ?>  <?php echo e('أعزب'); ?> <?php endif; ?></td>
                                            <?php else: ?>
                                                <td class="text-gray-800" style="direction:rtl">لم يتم الإدخال</td>
                                            <?php endif; ?>
                                            <?php if($patient->child_count): ?>
                                                <td class="text-gray-800" style="direction:rtl"><?php echo e($patient->child_count); ?></td>
                                            <?php else: ?>
                                                <td class="text-gray-800" style="direction:rtl">لم يتم الإدخال</td>
                                            <?php endif; ?>
                                            <?php if($patient->smoking): ?>
                                                <td class="text-gray-800" style="direction:rtl"><?php if($patient->smoking == 'negative'): ?> <?php echo e('سلبي'); ?> <?php elseif($patient->smoking == 'positive'): ?>  <?php echo e('إيجابي'); ?> <?php endif; ?></td>
                                            <?php else: ?>
                                                <td class="text-gray-800" style="direction:rtl">لم يتم الإدخال</td>
                                            <?php endif; ?>
                                            <?php if($patient->blood_type): ?>
                                                <td class="text-gray-800" style="direction:rtl"><?php echo e($patient->blood_type); ?></td>
                                            <?php endif; ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Collapsable Card Example -->
                            <div class="card mb-4">
                                <!-- Card Header - Accordion -->
                                <a href="#CardMoreDetails" class="d-block card-header py-3" data-toggle="collapse" style=""
                                    role="button" aria-expanded="true" aria-controls="CardMoreDetails">
                                    <h6 class="m-0 font-weight-bold text-gray-900 text-center"><span>السوابق</span> :
                                         ( <span class=" <?php if($patient->older_surgery): ?>
                                        text-primary
                                        <?php else: ?>
                                            text-gray-700
                                        <?php endif; ?>">الجراحية</span>

                                        - <span class=" <?php if($patient->older_sicky): ?>
                                        text-primary
                                        <?php else: ?>
                                            text-gray-700
                                        <?php endif; ?>">المرضية</span>

                                        - <span class=" <?php if($patient->older_sensitive): ?>
                                        text-primary
                                        <?php else: ?>
                                            text-gray-700
                                        <?php endif; ?>">التحسسية</span> )

                                        - <span class=" <?php if($patient->permanent_medic): ?>
                                        text-primary
                                        <?php else: ?>
                                            text-gray-700
                                        <?php endif; ?>">الأدوية الدائمة</span>

                                        - <span class=" <?php if($patient->patient_state): ?>
                                        text-primary
                                        <?php else: ?>
                                            text-gray-700
                                        <?php endif; ?>">حول المريض</span>
                                    </h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse" id="CardMoreDetails">
                                    <div class="card-body p-1">
                                        <div class="card mb-2 px-2 py-3 border-right-primary">
                                            <div class="text-lg text-primary text-uppercase mb-1">السوابق الجراحية</div>
                                            <div class="h6 mb-0 text-gray-800">
                                                <?php if($patient->older_surgery): ?>
                                                    <?php echo e($patient->older_surgery); ?>

                                                <?php else: ?>
                                                    لا يوجد
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="card mb-2 px-2 py-3 border-right-primary">
                                            <div class="text-lg text-primary text-uppercase mb-1">السوابق المرضية</div>
                                            <div class="h6 mb-0 text-gray-800">
                                                <?php if($patient->older_sicky): ?>
                                                    <?php echo e($patient->older_sicky); ?>

                                                <?php else: ?>
                                                    لا يوجد
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="card mb-2 px-2 py-3 border-right-primary">
                                            <div class="text-lg text-primary text-uppercase mb-1">السوابق التحسسية</div>
                                            <div class="h6 mb-0 text-gray-800">
                                                <?php if($patient->older_sensitive): ?>
                                                    <?php echo e($patient->older_sensitive); ?>

                                                <?php else: ?>
                                                    لا يوجد
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="card mb-2 px-2 py-3 border-right-primary">
                                            <div class="text-lg text-primary text-uppercase mb-1">الأدوية الدائمة</div>
                                            <div class="h6 mb-0 text-gray-800">
                                                <?php if($patient->permanent_medic): ?>
                                                    <?php echo e($patient->permanent_medic); ?>

                                                <?php else: ?>
                                                    لا يوجد
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="card mb-2 px-2 py-3 border-right-primary">
                                            <div class="text-lg text-primary text-uppercase mb-1">ملاحظات حول الزائر:</div>
                                            <div class="h6 mb-0 text-gray-800">
                                                <?php if($patient->patient_state): ?>
                                                    <?php echo e($patient->patient_state); ?>

                                                <?php else: ?>
                                                    لا يوجد
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-foot p-2" style=";direction:rtl">
                       <div class="w-100 d-inline-flex px-4">
                            <div class="mb-3 w-100 text-center d-block d-md-inline-flex" style="width: 30%;">
                                <p class="text-xs text-primary p-0 m-0">رقم الهاتف :&nbsp; </p>
                                <p class="text-xs text-gray-900  p-0 m-0" style=" direction:ltr"> <b>
                                    <?php if($patient->phone): ?>
                                        <?php echo e($patient->phone); ?>

                                    <?php else: ?>
                                        ---------------------
                                    <?php endif; ?>
                                </b></p>
                            </div>
                            <div class="mb-3 w-100 text-center d-block d-md-inline-flex" style="width: 20%;">
                                <p class="text-xs text-primary p-0 m-0">المهنة : &nbsp;</p>
                                <p class="text-xs text-gray-900  p-0 m-0" style=" direction:ltr"> <b>
                                    <?php if($patient->patient_job): ?>
                                        <?php echo e($patient->patient_job); ?>

                                    <?php else: ?>
                                        ---------------------
                                    <?php endif; ?>
                                </b></p>
                            </div>
                            <div class="mb-3 w-100 text-center d-block d-md-inline-flex" style="width: 50%;">
                                <p class="text-xs text-primary p-0 m-0">العنوان : &nbsp;</p>
                                <p class="text-xs text-gray-900  p-0 m-0" style=" direction:ltr"> <b>
                                    <?php if($patient->patient_address): ?>
                                        <?php echo e($patient->patient_address); ?>

                                    <?php else: ?>
                                        ---------------------
                                    <?php endif; ?>
                                </b></p>
                            </div>
                       </div>
                    </div>
                    <!-- Modal Profile -->
                    <div style="direction:ltr">
                        <!-- Modal Patient Delete -->
                        <div class="modal fade" id="Delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <h5 class="text-center text-danger">رسالة تأكيد</h5>
                                        <div class="row p-3">
                                            <div class="col-lg-4 d-none d-lg-block bg-deleted-image"></div>
                                            <div class="col-lg-8" style="text-align:center">
                                                <h5 class="text-center">هل أنت متأكد من حذف الملف ؟</h5>
                                                <p> عند التأكيد سوف يتم إرسال الملف مع جميع الزيارات إلى سلة المحذوفات </p>
                                                <button type="button" class="btn btn-secondary btn-user" data-dismiss="modal">إلغاء</button>
                                                <a href="<?php echo e(route('Clinic.softDeletesPatient',$patient->patient_slug)); ?>" class="btn btn-danger btn-user ">تأكيد</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Modal Patient Delete -->

                        <!-- Modal Edit Profile -->
                        

                        <!-- Modal Patient Profile -->
                        <div class="modal fade" id="Edit" tabindex="-1" aria-labelledby="patientEdit" aria-hidden="true">
                            <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content border-right-primary">
                                    <div class="modal-body">
                                        <div class="card-body p-0" style="direction:ltr">
                                            <!-- Nested Row within Card Body -->
                                            <div  style="overflow-y:auto ;height: 100%;">
                                            <div class="text-center">
                                                <h1 class="h6 font-weight-bold text-gray-900 my-2 text-center" style="direction:rtl;">تعديل على ملف  <?php echo e($patient->patient_name); ?></h1>
                                            </div>


                                                <form  class="user px-2" method="POST" action="<?php echo e(route('Clinic.updatePatient',$patient->patient_slug)); ?>">
                                                    <?php echo csrf_field(); ?>

                                                    <div class="form-group mb-2" style="direction: rtl;margin-bottom: 0.5rem;">
                                                        
                                                        
                                                        <div class="form-group mb-2 position-relative" style="direction: rtl;margin-bottom: 0.5rem;">
                                                            <label class="text-xs mr-3" style="text-align:right;float: right;  direction:rtl;">اسم الزائر : </label>
                                                            <input class="VoiceToText form-control <?php $__errorArgs = ['patient_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text" id="patient_name" value="<?php echo e($patient->patient_name); ?>" name="patient_name" required placeholder=" أكتب الاسم والكنية "
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
unset($__errorArgs, $__bag); ?>" value="<?php echo e($patient->phone); ?>" name="phone" placeholder=" أكتب رقم الهاتف"
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
unset($__errorArgs, $__bag); ?>" value="<?php if($patient->age != null): ?><?php echo e(date('Y') -$patient->age); ?> <?php endif; ?>" name="age" placeholder="1~99"
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
                                                                        <input type="radio" id="editgenderMale" name="gender" <?php if($patient->gender == 'male'): ?> checked  <?php endif; ?>  value="male" class="custom-control-input">
                                                                        <label class="text-xs custom-control-label" for="editgenderMale">ذكر</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="editgenderFemale" name="gender" <?php if($patient->gender == 'female'): ?> checked  <?php endif; ?>  value="female" class="custom-control-input">
                                                                        <label class="text-xs custom-control-label" for="editgenderFemale">أنثى</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-2 col-6" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                                <div class="custom-radio custom-control-inline">
                                                                    <label class="text-xs mr-3">التدخين : </label>
                                                                </div>
                                                                <div class="card d-block" style="height: 38px">
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="editnegative" name="smoking" value="negative" <?php if($patient->smoking == 'negative'): ?> checked  <?php endif; ?> class="custom-control-input">
                                                                        <label class="text-xs custom-control-label" for="editnegative">سلبي</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="editpositive" name="smoking"  value="positive" <?php if($patient->smoking == 'positive'): ?> checked  <?php endif; ?> class="custom-control-input">
                                                                        <label class="text-xs custom-control-label" for="editpositive">إيجابي</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- collapsePatientProfile -->
                                                        <div class="card mb-2">
                                                            <!-- Card Header - Accordion -->
                                                            <a href="#collapsePatientProfile" class="d-block card-header py-3" data-toggle="collapse" style=""
                                                                role="button" aria-expanded="true" aria-controls="collapsePatientProfile">
                                                                <h6 class="m-0 text-xs font-weight-bold text-primary text-center">المزيد ...</h6>
                                                            </a>
                                                            <!-- Card Content - Collapse -->
                                                            <div class="collapse" id="collapsePatientProfile">
                                                                <div class="card-body px-1 py-3">
                                                                    <div class="form-row">
                                                                        <div class="form-group mb-2 col-6" style="direction:rtl;text-align:right;margin-bottom: 0.5rem;">
                                                                            <label class="text-xs mb-0 mr-3" style="padding-bottom: 0.2rem;text-align:right;direction:rtl;">الحالة الإجتماعية : </label>
                                                                            <div class="card d-block" style="height: 38px">
                                                                                <div class="custom-control custom-radio custom-control-inline">
                                                                                    <input type="radio" id="editRelationshipMarried" name="relationship" value="married" <?php if( $patient->relationship == 'married'): ?> checked  <?php endif; ?>  class="custom-control-input">
                                                                                    <label class="text-xs custom-control-label" for="editRelationshipMarried">متزوج</label>
                                                                                </div>
                                                                                <div class="custom-control custom-radio custom-control-inline">
                                                                                    <input type="radio" id="editRelationshipSingle" name="relationship"  value="single" <?php if( $patient->relationship == 'single'): ?> checked  <?php endif; ?> class="custom-control-input">
                                                                                    <label class="text-xs custom-control-label" for="editRelationshipSingle">أعزب</label>
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
unset($__errorArgs, $__bag); ?>" value="<?php echo e($patient->child_count); ?>" name="child_count"
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
unset($__errorArgs, $__bag); ?>" value="<?php echo e($patient->patient_job); ?>" id="patient_job" name="patient_job"
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
unset($__errorArgs, $__bag); ?>" id="patient_address" value="<?php echo e($patient->patient_address); ?>" name="patient_address"
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
                                                                        <textarea  class="form-control" name="older_surgery" rows="2" style="height:38px;font-size: 75%;padding: 0.375rem 0.75rem;text-align:center"
                                                                            placeholder=" أكتب السوابق الجراحية في حال وجودها"><?php echo e($patient->older_surgery); ?></textarea>
                                                                    </div>
                                                                    <div class="form-group mb-2"  style="direction:rtl;margin-bottom: 0.5rem;">
                                                                        <label class="text-xs mr-3" style="text-align:right;float: right; direction:rtl;">السوابق المرضية : </label>
                                                                        <textarea  class="form-control" name="older_sicky" rows="2" style="padding: 0.375rem 0.75rem;text-align:center;height:38px;font-size: 75%"
                                                                            placeholder=" أكتب السوابق المرضية في حال وجودها"><?php echo e($patient->older_sicky); ?></textarea>
                                                                    </div>
                                                                    <div class="form-group mb-2"  style="direction:rtl;margin-bottom: 0.5rem;">
                                                                        <label class="text-xs mr-3" style="text-align:right;float: right; direction:rtl;">السوابق التحسسية : </label>
                                                                        <textarea  class="form-control" name="older_sensitive" rows="2" style="padding: 0.375rem 0.75rem;text-align:center;height:38px;font-size: 75%"
                                                                            placeholder=" أكتب السوابق التحسسية في حال وجودها"><?php echo e($patient->older_sensitive); ?></textarea>
                                                                    </div>
                                                                    <div class="form-group mb-2"  style="direction:rtl;margin-bottom: 0.5rem;">
                                                                        <label class="text-xs mr-3" style="text-align:right;float: right; direction:rtl;">الأدوية الدائمة : </label>
                                                                        <textarea  class="form-control" name="permanent_medic" rows="1" style="height:38px;font-size: 75%;padding: 0.375rem 0.75rem;text-align:center"
                                                                            placeholder=" أكتب الأدوية الدائمة في حال وجودها"><?php echo e($patient->permanent_medic); ?></textarea>
                                                                    </div>
                                                                    <div class="form-group mb-2"  style="direction:rtl;margin-bottom: 0.5rem;">
                                                                        <label class="text-xs mr-3" style="text-align:right;float: right; direction:rtl;">ملاحظات حول المريض : </label>
                                                                        <input type="text" class="form-control " name="patient_state" value="<?php echo e($patient->patient_state); ?>" placeholder=" أكتب ملاحظات في حال وجودها"
                                                                            style="padding: 0.375rem 0.75rem;height:38px;font-size: 75%;text-align:center">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><!-- collapsePatientProfile -->
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
                        </div><!-- Modal Patient Profile -->

                        

                    </div><!-- Modal Profile -->
                </div>
            </div>
        </div>
        <hr>
        
            <?php $__empty_1 = true; $__currentLoopData = $patientReviews->whereNull('patient_review_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php if($review->review_type == 'معاينة'): ?>
                <?php
                $type ='success'
                ?>
                <?php elseif($review->review_type == 'مراجعة'): ?>
                <?php
                $type ='warning'
                ?>
                <?php elseif($review->review_type == 'اسعافية' || $review->review_type == 'عمل جراحي'): ?>
                <?php
                $type ='danger'
                ?>
                <?php else: ?>
                <?php
                $type ='info'
                ?>
                <?php endif; ?>
                <div class="card my-2 shadow border-bottom-<?php echo e($type); ?> border-top-<?php echo e($type); ?>">
                
                    <?php if($review->patient->deleted_at == null): ?>
                        <div class="card-header p-3 " style="display:inline-flex;direction:rtl">
                    <?php else: ?>
                        <div class="card-header bg-gradient-danger p-3 " style="display:inline-flex;direction:rtl">
                    <?php endif; ?>
                        <div class="d-sm-block d-md-inline-flex">
                            <?php if($patient->deleted_at == null): ?>
                                <div class="dropdown no-arrow ml-2" style="line-height :normal;">
                                    <a class="dropdown-toggle px-1" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                        aria-labelledby="dropdownMenuLink" style="text-align:right">
                                        <div class="dropdown-header text-gray-800 bg-gray-300"><h6><b>الإجراءات</b></h6></div>
                                        
                                        <a href="<?php echo e(route('Clinic.printReview' ,$review->id)); ?>" class="dropdown-item " type="button"><i class="fa-solid fa-lg fa-print"></i> طباعة ال<?php echo e($review->review_type); ?></a>
                                        <a class="dropdown-item " type="button" data-toggle="modal" data-target="#EditReview<?php echo e($review->id); ?>">تعديل ال<?php echo e($review->review_type); ?></a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item " type="button" data-toggle="modal" data-target="#DeleteReview<?php echo e($review->id); ?>">حذف ال<?php echo e($review->review_type); ?></a>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div  class="ml-2">
                                <a class="card_dropdown" href="#collapse<?php echo e($review->id); ?>" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapse<?php echo e($review->id); ?>">
                                </a>
                            </div>
                            <div >
                                <a  class="mx-2" type="button" onclick="document.getElementById('specialWithStar<?php echo e($review->id); ?>').submit();" >
                                    <?php if($review->special_with_star == 1): ?>
                                        <i class="fa-solid fa-star" style="color: #f2df0d;"  data-toggle="tooltip" title="إلغاء التمييز"></i>
                                    <?php elseif($review->special_with_star == 0): ?>
                                        <i class="fa-solid fa-star text-gray-400"  data-toggle="tooltip" title="تمييز بنجمة"></i>
                                    <?php endif; ?>
                                </a>
                                <form id="specialWithStar<?php echo e($review->id); ?>" action="<?php echo e(route('Clinic.specialWithStar_do',$review->id)); ?>" method="post" class="d-none">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="special_with_star" <?php if($review->special_with_star == 1): ?>
                                    value="0"
                                    <?php else: ?>
                                    value="1"
                                    <?php endif; ?> >
                                </form>
                            </div>
                        </div>
                        <div class="text-center" style="width:100%;">
                            <h5 class="text-<?php echo e($type); ?> p-0 m-0"><b><?php echo e($review->review_type); ?></b>
                                <?php if($review->done == 0): ?>
                                    <span class="text-xs text-gray-900">لم يتم الفحص</span>
                                    <div >
                                        <form  action="<?php echo e(route('Clinic.tasksReview',$review->id)); ?>" method="post">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-white" style="width:20%" name="done" value="1" ><i class="fa-regular fa-circle-check text-gray-400"></i></button>
                                        </form>
                                    </div>
                                <?php elseif($review->done == 1): ?>
                                    <i class="fa-regular fa-circle-check text-primary"></i>
                                <?php endif; ?>
                            </h5>
                        </div>
                        <div style="text-align: left;width: 30%;">
                            <p class="text-xs text-gray-900 p-0 m-0">تاريخ الزيارة :</p>
                            <p class="text-xs text-gray-800  p-0 m-0"><?php echo e($review->created_at->format('D d-m-Y')); ?></p>
                            <p class="text-xs text-gray-800  p-0 m-0" style="direction: ltr"><?php echo e($patient->created_at->format('h:i a')); ?></p>
                        </div>
                    </div>
                    
                    <div class="collapse show" id="collapse<?php echo e($review->id); ?>">
                        <div class="card-body p-2 <?php if($review->done != 1): ?> bg-empty-image <?php endif; ?> ">
                            <div class="row px-1" style="direction:rtl;height:auto ;">
                                <div class="col-lg-6 card my-1 p-2" style="direction:ltr;height:360px ;overflow-y:auto">
                                    <ul style="direction:rtl;">
                                        <li><div class="text-xs text-<?php echo e($type); ?> text-uppercase mx-1"><b>سبب الزيارة</b> :</div></li>
                                        <div class="h6 mb-0 text-gray-800"><?php echo e($review->main_complaint); ?></div>

                                        <li><div class="text-xs text-<?php echo e($type); ?> text-uppercase mx-1"><b>القصة المرضية</b> :</div></li>
                                        <div class="h6 mb-0 text-gray-800">
                                            <?php if($review->pain_story): ?>
                                                <?php echo e($review->pain_story); ?>

                                            <?php else: ?>
                                                ------------------------------
                                            <?php endif; ?>
                                        </div>

                                        <li><div class="text-xs text-<?php echo e($type); ?> text-uppercase mx-1"><b>التحليل مكتوب</b> :</div></li>
                                        <div class="h6 mb-0 text-gray-800">
                                            <?php if($review->med_analysis_T): ?>
                                                <?php echo e($review->med_analysis_T); ?>

                                            <?php else: ?>
                                                ------------------------------
                                            <?php endif; ?>
                                        </div>
                                        <li><div class="text-xs text-<?php echo e($type); ?> text-uppercase mx-1"><b>محتوى الصورة</b> :</div></li>
                                        <div class="h6 mb-0 text-gray-800">
                                            <?php if($review->med_photo_T): ?>
                                                <?php echo e($review->med_photo_T); ?>

                                            <?php else: ?>
                                                ------------------------------
                                            <?php endif; ?>
                                        </div>
                                        <li><div class="text-xs text-<?php echo e($type); ?> text-uppercase mx-1"><b>رأي الطبيب</b> :</div></li>
                                        <div class="h6 mb-0 text-gray-800">
                                            <?php if($review->medical_report): ?>
                                                <?php echo e($review->medical_report); ?>

                                            <?php else: ?>
                                                ------------------------------
                                            <?php endif; ?>
                                        </div>

                                        <li><div class="text-xs text-<?php echo e($type); ?> text-uppercase mx-1"><b>خطة العلاج</b> :</div></li>
                                        <div class="h6 mb-0 text-gray-800">
                                            <?php if($review->treatment_plan): ?>
                                                <?php echo e($review->treatment_plan); ?>

                                            <?php else: ?>
                                                ------------------------------
                                            <?php endif; ?>
                                        </div>

                                        <li><div class="text-xs text-<?php echo e($type); ?> text-uppercase mx-1"><b>
                                            <?php if($review->main_complaint ==' - تحديد عملية - تحليل' || $review->main_complaint =='تحديد عملية' || $review->main_complaint ==' - تحديد عملية - صورة - تحليل' || $review->main_complaint ==' - تحديد عملية - صورة'): ?>
                                                تاريخ موعد العملية المتوقع
                                            <?php else: ?>
                                                تاريخ الموعد القادم
                                            <?php endif; ?>
                                        </b> :</div></li>
                                        <div class="h6 mb-0 text-gray-800">
                                            <?php if($review->date_expecting == null): ?>
                                                لا يوجد زيارة متوقعة
                                            <?php else: ?>
                                                <?php echo e(Carbon\Carbon::parse($review->date_expecting)->format('D d-m-Y')); ?>

                                            <?php endif; ?>
                                        </div>

                                        <li><div class="text-xs text-<?php echo e($type); ?> text-uppercase mx-1"><b>ملاحظات الطبيب</b> :</div></li>
                                        <div class="h6 mb-0 text-gray-800">
                                            <?php if($review->doctor_notes): ?>
                                                <?php echo e($review->doctor_notes); ?>

                                            <?php else: ?>
                                                ------------------------------
                                            <?php endif; ?>
                                        </div>

                                        <li><div class="text-xs text-<?php echo e($type); ?> text-uppercase mx-1"><b>تاريخ الزيارة</b> :</div></li>
                                        <div class="h6 mb-0 text-gray-800"><?php echo e($review->created_at->format('D d-m-Y')); ?></div>

                                    </ul>

                                </div>
                                
                                <?php if($review->reviewMedias->count() > 0): ?>
                                    <div class="col-lg-6 bg-gradient-dark my-1" style="direction:rtl;height:360px;border-radius: 0.35rem;">
                                        <div id="carouselIndicatorsReview<?php echo e($review->id); ?>" class="carousel slide" data-ride="carousel">
                                            <ol class="carousel-indicators">
                                                <?php $__currentLoopData = $review->reviewMedias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li data-target="#carouselIndicatorsReview<?php echo e($review->id); ?>" data-slide-to="<?php echo e($loop->index); ?>" class="<?php echo e($loop->index == 0 ? 'active' : ''); ?>"></li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ol>
                                            <div class="carousel-inner">
                                                <?php $__currentLoopData = $review->reviewMedias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="carousel-item <?php echo e($loop->index == 0 ? 'active' : ''); ?>">
                                                        <img src="<?php echo e(asset('assets/Clinic/'.auth()->user()->doctor_id.'/'.$media->file_name)); ?>" class="d-block" style="border-radius: 0.35rem;height:360px;object-fit:contain;width:100%;" alt="...">
                                                        <a class="position-absolute text-danger" style="right: 40px;bottom: 10px; border:1px solid;border-radius: 100%" href="<?php echo e(route('Clinic.destroyReviewMedia',$media->id)); ?>"><i class=" fas fa-fw  fa-2x fa-trash-alt"></i></a>

                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                            <?php if($review->reviewMedias->count() > 1): ?>
                                            <button class="carousel-control-prev" type="button" data-target="#carouselIndicatorsReview<?php echo e($review->id); ?>" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-target="#carouselIndicatorsReview<?php echo e($review->id); ?>" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only  text-primary">Next</span>
                                            </button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="col-lg-6 bg-register-image"></div>
                                <?php endif; ?>
                            </div>
                            <hr>

                            
                            <div class="row mr-2" style="direction:rtl">
                                <?php $__empty_2 = true; $__currentLoopData = $review->insideReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $insideReview): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                                    <?php if($insideReview->review_type == 'معاينة'): ?>
                                        <?php
                                        $type1 ='success'
                                        ?>
                                    <?php elseif($insideReview->review_type == 'مراجعة'): ?>
                                        <?php
                                        $type1 ='warning'
                                        ?>
                                    <?php elseif($insideReview->review_type == 'اسعافية' || $insideReview->review_type == 'عمل جراحي'): ?>
                                        <?php
                                        $type1 ='danger'
                                        ?>
                                        <?php else: ?>
                                        <?php
                                        $type1 ='info'
                                        ?>
                                    <?php endif; ?>
                                    <div class="col-lg-12 col-md-12">

                                        <div class=" my-1 card border-right-<?php echo e($type1); ?>" >
                                            
                                            <?php if($patient->deleted_at == null): ?>
                                                <div class="card-header p-3 " style="display:inline-flex;direction:rtl">
                                            <?php else: ?>
                                                <div class="card-header bg-gradient-danger p-3 " style="display:inline-flex;direction:rtl">
                                            <?php endif; ?>
                                                <div class="d-sm-block d-md-inline-flex">
                                                    <?php if($patient->deleted_at == null): ?>
                                                        <div class="dropdown no-arrow ml-2" style="line-height :normal;">
                                                            <a class="dropdown-toggle px-1" href="#" role="button" id="dropdownMenuLink"
                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                                aria-labelledby="dropdownMenuLink" style="text-align:right">
                                                                <div class="dropdown-header text-gray-800 bg-gray-300"><h6><b>الإجراءات</b></h6></div>
                                                                <a href="<?php echo e(route('Clinic.printReview' ,$insideReview->id)); ?>" class="dropdown-item " type="button"><i class="fa-solid fa-lg fa-print"></i> طباعة ال<?php echo e($insideReview->review_type); ?> التابعة</a>
                                                                <a class="dropdown-item " type="button" data-toggle="modal" data-target="#EditInsideReview<?php echo e($insideReview->id); ?>">تعديل ال<?php echo e($insideReview->review_type); ?> التابعة</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item " type="button" data-toggle="modal" data-target="#DeleteInsideReview<?php echo e($insideReview->id); ?>">حذف ال<?php echo e($insideReview->review_type); ?> التابعة</a>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="ml-2">
                                                        <a class="card_dropdown" href="#collapse<?php echo e($insideReview->id); ?>" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapse<?php echo e($insideReview->id); ?>">
                                                        </a>
                                                    </div>
                                                    <div >
                                                        <a  class="mx-2" type="button" onclick="document.getElementById('specialWithStar<?php echo e($insideReview->id); ?>').submit();" >
                                                            <?php if($insideReview->special_with_star == 1): ?>
                                                                <i class="fa-solid fa-star" style="color: #f2df0d;"  data-toggle="tooltip" title="إلغاء التمييز"></i>
                                                            <?php elseif($insideReview->special_with_star == 0): ?>
                                                                <i class="fa-solid fa-star text-gray-400"  data-toggle="tooltip" title="تمييز بنجمة"></i>
                                                            <?php endif; ?>
                                                        </a>
                                                        <form id="specialWithStar<?php echo e($insideReview->id); ?>" action="<?php echo e(route('Clinic.specialWithStar_do',$insideReview->id)); ?>" method="post" class="d-none">
                                                            <?php echo csrf_field(); ?>
                                                            <input type="hidden" name="special_with_star" <?php if($insideReview->special_with_star == 1): ?>
                                                            value="0"
                                                            <?php else: ?>
                                                            value="1"
                                                            <?php endif; ?> >
                                                        </form>
                                                    </div>

                                                </div>
                                                <div class="text-center" style="width:100%;">
                                                    <h5 class="text-<?php echo e($type1); ?> p-0 m-0"><b><?php echo e($insideReview->review_type); ?></b>
                                                        <?php if($insideReview->done == 0): ?>
                                                            <span class="text-xs text-gray-900">لم يتم الفحص</span>
                                                            <div >
                                                                <form  action="<?php echo e(route('Clinic.tasksReview',$insideReview->id)); ?>" method="post">
                                                                    <?php echo csrf_field(); ?>
                                                                    <button type="submit" class="btn btn-white" style="width:20%" name="done" value="1" ><i class="fa-regular fa-circle-check text-gray-400"></i></button>
                                                                </form>
                                                            </div>
                                                        <?php elseif($insideReview->done == 1): ?>
                                                            <i class="fa-regular fa-circle-check text-primary"></i>
                                                        <?php endif; ?>
                                                    </h5>
                                                </div>
                                                <div style="text-align: left;width: 35%;">
                                                    <p class="text-xs text-gray-900 p-0 m-0">تاريخ الزيارة :</p>
                                                    <p class="text-xs text-gray-800  p-0 m-0"><?php echo e($insideReview->created_at->format('D d-m-Y')); ?></p>
                                                    <p class="text-xs text-gray-800  p-0 m-0" style="direction: ltr"><?php echo e($patient->created_at->format('h:i a')); ?></p>
                                                </div>
                                            </div>

                                            
                                            <div class="collapse" id="collapse<?php echo e($insideReview->id); ?>">
                                                <div class="card-body p-2
                                                <?php if($insideReview->done != 1): ?>
                                                bg-empty-image
                                                <?php endif; ?>
                                                ">
                                                    <div class="form-row">
                                                            <div class="col-lg-6 col-md-7 my-1 card p-2" style="direction:ltr;height:360px ;overflow-y:auto">
                                                            <ul style="direction:rtl;">
                                                                <li><div class=" text-<?php echo e($type1); ?> text-uppercase mx-1"><b>سبب الزيارة</b> :</div></li>
                                                                <div class="h6 mb-0 text-gray-800"><?php echo e($insideReview->main_complaint); ?></div>

                                                                <li><div class=" text-<?php echo e($type1); ?> text-uppercase mx-1"><b>الحالة الحديثة</b> :</div></li>
                                                                <div class="h6 mb-0 text-gray-800">
                                                                    <?php if($insideReview->pain_story): ?>
                                                                        <?php echo e($insideReview->pain_story); ?>

                                                                    <?php else: ?>
                                                                        ------------------------------
                                                                    <?php endif; ?>
                                                                </div>

                                                                <li><div class=" text-<?php echo e($type1); ?> text-uppercase mx-1"><b>التحليل مكتوب</b> :</div></li>
                                                                <div class="h6 mb-0 text-gray-800">
                                                                    <?php if($insideReview->med_analysis_T): ?>
                                                                        <?php echo e($insideReview->med_analysis_T); ?>

                                                                    <?php else: ?>
                                                                        ------------------------------
                                                                    <?php endif; ?>
                                                                </div>
                                                                <li><div class=" text-<?php echo e($type1); ?> text-uppercase mx-1"><b>محتوى الصورة</b> :</div></li>
                                                                <div class="h6 mb-0 text-gray-800">
                                                                    <?php if($insideReview->med_photo_T): ?>
                                                                        <?php echo e($insideReview->med_photo_T); ?>

                                                                    <?php else: ?>
                                                                        ------------------------------
                                                                    <?php endif; ?>
                                                                </div>
                                                                <li><div class=" text-<?php echo e($type1); ?> text-uppercase mx-1"><b>رأي الطبيب</b> :</div></li>
                                                                <div class="h6 mb-0 text-gray-800">
                                                                    <?php if($insideReview->medical_report): ?>
                                                                        <?php echo e($insideReview->medical_report); ?>

                                                                    <?php else: ?>
                                                                        ------------------------------
                                                                    <?php endif; ?>
                                                                </div>

                                                                <li><div class=" text-<?php echo e($type1); ?> text-uppercase mx-1"><b>خطة العلاج</b> :</div></li>
                                                                <div class="h6 mb-0 text-gray-800">
                                                                    <?php if($insideReview->treatment_plan): ?>
                                                                        <?php echo e($insideReview->treatment_plan); ?>

                                                                    <?php else: ?>
                                                                        ------------------------------
                                                                    <?php endif; ?>
                                                                </div>

                                                                <li><div class=" text-<?php echo e($type1); ?> text-uppercase mx-1"><b>
                                                                    <?php if($insideReview->main_complaint ==' - تحديد عملية - تحليل' || $insideReview->main_complaint =='تحديد عملية' || $insideReview->main_complaint ==' - تحديد عملية - صورة - تحليل' || $insideReview->main_complaint ==' - تحديد عملية - صورة'): ?>
                                                                        تاريخ موعد العملية المتوقع
                                                                    <?php else: ?>
                                                                        تاريخ الموعد القادم
                                                                    <?php endif; ?></b> :</div></li>
                                                                <div class="h6 mb-0 text-gray-800">
                                                                    <?php if($insideReview->date_expecting == null): ?>
                                                                        لا يوجد زيارة متوقعة
                                                                    <?php else: ?>
                                                                        <?php echo e(Carbon\Carbon::parse($insideReview->date_expecting)->format('D d-m-Y')); ?>

                                                                    <?php endif; ?>
                                                                </div>

                                                                <li><div class=" text-<?php echo e($type1); ?> text-uppercase mx-1"><b>ملاحظات الطبيب</b> :</div></li>
                                                                <div class="h6 mb-0 text-gray-800">
                                                                    <?php if($insideReview->doctor_notes): ?>
                                                                        <?php echo e($insideReview->doctor_notes); ?>

                                                                    <?php else: ?>
                                                                        ------------------------------
                                                                    <?php endif; ?>
                                                                </div>

                                                                <li><div class=" text-<?php echo e($type1); ?> text-uppercase mx-1"><b>تاريخ الزيارة</b> :</div></li>
                                                                <div class="h6 mb-0 text-gray-800"><?php echo e($insideReview->created_at->format('D d-m-Y')); ?></div>

                                                            </ul>
                                                        </div>
                                                        <?php if($insideReview->reviewMedias->count() > 0): ?>
                                                            <div class="col-lg-6 col-md-5 my-1 bg-gradient-dark" style="direction:rtl;height:360px;border-radius: 0.35rem;" >
                                                                <div id="carouselIndicatorsInsideReview<?php echo e($insideReview->id); ?>" class="carousel slide" data-ride="carousel">
                                                                    <ol class="carousel-indicators">
                                                                        <?php $__currentLoopData = $insideReview->reviewMedias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <li data-target="#carouselIndicatorsInsideReview<?php echo e($insideReview->id); ?>" data-slide-to="<?php echo e($loop->index); ?>" class="<?php echo e($loop->index == 0 ? 'active' : ''); ?>"></li>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </ol>
                                                                    <div class="carousel-inner">
                                                                        <?php $__currentLoopData = $insideReview->reviewMedias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <div class=" carousel-item <?php echo e($loop->index == 0 ? 'active' : ''); ?>">
                                                                                <img src="<?php echo e(asset('assets/Clinic/'.auth()->user()->doctor_id.'/'.$media->file_name)); ?>" style=" border-radius: 0.35rem;height:360px;object-fit:contain;width:100%;" class="d-block" alt="...">
                                                                                    <a class="position-absolute text-danger" style="right: 40px;bottom: 10px; border:1px solid;border-radius: 100% " href="<?php echo e(route('Clinic.destroyReviewMedia',$media->id)); ?>"><i class=" fas fa-fw  fa-2x fa-trash-alt"></i></a>
                                                                            </div>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </div>
                                                                    <?php if($insideReview->reviewMedias->count() > 1): ?>
                                                                    <button class="carousel-control-prev" type="button" data-target="#carouselIndicatorsInsideReview<?php echo e($insideReview->id); ?>" data-slide="prev">
                                                                    <span class="carousel-control-prev-icon text-primary" aria-hidden="true"></span>
                                                                    <span class="sr-only">Previous</span>
                                                                    </button>
                                                                    <button class="carousel-control-next" type="button" data-target="#carouselIndicatorsInsideReview<?php echo e($insideReview->id); ?>" data-slide="next">
                                                                    <span class="carousel-control-next-icon " aria-hidden="true"></span>
                                                                    <span class="sr-only text-primary">Next</span>
                                                                    </button>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php else: ?>
                                                            <div class="col-lg-6 col-md-5 my-1 bg-register-image"></div>
                                                        <?php endif; ?>
                                                    </div>

                                                </div>
                                            </div>

                                            <div style="direction:ltr">
                                                <!-- Modal Delete InsideReview-->
                                                <div class="modal fade" id="DeleteInsideReview<?php echo e($insideReview->id); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog  modal-dialog-centered ">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <h5 class="text-center text-danger">رسالة تأكيد</h5>
                                                                <div class="row p-3">
                                                                    <div class="col-lg-4 d-none d-lg-block bg-deleted-image"></div>
                                                                    <div class="col-lg-8" style="text-align:center">
                                                                        <h5 class="text-center">هل أنت متأكد من حذف ال<?php echo e($insideReview->review_type); ?> ؟</h5>
                                                                        <p> عند التأكيد سوف يتم إرسال ال<?php echo e($insideReview->review_type); ?> إلى سلة المحذوفات </p>
                                                                        <button type="button" class="btn btn-secondary btn-user" data-dismiss="modal">إلغاء</button>
                                                                        <a href="<?php echo e(route('Clinic.softDeleteReview',$insideReview->id)); ?>" class="btn btn-danger btn-user ">تأكيد</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- Modal Delete InsideReview-->


                                                <!-- Modal Edit InsideReview-->
                                                <div class="modal fade" id="EditInsideReview<?php echo e($insideReview->id); ?>" tabindex="-1" aria-labelledby="EditInsideReview<?php echo e($insideReview->id); ?>" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-body py-1">
                                                                <form action="<?php echo e(route('Clinic.updateReview_doctor',$insideReview->id)); ?>" method="post" enctype="multipart/form-data">
                                                                    <?php echo csrf_field(); ?>
                                                                    <div class="d-block py-2" style="width:100% ;direction: rtl">


                                                                        
                                                                        <p class="text-center text-gray-800 p-0 m-0"><span class="text-<?php echo e($type); ?> font-weight-bold"><?php echo e($insideReview->review_type); ?> للمريض :  </span><a class="text-center text-gray-800 p-0 m-0" href="<?php echo e(route('Clinic.patientProfile',$insideReview->patient->patient_slug)); ?>"><b><?php echo e($insideReview->patient->patient_name); ?></b></a></p>
                                                                        <p class="text-center text-xs text-gray-800 p-0 m-0"><a class="text-center text-gray-800 p-0 m-0" href="<?php echo e(route('Clinic.patientProfile',$insideReview->patient->patient_slug)); ?>"><b class="text-xs text-gray-900">وقت الزيارة : </b> <?php echo e($insideReview->created_at->format('D d/m - h:i a')); ?></a></p>
                                                                        <p class="text-center text-xs text-gray-800 p-0 m-0">سبب الزيارة : <b><?php echo e($insideReview->main_complaint); ?></b></p>
                                                                    </div>
                                                                <hr class="m-0">
                                                                    <div class="row">
                                                                        <div class="col-lg-4 bg-new-image"></div>
                                                                        <div class="col-lg-8">
                                                                            <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                                <label class="text-xs">رأي الطبيب : </label>
                                                                                <textarea id="editReview-medical_report<?php echo e($insideReview->id); ?>" class="VoiceToText form-control <?php $__errorArgs = ['medical_report'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="medical_report" rows="3" style="padding: 0.375rem 0.75rem;text-align:center" ><?php echo e($insideReview->medical_report); ?></textarea>
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
                                                                                <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="editReview-medical_report<?php echo e($insideReview->id); ?>">
                                                                                    <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                                </button>
                                                                            </div>

                                                                            <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                                <label class="text-xs">خطة العلاج : </label>
                                                                                <textarea id="editReview-treatment_plan<?php echo e($insideReview->id); ?>" class="VoiceToText form-control <?php $__errorArgs = ['treatment_plan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="treatment_plan" rows="3" style="padding: 0.375rem 0.75rem;text-align:center" ><?php echo e($insideReview->treatment_plan); ?></textarea>
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
                                                                                <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="editReview-treatment_plan<?php echo e($insideReview->id); ?>">
                                                                                    <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                                </button>
                                                                            </div>
                                                                            <!-- Collapse Modal InsideReviews InsideEmergency -->
                                                                            <div class="card mb-2">
                                                                                <!-- Card Header - Accordion -->
                                                                                <a href="#CollapseEditViewReviewEmergency<?php echo e($insideReview->id); ?>" class="d-block card-header py-3" data-toggle="collapse" style=""
                                                                                    role="button" aria-expanded="true" aria-controls="CollapseEditViewReviewEmergency">
                                                                                    <h6 class="m-0 text-xs font-weight-bold text-gray-600 text-center">المزيد  :
                                                                                        <span class=" <?php if($insideReview->main_complaint): ?>
                                                                                        text-primary
                                                                                        <?php endif; ?>">سبب الزيارة</span>
                                                                                        - <span class=" <?php if($insideReview->pain_story): ?>
                                                                                        text-primary
                                                                                        <?php endif; ?>">الحالة الحديثة</span>
                                                                                        - <span class=" <?php if($insideReview->med_analysis_T): ?>
                                                                                        text-primary
                                                                                        <?php endif; ?>">نص التحليل</span>
                                                                                        - <span class=" <?php if($insideReview->med_photo_T): ?>
                                                                                        text-primary
                                                                                        <?php endif; ?>">محتوى الصورة</span>
                                                                                        - <span class=" <?php if($insideReview->doctor_notes): ?>
                                                                                        text-primary
                                                                                        <?php endif; ?>">ملاحظات الزيارة</span>
                                                                                        <?php if(Carbon\Carbon::today() < Carbon\Carbon::parse($insideReview->date_expecting)): ?>
                                                                                            - <span class=" <?php if($insideReview->date_expecting): ?>
                                                                                                text-primary
                                                                                                <?php endif; ?>">
                                                                                            <?php if($insideReview->main_complaint ==' - تحديد عملية - تحليل' || $insideReview->main_complaint =='تحديد عملية' || $insideReview->main_complaint ==' - تحديد عملية - صورة - تحليل' || $insideReview->main_complaint ==' - تحديد عملية - صورة'): ?>
                                                                                                 موعد العملية
                                                                                            <?php else: ?>
                                                                                                 الموعد القادم
                                                                                            <?php endif; ?></span>
                                                                                        <?php endif; ?>

                                                                                    </h6>
                                                                                </a>
                                                                                <!-- Card Content - Collapse -->
                                                                                <div class="collapse" id="CollapseEditViewReviewEmergency<?php echo e($insideReview->id); ?>">
                                                                                    <div class="card-body px-1 py-1">
                                                                                        <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                                            <label class="text-xs">نص التحليل : </label>
                                                                                            <textarea id="editReview-med_analysis_T<?php echo e($insideReview->id); ?>" class="VoiceToText form-control <?php $__errorArgs = ['med_analysis_T'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="med_analysis_T" rows="1" style="padding: 0.375rem 0.75rem;text-align:center" ><?php echo e($insideReview->med_analysis_T); ?></textarea>
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
                                                                                            <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:39px;" for="editReview-med_analysis_T<?php echo e($insideReview->id); ?>">
                                                                                                <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                                            <label class="text-xs">محتوى الصورة : </label>
                                                                                            <textarea id="editReview-med_photo_T<?php echo e($insideReview->id); ?>" class="VoiceToText form-control <?php $__errorArgs = ['med_photo_T'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="med_photo_T" rows="1" style="padding: 0.375rem 0.75rem;text-align:center" ><?php echo e($insideReview->med_photo_T); ?></textarea>
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
                                                                                            <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:39px;" for="editReview-med_photo_T<?php echo e($insideReview->id); ?>">
                                                                                                <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="form-group mb-2" style="direction:rtl;text-align:right" >
                                                                                            <label class="text-xs">
                                                                                                <?php if($insideReview->main_complaint ==' - تحديد عملية - تحليل' || $insideReview->main_complaint =='تحديد عملية' || $insideReview->main_complaint ==' - تحديد عملية - صورة - تحليل' || $insideReview->main_complaint ==' - تحديد عملية - صورة'): ?>
                                                                                                    تاريخ موعد العملية المتوقع
                                                                                                <?php else: ?>
                                                                                                    تاريخ الموعد القادم
                                                                                                <?php endif; ?> : </label>
                                                                                            

                                                                                                
                                                                                            
                                                                                            <input type="date" min="<?php echo e(Carbon\Carbon::tomorrow()->format('Y-m-d')); ?>" <?php if($insideReview->date_expecting): ?>
                                                                                                value="<?php echo e(Carbon\Carbon::parse($insideReview->date_expecting)->format('Y-m-d')); ?>"
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
                                                                                            <textarea id="editReview-doctor_notes<?php echo e($insideReview->id); ?>" class=" VoiceToText form-control <?php $__errorArgs = ['doctor_notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="doctor_notes" rows="3" style="padding: 0.375rem 0.75rem;text-align:center"><?php echo e($insideReview->doctor_notes); ?></textarea>
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
                                                                                            <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="editReview-doctor_notes<?php echo e($insideReview->id); ?>">
                                                                                                <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                                            </button>
                                                                                        </div>

                                                                                        
                                                                                        <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                                            <label class="text-xs">الحالة الحديثة : </label>
                                                                                            <textarea id="editReview-pain_story<?php echo e($insideReview->id); ?>" class=" VoiceToText form-control <?php $__errorArgs = ['pain_story'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="pain_story" rows="3" style="padding: 0.375rem 0.75rem;text-align:center" ><?php echo e($insideReview->pain_story); ?></textarea>
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
                                                                                            <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="editReview-pain_story<?php echo e($insideReview->id); ?>">
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
                                                </div><!-- Modal Edit InsideReview-->

                                            </div>
                                        </div>
                                    </div>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                                    <div class="card mr-2 my-1 p-3 w-100 border-right-dark">
                                        <h5 class="">لا يوجد زيارات لاحقة</h5>
                                    </div>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>

                    <!-- Modals Review InsideReviews -->
                    <div  style="direction:ltr">
                        <!-- Modal Delete Review-->
                        <div class="modal fade" id="DeleteReview<?php echo e($review->id); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog  modal-dialog-centered ">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <h5 class="text-center text-danger">رسالة تأكيد</h5>
                                        <div class="row p-3">
                                            <div class="col-lg-4 d-none d-lg-block bg-deleted-image"></div>
                                            <div class="col-lg-8" style="text-align:center">
                                                <h5 class="text-center">هل أنت متأكد من حذف ال<?php echo e($review->review_type); ?> الرئيسية ؟</h5>
                                                <p> عند التأكيد سوف يتم إرسال ال<?php echo e($review->review_type); ?> مع جميع الزيارات الفرعية إلى سلة المحذوفات </p>
                                                <button type="button" class="btn btn-secondary btn-user" data-dismiss="modal">إلغاء</button>
                                                <a href="<?php echo e(route('Clinic.softDeleteReview',$review->id)); ?>" class="btn btn-danger btn-user ">تأكيد</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Delete Review-->

                        <!-- Modal Edit View Review Emergency-->
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
                                                        <textarea id="editReview-medical_report<?php echo e($review->id); ?>" class="VoiceToText form-control <?php $__errorArgs = ['medical_report'];
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
                                                        <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="editReview-medical_report<?php echo e($review->id); ?>">
                                                            <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                        </button>
                                                    </div>

                                                    <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                        <label class="text-xs">خطة العلاج : </label>
                                                        <textarea id="editReview-treatment_plan<?php echo e($review->id); ?>" class="VoiceToText form-control <?php $__errorArgs = ['treatment_plan'];
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
                                                        <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="editReview-treatment_plan<?php echo e($review->id); ?>">
                                                            <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                        </button>
                                                    </div>
                                                    <!-- Collapse Modal InsideReviews InsideEmergency -->
                                                    <div class="card mb-2">
                                                        <!-- Card Header - Accordion -->
                                                        <a href="#CollapseEditViewReviewEmergency<?php echo e($review->id); ?>" class="d-block card-header py-3" data-toggle="collapse" style=""
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
                                                        <div class="collapse" id="CollapseEditViewReviewEmergency<?php echo e($review->id); ?>">
                                                            <div class="card-body px-1 py-1">
                                                                <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                    <label class="text-xs">نص التحليل : </label>
                                                                    <textarea id="editReview-med_analysis_T<?php echo e($review->id); ?>" class="VoiceToText form-control <?php $__errorArgs = ['med_analysis_T'];
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
                                                                    <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:39px;" for="editReview-med_analysis_T<?php echo e($review->id); ?>">
                                                                        <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                    <label class="text-xs">محتوى الصورة : </label>
                                                                    <textarea id="editReview-med_photo_T<?php echo e($review->id); ?>" class="VoiceToText form-control <?php $__errorArgs = ['med_photo_T'];
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
                                                                    <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:39px;" for="editReview-med_photo_T<?php echo e($review->id); ?>">
                                                                        <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="form-group mb-2" style="direction:rtl;text-align:right" >
                                                                    <label class="text-xs">
                                                                        <?php if($review->main_complaint ==' - تحديد عملية - تحليل' || $review->main_complaint =='تحديد عملية' || $review->main_complaint ==' - تحديد عملية - صورة - تحليل' || $review->main_complaint ==' - تحديد عملية - صورة'): ?>
                                                                             موعد العملية
                                                                        <?php else: ?>
                                                                             الموعد القادم
                                                                        <?php endif; ?> : </label>
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
                                                                    <textarea id="editReview-doctor_notes<?php echo e($review->id); ?>" class=" VoiceToText form-control <?php $__errorArgs = ['doctor_notes'];
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
                                                                    <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="editReview-doctor_notes<?php echo e($review->id); ?>">
                                                                        <i class="fa-solid fa-microphone-lines fa-beat text-primary"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="form-group mb-2 position-relative" style="direction:rtl;text-align:right" >
                                                                    <label class="text-xs">القصة المرضية : </label>
                                                                    <textarea id="editReview-pain_story<?php echo e($review->id); ?>" class=" VoiceToText form-control <?php $__errorArgs = ['pain_story'];
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
                                                                    <button class="btn btn-white speake" type="button" style="position:absolute;right:0; bottom:0;height:50px;" for="editReview-pain_story<?php echo e($review->id); ?>">
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
                        </div><!-- Modal Edit View Review Emergency-->


                        

                    </div><!-- Modals Review InsideReviews -->

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="card my-4 shadow border-bottom-dark">
                    <div class="card-head py-3 px-5">
                            <h5 class="mr-2 text-dark"><b>عذراً!!</b>
                            </h5>
                        <hr>
                    </div>
                    <div class="card-body p-2 bg-deleted-image" style="height: 300px">
                        <b class="px-5">المريض لم يكمل الزيارة</b>
                    </div>
                </div>
            <?php endif; ?>
        

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
                maxFileCount : 5 , // عدد الاقصى للصور
                allowedFileTypes : ['image'], // نوع الملفات المرفوعة
                showCancel : true , // إظهار زر الإلغاء
                showRemove : true , // إخفاء زر الإزالة
                showUpload : false, // عدم الرفع من نفس البلاجن
                overwriteInitial : false ,// عدم الكتابة على البلاجن شيئ
            });

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.myClinic', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Projects\xampp\htdocs\MyClinicApp8\resources\views/myClinic/patients/patientProfile.blade.php ENDPATH**/ ?>