<?php

namespace App\Http\Controllers\Admin;

use App\Library\Enum;
use App\Models\Asset;
use App\Models\Config;
use App\Models\AssetSale;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Asset\CreateRequest;
use App\Http\Requests\Admin\Asset\UpdateRequest;
use App\Http\Requests\Admin\AssetSale\CreateRequest as AssetSaleCreateRequest;
use App\Http\Requests\Admin\AssetSale\UpdateRequest as AssetSaleUpdateRequest;

class AssetController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Asset::filterTable($request->only(['status', 'is_deleted']));

            return Datatables::of($data)
                ->addIndexColumn()

                ->addColumn('operator', function ($row) {
                    return $row->user?->full_name;
                })

                ->addColumn('stock', function ($row) {
                    return $row->stock <= 0 ? '<span class="badge btn-danger">Stock Out</span>' : '<span class="badge btn2-secondary">' . $row->stock . '</span>';
                })

                ->addColumn('action', function ($row) {
                    return $this->getActionHtml($row);
                })
                ->rawColumns(['operator', 'stock', 'action'])
                ->make(true);
        }

        return view('admin.pages.asset.index');
    }

    private function getActionHtml($row)
    {
        $actionHtml = '';

        if ($row->id) {
            $actionHtml = '<a class="dropdown-item text-primary" href="' . route('admin.asset.show', $row->id) . '" ><i class="fas fa-eye"></i> View</a>
            <a class="dropdown-item" href="' . route('admin.asset.update', $row->id) . '" ><i class="far fa-edit"></i> Edit</a>';
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

    public function show(Asset $asset)
    {
        abort_unless($asset, 404);

        return view('admin.pages.asset.show', [
            'asset' => $asset
        ]);
    }

    public function showCreateForm()
    {
        return view('admin.pages.asset.create', [
            'asset_type' => Config::getDropdowns(Enum::CONFIG_DROPDOWN_ASSET_TYPE)
        ]);
    }

    public function create(CreateRequest $request)
    {
        $result = Asset::insert($request->validated());

        if ($result) {
            return redirect()->route('admin.asset.index')->with('success', __('Successfully created'));
        } else {
            return back()->withInput(request()->all())->with('error', 'Unable to create now');
        }
    }

    public function showUpdateForm(Asset $asset)
    {
        abort_unless($asset, 404);

        return view('admin.pages.asset.update', [
            'asset'      => $asset,
            'asset_type' => Config::getDropdowns(Enum::CONFIG_DROPDOWN_ASSET_TYPE)
        ]);
    }

    public function update(Asset $asset, UpdateRequest $request)
    {
        abort_unless($asset, 404);
        $result = Asset::edit($asset, $request->validated());

        if ($result) {
            return redirect()->route('admin.asset.index')->with('success', __('Successfully updated'));
        }

        return back()->withInput(request()->all())->with('error', 'Unable to update now');
    }

    public function changeStatusApi(Asset $asset, Request $request)
    {
        abort_unless($asset, 404);
        $result = false;

        if ($request->quantity <= $asset->stock && isset($request->status)) {
            $result = Asset::updateAsset($asset, $request->all());
        }

        if ($result) {
            return redirect()->route('admin.asset.show', $asset->id)->with('success', __('Successfully Change Status'));
        }

        return back()->withInput(request()->all())->with('error', 'Unable to update now');
    }

    // Asset Sale Module

    public function saleIndex(Request $request)
    {
        if ($request->ajax()) {
            $data = AssetSale::select('*');

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('lose_or_profit', function ($row) {
                    return $row->lose_or_profit < 0 ? '<span class="badge btn-danger">' . $row->lose_or_profit . '</span>' : '<span class="badge btn2-secondary">' . $row->lose_or_profit . '</span>';
                })
                ->addColumn('action', function ($row) {
                    return $this->getSaleActionHtml($row);
                })
                ->rawColumns(['lose_or_profit', 'action'])
                ->make(true);
        }

        return view('admin.pages.asset.sale.index');
    }

    private function getSaleActionHtml($row)
    {
        if ($row->id) {
            $actionHtml = '<a class="dropdown-item text-primary" href="' . route('admin.asset.sale.show', [$row->asset_id, $row->id]) . '" ><i class="fas fa-eye"></i> View</a>
            <a class="dropdown-item" href="' . route('admin.asset.sale.update', [$row->asset_id, $row->id]) . '" ><i class="far fa-edit"></i> Edit</a>';
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

    public function saleShow(Asset $asset, AssetSale $assetSale)
    {
        abort_unless($assetSale, 404);

        return view('admin.pages.asset.sale.show', [
            'assetSale' => $assetSale
        ]);
    }

    public function showCreateSaleForm(Asset $asset)
    {
        return view('admin.pages.asset.sale.create', [
            'asset' => $asset,
        ]);
    }

    public function saleCreate(Asset $asset, AssetSaleCreateRequest $request)
    {
        // dd($asset);
        $data = $request->validated();
        $result = AssetSale::insert($asset, $data);
        $redirect = redirect()->back();

        if ($result) {
            return $redirect->with('success', __('Successfully created'));
        } else {
            return $redirect->with('error', __('Unable to create'));
        }
    }

    public function saleShowUpdateForm(Asset $asset, AssetSale $assetSale)
    {
        abort_unless($assetSale, 404);

        return view('admin.pages.asset.sale.update', [
            'asset'     => $asset,
            'assetSale' => $assetSale,
        ]);
    }

    public function updateAssetSale(Asset $asset, AssetSale $assetSale, AssetSaleUpdateRequest $request)
    {
        $result = AssetSale::edit($asset, $assetSale, $request->validated());
        $redirect = redirect()->back();

        if ($result) {
            return $redirect->with('success', __('Successfully updated'));
        } else {
            return $redirect->with('error', __('Unable to updated'));
        }
    }
}
