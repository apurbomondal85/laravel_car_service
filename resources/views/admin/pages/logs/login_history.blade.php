@extends('admin.layouts.master')

@section('title', 'Login History')

@section('content')

<div class="content-wrapper">

    <div class="content-header d-flex justify-content-between">
        <div class="d-block">
            <h4 class="content-title">{{ __('LOGIN HISTORY') }}</h4>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            <table class="table table-bordered no-footer dtr-inline" id="loginHistoryDataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Email</th>
                        <th>IP</th>
                        <th>Country</th>
                        <th>City</th>
                        <th>Status</th>
                        <th>Created At</th>
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


@vite('resources/admin_assets/js/logs/login_history.js')



@endpush
