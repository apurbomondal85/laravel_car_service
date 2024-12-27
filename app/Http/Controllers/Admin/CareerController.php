<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Career\CreateRequest;
use App\Http\Requests\Admin\Career\UpdateRequest;
use App\Library\Enum;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use App\Models\Career;
use App\Models\Config;

class CareerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Career::filterTable($request->only(['status', 'is_deleted']));

            return DataTables::of($data)
                    ->addIndexColumn()

                    ->addColumn('title', function ($row) {
                        return '<a href="' . route('admin.career.show', $row->id) . '">' . $row->title . '</a>';
                    })

                    ->addColumn('job_type', function ($row) {
                        return $row->job_type ? ucwords($row->job_type) : 'N/A';
                    })

                    ->addColumn('location', function ($row) {
                        return $row->location ? $row->location : 'N/A';
                    })

                    ->addColumn('action', function ($row) {
                        return $this->getActionHtml($row);
                    })
                    ->rawColumns(['title', 'job_type', 'action'])
                    ->make(true);
        }

        return view('admin.pages.website.career.index');
    }
    private function getActionHtml($row)
    {
        $actionHtml = '';

        if($row->id) {
            $actionHtml = '<a class="dropdown-item text-primary" href="' . route('admin.career.show', $row->id) . '" ><i class="fas fa-eye"></i> View</a>
            <a class="dropdown-item" href="' . route('admin.career.update', $row->id) . '" ><i class="far fa-edit"></i> Edit</a>';
        } else {
            $actionHtml = '';
        }

        return '<div class="action dropdown">
                    <button class="btn btn2-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       <i class="fas fa-tools"></i> Action
                    </button>
                    <div class="dropdown-menu">
                        ' . $actionHtml . '
                    </div>
                </div>';
    }

    public function showCreateForm()
    {
        return view('admin.pages.website.career.create', [
            'job_type'      => Config::getDropdowns(Enum::CONFIG_DROPDOWN_JOB_TYPE),
            'job_locations' => Config::getDropdowns(Enum::CONFIG_DROPDOWN_JOB_LOCATION)
        ]);
    }

    public function create(CreateRequest $request)
    {
        $result = Career::insert($request->validated());

        if($result) {
            return redirect()->route('admin.career.index')->with('success', __('Successfully created'));
        } else {
            return back()->withInput(request()->all())->with('error', 'Unable to create now');
        }
    }

    public function show(Career $career)
    {
        return view('admin.pages.website.career.show', [
            'career' => $career,
        ]);
    }

    public function showUpdateForm(Career $career)
    {
        return view('admin.pages.website.career.update', [
            'career'        => $career,
            'job_type'      => Config::getDropdowns(Enum::CONFIG_DROPDOWN_JOB_TYPE),
            'job_locations' => Config::getDropdowns(Enum::CONFIG_DROPDOWN_JOB_LOCATION)
        ]);
    }

    public function update(Career $career, UpdateRequest $request)
    {
        abort_unless($career, 404);
        $result = Career::edit($career, $request->validated());

        if($result) {
            return redirect()->route('admin.career.index')->with('success', __('Successfully updated'));
        } else {
            return back()->withInput(request()->all())->with('error', 'Unable to update now');
        }
    }

    public function changeStatusApi(Career $career)
    {
        $career->is_active = !$career->is_active;
        $career->save();

        if($career) {
            return back()->with('success', __('Successfully updated'));
        } else {
            return back()->with('error', 'Unable to create now');
        }
    }
}
