@extends('admin.layouts.master')

@section('title', __('Update Subscriber'))

@section('content')
<div class="content-wrapper">

    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Update Subscriber')) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.subscribers.index')) !!}
    </div>

    @php
        $countryCode = strpos($subscriber->mobile, '-') ? explode('-', $subscriber->mobile)[0] : '+64';
        info($countryCode );
    @endphp

    <div class="card shadow-sm col-md-8">
        <div class="card-body py-sm-4">
            <form method="post" action="{{ route('admin.subscribers.update', $subscriber->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="p-sm-3">
                    <div class="form-group row @error('name') error @enderror">
                        <label class="col-sm-3 col-form-label required">{{ __('Name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name"
                                value="{{ old('name', $subscriber->name) }}" placeholder="{{ __('Write the Subscriber Name') }}"
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
                            value="{{ old('email', $subscriber->email) }}" placeholder="{{ __('Write the Subscriber Email') }}"
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
                                        @php $skip=0; @endphp
                                        @foreach($countries as $key => $country)
                                        <option value="{{ $country['code'] }}"
                                            {{( $countryCode == $country['code'] && !$skip) ? "selected" : ""}}>{{$key}}
                                            {{ $country['code']}}
                                        </option>
                                        @if ($countryCode == $country['code'])
                                        @php $skip=1; @endphp
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <input type="number" name="mobile"
                                    value="{{ old('mobile', ((strpos($subscriber->mobile, '-') == true) ? (explode('-', $subscriber->mobile))[1] : $subscriber->mobile) ) }}"
                                    class="form-control" placeholder="{{ __('11223344556') }}" maxlength="12">
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
