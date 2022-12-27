<?php

use App\Http\Controllers\API\ProjectApiController;
use App\Http\Controllers\API\TaskApiController;
use App\Http\Controllers\API\UserApiController;
use App\Http\Controllers\API\UserAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [UserAuthController::class, 'register']);
Route::post('login', [UserAuthController::class, 'login']);
Route::get('logout', [UserAuthController::class, 'logout']);


Route::group([
    'prefix'    => 'project',
    'middleware'    => ['auth:api']
], function () {
    Route::post('store', [ProjectApiController::class, 'store']);
    Route::get('/{project_id}', [ProjectApiController::class, 'show']);
    Route::get('/', [ProjectApiController::class, 'index']);
    Route::post('update/{project}', [ProjectApiController::class, 'update']);
    Route::delete('delete/{project}', [ProjectApiController::class, 'delete']);
});

Route::group([
    'prefix'    => 'task',
    'middleware'    => ['auth:api']
], function () {
    Route::post('store', [TaskApiController::class, 'store']);
    Route::get('/{task_id}', [TaskApiController::class, 'show']);
    Route::get('/', [TaskApiController::class, 'index']);
    Route::post('update/{task_id}', [TaskApiController::class, 'update']);
    Route::delete('delete/{task_id}', [TaskApiController::class, 'delete']);
});

Route::group([
    'prefix'    => 'member',
    'middleware'    => ['auth:api']
], function () {
    Route::get('/tasks', [UserApiController::class, 'tasks']);
    Route::get('/task/{task_id}', [UserApiController::class, 'show']);
    Route::post('/task/update/{task_id}', [UserApiController::class, 'update']);
});

