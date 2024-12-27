@extends('admin.layouts.master')

@section('title', 'Email Templates')

@section('content')

<div class="content-wrapper">

    <div class="content-header d-flex justify-content-between">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Email Templates')) }}</h4>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            <table class="table table-bordered no-footer dtr-inline" id="emailTemplateDataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Key</th>
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

    @vite('resources/admin_assets/js/config/email_template/index.js')

@endpush
