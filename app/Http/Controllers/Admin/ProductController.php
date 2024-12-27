<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\StoreRequest;
use App\Http\Traits\ApiResponse;
use App\Library\Services\Admin\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ApiResponse;

    private $product_service;

    public function __construct(ProductService $product_service)
    {
        $this->product_service = $product_service;
    }

    public function index(Request $request) {

        if ($request->ajax()) {
            return $this->product_service->dataTable();
        }

        return view('admin.pages.product.index');
    }

    public function create()
    {
        return view('admin.pages.product.create');
    }

    public function store(Request $request)
    {
        dd($request);
    }
}
