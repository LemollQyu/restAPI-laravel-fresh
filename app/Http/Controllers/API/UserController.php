<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ResponseFormatter;

class UserController extends Controller
{
    //

    public function index (Request $request) {
        return ResponseFormatter::success($request->user());
    }
}
