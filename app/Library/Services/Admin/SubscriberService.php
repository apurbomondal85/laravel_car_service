<?php

namespace App\Library\Services\Admin;

use Exception;
use App\Models\User;
use App\Library\Helper;
use App\Models\Subscriber;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SubscriberService extends BaseService
{
    public function dataTable()
    {
        $data = Subscriber::all();
        $user_role = User::getAuthUserRole();

        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) use ($user_role) {
                    return $user_role->hasPermission('subscribers_show') ?
                    '<a class="text-primary" href="' . route('admin.subscribers.show', $row->id) . '">' . $row->name . '</a>' :
                    '<p class="text-dark">' . $row->name . '</p>';
                })
                ->addColumn('email', function ($row) {
                    return $row->email;
                })
                ->addColumn('mobile', function ($row) {
                    return $row->mobile ?? 'N/A';
                })
                ->addColumn('action', function ($row) {
                    return $this->getActionHtml($row);
                })
                ->rawColumns(['name', 'action'])
                ->make(true);
    }


    private function getActionHtml($row)
    {
        $actionHtml = '';
        $route = route('admin.subscribers.delete', $row->id);

        if($row->id) {
            $actionHtml = '<a class="dropdown-item text-primary" href="' . route('admin.subscribers.show', $row->id) . '" ><i class="fas fa-eye"></i> View</a>
            <a class="dropdown-item" href="' . route('admin.subscribers.update', $row->id) . '" ><i class="far fa-edit"></i> Edit</a>
            <button class="dropdown-item" onclick="confirmFormModal(\'' . $route . '\', \'Confirmation\', \'Are you sure to delete?\');"><i class="fa fa-trash-alt"></i> Delete</button>';
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

    public function store(array $data): bool
    {
        DB::beginTransaction();

        try {
            $data['operator_id'] = auth()->id();

            $this->data = Subscriber::create($data);
            DB::commit();

            return $this->handleSuccess('Successfully Created');
        } catch (Exception $e) {
            Helper::log($e);
            DB::rollBack();

            return $this->handleException($e);
        }
    }

    public function update(Subscriber $subscriber, array $data): bool
    {
        try {
            $data['operator_id'] = auth()->id();

            $this->data = $subscriber->update($data);

            return $this->handleSuccess('Successfully Updated');
        } catch (Exception $e) {
            Helper::log($e);

            return $this->handleException($e);
        }
    }
}
