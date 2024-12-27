<?php

namespace App\Http\Controllers\Admin;

use App\Events\Notification\CreateEvent;
use App\Events\Notification\DeleteEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notification\CreateRequest;
use App\Library\Enum;
use App\Library\Helper;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Notification;
use App\Models\User;
use Exception;
use App\Library\Response;
use App\Models\Config;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Notification::filterTable($request->only(['is_for_emp', 'is_for_donor', 'is_for_org']));

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('employee', function ($row) {
                        return $row->is_for_emp ? '<i class="fas fa-check-circle"></i>' : '';
                    })
                    ->addColumn('donor', function ($row) {
                        return $row->is_for_donor ? '<i class="fas fa-check-circle"></i>' : '';
                    })
                    ->addColumn('organization', function ($row) {
                        return $row->is_for_org ? '<i class="fas fa-check-circle"></i>' : '';
                    })
                    ->addColumn('message', function ($row) {
                        return substr($row->message, 0, 50);
                    })
                    ->addColumn('action', function ($row) {
                        return $this->getActionHtml($row);
                    })
                    ->rawColumns(['employee', 'donor', 'organization', 'message', 'action',])
                    ->make(true);
        }

        return view('admin.pages.notification.index');
    }

    private function getActionHtml($row)
    {
        $user_role = User::getAuthUserRole();

        if($user_role->hasPermission('notification_delete')) {
            $actionHtml = '<a class="dropdown-item text-danger" href="javascript:void(0)" onclick="confirmModal(deleteNotification, ' . $row->id . ', \'Are you sure to delete operation?\')" ><i class="far fa-trash-alt"></i> Delete </a>';
        } else {
            $actionHtml = '';
        }

        return '<div class="action dropdown">
                    <button class="btn btn2-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuSizeButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       <i class="fas fa-tools"></i> Action
                    </button>
                    <div class="dropdown-menu">
                        ' . $actionHtml . '
                    </div>
                </div>';
    }

    public function showCreateForm()
    {
        $notification_types = Config::getDropdowns(Enum::CONFIG_DROPDOWN_NOTIFICATION_TYPE);

        return view('admin.pages.notification.create', [
            'notification_types' => $notification_types,
        ]);
    }

    public function create(CreateRequest $request)
    {
        $notification = Notification::insert($request->validated());
        event(new CreateEvent($notification));

        if($notification) {
            return redirect()->route('admin.notification.index')->with('success', __('Successfully created'));
        } else {
            return back()->withInput(request()->all())->with('error', __('Unable to create now'));
        }
    }

    public function deleteApi(Notification $notification)
    {
        try {
            $notification->delete();
            event(new DeleteEvent($notification));

            return Response::success(__('Successfully deleted'));
        } catch (Exception $e) {
            Helper::log($e);

            return Response::error(__('Unable to delete'), [], 500);
        }
    }
}
