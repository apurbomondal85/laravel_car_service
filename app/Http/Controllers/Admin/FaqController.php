<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Faq\CreateRequest;
use App\Http\Requests\Admin\Faq\UpdateRequest;
use App\Models\Faq;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Faq::filterTable($request->only(['status', 'is_deleted']));

            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('question', function ($row) {
                    return '<a class="text-primary" href="' . route('admin.faqs.show', $row->id) . '">' . substr($row->question, 0, 50) . '</a>';
                })

                ->addColumn('answer', function ($row) {
                    return substr($row->answer, 0, 50);
                })

                ->addColumn('is_active', function ($row) {
                    return $this->getSwitch($row);
                })

                ->addColumn('action', function ($row) {
                    return $this->getActionHtml($row);
                })
                ->rawColumns(['question', 'is_active', 'action'])
                ->make(true);
        }

        return view('admin.pages.website.faq.index');
    }

    private function getSwitch($row)
    {
        $is_check = $row->is_active ? "checked" : "";
        $route = "'" . route('admin.faqs.change_status', $row->id) . "'";

        return '<div class="custom-control custom-switch">
                    <input type="checkbox"
                        onchange="changeStatus(event, ' . $route . ')"
                        class="custom-control-input"
                        id="primarySwitch_' . $row->id . '" ' . $is_check . ' >
                    <label class="custom-control-label" for="primarySwitch_' . $row->id . '"></label>
                </div>';
    }

    private function getActionHtml($row)
    {
        $actionHtml = '';
        $route = route('admin.faqs.delete', $row->id);

        if ($row->id) {
            $actionHtml = '<a class="dropdown-item text-primary" href="' . route('admin.faqs.show', $row->id) . '" ><i class="fas fa-eye"></i> View</a>
            <a class="dropdown-item" href="' . route('admin.faqs.update', $row->id) . '" ><i class="far fa-edit"></i> Edit</a>
            <button class="dropdown-item" onclick="confirmFormModal(\'' . $route . '\', \'Confirmation\', \'Are you sure to delete?\');"><i class="fa fa-trash-alt"></i> Delete</button>';
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
        return view('admin.pages.website.faq.create');
    }

    public function create(CreateRequest $request)
    {
        $result = Faq::insert($request->validated());

        if ($result) {
            return redirect()->route('admin.faqs.index')->with('success', __('Successfully created'));
        } else {
            return back()->withInput(request()->all())->with('error', 'Unable to create now');
        }
    }

    public function show(Faq $faq)
    {
        return view('admin.pages.website.faq.show', [
            'faq' => $faq,
        ]);
    }

    public function showUpdateForm(Faq $faq)
    {
        return view('admin.pages.website.faq.update', [
            'faq' => $faq
        ]);
    }

    public function update(Faq $faq, UpdateRequest $request)
    {
        abort_unless($faq, 404);
        $result = Faq::edit($faq, $request->validated());

        if ($result) {
            return redirect()->route('admin.faqs.index')->with('success', __('Successfully updated'));
        } else {
            return back()->withInput(request()->all())->with('error', 'Unable to update now');
        }
    }
    public function delete(Faq $faq)
    {
        abort_unless($faq, 404);
        $faq->delete();

        return redirect()->route('admin.faqs.index')->with('success', __('Successfully Deleted'));
    }

    public function changeStatus(Faq $faq)
    {
        $faq->is_active = !$faq->is_active;
        $faq->save();

        if ($faq) {
            return back()->with('success', __('Successfully updated'));
        } else {
            return back()->with('error', 'Unable to update now');
        }
    }
}
