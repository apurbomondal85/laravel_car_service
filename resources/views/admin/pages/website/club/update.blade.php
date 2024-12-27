@extends('admin.layouts.master')

@section('title', __('Update Club'))

@section('content')
<div class="content-wrapper">

    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Update Club')) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.club.index')) !!}
    </div>

    <div class="card shadow-sm col-md-8">
        <div class="card-body py-sm-4">
            <form method="post" action="{{ route('admin.club.update', $club->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="p-sm-3">

                    <input type="hidden" name="id" value="{{ $club->id }}">

                    <div class="form-group row @error('name') error @enderror">
                        <label class="col-sm-3 col-form-label required">{{ __('Name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name"
                                value="{{ old('name', $club->name) }}" placeholder="{{ __('Write Your Club name') }}"
                                required>
                            @error('name')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row @error('slogan') error @enderror">
                        <label class="col-sm-3 col-form-label">{{ __('Slogan') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="slogan"
                                value="{{ old('slogan', $club->slogan) }}" placeholder="{{ __('Write Your Club Slogan') }}">
                            @error('slogan')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row @error('description') error @enderror">
                        <label class="col-sm-3 col-form-label required" for="description">{{ __('Description') }}</label>
                        <div class="col-sm-9">
                            <textarea type="text" name="description" class="form-control" required
                                placeholder="{{ __('Write Description') }}" rows="4">{{ old('description', $club->description) }}</textarea>
                            @error('description')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row @error('featured_image') error @enderror">
                        <label class="col-sm-3 col-form-label required">Logo</label>
                        <div class="col-sm-9">
                            <div class="file-upload-section">
                                <input name="featured_image" type="file" class="form-control d-none"
                                    allowed="png,gif,jpeg,jpg">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled=""
                                        readonly placeholder="Size: 200x200 and max 500kB">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-outline-secondary"
                                            type="button"><i class="fas fa-upload"></i> Browse</button>
                                    </span>
                                </div>
                                @error('featured_image')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                                <div class="display-input-image"
                                    style="display: {{ $club->featured_image ? '' : 'd-none' }}">
                                    <img src="{{ $club->getFeaturedImage() }}" alt="Preview Image" />
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
@stop

@include('admin.assets.summernote-text-editor')

@push('scripts')
<script>
    $('#summernote').summernote({
        height: 400
    });
</script>
@endpush