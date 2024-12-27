<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Transaction\CreateRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;


use App\Library\Enum;
use App\Library\Helper;
use App\Models\MembershipPlan;
use App\Models\Transaction;
use App\Models\User;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Transaction::filterTable($request->only(['status']));

            return DataTables::of($data)
                    ->addIndexColumn()

                    ->addColumn('created_by', function ($row) {
                        return $row->created_by ? ucwords($row->user?->full_name) : 'N/A';
                    })

                    ->addColumn('user_id', function ($row) {
                        return ucwords($row->member?->full_name);
                    })

                    ->addColumn('membershipType', function ($row) {
                        return $row->membership?->type;
                    })

                    ->addColumn('payment_method', function ($row) {
                        return ucwords($row->payment_method);
                    })

                    ->addColumn('transaction_id', function ($row) {
                        return $row->transaction_id ? ucwords($row->transaction_id) : 'N/A';
                    })

                    ->addColumn('created_at', function ($row) {
                        return Helper::getDateFormat($row->created_at, 'd M, Y H:i A');
                    })

                    ->addColumn('action', function ($row) {
                        return $this->getActionHtml($row);
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.pages.accounts.transaction.index');
    }

    private function getActionHtml($row)
    {
        $actionHtml = '';

        if($row->id) {
            $actionHtml = '<a class="dropdown-item text-primary" href="' . route('admin.transaction.show', $row->id) . '" ><i class="fas fa-eye"></i> View</a>';
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

    public function showCreateForm(Request $request)
    {
        $membership_types = MembershipPlan::whereIsActive(1)->get();

        if(isset($request->id)) {
            $id = $request->id;
        } else {
            $id = '';
        }

        return view('admin.pages.accounts.transaction.create', [
            'members'          => User::getByMember(Enum::USER_TYPE_MEMBER),
            'payment_method'   => Enum::getPaymentMethod(),
            'membership_types' => $membership_types,
            'id'               => $id,
        ]);
    }

    public function create(CreateRequest $request)
    {
        $result = Transaction::insert($request->validated());

        if($result) {
            return redirect()->route('admin.transaction.index')->with('success', __('Successfully created'));
        } else {
            return back()->withInput(request()->all())->with('error', 'Unable to create now');
        }
    }

    public function show(Transaction $transaction)
    {
        return view('admin.pages.accounts.transaction.show', [
            'transaction' => $transaction,
        ]);
    }

    public function changeStatusApi(Transaction $transaction, Request $request)
    {
        $result = Transaction::updateStatus($transaction, $request->all());

        if($result) {
            return back()->with('success', __('Successfully updated'));
        } else {
            return back()->withInput(request()->all())->with('error', 'Unable to update now');
        }
    }

    public function deleteApi(Transaction $transaction)
    {
        $transaction->delete();

        if($transaction) {
            return redirect()->route('admin.transaction.index')->with('success', __('Successfully Deleted'));
        } else {
            return back()->with('error', 'Unable to delete now');
        }
    }
}
