@extends('admin.layouts.master')

@section('title', 'Testimonnial Details')

@section('content')

@php
    $user_role = App\Models\User::getAuthUser()->roles()->first();
@endphp

<div class="content-wrapper">
    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Testimonnial Details')) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.testimonial.index')) !!}
    </div>

    <div class="row">

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">

                    <div class="border-bottom text-center">
                        <img src="{{ $testimonial->getAvatar() }}" alt="profile" class="img-lg rounded-circle mb-3">
                        <div class="mb-3">
                            <h3>{{ $testimonial->name }} </h3>
                        </div>
                    </div>
                    <table class="table org-data-table table-bordered show-table">
                        <tbody>
                            <tr>
                                <td>Status</td>
                                <td>
                                    <span class="badge {{ ($testimonial->is_active == \App\Library\Enum::STATUS_ACTIVE) ? "btn2-secondary" : "btn-secondary" }}">
                                        {{ ($testimonial->is_active == \App\Library\Enum::STATUS_ACTIVE) ? "Active" : "Inactive" }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Is Featured</td>
                                <td>
                                    <span class="badge {{ $testimonial->is_featured ? "btn2-secondary" : "btn-secondary" }}">
                                        {{ $testimonial->is_featured ? "Yes" : "No" }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Designation</td>
                                <td> {{ $testimonial->designation ?? 'N/A' }} </td>
                            </tr>
                            <tr>
                                <td>Company</td>
                                <td> {{ $testimonial->company ?? 'N/A' }} </td>
                            </tr>
                            <tr>
                                <td>Operator</td>
                                <td> {{ $testimonial->operator?->full_name }} </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="text-center my-4">

                        @if($user_role->hasPermission('testimonial_update_status'))
                            <button class="btn btn-sm mr-1 {{ $testimonial->is_active ? 'btn-secondary' : 'btn2-secondary' }}"
                                onclick="confirmFormModal('{{ route('admin.testimonial.change_status.api', [$testimonial->id, 'is_active']) }}', 'Confirmation', 'Are you sure to change status?')">
                                <i class="fas fa-power-off"></i> {{ $testimonial->is_active ? 'Make Inactive' : 'Make Active' }}
                            </button>
                        @endif

                        @if($user_role->hasPermission('testimonial_update_status'))
                            <button class="btn btn-sm mr-1 {{ $testimonial->is_featured ? 'btn-secondary' : 'btn2-secondary' }}"
                                onclick="confirmFormModal('{{ route('admin.testimonial.change_status.api', [$testimonial->id, 'is_featured']) }}', 'Confirmation', 'Are you sure to change status?')">
                                <i class="fas fa-power-off"></i> {{ $testimonial->is_featured ? 'Not Featured' : 'Make Featured' }}
                            </button>
                        @endif

                        @if($user_role->hasPermission('testimonial_update'))
                            <a href="{{ route('admin.testimonial.update', $testimonial->id) }}" class="btn btn-sm btn-warning mr-1">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        @endif

                        @if($user_role->hasPermission('testimonial_delete'))
                            <button class="btn btn-sm btn-danger"
                                onclick="confirmFormModal('{{ route('admin.testimonial.delete.api', $testimonial->id) }}', 'Confirmation', 'Are you sure to delete operation?')"><i
                                class="fas fa-trash-alt"></i> Delete
                            </button>
                        @endif

                    </div>
                </div>
            </div>
        </div>

        @if($testimonial->message)
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body py-4">
                        <div class="text-left">

                            {{ $testimonial->message }}

                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>

@stop
