@extends('admin.layouts.master')

@section('title', 'Gallery')

@section('content')
    <div class="content-wrapper">

        <div class="content-header d-flex justify-content-between">
            <div class="d-block">
                <h4 class="content-title">{{ strtoupper(__('Gallery')) }}</h4>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <table id="galleryDataTable" class="table table-bordered no-footer dtr-inline">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Is Featured</th>
                            <th>Operator</th>
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
    @vite('resources/admin_assets/js/gallery/index.js')
@endpush
