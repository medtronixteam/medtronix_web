<?php
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeePerformanceController;
use App\Http\Controllers\IncrementController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SalarySlipController;
use App\Http\Controllers\SeoController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskManagerController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\WaitlistController;
use App\Http\Controllers\UpdateEmployeeController;
use App\Http\Controllers\UpdateRequestController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

// ================== MainController
Route::get('/', [MainController::class, 'home'])->name('home');
Route::get('/apply-now', [MainController::class, 'applyNow'])->name('applyNow');
Route::get('ui', [MainController::class, 'ui'])->name('ui');
Route::get('about-us', [MainController::class, 'about_us'])->name('about');
Route::get('courses', [MainController::class, 'courses'])->name('courses');
Route::get('portfolio', [MainController::class, 'portfolio'])->name('portfolio');
Route::get('contact-us', [MainController::class, 'contact_us'])->name('contactUs');
Route::post('contact-us', [MainController::class, 'message_save'])->name('message.save');
// ==================== Add services Pages
Route::get('web-development', [MainController::class, 'web_development'])->name('web.development');
Route::get('app-development', [MainController::class, 'app_development'])->name('app.development');
Route::get('ui-ux-design', [MainController::class, 'ui_ux_design'])->name('ui.ux');
Route::get('desktop-app', [MainController::class, 'desktop_app'])->name('desktop.app');
Route::get('artificial-intelligence', [MainController::class, 'artificial_intelligence'])->name('artificial.intelligence');
// ==================== Add Courses Pages
Route::get('courses-web-development', [MainController::class, 'courses_web_development'])->name('course.web.development');
Route::get('course-app-development', [MainController::class, 'course_app_development'])->name('course.app.development');
Route::get('wordpress', [MainController::class, 'wordpress'])->name('wordpress');
Route::get('seo', [MainController::class, 'seo'])->name('seo');
Route::get('course-ui-ux-design', [MainController::class, 'course_ui_ux_design'])->name('course.ui.ux');
Route::get('python', [MainController::class, 'python'])->name('python');
Route::get('graphics', [MainController::class, 'graphics'])->name('graphics');
Route::get('freelancing', [MainController::class, 'freelancing'])->name('freelancing');

// ==================== Add services Pages end
Route::get('message/view/{id}', [MainController::class, 'message_view'])->name('message.view');
Route::get('message/delete/{id}', [MainController::class, 'message_delete'])->name('message.delete');
Route::get('more-project', [MainController::class, 'more_project'])->name('more.project');
Route::get('project-detail/{id}', [MainController::class, 'project_detail'])->name('project.detail');
Route::get('attendence-page', [MainController::class, 'email_attendence'])->name('email.attendence');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('mobile/login', [LoginController::class, 'index'])->name('mobile.login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('loginPost');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('reset-password', [LoginController::class, 'resetPasswordCh'])->name('reset.password.post');

// Route::get('/home', [MainController::class, 'home'])->name('home');
// Route::get('/404', [MainController::class, 'not_show'])->name('404');
// company dropdown Routes
// Route::get('about-us', [MainController::class, 'about_us'])->name('about.as');
// Route::get('contact-us', [MainController::class, 'contact_us'])->name('contact.us');
// Route::get('leadership', [MainController::class, 'leadership'])->name('leadership');
// Route::get('why-choose-us', [MainController::class, 'why_choose_us'])->name('why.choose.us');
// portfolio dropdown route
// Route::get('/portfolio', [MainController::class, 'portfolio'])->name('portfolio');
// courses route
// Route::get('/courses', [MainController::class, 'courses'])->name('courses');
// Route::post('/apply-request', [MainController::class, 'storeApplyRequest'])->name('apply.request');

// client/message
Route::post('/client/Sendmessage', [MessageController::class, 'storeMessage'])->name('message');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
});


