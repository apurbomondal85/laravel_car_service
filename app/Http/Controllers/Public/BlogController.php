<?php

namespace App\Http\Controllers\Public;

use App\Models\Post;
use App\Library\Enum;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index()
    {
        return view('public.pages.blogs.index', [
            'blogs' => Post::where('post_type', Enum::POST_TYPE_BLOG)->active()->get(),
        ]);
    }
    public function details(Post $blog)
    {
        return view('public.pages.blogs.details', [
            'blog'       => $blog,
            'blogs'      => Post::with('operator')->where('post_type', Enum::POST_TYPE_BLOG)->active()->limit(5)->get(),
            'categories' => Post::countBlogCategory(),
            'tags'       => getDropdown(Enum::CONFIG_DROPDOWN_BLOG_TAG),
        ]);
    }

    public function blogCategoryWise($key)
    {
        $blogs = Post::with('operator')->where('post_type', Enum::POST_TYPE_BLOG)->where('category', $key)->active()->get();

        return view('public.pages.blogs.index', [
            'blogs' => $blogs
        ]);
    }

}
