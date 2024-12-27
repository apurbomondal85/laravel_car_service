@extends('admin.layouts.master')

@section('title', 'New ' . ucwords($type))

@section('content')
<div class="content-wrapper">

    @php
        $client = \App\Library\Enum::CLIENT_TYPE_CLIENT;
        $partner = \App\Library\Enum::CLIENT_TYPE_PARTNER;
    @endphp

    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">NEW {{ strtoupper($type) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack($type == $client ? route('admin.client.index', ['type' => $client]) : route('admin.partner.index', ['type' => $partner])) !!}
    </div>

    <div class="card shadow-sm col-md-8">
        <div class="card-body py-sm-4">
            <form method="post" action="{{ $type == $client ? route('admin.client.create') : route('admin.partner.create') }}" enctype="multipart/form-data">
                @csrf
                <div class="p-sm-3">

                    <input type="hidden" name="client_type" value="{{ $type }}">

                    <div class="form-group row @error('name') error @enderror">
                        <label class="col-sm-3 col-form-label required">{{ __('Name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name"
                                value="{{ old('name') }}" placeholder="{{ __('Write Testimonial Name') }}"
                                required>
                            @error('name')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row @error('logo') error @enderror">
                        <label class="col-sm-3 col-form-label">Logo</label>
                        <div class="col-sm-9">
                            <div class="file-upload-section">
                                <input name="logo" type="file" class="form-control d-none" allowed="png,gif,jpeg,jpg">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled="" readonly placeholder="Size: 200x200 and max 500kB">
                                    <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-outline-secondary" type="button"><i class="fas fa-upload"></i> Browse</button>
                                    </span>
                                </div>
                                @error('logo')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                                <div class="display-input-image d-none">
                                    <img src="{{ asset(\App\Library\Enum::NO_IMAGE_PATH) }}" alt="Preview Image"/>
                                    <button type="button" class="btn btn-sm btn-outline-danger file-upload-remove" title="Remove">x</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row @error('description') error @enderror">
                        <label class="col-sm-3 col-form-label" for="description">{{ __('Description') }}</label>
                        <div class="col-sm-9">
                            <textarea type="text" name="description" class="form-control"
                                placeholder="{{ __('Write Description') }}" rows="4">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row @error('is_featured') error @enderror" style="align-items: center">
                        <label class="col-sm-3 col-form-label">Is Featured</label>
                        <div class="col-xl-9 col-md-9 col-sm-12 col-12" style="align-items: center">
                            <div class="form-check form-check-success @error('is_featured') error @enderror">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="is_featured"
                                        value="1" @checked(old('is_featured'))>
                                    <i class="input-helper"></i></label>
                                @error('is_featured')
                                <p class="error-message">{{ $message }}</p>
                                @enderror
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
