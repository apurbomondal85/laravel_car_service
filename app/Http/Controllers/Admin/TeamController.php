<?php

namespace App\Http\Controllers\Admin;

use App\Models\Team;
use App\Models\User;
use App\Library\Enum;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Team\CreateRequest;
use App\Http\Requests\Admin\Team\UpdateRequest;
use App\Library\Services\Admin\Team\TeamService;
use App\Http\Requests\Admin\Team\Member\CreateRequest as MemberCreateRequest;
use App\Http\Requests\Admin\Team\Member\UpdateRequest as MemberUpdateRequest;

class TeamController extends Controller
{
    use ApiResponse;

    private $team_service;

    public function __construct(TeamService $team_service)
    {
        $this->team_service = $team_service;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->team_service->dataTable();
        }

        return view('admin.pages.website.team.index', [
            'team' => Team::count(),
        ]);
    }

    public function create(CreateRequest $request)
    {
        $result = $this->team_service->store($request->validated());

        if ($result) {
            return redirect()->route('admin.team.index')->with('success', $this->team_service->message);
        }

        return back()->withInput(request()->all())->with('error', $this->team_service->message);
    }

    public function showUpdateForm(Team $team)
    {
        return view('admin.pages.website.team.update', [
            'team' => $team,
        ]);
    }

    public function update(Team $team, UpdateRequest $request)
    {
        abort_unless($team, 404);
        $result = $this->team_service->update($team, $request->validated());

        if ($result) {
            return redirect()->route('admin.team.index')->with('success', $this->team_service->message);
        }

        return back()->withInput(request()->all())->with('error', $this->team_service->message);
    }

    public function show(Team $team)
    {
        return view('admin.pages.website.team.show', [
            'team'    => $team,
            'members' => $team->members ? $team->members : [],
        ]);
    }

    public function changeActiveStatus(Team $team)
    {
        $team->is_active = !$team->is_active;
        $team->save();

        if ($team) {
            return back()->with('success', __('Successfully Updated'));
        }

        return back()->with('error', 'Unable to create now');
    }

    public function changeFeatureStatus(Team $team)
    {
        $team->is_featured = !$team->is_featured;
        $team->save();

        if ($team) {
            return back()->with('success', __('Successfully Updated'));
        }

        return back()->with('error', 'Unable to create now');
    }

    public function delete(Team $team)
    {
        $result = $this->team_service->delete($team);

        if ($result) {
            return redirect(route('admin.team.index'))->with('success', $this->team_service->message);
        }

        return back()->with('error', $this->team_service->message);
    }

    //======================== Member Section ====================//

    public function showCreateMemberForm(Team $team)
    {
        return view('admin.pages.website.team.member.create', [
            'team'              => $team,
            'users'             => User::memberNotInTeam($team->members->pluck('user_id')->toArray())->get(),
            'team_designations' => getDropdown(Enum::CONFIG_DROPDOWN_TEAM_DESIGNATION),
        ]);
    }

    public function createMember(Team $team, MemberCreateRequest $request)
    {
        $result = $this->team_service->storeMember($team, $request->validated());

        if ($result) {
            return redirect()->route('admin.team.show', $team->id)->with('success', $this->team_service->message);
        }

        return back()->withInput(request()->all())->with('error', $this->team_service->message);
    }

    public function showUpdateMemberForm(TeamMember $member)
    {
        return view('admin.pages.website.team.member.update', [
            'member'            => $member,
            'team_designations' => getDropdown(Enum::CONFIG_DROPDOWN_TEAM_DESIGNATION),
        ]);
    }

    public function updateMember(TeamMember $member, MemberUpdateRequest $request)
    {
        $result = $this->team_service->updateMember($member, $request->validated());

        if ($result) {
            return redirect()->route('admin.team.show', $member->team->id)->with('success', $this->team_service->message);
        }

        return back()->withInput(request()->all())->with('error', $this->team_service->message);
    }

    public function changeMemberActiveStatus(TeamMember $member)
    {
        $member->is_active = !$member->is_active;
        $member->save();

        if ($member) {
            return back()->with('success', __('Successfully updated'));
        }

        return back()->with('error', 'Unable to create now');
    }

    public function changeMemberFeatureStatus(TeamMember $member)
    {
        $member->is_featured = !$member->is_featured;
        $member->save();

        if ($member) {
            return back()->with('success', __('Successfully updated'));
        }

        return back()->with('error', 'Unable to create now');
    }

    public function memberDeleteApi(TeamMember $member)
    {
        $result = $member->delete();

        if ($result) {
            return redirect()->back()->with('success', 'Successfully Deleted !!');
        }

        return back()->with('error', 'Unable to Delete now');
    }
}
