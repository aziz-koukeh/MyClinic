<?php

use Illuminate\Support\Facades\Route;


// Route::get('/', function () { return view('myClinic.welcome');  });
// Route::get('/home', 'HomeController@index')->name('home');

//-------------------------------





// Authentication Routes ------------------------------------------------------
    Route::get('/login',                             ['as' => 'Clinic.show_login_form',                'uses' => 'MyClinic\Auth\LoginController@showLoginForm']);
    Route::post('login',                             ['as' => 'Clinic.login',                          'uses' => 'MyClinic\Auth\LoginController@login']);
    Route::post('logout',                            ['as' => 'Clinic.logout',                         'uses' => 'MyClinic\Auth\LoginController@logout']);
    Route::get('register',                           ['as' => 'Clinic.show_register_form',             'uses' => 'MyClinic\Auth\RegisterController@showRegistrationForm']);
    Route::post('register',                          ['as' => 'Clinic.register',                       'uses' => 'MyClinic\Auth\RegisterController@register']);
    Route::get('password/reset',                     ['as' => 'Clinic.password.request',               'uses' => 'MyClinic\Auth\ForgotPasswordController@showLinkRequestForm']);
    Route::post('password/email',                    ['as' => 'password.email',                        'uses' => 'MyClinic\Auth\ForgotPasswordController@sendResetLinkEmail']);
    Route::get('password/reset/{token}',             ['as' => 'password.reset',                        'uses' => 'MyClinic\Auth\ResetPasswordController@showResetForm']);
    Route::post('password/reset',                    ['as' => 'password.update',                       'uses' => 'MyClinic\Auth\ResetPasswordController@reset']);
    Route::get('email/verify',                       ['as' => 'verification.notice',                   'uses' => 'MyClinic\Auth\VerificationController@show']);
    Route::get('/email/verify/{id}/{hash}',          ['as' => 'verification.verify',                   'uses' => 'MyClinic\Auth\VerificationController@verify']);
    Route::post('email/resend',                      ['as' => 'verification.resend',                   'uses' => 'MyClinic\Auth\VerificationController@resend']);
// Authentication Routes ------------------------------------------------------

// Users Routes ------------------------------------------------------
    Route::get('/MyProfile/{username}',              ['as' => 'mang.usersProfile',                     'uses' => 'MyClinic\UsersController@usersProfile']);
    Route::post('/StoreUser',                        ['as' => 'mang.userStore',                        'uses' => 'MyClinic\UsersController@userStore']);
    Route::post('/UpdateUser/{id}',                  ['as' => 'mang.userUpdate',                       'uses' => 'MyClinic\UsersController@userUpdate']);
    Route::get('/DeleteUser/{username}',             ['as' => 'mang.userDestroy',                      'uses' => 'MyClinic\UsersController@userDestroy']);
// Users Routes ------------------------------------------------------

