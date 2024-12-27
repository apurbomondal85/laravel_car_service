<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\User;
use App\Library\Enum;
use App\Models\Event;
use App\Models\Career;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function dashboard()
    {
        $newMember = User::whereYear('created_at', date('Y'))->count();
        $inactiveMember = User::where('status', '0')->count();
        $activeMember = User::where('status', '1')->count();
        $blog = Post::where('post_type', Enum::POST_TYPE_BLOG)->where('is_active', 1)->whereYear('created_at', '>', date('Y'))->count();
        $event = Event::where('is_active', 1)->whereYear('created_at', '>', date('Y'))->count();


        $users = User::select(DB::raw('count(*) as total'), 'email')->groupBy('email')->orderBy('total', 'desc')->get();
        $newUsers = User::select(DB::raw('count(*) as total'))->whereYear('created_at', date('Y'))->groupBy('email')->orderBy('total', 'desc')->pluck('total')->toArray();

        $monthlyUserSignup = User::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('count(*) as total')
        )
                ->whereYear('created_at', '=', now()->year)
                ->groupBy('month')
                ->get();

        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $monthlySignup = [];


        foreach ($months as $key => $month) {
            foreach ($monthlyUserSignup as $item) {
                if ($key + 1 == $item->month) {
                    $monthlySignup[$month] = $item->total;
                } else {
                    $monthlySignup[$month] = 0;
                }
            }
        }

        return view('admin.pages.home.dashboard', compact('newMember', 'inactiveMember', 'activeMember', 'blog', 'event', 'users', 'newUsers', 'monthlySignup'));
    }
}
