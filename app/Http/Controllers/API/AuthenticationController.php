<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\ResponseFormatter;

class AuthenticationController extends Controller
{
    //

    public function login(Request $requst) {
        $email = request()->email;
        $password = request()->password;

        $user = User::where('email', $email)->first();

        // pengecekan email apakah ada di database

        if(is_null($user)){
            return ResponseFormatter::error(400, null, [
                'User tidak di temukan',
            ]);
        }


        // pengecekan password apakah sesuai dengan database

        $userPassword = $user->password;

        if(Hash::check($password, $userPassword)) {

            // kalau password benar maka create token
            $token = $user->createToken(config('app.name'))->plainTextToken;

            // dd($token);


            return ResponseFormatter::success([
                'token' => $token
            ]);
        } else {
            return ResponseFormatter::error(400, null, [
                'password salah',
            ]);
        }



        dd($email, $password);
    }
}
