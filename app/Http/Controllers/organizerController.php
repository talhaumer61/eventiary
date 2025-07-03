<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class organizerController extends Controller
{
    public function index(){
        return view('organizer.dashboard');
    }
    public function profile(){
        return view('organizer.profile');
    }

}
