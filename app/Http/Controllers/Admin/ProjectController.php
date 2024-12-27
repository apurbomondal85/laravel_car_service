<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Library\Services\Admin\ProjectService;
use App\Http\Requests\Admin\Project\CreateRequest;
use App\Http\Requests\Admin\Project\UpdateRequest;

class ProjectController extends Controller
{
    use ApiResponse;

    private $project_service;

    public function __construct(ProjectService $project_service)
    {
        $this->project_service = $project_service;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->project_service->dataTable();
        }

        return view('admin.pages.project.index');
    }

    public function create()
    {
        return view('admin.pages.project.create');
    }

    public function store(CreateRequest $request)
    {
        $result = $this->project_service->store($request->validated());

        if ($result) {
            return redirect()->route('admin.project.index')->with('success', $this->project_service->message);
        }

        return back()->withInput($request->all())->with('error', $this->project_service->message);
    }

    public function show(Project $project)
    {
        abort_unless($project, 404);

        return view('admin.pages.project.show', [
            'project'       => $project,
            'projectImages' => $project->projectImages,
        ]);
    }

    public function edit(Project $project)
    {
        abort_unless($project, 404);

        return view('admin.pages.project.update', [
            'project'       => $project,
            'projectImages' => $project->projectImages,
        ]);
    }

    public function update(UpdateRequest $request, Project $project): RedirectResponse
    {
        abort_unless($project, 404);
        $result = $this->project_service->update($project, $request->validated());

        if ($result) {
            return redirect()->route('admin.project.index', $project->id)->with('success', $this->project_service->message);
        }

        return back()->withInput($request->all())->with('error', $this->project_service->message);
    }

    public function destroy(Project $project): RedirectResponse
    {
        abort_unless($project, 404);
        $result = $this->project_service->delete($project);

        if($result) {
            return redirect()->route('admin.project.index')->with('success', $this->project_service->message);
        }

        return back()->with('error', 'Unable to delete now');
    }

    public function changeStatus(Project $project, $type)
    {
        abort_unless($project, 404);
        $result = $this->project_service->changeStatus($project, $type);

        if ($result) {
            return redirect()->route('admin.project.show', $project->id)->with('success', $this->project_service->message);
        }

        return back()->with('error', $this->project_service->message);
    }



    public function createProjectImage(Project $project)
    {
        return view('admin.pages.project.partial.create', [
            'project' => $project,
        ]);
    }

    public function storeProjectImage(Project $project, Request $request)
    {
        $result = $this->project_service->storeProjectImage($project, $request->all());

        if ($result) {
            return redirect()->route('admin.project.show', $project->id)->with('success', $this->project_service->message);
        }

        return back()->withInput($request->all())->with('error', $this->project_service->message);
    }

    public function destroyProjectImage(ProjectImage $projectImage)
    {
        abort_unless($projectImage, 404);

        deleteFile($projectImage->image);

        $projectImage->delete();

        return redirect()->route('admin.project.show', $projectImage->project_id)->with('success', __('Successfully Deleted'));
    }
}
