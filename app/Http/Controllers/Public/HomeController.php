<?php

namespace App\Http\Controllers\Public;

use App\Models\Post;
use App\Models\Client;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        // dd(Client::getClient()->take(10));

        return view('public.pages.index', [
            'blogs'    => Post::getLandingPageBlog()->take(4),
        ]);
    }
}
