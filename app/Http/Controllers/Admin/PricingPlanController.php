<?php

namespace App\Http\Controllers\Admin;

use App\Models\PricingPlan;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Library\Services\Admin\PricingPlanService;
use App\Http\Requests\Admin\PricingPlan\CreateRequest;
use App\Http\Requests\Admin\PricingPlan\UpdateRequest;

class PricingPlanController extends Controller
{
    use ApiResponse;

    private $pricing_plan_service;

    public function __construct(PricingPlanService $pricing_plan_service)
    {
        $this->pricing_plan_service = $pricing_plan_service;
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {
            return $this->pricing_plan_service->dataTable();
        }

        return view('admin.pages.config.pricing_plan.index');
    }

    public function showCreateForm()
    {
        return view('admin.pages.config.pricing_plan.create');
    }

    public function create(CreateRequest $request)
    {
        $result = $this->pricing_plan_service->store($request->validated());

        if ($result) {
            return redirect()->route('admin.pricing_plan.index')->with('success', __('Successfully created'));
        }

        return back()->withInput(request()->all())->with('error', 'Unable to create now');

    }

    public function show(PricingPlan $pricingPlan)
    {
        return view('admin.pages.config.pricing_plan.show', [
            'pricingPlan' => $pricingPlan,
        ]);
    }

    public function showUpdateForm(PricingPlan $pricingPlan)
    {
        return view('admin.pages.config.pricing_plan.update', [
            'pricingPlan' => $pricingPlan
        ]);
    }

    public function update(PricingPlan $pricingPlan, UpdateRequest $request)
    {
        abort_unless($pricingPlan, 404);
        $result = $this->pricing_plan_service->update($pricingPlan, $request->validated());

        if ($result) {
            return redirect()->route('admin.pricing_plan.index')->with('success', __('Successfully updated'));
        }

        return back()->withInput(request()->all())->with('error', 'Unable to update now');

    }

    public function changeStatusApi(PricingPlan $pricingPlan, $type)
    {
        abort_unless($pricingPlan, 404);
        $result = $this->pricing_plan_service->changeStatus($pricingPlan, $type);

        if ($result) {
            return redirect()->route('admin.pricing_plan.show', $pricingPlan->id)->with('success', $this->pricing_plan_service->message);
        }

        return back()->with('error', $this->pricing_plan_service->message);
    }

    public function deleteApi(PricingPlan $pricingPlan)
    {
        $pricingPlan->delete();

        if ($pricingPlan) {
            return redirect()->route('admin.pricing_plan.index')->with('success', __('Successfully Deleted'));
        }

        return back()->with('error', 'Unable to delete now');
    }
}
