<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Role;
use App\Models\User;
use App\Library\Enum;
use App\Models\Config;
use App\Library\Helper;
use App\Library\Response;
use App\Models\Committee;
use Illuminate\Http\Request;
use App\Models\CommitteeMember;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Committee\CreateRequest;
use App\Http\Requests\Admin\Committee\UpdateRequest;
use App\Http\Requests\Admin\Committee\Member\CreateRequest as MemberCreateRequest;
use App\Http\Requests\Admin\Committee\Member\UpdateRequest as MemberUpdateRequest;

class CommitteeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Committee::all();

            return DataTables::of($data)
                    ->addIndexColumn()

                    ->addColumn('name', function ($row) {
                        return '<a href="' . route('admin.committee.show', $row->id) . '">' . $row->name . '</a>';
                    })
                    ->addColumn('created_at', function ($row) {
                        return $row->created_at->format('d-m-Y h:m a');
                    })
                    ->addColumn('is_current', function ($row) {
                        return $this->getSwitch($row);
                    })
                    ->addColumn('action', function ($row) {
                        return $this->getActionHtml($row);
                    })
                    ->rawColumns(['name', 'created_at', 'status', 'is_current', 'action'])
                    ->make(true);
        }

        return view('admin.pages.committee.index');
    }

    private function getSwitch($row)
    {
        $is_check = $row->is_current ? "checked" : "";
        $route = "'" . route('admin.committee.set_current', $row->id) . "'";

        return '<div class="custom-control custom-switch">
                    <input type="checkbox"
                        onchange="changePrimary(event, ' . $route . ')"
                        class="custom-control-input"
                        id="primarySwitch_' . $row->id . '" ' . $is_check . ' >
                    <label class="custom-control-label" for="primarySwitch_' . $row->id . '"></label>
                </div>';
    }

    private function getActionHtml($row)
    {
        $actionHtml = '';

        if($row->id) {
            $actionHtml = '<a class="dropdown-item text-primary" href="' . route('admin.committee.show', $row->id) . '" ><i class="fas fa-eye"></i> View</a>
            <a class="dropdown-item text-success" href="' . route('admin.committee.update', $row->id) . '" ><i class="far fa-edit"></i> Edit</a>';
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
        return view('admin.pages.committee.create', [
            'seasons' => Helper::getCommitteeSeason(),
        ]);
    }

    public function create(CreateRequest $request)
    {
        $result = Committee::insert($request->validated());

        if($result) {
            return redirect()->route('admin.committee.index')->with('success', __('Successfully created'));
        } else {
            return back()->withInput(request()->all())->with('error', 'Unable to create now');
        }
    }

    public function show(Committee $committee)
    {
        return view('admin.pages.committee.show', [
            'committee' => $committee,
            'members'   => $committee->members,
        ]);
    }

    public function showUpdateForm(committee $committee)
    {
        return view('admin.pages.committee.update', [
            'committee' => $committee,
            'seasons'   => Config::getDropdowns(Enum::CONFIG_DROPDOWN_SEASON)
        ]);
    }

    public function update(Committee $committee, UpdateRequest $request)
    {
        abort_unless($committee, 404);
        $result = Committee::edit($committee, $request->validated());

        if($result) {
            return redirect()->route('admin.committee.index')->with('success', __('Successfully updated'));
        } else {
            return back()->withInput(request()->all())->with('error', 'Unable to update now');
        }
    }

    public function changeStatusApi(Committee $committee)
    {
        $committee->status = !$committee->status;
        $committee->save();

        if($committee) {
            return back()->with('success', __('Successfully updated'));
        } else {
            return back()->with('error', 'Unable to create now');
        }
    }

    public function setCurrent(Committee $committee)
    {
        $result = CommitteeMember::setCurrentCommittee($committee);

        if($result) {
            return back()->with('success', __('Successfully updated'));
        }

        return back()->with('error', 'Something is Wrong !');
    }

    public function deleteApi(Committee $committee)
    {
        DB::beginTransaction();

        try {
            $committee->members()->delete();

            $committee->delete();
            DB::commit();

            return redirect()->route('admin.committee.index')->with('success', __('Successfully Deleted'));
        } catch (Exception $e) {
            return back()->with('error', __('Something is Wrong !'));
        }
    }

    // Committee members
    public function showCreatememberForm(Committee $committee)
    {
        return view('admin.pages.committee.member.create', [
            'committee'       => $committee,
            'genaral_members' => User::where('id', '!=', 1)->get(),
            // 'genaral_members'        => User::getByStatus(Enum::USER_STATUS_ACTIVE),
            'committee_designations' => Enum::getCommitteeDesignation(),
            'roles'                  => Role::getWithoutSystemAdmin(),
        ]);
    }

    public function createMember(Committee $committee, MemberCreateRequest $request)
    {
        $result = CommitteeMember::insert($committee, $request->validated());

        if($result) {
            return redirect(route('admin.committee.show', $committee->id))->with('success', 'Successfully Created');
        }

        return back()->with('error', 'Something is Wrong !');
    }

    public function showUpdateMemberForm(Committee $committee, CommitteeMember $member)
    {
        return view('admin.pages.committee.member.update', [
            'committee'              => $committee,
            'member'                 => $member,
            'genaral_members'        => User::where('id', '!=', 1)->get(),
            'committee_designations' => Enum::getCommitteeDesignation(),
            'roles'                  => Role::getWithoutSystemAdmin(),
        ]);
    }

    public function updateMember(Committee $committee, CommitteeMember $member, MemberUpdateRequest $request)
    {
        $result = CommitteeMember::edit($member, $request->validated());

        if($result) {
            return redirect(route('admin.committee.show', $committee->id))->with('success', 'Successfully Updated');
        }

        return redirect(back())->with('error', 'Something is Wrong');
    }

    public function memberDeleteApi(CommitteeMember $member)
    {
        $result = CommitteeMember::deleteCommitteeMember($member);

        if($result) {
            return Response::success(__('Successfully Deleted'));
        }

        return Response::error(__('Something is Wrong'));
    }

}
