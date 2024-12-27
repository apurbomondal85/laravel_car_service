<?php

namespace App\Library\Services\Admin;

use Exception;
use App\Models\User;
use App\Library\Helper;
use App\Models\PricingPlan;
use Yajra\DataTables\Facades\DataTables;

class PricingPlanService extends BaseService
{
    private function getActionHtml($row, $user_role)
    {
        $actionHtml = '';

        if ($row->id) {
            if ($user_role->hasPermission('pricing_plan_show')) {
                $actionHtml .= '<a class="dropdown-item text-primary" href="' . route('admin.pricing_plan.show', $row->id) . '" ><i class="fas fa-eye"></i> View</a>';
            }

            if ($user_role->hasPermission('pricing_plan_update')) {
                $actionHtml .= '<a class="dropdown-item" href="' . route('admin.pricing_plan.update', $row->id) . '" ><i class="far fa-edit"></i> Edit</a>';
            }

            if ($user_role->hasPermission('pricing_plan_delete')) {
                $actionHtml .= '<a class="dropdown-item text-danger" onclick="confirmFormModal(\'' . route('admin.pricing_plan.delete.api', $row->id) . '\', \'Confirmation\', \'Are you sure to delete operation?\')" ><i class="fas fa-trash-alt"></i> Delete</a>';
            }
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

    private function getSwitch($row, $status)
    {
        $is_check = $status ? "checked" : "";

        return '<div class="custom-control custom-switch">
                    <input type="checkbox" disabled class="custom-control-input"
                        id="primarySwitch_' . $row->id . '" ' . $is_check . '>
                    <label class="custom-control-label" for="primarySwitch_' . $row->id . '"></label>
                </div>';
    }

    public function dataTable()
    {
        $user_role = User::getAuthUserRole();
        $data = PricingPlan::get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('name', function ($row) {
                return '<a href="' . route('admin.pricing_plan.show', $row->id) . '">' . $row->name . '</a>';
            })
            ->editColumn('is_featured', function ($row) {
                return $this->getSwitch($row, $row->is_featured);
            })
            ->editColumn('is_active', function ($row) {
                return $this->getSwitch($row, $row->is_active);
            })
            ->addColumn('operator', function ($row) {
                return $row?->operator?->full_name;
            })
            ->addColumn('action', function ($row) use ($user_role) {
                return $this->getActionHtml($row, $user_role);
            })
            ->rawColumns(['name', 'is_featured', 'is_active', 'action'])
            ->make(true);
    }

    public function store(array $data): bool
    {
        try {
            $data['operator_id'] = auth()->id();

            PricingPlan::create($data);

            return $this->handleSuccess('Successfully created');
        } catch (Exception $e) {
            Helper::log($e);

            return $this->handleException($e);
        }
    }

    public function update(PricingPlan $pricingPlan, array $data): bool
    {
        try {
            $data['operator_id'] = auth()->id();

            $this->data = $pricingPlan->update($data);

            return $this->handleSuccess('Successfully Updated');
        } catch (Exception $e) {
            Helper::log($e);

            return $this->handleException($e);
        }
    }

    public function changeStatus(PricingPlan $pricingPlan, $type): bool
    {
        try {
            if ($type == 'is_active') {
                $this->data = $pricingPlan->update(['is_active' => !$pricingPlan->is_active]);
            } else {
                $this->data = $pricingPlan->update(['is_featured' => !$pricingPlan->is_featured]);
            }

            return $this->handleSuccess('Successfully Updated');
        } catch (Exception $e) {
            Helper::log($e);

            return $this->handleException($e);
        }
    }
}
