<?php

namespace App\Http\Controllers\Admin;

use App\Models\Club;
use App\Models\User;
use App\Library\Enum;
use App\Models\Config;

use App\Models\ClubCommittee;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClubCommittee\CreateRequest;
use App\Http\Requests\Admin\ClubCommittee\UpdateRequest;

class ClubCommitteeController extends Controller
{
    public function showCreateMemberForm(Club $club)
    {
        return view('admin.pages.website.club.member.create', [
            'club'        => $club,
            'member'      => User::getByMemberNotAdmin(Enum::USER_TYPE_ADMIN),
            'designation' => Config::getDropdowns(Enum::CONFIG_DROPDOWN_MEMBER_DESIGNATION)
        ]);
    }

    public function createMember(Club $club, CreateRequest $request)
    {
        $result = ClubCommittee::insert($request->validated());

        $redirect = redirect()->route('admin.club.show', $club->id);

        if($result) {
            return $redirect->with('success', __('Successfully created'));
        } else {
            return $redirect->with('error', __('Unable to create'));
        }
    }

    public function showUpdateMemberForm(Club $club, ClubCommittee $clubCommittee)
    {
        return view('admin.pages.website.club.member.update', [
            'club'          => $club,
            'clubCommittee' => $clubCommittee,
            'member'        => User::getByMemberNotAdmin(Enum::USER_TYPE_ADMIN),
            'designation'   => Config::getDropdowns(Enum::CONFIG_DROPDOWN_MEMBER_DESIGNATION)
        ]);
    }

    public function updateMember(Club $club, ClubCommittee $clubCommittee, UpdateRequest $request)
    {
        ClubCommittee::edit($clubCommittee, $request->validated());

        return back()->with('success', __('Successfully updated'));
    }

    public function updateStatusApi(ClubCommittee $clubCommittee)
    {
        $clubCommittee->is_active = !$clubCommittee->is_active;
        $clubCommittee->save();

        if($clubCommittee) {
            return back()->with('success', __('Successfully updated'));
        } else {
            return back()->with('error', 'Unable to update now');
        }
    }

    public function deleteApi(ClubCommittee $clubCommittee)
    {
        $clubCommittee->delete();

        if($clubCommittee) {
            return redirect()->route('admin.club.show', $clubCommittee->club_id)->with('success', __('Successfully Deleted'));
        } else {
            return back()->with('error', 'Unable to delete now');
        }
    }
}
