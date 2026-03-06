<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function showForgotForm()
    {
        return view('forgot'); // Assuming you have a 'forgot.blade.php' view.
    }
}
