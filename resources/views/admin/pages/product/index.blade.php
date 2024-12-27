@extends('admin.layouts.master')

@section('title', 'Product')

@section('content')
    <div class="content-wrapper">

        <div class="content-header d-flex justify-content-between">
            <div class="d-block">
                <h4 class="content-title">{{ strtoupper(__('Products')) }}</h4>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <table id="dataTable" class="table table-bordered no-footer dtr-inline">
                    <thead>
                        <tr>
                            <th>#Id</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@include('admin.assets.dt')
@include('admin.assets.dt-buttons')
@include('admin.assets.dt-buttons-export')

@push('scripts')
    @vite('resources/admin_assets/js/product/index.js')
@endpush
