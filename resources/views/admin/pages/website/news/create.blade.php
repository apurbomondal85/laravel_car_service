@extends('admin.layouts.master')

@section('title', __('New News'))

@section('content')
<div class="content-wrapper">

    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('New News')) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.news.index')) !!}
    </div>

    <div class="card shadow-sm col-md-8">
        <div class="card-body py-sm-4">
            <form method="post" action="{{ route('admin.news.create') }}" enctype="multipart/form-data">
                @csrf
                <div class="p-sm-3">

                    <div class="form-group row @error('title') error @enderror">
                        <label class="col-sm-3 col-form-label required">{{ __('Title') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}"
                                placeholder="{{ __('Write Your News Title') }}" required>
                            @error('title')
                            <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row @error('link') error @enderror">
                        <label class="col-sm-3 col-form-label">{{ __('Link') }}</label>
                        <div class="col-sm-9">
                            <input type="url" class="form-control" name="link" value="{{ old('link') }}"
                                placeholder="{{ __('Enter News Link') }}">
                            @error('title')
                            <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row @error('description') error @enderror">
                        <label class="col-sm-3 col-form-label required" for="description">{{ __('Description')
                            }}</label>
                        <div class="col-sm-9">
                            <textarea type="text" name="description" id="summernote" class="form-control"
                                placeholder="{{ __('Write Short Description') }}" rows="4"
                                required>{{ old('description') }}</textarea>
                            @error('description')
                            <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row @error('featured_image') error @enderror">
                        <label class="col-sm-3 col-form-label">Thumbnail</label>
                        <div class="col-sm-9">
                            <div class="file-upload-section">
                                <input name="featured_image" type="file" class="form-control d-none"
                                    allowed="png,gif,jpeg,jpg">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled="" readonly
                                        placeholder="Size: 200x200 and max 500kB">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-outline-secondary" type="button"><i
                                                class="fas fa-upload"></i> Browse</button>
                                    </span>
                                </div>
                                @error('featured_image')
                                <p class="error-message">{{ $message }}</p>
                                @enderror
                                <div class="display-input-image d-none">
                                    <img src="{{ asset(\App\Library\Enum::NO_IMAGE_PATH) }}" alt="Preview Image" />
                                    <button type="button" class="btn btn-sm btn-outline-danger file-upload-remove"
                                        title="Remove">x</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row @error('is_featured') error @enderror">
                        <label class="col-sm-3 col-form-label">{{ __('Featured') }}</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="is_featured">
                                <option value="0" class="selected highlighted">Select One</option>
                                <option value="1" {{(old("is_featured")==1) ? "selected" : "" }}>
                                    Yes</option>
                                <option value="0" {{(old("is_featured")==0) ? "selected" : "" }}>
                                    No</option>
                            </select>
                            @error('is_featured')
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
@include('admin.assets.summernote-text-editor')

@push('scripts')
<script>
    $('#summernote').summernote({
        height: 300
    });
</script>
@endpush
