<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use Carbon\Carbon;
use App\Models\User;
use App\Library\Response;
use App\Models\LoginHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogController extends Controller
{
    public function loginHistory(Request $request)
    {
        if ($request->ajax()) {
            $data = LoginHistory::select('*');

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('created_at', function ($row) {
                        return $row->created_at ? Carbon::parse($row->created_at)->format('d-m-Y H:i A') : 'N/A';
                    })
                    ->addColumn('status', function ($row) {
                        return $row->status == "success" ? '<div class="text-success">' . $row->status . '</div>' : '<div class="text-danger">' . $row->status . '</div>';
                    })
                    ->addColumn('action', function ($row) {
                        $user_role = User::getAuthUserRole();

                        if($user_role->hasPermission('log_delete_login')) {
                            $btn = '<div class="action dropdown">
                                    <button class="btn btn2-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuSizeButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">
                                        <a class="dropdown-item text-primary" href="javascript:void(0)" onclick="confirmModal(deleteLoginHistory, ' . $row->id . ', \'Are you sure to delete operation?\')" ><i class="far fa-trash-alt"></i> Delete</a>
                                    </div>
                                </div>';
                        } else {
                            $btn = '';
                        }

                        return $btn;
                    })
                    ->rawColumns(['status', 'action'])
                    ->make(true);
        }

        return view('admin.pages.logs.login_history');
    }

    public function deleteLoginHIstoryApi(LoginHistory $log)
    {
        try {
            $log->delete();

            return Response::success(__('Successfully deleted'));
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return Response::error(__('Unable to delete'), [], 500);
        }
    }

}
