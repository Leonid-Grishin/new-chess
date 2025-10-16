<?php

use App\Http\Controllers\CampController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\NewsController;

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

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/school', [SchoolController::class, 'school'])->name('school');
Route::get('/camp', [CampController::class, 'camp'])->name('camp');
Route::get('/student/{student}', [StudentController::class, 'student'])->name('student');
Route::get('/login', [UserController::class, 'login'])->name('login');

Route::group(['middleware' => 'guest'], function () {
/*    Route::get('/register', [UserController::class, 'create']);
    Route::post('/register', [UserController::class, 'store'])->name('register.store');*/
    Route::post('/login', [UserController::class, 'loginAuth'])->name('login.auth');
});

Route::get('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');

Route::prefix('api')->group(function () {
    Route::match(['get', 'post'], '/request', [\App\Http\Controllers\Api\RequestControllerApi::class, 'store'])->name('api.request');
    Route::match(['get', 'post'], '/subscriber', [\App\Http\Controllers\Api\SubscriberControllerApi::class, 'store'])->name('api.subscriber');
});

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/club', [\App\Http\Controllers\Admin\ClubController::class, 'index'])->name('admin.club');
    Route::get('/school', [\App\Http\Controllers\Admin\SchoolController::class, 'index'])->name('admin.school');
    Route::get('/students/trashed', [\App\Http\Controllers\Admin\StudentController::class, 'trashed'])->name('admin.students.trashed');
    Route::patch('/students/rating-update', [\App\Http\Controllers\Admin\StudentController::class, 'ratingUpdate'])->name('admin.students.ratingUpdate');
    Route::delete('/students/trashed/{student}', [\App\Http\Controllers\Admin\StudentController::class, 'destroyForever'])->name('admin.students.destroyForever');
    Route::patch('/students/restore/{student}', [\App\Http\Controllers\Admin\StudentController::class, 'restore'])->name('admin.students.restore');
    Route::post('requests/clear', [\App\Http\Controllers\Admin\RequestController::class, 'clear'])->name('admin.requests.clear');
    Route::post('subscribers/clear', [\App\Http\Controllers\Admin\SubscriberController::class, 'clear'])->name('admin.subscribers.clear');

    Route::get('/camp', [\App\Http\Controllers\Admin\CampController::class, 'edit'])->name('admin.camp.edit');
   Route::post('/camp/update', [\App\Http\Controllers\Admin\CampController::class, 'update'])->name('admin.camp.update');

/*    Route::resource('/camp', \App\Http\Controllers\Admin\CampController::class)->names([
        'index' => 'admin.news',
        'create' => 'admin.news.create',
        'store' => 'admin.news.store',
        'edit' => 'admin.camp',
        'update' => 'admin.camp.update',
        'show' => 'admin.news.show',
        'destroy' => 'admin.news.destroy',
    ]);*/

    Route::get('/location-slider', [\App\Http\Controllers\Admin\CampController::class, 'locationSliderEdit'])->name('admin.campLocationSlider');
    Route::post('/location-slider/update', [\App\Http\Controllers\Admin\CampController::class, 'locationSliderEditUpdate'])->name('admin.campLocationSlider.update');

    Route::get('/gallery-slider', [\App\Http\Controllers\Admin\CampController::class, 'gallerySlider'])->name('admin.campGallerySlider');
    Route::post('/gallery-slider/update', [\App\Http\Controllers\Admin\CampController::class, 'gallerySliderUpdate'])->name('admin.campGallerySlider.update');

    Route::resource('/news', NewsController::class)->names([
        'index' => 'admin.news',
        'create' => 'admin.news.create',
        'store' => 'admin.news.store',
        'edit' => 'admin.news.edit',
        'update' => 'admin.news.update',
        'show' => 'admin.news.show',
        'destroy' => 'admin.news.destroy',
    ]);

    Route::resource('/students', \App\Http\Controllers\Admin\StudentController::class)->names([
        'index' => 'admin.students',
        'create' => 'admin.students.create',
        'store' => 'admin.students.store',
        'edit' => 'admin.students.edit',
        'update' => 'admin.students.update',
        'show' => 'admin.students.show',
        'destroy' => 'admin.students.destroy',
    ]);;

    Route::resource('/reviews', \App\Http\Controllers\Admin\ReviewController::class)->names([
        'index' => 'admin.reviews',
        'create' => 'admin.reviews.create',
        'store' => 'admin.reviews.store',
        'edit' => 'admin.reviews.edit',
        'update' => 'admin.reviews.update',
        'show' => 'admin.reviews.show',
        'destroy' => 'admin.reviews.destroy',
    ]);

    Route::resource('/teachers', \App\Http\Controllers\Admin\TeacherController::class)->names([
        'index' => 'admin.teachers',
        'create' => 'admin.teachers.create',
        'store' => 'admin.teachers.store',
        'edit' => 'admin.teachers.edit',
        'update' => 'admin.teachers.update',
        'show' => 'admin.teachers.show',
        'destroy' => 'admin.teachers.destroy',
    ]);

    Route::resource('/requests', \App\Http\Controllers\Admin\RequestController::class)->names([
        'index' => 'admin.requests',
        'destroy' => 'admin.requests.destroy',
    ]);

    Route::resource('/subscribers', \App\Http\Controllers\Admin\SubscriberController::class)->names([
        'index' => 'admin.subscribers',
        'destroy' => 'admin.subscribers.destroy',
    ]);
});

Route::fallback([\App\Http\Controllers\ErrorController::class, 'error404']);
