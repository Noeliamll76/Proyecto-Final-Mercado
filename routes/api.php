<?php

use App\Http\Controllers\StoresController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\GuildsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\Image_productController;
use App\Models\Image_product;
use App\Models\Product;
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

    Route::post('/guilds/register', [GuildsController::class, 'guildRegister']);
    Route::put('/guilds/update/{id}', [GuildsController::class, 'guildUpdate']);
    Route::delete('/guilds/delete/{id}', [GuildsController::class, 'guildDelete']);

    Route::post('/categories/register', [CategoriesController::class, 'categoryRegister']);
    Route::put('/categories/update/{id}', [CategoriesController::class, 'categoryUpdate']);
    Route::delete('/categories/delete/{id}', [CategoriesController::class, 'categoryDelete']);
    
    Route::post('/image_product/register', [Image_productController::class, 'image_productRegister']);
    Route::put('/image_product/update/{id}', [Image_productController::class, 'image_productUpdate']);
    Route::delete('/image_product/delete/{id}', [Image_productController::class, 'image_productDelete']);


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
    Route::get('/stores/profile', [StoresController::class, 'storeProfile']);
    Route::put('/stores/update', [StoresController::class, 'storeUpdate']);

    Route::post('/product/register', [ProductController::class, 'productRegister']);
    Route::get('/product/profile/{id}', [ProductController::class, 'productProfile']);

    Route::get('/allGuilds', [GuildsController::class, 'getAllGuilds']);

    Route::get('/allCategories', [CategoriesController::class, 'getAllCategories']);
    Route::get('/categories/profileByGuild/{id}', [CategoriesController::class, 'getCategoriesByGuild']);
    
    Route::get('/allImage_product', [Image_productController::class, 'getAllImage_product']);
    
});
