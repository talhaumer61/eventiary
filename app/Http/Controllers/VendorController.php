<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index(){
        return view('vendor.dashboard');
    }
    
    public function vendor_signup(){
        return view('vendor.signup');
    }
}
