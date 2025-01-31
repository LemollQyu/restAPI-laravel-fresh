<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


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
