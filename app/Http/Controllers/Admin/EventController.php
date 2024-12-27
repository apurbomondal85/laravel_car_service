<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Event\CreateRequest;
use App\Http\Requests\Admin\Event\UpdateRequest;
use App\Library\Enum;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use App\Models\Event;
use App\Models\Config;

class EventController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Event::filterTable($request->only(['status']));

            return DataTables::of($data)
                    ->addIndexColumn()

                    ->addColumn('title', function ($row) {
                        return '<a href="' . route('admin.event.show', $row->id) . '">' . $row->title . '</a>';
                    })

                    ->addColumn('event_type', function ($row) {
                        return ucwords($row->event_type);
                    })

                    ->addColumn('start', function ($row) {
                        $start = strtotime($row->start);

                        return date('d-m-Y', $start);
                    })

                    ->addColumn('end', function ($row) {
                        $end = strtotime($row->end);

                        return date('d-m-Y', $end);
                    })

                    ->addColumn('action', function ($row) {
                        return $this->getActionHtml($row);
                    })
                    ->rawColumns(['title', 'event_type', 'action'])
                    ->make(true);
        }

        return view('admin.pages.website.event.index');
    }
    private function getActionHtml($row)
    {
        $actionHtml = '';

        if($row->id) {
            $actionHtml = '<a class="dropdown-item text-primary" href="' . route('admin.event.show', $row->id) . '" ><i class="fas fa-eye"></i> View</a>
            <a class="dropdown-item" href="' . route('admin.event.update', $row->id) . '" ><i class="far fa-edit"></i> Edit</a>';
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
        return view('admin.pages.website.event.create', [
            'event_type' => Config::getDropdowns(Enum::CONFIG_DROPDOWN_EVENT_TYPE)
        ]);
    }

    public function create(CreateRequest $request)
    {
        $result = Event::insert($request->validated());

        if($result) {
            return redirect()->route('admin.event.index')->with('success', __('Successfully created'));
        } else {
            return back()->withInput(request()->all())->with('error', 'Unable to create now');
        }
    }

    public function show(Event $event)
    {
        return view('admin.pages.website.event.show', [
            'event' => $event,
        ]);
    }

    public function showUpdateForm(Event $event)
    {
        return view('admin.pages.website.event.update', [
            'event'      => $event,
            'event_type' => Config::getDropdowns(Enum::CONFIG_DROPDOWN_EVENT_TYPE)
        ]);
    }

    public function update(Event $event, UpdateRequest $request)
    {
        abort_unless($event, 404);
        $result = Event::edit($event, $request->validated());

        if($result) {
            return redirect()->route('admin.event.index')->with('success', __('Successfully updated'));
        } else {
            return back()->withInput(request()->all())->with('error', 'Unable to update now');
        }
    }

    public function changeStatusApi(Event $event)
    {
        $event->is_active = !$event->is_active;
        $event->save();

        if($event) {
            return back()->with('success', __('Successfully updated'));
        } else {
            return back()->with('error', 'Unable to update now');
        }
    }

    public function deleteApi(Event $event)
    {
        $event->delete();

        if($event) {
            return redirect()->route('admin.event.index')->with('success', __('Successfully Deleted'));
        } else {
            return back()->with('error', 'Unable to delete now');
        }
    }
}
