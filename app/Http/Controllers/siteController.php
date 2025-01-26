<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class siteController extends Controller
{
    public function home(){
        return view('home');
    }
    public function login(){
        return view('login');
    }
    public function signup(){
        return view('signup');
    }
    public function organizers(){
        return view('organizers');
    }
    public function events(){
        return view('events');
    }
}
