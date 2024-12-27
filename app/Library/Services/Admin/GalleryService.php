<?php

namespace App\Library\Services\Admin;

use Exception;
use App\Models\User;
use App\Library\Helper;
use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class GalleryService extends BaseService
{
    private function actionHtml($row, $user_role)
    {
        $actionHtml = '';

        if ($row->id) {
            if ($user_role->hasPermission('gallery_show')) {
                $actionHtml .= '<a class="dropdown-item" href="' . route('admin.gallery.show', $row->id) . '" ><i class="far fa-eye"></i> View</a>';
            }

            if ($user_role->hasPermission('gallery_update')) {
                $actionHtml .= '<a class="dropdown-item" href="' . route('admin.gallery.update', $row->id) . '" ><i class="far fa-edit"></i> Edit</a>';
            }

            if ($user_role->hasPermission('gallery_delete')) {
                $actionHtml .= '<a class="dropdown-item text-danger" href="#"  onclick="confirmFormModal(\'' . route('admin.gallery.delete', $row->id) . '\', \'Confirmation\', \'Are you sure to delete operation?\')" ><i class="fas fa-trash"></i> Delete</a>';
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
        $data = Gallery::with('operator');
        $user_role = User::getAuthUserRole();

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('category', function ($row) {
                return $row->category ?? 'N/A';
            })
            ->editColumn('name', function ($row) {
                return $row->name;
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
            ->rawColumns(['operator', 'is_featured', 'action'])
            ->make(true);
    }

    public function store(array $data): bool
    {
        DB::beginTransaction();

        try {
            $data['operator_id'] = auth()->id();

            $gallery = Gallery::create($data);

            if (!empty($data['images'])) {
                foreach ($data['images'] as $index => $attachment) {
                    if (isset($attachment)) {
                        $data['attachment'] = Helper::getAttachment($attachment);
                    }

                    $attachment = new GalleryImage();
                    $attachment->gallery_id = $gallery->id;
                    $attachment->name = $data['file_name'][$index];
                    $attachment->image = $data['attachment'];
                    $attachment->operator_id = $data['operator_id'];
                    $attachment->save();
                }
            }

            DB::commit();

            return $this->handleSuccess('Successfully created');
        } catch (Exception $e) {
            Helper::log($e);
            DB::rollBack();

            return $this->handleException($e);
        }
    }

    public function update(Gallery $gallery, array $data): bool
    {
        try {
            $data['operator_id'] = auth()->id();

            $gallery->update($data);

            return $this->handleSuccess('Successfully Updated');
        } catch (Exception $e) {
            Helper::log($e);

            return $this->handleException($e);
        }
    }

    public function delete(Gallery $gallery): bool
    {
        try {
            if (isset($gallery->galleryImages)) {

                foreach ($gallery->galleryImages as $galleryImage) {
                    deleteFile($galleryImage->image);
                    $galleryImage->delete();
                }
            }

            $gallery->delete();

            $this->message = __('Successfully deleted');

            return true;
        } catch (Exception $e) {
            Helper::log($e);

            return $this->handleException($e);
        }
    }

    public function storeGalleryImage($gallery, array $data): bool
    {
        try {
            if (!empty($data['images'])) {
                foreach ($data['images'] as $index => $attachment) {
                    if (isset($attachment)) {
                        $data['attachment'] = Helper::getAttachment($attachment);
                    }

                    $attachment = new GalleryImage();
                    $attachment->gallery_id = $gallery->id;
                    $attachment->name = $data['file_name'][$index];
                    $attachment->image = $data['attachment'];
                    $attachment->operator_id = auth()->id();
                    $attachment->save();
                }
            }

            return $this->handleSuccess('Successfully created');
        } catch (Exception $e) {
            Helper::log($e);

            return $this->handleException($e);
        }
    }
}
