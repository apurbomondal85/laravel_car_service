@extends('admin.layouts.master')

@section('title', __('Update profile'))

@section('content')

<div class="content-wrapper">

    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ __('Update Profile') }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.profile.index')) !!}
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="post" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
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
                                                <input type="text" class="form-control"
                                                    value="{{ old('user.f_name', $user->f_name) }}" name="user[f_name]"
                                                    placeholder="{{ __('First Name') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group @error('user.m_name') error @enderror">
                                                <input type="text" class="form-control" name="user[m_name]"
                                                    value="{{ old('user.m_name', $user->m_name) }}"
                                                    placeholder="{{ __('Middle Name (optioanl)') }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group @error('user.l_name') error @enderror">
                                                <input type="text" class="form-control" name="user[l_name]"
                                                    value="{{ old('user.l_name', $user->l_name) }}"
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
                                <label class="col-sm-3 col-form-label required">{{ __('Title') }}</label>
                                <div class="col-sm-9">
                                    <select class="select form-control" name="title" required>
                                        <option value="" selected disabled>Select One</option>
                                        @foreach ($titles as $title)
                                        <option value="{{ $title }}"
                                            {{ old('title', $title) == $user->userProfile->title ? 'selected' : '' }}>
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
                                        value="{{ old('user.email', $user->email) }}"
                                        placeholder="{{ __('Email Address') }}" required>
                                    @error('user.email')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row @error('user.mobile') error @enderror">
                                <label class="col-sm-3 col-form-label required">{{ __('Mobile No') }}</label>
                                <div class="col-sm-9">
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <select name="country_code" class="input-group-text text-primary" required>
                                                @foreach($countries as $key => $country)
                                                <option value="{{ $country['code'] }}"
                                                    {{( $user && $user->country == $key ) ? "selected" : ""}}>{{$key}}
                                                    {{ $country['code']}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="number" name="user[mobile]"
                                            value="{{ old('user.mobile', ((strpos($user->mobile, '-') == true) ? (explode('-', $user->mobile))[1] : $user->mobile) ) }}"
                                            class="form-control" placeholder="{{ __('013 355 666') }}" required>
                                    </div>
                                    @error('user.mobile')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="p-sm-3 col-sm-12">

                                <div class="form-group row @error('user.dob') error @enderror">
                                    <label class="col-sm-3 col-form-label" for="name">{{ __('Date Of Birth') }}</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="user[dob]" class="form-control"
                                            value="{{old('user.dob',($user ? $user->dob : ''))}}">
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
                                                {{ old('gender', $gender) == $user->userProfile->gender ? 'selected' : '' }}>
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
                                                {{ old('pro_noun', $pronoun) == $user->userProfile->pro_noun ? 'selected' : '' }}>
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
                                                allowed="png,gif,jpeg,jpg">
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
                                            <div class="display-input-image"
                                                style="display: {{ ($user ? (($user->avatar) ? '' : 'd-none') : 'd-none') }}">
                                                <img src="{{ ($user) ? $user->getAvatar() : '' }}"
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