<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function registerPage(){
        return view('register');
    }

    // public function logout(){
    //     return view('login');
    // }
}
