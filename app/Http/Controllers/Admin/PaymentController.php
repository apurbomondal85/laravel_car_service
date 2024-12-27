<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Library\Helper;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Payment::select('*');

            return DataTables::of($data)
                    ->addIndexColumn()

                    ->addColumn('user_id', function ($row) {
                        return $row->user_id ? ucwords($row->user?->full_name) : 'N/A';
                    })

                    ->addColumn('member_type', function ($row) {
                        return $row->user_id ? ucwords($row->user?->member_type) : 'Not a member';
                    })

                    ->addColumn('payment_method', function ($row) {
                        return ucwords($row->payment_method);
                    })

                    ->addColumn('type', function ($row) {
                        if($row->type == 1) {
                            $type = 'Business';
                        } elseif($row->type == 2) {
                            $type = 'Subscriptions';
                        } elseif($row->type == 3) {
                            $type = 'Thank You';
                        }

                        return $type;
                    })

                    ->addColumn('created_at', function ($row) {
                        return Helper::getDateFormat($row->created_at, 'd M, Y H:i A');
                    })

                    ->make(true);
        }

        return view('admin.pages.accounts.payments.index');
    }

}
