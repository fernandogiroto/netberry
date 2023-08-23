<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// TO DO 
// ADD BARREAR TOKEN ON HEANDER API CALL ON DASHBOARD PAGE

Route::middleware('auth')->group(function () {
    Route::post('create_task', [TaskController::class, 'create'])->name('task.api.create');
    Route::put('update_task', [TaskController::class, 'update'])->name('task.api.update');
    Route::put('complete_task', [TaskController::class, 'complete'])->name('task.api.complete');
    Route::post('delete_task', [TaskController::class, 'destroy'])->name('task.api.delete');
});
