<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notice\CreateRequest;
use App\Http\Requests\Admin\Notice\UpdateRequest;
use App\Library\Enum;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use App\Models\Notice;
use App\Models\Config;

class NoticeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Notice::filterTable($request->only(['status']));

            return DataTables::of($data)
                    ->addIndexColumn()

                    ->addColumn('title', function ($row) {
                        return '<a href="' . route('admin.notice.show', $row->id) . '">' . $row->title . '</a>';
                    })

                    ->addColumn('notice_type', function ($row) {
                        return ucwords($row->notice_type);
                    })

                    ->addColumn('action', function ($row) {
                        return $this->getActionHtml($row);
                    })
                    ->rawColumns(['title', 'notice_type', 'action'])
                    ->make(true);
        }

        return view('admin.pages.website.notice.index');
    }
    private function getActionHtml($row)
    {
        $actionHtml = '';

        if($row->id) {
            $actionHtml = '<a class="dropdown-item text-primary" href="' . route('admin.notice.show', $row->id) . '" ><i class="fas fa-eye"></i> View</a>
            <a class="dropdown-item" href="' . route('admin.notice.update', $row->id) . '" ><i class="far fa-edit"></i> Edit</a>';
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
        return view('admin.pages.website.notice.create', [
            'notice_type' => Config::getDropdowns(Enum::CONFIG_DROPDOWN_NOTICE_TYPE)
        ]);
    }

    public function create(CreateRequest $request)
    {
        $result = Notice::insert($request->validated());

        if($result) {
            return redirect()->route('admin.notice.index')->with('success', __('Successfully created'));
        } else {
            return back()->withInput(request()->all())->with('error', 'Unable to create now');
        }
    }

    public function show(Notice $notice)
    {
        return view('admin.pages.website.notice.show', [
            'notice' => $notice,
        ]);
    }

    public function showUpdateForm(Notice $notice)
    {
        return view('admin.pages.website.notice.update', [
            'notice'      => $notice,
            'notice_type' => Config::getDropdowns(Enum::CONFIG_DROPDOWN_NOTICE_TYPE)
        ]);
    }

    public function update(Notice $notice, UpdateRequest $request)
    {
        abort_unless($notice, 404);
        $result = Notice::edit($notice, $request->validated());

        if($result) {
            return redirect()->route('admin.notice.index')->with('success', __('Successfully updated'));
        } else {
            return back()->withInput(request()->all())->with('error', 'Unable to update now');
        }
    }

    public function changeStatusApi(Notice $notice)
    {
        $notice->is_active = !$notice->is_active;
        $notice->save();

        if($notice) {
            return back()->with('success', __('Successfully updated'));
        } else {
            return back()->with('error', 'Unable to update now');
        }
    }

    public function deleteApi(Notice $notice)
    {
        $notice->delete();

        if($notice) {
            return redirect()->route('admin.notice.index')->with('success', __('Successfully Deleted'));
        } else {
            return back()->with('error', 'Unable to delete now');
        }
    }
}
