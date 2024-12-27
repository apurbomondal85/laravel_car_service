@extends('admin.layouts.master')

@section('title', 'Teams')

@section('content')

@php
$user_role = App\Models\User::getAuthUser()->roles()->first();
@endphp

<div class="content-wrapper">

    <div class="content-header d-flex justify-content-between">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Teams' )) }}</h4>
        </div>
    </div>


    <div class="row">
        <div class="col-xxl-8 col-xl-8 col-lg-12 col-md-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table display nowrap table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
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

        @if($user_role->hasPermission('team_create') && $team == false)
        <div class="col-xxl-4 col-xl-4 col-lg-12 col-md-12">
            @include('admin.pages.website.team.create')
        </div>
        @endif
    </div>
</div>

@stop

@include('admin.assets.dt')
@include('admin.assets.dt-buttons')

@push('scripts')
@vite('resources/admin_assets/js/team/index.js')
@endpush
