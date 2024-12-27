<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Library\Enum;
use App\Models\Config;
use App\Library\Helper;
use App\Library\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use App\Http\Requests\Admin\Config\GeneralSettingsRequest;

class ConfigController extends Controller
{
    public function getDropdownList()
    {
        return view('admin.pages.config.dropdown.list');
    }

    public function dropdownIndex(Request $request, $dropdown)
    {
        $config = Config::getByKey($dropdown);
        $data = $config && $config->value ? json_decode($config->value) : [];

        return view('admin.pages.config.dropdown.index', [
            'dropdown' => $dropdown,
            'data'     => $data
        ]);
    }

    public function showDropdownApi($dropdown, $id)
    {
        $config = Config::getByKey($dropdown);

        return [
            'index' => $id,
            'value' => json_decode($config->value)[$id]
        ];
    }

    public function createDropdownApi(Request $request, $dropdown)
    {
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);

        $config = Config::getByKey($dropdown);
        $values = $config && $config->value ? json_decode($config->value) : [];

        if (in_array($request->name, $values)) {
            return Response::error(__($request->name . ' already exists.'));
        }

        $values[] = $request->name;
        Config::updateConfig($dropdown, json_encode($values, true));

        return Response::success(__('Successfully created'));
    }

    public function updateDropdownApi(Request $request, $dropdown, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);

        $config = Config::getByKey($dropdown);
        $values = json_decode($config->value);
        $tmp_values = $values;
        unset($tmp_values[$id]);

        if (in_array($request->name, $tmp_values)) {
            return Response::error(__($request->name . ' already exists.'));
        }

        $values[$id] = $request->name;
        Config::updateConfig($dropdown, json_encode($values, true));

        return Response::success(__('Successfully updated'));
    }

    public function deleteDropdownApi($dropdown, $id)
    {
        $config = Config::getByKey($dropdown);
        $values = json_decode($config->value);
        unset($values[$id]);
        Config::updateConfig($dropdown, json_encode($values, true));

        return Response::success(__('Successfully deleted'));
    }

    public function membershipPlan()
    {
        $data = Config::getByKey('membership_type');
        $membership_types = $data ? json_decode($data->value) : '';

        return view('admin.pages.config.membership_type', compact('membership_types'));
    }

    public function updatemembershipPlan(Request $request)
    {
        $this->validate($request, [
            'General'  => 'required|int',
            'Premium'  => 'required|int',
            'Lifetime' => 'required|int',
        ]);

        $data = [
            'general'  => $request->General,
            'premium'  => $request->Premium,
            'lifetime' => $request->Lifetime,
        ];

        try {
            Config::updateConfig('membership_type', json_encode($data, true));

            return back()->with('success', __('Successfully updated'));
        } catch (Throwable $e) {
            return back()->with('error', __('Something went wrong! please try agin.'));
        }
    }

    public function general()
    {
        return view('admin.pages.config.general_settings', [
            'countries' => Helper::getCountries(),
        ]);
    }

    public function updateGeneralSettings(GeneralSettingsRequest $request)
    {
        $data = $request->validated();

        if (isset($data['logo'])) {
            $data['logo'] = Helper::uploadImage($data['logo'], Enum::CONFIG_IMAGE_DIR, 200, 200);
        }

        if (isset($data['favicon'])) {
            $data['favicon'] = Helper::uploadImage($data['favicon'], Enum::CONFIG_IMAGE_DIR, 16, 16);
        }

        if (isset($data['og_image'])) {
            $data['og_image'] = Helper::uploadImage($data['og_image'], Enum::CONFIG_IMAGE_DIR, 100, 100);
        }

        $this->updateConfig($data);

        return back()->with('success', __('Successfully Updated'));
    }

    /**
     * Update config data
     *
     * @param array $data
     *
     * @return void
     */
    protected function updateConfig(array $data)
    {
        foreach ($data as $key => $value) {
            Config::where('key', $key)->update(['value' => $value]);
        }

        Artisan::call('cache:clear');
    }
}
