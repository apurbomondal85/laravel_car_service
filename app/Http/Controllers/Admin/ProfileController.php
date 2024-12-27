<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Library\Enum;
use App\Library\Helper;
use App\Library\Response;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Profile\UpdateRequest;
use App\Http\Requests\Admin\Profile\AddressUpdateRequest;
use App\Http\Requests\Admin\Employee\UpdatePasswordRequest;
use App\Http\Requests\Admin\Profile\SocialLinkUpdateRequest;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::find(User::getAuthUser()->id);

        return view('admin.pages.profile.index', [
            'user'     => $user,
            'employee' => $user->employee,
        ]);
    }

    public function showUpdateForm()
    {
        return view('admin.pages.profile.update', [
            'user'      => User::getAuthUser(),
            'countries' => Helper::getCountries(),
            'genders'   => getDropdown(Enum::CONFIG_DROPDOWN_GENDER),
            'pronouns'  => getDropdown(Enum::CONFIG_DROPDOWN_PRONOUN),
            'titles'    => getDropdown(Enum::CONFIG_DROPDOWN_USER_TITLE),
        ]);
    }

    public function update(UpdateRequest $request)
    {
        $result = User::edit(auth()->user(), $request->validated());

        if ($result) {
            return redirect()->route('admin.profile.index')->with('success', __('Successfully Updated'));
        } else {
            return back()->withInput(request()->all())->with('error', 'Unable to Update now');
        }
    }

    public function showUpdateAddressForm()
    {
        return view('admin.pages.profile.address_update', [
            'user' => User::getAuthUser(),
        ]);
    }

    public function addressUpdate(AddressUpdateRequest $request)
    {
        $result = User::edit(auth()->user(), $request->validated());

        if ($result) {

            return redirect()->route('admin.profile.index')->with('success', __('Successfully Updated'));
        } else {

            return back()->withInput(request()->all())->with('error', 'Unable to Update now');
        }
    }

    public function showSocialLinkUpdateForm()
    {
        return view('admin.pages.profile.social_link_update', [
            'user' => User::getAuthUser(),
        ]);
    }

    public function socialLinkUpdate(SocialLinkUpdateRequest $request)
    {
        $result = User::edit(auth()->user(), $request->validated());

        if ($result) {

            return redirect()->route('admin.profile.index')->with('success', __('Successfully Updated'));
        } else {

            return back()->withInput(request()->all())->with('error', 'Unable to Update now');
        }
    }

    public function updatePasswordApi(UpdatePasswordRequest $request)
    {
        try {
            $user = User::getAuthUser();
            $data = $request->validated();
            $user->update([
                'password' => bcrypt($data['password']),
            ]);

            return Response::success(__('Successfully created'));
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return Response::error(__('Unable to create'), [], 500);
        }
    }
}
