<?php

namespace App\Http\Controllers\Public;

use App\Models\Project;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function index()
    {
        return view('public.pages.projects.index', [
            'projects' => Project::with('operator')->get(),
        ]);
    }

    public function show(Project $project)
    {
        abort_unless($project, 404);

        return view('admin.pages.project.show', [
            'project'       => $project,
            'projectImages' => $project->projectImages,
        ]);
    }

}
