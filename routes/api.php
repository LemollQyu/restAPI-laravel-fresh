<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthenticationController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ProductController;


Route::get('/user', [UserController::class, 'index'])->middleware('auth:sanctum');


Route::get('/welcome', function (Request $request) {
    // response api punya stansar yaitu json
    return response()->json([
        'is_succes' => true,
        'app_name' => config('app.name'),
    ]);
});

Route::post('/welcome', function (Request $request) {
    // post untuk mengambil data yang di input oleh user di form data
    return request()->all();
});

Route::post('/authorization', function (Request $request) {
    // post untuk mengambil data auth di header
    return request()->header('Authorization');
});

Route::post('/login', [AuthenticationController::class, 'login']);



// Route Product
// untuk CRUD

Route::prefix('product')->middleware('auth:sanctum')->group(function() {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{id}', [ProductController::class, 'show']);
    Route::post('/', [ProductController::class, 'store']);
    Route::patch('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'destroy']);
});
