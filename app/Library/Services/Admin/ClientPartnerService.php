<?php

namespace App\Library\Services\Admin;

use Exception;
use App\Models\User;
use App\Library\Enum;
use App\Library\Helper;
use App\Models\Client;
use Yajra\DataTables\Facades\DataTables;

class ClientPartnerService extends BaseService
{
    private function filter(array $params, $client_type)
    {
        $query = Client::with('operator');

        return $query->whereClientType($client_type)->whereIsActive($params['status']);
    }

    private function getClientType($row)
    {
        $client_type = 'partner';

        if ($row->client_type == Enum::CLIENT_TYPE_CLIENT) {
            $client_type = 'client';
        }

        return $client_type;
    }

    private function actionHtml($row, $user_role)
    {
        $client_type = $this->getClientType($row);

        $actionHtml = '';

        if ($row->id) {
            if ($user_role->hasPermission('' . $client_type . '_show')) {
                $actionHtml .= '<a class="dropdown-item" href="' . route('admin.' . $client_type . '.show', $row->id) . '" ><i class="far fa-eye"></i> View</a>';
            }

            if ($user_role->hasPermission('' . $client_type . '_update')) {
                $actionHtml .= '<a class="dropdown-item" href="' . route('admin.' . $client_type . '.update', $row->id) . '" ><i class="far fa-edit"></i> Edit</a>';
            }

            if ($user_role->hasPermission('' . $client_type . '_delete')) {
                $actionHtml .= '<a class="dropdown-item text-danger" href="#"  onclick="confirmFormModal(\'' . route('admin.' . $client_type . '.delete.api', $row->id) . '\', \'Confirmation\', \'Are you sure to delete operation?\')" ><i class="fas fa-trash"></i> Delete</a>';
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

    private function getImage($row)
    {
        return '<div class="popup">
                    <img onclick="clickImage(\'' . $row->getLogo() . '\')" src="' . asset($row->getLogo() ?? \App\Library\Enum::NO_IMAGE_PATH) . '" alt="logo" class="img-lg rounded-circle small-image">
                </div>';
    }

    private function getName($row)
    {
        $client_type = $this->getClientType($row);

        return '<a href="' . route('admin.' . $client_type . '.show', $row->id) . '" >' . $row->name . '</a>';
    }

    public function dataTable(array $filter_params, $client_type)
    {
        $data = $this->filter($filter_params, $client_type);
        $user_role = User::getAuthUserRole();

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('name', function ($row) {
                return $this->getName($row);
            })
            ->editColumn('logo', function ($row) {
                return $this->getImage($row);
            })
            ->editColumn('description', function ($row) {
                return $row->description ?? 'N/A';
            })
            ->editColumn('is_featured', function ($row) {
                return $this->getSwitch($row, $row->is_featured);
            })
            ->editColumn('operator', function ($row) {
                return $row?->operator?->full_name;
            })
            ->addColumn('action', function ($row) use ($user_role) {
                return $this->actionHtml($row, $user_role);
            })
            ->rawColumns(['name', 'logo', 'is_featured', 'action'])
            ->make(true);
    }

    public function store(array $data): bool
    {
        try {
            $data['operator_id'] = auth()->id();

            if (isset($data['logo'])) {
                $data['logo'] = Helper::uploadImage($data['logo'], Enum::CLIENT_PARTNER_LOGO_DIR, 200, 200);
            }

            Client::create($data);

            return $this->handleSuccess('Successfully created');
        } catch (Exception $e) {
            Helper::log($e);

            return $this->handleException($e);
        }
    }

    public function update(Client $client, array $data): bool
    {
        try {
            $data['operator_id'] = auth()->id();

            if (isset($data['logo'])) {
                deleteFile($client->logo);
                $data['logo'] = Helper::uploadImage($data['logo'], Enum::CLIENT_PARTNER_LOGO_DIR, 200, 200);
            }

            $this->data = $client->update($data);

            return $this->handleSuccess('Successfully Updated');
        } catch (Exception $e) {
            Helper::log($e);

            return $this->handleException($e);
        }
    }

    public function changeStatus(Client $client, $type): bool
    {
        try {
            if ($type == 'is_active') {
                $this->data = $client->update(['is_active' => !$client->is_active]);
            } else {
                $this->data = $client->update(['is_featured' => !$client->is_featured]);
            }

            return $this->handleSuccess('Successfully Updated');
        } catch (Exception $e) {
            Helper::log($e);

            return $this->handleException($e);
        }
    }

    public function delete(Client $client): bool
    {
        try {
            deleteFile($client->logo);
            $client->delete();

            $this->message = __('Successfully deleted');

            return true;
        } catch (Exception $e) {
            Helper::log($e);

            return $this->handleException($e);
        }
    }
}
