<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Business\CreateRequest;
use App\Http\Requests\Admin\Business\UpdateRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

use App\Models\Business;
use App\Models\Config;
use App\Library\Enum;
use App\Models\User;

class ThankYouController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Business::filterTable($request->only(['status']), Enum::PAYMENT_TYPE_THANK_YOU);

            return DataTables::of($data)
                    ->addIndexColumn()

                    ->addColumn('title', function ($row) {
                        return '<a href="' . route('admin.thanks.show', $row->id) . '">' . $row->title . '</a>';
                    })

                    ->addColumn('business_type', function ($row) {
                        return ucwords($row->business_type);
                    })

                    ->addColumn('action', function ($row) {
                        return $this->getActionHtml($row);
                    })
                    ->rawColumns(['title', 'business_type', 'action'])
                    ->make(true);
        }

        return view('admin.pages.website.thank_you.index');
    }
    private function getActionHtml($row)
    {
        $actionHtml = '';

        if($row->id) {
            $actionHtml = '<a class="dropdown-item text-primary" href="' . route('admin.thanks.show', $row->id) . '" ><i class="fas fa-eye"></i> View</a>';
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
        return view('admin.pages.website.thank_you.create', [
            'business_type' => Config::getDropdowns(Enum::CONFIG_DROPDOWN_BUSINESS_TYPE),
            'ranking'       => Enum::getBusinessRanking(),
            'members'       => User::getByMember(Enum::USER_TYPE_MEMBER),
        ]);
    }

    public function create(CreateRequest $request)
    {
        $type = Enum::PAYMENT_TYPE_THANK_YOU;
        $result = Business::insert($request->validated(), $type);

        if($result) {
            return redirect()->route('admin.thanks.index')->with('success', __('Successfully created'));
        } else {
            return back()->withInput(request()->all())->with('error', 'Unable to create now');
        }
    }

    public function show(Business $business)
    {
        return view('admin.pages.website.thank_you.show', [
            'business' => $business,
            'ranking'  => Enum::getBusinessRanking(),
        ]);
    }

    public function showUpdateForm(Business $business)
    {
        return view('admin.pages.website.thank_you.update', [
            'business'      => $business,
            'ranking'       => Enum::getBusinessRanking(),
            'business_type' => Config::getDropdowns(Enum::CONFIG_DROPDOWN_BUSINESS_TYPE),
            'members'       => User::getByMember(Enum::USER_TYPE_MEMBER),
        ]);
    }

    public function update(Business $business, UpdateRequest $request)
    {
        abort_unless($business, 404);
        $result = Business::edit($business, $request->validated());

        if($result) {
            return redirect()->route('admin.thanks.index')->with('success', __('Successfully updated'));
        } else {
            return back()->withInput(request()->all())->with('error', 'Unable to update now');
        }
    }

    public function changeStatusApi(Business $business)
    {
        $business->is_active = !$business->is_active;
        $business->save();

        if($business) {
            return back()->with('success', __('Successfully updated'));
        } else {
            return back()->with('error', 'Unable to update now');
        }
    }

    public function deleteApi(Business $business)
    {
        $business->delete();

        if($business) {
            return redirect()->route('admin.thanks.index')->with('success', __('Successfully Deleted'));
        } else {
            return back()->with('error', 'Unable to delete now');
        }
    }



    public function confirmPaymentApi(Business $business)
    {
        $result = Business::confirmPayment($business);

        if($result) {
            return back()->with('success', __('Successfully Updated'));
        } else {
            return back()->with('error', 'Unable to confirm payment now');
        }
    }
}
