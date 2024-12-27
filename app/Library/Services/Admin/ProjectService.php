<?php

namespace App\Library\Services\Admin;

use Exception;
use App\Models\User;
use App\Library\Enum;
use App\Library\Helper;
use App\Models\Project;
use Illuminate\Support\Str;
use App\Models\ProjectImage;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ProjectService extends BaseService
{
    private function actionHtml($row, $user_role)
    {
        $actionHtml = '';

        if ($row->id) {
            if ($user_role->hasPermission('project_show')) {
                $actionHtml .= '<a class="dropdown-item" href="' . route('admin.project.show', $row->id) . '" ><i class="far fa-eye"></i> View</a>';
            }

            if ($user_role->hasPermission('project_update')) {
                $actionHtml .= '<a class="dropdown-item" href="' . route('admin.project.update', $row->id) . '" ><i class="far fa-edit"></i> Edit</a>';
            }

            if ($user_role->hasPermission('project_delete')) {
                $actionHtml .= '<a class="dropdown-item text-danger" href="#"  onclick="confirmFormModal(\'' . route('admin.project.delete', $row->id) . '\', \'Confirmation\', \'Are you sure to delete operation?\')" ><i class="fas fa-trash"></i> Delete</a>';
            }
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
        $data = Project::with('operator');
        $user_role = User::getAuthUserRole();

        return Datatables::of($data)
            ->addIndexColumn()

            ->editColumn('name', function ($row) {
                return $row->name;
            })
            ->editColumn('url', function ($row) {
                return $row->url ?? 'N/A';
            })
            ->editColumn('date', function ($row) {
                return $row->date ?? 'N/A';
            })
            ->editColumn('is_featured', function ($row) {
                return $this->getSwitch($row, $row->is_featured);
            })
            ->editColumn('is_active', function ($row) {
                return $this->getSwitch($row, $row->is_active);
            })
            ->editColumn('operator', function ($row) {
                return $row?->operator?->full_name;
            })
            ->addColumn('action', function ($row) use ($user_role) {
                return $this->actionHtml($row, $user_role);
            })
            ->rawColumns(['operator', 'is_featured', 'is_active', 'action'])
            ->make(true);
    }

    public function store(array $data): bool
    {
        DB::beginTransaction();

        // try {
        $data['operator_id'] = auth()->id();
        // $data['slug'] = Str::slug($data['category']);
        $data['slug'] = rand(100000, 999999);

        if (isset($data['featured_image'])) {
            $data['featured_image'] = Helper::uploadImage($data['featured_image'], Enum::PROJECT_FEATURE_IMAGE, 200, 200);
        }

        $project = Project::create($data);

        if (!empty($data['images'])) {
            foreach ($data['images'] as $index => $attachment) {
                if (isset($attachment)) {
                    $data['attachment'] = Helper::getAttachment($attachment);
                }

                $attachment = new ProjectImage();
                $attachment->project_id = $project->id;
                $attachment->name = $data['file_name'][$index];
                $attachment->image = $data['attachment'];
                $attachment->operator_id = $data['operator_id'];
                $attachment->save();
            }
        }

        DB::commit();

        return $this->handleSuccess('Successfully created');
        // } catch (Exception $e) {
        //     Helper::log($e);
        //     DB::rollBack();

        //     return $this->handleException($e);
        // }
    }

    public function update(Project $project, array $data): bool
    {
        try {
            $data['operator_id'] = auth()->id();
            // $data['slug'] = Str::slug($data['category']);
            $data['slug'] = rand(100000, 999999);

            if (isset($data['featured_image'])) {
                deleteFile($project->featured_image);
                $data['featured_image'] = Helper::uploadImage($data['featured_image'], Enum::PROJECT_FEATURE_IMAGE, 200, 200);
            }

            $this->data = $project->update($data);

            return $this->handleSuccess('Successfully Updated');
        } catch (Exception $e) {
            Helper::log($e);

            return $this->handleException($e);
        }
    }

    public function changeStatus(Project $project, $type): bool
    {
        try {
            if ($type == 'is_active') {
                $this->data = $project->update(['is_active' => !$project->is_active]);
            } else {
                $this->data = $project->update(['is_featured' => !$project->is_featured]);
            }

            return $this->handleSuccess('Successfully Updated');
        } catch (Exception $e) {
            Helper::log($e);

            return $this->handleException($e);
        }
    }

    public function delete(Project $project): bool
    {
        try {
            if (isset($project->projectImages)) {

                foreach ($project->projectImages as $projectImage) {
                    deleteFile($projectImage->image);
                    $projectImage->delete();
                }
            }

            deleteFile($project->featured_image);
            $project->delete();

            $this->message = __('Successfully deleted');

            return true;
        } catch (Exception $e) {
            Helper::log($e);

            return $this->handleException($e);
        }
    }

    public function storeProjectImage($project, array $data): bool
    {
        try {
            if (!empty($data['images'])) {
                foreach ($data['images'] as $index => $attachment) {
                    if (isset($attachment)) {
                        $data['attachment'] = Helper::getAttachment($attachment);
                    }

                    $attachment = new ProjectImage();
                    $attachment->project_id = $project->id;
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
