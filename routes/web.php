<?php

use App\Http\Controllers\CarRequestController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\CarApprovalController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarUsageController;
use App\Http\Controllers\ChiefDashboardController;
use App\Http\Controllers\FuelUsageController;
use App\Http\Controllers\FuelController;
use Illuminate\Http\Request;
use App\Http\Controllers\DriverDashboardController;
use App\Http\Controllers\AdminDashboardController;

Route::post('/car-requests/set-date', function (Request $request) {
    $request->validate(['date' => 'required|date']);
    session(['car_request_date' => $request->date]);
    return response()->json(['status' => 'success']);
})->middleware('auth');



Route::resource('fuel', FuelUsageController::class);
Route::get('/fuel', [FuelController::class, 'index'])->name('fuel.index');


Route::resource('fuel', FuelController::class);


//use App\Livewire\UserForm;

//Route::get('/dashboard', function () {
//    return view('dashboard');
//});
//Route::get('/user', function () {
//   return view('user');
//});
//Route::resource('users', UserController::class);
//Route::resource('user-profiles', UserProfileController::class)->only([
//   'index', 'create', 'store' , 
//]);
//Route::get('/users', UserForm::class)->name('users.create');

Route::get('/', function () {
    return view('auth.login');
});

//Route Admin เฉพาระหน้า admin
//Route::middleware(['auth', 'role.admin'])->prefix('admin')->group(function () {
 //   Route::get('/', [AdminDashboardController::class, 'adminDashboard'])->name('admin.dashboard');
//});


//Route Chief เฉพราะหน้า Chief
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); //ให้chiefไปหน้าdashboardก่อน
Route::middleware(['auth', 'role.chief'])->prefix('chief')->group(function () {
    Route::get('/dashboard', [ChiefDashboardController::class, 'chiefDashboard'])->name('chief.dashboard');

    // หน้ารายการคำขอรถ (รออนุมัติ)
    Route::get('/car-requests/pending', [CarApprovalController::class, 'pending'])->name('chief.car-requests.pending');
    //ดูรายการอนุมัติ
    Route::get('/car-requests/approved', [CarApprovalController::class, 'approved'])->name('chief.car-requests.approved');
    //ดูรายการไม่อนุมัติ
    Route::get('/car-requests/rejected', [CarApprovalController::class, 'rejected'])->name('chief.car-requests.rejected');

    // การอนุมัติ / ไม่อนุมัติ
    Route::post('/car-requests/{id}/approve', [CarApprovalController::class, 'Chiefapprove'])->name('chief.car-requests.approve');
    Route::post('/car-requests/{id}/reject', [CarApprovalController::class, 'Chiefreject'])->name('chief.car-requests.reject');
});

//Route User admin chief หน้าฟอร์มปกติ
Route::middleware(['auth'])->group(function () {
    Route::get('/car-requests/create', [CarRequestController::class, 'create'])->name('car-requests.create');
    Route::post('/car-requests', [CarRequestController::class, 'store'])->name('car-requests.store');
    Route::get('/car-requests/list', [CarRequestController::class, 'index'])->name('car-requests.list');
    Route::get('/user-dashboard', [DashboardController::class, 'userDashboard'])->name('user.dashboard');
});

//Route::middleware(['auth', 'role.chief'])->group(function () {
//    Route::post('/requests/{id}/approve', [VehicleRequestApprovalController::class, 'approve'])->name('requests.approve');
//});
Route::middleware(['auth', \App\Http\Middleware\RoleDriverMiddleware::class])->prefix('driver')->group(function () {
    Route::get('/dashboard', [DriverDashboardController::class, 'driverDashboard'])->name('driver.dashboard');

    Route::get('/assigned-jobs', [DriverDashboardController::class, 'assignedJobs'])->name('driver.assigned_jobs');
});


Route::get('/notifications/read/{id}', function ($id) {
    $notification = Auth::user()->notifications()->findOrFail($id);
    $notification->markAsRead();
    return redirect($notification->data['url'] ?? '/');
})->name('notifications.read');

Route::post('/car-requests/set-date', function (Request $request) {
    $request->validate(['date' => 'required|date']);
    session(['car_request_date' => $request->date]);
    return response()->json(['status' => 'success']);
})->middleware('auth');

// web.php  //สำหรับ print pdf
Route::get('/car-request/{id}/print', [CarRequestController::class, 'printForm'])->name('car_request.print');
Route::get('/font-test', function () {
    return view('car_requests.print', ['request' => \App\Models\CarRequest::first()]);
});  

//Route::get('/admin-dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
Route::get('/calendar', [CarRequestController::class, 'calendar'])->middleware('auth')->name('car-requests.calendar');
Route::get('/car-requests/calendar-events', [CarRequestController::class, 'calendarEvents'])->middleware('auth');
Route::resource('car-requests', CarRequestController::class);
Route::resource('user-profiles', UserProfileController::class);

Route::get('/dashboard', function () {
    return view('car_requests.calendar');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/car-usage/create', [CarUsageController::class, 'create'])->name('car-usage.create');
Route::post('/car-usage', [CarUsageController::class, 'store'])->name('car-usage.store');


Route::resource('car-usage', CarUsageController::class);

require __DIR__ . '/auth.php';
