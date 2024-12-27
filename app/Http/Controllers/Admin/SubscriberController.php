<?php

namespace App\Http\Controllers\Admin;

use App\Library\Helper;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Library\Services\Admin\SubscriberService;
use App\Http\Requests\Admin\Subscriber\CreateRequest;
use App\Http\Requests\Admin\Subscriber\UpdateRequest;

class SubscriberController extends Controller
{
    use ApiResponse;

    private $subscriberService;

    public function __construct(SubscriberService $subscriberService)
    {
        $this->subscriberService = $subscriberService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->subscriberService->dataTable();
        }

        return view('admin.pages.subscriber.index');
    }

    public function create()
    {
        return view('admin.pages.subscriber.create', [
            'countries' => Helper::getCountries()
        ]);
    }

    public function store(CreateRequest $request)
    {
        $result = $this->subscriberService->store($request->validated());

        if ($result) {
            return redirect()->route('admin.subscribers.index')->with('success', $this->subscriberService->message);
        }

        return back()->withInput($request->all())->with('error', $this->subscriberService->message);
    }


    public function show(Subscriber $subscriber)
    {
        abort_unless($subscriber, 404);

        return view('admin.pages.subscriber.show', [
            'subscriber' => $subscriber,
        ]);
    }

    public function edit(Subscriber $subscriber)
    {
        abort_unless($subscriber, 404);

        return view('admin.pages.subscriber.update', [
            'subscriber' => $subscriber,
            'countries'  => Helper::getCountries()
        ]);
    }

    public function update(UpdateRequest $request, Subscriber $subscriber): RedirectResponse
    {
        abort_unless($subscriber, 404);
        $result = $this->subscriberService->update($subscriber, $request->validated());

        if($result) {
            return redirect()->route('admin.subscribers.index')->with('success', $this->subscriberService->message);
        } else {
            return back()->withInput(request()->all())->with('error', $this->subscriberService->message);
        }
    }

    public function destroy(Subscriber $subscriber)
    {
        abort_unless($subscriber, 404);
        $subscriber->delete();

        return redirect()->route('admin.subscribers.index')->with('success', __('Successfully Deleted'));
    }
}
