<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    AdminController,
    DashboardController,
    UserController,
    CourseController,
    ModuleController,
    LessonController,
    SupportController
};

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

Route::prefix('admin')->group(function () {
    /**
    * Supports
    */
    Route::get('/supports', [SupportController::class, 'index'])->name('supports.index');

    /**
    * Routes Lessons
    */
    Route::resource('/modules/{moduleId}/lessons', LessonController::class);

    /**
    * Routes Modules
    */
    // como vamos fazer o Modulo dentro de Curso, sempre teremos que passar o id do Curso
    Route::resource('/courses/{courseId}/modules', ModuleController::class);

    /**
    * Routes Course
    */
    Route::resource('/courses', CourseController::class);

    /**
    * Routes Admin
    */
    Route::put('/admins/{id}/update-image', [AdminController::class, 'uploadFile'])->name('admins.update.image');
    Route::get('/admins/{id}/image', [AdminController::class, 'changeImage'])->name('admins.change.image');
    Route::resource('/admins', AdminController::class);
    
    /**
    * Routes Users
    */
    Route::put('/users/{id}/update-image', [UserController::class, 'uploadFile'])->name('users.update.image');
    Route::get('/users/{id}/image', [UserController::class, 'changeImage'])->name('users.change.image');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    
    Route::get('/', [DashboardController::class, 'index'])->name('admin.home');
});

Route::get('/', function () {
    return view('welcome');
});
