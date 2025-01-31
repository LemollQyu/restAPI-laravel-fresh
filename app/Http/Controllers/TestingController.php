<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestingController extends Controller
{
    //
    public function index() {
        return 'Hallo Annas';
    }

    // ini unutuk testing berupa tampilan web
    // untuk test crud

    public function testing(){

        $user = \App\Models\User::create([
            'name' => 'Alisa Qotru Nada',
            'email' => 'alisa@gmail.com',
            'handphone' => '0891463435563',
            'password' => bcrypt('password'),
        ]);




        return 'testing';
    }

    // function (Request $request) {
    //     return $request->user();
    // }
}
