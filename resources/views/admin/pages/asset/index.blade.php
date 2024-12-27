@extends('admin.layouts.master')

@section('title', 'Asset')

@section('content')

@php
    $user_role = App\Models\User::getAuthUser()->roles()->first();
    $hasPermission = $user_role->hasPermission('role_create');
@endphp

<div class="content-wrapper">

    <div class="content-header d-flex justify-content-between">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Asset' )) }}</h4>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div id="filterArea" class="d-inline-flex justify-content-start">
                <ul class="nav nav-pills nav-pills-success"  role="tablist" >
                    @php $pending_status = \App\Library\Enum::ASSET_GOOD; @endphp
                    @foreach(\App\Library\Enum::getAssetStatus() as $key => $value)
                        <li class="nav-item">
                            <a class="nav-link tab-menu {{ $pending_status == $key ? 'active' : '' }}" href="#" onclick="filterStatus({{ $key }})">{{ $value }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <input type="hidden" id="assetStatus" value="{{ $pending_status }}">

            <table id="assetDataTable" class="table table-bordered no-footer dtr-inline">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Operator</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Stock</th>
                        <th>Date</th>
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

    @vite('resources/admin_assets/js/asset/index.js')

@endpush
