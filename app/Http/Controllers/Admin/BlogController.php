<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\User;
use App\Library\Enum;
use App\Models\Config;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Blog\CreateRequest;
use App\Http\Requests\Admin\Blog\UpdateRequest;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Post::filterTable($request->only(['status', 'is_deleted']), Enum::POST_TYPE_BLOG);

            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('title', function ($row) {
                    $user_role = User::getAuthUserRole();

                    return $user_role->hasPermission('blog_show') ? '<a href="' . route('admin.blog.show', $row->id) . '">' . $row->title . '</a>' : '';
                })

                ->addColumn('short_description', function ($row) {
                    return substr($row->short_description, 0, 50) . '...';
                })
                ->addColumn('is_featured', function ($row) {
                    return $this->getFeatureSwitch($row);
                })

                ->addColumn('is_active', function ($row) {
                    return $this->getSwitch($row);
                })

                ->addColumn('action', function ($row) {
                    return $this->getActionHtml($row);
                })
                ->rawColumns(['title', 'short_description', 'is_featured', 'is_active', 'action'])
                ->make(true);
        }

        return view('admin.pages.website.blog.index');
    }

    private function getSwitch($row)
    {
        $is_check = $row->is_active ? "checked" : "";
        $route = "'" . route('admin.blog.change_status', $row->id) . "'";

        return '<div class="custom-control custom-switch">
                    <input type="checkbox"
                        onchange="changePrimary(event, ' . $route . ')"
                        class="custom-control-input"
                        id="primarySwitch_' . $row->id . '" ' . $is_check . ' >
                    <label class="custom-control-label" for="primarySwitch_' . $row->id . '"></label>
                </div>';
    }

    private function getActionHtml($row)
    {
        $user_role = User::getAuthUserRole();
        $actionHtml = '';
        $route = route('admin.blog.delete', $row->id);

        if ($row->id) {
            if ($user_role->hasPermission('blog_show')) {
                $actionHtml .= '<a class="dropdown-item text-primary" href="' . route('admin.blog.show', $row->id) . '" ><i class="fas fa-eye"></i> View</a>';
            }

            if ($user_role->hasPermission('blog_update')) {
                $actionHtml .= '<a class="dropdown-item" href="' . route('admin.blog.update', $row->id) . '" ><i class="far fa-edit"></i> Edit</a>';
            }

            if ($user_role->hasPermission('blog_delete')) {
                $actionHtml .= '<button class="dropdown-item" onclick="confirmFormModal(\'' . $route . '\', \'Confirmation\', \'Are you sure to delete?\');"><i class="fa fa-trash-alt"></i> Delete</button>';
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

    private function getFeatureSwitch($row)
    {
        $is_check = $row->is_featured ? "checked" : "";
        $route = "'" . route('admin.blog.change_featured', $row->id) . "'";

        return '<div class="custom-control custom-switch">
                    <input type="checkbox"
                        onchange="changePrimary(event, ' . $route . ')"
                        class="custom-control-input"
                        id="primarySwitch_' . $row->id . '2" ' . $is_check . ' >
                    <label class="custom-control-label" for="primarySwitch_' . $row->id . '2"></label>
                </div>';
    }

    public function showCreateForm()
    {
        return view('admin.pages.website.blog.create', [
            'categories' => Config::getDropdowns(Enum::CONFIG_DROPDOWN_BLOG_TYPE),
            'tags'       => Config::getDropdowns(Enum::CONFIG_DROPDOWN_BLOG_TAG),
        ]);
    }

    public function create(CreateRequest $request)
    {
        $result = Post::insert($request->validated(), Enum::POST_TYPE_BLOG);

        if ($result) {
            return redirect()->route('admin.blog.index')->with('success', __('Successfully created'));
        } else {
            return back()->withInput(request()->all())->with('error', 'Unable to create now');
        }
    }

    public function show(Post $blog)
    {
        abort_unless($blog, 404);

        return view('admin.pages.website.blog.show', [
            'blog' => $blog,
        ]);
    }

    public function showUpdateForm(Post $blog)
    {
        abort_unless($blog, 404);

        return view('admin.pages.website.blog.update', [
            'blog'       => $blog,
            'categories' => Config::getDropdowns(Enum::CONFIG_DROPDOWN_BLOG_TYPE),
            'tags'       => Config::getDropdowns(Enum::CONFIG_DROPDOWN_BLOG_TAG),
        ]);
    }

    public function update(Post $blog, UpdateRequest $request)
    {
        abort_unless($blog, 404);
        $result = Post::edit($blog, $request->validated());

        if ($result) {
            return redirect()->route('admin.blog.index')->with('success', __('Successfully updated'));
        } else {
            return back()->withInput(request()->all())->with('error', 'Unable to update now');
        }
    }

    public function delete(Post $blog)
    {
        abort_unless($blog, 404);
        $blog->delete();

        return redirect()->route('admin.blog.index')->with('success', __('Successfully Deleted'));
    }

    public function changeStatus(Post $blog)
    {
        abort_unless($blog, 404);
        $blog->is_active = !$blog->is_active;
        $blog->save();

        if ($blog) {
            return back()->with('success', __('Successfully updated'));
        } else {
            return back()->with('error', 'Unable to create now');
        }
    }

    public function changeFeatured(Post $blog)
    {
        $blog->is_featured = !$blog->is_featured;
        $blog->save();

        if ($blog) {
            return back()->with('success', __('Successfully updated'));
        } else {
            return back()->with('error', 'Unable to create now');
        }
    }
}
