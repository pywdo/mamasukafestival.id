<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\EventController;

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
Route::get('/courses/{i}', [HomeController::class, 'coursesDetail'])->name('home.courses.detail');

Auth::routes();

Route::get('/event', [HomeController::class, 'event'])->name('home.event');
Route::get('/event/{id}', [HomeController::class, 'eventDetail'])->name('home.event.detail');

Route::prefix('admin')->middleware(['is_admin'])->group(function () {
    Route::get('home', [HomeController::class, 'adminHome'])->name('admin.home');

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
