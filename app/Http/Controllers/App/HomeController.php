<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('app.master');
    }
}
