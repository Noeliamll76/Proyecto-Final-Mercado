<?php

use App\Http\Controllers\StoresController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::group([
    'middleware' => ['auth:sanctum', 'is_superadmin']
], function () {
    Route::put('/users/activate/{id}', [SuperAdminController::class, 'activate']);
    Route::put('/users/role/{id}', [SuperAdminController::class, 'changeRole']);
    Route::get('/allUsers', [SuperAdminController::class, 'getAllUsers']);
});

Route::group([
    'middleware' => ['auth:sanctum']
], function () {
    Route::get('/users/profile', [UserController::class, 'profile']);
    Route::post('/users/logout', [UserController::class, 'logout']);
    Route::put('/users/update', [UserController::class, 'updateUsers']);
    Route::put('/users/password', [UserController::class, 'changePassword']);
    Route::put('/users/inactivate', [UserController::class, 'inactivate']);
    Route::post('/stores/register', [StoresController::class, 'storeRegister']);
});
