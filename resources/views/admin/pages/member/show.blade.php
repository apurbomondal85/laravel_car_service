@extends('admin.layouts.master')

@section('title', 'Member Details')

@section('content')

@php
    $user_role = App\Models\User::getAuthUser()->roles()->first();
@endphp

<div class="content-wrapper">
    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Employee Details')) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.user.index')) !!}
    </div>

    <div class="row">

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">

                    <div class="border-bottom text-center pb-2">
                        <img src="{{ $user->getAvatar() }}" alt="profile" class="img-lg rounded-circle mb-3">
                        <div class="mb-3">
                            <h3>{{ $user->title }} {{ $user->getFullNameAttribute() }}</h3>
                            <div class="d-flex align-items-center justify-content-center">
                                <h5 class="mb-0 me-2 text-muted">{{ \App\Library\Helper::getCountryName($user->country) }}</h5>
                            </div>

                            <div class="text-center mt-4">
                                <a href="{{ route('admin.user.update_address', $user->id) }}" class="btn btn-outline-success btn-icon-text mb-2 mr-2">
                                    <i class="fa-sharp fa-solid fa-house fa-3xl"></i> Address
                                </a>

                                <a href="{{ route('admin.user.update_social', $user->id) }}" class="btn btn-outline-info btn-icon-text mb-2 mr-2">
                                    <i class="fa-solid fa-link fa-2xl"></i> Social Link
                                </a>
                            </div>
                        </div>
                    </div>

                    <table class="table org-data-table table-bordered show-table">
                        <tbody>
                            <tr>
                                <td>Status</td>
                                <td>
                                    @if($user->status == \App\Library\Enum::USER_STATUS_PENDING)
                                        <span class="badge btn-danger">Pending</span>
                                    @elseif($user->status == \App\Library\Enum::USER_STATUS_ACTIVE)
                                        <span class="badge btn2-secondary">Active</span>
                                    @elseif($user->status == \App\Library\Enum::USER_STATUS_INACTIVE)
                                        <span class="badge btn-secondary">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Role</td>
                                <td>
                                    <span class="badge {{ $user->role() ? 'btn2-secondary' : 'btn-secondary' }}">{{ $user->role() ? $user->role()->name : 'N/A' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Date Of Birth</td>
                                <td> {{ $user->dob ? $user->dob : 'N/A' }} </td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td> {{ $user->mobile ?? 'N/A' }} </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td> {{ $user->email }} </td>
                            </tr>

                            <tr>
                                <td style="width:30%;">Address</td>
                                <td> {{ $user->getFullAddressAttribute() }} </td>
                            </tr>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="card shadow-sm">
                <div class="card-header bg-light-secondary">
                    <span><i class="fas fa-cog"></i> {{ __('Actions') }} </span>
                </div>

                <div class="card-body py-4">
                    <div class="text-left">

                        <button class="btn btn-block btn-sm mb-3 btn-secondary" onclick="clickChangeStatus()">
                            <i class="fas fa-power-off"></i> Change Status
                        </button>

                        <button class="btn btn-block btn-sm mb-3 btn2-light-secondary"
                            onclick="updateUserPassword('{{ $user->id }}')" >
                            <i class="fas fa-key"></i> Update Password
                        </button>

                        <a href="{{ route('admin.user.update', $user->id) }}" class="btn btn-block btn-sm btn-warning mb-3">
                            <i class="fas fa-edit"></i> Edit
                        </a>

                        <button class="btn btn-sm btn-block btn-danger mb-3"
                            onclick="confirmFormModal('{{ route('admin.user.delete.api', $user->id) }}', 'Confirmation', 'Are you sure to delete This Member? if member is Connected with BANZI Committe or other organization, Then he/she will be remove from here')">
                            <i class="fas fa-trash-alt"></i> Delete
                        </button>

                        <button class="btn btn-sm btn-block @if($user->login_access) btn-success @else btn-secondary @endif"
                            onclick="confirmFormModal('{{ route('admin.user.change_login_status', $user->id) }}', 'Confirmation', 'Are you sure Update Login Access')">
                            <i class="fa-solid fa-right-to-bracket"></i> Login Access
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.components.update_password')
@include('admin.pages.member.change_status')

@stop

@push('scripts')
<script>
    function clickChangeStatus() {
        $(changeStatusModal).modal('show');
    }
</script>
@endpush
