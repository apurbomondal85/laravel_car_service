<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Library\Enum;
use App\Library\Helper;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use App\Models\Asset;
use App\Models\Payment;
use App\Models\User;

class ReportController extends Controller
{
    public function assetIndex(Request $request)
    {
        if ($request->ajax()) {
            $data = Asset::filterTableForReport($request->only(['startDate', 'endDate', 'status']));

            return Datatables::of($data)
                    ->addIndexColumn()

                    ->addColumn('created_by', function ($row) {
                        return $row->user?->nick_name;
                    })

                    ->addColumn('stock', function ($row) {
                        return $row->stock <= 0 ? '<span class="badge btn-danger">Stock Out</span>' : '<span class="badge btn2-secondary">' . $row->stock . '</span>' ;
                    })

                    ->rawColumns(['created_by', 'stock'])
                    ->make(true);
        }

        return view('admin.pages.report.assetIndex');
    }

    public function transactionIndex(Request $request)
    {
        if ($request->ajax()) {
            $data = Payment::filterTableForReport($request->only(['startDate', 'endDate', 'type']));

            return Datatables::of($data)
                    ->addIndexColumn()

                    ->addColumn('user_id', function ($row) {
                        return $row->user_id ? $row->user?->nick_name : 'N/A';
                    })

                    ->addColumn('amount', function ($row) {
                        return env('CURRENCY_SIGN') . $row->amount;
                    })

                    ->addColumn('type', function ($row) {
                        if($row->type == Enum::PAYMENT_TYPE_BUSINESS) {
                            $type = 'Business';
                        } elseif($row->type == Enum::PAYMENT_TYPE_SUBSCRIPTION) {
                            $type = 'Subscriptions';
                        } elseif($row->type == Enum::PAYMENT_TYPE_THANK_YOU) {
                            $type = 'Thank You';
                        } else {
                            $type = 'N/A';
                        }

                        return $type;
                    })

                    ->addColumn('created_by', function ($row) {
                        return $row->created_by ? $row->createdBy?->nick_name : 'N/A';
                    })
                    ->addColumn('created_at', function ($row) {
                        return Helper::getDateFormat($row->created_at, 'd-m-Y, h:i A');
                    })

                    ->make(true);
        }

        return view('admin.pages.report.transactionIndex');
    }

    public function memberStatusIndex(Request $request)
    {
        if ($request->ajax()) {
            $data = User::filterTableForReport($request->only(['status', 'date']));

            return Datatables::of($data)
                    ->addIndexColumn()

                    ->addColumn('member_type', function ($row) {
                        return $row->member_type ? ucwords($row->member_type) : 'N/A';
                    })

                    ->addColumn('amount', function ($row) {
                        $payData = Payment::latestPayment($row->id);

                        return $payData ? $payData->amount : 'N/A';
                    })
                    ->addColumn('created_at', function ($row) {
                        $payData = Payment::latestPayment($row->id);

                        return $payData ? Helper::getDateFormat($payData->created_at, 'd-m-Y, h:i A') : 'N/A';
                    })

                    ->addColumn('created_by', function ($row) {
                        $payData = Payment::latestPayment($row->id);

                        return $payData ? $payData->createdBy?->nick_name : 'N/A';
                    })

                    ->make(true);
        }

        return view('admin.pages.report.memberStatusIndex');
    }

    public function memberSignupIndex(Request $request)
    {
        if ($request->ajax()) {
            $data = User::filterTableForSignupReport($request->only(['startDate', 'endDate']));

            return Datatables::of($data)
                    ->addIndexColumn()

                    ->addColumn('member_type', function ($row) {
                        return $row->member_type ? ucwords($row->member_type) : 'N/A';
                    })

                    ->addColumn('membership_expired_at', function ($row) {
                        return $row->membership_expired_at ? $row->membership_expired_at : 'N/A';
                    })

                    ->addColumn('status', function ($row) {
                        if($row->status == Enum::USER_STATUS_PENDING) {
                            $status = '<span class="badge badge-danger">Pending</span>';
                        } elseif($row->status == Enum::USER_STATUS_ACTIVE) {
                            $status = '<span class="badge badge-success">Active</span>';
                        } elseif($row->status == Enum::USER_STATUS_INACTIVE) {
                            $status = '<span class="badge badge-warning">Inactive</span>';
                        } else {
                            $status = 'N/A';
                        }

                        return $status;
                    })

                    ->rawColumns(['status'])

                    ->make(true);
        }

        return view('admin.pages.report.memberSignupIndex');
    }
}
