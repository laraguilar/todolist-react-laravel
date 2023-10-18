<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskListController;
use App\Http\Controllers\TasksController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register', [UserController::class, 'store'])->name('users.store');
Route::post('login', [UserController::class, 'login'])->name('users.login');

Route::group(['prefix' => 'v1', 'middleware' => 'jwt.verify'],function () {
    Route::apiResources([
        'tasklist'  =>  'TaskListController',
        'tasks' => 'TasksController',
    ]);

    Route::put('task/close/{id}', [TasksController::class, 'tasks.closeTask'])->name('tasks.closeTask');
    Route::put('list/tasks/{id}', [TasksController::class, 'tasks.tasksByList'])->name('tasks.tasksByList');

    Route::post('completedTaskList', [TaskListController::Class, 'completedTaskList'])->name('tasklist.completedTaskList');

    Route::post('logout', [UserController::Class, 'logout'])->name('users.logout');
});
