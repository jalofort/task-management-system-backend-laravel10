<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FindController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Initial route
Route::get('/', function () {
    return 'Hello from Tasks management system!';
})->withoutMiddleware(['auth.bearer']);

// Auth endpoints
Route::post('/auth/login', [AuthController::class, 'login'])->withoutMiddleware(['auth.bearer']);
Route::post('/auth/register', [AuthController::class, 'register'])->withoutMiddleware(['auth.bearer']);

// Groups
Route::get('/groups/find/{text}', [GroupController::class, 'find']);
Route::get('/groups', [GroupController::class, 'index']);
Route::post('/groups', [GroupController::class, 'store']);
Route::put('/groups/{id}', [GroupController::class, 'update']);
Route::delete('/groups/{id}', [GroupController::class, 'destroy']);

// Tasks
Route::get('/tasks/{id}', [TaskController::class, 'view']);
Route::post('/tasks', [TaskController::class, 'store']);
Route::put('/tasks/{id}', [TaskController::class, 'update']);
Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);
