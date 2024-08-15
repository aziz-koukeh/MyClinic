
<div style="position: fixed; bottom: 20px; left: 20px;direction:ltr;z-index: 2;text-align:right;width: 300px;">

    
    <?php if(session('ReviewMassage')): ?>
        <div class="toast border-bottom-<?php echo e(session('alert_type_R')); ?> shadow"  role="alert" id="ReviewMassage" aria-live="assertive" aria-atomic="true" data-animation="true">
            <div class="toast-header ">
                
                <i class="fa-regular fa-hospital" style="color: #4e73df;"></i>
                <strong class="mx-auto text-gray-900" style="direction:rtl"><?php echo e(session('MainReviewMassage')); ?></strong>
                <small class="text-muted">الآن</small>
                
            </div>
            <div class="toast-body text-gray-800" style="direction: rtl;text-align: right">
                <b><?php echo e(session('ReviewMassage')); ?></b>
            </div>
        </div>
    <?php endif; ?>
    

    
    <?php if(session('PatientMassage')): ?>
        <div class="toast border-bottom-<?php echo e(session('alert_type_P')); ?>" role="alert" id="PatientMassage" aria-live="assertive" aria-atomic="true" data-animation="true">
            <div class="toast-header">
                
                <i class="fa-regular fa-hospital" style="color: #4e73df;"></i>
                <strong class="mx-auto text-gray-900" style="direction:rtl"><?php echo e(session('MainPatientMassage')); ?></strong>
                <small class="text-muted">الآن</small>
                
            </div>
            <div class="toast-body text-gray-800" style="direction: rtl;text-align: right">
                <b><p><?php echo e(session('PatientMassage')); ?></p>
                <?php if(session('PatientSlug')): ?>
                    <a href="<?php echo e(route('Clinic.patientProfile',session('PatientSlug'))); ?>">إضغط هنا للذهاب إلى ملف المريض</a>
                <?php endif; ?></b>
            </div>
        </div>
    <?php endif; ?>
    

    
    <?php if(session('AlertMessage')): ?>
        <div class="toast border-bottom-<?php echo e(session('alert_type_A')); ?> border-top-<?php echo e(session('alert_type_A')); ?> shadow" role="alert" id="AlertMessage" aria-live="assertive" aria-atomic="true" data-animation="true">
            <div class="toast-header ">
                
                <i class="fa-regular fa-hospital" style="color: #4e73df;"></i>
                <strong class="mx-auto text-gray-900" style="direction:rtl"><?php echo e(session('MainAlertMessage')); ?></strong>
                <small class="text-muted">الآن</small>
                
            </div>
            <div class="toast-body text-gray-800" style="direction: rtl;text-align: right">
                <b><?php echo e(session('AlertMessage')); ?></b>
            </div>
        </div>
    <?php endif; ?>
    


</div>
<?php /**PATH E:\Projects\xampp\htdocs\MyClinicApp8\resources\views/partial/flash.blade.php ENDPATH**/ ?>