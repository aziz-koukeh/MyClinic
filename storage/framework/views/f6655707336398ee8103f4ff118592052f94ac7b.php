<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="container-fluid pb-5" style="direction:ltr">

        <!-- Content Row -->
        <div class="pt-3 form-row" style="direction:rtl">

            
            <div class="col-xl-8 col-lg-7  mb-4" >
                <div class="card border-top-primary border-right-primary shadow mb-2"  style="height:300px">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col ml-2" style="text-align:right">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-3">إحصائية الزيارات
                                </div>
                                <div class="font-weight-bold text-gray-600 text-uppercase mb-4">العدد الإجمالي : /<?php echo e($allDonePatientReviews + $allNotDonePatientReviews); ?>/
                                </div>

                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th class="text-success" colspan="2">المعاينات</th>
                                            <th class="text-danger" colspan="2">الإسعافيات</th>
                                            <th class="text-warning" colspan="2">المراجعات</th>
                                            <th class="text-info" colspan="2">الزيارات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-gray-800 text-xs">تم الفحص</td>
                                            <td class="text-gray-800 text-xs">غير مفحوص</td>
                                            <td class="text-gray-800 text-xs">تم الفحص</td>
                                            <td class="text-gray-800 text-xs">غير مفحوص</td>
                                            <td class="text-gray-800 text-xs">تم الفحص</td>
                                            <td class="text-gray-800 text-xs">غير مفحوص</td>
                                            <td class="text-gray-800 text-xs">تم الفحص</td>
                                            <td class="text-gray-800 text-xs">غير مفحوص</td>
                                        </tr>
                                        <tr>

                                            <td class="text-gray-900"><?php echo e($doneViews); ?></td>
                                            <td class="text-gray-900"><?php echo e($notDoneViews); ?></td>
                                            <td class="text-gray-900"><?php echo e($doneEmengs); ?></td>
                                            <td class="text-gray-900"><?php echo e($notDoneEmengs); ?></td>
                                            <td class="text-gray-900"><?php echo e($doneReviews); ?></td>
                                            <td class="text-gray-900"><?php echo e($notDoneReviews); ?></td>
                                            <td class="text-gray-900"><?php echo e($doneVisits); ?></td>
                                            <td class="text-gray-900"><?php echo e($notDoneVisits); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row" >
                    <div class="col-md-6">
                        <div class="card border-bottom-primary border-right-primary shadow" >
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col ml-2" style="text-align:right">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">عدد الزوار
                                        </div>
                                        <div class="font-weight-bold text-gray-600 text-uppercase mb-1">العدد الإجمالي : /<?php echo e($allpatients); ?>/
                                        </div>

                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-bottom-primary shadow" >
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col ml-2" style="text-align:right">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">الزيارات المكتملة
                                        </div>
                                        <div class="font-weight-bold text-gray-600 text-uppercase mb-1">العدد الإجمالي : /<?php echo e($allDonePatientReviews); ?>/
                                        </div>

                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            

            <!-- Donut Chart -->
            <div class="col-xl-4 col-lg-5  mb-4">
                <div class="card border-top-primary border-bottom-primary  border-left-primary shadow "  style="height:100%">
                    <div class="card-body">
                        <div class="chart-pie pt-4">
                            <canvas id="myPieChart"></canvas>
                        </div>
                        <div class="mt-4 text-center small" id="names_js">
                        </div>
                        <hr class="text-center text-primary p-0 m-0">
                        <p class="text-center text-primary p-0 m-0">النسبة المئوية للزيارات</p>

                    </div>
                </div>
            </div><!-- Donut Chart -->
        </div>

        <div class="form-row">
            <div class="col-lg-6">
                <!-- Area Chart -->
                <div class="card border-top-primary border-left-primary border-bottom-primary shadow mb-4">
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="myAreaChart"></canvas>
                        </div>
                        <hr class="text-center text-primary p-0 m-0">
                        <p class="text-center text-primary p-0 m-0">الزيارت المفحوصة والزيارات الفائتة لعام ( <?php echo e(Carbon\Carbon::now()->format('Y')); ?> )</p>
                    </div>
                </div><!-- Area Chart -->
            </div>
            <div class="col-lg-6">
                <!-- Bar Chart -->
                <div class="card border-top-primary border-right-primary border-bottom-primary shadow mb-4">
                    <div class="card-body">
                        <div class="chart-bar">
                            <canvas id="myBarChart"></canvas>
                        </div>
                        <hr class="text-center text-primary p-0 m-0">
                        <p class="text-center text-primary p-0 m-0">معدل الزيارات الشهري لعام ( <?php echo e(Carbon\Carbon::now()->format('Y')); ?> )</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- DataTales Example -->

        <nav>
            <div class="nav nav-tabs font-weight-bold pr-3" id="nav-tab" role="tablist" style="direction: rtl">
                
                <button class="nav-link font-weight-bold active px-2" id="nav-employees-tab" data-toggle="tab" data-target="#nav-employees" type="button" role="tab" aria-controls="nav-employees" aria-selected="true"><i class="fa-solid fa-users"  data-toggle="tooltip" title="الموظفين"></i>
                    <?php if(count($employeeusers) >0): ?>
                        <span class="badge badge-primary badge-counter">
                            <?php if(count($employeeusers) > 9): ?>
                            +9
                            <?php else: ?>
                            <?php echo e(count($employeeusers)); ?>

                            <?php endif; ?>
                        </span>
                    <?php endif; ?>
                </button>
                <button class="nav-link font-weight-bold px-2" id="nav-Patient-tab" data-toggle="tab" data-target="#nav-Patient" type="button" role="tab" aria-controls="nav-Patient" aria-selected="false"><i class="fa-solid fa-user-clock" data-toggle="tooltip" title="آخر الزوار"></i></button>
                <button class="nav-link font-weight-bold px-2" id="nav-Review-tab" data-toggle="tab" data-target="#nav-Review" type="button" role="tab" aria-controls="nav-Review" aria-selected="false"><i class="fa-solid fa-elevator"  data-toggle="tooltip" title="آخر الزيارات"></i></button>
                
                <button class="nav-link font-weight-bold px-2" id="nav-tasks-tab" data-toggle="tab" data-target="#nav-tasks" type="button" role="tab" aria-controls="nav-tasks" aria-selected="false"><i class="fa-solid fa-list-check" data-toggle="tooltip" title="المهام"></i>
                    <?php if(count($tasks) >0): ?>
                        <span class="badge badge-info badge-counter">
                            <?php if(count($tasks) > 9): ?>
                            +9
                            <?php else: ?>
                            <?php echo e(count($tasks)); ?>

                            <?php endif; ?>
                        </span>
                    <?php endif; ?>
                </button>
                <button class="nav-link font-weight-bold px-2" id="nav-notify-tab" data-toggle="tab" data-target="#nav-notify" type="button" role="tab" aria-controls="nav-notify" aria-selected="false"><i class="fa-regular fa-bell" data-toggle="tooltip" title="الإشعارات"></i>
                    <?php if(count($notificates) >0): ?>
                        <span class="badge badge-warning badge-counter">
                            <?php if(count($notificates) > 9): ?>
                            +9
                            <?php else: ?>
                            <?php echo e(count($notificates)); ?>

                            <?php endif; ?>
                        </span>
                    <?php endif; ?>
                </button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            
            
            
            
            <div class="tab-pane fade  show active" id="nav-employees" role="tabpanel" aria-labelledby="nav-employees-tab">

                <div class="card border-top-primary border-left-primary border-bottom-primary border-right-primary shadow my-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary text-center">جدول الموظفين</h6>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-primary mx-2 mb-3" style="float: right" data-toggle="modal" data-target="#CreateUser" >إضافة موظف</button>

                        <!-- Modal CreateUser -->
                        <div class="modal fade" id="CreateUser" tabindex="-1" aria-labelledby="CreateUser" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-body" style="direction:ltr">
                                        <div class="row p-2">
                                            <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                                            <div class="col-lg-7">
                                                <div class="p-2">
                                                    <div class="text-center">
                                                        <h1 class="h4 text-gray-900 mb-4">إنشاء حساب</h1>
                                                    </div>
                                                    <form class="user" method="post" action="<?php echo e(route('mang.userStore')); ?>" style="direction:rtl" enctype="multipart/form-data">
                                                        <?php echo csrf_field(); ?>
                                                        <div class="form-row">
                                                            <div class="col-xl-6 col-lg-12 mb-3">
                                                                <label class="text-xs" style="text-align:right;float: right;margin-bottom: 0.25rem;margin-right: 1rem;">الاسم :</label>
                                                                <input type="text" class="form-control form-control-user <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name" autocomplete="name" autofocus placeholder="اسم مستخدم الحساب">
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
                                                            <div class="col-xl-6 col-lg-12">
                                                                <label class="text-xs" style="text-align:right;float: right;margin-bottom: 0.25rem;margin-right: 1rem;">اسم الحساب :</label>
                                                                <input type="text" class="form-control form-control-user <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="username" autocomplete="username"  placeholder="الاسم المستخدم لتسجيل الدخول">
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
                                                                <label class="text-xs" style="text-align:right;float: right;margin-bottom: 0.25rem;margin-right: 1rem;">كلمة المرور :</label>
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
                                                                <label class="text-xs" style="text-align:right;float: right;margin-bottom: 0.25rem;margin-right: 1rem;">تأكيد كلمة المرور :</label>
                                                                <input type="password" class="form-control form-control-user" name="password_confirmation"  autocomplete="new-password" placeholder="تأكيد كلمة المرور">
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="col-lg-12  mb-3" style="direction:ltr ">
                                                                <label class="text-xs" style="text-align:right;float: right;direction:rtl;margin-bottom: 0.25rem;margin-right: 1rem;">مستوى الحساب :</label>
                                                                <select class="form-control form-control-user" name="d_o_e" style="text-align:center;padding: 0.5rem 1rem;height:50px;">
                                                                    <option value="0"  selected >موظف</option>
                                                                    <option value="1">مشرف</option>
                                                                </select>
                                                            </div>
                                                        </div>
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
unset($__errorArgs, $__bag); ?>" name="email" autocomplete="email" placeholder="">
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
unset($__errorArgs, $__bag); ?>" name="mobile" autocomplete="mobile" placeholder="">
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
                                                                                <option value="female" selected>أنثى</option>
                                                                                <option value="male">ذكر</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><!-- collapseCardMoreDetails -->
                                                        <button type="submit" style="float:right"  class="btn btn-primary btn-user ">
                                                            إنشاء حساب جديد
                                                        </button>
                                                        <button type="button" style="float:right" class="btn btn-secondary btn-user">إلغاء</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal CreateUser -->

                        <div class="table-responsive text-center" style="direction:rtl">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم الموظف</th>
                                        <th>اسم الحساب</th>
                                        <th>الايميل</th>
                                        <th>رقم الجوال</th>
                                        <th>مستوى الحساب</th>
                                        <th>حالة الحساب</th>
                                        <th>الإجراء</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $i=0
                                    ?>
                                    <?php $__currentLoopData = $employeeusers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employeeuser): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(++$i); ?></td>
                                            <td><?php echo e($employeeuser->name); ?></td>
                                            <td><?php echo e($employeeuser->username); ?></td>
                                            <td><?php echo e($employeeuser->email); ?></td>
                                            <td><?php echo e($employeeuser->mobile); ?></td>
                                            <td>
                                                <?php if($employeeuser->d_o_e): ?>
                                                    <?php echo e('مشرف'); ?>

                                                <?php else: ?>
                                                    <?php echo e('موظف'); ?>

                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <span class="text-success font-weight-bold"><?php if($employeeuser->status): ?> <?php echo e('مفعل'); ?> <?php else: ?> <?php echo e('غير مفعل'); ?> <?php endif; ?></span>
                                            </td>
                                            <td>
                                                <div class="d-sm-block d-lg-inlineflex">
                                                    <a href="<?php echo e(route('mang.usersProfile',$employeeuser->username)); ?>" class="btn btn-primary btn-circle btn-sm mx-1"  data-toggle="tooltip" title="الملف الشخصي" >
                                                        <i class="fas fa-sign-in-alt text-light"></i>
                                                    </a>
                                                    <a class="btn btn-danger btn-circle btn-sm mx-1" data-toggle="modal" data-target="#DeleteUser<?php echo e($employeeuser->id); ?>">
                                                        <i class="fas fa-fw fa-trash text-light"  data-toggle="tooltip" title="حذف الحساب"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Modal Delete -->
                                        <div class="modal fade" id="DeleteUser<?php echo e($employeeuser->id); ?>" tabindex="-1" aria-labelledby="DeleteUser<?php echo e($employeeuser->id); ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content" >
                                                    <div class="modal-body" style="direction: ltr">
                                                        <h5 class="text-center text-danger">رسالة تأكيد</h5>
                                                        <div class="row p-3">
                                                            <div class="col-lg-4 d-none d-lg-block bg-deleted-image"></div>
                                                            <div class="col-lg-8" style="text-align:center">
                                                                <h5 class="text-center">هل أنت متأكد من حذف الحساب ؟</h5>
                                                                <p> عند التأكيد سوف يتم حذف الحساب بشكل نهائي </p>
                                                                <button type="button" class="btn btn-secondary btn-user" data-dismiss="modal">إلغاء</button>
                                                                <a href="<?php echo e(route('mang.userDestroy',$employeeuser->username)); ?>" class="btn btn-danger btn-user ">تأكيد</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Delete -->
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
            

            
            <div class="tab-pane fade" id="nav-Patient" role="tabpanel" aria-labelledby="nav-Patient-tab">

                <div class="card border-top-success border-left-success border-bottom-success border-right-success shadow my-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-success text-center">آخر 15 زائر</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive text-center" style="direction:rtl">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم المريض</th>
                                        <th>العمر</th>
                                        <th>الجنس</th>
                                        
                                        <th>هاتف</th>
                                        <th>تاريخ الزيارة</th>
                                        <th>الإجراء</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $i=count($patients);
                                    ?>
                                    <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($i--); ?></td>
                                            <td><?php echo e($patient->patient_name); ?></td>
                                            <?php if($patient->age && $patient->age != date('Y')): ?>
                                                <td style="direction:rtl"><?php echo e(date('Y') - $patient->age .' سنة'); ?></td>
                                            <?php else: ?>
                                                <td class="text-gray-800" style="direction:rtl">--------------</td>
                                            <?php endif; ?>
                                            <?php if($patient->gender): ?>
                                                <td class="text-gray-800"><?php if($patient->gender == 'male'): ?> <?php echo e('ذكر'); ?> <?php elseif($patient->gender == 'female'): ?> <?php echo e('أنثى'); ?> <?php endif; ?></td>
                                            <?php else: ?>
                                                <td class="text-gray-800" style="direction:rtl">--------------</td>
                                            <?php endif; ?>
                                            
                                            <?php if($patient->phone): ?>
                                                <td class="text-gray-800" style="direction:rtl"><?php echo e($patient->phone); ?></td>
                                            <?php else: ?>
                                                <td class="text-gray-800" style="direction:rtl">--------------</td>
                                            <?php endif; ?>

                                            <td><?php echo e($patient->created_at->format('D d-m-Y H:i a')); ?></td>

                                            <td>
                                                <div class="d-sm-block d-lg-inlineflex">
                                                    <a href="<?php echo e(route('Clinic.patientProfile',$patient->patient_slug)); ?>" class="btn btn-primary btn-circle btn-sm mx-1"  data-toggle="tooltip" title="الذهاب إلى ملف المريض" >
                                                        <i class="fas fa-sign-in-alt text-light"></i>
                                                    </a>
                                                    <a class="btn btn-danger btn-circle btn-sm mx-1" data-toggle="modal" data-target="#DeletePatient<?php echo e($patient->id); ?>">
                                                        <i class="fas fa-fw fa-trash text-light"  data-toggle="tooltip" title="حذف ملف المريض"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Modal Delete -->
                                        <div class="modal fade" id="DeletePatient<?php echo e($patient->id); ?>" tabindex="-1" aria-labelledby="DeletePatient<?php echo e($patient->id); ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content" >
                                                    <div class="modal-body" style="direction: ltr">
                                                        <h5 class="text-center text-danger">رسالة تأكيد</h5>
                                                        <div class="row p-3">
                                                            <div class="col-lg-4 d-none d-lg-block bg-deleted-image"></div>
                                                            <div class="col-lg-8" style="text-align:center">
                                                                <p> عند التأكيد سوف يتم نقل ملف المريض مع جميع زياراته إلى سلة المحذوفات </p>
                                                                <button type="button" class="btn btn-secondary btn-user" data-dismiss="modal">إلغاء</button>
                                                                <a href="<?php echo e(route('Clinic.softDeletesPatient',$patient->patient_slug)); ?>" class="btn btn-danger btn-user ">تأكيد</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Delete -->
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
            

            
            <div class="tab-pane fade" id="nav-Review" role="tabpanel" aria-labelledby="nav-Review-tab">

                <div class="card border-top-warning border-left-warning border-bottom-warning border-right-warning shadow my-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-warning text-center">آخر 15 زيارة</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive text-center" style="direction:rtl">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم المريض</th>
                                        <th>نوع الزيارة</th>
                                        <th>الشكاية</th>
                                        <th>القصة المرضية</th>
                                        <th>رأي الطبيب</th>
                                        <th>خطة العلاج</th>
                                        <th>تاريخ الزيارة</th>
                                        <th>الإجراء</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $i=count($patientReviews)
                                    ?>
                                    <?php $__currentLoopData = $patientReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patientReview): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($i--); ?></td>
                                            <td><?php echo e($patientReview->patient->patient_name); ?></td>
                                            <td><?php echo e($patientReview->review_type); ?></td>
                                            <?php if($patientReview->main_complaint): ?>
                                                <td data-toggle="tooltip" title="<?php echo e($patientReview->main_complaint); ?>" style="direction:rtl"><?php echo e(\Illuminate\Support\Str::limit($patientReview->main_complaint, 40 , '...')); ?></td>
                                            <?php else: ?>
                                                <td class="text-gray-800" style="direction:rtl">--------------</td>
                                            <?php endif; ?>
                                            <?php if($patientReview->pain_story): ?>
                                                <td data-toggle="tooltip" title="<?php echo e($patientReview->pain_story); ?>" style="direction:rtl"><?php echo e(\Illuminate\Support\Str::limit($patientReview->pain_story, 40 , '...')); ?></td>
                                            <?php else: ?>
                                                <td class="text-gray-800" style="direction:rtl">--------------</td>
                                            <?php endif; ?>
                                            <?php if($patientReview->medical_report): ?>
                                                <td data-toggle="tooltip" title="<?php echo e($patientReview->medical_report); ?>" style="direction:rtl"><?php echo e(\Illuminate\Support\Str::limit($patientReview->medical_report, 40 , '...')); ?></td>
                                            <?php else: ?>
                                                <td class="text-gray-800" style="direction:rtl">--------------</td>
                                            <?php endif; ?>
                                            <?php if($patientReview->treatment_plan): ?>
                                                <td data-toggle="tooltip" title="<?php echo e($patientReview->treatment_plan); ?>" style="direction:rtl"><?php echo e(\Illuminate\Support\Str::limit($patientReview->treatment_plan, 40 , '...')); ?></td>
                                            <?php else: ?>
                                                <td class="text-gray-800" style="direction:rtl">--------------</td>
                                            <?php endif; ?>
                                            <td><?php echo e($patientReview->created_at->format('D d-m-Y H:i a')); ?></td>
                                            <td>
                                                <div class="d-sm-block d-lg-inlineflex">
                                                    <a href="<?php echo e(route('Clinic.patientProfile',$patientReview->patient->patient_slug)); ?>" class="btn btn-primary btn-circle btn-sm mx-1"  data-toggle="tooltip" title="الذهاب إلى ملف المريض" >
                                                        <i class="fas fa-sign-in-alt text-light"></i>
                                                    </a>
                                                    <a class="btn btn-danger btn-circle btn-sm mx-1" data-toggle="modal" data-target="#DeleteReview<?php echo e($patientReview->id); ?>">
                                                        <i class="fas fa-fw fa-trash text-light" data-toggle="tooltip" title="حذف الزيارة"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Modal Delete -->
                                        <div class="modal fade" id="DeleteReview<?php echo e($patientReview->id); ?>" tabindex="-1" aria-labelledby="DeleteReview<?php echo e($patientReview->id); ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content" >
                                                    <div class="modal-body" style="direction: ltr">
                                                        <h5 class="text-center text-danger">رسالة تأكيد</h5>
                                                        <div class="row p-3">
                                                            <div class="col-lg-4 d-none d-lg-block bg-deleted-image"></div>
                                                            <div class="col-lg-8" style="text-align:center">
                                                                <p> عند التأكيد سوف يتم نقل الزيارة إلى سلة المحذوفات </p>
                                                                <button type="button" class="btn btn-secondary btn-user" data-dismiss="modal">إلغاء</button>
                                                                <a href="<?php echo e(route('Clinic.softDeleteReview',$patientReview->id)); ?>" class="btn btn-danger btn-user ">تأكيد</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Delete -->
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
            

            
            
            


            
            <div class="tab-pane fade" id="nav-tasks" role="tabpanel" aria-labelledby="nav-tasks-tab">

                <div class="card border-top-info border-left-info border-bottom-info border-right-info shadow my-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-info text-center">جميع المهام في الموقع </h6>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-primary mx-2 mb-3" style="float: right" data-toggle="modal" data-target="#newTask" >إنشاء مهمة جديدة</button>
                        <a href="<?php echo e(route('Clinic.doneAllTasks')); ?>" class="btn btn-warning mx-2 mb-3" style="float: right" >تحديد الجميع كمنفذ</a>
                        <a href="<?php echo e(route('Clinic.destroyAllDoneTasks')); ?>" class="btn btn-success mx-2 mb-3" style="float: left" >حذف جميع المهام المنفذة</a>
                        <a href="<?php echo e(route('Clinic.destroyAllTasks')); ?>" class="btn btn-danger mx-2 mb-3" style="float: left" >حذف جميع المهام</a>

                        <div class="table-responsive text-center" style="direction:rtl">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>موجه إلى</th>
                                        <th>المهمة</th>
                                        <th>إنجزت بواسطة</th>
                                        <th>الإجراء</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $i=count($tasks);
                                    ?>
                                    <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="<?php if($task->read_at === null): ?> bg-gray-200 <?php endif; ?>">
                                            <td><?php echo e($i--); ?></td>
                                            <td>
                                                <?php if($task->forUser_id === null): ?>
                                                    الجميع
                                                <?php else: ?>
                                                    <?php if($task->foruser): ?>
                                                        <?php echo e($task->foruser->name); ?>

                                                    <?php else: ?>
                                                        لموظف سابق
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </td>
                                            <td data-toggle="tooltip" title="<?php echo e($task->contant); ?>" style="direction:rtl"><?php echo \Illuminate\Support\Str::limit($task->contant, 50 , '...'); ?></td>
                                            <td>
                                                <?php if($task->doneByUser_id === null): ?>
                                                    -
                                                <?php else: ?>
                                                    <?php if($task->donebyuser): ?>
                                                        <?php echo e($task->donebyuser->name); ?>

                                                    <?php else: ?>
                                                        لموظف سابق
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="d-sm-block d-lg-inlineflex">
                                                    <?php if($task->read_at === null): ?>
                                                        <a  type="button"class="btn btn-success btn-circle btn-sm mx-1"  onclick="document.getElementById('task<?php echo e($task->slug); ?>').submit();" data-toggle="tooltip" title="تحديد كمنفذ">
                                                            <i class="fa-solid fa-check text-light"></i>
                                                        </a>
                                                        <form id="task<?php echo e($task->slug); ?>" action="<?php echo e(route('Clinic.taskDone',$task->slug)); ?>" method="post" class="d-none">
                                                            <?php echo csrf_field(); ?>
                                                        </form>
                                                    <?php else: ?>
                                                        <a href="<?php echo e(route('Clinic.unDoneTask',$task->slug)); ?>" class="btn btn-info btn-circle btn-sm mx-1" data-toggle="tooltip" title="تحديد كغير منفذ">
                                                            <i class="fa-solid fa-xmark text-light"></i>
                                                        </a>
                                                    <?php endif; ?>
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
            

            
            <div class="tab-pane fade" id="nav-notify" role="tabpanel" aria-labelledby="nav-notify-tab">

                <div class="card border-top-warning border-left-warning border-bottom-warning border-right-warning shadow my-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-warning text-center">جدول إشعارات الموقع</h6>
                    </div>
                    <div class="card-body">
                        <a href="<?php echo e(route('Clinic.readNotificateAll')); ?>" class="btn btn-info mx-2 mb-3" style="float: right">تحديد جميع الإشعارات كمقروء</a>
                        <a href="<?php echo e(route('Clinic.destroyReadNotificateAll')); ?>" class="btn btn-warning mx-2 mb-3" style="float: left">حذف جميع الإشعارات المقروءة</a>


                        <div class="table-responsive text-center" style="direction:rtl">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>نوع الإشعار</th>
                                        <th>المصدر</th>
                                        <th>نص الإشعار</th>
                                        <th>خاص بـ</th>
                                        <th>الإجراء</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $i=count($notificates);
                                    ?>
                                    <?php $__currentLoopData = $notificates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notificate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr  class="<?php if($notificate->read_at === null): ?> bg-gray-200 <?php endif; ?>" >
                                            <td><?php echo e($i--); ?></td>

                                                
                                            <?php if( $notificate->notify_type == 'newReview'): ?>
                                                <td>زيارة جديدة</td>
                                            <?php elseif($notificate->notify_type == 'publictask' ): ?>
                                                <td>مهمة عامة</td>
                                            <?php elseif($notificate->notify_type == 'newDevice' ): ?>
                                                <td>تصريح جديد</td>
                                            <?php elseif($notificate->notify_type == 'reviewDate' ): ?>
                                                <td>حجز موعد</td>
                                            <?php elseif($notificate->notify_type == 'sureryDate' ): ?>
                                                <td>حجز عملية</td>
                                            <?php elseif($notificate->notify_type == 'newtask'): ?>
                                                <td>مهمة جديدة</td>
                                            <?php elseif($notificate->notify_type == 'newPatient' ): ?>
                                                <td>زائر جديد</td>
                                            <?php elseif($notificate->notify_type == 'delete'): ?>
                                                <td>عملية حذف</td>
                                            <?php elseif($notificate->notify_type == 'donetask' ): ?>
                                                <td>إنجاز مهمة</td>
                                            <?php endif; ?>

                                            <?php if($notificate->user->doctor_id == $notificate->user->id && $notificate->notify_type != 'newDevice' ): ?>
                                                <td><?php echo e($notificate->user->name); ?></td>
                                            <?php else: ?>
                                                <td>مركز الإشعارات</td>
                                            <?php endif; ?>

                                            <td><?php echo e($notificate->mainMassage); ?></td>
                                            <?php if($notificate->nforuser != null): ?>
                                                <td><?php echo e($notificate->nforuser->name); ?></td>
                                            <?php else: ?>
                                                <td>الجميع</td>
                                            <?php endif; ?>
                                            <td>
                                                <div class="d-sm-block d-lg-inlineflex">
                                                    <?php if($notificate->read_at === null): ?>
                                                        <a  type="button"class="btn btn-success btn-circle btn-sm mx-1"  onclick="document.getElementById('notificate<?php echo e($notificate->id); ?>').submit();"  data-toggle="tooltip" title="تحديد كمقروء">
                                                            <i class="fa-solid fa-check text-light"></i>
                                                        </a>
                                                        <form id="notificate<?php echo e($notificate->id); ?>" action="<?php echo e(route('Clinic.readNotificate',$notificate->id)); ?>" method="post" class="d-none">
                                                            <?php echo csrf_field(); ?>
                                                        </form>
                                                    <?php else: ?>
                                                        <a href="<?php echo e(route('Clinic.unReadNotificate',$notificate->id)); ?>" class="btn btn-info btn-circle btn-sm mx-1"  data-toggle="tooltip" title="تحديد كغير مقروء">
                                                            <i class="fa-solid fa-eye-slash text-light"></i>

                                                        </a>
                                                    <?php endif; ?>

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
            

        </div>




    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

    <!-- Page level plugins -->
    <script src="<?php echo e(asset('assets/MyClinicApp/vendor/chart.js/Chart.min.js')); ?>"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo e(asset('assets/MyClinicApp/js/demo/chart-area-demo.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/MyClinicApp/js/demo/chart-pie-demo.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/MyClinicApp/js/demo/chart-bar-demo.js')); ?>"></script>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.myClinic', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Projects\xampp\htdocs\MyClinicApp8\resources\views/myClinic/mangement/D_borad.blade.php ENDPATH**/ ?>