@extends('admin.layouts.master')

@section('title', 'Testimonials')

@section('content')

@php
    $user_role = App\Models\User::getAuthUser()->roles()->first();
    $hasPermission = $user_role->hasPermission('role_create');
@endphp

<div class="content-wrapper">

    <div class="content-header d-flex justify-content-between">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Testimonials' )) }}</h4>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div id="filterArea" class="d-inline-flex justify-content-start">
                <ul class="nav nav-pills nav-pills-success"  role="tablist" >
                    @php $active_status = \App\Library\Enum::TESTIMONIAL_ACTIVE; @endphp
                    @foreach(\App\Library\Enum::getTestimonialStatus() as $key => $value)
                        <li class="nav-item">
                            <a class="nav-link tab-menu {{ $active_status == $key ? 'active' : '' }}" href="#" onclick="filterStatus({{ $key }})">{{ $value }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <input type="hidden" id="testimonialStatus" value="{{ $active_status }}">

            <table class="table table-bordered no-footer dtr-inline" id="testimonialDataTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Avatar</th>
                        <th>Designation</th>
                        <th>Company</th>
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

<div class="showDiv">
    <div class="overlay"></div>
    <div class="img-show">
      <span class="close-btn" onclick="clickClose()">X</span>
      <img src="">
    </div>
</div>


@stop


@include('admin.assets.dt')
@include('admin.assets.dt-buttons')
@include('admin.assets.dt-buttons-export')

@push('scripts')
    @vite('resources/admin_assets/js/website/testimonial/index.js')
@endpush
