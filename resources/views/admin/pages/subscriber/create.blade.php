@extends('admin.layouts.master')

@section('title', __('New Subscriber'))

@section('content')
<div class="content-wrapper">

    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('New Subscriber')) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.subscribers.index')) !!}
    </div>

    <div class="card shadow-sm col-md-8">
        <div class="card-body py-sm-4">
            <form method="post" action="{{ route('admin.subscribers.create') }}" enctype="multipart/form-data">
                @csrf
                <div class="p-sm-3">
                    <div class="form-group row @error('name') error @enderror">
                        <label class="col-sm-3 col-form-label required">{{ __('Name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name"
                                value="{{ old('name') }}" placeholder="{{ __('Enter the Subscriber\'s Name') }}"
                                required>
                            @error('name')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row @error('e') error @enderror">
                        <label class="col-sm-3 col-form-label required" for="email">{{ __('Email') }}</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="email"
                            value="{{ old('email') }}" placeholder="{{ __('Enter the Subscriber\'s Email') }}"
                            required>
                            @error('email')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row @error('mobile') error @enderror">
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
                                <input type="number" name="mobile" value="{{ old('mobile') }}" maxlength="12"
                                    class="form-control" placeholder="{{ __('011355666111') }}">
                            </div>
                            @error('mobile')
                            <p class="error-message">{{ $message }}</p>
                            @enderror
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
