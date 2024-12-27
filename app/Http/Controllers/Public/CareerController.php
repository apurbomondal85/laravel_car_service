<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Career;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function index(){
        return view('public.pages.career.index',[
            'careers' => Career::CareerPage(),
        ]);
    }

    public function details(Career $career){
        return view('public.pages.career.details',[
            'career' => $career,
        ]);
    }
}
