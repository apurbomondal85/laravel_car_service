<?php

namespace App\Http\Controllers\Admin;

use App\Library\Enum;
use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Library\Services\Admin\GalleryService;
use App\Http\Requests\Admin\Gallery\CreateRequest;
use App\Http\Requests\Admin\Gallery\UpdateRequest;

class GalleryController extends Controller
{
    use ApiResponse;

    private $gallery_service;

    public function __construct(GalleryService $gallery_service)
    {
        $this->gallery_service = $gallery_service;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->gallery_service->dataTable();
        }

        return view('admin.pages.gallery.index');
    }

    public function create()
    {
        return view('admin.pages.gallery.create', [
            'category' => getDropdown(Enum::CONFIG_DROPDOWN_GALLERY_CATEGORY),
        ]);
    }

    public function store(CreateRequest $request)
    {
        $result = $this->gallery_service->store($request->validated());

        if ($result) {
            return redirect()->route('admin.gallery.index')->with('success', $this->gallery_service->message);
        }

        return back()->withInput($request->all())->with('error', $this->gallery_service->message);
    }

    public function show(Gallery $gallery)
    {
        abort_unless($gallery, 404);

        return view('admin.pages.gallery.show', [
            'gallery'       => $gallery,
            'galleryImages' => $gallery->galleryImages,
        ]);
    }

    public function edit(Gallery $gallery)
    {
        abort_unless($gallery, 404);

        return view('admin.pages.gallery.update', [
            'gallery'  => $gallery,
            'category' => getDropdown(Enum::CONFIG_DROPDOWN_GALLERY_CATEGORY),
        ]);
    }

    public function update(UpdateRequest $request, Gallery $gallery): RedirectResponse
    {
        abort_unless($gallery, 404);
        $result = $this->gallery_service->update($gallery, $request->validated());

        if ($result) {
            return redirect()->route('admin.gallery.index', $gallery->id)->with('success', $this->gallery_service->message);
        }

        return back()->withInput($request->all())->with('error', $this->gallery_service->message);
    }

    public function destroy(Gallery $gallery): RedirectResponse
    {
        abort_unless($gallery, 404);
        $result = $this->gallery_service->delete($gallery);

        if ($result) {
            return redirect()->route('admin.gallery.index')->with('success', $this->gallery_service->message);
        }

        return back()->with('error', 'Unable to delete now');
    }

    public function changeStatus(Gallery $gallery)
    {
        abort_unless($gallery, 404);

        $result = $gallery->update(['is_featured' => !$gallery->is_featured]);

        if ($result) {
            return redirect()->route('admin.gallery.show', $gallery->id)->with('success', $this->gallery_service->message);
        }

        return back()->with('error', $this->gallery_service->message);
    }


    public function createGalleryImage(Gallery $gallery)
    {
        return view('admin.pages.gallery.partial.create', [
            'gallery' => $gallery,
        ]);
    }

    public function storeGalleryImage(Gallery $gallery, Request $request)
    {
        $result = $this->gallery_service->storeGalleryImage($gallery, $request->all());

        if ($result) {
            return redirect()->route('admin.gallery.show', $gallery->id)->with('success', $this->gallery_service->message);
        }

        return back()->withInput($request->all())->with('error', $this->gallery_service->message);
    }

    public function destroyGalleryImage(GalleryImage $galleryImage)
    {
        abort_unless($galleryImage, 404);

        deleteFile($galleryImage->image);

        $galleryImage->delete();

        return redirect()->route('admin.gallery.show', $galleryImage->gallery_id)->with('success', __('Successfully Deleted'));
    }
}
