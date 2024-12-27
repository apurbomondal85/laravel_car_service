<?php

namespace App\Library\Services\Admin\Team;

use Exception;
use App\Models\Team;
use App\Models\User;
use App\Library\Helper;
use App\Models\TeamMember;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Library\Services\Admin\BaseService;

class TeamService extends BaseService
{
    private function getActionHtml($row, $user_role)
    {
        $actionHtml = '';

        if ($user_role->hasPermission('team_show')) {
            $actionHtml .= '<a class="dropdown-item text-primary" href="' . route('admin.team.show', $row->id) . '" ><i class="fas fa-eye"></i> View </a>';
        }

        if ($user_role->hasPermission('team_update')) {
            $actionHtml .= '<a class="dropdown-item text-success" href="' . route('admin.team.update', $row->id) . '" ><i class="far fa-edit"></i> Edit</a>';
        }

        if ($user_role->hasPermission('team_delete')) {
            $actionHtml .= '<a class="dropdown-item text-danger" href="#"  onclick="confirmFormModal(\'' . route('admin.team.delete', $row->id) . '\', \'Confirmation\', \'Are you sure to delete operation?\')" ><i class="fas fa-trash"></i> Delete</a>';
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

    private function getActiveSwitch($row)
    {
        $is_check = "";
        $confirmation_msg = "'Are you sure !! You Active Team Status?'";

        if ($row->is_active) {
            $is_check = "checked";
            $confirmation_msg = "'Are you sure !! You Inactive Team Status?'";
        }

        $route = "'" . route('admin.team.update_active_status', $row->id) . "'";

        return '<div class="custom-control custom-switch">
                    <input type="checkbox"
                        onchange="changeActiveStatus(event, ' . $route . ', ' . $confirmation_msg . ')"
                        class="custom-control-input"
                        id="primarySwitch_' . $row->id . '" ' . $is_check . ' >
                    <label class="custom-control-label" for="primarySwitch_' . $row->id . '"></label>
                </div>';
    }

    private function getFeatureSwitch($row)
    {
        $is_check = "";
        $confirmation_msg = "'Are you sure !! You Active IsFeatured Status?'";

        if ($row->is_featured) {
            $is_check = "checked";
            $confirmation_msg = "'Are you sure !! You Inactive IsFeatured Status?'";
        }

        $route = "'" . route('admin.team.update_feature_status', $row->id) . "'";

        return '<div class="custom-control custom-switch">
                    <input type="checkbox"
                        onchange="changeFeatureStatus(event, ' . $route . ', ' . $confirmation_msg . ')"
                        class="custom-control-input"
                        id="primaryFeatureSwitch_' . $row->id . '" ' . $is_check . ' >
                    <label class="custom-control-label" for="primaryFeatureSwitch_' . $row->id . '"></label>
                </div>';
    }

    public function dataTable()
    {
        $data = Team::all();
        $user_role = User::getAuthUserRole();

        return DataTables::of($data)
            ->addIndexColumn()

            ->addColumn('name', function ($row) {
                return '<a href="' . route('admin.team.show', $row->id) . '">' . $row->name . '</a>';
            })
            ->addColumn('created_at', function ($row) {
                return $row->created_at->format('d-m-Y h:m a');
            })
            ->addColumn('short_description', function ($row) {
                return substr($row->short_description, 0, 50) . '...';
            })
            ->addColumn('is_active', function ($row) {
                return $this->getActiveSwitch($row);
            })
            ->addColumn('is_featured', function ($row) {
                return $this->getFeatureSwitch($row);
            })
            ->editColumn('operator_id', function ($row) {
                return $row?->operator?->full_name;
            })
            ->addColumn('action', function ($row) use ($user_role) {
                return $this->getActionHtml($row, $user_role);
            })
            ->rawColumns(['name', 'is_active', 'action', 'is_featured', 'operator_id', 'short_description'])
            ->make(true);
    }

    public function store(array $data): bool
    {
        try {
            $data['operator_id'] = auth()->id();
            Team::create($data);

            return $this->handleSuccess('Successfully Created !!');
        } catch (Exception $e) {
            Helper::log($e);

            return $this->handleException($e);
        }
    }

    public function update(Team $team, array $data): bool
    {
        try {
            $data['operator_id'] = auth()->id();
            $this->data = $team->update($data);

            return $this->handleSuccess('Successfully Updated');
        } catch (Exception $e) {
            Helper::log($e);

            return $this->handleException($e);
        }
    }

    public function changeStatus(Team $team): bool
    {
        try {
            $this->data = $team->update(['is_active' => !$team->is_active]);

            return $this->handleSuccess('Successfully Updated');
        } catch (Exception $e) {
            Helper::log($e);

            return $this->handleException($e);
        }
    }

    public function delete(Team $team): bool
    {
        try {
            DB::beginTransaction();

            $team->members()->delete();
            $team->delete();

            $this->message = __('Successfully Deleted !!');
            DB::commit();

            return true;
        } catch (Exception $e) {
            Helper::log($e);
            DB::rollback();

            return $this->handleException($e);
        }
    }

    public function storeMember(Team $team, array $data): bool
    {
        try {
            $data['operator_id'] = auth()->id();
            $data['team_id'] = $team->id;
            TeamMember::create($data);

            return $this->handleSuccess('Successfully Created');
        } catch (Exception $e) {
            Helper::log($e);

            return $this->handleException($e);
        }
    }

    public function updateMember(TeamMember $member, array $data): bool
    {
        try {
            $data['operator_id'] = auth()->id();
            $member->update($data);

            return $this->handleSuccess('Successfully Created');
        } catch (Exception $e) {
            Helper::log($e);

            return $this->handleException($e);
        }
    }
}
