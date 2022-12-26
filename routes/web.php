<?php

use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group([
    'prefix' => 'project',
    'middleware'    => 'check_admin'
], function () {
    Route::get('/', [ProjectsController::class, 'index'])->name('project');
    Route::get('create', [ProjectsController::class, 'create'])->name('project.create');
    Route::post('store', [ProjectsController::class, 'store'])->name('project.store');
    Route::get('edit/{project}', [ProjectsController::class, 'edit'])->name('project.edit');
    Route::post('update/{project}', [ProjectsController::class, 'update'])->name('project.update');
    Route::get('delete/{project}', [ProjectsController::class, 'delete'])->name('project.delete');
});


Route::group([
    'prefix' => 'task',
    'middleware'    => 'check_admin'
], function () {
    Route::get('/', [TasksController::class, 'index'])->name('task');
    Route::get('create', [TasksController::class, 'create'])->name('task.create');
    Route::post('store', [TasksController::class, 'store'])->name('task.store');
    Route::get('edit/{task}', [TasksController::class, 'edit'])->name('task.edit');
    Route::post('update/{task}', [TasksController::class, 'update'])->name('task.update');
    Route::get('delete/{task}', [TasksController::class, 'delete'])->name('task.delete');
});

Route::group([
    'prefix' => 'member',
], function () {
    Route::get('/tasks', [UserController::class, 'tasks'])->name('member.tasks');
    Route::get('edit/{task}', [UserController::class, 'edit'])->name('member.task.edit');
    Route::post('update/{task}', [UserController::class, 'update'])->name('member.task.update');
    // Route::get('delete/{task}', [UserController::class, 'delete'])->name('member.task.delete');
});
