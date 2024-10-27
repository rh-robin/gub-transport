<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/* admin */
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\RouteController;
use App\Http\Controllers\Admin\PreSelectionController;


/* driver  */
use App\Http\Controllers\Driver\DriverProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/route/{id}', [ProfileController::class, 'routeView'])->name('user.route.view');
    Route::get('/find-vehicle', [ProfileController::class, 'findVehicle'])->name('user.findVehicle');
    Route::post('/find-vehicle', [ProfileController::class, 'findVehicleSubmit'])->name('user.findVehicle.submit');
    Route::get('/preselection', [ProfileController::class, 'preSelection'])->name('user.preselection');
    Route::post('/preselection-submit', [ProfileController::class, 'preSelectionSubmit'])->name('user.preselection.submit');
    Route::get('/profile', [ProfileController::class, 'profileView'])->name('user.profile.view');
    Route::post('/profile-submit', [ProfileController::class, 'profileSubmit'])->name('user.profile.submit');
    Route::get('/change-password', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile-update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile-delete', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


/* ==================  admin routes ========================= */
Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [UserController::class, 'view'])->name('user.view');

    /* routes for driver */
    Route::prefix('driver')->group(function () {
        Route::get('/', [DriverController::class, 'view'])->name('admin.driver.view');
        Route::post('/store', [DriverController::class, 'store'])->name('admin.driver.store');
        Route::post('/update/{id}', [DriverController::class, 'update'])->name('admin.driver.update');
        Route::get('/edit/{id}', [DriverController::class, 'edit'])->name('admin.driver.edit');
        Route::get('/delete/{id}', [DriverController::class, 'delete'])->name('admin.driver.delete');
    });

    /* routes for vehicles */
    Route::prefix('vehicle')->group(function () {
        Route::get('/', [VehicleController::class, 'view'])->name('admin.vehicle.view');
        Route::post('/store', [VehicleController::class, 'store'])->name('admin.vehicle.store');
        Route::post('/update/{id}', [VehicleController::class, 'update'])->name('admin.vehicle.update');
        Route::get('/edit/{id}', [VehicleController::class, 'edit'])->name('admin.vehicle.edit');
        Route::get('/delete/{id}', [VehicleController::class, 'delete'])->name('admin.vehicle.delete');
    });

    /* routes for areas */
    Route::prefix('area')->group(function () {
        Route::get('/', [AreaController::class, 'view'])->name('admin.area.view');
        Route::post('/store', [AreaController::class, 'store'])->name('admin.area.store');
        Route::post('/update/{id}', [AreaController::class, 'update'])->name('admin.area.update');
        Route::get('/edit/{id}', [AreaController::class, 'edit'])->name('admin.area.edit');
        Route::get('/delete/{id}', [AreaController::class, 'delete'])->name('admin.area.delete');
    });


    /* routes for routes */
    Route::prefix('route')->group(function () {
        Route::get('/', [RouteController::class, 'view'])->name('admin.route.view');
        Route::get('/add', [RouteController::class, 'add'])->name('admin.route.add');
        Route::post('/store', [RouteController::class, 'store'])->name('admin.route.store');
        Route::post('/update/{id}', [RouteController::class, 'update'])->name('admin.route.update');
        Route::get('/edit/{id}', [RouteController::class, 'edit'])->name('admin.route.edit');
        Route::get('/delete/{id}', [RouteController::class, 'delete'])->name('admin.route.delete');
        Route::post('/vehicle/check-availability', [RouteController::class, 'availability']);
    });

    /* routes for preselection and slot request */
    Route::prefix('preselection')->group(function () {
        Route::get('/selections', [PreSelectionController::class, 'selectionView'])->name('admin.selection.view');
        Route::get('/selection-on-off', [PreSelectionController::class, 'selectionOnOff']);
        Route::get('/request', [PreSelectionController::class, 'requestView'])->name('admin.request.view');
    });
});

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'login'])->name('admin.login')->middleware('guest:admin');
    Route::post('/login-submit', [AdminController::class, 'login_submit'])->name('admin.login_submit')->middleware('guest:admin');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/forget-password', [AdminController::class, 'forgetPassword'])->name('admin.forgetPassword');
    Route::post('/forget-password_submit', [AdminController::class, 'forgetPassword_submit'])->name('admin.forgetPassword_submit');
    Route::get('/reset-password/{token}/{email}', [AdminController::class, 'resetPassword'])->name('admin.resetPassword');
    Route::post('/reset-password_submit', [AdminController::class, 'resetPassword_submit'])->name('admin.resetPassword_submit');

});




/* =================== Driver routes ================ */
Route::prefix('driver')->group(function () {
    Route::get('/login', [DriverProfileController::class, 'login'])->name('driver.login')->middleware('guest:driver');
    Route::post('/login-submit', [DriverProfileController::class, 'login_submit'])->name('driver.login_submit')->middleware('guest:driver');
});
Route::middleware('driver')->prefix('driver')->group(function () {
    Route::get('/dashboard', [DriverProfileController::class, 'dashboard'])->name('driver.dashboard');
    Route::get('/logout', [DriverProfileController::class, 'logout'])->name('driver.logout');
    Route::get('/profile', [DriverProfileController::class, 'profile'])->name('driver.profile');
});