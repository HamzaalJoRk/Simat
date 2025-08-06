<?php

use App\Http\Controllers\FeeController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\NationalityController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SimatController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\TankController;
use App\Http\Controllers\RefuelingController;
use App\Http\Controllers\CarBrandController;


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

Route::get('/', function () {
    if (auth()->user()->hasRole('Super Admin')) {
        return redirect('/dashboard');
    } elseif (auth()->user()->hasRole('Simats')) {
        return redirect('/simats');
    } elseif (auth()->user()->hasRole('Cargo Insurance')) {
        return redirect('/insurances/cargo');
    } elseif (auth()->user()->hasRole('Tourist Insurance')) {
        return redirect('/insurances/tourist');
    } elseif (auth()->user()->hasRole('Admin')) {
        return redirect('/simats');
    }
})->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('/users', function () {
    return view('users.index');
})->middleware('auth')->name('users.index');
Route::get('/users/edit/{id}', 'UserController@edit')->name('users.edit');


Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);
Route::get('user-create', [UserController::class, 'create_user']);
Route::resource('products', ProductController::class);
//Route::resource('permissions', PermissionController::class);

Route::middleware(['auth']) // Implement admin middleware to restrict access
    ->group(function () {
        Route::get('change-password', [UserController::class, 'changePasswordForm'])->name('password.change');
        Route::post('change-password', [UserController::class, 'changePassword'])->name('password.update');


        Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
        Route::get('/permissions-create', [PermissionController::class, 'create'])->name('permissions.create');
        Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
        Route::get('/permissions/{permission}', [PermissionController::class, 'edit'])->name('permissions.edit');
        Route::put('/permissions/{permission}', [PermissionController::class, 'update'])->name('permissions.update');
        Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');

        Route::prefix('simats')->name('simats.')->group(function () {
            Route::get('/', [SimatController::class, 'index'])->name('index');
            Route::get('/create', [SimatController::class, 'create'])->name('create');
            Route::post('/', [SimatController::class, 'store'])->name('store');
            Route::get('/{id}', [SimatController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [SimatController::class, 'edit'])->name('edit');
            Route::put('/{id}', [SimatController::class, 'update'])->name('update');
            Route::delete('/{id}', [SimatController::class, 'destroy'])->name('destroy');
            Route::get('/{id}/receipt', [SimatController::class, 'printReceipt'])->name('receipt');

        });

        Route::prefix('nationalities')->name('nationalities.')->group(function () {
            Route::get('/', [NationalityController::class, 'index'])->name('index');
            Route::get('/create', [NationalityController::class, 'create'])->name('create');
            Route::post('/', [NationalityController::class, 'store'])->name('store');
            Route::get('/{id}', [NationalityController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [NationalityController::class, 'edit'])->name('edit');
            Route::put('/{id}', [NationalityController::class, 'update'])->name('update');
            Route::delete('/{id}', [NationalityController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('fees')->name('fees.')->group(function () {
            Route::get('/', [FeeController::class, 'index'])->name('index');
            Route::get('/create', [FeeController::class, 'create'])->name('create');
            Route::post('/', [FeeController::class, 'store'])->name('store');
            Route::get('/{id}', [FeeController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [FeeController::class, 'edit'])->name('edit');
            Route::put('/{id}', [FeeController::class, 'update'])->name('update');
            Route::delete('/{id}', [FeeController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('insurances')->name('insurances.')->group(function () {
            Route::get('/cargo', [InsuranceController::class, 'indexCargo'])->name('indexCargo');
            Route::get('/tourist', [InsuranceController::class, 'indexTourist'])->name('indexTourist');
            // Route::get('/', [InsuranceController::class, 'index'])->name('index');
            Route::get('/create', [InsuranceController::class, 'create'])->name('create');
            Route::post('/', [InsuranceController::class, 'store'])->name('store');
            Route::get('/{id}', [InsuranceController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [InsuranceController::class, 'edit'])->name('edit');
            Route::put('/{id}', [InsuranceController::class, 'update'])->name('update');
            Route::delete('/{id}', [InsuranceController::class, 'destroy'])->name('destroy');
            Route::get('/{id}/receipt', [InsuranceController::class, 'printReceipt'])->name('receipt');
        });
    });
//Route::get('/users', [UserController::class, 'index'])->name('users.index');
require __DIR__ . '/auth.php';