Route::get('/import-sql', function () {
    $path = public_path('medtyeyo_medtronix.sql'); // Path to your .sql file
    $sql = file_get_contents($path);

    try {
        DB::unprepared($sql); // Execute the SQL script
        return 'SQL file imported successfully!';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});
Route::middleware(['auth', 'admin'])->group(function () {

    Route::post('settings/qrCode', [SettingController::class, 'generate'])->name('settings.qrCode');
    Route::get('/generate-qrcode', [SettingController::class, 'generateQrCode'])->name('generate.qrCode');
    Route::get('admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/profile', [DashboardController::class, 'user'])->name('profile.index');

    Route::get('/employees', [DashboardController::class, 'index'])->name('employees.index');
    // show Employee in website
    Route::get('/show-in-website', [DashboardController::class, 'employee_website_list'])->name('employee.website.list');
    Route::get('/update/eployee/status', [DashboardController::class, 'update_employee_website'])->name('update.employee.website');

    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    Route::post('/settings/update-ip-range', [SettingController::class, 'updateIpRange'])->name('settings.updateIpRange');
    Route::post('/settings/update-location', [SettingController::class, 'loctionSettings'])->name('settings.updateLocation');
    Route::get('/settings/delete-ip-range/{id}', [SettingController::class, 'deleteIpRange'])->name('settings.deleteIpRange');
    Route::post('/settings/updateOfficeTime', [SettingController::class, 'updateOfficeTime'])->name('settings.updateOfficeTime');

    Route::post('/teams', [TeamController::class, 'store'])->name('team.store');
    Route::get('/teams/manage', [TeamController::class, 'create'])->name('team.manage');
    Route::get('/teams', [TeamController::class, 'list'])->name('team.list');
    Route::get('/teams/{team}/edit', [TeamController::class, 'edit'])->name('team.edit');
    Route::delete('/teams/{team}', [TeamController::class, 'destroy'])->name('team.destroy');
    Route::put('/teams/{team}', [TeamController::class, 'update'])->name('team.update');
    Route::post('/teams/set_lead', [TeamController::class, 'setlead'])->name('team.set_lead');
    Route::post('/teams/add_members', [TeamController::class, 'addMembers'])->name('team.add_members');

    Route::get('/request/list', [RequestController::class, 'adminlist'])->name('request.list');
    Route::get('/profile/request/list', [DashboardController::class, 'profilelist'])->name('profile.check');
    Route::get('/requests/{id}', [RequestController::class, 'show'])->name('requests.show');

    Route::post('/approve/{id}', [RequestController::class, 'approve'])->name('request.approve');
    Route::post('/reject/{id}', [RequestController::class, 'reject'])->name('request.reject');

    Route::post('/employees/reset-password', [DashboardController::class, 'emp_reset_password'])->name('employee.password.reset');
    Route::get('/profile-settings', [DashboardController::class, 'profile_settings'])->name('profile.settings');
    Route::get('/employees/create', [DashboardController::class, 'create'])->name('employees.create');
    Route::get('/employees/{employee}', [DashboardController::class, 'show'])->name('employees.show');
    Route::post('/employees', [DashboardController::class, 'store'])->name('employees.store');
    Route::get('/profile/{employee}/edit', [DashboardController::class, 'edit'])->name('employees.edit');
    Route::put('/employees/{employee}', [DashboardController::class, 'update'])->name('employees.update');
    Route::delete('/employees/{employee}', [DashboardController::class, 'destroy'])->name('employees.destroy');

    Route::patch('/employees/toggle/{id}', [DashboardController::class, 'toggleEmployee'])->name('employees.toggle');
    Route::get('/disable-user', [DashboardController::class, 'disableduser'])->name('employees.disable-user');

    Route::post('/employees/update-profile-picture/{employee}', [DashboardController::class, 'updateProfilePicture'])->name('updateProfilePicture');
    // increment
    Route::post('addIncrement', [IncrementController::class, 'AddIncrement'])->name('add.increment');
    Route::get('increment/list/{id}', [IncrementController::class, 'list'])->name('incrementList');
    Route::post('increment/delete/{id}', [IncrementController::class, 'delete'])->name('increment.delete');
    Route::get('increment/edit/{id}', [IncrementController::class, 'edit'])->name('edit.increment');
    Route::get('increment/update/{id}', [IncrementController::class, 'update'])->name('update.increment');

    // update profile
    Route::post('/profile-settings-picture', [DashboardController::class, 'profile_settings_picture'])->name('update.profile.picture');
    Route::post('/profile-settings-info', [DashboardController::class, 'profile_settings_info'])->name('update.profile.info');
    Route::post('/profile-settings-links', [DashboardController::class, 'profile_settings_links'])->name('update.profile.links');

    Route::get('/salary_slips', [SalarySlipController::class, 'index'])->name('salary_slips.index');
    Route::get('/salary_slips/create/{id}', [SalarySlipController::class, 'create'])->name('salary_slips.create');
    Route::get('/generate/salary_slips/{id}', [SalarySlipController::class, 'generatePdf'])->name('salary_slips.pdf');
    Route::post('/salary_slips', [SalarySlipController::class, 'store'])->name('salary_slips.store');
    // Route::get('/salary_slips/{id}', [SalarySlipController::class, 'show'])->name('salary_slips.show');
    Route::get('/salary_slip/{id}', [SalarySlipController::class, 'generate'])->name('salary_slips.generate');
    Route::get('/salary_slips/{id}/edit', [SalarySlipController::class, 'edit'])->name('salary_slips.edit');
    Route::put('/salary_slips/update', [SalarySlipController::class, 'update'])->name('salary_slips.update');
    Route::delete('/salary_slips', [SalarySlipController::class, 'destroy'])->name('salary_slips.destroy');

    Route::get('/admin/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/admin/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/admin/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/admin/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/admin/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::put('/admin/project-pictures/{project}', [ProjectController::class, 'updateProjectPictures'])->name('project_pictures.update');
    Route::delete('/admin/project-pictures/{projectPicture}', [ProjectController::class, 'destroyProjectPictures'])->name('project_pictures.destroy');
    Route::delete('/admin/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    Route::delete('/admin/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

    Route::get('/admin/attendances', [AttendanceController::class, 'index'])->name('attendances.index');
    Route::get('/admin/attendances/user/{id}', [AttendanceController::class, 'attendancesUser'])->name('attendances.user');
    Route::post('/admin/attendances/list', [AttendanceController::class, 'listAttendance'])->name('attendances.list');
    Route::get('/admin/attendances/list', [AttendanceController::class, 'list'])->name('attendances.create');
    Route::post('/admin/attendances', [AttendanceController::class, 'storeAttendance'])->name('attendances.store');
    // Waitlist route
    Route::get('/waitlist', [WaitlistController::class, 'webList'])->name('waitlist.list');

    Route::get('/admin/user/message', [MessageController::class, 'showMessage'])->name('client.showMessage');
    Route::get('/salary-slip/{id}', [MainController::class, 'salary'])->name('salary-slip');
    // Employee show in attendence
    Route::get('/show-in-attendence', [DashboardController::class, 'employee_attendence_list'])->name('employee.attendence.list');
    Route::get('/update/attendence/user', [DashboardController::class, 'update_employee_attendence'])->name('update.employee.attendence');

    // client review routes
    Route::get('/admin/review/create', [ReviewController::class, 'create'])->name('client.reviewCreate');
    Route::post('/admin/review/store', [ReviewController::class, 'store'])->name('client.reviewStore');
    Route::get('/admin/review/list', [ReviewController::class, 'list'])->name('client.reviewList');
    Route::delete('/admin/review/delete{id}', [ReviewController::class, 'delete'])->name('review.delete');
    Route::get('/admin/review/edit/{id}', [ReviewController::class, 'edit'])->name('review.edit');
    Route::put('/admin/review/update/{id}', [ReviewController::class, 'update'])->name('review.update');

    // notification route
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications', [NotificationController::class, 'store'])->name('notifications.store');
    Route::get('/notifications/manage', [NotificationController::class, 'manage'])->name('notifications.manage');
    Route::get('/notifications/list', [NotificationController::class, 'list'])->name('notifications.list');
    Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::get('notifications/{id}', [NotificationController::class, 'show'])->name('notifications.show');

    Route::put('/notifications/{notification}', [NotificationController::class, 'update'])->name('notifications.update');
    Route::get('/notifications/edit/{notification}', [NotificationController::class, 'edit'])->name('notifications.edit');
    Route::get('/work-history', [TaskController::class, 'work_history'])->name('work.history');
    Route::get('/work-detail/{id}', [TaskController::class, 'work_detail'])->name('work.detail');

    Route::patch('/tasks/approve/hr/{task}', [TaskController::class, 'approveHR'])->name('tasks.approve.hr');

    Route::patch('/tasks/approve/teamlead_remarks/{task}', [TaskController::class, 'approveTeamLeadRemarks'])->name('tasks.approve.teamlead_remarks');

    Route::patch('/tasks/approve/teamlead/{task}', [TaskController::class, 'approveTeamLead'])->name('tasks.approve.teamlead');
    Route::post('/tasks/add-remarks/{task}', [TaskController::class, 'addRemarks'])->name('tasks.add.remarks');

    Route::get('admin/requests', [RequestController::class, 'list'])->name('admin.requests');

    Route::get('/task/manager', [TaskManagerController::class, 'index'])->name('task.manager');
});

Route::group(
    ['as' => 'employee.', 'middleware' => ['auth', 'employee','screen.desktop'], 'prefix' => 'employee'],
    function () {
        Route::get('/work-detail/{id}', [TaskController::class, 'work_detail'])->name('work.detail');
        Route::patch('/tasks/approve/teamlead_remarks/{task}', [TaskController::class, 'approveTeamLeadRemarks'])->name('tasks.approve');

        Route::get('/dashboard', [EmployeeController::class, 'dashboard'])->name('dashboard');
        Route::get('/attendance', [AttendanceController::class, 'viewAttendance'])->name('attendance');
        Route::get('/dasboard/profile', [EmployeeController::class, 'employeeProfile'])->name('profile');
        Route::post('/profile/update', [EmployeeController::class, 'update'])->name('profile.update');
        Route::post('/profile/update/link', [EmployeeController::class, 'updateLink'])->name('profile.link');
        Route::post('/profile/update/password', [EmployeeController::class, 'updatePassword'])->name('reset.password');
        Route::post('update-profile-picture', [EmployeeController::class, 'updatePicture'])->name('updatePicture');
        Route::post('/attendance/mark', [AttendanceController::class, 'attendanceMarked'])->name('attendance.marked');
        // Route::post('/attendance/checkout', [AttendanceController::class, 'attendanceMarkedCheckout'])->name('attendance.markedCheckout');
        Route::post('/check-in', [AttendanceController::class, 'checkIn'])->name('check-in');
        Route::post('/check-out', [AttendanceController::class, 'checkOut'])->name('check-out');
        Route::get('/notifications', [NotificationController::class, 'index'])->name('notification');
        Route::get('/notification/{id}', [NotificationController::class, 'showDetails'])->name('notification.details');
        Route::get('/performance', [EmployeePerformanceController::class, 'viewPerformance'])->name('performance');
        Route::get('/todos', [TodoController::class, 'index'])->name('todos.index');
        Route::post('/todos/store', [TodoController::class, 'store'])->name('todos.store');
        Route::get('/todos/list', [TodoController::class, 'list'])->name('todos.list');
        Route::get('/requests', [RequestController::class, 'list'])->name('request');
        Route::post('/request/store', [RequestController::class, 'store'])->name('request.store');
        Route::get('/request/view/{id}', [RequestController::class, 'requestView'])->name('request.view');
        Route::post('/task', [TaskController::class, 'store'])->name('task.message');
        Route::get('/task/list', [TaskController::class, 'taskList'])->name('tasklist');
        Route::get('/team', [TeamController::class, 'myTeam'])->name('team');
        // routes/web.php
        Route::get('/fetch-task-data', [TaskController::class, 'fetch_task_data'])->name('fetch.taskData');
        Route::get('/tasks', [TaskController::class, 'taskList'])->name('task.filter');
    }
);
//  =================== Update Employee Controller
Route::group(
    ['as' => 'mobile.', 'middleware' => ['auth', 'employee','screen.mobile'], 'prefix' => 'mobile'],
    function () {
        Route::get('/work-detail/{id}', [UpdateEmployeeController::class, 'work_detail'])->name('work.detail');
        Route::patch('/tasks/approve/teamlead_remarks/{task}', [UpdateEmployeeController::class, 'approveTeamLeadRemarks'])->name('tasks.approve');

        Route::get('/dashboard', [UpdateEmployeeController::class, 'dashboard'])->name('dashboard');
        Route::get('/attendance', [UpdateEmployeeController::class, 'viewAttendance'])->name('attendance');
        Route::get('/dasboard/profile', [UpdateEmployeeController::class, 'employeeProfile'])->name('profile');
        // Route::post('/attendance/checkout', [AttendanceController::class, 'attendanceMarkedCheckout'])->name('attendance.markedCheckout');
        Route::get('employee/notifications', [UpdateEmployeeController::class, 'index'])->name('notification');
        Route::get('employee/notification/{id}', [UpdateEmployeeController::class, 'showDetails'])->name('notification.details');
        Route::get('employee/performance', [UpdateEmployeeController::class, 'viewPerformance'])->name('performance');
        Route::get('employee/requests', [UpdateEmployeeController::class, 'list'])->name('request');
        Route::get('employee/request/view/{id}', [UpdateRequestController::class, 'requestView'])->name('request.view');
        Route::post('employee/task', [UpdateEmployeeController::class, 'storetask'])->name('task.message');
        Route::get('employee/task/list', [UpdateEmployeeController::class, 'taskList'])->name('tasklist');
        Route::get('employee/team', [UpdateEmployeeController::class, 'myTeam'])->name('team');
        // routes/web.php
        Route::get('employee/tasks', [UpdateEmployeeController::class, 'taskList'])->name('task.filter');
        Route::post('/profile/update', [EmployeeController::class, 'update'])->name('profile.update');
        Route::post('/profile/update/link', [EmployeeController::class, 'updateLink'])->name('profile.link');
        Route::post('/profile/update/password', [EmployeeController::class, 'updatePassword'])->name('reset.password');
        Route::post('update-profile-picture', [EmployeeController::class, 'updatePicture'])->name('updatePicture');
        Route::post('/attendance/mark', [AttendanceController::class, 'attendanceMarked'])->name('attendance.marked');
        Route::post('/check-in', [AttendanceController::class, 'checkIn'])->name('check-in');
        Route::post('/check-out', [AttendanceController::class, 'checkOut'])->name('check-out');
        Route::post('/request/store', [UpdateEmployeeController::class, 'store'])->name('request.store');
        Route::post('/task', [TaskController::class, 'store'])->name('task.message');
        Route::get('/fetch-task-data', [TaskController::class, 'fetch_task_data'])->name('fetch.taskData');
        Route::get('/tasks', [UpdateEmployeeController::class, 'taskList'])->name('task.filter');
        // Route::get('/scan-qr', [UpdateEmployeeController::class, 'scan_qr'])->name('scanQr');
    }
);

//chect
use App\Http\Controllers\ChatController;

Route::post('/chat/messages', [ChatController::class, 'receive'])->name('box.messages');
Route::post('/chat/messages/list', [ChatController::class, 'messagesList'])->name('box.messages.list');
Route::post('/chat/messages/replay', [ChatController::class, 'messagesReplay'])->name('box.messages.replay');
// Route::get('/chat/history', [ChatController::class, 'index'])->name('box.history');
Route::get('/events', [ChatController::class, 'stream']);
// web.php

Route::get('/admin/chat/messages', [ChatController::class, 'fetchMessages']);

//seo routes
Route::get('/seo/manage', [SeoController::class, 'manage'])->name('seo.manage');
Route::post('/seo/store', [SeoController::class, 'store'])->name('seo.create');

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/dashboard');
})->middleware(['signed', 'auth'])->name('verification.verify');

use Illuminate\Support\Facades\Artisan;

Route::get('/run-db-wipe', function () {
    try {
        Artisan::call('db:wipe'); // Run the db:wipe command
        return 'Database wiped successfully!';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});
