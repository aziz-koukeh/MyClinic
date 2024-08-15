<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="pb-5 mt-3">

    <ul class="nav nav-tabs pr-1">
        <li class="nav-item">
            <a class="nav-link px-3" href="<?php echo e(route('Clinic.mangementPage')); ?>"><b>الإدارة</b></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" data-toggle="dropdown" role="button" aria-expanded="false"><b>المهام</b></a>
            <div class="dropdown-menu" style="direction:rtl;text-align:right;width: auto;">
            <?php if(auth()->user()->id == auth()->user()->doctor_id): ?>
                <a class="dropdown-item" type="button" data-toggle="modal" data-target="#newTask">إنشاء مهمة</a>
            <?php endif; ?>
            <a class="dropdown-item" href="<?php echo e(route('Clinic.doneAllTasks')); ?>">تحديد جميع المهام كمنفذ</a>
            <div class="dropdown-divider"></div>
            <?php if(auth()->user()->d_o_e == 1): ?>
                <a class="dropdown-item" href="<?php echo e(route('Clinic.destroyAllDoneTasks')); ?>">حذف المهام المنجزة</a>
                <a class="dropdown-item" href="<?php echo e(route('Clinic.destroyAllTasks')); ?>">حذف جميع المهام</a>
            <?php endif; ?>
          </div>
        </li>
        
        <li class="nav-item">
        <a class="nav-link px-2" href="<?php echo e(route('Clinic.notificationsPage')); ?>"><b>الإشعارات</b>
            <?php if($notificates >0): ?>
                <span class="badge badge-warning badge-counter">
                    <?php if($notificates > 9): ?>
                    +9
                    <?php else: ?>
                    <?php echo e($notificates); ?>

                    <?php endif; ?>
                </span>
            <?php endif; ?>
        </a>
        </li>
    </ul>

    <br>

    <div class="container-fluid pb-5 mb-5">
        <?php $__empty_1 = true; $__currentLoopData = $tasks->where('forUser_id','<>',auth()->user()->doctor_id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class=" card border-right-primary shadow h-100 py-1 mt-1 ">

                <div class="card-body <?php if($task->read_at == null): ?> bg-gray-300 <?php endif; ?> p-2" >
                    <div class="row no-gutters align-items-center" style="direction:rtl;text-align:right" >
                        <div class="col-auto ml-2">
                            
                                <?php if($task->forUser_id == null ): ?>
                                    <img class="rounded-circle ml-2" src="<?php echo e(asset('assets/MyClinicApp/image/1.gif')); ?>"  style=" height: 40px;width: 40px;">
                                <?php else: ?>
                                    <i class="rounded-circle ml-2 fa-solid fa-user-slash fa-xl fa-bounce"></i>
                                    
                                <?php endif; ?>
                     
                        </div>
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <?php if($task->forUser_id == null): ?>
                                    مهمة عامة
                                <?php else: ?>
                                    <?php if($task->foruser && $task->foruser->doctor_id == $task->forGroup_id): ?>
                                        مهمة لـ <?php echo e($task->foruser->name); ?>

                                    <?php else: ?>
                                        مهمة لموظف سابق
                                    <?php endif; ?>

                                <?php endif; ?>

                                <?php if($task->read_at != null): ?>
                                    <span class="text-success">- تم الإنجاز

                                <?php else: ?>
                                    <span class="text-danger">- لم يتم الإنجاز بعد</span>
                                    <?php if($task->forDay): ?>
                                        <span class="text-gray-900" style="text-decoration:underline">- لتاريخ : <?php echo e(\Carbon\Carbon::parse($task->forDay)->diffForHumans()); ?> - <?php echo e(\Carbon\Carbon::parse($task->forDay)->format('D d/m/Y - h:i a')); ?></span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        <div class="h6 my-2 font-weight-bold text-gray-800"> <?php echo e($task->contant); ?></div>
                        </div>

                    </div>
                </div>
                <div class="card-footer p-1" >
                    <div class="mx-4">
                        <small ><b style="text-align: right;direction: rtl;float:right"><a  type="button" class="text-primary" onclick="document.getElementById('task<?php echo e($task->slug); ?>').submit();"> تم إنجاز المهمة <i class="fa-regular fa-circle-check text-primary"></i></a></b></small>
                        <form id="task<?php echo e($task->slug); ?>" action="<?php echo e(route('Clinic.taskDone',$task->slug)); ?>" method="post" class="d-none">
                            <?php echo csrf_field(); ?>
                        </form>
                        <small ><b style="text-align: right;direction: rtl;float:right"><a  type="button" class="text-dark" href="<?php echo e(route('Clinic.unDoneTask',$task->slug)); ?>">&nbsp;- تراجع <i class="fa-regular fa-circle-xmark"></i></a></b></small>
                        <div style="float: left;display: grid">
                            <small class="text-xs" ><b> -وقت الإنشاء : <?php echo e($task->created_at->format('D d/m/Y - h:i a')); ?></b></small>
                            <?php if($task->read_at !=null): ?>
                                <small class="text-xs text-success"><b>- تم الإنجاز : <?php echo e(\Carbon\Carbon::parse($task->read_at)->format('D d/m/Y - h:i a')); ?></b></small>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="card border-right-primary shadow h-100 py-2 my-2">
                <div class="card-body" >
                    <div class="row no-gutters align-items-center" style="direction:rtl;text-align:right" >
                        <div class="col mr-2">
                            <div class="h6 mb-0 font-weight-bold text-gray-800">لا يوجد أي مهمة</div>
                        </div>

                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>


</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.myClinic', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Projects\xampp\htdocs\MyClinicApp8\resources\views/myClinic/mangement/tasks.blade.php ENDPATH**/ ?>