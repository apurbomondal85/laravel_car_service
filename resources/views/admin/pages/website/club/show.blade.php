@extends('admin.layouts.master') 

@section('title', 'Club Details')

@section('content') 

@php
    $user_role = App\Models\User::getAuthUser()->roles()->first();
@endphp

<div class="content-wrapper">
    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Club Details')) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.club.index')) !!}
    </div>

    <div class="row">

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">

                    <div class="border-bottom text-center pb-2">
                        <img src="{{ $club->getFeaturedImage() }}" alt="profile" class="img-lg rounded-circle mb-3">
                        <div class="mb-3">
                            <h3>{{ $club->name }} </h3>
                        </div>
                        <p class="mx-auto mb-2 w-75">{{ $club->description }}</p>
                    </div>
                    <table class="table org-data-table table-bordered show-table">
                        <tbody>
                            <tr>
                                <td>Status</td>
                                <td>
                                    <span class="badge {{ $club->is_active ? "btn2-secondary" : "btn-secondary" }}">
                                        {{ $club->is_active ? "Active" : "Inactive" }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Slogan</td>
                                <td> {{ $club->slogan }} </td>
                            </tr>
                            <tr>
                                <td>Operator</td>
                                <td> {{ $club->user?->nick_name }} </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="text-center my-4">
                        <button class="btn btn-sm mr-1 {{ $club->is_active ? 'btn-secondary' : 'btn2-secondary' }}"
                            onclick="confirmFormModal('{{ route('admin.club.change_status.api', $club->id) }}', 'Confirmation', 'Are you sure to change status?')">    
                            <i class="fas fa-power-off"></i> {{ $club->is_active ? 'Make Inactive' : 'Make Active' }} 
                        </button> 
                        <a href="{{ route('admin.club.update', $club->id) }}" class="btn btn-sm btn-warning mr-1">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <button class="btn btn-sm btn-danger mr-1"
                            onclick="confirmFormModal('{{ route('admin.club.delete.api', $club->id) }}', 'Confirmation', 'Are you sure to delete operation?')">
                            <i class="fas fa-trash-alt"></i> Delete 
                        </button>
                        <a href="{{ route('admin.club.member.create', $club->id) }}"  class="btn btn-sm btn2-secondary">
                            <i class="fa fa-plus"></i> Add Member
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body py-4">
                    <h5> {{ __('Committee/Members') }} </h5>
                    <div class="table-responsive pt-3">
                        <table class="table table-bordered" id="organizationOperatorTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Note</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $index = 0; @endphp
                                @forelse($members as $row)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $row->user?->getFullNameAttribute() }}</td>
                                        <td>{{ isset($member->designation) ? \App\Library\Helper::getClubDesignationByKey($member->designation) : 'Member' }}</td>
                                        <td>{{ ucwords($row->user_type) }}</td>
                                        <td>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox"
                                                    onclick="changeStatus(event, '{{ route('admin.club.member.update_status.api', $row->id) }}' )" class="custom-control-input"
                                                    id="statusSwitch_{{ $row->id }}" {{ $row->is_active ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="statusSwitch_{{ $row->id }}"></label>
                                            </div>
                                        </td>
                                        <td>{{ $row->note }}</td>
                                        <td class="text-center">
                                            <div class="action dropdown">
                                                <button class="btn btn2-secondary btn-sm dropdown-toggle" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-tools"></i> Action
                                                </button>

                                                <div class="dropdown-menu">

                                                    <a class="dropdown-item text-primary" href="{{ route('admin.club.member.update', [$row->club_id, $row->id]) }}" >
                                                        <i class="far fa-edit"></i> Edit
                                                    </a>
                                                    <a class="dropdown-item text-danger" href="javascript:void(0)"
                                                        onclick="confirmFormModal('{{ route('admin.club.member.delete.api', $row->id) }}', 'Are you sure to delete operation?')"> 
                                                        <i class="fas fa-trash"></i>  Delete
                                                    </a>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">No operators are found.</td>
                                    </tr>
                                @endforelse  
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@stop


@push('scripts')
<script>
    function changeStatus(e, route)
    {
        e.preventDefault();
        confirmFormModal(route, 'Confirmation', 'Are you sure to change status?');
    }
</script>
@endpush
