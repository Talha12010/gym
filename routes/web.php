<?php

use App\Http\Controllers\trainer\TrainerController as TrainerLoginController;
use App\Http\Controllers\trainer\DashboardController as TrainerDashboardController;
use App\Http\Controllers\admin\LoginController as AdminLoginController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/whyus', function () {
    return view('whyus');
});
Route::get('/contact', function () {
    return view('contact');
});Route::get('/services', function () {
    return view('services');
});
// Route::get('/admin/pending-users', function () {
//     return view('admin.pending-users');
// });

Route::group(['prefix' => 'account'], function() {

    // Middleware guest
    Route::group(['middleware' => 'guest'], function() {
        Route::get('login', [LoginController::class, 'index'])->name('account.login');
        Route::get('register', [LoginController::class, 'register'])->name('account.register');
        Route::post('processregister', [LoginController::class, 'processregister'])->name('account.processregister');
        Route::post('authenticate', [LoginController::class, 'authenticate'])->name('account.authenticate');
    });

    // Middleware authenticated
    Route::group(['middleware' => 'auth'], function() {
        Route::get('logout', [LoginController::class, 'logout'])->name('account.logout');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('account.dashboard');
    });
});

Route::group(['prefix' => 'admin'], function() {

    // Middleware guest for admin
    Route::group(['middleware' => 'admin.guest'], function() {
        Route::get('login', [AdminLoginController::class, 'index'])->name('admin.login');
        Route::post('authenticate', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');
    });

    // Middleware authenticated
    Route::group(['middleware' => 'admin.auth'], function() {
        Route::post('add-customer', [AdminDashboardController::class, 'addCustomer'])->name('admin.addCustomer');
        Route::post('view-customer', [App\Http\Controllers\admin\DashboardController::class, 'viewCustomer'])->name('admin.viewCustomer');
        Route::post('edit-customer', [App\Http\Controllers\admin\DashboardController::class, 'editCustomer'])->name('admin.editCustomer');
        Route::post('delete-customer', [App\Http\Controllers\admin\DashboardController::class, 'deleteCustomer'])->name('admin.deleteCustomer');
        Route::post('update-customer', [App\Http\Controllers\admin\DashboardController::class, 'updateCustomer'])->name('admin.updateCustomer');
        Route::get('view-all-customers', [App\Http\Controllers\admin\DashboardController::class, 'viewAllCustomers'])->name('admin.viewAllCustomers');

        // Equipment
        Route::post('add-equipment', [DashboardController::class, 'addEquipment'])->name('admin.addEquipment');
        Route::post('edit-equipment', [AdminDashboardController::class, 'editEquipment'])->name('admin.editEquipment');
        Route::post('delete-equipment', [AdminDashboardController::class, 'deleteEquipment'])->name('admin.deleteEquipment');
        Route::post('view-equipment', [AdminDashboardController::class, 'viewEquipment'])->name('admin.viewEquipment');
        Route::post('update-equipment', [AdminDashboardController::class, 'updateEquipment'])->name('admin.updateEquipment');
        Route::post('search-equipment', [AdminDashboardController::class, 'searchEquipment'])->name('admin.searchEquipment');

        // Trainer
        Route::post('add-trainer', [App\Http\Controllers\admin\DashboardController::class, 'addTrainer'])->name('admin.addTrainer');
        Route::post('edit-trainer', [App\Http\Controllers\admin\DashboardController::class, 'editTrainer'])->name('admin.editTrainer');
        Route::post('delete-trainer', [App\Http\Controllers\admin\DashboardController::class, 'deleteTrainer'])->name('admin.deleteTrainer');
        Route::post('view-trainer', [App\Http\Controllers\admin\DashboardController::class, 'viewTrainer'])->name('admin.viewTrainer');
        Route::post('update-trainer', [App\Http\Controllers\admin\DashboardController::class, 'updateTrainer'])->name('admin.updateTrainer');
        Route::post('search-trainer', [App\Http\Controllers\admin\DashboardController::class, 'searchTrainer'])->name('admin.searchTrainer');

        // Feedback
        Route::post('add-feedback', [App\Http\Controllers\admin\DashboardController::class, 'addFeedback'])->name('admin.addFeedback');
        Route::post('edit-feedback', [App\Http\Controllers\admin\DashboardController::class, 'editFeedback'])->name('admin.editFeedback');
        Route::post('delete-feedback', [App\Http\Controllers\admin\DashboardController::class, 'deleteFeedback'])->name('admin.deleteFeedback');
        Route::get('view-all-feedback', [App\Http\Controllers\admin\DashboardController::class, 'viewAllFeedback'])->name('admin.viewAllFeedback');
        Route::post('update-feedback', [App\Http\Controllers\admin\DashboardController::class, 'updateFeedback'])->name('admin.updateFeedback');
        Route::post('search-feedback', [App\Http\Controllers\admin\DashboardController::class, 'searchFeedback'])->name('admin.searchFeedback');

        // Class
        Route::post('store', [App\Http\Controllers\admin\DashboardController::class, 'storeClass'])->name('classes.store');
        Route::post('/classes/edit', [App\Http\Controllers\admin\DashboardController::class, 'editClass'])->name('classes.edit');
        Route::post('/classes/delete', [App\Http\Controllers\admin\DashboardController::class, 'deleteClass'])->name('classes.delete');
        Route::get('/classes/view', [App\Http\Controllers\admin\DashboardController::class, 'viewClasses'])->name('classes.view');
        Route::post('/classes/update', [App\Http\Controllers\admin\DashboardController::class, 'updateClass'])->name('classes.update');
        Route::post('/classes/search', [App\Http\Controllers\admin\DashboardController::class, 'searchClasses'])->name('classes.search');

        // Subscription Plan
        Route::post('/admin/add-subscription', [App\Http\Controllers\admin\DashboardController::class, 'addSubscription'])->name('admin.addSubscription');
        Route::post('/admin/edit-subscription', [App\Http\Controllers\admin\DashboardController::class, 'editSubscription'])->name('admin.editSubscription');
        Route::post('/admin/delete-subscription', [App\Http\Controllers\admin\DashboardController::class, 'deleteSubscription'])->name('admin.deleteSubscription');
        Route::get('/admin/view-all-subscriptions', [AdminDashboardController::class, 'viewAllSubscriptions'])->name('admin.viewAllSubscriptions');
        Route::post('/admin/update-subscription', [App\Http\Controllers\admin\DashboardController::class, 'updateSubscription'])->name('admin.updateSubscription');
        Route::post('/admin/search-subscription', [App\Http\Controllers\admin\DashboardController::class, 'searchSubscription'])->name('admin.searchSubscription');

        // Schedule
        Route::post('/admin/add-schedule', [App\Http\Controllers\admin\DashboardController::class, 'addSchedule'])->name('admin.addSchedule');
        Route::post('/admin/delete-schedule', [App\Http\Controllers\admin\DashboardController::class, 'deleteSchedule'])->name('admin.deleteSchedule');
        Route::get('/admin/view-all-schedules', [App\Http\Controllers\admin\DashboardController::class, 'viewAllSchedules'])->name('admin.viewAllSchedules');
         Route::post('/admin/search-schedule', [App\Http\Controllers\admin\DashboardController::class, 'searchSchedule'])->name('admin.searchSchedule');
        // payment
        Route::post('/admin/add-payment', [AdminDashboardController::class, 'addPayment'])->name('admin.addPayment');
        Route::post('/admin/edit-payment', [AdminDashboardController::class, 'editPayment'])->name('admin.editPayment');
        Route::post('/admin/delete-payment', [AdminDashboardController::class, 'deletePayment'])->name('admin.deletePayment');
        Route::post('/admin/view-payment', [AdminDashboardController::class, 'viewPayment'])->name('admin.viewPayment');











      Route::get('pending-users', [AdminDashboardController::class, 'showPendingUsers'])->name('admin.pendingUsers');
        Route::post('approve-user/{id}', [AdminDashboardController::class, 'approveUser'])->name('admin.approveUser');
         Route::get('records', [AdminDashboardController::class, 'showSubscriptions'])->name('admin.subscriptions');

Route::delete('delete-user/{id}', [AdminDashboardController::class, 'deleteUser'])->name('admin.deleteUser');

        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
    });
});

Route::group(['prefix' => 'trainer'], function() {
    Route::get('dashboard', [TrainerDashboardController::class, 'index'])->name('trainer.dashboard');
    Route::get('register', [TrainerLoginController::class, 'register'])->name('trainer.register');
    Route::post('processregister', [TrainerLoginController::class, 'processregister'])->name('trainer.processregister');
    Route::post('authenticate', [TrainerLoginController::class, 'authenticate'])->name('trainer.authenticate');
    Route::get('logout', [LoginController::class, 'logout'])->name('trainer.logout');
});

Route::group(['middleware' => 'guest'], function() {
    Route::post('/auth/forgot-password', [MailController::class, 'sendemail'])->name('auth.forgotPassword');
    Route::get('/auth/forgot-password', [MailController::class, 'showForgotPasswordForm'])->name('auth.showForgotPasswordForm');
    Route::get('/auth/reset-password', [MailController::class, 'Showresetpassword'])->name('auth.Showresetpassword');
    Route::post('/auth/reset-password', [MailController::class, 'resetPassword'])->name('auth.resetPassword');

});
Route::get('/subscription', function () {
    return view('subscription');
});

use App\Http\Controllers\SubscriptionController;

Route::post('/submit-subscription', [SubscriptionController::class, 'store'])->name('subscription.store');

use App\Http\Controllers\FeedbackController;

Route::post('/submit-feedback', [FeedbackController::class, 'store'])->name('feedbacknew.store');
Route::get('trainer/dashboard', [SubscriptionController::class, 'showMembers'])->name('trainer.dashboard');

use App\Http\Controllers\AttendanceController;

Route::post('/mark-attendance', [AttendanceController::class, 'store'])->name('attendance.mark');

Route::get('/auth/update/{token}', [MailController::class, 'updateshow'])->name('auth.updateform');
Route::post('/auth/update', [MailController::class, 'forgot'])->name('auth.updatepassword');


Route::get('/auth/update', [MailController::class, 'updateshow'])->name('auth.updatepasswordform');


