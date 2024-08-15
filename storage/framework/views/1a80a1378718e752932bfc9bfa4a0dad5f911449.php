<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="pb-5 mt-3 ">
    <ul class="nav nav-tabs pr-1">
        <li class="nav-item ">
            <a class="nav-link px-3" href="<?php echo e(route('Clinic.mangementPage')); ?>"><b>الإدارة</b></a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-2" href="<?php echo e(route('Clinic.tasksPage')); ?>"><b>المهام</b>
                <?php if($tasks >0): ?>
                    <span class="badge badge-warning badge-counter">
                        <?php if($tasks > 9): ?>
                        +9
                        <?php else: ?>
                        <?php echo e($tasks); ?>

                        <?php endif; ?>
                    </span>
                <?php endif; ?>
            </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link px-2 dropdown-toggle active" data-toggle="dropdown" role="button" aria-expanded="false"><b>الرسائل</b></a>
          <div class="dropdown-menu" style="direction:rtl;text-align:right;width: auto;">
            <?php if(count($messages)>0): ?>
                <a class="dropdown-item" href="<?php echo e(route('Clinic.readMessagesAll')); ?>" >تحديد الكل كمقروء</a>
                <?php if(auth()->user()->d_o_e == 1): ?>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo e(route('Clinic.destroyMessagesAll')); ?>" >حذف الجميع</a>
                <?php endif; ?>
            <?php else: ?>
                <a class="dropdown-item" >لا يوجد أي إجراء</a>
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
<div class="container-fluid  pb-5 mb-5">
    <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class=" card border-right-primary shadow h-100  <?php if($message->read_at == null): ?> bg-gray-300 <?php endif; ?> py-2 my-2 ">

            <div class="card-body" >
                <div class="row no-gutters align-items-center" style="direction:rtl;text-align:right" >
                    <div class="col-auto ">
                        <img class="rounded-circle ml-2" src="" style=" height: 40px;width: 40px;">
                    </div>
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?php echo e($message->name); ?></div>
                       <b> الموضوع : </b><p class="mr-3 mb-0 font-weight-bold text-gray-900" >  <?php echo e($message->title); ?></p>
                        <b>محتوى الرسالة : </b><div class="h6 mb-0 font-weight-bold text-gray-800"> <?php echo e($message->message); ?></div>
                        <div class="text-xs text-center text-primary text-uppercase my-1"> <?php if($message->mobile): ?> <b>رقم الهاتف :</b> <?php echo e($message->mobile); ?> - <?php endif; ?> <b>الإيميل :</b> <?php echo e($message->email); ?> - <b>تاريخ الإرسال :</b> <?php echo e($message->created_at->format('D m y h:i a')); ?></div>
                    </div>

                </div>
            </div>
            <div class="card-footer" >
                <div class="mx-4">
                    <small><b  style="text-align: right;direction: rtl;float:right"><a href="<?php echo e(route('Clinic.readMessage',$message->id)); ?>" class="text-primary">تحديد الرسالة كمقروءة</a></b></small>
                    <small><b  style="text-align: right;direction: rtl;float:right">&nbsp;-<a href="<?php echo e(route('Clinic.destroyMessage',$message->id)); ?>" class="text-danger"> حذف الرسالة</a></b></small>
                </div>
            </div>

        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="card border-right-primary shadow h-100 py-2 my-2">
            <div class="card-body" >
                <div class="row no-gutters align-items-center" style="direction:rtl;text-align:right" >
                    <div class="col mr-2">
                        <div class="font-weight-bold text-primary text-uppercase mb-1 mx-4">فارغ !!</div><hr>
                        <div class="h6 mb-0 font-weight-bold text-gray-800">لا يوجد لديك أي بريد على الموقع</div>
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

<?php echo $__env->make('layouts.myClinic', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Projects\xampp\htdocs\MyClinicApp8\resources\views/myClinic/mangement/messages.blade.php ENDPATH**/ ?>