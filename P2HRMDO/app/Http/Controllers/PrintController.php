<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function printMRPage()
    {    
        return view('requesting.mrpages.showmrform');
    }

    public function printEvalPage()
    {    
        return view('requesting.evalpages.saveevalpage');
    }
}
