<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
       /**
     * Forgot password Form
     */

     public function showLinkRequestForm()
     {
         return view('auth.forget-password');
     }


}