// pages...........................................
    // Management Routes ------------------------------------------------------
        Route::get('/AddPatient',                    ['as' => 'Clinic.newPatient',                     'uses' => 'MyClinic\ManagementPagesController@newPatient']);
        Route::get('/AddPatientFully',               ['as' => 'Clinic.newPatientFully',                'uses' => 'MyClinic\ManagementPagesController@newPatientFully']);
        Route::get('/PatientProfile/{patient_slug}', ['as' => 'Clinic.patientProfile',                 'uses' => 'MyClinic\ManagementPagesController@patientProfile']);
        Route::get('/SelectReview/{patient_slug}',   ['as' => 'Clinic.selectReview',                   'uses' => 'MyClinic\ManagementPagesController@selectReview']);
        Route::get('/MyClinic',                      ['as' => 'Clinic.index',                          'uses' => 'MyClinic\ManagementPagesController@index']);
        Route::get('/Search',                        ['as' => 'Clinic.Search',                         'uses' => 'MyClinic\ManagementPagesController@Search']);
        Route::get('/PatientInClinic',               ['as' => 'Clinic.patientInClinic',                'uses' => 'MyClinic\ManagementPagesController@patientsInClinic']);
        Route::get('/SpecialWithStar',               ['as' => 'Clinic.specialWithStar',                'uses' => 'MyClinic\ManagementPagesController@specialWithStar']);
        Route::get('/PatientsArchive',               ['as' => 'Clinic.patientsArchive',                'uses' => 'MyClinic\ManagementPagesController@patientsArchive']);
        Route::get('/ReviewsArchive',                ['as' => 'Clinic.reviewsArchive',                 'uses' => 'MyClinic\ManagementPagesController@reviewsArchive']);
        Route::get('/PatientsArchiveLastet',         ['as' => 'Clinic.patientsArchivelatest',          'uses' => 'MyClinic\ManagementPagesController@patientsArchiveNewer']);
        Route::get('/ReviewsArchivelatest',          ['as' => 'Clinic.reviewsArchivelatest',           'uses' => 'MyClinic\ManagementPagesController@reviewsArchiveNewer']);
        Route::get('/D_borad',                       ['as' => 'Clinic.D_borad',                        'uses' => 'MyClinic\ManagementPagesController@D_borad']);
        Route::get('/NotificationsPage',             ['as' => 'Clinic.notificationsPage',              'uses' => 'MyClinic\ManagementPagesController@notificationsPage']);
        Route::get('/ManagementPage',                ['as' => 'Clinic.mangementPage',                  'uses' => 'MyClinic\ManagementPagesController@mangementPage']);
        Route::get('/MessagesPage',                  ['as' => 'Clinic.messagesPage',                   'uses' => 'MyClinic\ManagementPagesController@messagesPage']);
        Route::get('/TasksPage',                     ['as' => 'Clinic.tasksPage',                      'uses' => 'MyClinic\ManagementPagesController@tasksPage']);
        Route::get('/MyClinic/TrashedFiles',         ['as' => 'Clinic.trashed',                        'uses' => 'MyClinic\ManagementPagesController@trashedFiles']);
    // Management Routes ------------------------------------------------------
    // Public Routes ------------------------------------------------------
        Route::get('/ContantUs',                     ['as' => 'Clinic.ContantUs',                      'uses' => 'MyClinic\PublicPagesController@ContantUs']);
        Route::post('/ContantUs',                    ['as' => 'Clinic.do_ContantUs',                   'uses' => 'MyClinic\PublicPagesController@do_ContantUs']);
        Route::get('/AboutUs',                       ['as' => 'Clinic.AboutUs',                        'uses' => 'MyClinic\PublicPagesController@AboutUs']);
        Route::get('/',                              ['as' => 'Clinic.welcome',                        'uses' => 'MyClinic\PublicPagesController@welcome']);
    // Public Routes ------------------------------------------------------
// pages...........................................

