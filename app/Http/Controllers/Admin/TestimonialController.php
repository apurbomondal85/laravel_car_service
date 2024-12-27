<?php

namespace App\Http\Controllers\Admin;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Library\Services\Admin\TestimonialService;
use App\Http\Requests\Admin\Testimonial\CreateRequest;
use App\Http\Requests\Admin\Testimonial\UpdateRequest;

class TestimonialController extends Controller
{
    use ApiResponse;

    private $testimonial_service;

    public function __construct(TestimonialService $testimonial_service)
    {
        $this->testimonial_service = $testimonial_service;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $filter_request = $request->only(['status']);

            return $this->testimonial_service->dataTable($filter_request);
        }

        return view('admin.pages.website.testimonial.index');
    }

    public function create()
    {
        return view('admin.pages.website.testimonial.create');
    }

    public function store(CreateRequest $request)
    {
        $result = $this->testimonial_service->store($request->validated());

        if ($result) {
            return redirect()->route('admin.testimonial.index')->with('success', $this->testimonial_service->message);
        }

        return back()->withInput($request->all())->with('error', $this->testimonial_service->message);
    }

    public function show(Testimonial $testimonial)
    {
        abort_unless($testimonial, 404);

        return view('admin.pages.website.testimonial.show', [
            'testimonial' => $testimonial,
        ]);
    }

    public function edit(Testimonial $testimonial)
    {
        abort_unless($testimonial, 404);

        return view('admin.pages.website.testimonial.update', [
            'testimonial' => $testimonial,
        ]);
    }

    public function update(UpdateRequest $request, Testimonial $testimonial): RedirectResponse
    {
        abort_unless($testimonial, 404);
        $result = $this->testimonial_service->update($testimonial, $request->validated());

        if ($result) {
            return redirect()->route('admin.testimonial.index', $testimonial->id)->with('success', $this->testimonial_service->message);
        }

        return back()->withInput($request->all())->with('error', $this->testimonial_service->message);
    }

    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        abort_unless($testimonial, 404);
        $result = $this->testimonial_service->delete($testimonial);

        if($result) {
            return redirect()->route('admin.testimonial.index')->with('success', $this->testimonial_service->message);
        }

        return back()->with('error', 'Unable to delete now');
    }

    public function changeStatusApi(Testimonial $testimonial, $type)
    {
        abort_unless($testimonial, 404);
        $result = $this->testimonial_service->changeStatus($testimonial, $type);

        if ($result) {
            return redirect()->route('admin.testimonial.show', $testimonial->id)->with('success', $this->testimonial_service->message);
        }

        return back()->with('error', $this->testimonial_service->message);
    }
}
