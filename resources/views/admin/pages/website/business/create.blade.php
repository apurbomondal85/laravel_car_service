@extends('admin.layouts.master')

@section('title', __('New Business'))

@section('content')
<div class="content-wrapper">

    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('New Business')) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.business.index')) !!}
    </div>

    <div class="card shadow-sm col-md-12">
        <div class="card-body py-sm-4">
            <form method="post" action="{{ route('admin.business.create') }}" enctype="multipart/form-data">
                @csrf
                <div class="p-sm-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row @error('business_type') error @enderror">
                                <label class="col-sm-3 col-form-label required">{{ __('Business Type') }}</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="business_type" required>
                                        <option value="" class="selected highlighted">Select One</option>
                                        @foreach($business_type as $value)
                                            <option value="{{ $value }}" {{(old("business_type") == $value) ? "selected" : ""}}>
                                                {{ ucwords($value) }}</option>
                                        @endforeach
                                    </select>
                                    @error('business_type')
                                        <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row @error('title') error @enderror">
                                <label class="col-sm-3 col-form-label required">{{ __('Business Title') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="title"
                                        value="{{ old('title') }}" placeholder="{{ __('Write Your Business Title') }}"
                                        required>
                                    @error('title')
                                        <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row @error('user_id') error @enderror">
                                <label class="col-sm-3 col-form-label">{{ __('Select Member') }}</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="user_id">
                                        <option value="" class="selected highlighted">Select One</option>
                                        @foreach($members as $row)
                                            <option value="{{ $row->id }}" {{(old("user_id") == $row->id) ? "selected" : ""}}>
                                                {{ ucwords($row->full_name) }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row @error('contact_person') error @enderror">
                                <label class="col-sm-3 col-form-label">{{ __('Contact Person') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="contact_person"
                                        value="{{ old('contact_person') }}" placeholder="{{ __('Write Contact Person Details') }}">
                                    @error('contact_person')
                                        <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row @error('url') error @enderror">
                                <label class="col-sm-3 col-form-label">{{ __('Company URL') }}</label>
                                <div class="col-sm-9">
                                    <input type="url" class="form-control" name="url"
                                        value="{{ old('url') }}" placeholder="{{ __('Write Company URL') }}">
                                    @error('url')
                                        <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row @error('description') error @enderror">
                                <label class="col-sm-3 col-form-label required" for="description">{{ __('Description') }}</label>
                                <div class="col-sm-9">
                                    <textarea type="text" name="description" class="form-control" required
                                        placeholder="{{ __('Write Description') }}" rows="4">{{ old('description') }}</textarea>
                                    @error('description')
                                        <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">

                            <div class="form-group row @error('start_date') error @enderror">
                                <label class="col-sm-3 col-form-label required" for="start_date">{{ __('Start Date') }}</label>
                                <div class="col-sm-9">
                                    <input type="date" name="start_date" id="start_date" class="form-control"
                                        value="{{old('start_date')}}" required>
                                    @error('start_date')
                                        <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row @error('end_date') error @enderror">
                                <label class="col-sm-3 col-form-label required" for="end_date">{{ __('End Date') }}</label>
                                <div class="col-sm-9">
                                    <input type="date" name="end_date" id="end_date" class="form-control"
                                        value="{{old('end_date')}}" required>
                                    @error('end_date')
                                        <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row @error('ranking') error @enderror">
                                <label class="col-sm-3 col-form-label">{{ __('Business Ranking') }}</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="ranking">
                                        <option value="" class="selected highlighted">Select One</option>
                                        @foreach($ranking as $key => $value)
                                            <option value="{{ $key }}" {{(old("ranking") == $key) ? "selected" : ""}}>
                                                {{ ucwords($value) }}</option>
                                        @endforeach
                                    </select>
                                    @error('ranking')
                                        <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row @error('amount') error @enderror">
                                <label class="col-sm-3 col-form-label required">{{ __('Payment Amount') }}</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="amount" step="0.01"
                                        value="{{ old('amount') }}" placeholder="{{ __('Write Amount') }}"
                                        required>
                                    @error('amount')
                                        <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row @error('note') error @enderror">
                                <label class="col-sm-3 col-form-label" for="note">{{ __('Payment Note') }}</label>
                                <div class="col-sm-9">
                                    <textarea type="text" name="note" class="form-control"
                                        placeholder="{{ __('Write here about payment method & payment details') }}" rows="4">{{ old('note') }}</textarea>
                                    @error('note')
                                        <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row @error('business_logo') error @enderror">
                                <label class="col-sm-3 col-form-label required">Business Logo</label>
                                <div class="col-sm-9">
                                    <div class="file-upload-section">
                                        <input name="business_logo" type="file" class="form-control d-none" allowed="png,gif,jpeg,jpg">
                                        <div class="input-group col-xs-12">
                                            <input type="text" class="form-control file-upload-info" disabled="" readonly placeholder="Size: 200x200 and max 500kB">
                                            <span class="input-group-append">
                                                <button class="file-upload-browse btn btn-outline-secondary" type="button"><i class="fas fa-upload"></i> Browse</button>
                                            </span>
                                        </div>
                                        @error('business_logo')
                                            <p class="error-message">{{ $message }}</p>
                                        @enderror
                                        <div class="display-input-image d-none">
                                            <img src="{{ asset(\App\Library\Enum::NO_IMAGE_PATH) }}" alt="Preview Image"/>
                                            <button type="button" class="btn btn-sm btn-outline-danger file-upload-remove" title="Remove">x</button>
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


@push('scripts')
<script>

</script>
@endpush
