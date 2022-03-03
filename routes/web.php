<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TransactionController;

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

Route::get('/', [HomeController::class, 'index'])->name('/');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/courses/mine', [HomeController::class, 'mine'])->name('home.courses.mine')->middleware(['is_user']);
Route::get('/courses/purchase/{i}', [TransactionController::class, 'create'])->name('home.transaction.create')->middleware(['is_user']);
Route::post('/courses/purchase', [TransactionController::class, 'store'])->name('home.transaction.store')->middleware(['is_user']);

Route::get('/courses/{i}', [HomeController::class, 'coursesDetail'])->name('home.courses.detail');
Route::get('/category/{i}', [HomeController::class, 'categoryDetail'])->name('home.category.detail');

Auth::routes();

Route::get('/event', [HomeController::class, 'event'])->name('home.event');
Route::get('/event/{id}', [HomeController::class, 'eventDetail'])->name('home.event.detail');

Route::prefix('admin')->middleware(['is_admin'])->group(function () {
    Route::get('home', [HomeController::class, 'adminHome'])->name('admin.home');
    Route::get('transaction', [TransactionController::class, 'index'])->name('admin.transaction');
    Route::get('transaction/approval/{id}/{status}', [TransactionController::class, 'approval'])->name('admin.transaction.approval');

    Route::resource(
        'category',
        CategoryController::class,
        [
            'names' => [
                'index' => 'admin.category',
                'create' => 'admin.category.create',
                'store' => 'admin.category.store',
                'show' => 'admin.category.show',
                'edit' => 'admin.category.edit',
                'update' => 'admin.category.update',
                'destroy' => 'admin.category.destroy',
            ]
        ]
    );

    Route::resource(
        'courses',
        CoursesController::class,
        [
            'names' => [
                'index' => 'admin.courses',
                'create' => 'admin.courses.create',
                'store' => 'admin.courses.store',
                'show' => 'admin.courses.show',
                'edit' => 'admin.courses.edit',
                'update' => 'admin.courses.update',
                'destroy' => 'admin.courses.destroy',
            ]
        ]
    );

    Route::resource(
        'event',
        EventController::class,
        [
            'names' => [
                'index' => 'admin.event',
                'create' => 'admin.event.create',
                'store' => 'admin.event.store',
                'show' => 'admin.event.show',
                'edit' => 'admin.event.edit',
                'update' => 'admin.event.update',
                'destroy' => 'admin.event.destroy',
            ]
        ]
    );
});
