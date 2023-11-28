<?php

use App\Http\Controllers\PharmacistController;
use App\Http\Controllers\WarehouseOwnerController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('get/{id}',[WarehouseOwnerController::class,'getMedicines']);//->middleware('auth:sanctum');
Route::post('addCategory',[WarehouseOwnerController::class,'addCategory']);
Route::post('addMedicine',[WarehouseOwnerController::class,'addMedicine']);
Route::post('register',[PharmacistController::class,'register']);
Route::post('login',[PharmacistController::class,'login']);
Route::get('logout',[PharmacistController::class,'logout'])->middleware('auth:sanctum');
Route::get('get_categories',[WarehouseOwnerController::class,'getAllCategories']);
Route::get('test/{name}',[PharmacistController::class,'test']);
