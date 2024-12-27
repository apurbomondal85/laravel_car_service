@extends('admin.layouts.master')

@section('title', __('Update Social Link'))

@section('content')

<div class="content-wrapper">

    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ __('Update Social link') }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.user.show', $user->id)) !!}
    </div>

    <div class="card shadow-sm col-md-8">
        <div class="card-body">
            <form method="post" action="{{ route('admin.user.update_social', $user->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="p-sm-3">

                            <div class="form-group row @error('facebook_url') error @enderror">
                                <label class="col-sm-3 col-form-label">{{ __('Facebook') }}</label>
                                <div class="col-sm-9">
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-secondary">
                                                <i class="fa-brands fa-facebook-f"></i>
                                            </span>
                                        </div>
                                        <input type="url" name="facebook_url" class="form-control"
                                            placeholder="{{ __('https://facebook.com/') }}"
                                            value="{{ old('facebook_link', $user->userProfile->facebook_url) }}">
                                    </div>
                                    @error('facebook_url')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row @error('instagram_url') error @enderror">
                                <label class="col-sm-3 col-form-label">{{ __('Instagram') }}</label>
                                <div class="col-sm-9">
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-secondary">
                                                <i class="fa-brands fa-instagram"></i>
                                            </span>
                                        </div>

                                        <input type="url" name="instagram_url" class="form-control"
                                            placeholder="{{ __('https://instagram.com/') }}"
                                            value="{{ old('instagram_url', $user->userProfile->instagram_url) }}">
                                    </div>
                                    @error('instagram_url')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row @error('twitter_url') error @enderror">
                                <label class="col-sm-3 col-form-label">{{ __('Twitter') }}</label>
                                <div class="col-sm-9">
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-secondary">
                                                <i class="fa-brands fa-twitter"></i>
                                            </span>
                                        </div>
                                        <input type="url" name="twitter_url" class="form-control"
                                            placeholder="{{ __('https://twitter.com/') }}"
                                            value="{{ old('twitter_url', $user->userProfile->twitter_url) }}">
                                    </div>
                                    @error('twitter_url')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row @error('linkedin_url') error @enderror">
                                <label class="col-sm-3 col-form-label">{{ __('Linked In') }}</label>
                                <div class="col-sm-9">
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-secondary">
                                                <i class="fa-brands fa-linkedin-in"></i>
                                            </span>
                                        </div>
                                        <input type="url" name="linkedin_url" class="form-control"
                                            placeholder="{{ __('https://linkedin.com/') }}"
                                            value="{{ old('linkedin_link', $user->userProfile->linkedin_url) }}">
                                    </div>
                                    @error('linkedin_url')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror
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