@extends('admin.layouts.master')

@section('title', 'Job Details')

@section('content')

@php
    $user_role = App\Models\User::getAuthUser()->roles()->first();
@endphp

<div class="content-wrapper">
    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Job Details')) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.career.index')) !!}
    </div>

    <div class="row">

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">

                    <div class="border-bottom text-center pb-2">

                        <div class="mb-3">
                            <h3>{{ $career->title }} </h3>
                        </div>
                        <p class="mx-auto mb-2 w-75">{{ $career->company_name }}</p>
                    </div>
                    <table class="table org-data-table table-bordered show-table">
                        <tbody>
                            <tr>
                                <td>Status</td>
                                <td>
                                    <span class="badge {{ ($career->is_active) ? "btn2-secondary" : "btn-secondary" }}">
                                        {{ ($career->is_active) ? "Active" : "Inactive" }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Job Type</td>
                                <td> {{ ucwords($career->job_type) }} </td>
                            </tr>
                            <tr>
                                <td style="width: 40%;">Application Deadline</td>
                                <td> {{ ucwords($career->deadline) }} </td>
                            </tr>
                            @if($career->location)
                            <tr>
                                <td>Location</td>
                                <td> {{ $career->location }} </td>
                            </tr>
                            @endif
                            <tr>
                                <td>Operator</td>
                                <td> {{ $career->user?->full_name }} </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="text-center my-4">
                        <button class="btn btn-sm mr-1 {{ $career->is_active ? 'btn-secondary' : 'btn2-secondary' }}"
                            onclick="confirmFormModal('{{ route('admin.career.change_status.api', $career->id) }}', 'Confirmation', 'Are you sure to change status?')">
                            <i class="fas fa-power-off"></i> {{ $career->is_active ? 'Make Inactive' : 'Make Active' }}
                        </button>
                        <a href="{{ route('admin.career.update', $career->id) }}" class="btn btn-sm btn-warning mr-1">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body py-4">
                    <div class="text-left">

                        {{ $career->short_description }}

                    </div>
                    <hr>
                    <div class="text-left">

                        {!! $career->description !!}

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
