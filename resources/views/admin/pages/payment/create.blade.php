@extends('admin.layouts.master')

@section('title', __('New payment'))

@section('content')
<div class="content-wrapper">

    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ __('New payment') }}</h4>
        </div>
        <a href="{{ route('admin.payment.index') }}" class="btn btn-sm btn-outline-secondary btn-back"><i
                class="far fa-hand-point-left"></i> Back</a>
    </div>

    <div class="card">
        <div class="card-body py-sm-4">
            <form method="post" action="{{ route('admin.payment.create') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="p-sm-3">
                            <div class="form-group row @error('trx_id') error @enderror">
                                <label class="col-sm-3 col-form-label">{{ __('Transaction Id') }}</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="trx_id" value="{{ old('trx_id') }}"
                                        placeholder="{{ __('TRX ID') }}" required>
                                    @error('trx_id')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row @error('camp_id') error @enderror">
                                <label class="col-sm-3 col-form-label">{{ __('Campain') }}</label>
                                <div class="col-sm-9">
                                    <select name="camp_id" class="form-control js-example-basic-single" required>
                                        <option selected disabled>Select One</option>
                                        @foreach($campains as $key => $campain)
                                        <option value="{{ $campain->id }}"
                                            {{ (old('camp_id') == $campain->id) ? "selected" : "" }}>
                                            {{ $campain->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('camp_id')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row @error('donor_id') error @enderror">
                                <label class="col-sm-3 col-form-label">{{ __('Donors') }}</label>
                                <div class="col-sm-9">
                                    <select name="donor_id" class="form-control js-example-basic-single" required>
                                        <option selected disabled>Select One</option>
                                        @foreach($donors as $key => $donor)
                                        <option value="{{ $donor->user->id }}"
                                            {{ (old('donor_id') == $donor->id) ? "selected" : "" }}>
                                            {{ $donor->user?->getFullNameAttribute() }}</option>
                                        @endforeach
                                    </select>
                                    @error('donor_id')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label
                                        class="col-sm-3 col-form-label required required">{{ __('Is Recurrent') }}</label>
                                    <div class="col-sm-9">
                                        <div class="d-inline-flex justify-content-start">
                                            <div class="form-check form-check-info mr-5">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="is_recurrent"
                                                        value="1" required
                                                        {{ !old('is_recurrent') ? 'checked' : '' }}>
                                                    Recurrent
                                                    <i class="input-helper"></i></label>
                                            </div>
                                            <div class="form-check form-check-danger">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="is_recurrent"
                                                        value="0" required
                                                        {{ old('is_recurrent') ? 'checked' : '' }}>
                                                    Manual
                                                    <i class="input-helper"></i></label>
                                            </div>
                                            @error('is_recurrent') <p class="error-message">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="p-sm-3 col-sm-12">

                            <div class="form-group row @error('type') error @enderror">
                                <label class="col-sm-3 col-form-label required">{{ __('Type') }}</label>
                                <div class="col-sm-9">
                                    <select name="type" class="form-control js-example-basic-single" required>
                                        <option selected disabled>Select One</option>
                                        @foreach($payment_types as $key => $payment_type)
                                        <option value="{{ $payment_type }}"
                                            {{ (old('type') == $payment_type) ? "selected" : "" }}>
                                            {{ $payment_type }}</option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row @error('amount') error @enderror">
                                <label class="col-sm-3 col-form-label required">{{ __('Amount') }}</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="amount" step="0.1" value="{{ old('amount') }}"
                                        placeholder="{{ __('Amount') }}" required>
                                    @error('amount')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row @error('commission') error @enderror">
                                <label class="col-sm-3 col-form-label required">{{ __('Commission') }}</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="commission" step="0.1" value="{{ old('commission') }}"
                                        placeholder="{{ __('Commission') }}" required>
                                    @error('commission')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="modal-footer justify-content-center col-md-12">
                        <button type="reset" class="btn btn-secondary mr-3">{{ __('Reset') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Save') }} </button>
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