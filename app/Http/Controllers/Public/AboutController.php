<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\TeamMember;

class AboutController extends Controller
{
    public function index()
    {
        return view('public.pages.about.index');
    }

    public function team()
    {
        $team = Team::findActiveFeaturedTeam();
        $teamMembers = TeamMember::where('team_id', $team->id ?? '')->active()->get();

        return view('public.pages.about.team', [
            'team'        => $team,
            'teamMembers' => $teamMembers,
        ]);
    }
}
