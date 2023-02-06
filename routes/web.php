<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UpdateProfileInformationController;
use App\Http\Controllers\UpdatePasswordController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ClientController;
use App\Http\Livewire\User\UserReviewComponent;
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

Route::get('/fresh',function(){
Artisan::call('migrate:fresh');
});


Route::get('/migrate',function(){
Artisan::call('migrate');
});
Route::get('/', [HomeController::class, 'index'])->name('/');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/courses/mine', [HomeController::class, 'mine'])->name('home.courses.mine')->middleware(['is_user']);
Route::get('/courses/teacher', [HomeController::class, 'teacher'])->name('home.courses.teacher')->middleware(['is_teacher']);
Route::get('/courses/purchase/{i}', [TransactionController::class, 'create'])->name('home.transaction.create')->middleware(['is_user']);
Route::post('/courses/purchase', [TransactionController::class, 'store'])->name('home.transaction.store')->middleware(['is_user']);

Route::post('/contactusstore', [ContactController::class, 'store'])->name('pages.contactus');
Route::post('/contactusstorehome', [ContactController::class, 'storehome']);
Route::get('/dashboard/contactusindex', [ContactController::class, 'index'])->middleware('admin');
Route::get('/dashboard/contactusindex/{id}', [ContactController::class, 'show'])->middleware('admin');
Route::get('/contactus', function () {
    return view('pages/contactus', [
        "title" => "contactus"
    ]);
});



Auth::routes();

Route::prefix('user')->middleware(['auth'])->group(function () {

    Route::resource(
        'reviews',
        UserReviewComponent::class,
        [
            'names' => [
                'index' => 'users.review',
                'create' => 'admin.category.create',
                'store' => 'users.review.store',
                'show' => 'admin.category.show',
                'edit' => 'admin.category.edit',
                'update' => 'admin.category.update',
                'destroy' => 'admin.category.destroy',
            ]
        ]
    );


    });




Route::get('/courses/{i}', [HomeController::class, 'coursesDetail'])->name('home.courses.detail');
Route::get('/category/{i}', [HomeController::class, 'categoryDetail'])->name('home.category.detail');

Route::get('/event', [HomeController::class, 'event'])->name('home.event');
Route::get('/event/{id}', [HomeController::class, 'eventDetail'])->name('home.event.detail');


Route::get('/slider', [HomeController::class, 'slider'])->name('home.slider');
Route::get('/slider/{id}', [HomeController::class, 'sliderDetail'])->name('home.slider.detail');

Route::prefix('profile')->middleware(['auth'])->group(function () {
    Route::get('edit',[UpdateProfileInformationController::class,'edit'])->name('profile.edit');
    Route::put('update',[UpdateProfileInformationController::class,'update'])->name('profile.update');
    });

Route::prefix('password')->middleware(['auth'])->group(function () {

    Route::get('edit',[UpdatePasswordController::class,'edit'])->name('password.edit');
    Route::put('update',[UpdatePasswordController::class,'update'])->name('password.update');
    
});



Route::prefix('admin')->middleware(['is_admin'])->group(function () {
    Route::get('home', [HomeController::class, 'adminHome'])->name('admin.home');
    Route::get('transaction', [TransactionController::class, 'index'])->name('admin.transaction');
    Route::get('transaction/approval/{id}/{status}', [TransactionController::class, 'approval'])->name('admin.transaction.approval');
    Route::get('transaction/cetak', [TransactionController::class, 'cetak'])->name('admin.report.report');
    
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
        'teacher',
        TeacherController::class,
        [
            'names' => [
                'index' => 'admin.teacher',
                'create' => 'admin.teacher.create',
                'store' => 'admin.teacher.store',
                'show' => 'admin.teacher.show',
                'edit' => 'admin.teacher.edit',
                'update' => 'admin.teacher.update',
                'destroy' => 'admin.teacher.destroy',
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

    Route::resource(
        'slider',
        SliderController::class,
        [
            'names' => [
                'index' => 'admin.slider',
                'create' => 'admin.slider.create',
                'store' => 'admin.slider.store',
                'show' => 'admin.slider.show',
                'edit' => 'admin.slider.edit',
                'update' => 'admin.slider.update',
                'destroy' => 'admin.slider.destroy',
            ]
        ]
    );
	
	
	
	
	
	
	

    Route::resource(
        'client',
        ClientController::class,
        [
            'names' => [
                'index' => 'admin.client',
                'create' => 'admin.client.create',
                'store' => 'admin.client.store',
                'show' => 'admin.client.show',
                'edit' => 'admin.client.edit',
                'update' => 'admin.client.update',
                'destroy' => 'admin.client.destroy',
            ]
        ]
    );







    
});
