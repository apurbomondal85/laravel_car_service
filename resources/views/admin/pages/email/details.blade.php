@extends('admin.layouts.master')

@section('title', 'Bulk Email Details')

@section('content')

@php
    $user_role = App\Models\User::getAuthUser()->roles()->first();
@endphp

<div class="content-wrapper">
    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Bulk Email Details')) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.email.index')) !!}
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body py-4">
                    <div class="text-left">
                        <h3>{{ $email->subject }}</h3>
                    </div>
                    <hr>
                    <div class="text-left">

                        {!! $email->message !!}

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@stop


@push('scripts')
<script>
    function clickChangeStatus() {
        $(changeStatusModal).modal('show');
    }
</script>
@endpush
