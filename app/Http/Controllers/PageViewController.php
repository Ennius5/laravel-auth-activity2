<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class PageViewController extends Controller
{
    public function showProfile(){
        $user = User::find(Session::get('user_id'));
        return view('profile.show', compact('user'));
    }

    public function showLogin(){
        return view('auth.login');
    }

    public function showRegister(){
        return view('auth.register');
    }

    public function showHome(){
        return view('general.home');
    }


    public function showtaskIndex(){
        return view('tasks.index');
    }
}
