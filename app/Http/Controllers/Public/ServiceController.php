<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function index()
    {
        return view('public.pages.services.services');
    }
}
