<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Library\Enum;
use App\Library\Helper;
use App\Library\Response;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\CreateRequest;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Http\Requests\Admin\Profile\AddressUpdateRequest;
use App\Http\Requests\Admin\Profile\SocialLinkUpdateRequest;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::filterTable($request->only(['status', 'is_deleted']));

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->deleted_at ? $row->getFullNameAttribute() : '<a class="text-primary" href="' . route('admin.user.show', $row->id) . '" >' . $row->getFullNameAttribute() . '</a>';
                })
                ->addColumn('action', function ($row) {
                    return $this->getActionHtml($row);
                })
                ->addColumn('mobile', function ($row) {
                    return $row->mobile ?? 'N/A';
                })
                ->addColumn('dob', function ($row) {
                    return $row->dob ?? 'N/A';
                })
                ->addColumn('login_access', function ($row) {
                    return $this->getLoginAccessSwitch($row);
                })
                ->rawColumns(['name', 'action', 'login_access'])
                ->make(true);
        }

        return view('admin.pages.member.index');
    }

    private function getLoginAccessSwitch($row)
    {
        $is_check = "";
        $confirmation_msg = "'Are you sure !! You Active Status?'";

        if ($row->login_access) {
            $is_check = "checked";
            $confirmation_msg = "'Are you sure !! You Inactive Status?'";
        }

        $route = "'" . route('admin.user.change_login_status', $row->id) . "'";

        return '<div class="custom-control custom-switch">
                    <input type="checkbox"
                        onchange="changeLoginStatus(event, ' . $route . ', ' . $confirmation_msg . ')"
                        class="custom-control-input"
                        id="primarySwitch_' . $row->id . '" ' . $is_check . ' >
                    <label class="custom-control-label" for="primarySwitch_' . $row->id . '"></label>
                </div>';
    }

    private function getActionHtml($row)
    {
        $actionHtml = '';

        if ($row->deleted_at) {
            $actionHtml = '<a class="dropdown-item text-secondary" href="javascript:void(0)" onclick="confirmModal(restoreEmployee, ' . $row->id . ', \'Are you sure to restore operation?\')" ><i class="fas fa-trash-restore-alt"></i> Restore</a>';
        } elseif ($row->id && !$row->deleted_at) {
            $actionHtml = '<a class="dropdown-item text-primary" href="' . route('admin.user.show', $row->id) . '" ><i class="fas fa-eye"></i> View</a>
            <a class="dropdown-item" href="' . route('admin.user.update', $row->id) . '" ><i class="far fa-edit"></i> Edit</a>';
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

    public function show(User $user)
    {
        abort_unless($user, 404);

        return view('admin.pages.member.show', [
            'user' => $user,
        ]);
    }

    public function showCreateForm()
    {
        return view('admin.pages.member.create', [
            'countries' => Helper::getCountries(),
            'genders'   => getDropdown(Enum::CONFIG_DROPDOWN_GENDER),
            'pronouns'  => getDropdown(Enum::CONFIG_DROPDOWN_PRONOUN),
            'titles'    => getDropdown(Enum::CONFIG_DROPDOWN_USER_TITLE),
            'roles'     => Role::getWithoutSystemAdmin(),
        ]);
    }

    public function create(CreateRequest $request)
    {
        $result = User::insert($request->validated());

        if ($result) {
            return redirect()->route('admin.user.index')->with('success', __('Successfully created'));
        }

        return back()->withInput(request()->all())->with('error', 'Unable to create now');
    }

    public function showUpdateForm(User $user)
    {
        abort_unless($user, 404);

        return view('admin.pages.member.update', [
            'user'      => $user,
            'countries' => Helper::getCountries(),
            'genders'   => getDropdown(Enum::CONFIG_DROPDOWN_GENDER),
            'pronouns'  => getDropdown(Enum::CONFIG_DROPDOWN_PRONOUN),
            'titles'    => getDropdown(Enum::CONFIG_DROPDOWN_USER_TITLE),
            'roles'     => Role::getWithoutSystemAdmin(),
        ]);
    }

    public function update(User $user, UpdateRequest $request)
    {
        abort_unless($user, 404);
        $result = User::edit($user, $request->validated());

        if ($result) {
            return redirect()->route('admin.user.show', $user->id)->with('success', __('Successfully updated'));
        }

        return back()->withInput(request()->all())->with('error', 'Unable to update now');
    }

    public function showUpdateAddressForm(User $user)
    {
        return view('admin.pages.member.address_update', [
            'user' => $user,
        ]);
    }

    public function addressUpdate(User $user, AddressUpdateRequest $request)
    {
        $result = User::edit($user, $request->validated());

        if ($result) {
            return redirect()->route('admin.user.show', $user->id)->with('success', __('Successfully Updated'));
        }

        return back()->withInput(request()->all())->with('error', 'Unable to Update now');
    }

    public function showSocialLinkUpdateForm(User $user)
    {
        return view('admin.pages.member.social_link_update', [
            'user' => $user,
        ]);
    }

    public function socialLinkUpdate(User $user, SocialLinkUpdateRequest $request)
    {
        $result = User::edit($user, $request->validated());

        if ($result) {
            return redirect()->route('admin.user.show', $user->id)->with('success', __('Successfully Updated'));
        }

        return back()->withInput(request()->all())->with('error', 'Unable to Update now');
    }

    public function changeStatusApi(User $user, Request $request)
    {
        try {
            if ($request->status == Enum::USER_STATUS_ACTIVE) {
                $user->update([
                    'status'      => $request->status,
                    'signup_date' => Carbon::now(),
                ]);
            } else {
                $user->update([
                    'status' => $request->status,
                ]);
            }

            return redirect()->route('admin.user.show', $user->id)->with('success', __('Successfully Change Status'));
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return Response::error(__('Unable to Change'), [], 500);
        }
    }

    public function changeLoginStatus(User $user)
    {
        if (!$user->login_access) {
            if (User::where('login_access', true)->count() >= settings('user_quota')) {
                return back()->with('error', 'Your Quota Has been Finished!!!');
            }
        }
        $user->login_access = !$user->login_access;
        $user->save();

        if ($user) {
            return back()->with('success', __('Successfully updated'));
        }

        return back()->with('error', 'Unable to create now');
    }
}
