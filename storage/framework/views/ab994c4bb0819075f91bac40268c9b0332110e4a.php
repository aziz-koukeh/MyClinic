<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid mt-3 mb-5 pb-5">
        <?php if(count($errors)>0): ?>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="alert alert-secondary" role="alert">
                    <?php echo e($item); ?>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <!-- DataTales Example -->
        <div class="card shadow my-3">
            <div class="card-header p-3 " style="display:inline-flex;direction:rtl">
                <div class="d-sm-block d-md-inline-flex">
                    <div class="dropdown no-arrow ml-2" style="line-height :normal;">
                        <?php if($user->doctor_id == $user->id): ?>
                            <?php if(auth()->user()->doctor_id == auth()->user()->id): ?>
                                <a class="dropdown-toggle px-1" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink" style="text-align:right">
                                    <div class="dropdown-header text-gray-800 bg-gray-300"><h6><b>الإجراءات</b></h6></div>
                                    <a class="dropdown-item " type="button" data-toggle="modal" data-target="#EditUser">
                                        <i class="fas fa-cog fa-sm fa-fw ml-2 text-gray-400"></i>
                                        تعديل الحساب
                                    </a>
                                    
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item " type="button" data-toggle="modal" data-target="#DeleteUser">
                                        <i class="fas fa-trash fa-sm fa-fw ml-2 text-gray-400"></i>
                                        حذف الحساب
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php elseif($user->doctor_id != $user->id): ?>
                            <?php if(auth()->user()->d_o_e == 1): ?>
                                <a class="dropdown-toggle px-1" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink" style="text-align:right">
                                    <div class="dropdown-header text-gray-800 bg-gray-300"><h6><b>الإجراءات</b></h6></div>
                                    <a class="dropdown-item " type="button" data-toggle="modal" data-target="#EditUser">
                                        <i class="fas fa-cog fa-sm fa-fw ml-2 text-gray-400"></i>
                                        تعديل الحساب
                                    </a>
                                    
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item " type="button" data-toggle="modal" data-target="#DeleteUser">
                                        <i class="fas fa-trash fa-sm fa-fw ml-2 text-gray-400"></i>
                                        حذف الحساب
                                    </a>
                                </div>
                            <?php elseif($user->id == auth()->user()->id): ?>
                                <a class="dropdown-toggle px-1" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink" style="text-align:right">
                                    <div class="dropdown-header text-gray-800 bg-gray-300"><h6><b>الإجراءات</b></h6></div>
                                    <a class="dropdown-item " type="button" data-toggle="modal" data-target="#EditUser">
                                        <i class="fas fa-cog fa-sm fa-fw ml-2 text-gray-400"></i>
                                        تعديل الحساب
                                    </a>
                                    
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item " type="button" data-toggle="modal" data-target="#DeleteUser">
                                        <i class="fas fa-trash fa-sm fa-fw ml-2 text-gray-400"></i>
                                        حذف الحساب
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="text-center" style="width:100%;">
                    <h5 class="text-primary p-0 m-0"><b>الصفحة الشخصية</b></h5>
                </div>
            </div>
            <div class="card-body" style="text-align:right">
                <div class="form-row align-items-center justify-content-center">
                    <div class="col-sm-6">
                        <p  class="py-1 m-0"> الاسم  : <b><?php echo e($user->name); ?></b></p>
                        <ul>
                            <li>
                                <p class="py-1 m-0">  اسم الحساب :</p><b><?php echo e($user->username); ?></b>
                            </li>
                            <li>
                                <p class="py-1 m-0">  ايميل الحساب :</p><b><?php echo e($user->email); ?></b>
                            </li>
                            <li>
                                <p class="py-1 m-0"> رقم الهاتف :</p><b><?php echo e($user->mobile); ?></b>
                            </li>
                            <li>
                                <p class="py-1 m-0"> مستوى الحساب :</p>
                                <b>
                                    <?php if($user->d_o_e ): ?>
                                    مشرف
                                    <?php else: ?>
                                    موظف
                                    <?php endif; ?>
                                </b>
                            </li>
                            <li>
                                <p class="py-1 m-0"> حالة الحساب :</p>
                                <b>
                                    <?php if($user->status ): ?>
                                    نشط
                                    <?php else: ?>
                                    غير نشط
                                    <?php endif; ?>
                                </b>
                            </li>
                        </ul>
                    </div>
                    <?php if($user->user_image): ?>
                        <div class="col-sm-6">
                            <div class="card border-top-dark border-left-dark border-bottom-dark border-right-dark shadow m-3">
                                <img src="<?php echo e(asset('assets/users/'.$user->user_image)); ?>" alt="" style="max-height:300px;width:auto;object-fit:contain;background:rgb(197, 197, 197)">
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="col-sm-6">
                            <div class="card border-top-dark border-left-dark border-bottom-dark border-right-dark shadow m-3">
                                <img src="" alt="" style="max-height:300px;width:auto;object-fit:contain;background:rgb(197, 197, 197)">
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
            <!-- Modal Delete -->
            <div class="modal fade" id="DeleteUser" tabindex="-1" aria-labelledby="DeleteUser" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">

                                    <?php if($user->id == $user->doctor_id ): ?>
                                        <h5 class="text-center text-danger">رسالة تذكير</h5>
                                        <div class="row p-3">
                                            <div class="col-lg-4 d-none d-lg-block bg-protected-image"></div>
                                            <div class="col-lg-8" style="text-align:center">
                                                <h6 class="text-center font-weight-bold text-gray-800">هذا الحساب محمي <i class="fas fa-shield fa-2x text-warning"></i></h6>
                                                <h6 class="text-center">لا يمكنك حذف الحساب حتى عن طريق الخطأ </h6>
                                                <button type="button" class="btn btn-secondary btn-user" data-dismiss="modal">تراجع</button>

                                    <?php else: ?>
                                        <h5 class="text-center text-danger">رسالة تأكيد</h5>
                                        <div class="row p-3">
                                            <div class="col-lg-4 d-none d-lg-block bg-deleted-image"></div>
                                            <div class="col-lg-8" style="text-align:center">
                                            <h5 class="text-center">هل أنت متأكد من حذف الحساب ؟</h5>
                                            <p> عند التأكيد سوف يتم حذف الحساب بشكل نهائي </p>
                                            <a href="<?php echo e(route('mang.userDestroy',$user->username)); ?>" class="btn btn-danger btn-user ">تأكيد</a>
                                            <button type="button" class="btn btn-secondary btn-user" data-dismiss="modal">إلغاء</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Delete -->
            <!-- Modal EditUser -->
            <div class="modal fade" id="EditUser" tabindex="-1" aria-labelledby="EditUser" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-body" style="direction:ltr">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">تعديل الحساب</h1>
                            </div>
                            <hr>
                            <form class="user" method="post" action="<?php echo e(route('mang.userUpdate',$user->id)); ?>" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                            <div class="form-row" style="direction: rtl">
                                <div class="col-lg-7">
                                    <div class="p-2">
                                        <?php if(($user->id == $user->doctor_id && auth()->user()->id == $user->id) || ($user->id != $user->doctor_id && auth()->user()->d_o_e == 0)): ?>
                                            <div class="form-row">
                                                <div class="col-lg-12 mb-3">
                                                    <label class="text-xs mr-3" style="text-align:right;float: right;">كلمة المرور الحالية :</label>
                                                    <input type="password" class="form-control form-control-user <?php $__errorArgs = ['old_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="old_password" placeholder="لن يتم أي تعديل بدون كلمة المرور الحالية">
                                                    <?php $__errorArgs = ['old_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($message); ?></strong>
                                                        </span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="form-row">
                                            <div class="col-xl-6 col-lg-12 mb-3">
                                                <label class="text-xs mr-3" style="text-align:right;float: right;">الاسم :</label>
                                                <input type="text" class="form-control form-control-user <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name" value="<?php echo e($user->name); ?>"  autocomplete="name" autofocus placeholder="اسم مستخدم الحساب">
                                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($message); ?></strong>
                                                    </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="col-xl-6 col-lg-12 mb-3">
                                                <label class="text-xs mr-3" style="text-align:right;float: right;">اسم حسابك :</label>
                                                <input type="text" class="form-control form-control-user <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="username" value="<?php echo e($user->username); ?>"  autocomplete="username" required placeholder="الاسم المستخدم لتسجيل الدخول">
                                                <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($message); ?></strong>
                                                    </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-xl-6 col-lg-12 mb-3">
                                                <label class="text-xs mr-3" style="text-align:right;float: right;">كلمة المرور :</label>
                                                <input type="password" class="form-control form-control-user <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password"  autocomplete="new-password" placeholder="كلمة المرور">
                                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($message); ?></strong>
                                                    </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="col-xl-6 col-lg-12  mb-3">
                                                <label class="text-xs mr-3" style="text-align:right;float: right;">تأكيد كلمة المرور :</label>
                                                <input type="password" class="form-control form-control-user" name="password_confirmation"  autocomplete="new-password" placeholder="كرر كلمة المرور">
                                            </div>
                                        </div>
                                        <?php if($user->id != $user->doctor_id && auth()->user()->d_o_e == 1): ?>
                                            <div class="form-row">
                                                <div class="col-lg-12  mb-3" style="direction:ltr ">
                                                    <label class="text-xs" style="text-align:right;float: right;direction:rtl;margin-bottom: 0.25rem;margin-right: 1rem;">مستوى الحساب :</label>
                                                    <select class="form-control form-control-user" name="d_o_e" style="text-align:center;padding: 0.5rem 1rem;height:50px;">
                                                        <option value="1" <?php if($user->d_o_e == 1 ): ?> selected <?php endif; ?>>مشرف</option>
                                                        <option value="0" <?php if($user->d_o_e == 0 ): ?> selected <?php endif; ?>>موظف</option>
                                                    </select>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <input type="hidden" name="d_o_e" value="<?php echo e($user->d_o_e); ?>">

                                        <?php endif; ?>

                                        <label class="text-xs" style="text-align:right;float: right;margin-bottom: 0.25rem;margin-right: 1rem;">المزيد :</label>
                                        <br class="m-0 p-0">
                                        <div class="card mb-4 " style="border-radius: 35px 35px 35px 35px " >
                                            <!-- Card Header - Accordion -->
                                            <a href="#collapseEditMoreDetails" class="d-block py-3" data-toggle="collapse" style=""
                                                role="button" aria-expanded="true" aria-controls="collapseEditMoreDetails">
                                                <p class="text-xs font-weight-bold text-primary text-center mb-0">' الإيميل - الجوال - صورة الحساب - الجنس '</p>
                                            </a>
                                            <!-- Card Content - Collapse -->
                                            <div class="collapse" id="collapseEditMoreDetails">
                                                <div class="card-body px-1 py-3">
                                                    <div class="form-row" >
                                                        <div class="col-xl-6 col-lg-12 mb-3" style="direction:ltr">
                                                            <label class="text-xs" style="text-align:right;direction:rtl;float: right;margin-bottom: 0.25rem;margin-right: 1rem;">الإيميل :</label>
                                                            <input type="email" class="form-control form-control-user <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e($user->email); ?>"  autocomplete="email" placeholder="">
                                                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong><?php echo e($message); ?></strong>
                                                                </span>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                        <div class="col-xl-6 col-lg-12  mb-3">
                                                            <label class="text-xs" style="text-align:right;float: right;margin-bottom: 0.25rem;margin-right: 1rem;">الجوال :</label>
                                                            <input type="tel" class="form-control form-control-user <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="mobile" value="<?php echo e($user->mobile); ?>"  autocomplete="mobile" placeholder="">
                                                            <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong><?php echo e($message); ?></strong>
                                                                </span>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="col-xl-6 col-lg-12 mb-3">
                                                            <label class="text-xs" style="text-align:right;float: right;margin-bottom: 0.25rem;margin-right: 1rem;">صورة الحساب :</label>
                                                            <input type="file" class="form-control form-control-user" style="padding: 1rem; height: 50px;" name="user_image">
                                                        </div>
                                                        <div class="col-xl-6 col-lg-12  mb-3" style="direction:ltr ">
                                                            <label class="text-xs" style="text-align:right;float: right;direction:rtl;margin-bottom: 0.25rem;margin-right: 1rem;">الجنس :</label>
                                                            <select class="form-control form-control-user" name="gender" style="text-align:center;padding: 0.5rem 1rem;height:50px;">
                                                                <option value="male" <?php if($user->gender == 'male' ): ?> selected <?php endif; ?>>ذكر</option>
                                                                <option value="female" <?php if($user->gender == 'female' ): ?> selected <?php endif; ?>>أنثى</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- collapseCardMoreDetails -->

                                    </div>
                                </div>
                                <div class="col-lg-5 bg-profile-image">
                                    
                                </div>
                            </div>


                        </div>
                        <div class="modal-footer py-1" style="float: right;direction: ltr">
                            <button type="submit" style="float:right" class="btn btn-primary btn-user">تعديل</button>
                            <button type="button" style="float:right" class="btn btn-secondary btn-user" data-dismiss="modal">إلغاء</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal EditUser -->
            
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.myClinic', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Projects\xampp\htdocs\MyClinicApp8\resources\views/myClinic/mangement/usersProfile.blade.php ENDPATH**/ ?>