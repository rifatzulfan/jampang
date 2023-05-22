<?php

use App\Http\Controllers\Admin\InstansiController;
use App\Http\Controllers\Admin\KegunaanController;
use App\Http\Controllers\Admin\PeminjamanController as AdminPeminjamanController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\SuksesPageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);

    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
});
Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->name('logout')->middleware('auth');

Route::prefix('/dashboard-admin')->middleware(['auth', 'role:Admin,Superadmin'])->group(function () {
    Route::get('/peminjaman', [AdminPeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::get('/peminjaman/create', [AdminPeminjamanController::class, 'create'])->name('peminjaman.create');
    Route::post('/peminjaman/create', [AdminPeminjamanController::class, 'store'])->name('peminjaman.store');
    Route::get('/peminjaman/{id}', [AdminPeminjamanController::class, 'show'])->name('peminjaman.show');
    Route::get('/peminjaman/{id}/edit', [AdminPeminjamanController::class, 'edit'])->name('peminjaman.edit');
    Route::put('/peminjaman/{id}', [AdminPeminjamanController::class, 'update'])->name('peminjaman.update');
    Route::delete('/peminjaman/{id}', [AdminPeminjamanController::class, 'delete'])->name('peminjaman.destroy');
    Route::resource('kegunaan', KegunaanController::class);
    Route::resource('staff', StaffController::class);
    Route::resource('instansi', InstansiController::class);
});

Route::prefix('/dashboard-admin')->middleware(['auth', 'role:Superadmin'])->group(function () {

    Route::resource('role', RoleController::class);
    Route::resource('user', UserController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/form-peminjaman', [PeminjamanController::class, 'index'])->name('form-peminjaman.index');
    Route::post('/form-peminjaman', [PeminjamanController::class, 'store'])->name('form-peminjaman.store');
});

Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard')->middleware('auth', 'role:User');
Route::get('/success', [SuksesPageController::class, 'index'])->name('success.index')->middleware('auth');

