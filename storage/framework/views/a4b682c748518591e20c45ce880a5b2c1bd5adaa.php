<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="pb-5 mt-3">

    <ul class="nav nav-tabs pr-1">
        <li class="nav-item">
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
            <a class="nav-link px-2 dropdown-toggle active" data-toggle="dropdown" role="button" aria-expanded="false"><b>الإشعارات</b></a>
            <div class="dropdown-menu" style="direction:rtl;text-align:right;width: auto;">
                <?php if(count($notificates)>0): ?>
                    <a class="dropdown-item" href="<?php echo e(route('Clinic.readNotificateAll')); ?>" >تحديد الكل كمقروء</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo e(route('Clinic.destroyReadNotificateAll')); ?>" >حذف جميع إشعاراتي المقروءة</a>
                <?php else: ?>
                    <a class="dropdown-item" >لا يوجد أي إجراء</a>
                <?php endif; ?>
            </div>
        </li>
      </ul>

    <br>

    <div class="container-fluid pb-5 mb-5">
        <?php $__empty_1 = true; $__currentLoopData = $notificates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notificate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php if($notificate->forUser_id == null || $notificate->forUser_id == auth()->user()->id): ?>
                <div class=" card border-right-primary shadow h-100 py-1 mt-1 ">

                    <div class="card-body <?php if($notificate->read_at == null): ?> bg-gray-300 <?php endif; ?> p-2" >
                        <div class="row no-gutters align-items-center" style="direction:rtl;text-align:right" >
                            <div class="col-auto ml-2 icon-circle
                                <?php if( $notificate->notify_type == 'newReview'): ?>
                                bg-warning
                                <?php elseif($notificate->notify_type == 'newPatient' || $notificate->notify_type == 'newtask' || $notificate->notify_type == 'publictask' ): ?>
                                bg-info
                                <?php elseif($notificate->notify_type == 'delete' || $notificate->notify_type == 'sureryDate'): ?>
                                bg-danger
                                <?php elseif($notificate->notify_type == 'donetask' || $notificate->notify_type == 'reviewDate' ): ?>
                                bg-success
                                <?php elseif($notificate->notify_type == 'newDevice' ): ?>
                                bg-secondary
                                <?php endif; ?>
                                ">
                                <?php echo $notificate->icon; ?>

                            </div>
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    <?php if($notificate->notify_type == 'newPatient'): ?>
                                        مريض جديد
                                    <?php elseif($notificate->notify_type == 'newReview'): ?>
                                        زيارة جديدة
                                    <?php elseif($notificate->notify_type == 'delete'): ?>
                                        <span class="text-danger" >حذف</span>
                                    <?php endif; ?>
                                    - <?php echo e($notificate->created_at->locale('ar')->diffForHumans()); ?>- <?php echo e($notificate->created_at->format('D m y h:i a')); ?>

                                </div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800"> <?php echo e($notificate->mainMassage); ?></div>
                                
                            </div>

                        </div>
                    </div>
                    <div class="card-footer p-1" >
                        <div class="mx-4">
                            <small ><b style="text-align: right;direction: rtl;float:right"><a  type="button" class="text-primary" onclick="document.getElementById('notificate<?php echo e($notificate->id); ?>').submit();">تحديد الإشعار كمقروء &nbsp;</a></b></small>
                            <form id="notificate<?php echo e($notificate->id); ?>" action="<?php echo e(route('Clinic.readNotificate',$notificate->id)); ?>" method="post" class="d-none">
                                <?php echo csrf_field(); ?>
                            </form>
                            <small ><b style="text-align: right;direction: rtl;float:right"><a  type="button" class="text-dark" href="<?php echo e(route('Clinic.unReadNotificate',$notificate->id)); ?>">&nbsp;- تحديد الإشعار كغير مقروء</a></b></small>
                        </div>
                    </div>

                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="card border-right-primary shadow h-100 py-2 my-2">
                <div class="card-body" >
                    <div class="row no-gutters align-items-center" style="direction:rtl;text-align:right" >
                        <div class="col mr-2">
                            <div class="font-weight-bold text-primary text-uppercase mb-1 mx-4">فارغ !!</div><hr>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">لا يوجد لديك أي إشعار</div>
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

<?php echo $__env->make('layouts.myClinic', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Projects\xampp\htdocs\MyClinicApp8\resources\views/myClinic/mangement/notifications.blade.php ENDPATH**/ ?>