// functions .....................................
    // Management Routes ------------------------------------------------------
        Route::post('/D_boradCheck',                 ['as' => 'Clinic.D_boradCheck',                   'uses' => 'MyClinic\ManagementFunctionsController@D_boradCheck']);
        Route::post('/EditDoctorInfo',               ['as' => 'Clinic.editDoctorInfo',                 'uses' => 'MyClinic\ManagementFunctionsController@editDoctorInfo']);
        Route::get('/PrintReview/{id}',              ['as' => 'Clinic.printReview',                    'uses' => 'MyClinic\ManagementFunctionsController@printReview']);
        Route::get('/PrintPatientProfile/{patient_slug}', ['as' => 'Clinic.printPatientProfile',       'uses' => 'MyClinic\ManagementFunctionsController@printPatientProfile']);
        Route::get('/Change-language/{locale}',      ['as' => 'Clinic.change_language',                'uses' => 'MyClinic\ManagementFunctionsController@changeLanguage']);

        Route::post('/ReadNotificate/{id}',          ['as' => 'Clinic.readNotificate',                 'uses' => 'MyClinic\ManagementFunctionsController@readNotificate']);
        Route::get('/UnReadNotificate/{id}',         ['as' => 'Clinic.unReadNotificate',               'uses' => 'MyClinic\ManagementFunctionsController@unReadNotificate']);
        Route::get('/ReadNotificateAll',             ['as' => 'Clinic.readNotificateAll',              'uses' => 'MyClinic\ManagementFunctionsController@readNotificateAll']);
        Route::get('/DestroyReadNotificationsAll',   ['as' => 'Clinic.destroyReadNotificateAll',       'uses' => 'MyClinic\ManagementFunctionsController@destroyReadNotificateAll']);

        Route::post('/storetask',                    ['as' => 'Clinic.storetask',                      'uses' => 'MyClinic\ManagementFunctionsController@storetask']);
        Route::post('/TaskDone/{slug}',              ['as' => 'Clinic.taskDone',                       'uses' => 'MyClinic\ManagementFunctionsController@taskDone']);
        Route::get('/UnDoneTask/{slug}',             ['as' => 'Clinic.unDoneTask',                     'uses' => 'MyClinic\ManagementFunctionsController@unDoneTask']);
        Route::get('/AllTasksDone',                  ['as' => 'Clinic.doneAllTasks',                   'uses' => 'MyClinic\ManagementFunctionsController@doneAllTasks']);
        Route::get('/DestroyAllDoneTasks',           ['as' => 'Clinic.destroyAllDoneTasks',            'uses' => 'MyClinic\ManagementFunctionsController@destroyAllDoneTasks']);
        Route::get('/DestroyAllTasks',               ['as' => 'Clinic.destroyAllTasks',                'uses' => 'MyClinic\ManagementFunctionsController@destroyAllTasks']);
        Route::get('/destroyDoctorNotes/{slug}',     ['as' => 'Clinic.destroyDoctorNotesTasks',        'uses' => 'MyClinic\ManagementFunctionsController@destroyDoctorNotesTasks']);

        Route::get('/ReadMessage/{id}',              ['as' => 'Clinic.readMessage',                    'uses' => 'MyClinic\ManagementFunctionsController@readMessage']);
        Route::get('/DestroyMessage/{id}',           ['as' => 'Clinic.destroyMessage',                 'uses' => 'MyClinic\ManagementFunctionsController@destroyMessage']);
        Route::get('/ReadMessagesAll',               ['as' => 'Clinic.readMessagesAll',                'uses' => 'MyClinic\ManagementFunctionsController@readMessagesAll']);
        Route::get('/DestroyAllMessages',            ['as' => 'Clinic.destroyMessagesAll',             'uses' => 'MyClinic\ManagementFunctionsController@destroyMessagesAll']);

        Route::get('/ExportAllPatients',             ['as' => 'Clinic.export_excel_patients',          'uses' => 'MyClinic\ManagementFunctionsController@export_excel_patients']);
        Route::post('/ExportPatientsMonthly',        ['as' => 'Clinic.export_excel_patients_monthly',  'uses' => 'MyClinic\ManagementFunctionsController@export_excel_patients_monthly']);
        Route::get('/ExportAllReviews',              ['as' => 'Clinic.export_excel_reviews',           'uses' => 'MyClinic\ManagementFunctionsController@export_excel_reviews']);
        Route::post('/ExportReviewsMonthly',         ['as' => 'Clinic.export_excel_reviews_monthly',   'uses' => 'MyClinic\ManagementFunctionsController@export_excel_reviews_monthly']);
    // Management Routes ------------------------------------------------------
    // Patient Routes ----------------------------------------------------------------
        Route::post('/StorePatient',                 ['as' => 'Clinic.storePatient',                   'uses' => 'MyClinic\PatientsFunctionsController@storePatient']);
        Route::post('/StorePatientfully',            ['as' => 'Clinic.storePatientfully',              'uses' => 'MyClinic\PatientsFunctionsController@storePatientfully']);
        Route::post('/UpdatePatient/{patient_slug}', ['as' => 'Clinic.updatePatient',                  'uses' => 'MyClinic\PatientsFunctionsController@updatePatient']);
        Route::get('/SoftDeletes/{patient_slug}',    ['as' => 'Clinic.softDeletesPatient',             'uses' => 'MyClinic\PatientsFunctionsController@softDeletes']);
        Route::get('/Restore/{patient_slug}',        ['as' => 'Clinic.restorePatient',                 'uses' => 'MyClinic\PatientsFunctionsController@restore']);
        Route::get('/Destroy/{patient_slug}',        ['as' => 'Clinic.destroyPatient',                 'uses' => 'MyClinic\PatientsFunctionsController@destroy']);

        Route::post('/SpecialWithStar/{id}',         ['as' => 'Clinic.specialWithStar_do',             'uses' => 'MyClinic\PatientsFunctionsController@SpecialWithStar_do']);
        Route::post('/StoreReview/{id}',             ['as' => 'Clinic.storeReview',                    'uses' => 'MyClinic\PatientsFunctionsController@StoreReview']);
        Route::post('/DoctorReport/{id}',            ['as' => 'Clinic.updateReview_doctor',            'uses' => 'MyClinic\PatientsFunctionsController@UpdateReview_doctor']);
        Route::post('/UpdateReview/{id}',            ['as' => 'Clinic.updateReview_insert',            'uses' => 'MyClinic\PatientsFunctionsController@UpdateReview_insert']);
        Route::post('/TasksReview/{id}',             ['as' => 'Clinic.tasksReview',                    'uses' => 'MyClinic\PatientsFunctionsController@TasksReview']);
        Route::get('/SoftDeleteReview/{id}',         ['as' => 'Clinic.softDeleteReview',               'uses' => 'MyClinic\PatientsFunctionsController@SoftDeleteReview']);
        Route::get('/RestoreReview/{id}',            ['as' => 'Clinic.restoreReview',                  'uses' => 'MyClinic\PatientsFunctionsController@RestoreReview']);
        Route::get('/DestroyReview/{id}',            ['as' => 'Clinic.destroyReview',                  'uses' => 'MyClinic\PatientsFunctionsController@DestroyReview']);
        Route::get('/DestroyReviewEmployee/{id}',            ['as' => 'Clinic.destroyReviewEmployee',                  'uses' => 'MyClinic\PatientsFunctionsController@DestroyReviewEmployee']);
        Route::get('/DestroyReviewPhoneTurns',       ['as' => 'Clinic.destroyReviewPhoneTurns',        'uses' => 'MyClinic\PatientsFunctionsController@destroyReviewPhoneTurns']);

        Route::get('/DestroyReviewMedia/{id}',       ['as' => 'Clinic.destroyReviewMedia',             'uses' => 'MyClinic\PatientsFunctionsController@DestroyReviewMedia']);
    // Patient Routes ----------------------------------------------------------------
// functions .....................................

// Device Routes ------------------------------------------------------
        Route::post('/Device/{id}',                   ['as' => 'mang.allowed_blocked_device',          'uses' => 'MyClinic\DeviceCheckController@allowed_blocked_device']);
        Route::post('/User/{user}',                   ['as' => 'mang.allowed_blocked_user',            'uses' => 'MyClinic\DeviceCheckController@allowed_blocked_user']);
        Route::post('/Browser/{browser}',             ['as' => 'mang.allowed_blocked_browser',         'uses' => 'MyClinic\DeviceCheckController@allowed_blocked_browser']);
        Route::post('/DeleteDevice/{id}',             ['as' => 'mang.deleteDevice',                    'uses' => 'MyClinic\DeviceCheckController@deleteDevice']);
        // Route::post('/LockDevice/{id}',                ['as' => 'mang.lockDevice',                      'uses' => 'MyClinic\DeviceCheckController@lock_device']);
        // Route::post('/UnlockDevice/{id}',              ['as' => 'mang.unlockDevice',                    'uses' => 'MyClinic\DeviceCheckController@un_Lock_device']);
// Device Routes ------------------------------------------------------
