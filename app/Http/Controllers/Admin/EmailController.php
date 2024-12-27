<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Email;
use App\Library\Response;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Models\EmailRecipient;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class EmailController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Email::with('user')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('sent_at', function ($row) {
                    return $row->created_at->format('m-d-Y');
                })
                ->addColumn('sent_by', function ($row) {
                    return $row->user?->getFullNameAttribute();
                })
                ->addColumn('action', function ($row) {
                    return $this->getActionHtml($row);
                })
                ->rawColumns(['action', 'sent_at', 'sent_by'])
                ->make(true);
        }

        return view('admin.pages.email.index');
    }

    private function getActionHtml($row)
    {
        $actionHtml = '<a class="dropdown-item text-primary" href="' . route('admin.email.details', $row->id) . '"><i class="fas fa-eye"></i> Show</a>
                        <a class="dropdown-item text-primary" href="' . route('admin.email.show', $row->id) . '" ><i class="fas fa-users"></i> Recipients</a>';

        return '<div class="action dropdown">
                    <button class="btn btn2-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       <i class="fas fa-tools"></i> Action
                    </button>
                    <div class="dropdown-menu">
                        ' . $actionHtml . '
                    </div>
                </div>';
    }

    public function show(Request $request, Email $email)
    {
        if ($request->ajax()) {
            $data = $email->recipients;

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->subscriber?->name;
                })
                ->addColumn('email', function ($row) {
                    return $row->subscriber?->email;
                })
                ->addColumn('mobile', function ($row) {
                    return $row->subscriber?->mobile;
                })
                ->addColumn('status', function ($row) {
                    return $this->getStatusHtml($row);
                })
                ->addColumn('action', function ($row) {
                    if ($row->try == 1 && $row->is_sent == 0) {
                        return '<a class="btn btn-warning btn-sm text-white" href="javascript:void(0)" onclick="confirmModal(resendEmail, ' . $row->id . ', \'Are you sure to restore operation?\')"><i class="fas fa-trash-restore-alt"></i> Resend</a>';
                    }

                    return '<a class="btn btn-primary btn-sm text-white disabled" href="javascript:void(0)" ><i class="fa-solid fa-envelope-circle-check"></i> Not Sent</a>';
                })
                ->rawColumns(['name', 'email', 'status', 'mobile', 'action'])
                ->make(true);
        }

        return view('admin.pages.email.show', compact('email'));
    }

    private function getStatusHtml($row)
    {
        if ($row->try == 0) {
            return '<div class="badge badge-warning">Pending</div>';
        } elseif ($row->is_sent) {
            return '<div class="badge badge-success">Success</div>';
        }

        return '<div class="badge badge-danger">Failed</div>';
    }

    public function details(Email $email)
    {
        // return Response::success(__('Success'), $email);

        return view('admin.pages.email.details', compact('email'));
    }

    public function showCreateForm()
    {
        $subscriber = Subscriber::all();

        return view('admin.pages.email.create', compact('subscriber'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'subscriber_id' => 'required',
            'subject'       => 'required',
            'message'       => 'required',
        ]);

        $result = Email::insert($request->all());

        if ($result) {
            return redirect()->route('admin.email.index')->with('success', __('Successfully send'));
        }

        return back()->with('error', __('Something went wrong! please try again.'));
    }

    public function resend(EmailRecipient $recipient)
    {
        try {
            $recipient->update(['try' => 0]);

            return Response::success(__('Successfully sent'));
        } catch (Throwable $e) {
            Log::error($e->getMessage());

            return Response::error(__('Something went wrong! please try again.'));
        }
    }
}
