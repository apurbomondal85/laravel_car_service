@extends('admin.layouts.master')

@section('title', __('Update Committee Member'))

@section('content')
<div class="content-wrapper">

    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Update Committee Member')) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.committee.show', $committee->id)) !!}
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="p-sm-3">
                    <form action="{{ route('admin.committee.member.update', [$committee->id, $member->id]) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body py-sm-4">

                            <div class="form-group row @error('user_id') error @enderror">
                                <label class="col-sm-3 col-form-label required" for="name">{{ __('Member') }}</label>
                                <div class="col-sm-9">
                                    <select class="select form-control" name="user_id" id="user_id"
                                        style="width: 100%;">
                                        <option selected disabled value="">Select One</option>
                                        @foreach($genaral_members as $genaral_member)
                                        <option value="{{ $genaral_member->id }}"
                                            {{ old('user_id', $member->user_id) == $genaral_member->id ? 'selected' : '' }}>
                                            {{$genaral_member->f_name}} </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row @error('designation') error @enderror">
                                <label class="col-sm-3 col-form-label required"
                                    for="name">{{ __('Designation') }}</label>
                                <div class="col-sm-9">
                                    <select class="select form-control" name="designation" id="designation"
                                        style="width: 100%;">
                                        <option selected disabled value="">Select One</option>
                                        @foreach($committee_designations as $key => $committee_designation)
                                        <option value="{{ $key }}"
                                            {{ old('designation', $member->designation) == $key ? 'selected' : '' }}>
                                            {{$committee_designation}} </option>
                                        @endforeach
                                    </select>
                                    @error('designation')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row @error('role_id') error @enderror">
                                <label class="col-sm-3 col-form-label"
                                    for="name">{{ __('Role') }}</label>
                                <div class="col-sm-9">
                                    <select class="select form-control" name="role_id" id="role_id"
                                        style="width: 100%;">
                                        <option selected value="">Select One</option>
                                        @foreach($roles as $key => $role)
                                        <option value="{{ $role->id }}"
                                            {{ old('role', $member->role_id) == $role->id ? 'selected' : '' }}>
                                            {{ $role->name }} </option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row @error('vote') error @enderror">
                                <label class="col-sm-3 col-form-label">{{ __('Total Vote') }}</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="vote" value="{{ old('vote', $member->vote) }}"
                                        placeholder="{{ __('Total Vote Get') }}">
                                    @error('vote')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row @error('image') error @enderror">
                                <label class="col-sm-3 col-form-label"> Picture </label>
                                <div class="col-sm-9">
                                    <div class="file-upload-section">
                                        <input name="image" type="file" class="form-control d-none"
                                            allowed="png,gif,jpeg,jpg">
                                        <div class="input-group col-xs-12">
                                            <input type="text" class="form-control file-upload-info" disabled=""
                                                readonly placeholder="Size: 380x380 and max 500kB">
                                            <span class="input-group-append">
                                                <button class="file-upload-browse btn btn-outline-secondary"
                                                    type="button"><i class="fas fa-upload"></i> Browse</button>
                                            </span>
                                        </div>
                                        @error('image')
                                        <p class="error-message">{{ $message }}</p>
                                        @enderror
                                        <div class="display-input-image @if(!$member->image) d-none @endif">
                                            <img src="{{ asset($member->image) }}"
                                                alt="Preview Image" />
                                            <button type="button"
                                                class="btn btn-sm btn-outline-danger file-upload-remove"
                                                title="Remove">x</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="modal-footer justify-content-center col-md-12">
                                {!! \App\Library\Html::btnReset() !!}
                                {!! \App\Library\Html::btnSubmit() !!}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
@include('admin.assets.dt')
@push('scripts')
@endpush
