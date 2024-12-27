@extends('admin.layouts.master')

@section('title', 'Manage Roles')

@section('content')

@php
    $user_role = App\Models\User::getAuthUser()->roles()->first();
    $hasPermission = $user_role->hasPermission('role_create');
@endphp

<div class="content-wrapper">

    <div class="content-header d-flex justify-content-between">
        <div class="d-block">
            <h4 class="content-title">MANAGE ROLES</h4>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-bordered no-footer dtr-inline" id="roleDataTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('admin.pages.config.role.partial.modal_create')
@include('admin.pages.config.role.partial.modal_update')

@stop

@include('admin.assets.dt')
@include('admin.assets.dt-buttons')

@push('scripts')

    @vite('resources/admin_assets/js/config/role/index.js')

@endpush
