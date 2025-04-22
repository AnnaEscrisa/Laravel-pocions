<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    
    
    
    public function profile(){
        return view('profile');
    }

}