@extends('admin.layouts.master')

@section('title', 'Email')

@section('content')


<div class="content-wrapper">

    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Email Recipients' )) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.email.index')) !!}
    </div>
    <input type="hidden" id="emailId" value="{{$email->id}}">
    <div class="card shadow-sm">
        <div class="card-body">
            <table id="dataTable" class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Mobile</th>
                        <th class="text-center">Sending Status</th>
                        <th class="text-center" width="100px">Action</th>
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
@vite('resources/admin_assets/js/bulk_email/show.js')
@endpush
