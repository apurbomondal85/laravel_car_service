<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UpdatePasswordRequest;
use App\Library\Helper;
use App\Library\Response;
use App\Models\User;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function updatePasswordApi(User $user, UpdatePasswordRequest $request)
    {
        // $this->checkRolePermission($user, 'update_password');

        try {
            $data = $request->validated();
            $user->update([
                'password' => bcrypt($data['password']),
            ]);
            $result = true;
        } catch (\Exception $e) {
            Helper::log($e);
            $result = false;
        }
        $success_message = __('Successfully updated');
        $error_message = __('Unable to update now');

        if($request->ajax()) {
            return $result ? Response::success($success_message) : Response::error($error_message);
        }

        return back()->with($result ? 'success' : 'error', $result ? $success_message : $error_message);
    }

    public function updateStatusApi(Request $request, User $user)
    {
        $this->checkRolePermission($user, 'update_status');

        $user->is_active = !$user->is_active;
        $user->save();
        $success_message = __('Successfully updated');

        if($request->ajax()) {
            return Response::success($success_message);
        }

        return back()->with('success', $success_message);
    }

    public function deleteApi(Request $request, User $user)
    {
        // $redirect = $this->checkRolePermission($user, 'delete');

        $redirect = route('admin.user.index');

        if(count($user->isCommitteeMember) || count($user->isClubMember) || count($user->isTeamMember)) {
            $result = false;
            $error_message = __('This Member is Already Connected With Committee Or Team Member, Remove From There And Try Again');

            return back()->with('error', $error_message);
        } else {

            try {
                $user->delete();
                $result = true;
            } catch (\Exception $e) {
                Helper::log($e);
                $result = false;
            }
            $success_message = __('Successfully deleted');
            $error_message = __('Unable to delete now');
        }

        if($request->ajax()) {
            return $result ? Response::success($success_message) : Response::error($error_message);
        }

        return redirect($redirect)->with($result ? 'success' : 'error', $result ? $success_message : $error_message);
    }

    public function restoreApi(Request $request, $id)
    {
        $user = User::onlyTrashed()->find($id);
        abort_unless($user, 404, 'Not found');

        // $this->checkRolePermission($user, 'restore');

        try {
            $user->restore();
            $result = true;
        } catch (\Exception $e) {
            Helper::log($e);
            $result = false;
        }
        $success_message = __('Successfully restored');
        $error_message = __('Unable to restore now');

        if($request->ajax()) {
            return $result ? Response::success($success_message) : Response::error($error_message);
        }

        return back()->with($result ? 'success' : 'error', $result ? $success_message : $error_message);
    }

    private function checkRolePermission(User $user, string $permission_suffix)
    {
        $auth_role = User::getAuthUser()->role();

        if($user->isEmployee()) {
            abort_unless($auth_role->hasPermission('employee_' . $permission_suffix), 401, 'Permission denied');
            $redirect = route('admin.employee.index');
        } elseif($user->isDonor()) {
            abort_unless($auth_role->hasPermission('donor_' . $permission_suffix), 401, 'Permission denied');
            $redirect = route('admin.donor.index');
        } elseif($user->isOrganizationOperator()) {
            abort_unless($auth_role->hasPermission('organization_operator_' . $permission_suffix), 401, 'Permission denied');
            //$redirect = route('admin.organization.show', request('org_id'));
            $redirect = url()->previous();
        }

        //This redirect variable will be used only for delete operation
        return $redirect;

    }
}
