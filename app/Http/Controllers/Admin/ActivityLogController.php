<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use DataTables;
use Carbon\Carbon;
use App\Library\Response;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Library\Enum;
use App\Models\User;
use Illuminate\Support\Facades\View;

class ActivityLogController extends Controller
{
    /**
     * Fetch and show activity log
     *
     * @param Request $request
     * @return View
     */
    public function activityLog(Request $request)
    {
        if ($request->ajax()) {
            $data = ActivityLog::getData();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action_by', function ($row) {
                        return $row->user ? $row->user->full_name : '';
                    })
                    ->addColumn('user_type', function ($row) {
                        return $row->user ? Enum::getUserType($row->user->user_type) : '';
                    })
                    ->addColumn('event_type', function ($row) {
                        return $row->action;
                    })
                    ->addColumn('log_time', function ($row) {
                        return Carbon::parse($row->log_time)->format('M d, Y h:i A');
                    })
                    ->addColumn('details', function ($row) {
                        $user_role = User::getAuthUserRole();

                        return $user_role->hasPermission('activity_log_details') ? '<a href="javascript:void(0)" onclick="showActivityLogDetails(' . $row->id . ')" ></i> <u>Details</u></a>' : 'Details';
                    })
                    ->addColumn('action', function ($row) {
                        return $this->getActionHtml($row);
                    })
                    ->rawColumns(['action', 'details'])
                    ->make(true);
        }

        return view('admin.pages.logs.activity_log');
    }

    public function deleteActivityLog(ActivityLog $activity)
    {
        try {
            $activity->delete();

            return Response::success(__('Successfully deleted'));
        } catch (Throwable $e) {
            Log::error($e->getMessage());

            return Response::error(__('Unable to delete'), [], 500);
        }
    }

    public function getActionHtml($row)
    {
        $user_role = User::getAuthUserRole();
        $actionHtml = '';

        if($user_role->hasPermission('activity_log_delete')) {
            $actionHtml = '<a class="dropdown-item text-primary" href="javascript:void(0)" onclick="confirmModal(deleteActivityLog, ' . $row->id . ', \'Are you sure to delete operation?\')" ><i class="far fa-trash-alt"></i> Delete</a>';
        } else {
            $actionHtml = '';
        }

        return '<div class="action dropdown">
                    <button class="btn btn2-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuSizeButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">
                        ' . $actionHtml . '
                    </div>
                </div>';
    }

    public function activityLogDetails(ActivityLog $activity)
    {
        return Response::success(__('Successfully Retrived'), $activity->changes);
    }
}
