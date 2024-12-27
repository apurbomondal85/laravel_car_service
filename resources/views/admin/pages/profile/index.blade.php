@extends('admin.layouts.master')

@section('title', __('Profile'))

@section('content')


<div class="content-wrapper">
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="border-bottom text-center pb-4">
                        <img src="{{$user->getAvatar()}}"
                            alt="profile" class="img-lg rounded-circle mb-3">
                        <div class="mb-3">
                            <h3>{{ $user->getFullNameAttribute() }}</h3>
                            <div class="d-flex align-items-center justify-content-center">
                                <h5 class="mb-0 me-2 text-muted">{{ $user->country }}</h5>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                       
                            <a href="{{ route('admin.profile.update_address') }}" class="btn btn-outline-success btn-icon-text mb-2 mr-2">
                            <i class="fa-sharp fa-solid fa-house fa-3xl"></i> Address
                            </a>

                            <a href="{{ route('admin.profile.update_social') }}" class="btn btn-outline-info btn-icon-text mb-2 mr-2">
                            <i class="fa-solid fa-link fa-2xl"></i> Social Link
                            </a>

                    </div>
                    </div>


                    <table class="table org-data-table table-bordered">
                        <tbody>
                            <tr>
                                <td>Status</td>
                                <td>
                                    @if($user->status == 0)
                                        <span class="badge btn-warning">Pending</span>
                                    @elseif($user->status == 1)
                                        <span class="badge btn-success">Active</span>
                                    @elseif($user->status == 2)
                                        <span class="badge btn-danger">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td> {{ $user ? $user->mobile : 'N/A' }} </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td> {{ $user->email }} </td>
                            </tr>
                            <tr>
                                <td>Date Of Birth</td>
                                <td> {{ $user ? $user->dob : 'N/A' }} </td>
                            </tr>

                            <tr>
                                <td style="width:30%;">Address</td>
                                <td> {{ $user->userProfile ? $user->getFullAddressAttribute() : 'N/A' }}  </td>
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

                            <button class="btn btn-block btn-sm mb-3 btn2-light-secondary" onclick="updateUserPassword('{{ $user->id }}')" >
                                <i class="fas fa-key"></i> Update Password
                            </button>

                            <a href="{{ route('admin.profile.update') }}" class="btn btn-block btn-sm btn-warning mb-3">
                                <i class="fas fa-edit"></i> Edit Profile
                            </a>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@include('admin.components.update_password')

@stop

@include('admin.assets.dt')

@push('scripts')

<script type="text/javascript">

</script>
@endpush
