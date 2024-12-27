<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Library\Enum;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\News\CreateRequest;
use App\Http\Requests\Admin\News\UpdateRequest;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Post::filterTable($request->only(['status', 'is_deleted']), Enum::POST_TYPE_NEWS);

            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('title', function ($row) {
                    return '<a class="text-primary" href="' . route('admin.news.show', $row->id) . '">' . $row->title . '</a>';
                })

                ->addColumn('link', function ($row) {
                    return '<a class="text-primary" target = "_blank" href="' . $row->link . '"> Click Here </a>';
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
                ->rawColumns(['title', 'link', 'is_featured', 'is_active', 'action'])
                ->make(true);
        }

        return view('admin.pages.website.news.index');
    }

    private function getSwitch($row)
    {
        $is_check = $row->is_active ? "checked" : "";
        $route = "'" . route('admin.news.change_status', $row->id) . "'";

        return '<div class="custom-control custom-switch">
                    <input type="checkbox"
                        onchange="changePrimary(event, ' . $route . ')"
                        class="custom-control-input"
                        id="primarySwitch_' . $row->id . '" ' . $is_check . ' >
                    <label class="custom-control-label" for="primarySwitch_' . $row->id . '"></label>
                </div>';
    }

    private function getFeatureSwitch($row)
    {
        $is_check = $row->is_featured ? "checked" : "";
        $route = "'" . route('admin.news.change_featured', $row->id) . "'";

        return '<div class="custom-control custom-switch">
                    <input type="checkbox"
                        onchange="changePrimary(event, ' . $route . ')"
                        class="custom-control-input"
                        id="primarySwitch_' . $row->id . '2" ' . $is_check . ' >
                    <label class="custom-control-label" for="primarySwitch_' . $row->id . '2"></label>
                </div>';
    }

    private function getActionHtml($row)
    {
        $actionHtml = '';
        $route = route('admin.news.delete', $row->id);

        if ($row->id) {
            $actionHtml = '<a class="dropdown-item text-primary" href="' . route('admin.news.show', $row->id) . '" ><i class="fas fa-eye"></i> View</a>
            <a class="dropdown-item" href="' . route('admin.news.update', $row->id) . '" ><i class="far fa-edit"></i> Edit</a>
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

    public function showCreateForm()
    {
        return view('admin.pages.website.news.create');
    }

    public function create(CreateRequest $request)
    {
        $result = Post::insert($request->validated(), Enum::POST_TYPE_NEWS);

        if ($result) {
            return redirect()->route('admin.news.index')->with('success', __('Successfully created'));
        } else {
            return back()->withInput(request()->all())->with('error', 'Unable to create now');
        }
    }

    public function show(Post $news)
    {
        $news->load('operator');

        return view('admin.pages.website.news.show', [
            'news' => $news,
        ]);
    }

    public function showUpdateForm(Post $news)
    {
        return view('admin.pages.website.news.update', [
            'news' => $news
        ]);
    }

    public function update(Post $news, UpdateRequest $request)
    {
        abort_unless($news, 404);
        $result = Post::edit($news, $request->validated());

        if ($result) {
            return redirect()->route('admin.news.index')->with('success', __('Successfully updated'));
        } else {
            return back()->withInput(request()->all())->with('error', 'Unable to update now');
        }
    }

    public function delete(Post $news)
    {
        abort_unless($news, 404);
        $news->delete();

        return redirect()->route('admin.news.index')->with('success', __('Successfully Deleted'));
    }

    public function changeStatus(Post $news)
    {
        $news->is_active = !$news->is_active;
        $news->save();

        if ($news) {
            return back()->with('success', __('Successfully updated'));
        } else {
            return back()->with('error', 'Unable to create now');
        }
    }

    public function changeFeatured(Post $news)
    {
        $news->is_featured = !$news->is_featured;
        $news->save();

        if ($news) {
            return back()->with('success', __('Successfully updated'));
        } else {
            return back()->with('error', 'Unable to create now');
        }
    }
}
