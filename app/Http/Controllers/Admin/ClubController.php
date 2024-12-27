<?php

namespace App\Http\Controllers\Admin;

use App\Models\Club;
use App\Models\User;
use App\Library\Enum;
use App\Models\Config;
use App\Library\Response;
use App\Models\ClubMember;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Club\CreateRequest;
use App\Http\Requests\Admin\Club\UpdateRequest;
use App\Http\Requests\Admin\Club\Member\CreateRequest as MemberCreateRequest;
use App\Http\Requests\Admin\Club\Member\UpdateRequest as MemberUpdateRequest;

class ClubController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Club::getAll();

            return DataTables::of($data)
                    ->addIndexColumn()

                    ->addColumn('name', function ($row) {
                        return '<a href="' . route('admin.club.show', $row->id) . '">' . $row->name . '</a>';
                    })
                    ->addColumn('created_at', function ($row) {
                        return $row->created_at->format('d-m-Y h:m a');
                    })
                    ->addColumn('action', function ($row) {
                        return $this->getActionHtml($row);
                    })
                    ->rawColumns(['name', 'created_at', 'action'])
                    ->make(true);
        }

        return view('admin.pages.club.index');
    }

    private function getActionHtml($row)
    {
        $actionHtml = '';

        if($row->id) {
            $actionHtml = '<a class="dropdown-item text-primary" href="' . route('admin.club.show', $row->id) . '" ><i class="fas fa-eye"></i> View</a>
            <a class="dropdown-item text-success" href="' . route('admin.club.update', $row->id) . '" ><i class="far fa-edit"></i> Edit</a>';
        } else {
            $actionHtml = '';
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

    public function showCreateForm()
    {
        return view('admin.pages.club.create');
    }

    public function create(CreateRequest $request)
    {
        $result = Club::insert($request->validated());

        if($result) {
            return redirect()->route('admin.club.index')->with('success', __('Successfully created'));
        } else {
            return back()->withInput(request()->all())->with('error', 'Unable to create now');
        }
    }

    public function show(Club $club)
    {
        return view('admin.pages.club.show', [
            'club'    => $club,
            'members' => $club->members,
        ]);
    }

    public function showUpdateForm(Club $club)
    {
        return view('admin.pages.club.update', [
            'club'    => $club,
            'seasons' => Config::getDropdowns(Enum::CONFIG_DROPDOWN_SEASON)
        ]);
    }

    public function update(Club $club, UpdateRequest $request)
    {
        abort_unless($club, 404);
        $result = Club::edit($club, $request->validated());

        if($result) {
            return redirect()->route('admin.club.index')->with('success', __('Successfully updated'));
        } else {
            return back()->withInput(request()->all())->with('error', 'Unable to update now');
        }
    }

    public function deleteApi(Club $club)
    {
        $result = Club::deleteClub($club);

        if($result) {
            return redirect()->route('admin.club.index')->with('success', __('Successfully Deleted'));
        }

        return Response::error(__('Something is Wrong'));
    }

    // club members
    public function showCreatememberForm(Club $club)
    {
        // dd("hello");
        return view('admin.pages.club.member.create', [
            'club'              => $club,
            'genaral_members'   => User::getByStatus(Enum::USER_STATUS_ACTIVE),
            'club_member_types' => Enum::getClubMemberType(),
            'club_designations' => Enum::getClubCommitteeDesignation(),
        ]);
    }

    public function createMember(Club $club, MemberCreateRequest $request)
    {
        $result = ClubMember::insert($club, $request->validated());

        if($result) {
            return redirect(route('admin.club.show', $club->id))->with('success', 'Successfully Created');
        }

        return back()->with('error', 'Something is Wrong !');
    }

    public function showUpdateMemberForm(Club $club, ClubMember $member)
    {
        return view('admin.pages.club.member.update', [
            'club'              => $club,
            'member'            => $member,
            'genaral_members'   => User::getByStatus(Enum::USER_STATUS_ACTIVE),
            'club_member_types' => Enum::getClubMemberType(),
            'club_designations' => Enum::getClubCommitteeDesignation(),
        ]);
    }

    public function updateMember(Club $club, ClubMember $member, MemberUpdateRequest $request)
    {
        $result = ClubMember::edit($member, $request->validated());

        if($result) {
            return redirect(route('admin.club.show', $club->id))->with('success', 'Successfully Updated');
        }

        return back()->with('error', 'Something is Wrong');
    }

    public function memberDeleteApi(ClubMember $member)
    {
        $result = $member->delete();

        if($result) {
            return Response::success(__('Successfully Deleted'));
        }

        return Response::error(__('Something is Wrong'));
    }
}
