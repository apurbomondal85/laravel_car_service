@extends('admin.layouts.master')

@section('title', __('New Member'))

@section('content')
<div class="content-wrapper">

    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('New Member')) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.user.index')) !!}
    </div>

    <div class="card shadow-sm">
        <div class="card-body py-sm-4">
            <form method="post" action="{{ route('admin.user.create') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="p-sm-3">

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label required">{{ __('Name') }}</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group @error('user.f_name') error @enderror">
                                                <input type="text" class="form-control" value="{{ old('user.f_name') }}"
                                                    name="user[f_name]" placeholder="{{ __('First Name') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group @error('user.m_name') error @enderror">
                                                <input type="text" class="form-control" name="user[m_name]"
                                                    value="{{ old('user.m_name') }}"
                                                    placeholder="{{ __('Middle Name (optioanl)') }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group @error('user.l_name') error @enderror">
                                                <input type="text" class="form-control" name="user[l_name]"
                                                    value="{{ old('user.l_name') }}"
                                                    placeholder="{{ __('Last Name') }}">
                                            </div>
                                        </div>

                                    </div>
                                    @error('user.f_name')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror
                                    @error('user.m_name')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror
                                    @error('user.l_name')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror

                                </div>
                            </div>

                            <div class="form-group row @error('title') error @enderror">
                                <label class="col-sm-3 col-form-label">{{ __('Title') }}</label>
                                <div class="col-sm-9">
                                    <select class="select form-control" name="title">
                                        <option value="" selected disabled>Select One</option>
                                        @foreach ($titles as $title)
                                        <option value="{{ $title }}" {{ old('title') == $title ? 'selected' : '' }}>
                                            {{ $title }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('title')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row @error('user.email') error @enderror">
                                <label class="col-sm-3 col-form-label required">{{ __('Email Address') }}</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" name="user[email]"
                                        value="{{ old('user.email') }}" placeholder="{{ __('Email Address') }}"
                                        required>
                                    @error('user.email')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label required">{{ __('Password') }}</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group @error('user.password') error @enderror">
                                                <input type="password" class="form-control" id="pass"
                                                    name="user[password]" placeholder="{{ __('Password') }}" required>

                                                <span class="error-message text-danger" id="error-pass"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div
                                                class="form-group @error('user.password_confirmation') error @enderror">
                                                <input type="password" class="form-control"
                                                    name="user[password_confirmation]" id="cpass"
                                                    placeholder="{{ __('Confirm Password') }}" required>

                                                <span class="error-message text-danger" id="error-cpass"></span>
                                            </div>
                                        </div>
                                    </div>
                                    @error('user.password')
                                    <p class="error-message text-danger">{{ $message }}</p>
                                    @enderror
                                    @error('user.password_confirmation')
                                    <p class="error-message text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row @error('role_id') error @enderror" id="role">
                                <label class="col-sm-3 col-form-label required">{{ __('Role') }}</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2" name="role_id" id="role_id">
                                        <option value="" selected disabled>Select One</option>
                                        @foreach($roles as $value)
                                        <option value="{{ $value->id }}" {{ old('role_id') ? 'selected':'' }} data-params="{{ $value->id }}" >
                                            {{ ucwords($value->name) }}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="p-sm-3 col-sm-12">

                                <div class="form-group row @error('user.mobile') error @enderror">
                                    <label class="col-sm-3 col-form-label">{{ __('Mobile No') }}</label>
                                    <div class="col-sm-9">
                                        <div class="input-group mb-4">
                                            <div class="input-group-prepend">
                                                <select name="country_code" class="input-group-text text-primary">
                                                    @foreach($countries as $key => $country)
                                                    <option value="{{ old('country_code', $country['code']) }}"
                                                        {{ $key == 'NZ' ? 'selected' : '' }}>
                                                        {{$key}} {{ $country['code']}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input type="number" name="user[mobile]" value="{{ old('user.mobile') }}"
                                                class="form-control" placeholder="{{ __('013 355 666') }}">
                                        </div>
                                        @error('user.mobile')
                                        <p class="error-message">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row @error('user.dob') error @enderror">
                                    <label class="col-sm-3 col-form-label" for="name">{{ __('Date Of Birth') }}</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="user[dob]" class="form-control"
                                            value="{{old('user.dob')}}">
                                        @error('user.dob')
                                        <p class="error-message">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row @error('gender') error @enderror">
                                    <label class="col-sm-3 col-form-label required">{{ __('Gender') }}</label>
                                    <div class="col-sm-9">
                                        <select class="select form-control" name="gender" required>
                                            <option value="" selected disabled>Select One</option>
                                            @foreach ($genders as $gender)
                                            <option value="{{ $gender }}"
                                                {{ old('gender') ==  $gender ? 'selected' : '' }}>
                                                {{ $gender }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('gender')
                                        <p class="error-message">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row @error('pro_noun') error @enderror">
                                    <label class="col-sm-3 col-form-label">{{ __('Pronoun') }}</label>
                                    <div class="col-sm-9">
                                        <select class="select form-control" name="pro_noun">
                                            <option value="" selected disabled>Select One</option>
                                            @foreach ($pronouns as $pronoun)
                                            <option value="{{ $pronoun }}"
                                                {{ old('pro_noun') == $pronoun ? 'selected' : '' }}>
                                                {{ $pronoun }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('pro_noun')
                                        <p class="error-message">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row @error('user.avatar') error @enderror">
                                    <label class="col-sm-3 col-form-label">Profile Picture</label>
                                    <div class="col-sm-9">
                                        <div class="file-upload-section">
                                            <input name="user[avatar]" type="file" class="form-control d-none"
                                                allowed="webp,png,gif,jpeg,jpg">
                                            <div class="input-group col-xs-12">
                                                <input type="text" class="form-control file-upload-info" disabled=""
                                                    readonly placeholder="Size: 200x200 and max 500kB">
                                                <span class="input-group-append">
                                                    <button class="file-upload-browse btn btn-outline-secondary"
                                                        type="button"><i class="fas fa-upload"></i> Browse</button>
                                                </span>
                                            </div>
                                            @error('user.avatar')
                                            <p class="error-message">{{ $message }}</p>
                                            @enderror
                                            <div class="display-input-image d-none">
                                                <img src="{{ Vite::asset(\App\Library\Enum::NO_IMAGE_PATH) }}"
                                                    alt="Preview Image" />
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-danger file-upload-remove"
                                                    title="Remove">x</button>
                                            </div>
                                        </div>
                                    </div>
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
@stop
@include('admin.assets.dt')
@push('scripts')
@endpush
