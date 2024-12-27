<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Expense\CreateRequest;
use App\Http\Requests\Admin\Expense\UpdateRequest;
use App\Library\Enum;
use App\Models\Config;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use App\Models\Expense;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Expense::select('*');

            return DataTables::of($data)
                    ->addIndexColumn()

                    ->addColumn('title', function ($row) {
                        return '<a href="' . route('admin.expense.show', $row->id) . '">' . $row->title . '</a>';
                    })

                    ->addColumn('expense_type', function ($row) {
                        return ucwords($row->expense_type);
                    })

                    ->addColumn('action', function ($row) {
                        return $this->getActionHtml($row);
                    })
                    ->rawColumns(['title', 'expense_type', 'action'])
                    ->make(true);
        }

        return view('admin.pages.accounts.expense.index');
    }
    private function getActionHtml($row)
    {
        $actionHtml = '';

        if($row->id) {
            $actionHtml = '<a class="dropdown-item text-primary" href="' . route('admin.expense.show', $row->id) . '" ><i class="fas fa-eye"></i> View</a>
            <a class="dropdown-item text-primary" href="' . route('admin.expense.update', $row->id) . '" ><i class="far fa-edit"></i> Edit</a>';
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
        return view('admin.pages.accounts.expense.create', [
            'expense_type' => Config::getDropdowns(Enum::CONFIG_DROPDOWN_EXPENSE_TYPE)
        ]);
    }

    public function create(CreateRequest $request)
    {
        $result = Expense::insert($request->validated());

        if($result) {
            return redirect()->route('admin.expense.index')->with('success', __('Successfully created'));
        } else {
            return back()->withInput(request()->all())->with('error', 'Unable to create now');
        }
    }

    public function show(Expense $expense)
    {
        return view('admin.pages.accounts.expense.show', [
            'expense' => $expense,
        ]);
    }

    public function showUpdateForm(Expense $expense)
    {
        return view('admin.pages.accounts.expense.update', [
            'expense'      => $expense,
            'expense_type' => Config::getDropdowns(Enum::CONFIG_DROPDOWN_EXPENSE_TYPE)
        ]);
    }

    public function update(Expense $expense, UpdateRequest $request)
    {
        abort_unless($expense, 404);
        $result = Expense::edit($expense, $request->validated());

        if($result) {
            return redirect()->route('admin.expense.index')->with('success', __('Successfully updated'));
        } else {
            return back()->withInput(request()->all())->with('error', 'Unable to update now');
        }
    }

    public function deleteApi(Expense $expense)
    {
        $expense->delete();

        if($expense) {
            return redirect()->route('admin.expense.index')->with('success', __('Successfully Deleted'));
        } else {
            return back()->with('error', 'Unable to delete now');
        }
    }
}
