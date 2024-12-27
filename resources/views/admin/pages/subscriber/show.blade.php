@extends('admin.layouts.master')

@section('title', 'Subscriber Details')

@section('content')

@php
    $user_role = App\Models\User::getAuthUser()->roles()->first();
@endphp

<div class="content-wrapper">
    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Subscriber Details')) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.subscribers.index')) !!}
    </div>

    <div class="row justify-content-start">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table org-data-table table-bordered show-table">
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td> {{ $subscriber->name }} </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td> {{ $subscriber->email }} </td>
                            </tr>
                            <tr>
                                <td>Mobile</td>
                                <td> {{ $subscriber->mobile ?? 'N/A' }} </td>
                            </tr>
                            <tr>
                                <td>Operator</td>
                                <td> {{ $subscriber->operator?->full_name }} </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-center my-4">
                        @if($user_role->hasPermission('subscribers_update'))
                            <a href="{{ route('admin.subscribers.update', $subscriber->id) }}" class="btn btn-sm btn-warning mr-1">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
