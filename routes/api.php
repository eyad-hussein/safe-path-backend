<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ParentController;
use App\Http\Controllers\Api\ChildController;
use App\Http\Controllers\Api\UserController;

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

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [UserController::class, 'logout']);
});

Route::get('/relationships/{parent}/children', [ParentController::class, 'showChildren']);
Route::get('/relationships/{child}/parents', [ChildController::class, 'showParents']);

Route::prefix('parents')->group(function () {
    Route::post('{parent}/children', [ParentController::class, 'createChild']);
    Route::put('{parent}/children/{child}', [ParentController::class, 'updateChild']);
    Route::delete('{parent}/children/{child}', [ParentController::class, 'deleteChild']);
    Route::post('{parent}/children/sync', [ParentController::class, 'syncChildren']);
});

Route::prefix('children')->group(function () {
    Route::post('{child}/parents', [ChildController::class, 'createParent']);
    Route::put('{child}/parents/{parent}', [ChildController::class, 'updateParent']);
    Route::delete('{child}/parents/{parent}', [ChildController::class, 'deleteParent']);
    Route::post('{child}/parents/sync', [ChildController::class, 'syncParents']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
