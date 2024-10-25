<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/home', [\App\Http\Controllers\UserController::class, 'index'])
    ->name('index');

Route::get('/dashboard', function () {
    return view('frontend/dashboard/index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/user/profile', [UserController::class, 'profile'])
        ->name('user.profile');
    Route::post('/user/profile', [UserController::class, 'updateProfile'])
        ->name('user.profile.store');
    Route::get('/user/logout', [UserController::class, 'logout'])
        ->name('user.logout');
    Route::get('/user/change-password', [UserController::class, 'change_password'])
        ->name('user.change_password');
    Route::post('/user/change-password', [UserController::class, 'change_password_store'])
        ->name('user.change_password.store');
});

require __DIR__ . '/auth.php';

/*
 * Admin Path
 */
Route::get('/admin/login', [\App\Http\Controllers\AdminController::class, 'AdminLogin'])
    ->name('admin.login');
Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::get('/admin/dashboard', [\App\Http\Controllers\AdminController::class, 'AdminDashboard'])
        ->name('admin.dashboard');
    Route::get('/admin/logout', [\App\Http\Controllers\AdminController::class, 'AdminLogout'])
        ->name('admin.logout');
    Route::get('/admin/profile', [\App\Http\Controllers\AdminController::class, 'AdminProfile'])
        ->name('admin.profile');
    Route::post('/admin/profile', [\App\Http\Controllers\AdminController::class, 'AdminProfileStore'])
        ->name('admin.profile.store');
    Route::get('/admin/change_password', [\App\Http\Controllers\AdminController::class, 'AdminChangePassword'])
        ->name('admin.change_password');
    Route::post('/admin/change_password', [\App\Http\Controllers\AdminController::class, 'AdminChangePasswordStore'])
        ->name('admin.change_password.store');

    // Category
    Route::controller(\App\Http\Controllers\Backend\CategoryController::class)->group(function () {
        Route::get('/admin/category', [\App\Http\Controllers\Backend\CategoryController::class,'all'])
            ->name('category.all');
        Route::get('/admin/category/add', [\App\Http\Controllers\Backend\CategoryController::class, 'add'])
            ->name('category.add');
        Route::post('/admin/category/add', [\App\Http\Controllers\Backend\CategoryController::class, 'store'])
            ->name('category.store');
    });
});


/*
 * Instructor Path
 */
Route::get('/instructor/login', [\App\Http\Controllers\InstructorController::class, 'InstructorLogin'])
    ->name('instructor.login');
Route::middleware(['auth', 'roles:instructor'])->group(function () {
    Route::get('/instructor/dashboard', [\App\Http\Controllers\InstructorController::class, 'InstructorDashboard'])
        ->name('instructor.dashboard');
    Route::get('/instructor/logout', [\App\Http\Controllers\InstructorController::class, 'InstructorLogout'])
        ->name('instructor.logout');
    Route::get('/instructor/profile', [\App\Http\Controllers\InstructorController::class, 'InstructorProfile'])
        ->name('instructor.profile');
    Route::post('/instructor/profile', [\App\Http\Controllers\InstructorController::class, 'InstructorProfileStore'])
        ->name('instructor.profile.store');
    Route::get('/instructor/change_password', [\App\Http\Controllers\InstructorController::class, 'InstructorChangePassword'])
        ->name('instructor.change_password');
    Route::post('/instructor/change_password', [\App\Http\Controllers\InstructorController::class, 'InstructorChangePasswordStore'])
        ->name('instructor.change_password.store');
});

