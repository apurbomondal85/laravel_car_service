@extends('admin.layouts.master')

@section('title', __('New Product'))

@section('content')
<div class="content-wrapper">

    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('New Product')) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.product.index')) !!}
    </div>

    <form method="post" id="create-form" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card col-md-12 mb-4" style="box-shadow: rgb(0, 92, 45) 0px 2px 5px !important;">
            <div class="card-body">

                <div class="row pt-4">
                    <div class="col-md-6">

                        <div class="form-group row @error('name') error @enderror">
                            <label class="col-sm-3 col-form-label required">{{ __('Title') }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name') }}" placeholder="{{ __('Write Product Title') }}"
                                    required>
                                @error('name')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row @error('date') error @enderror">
                            <label class="col-sm-3 col-form-label">{{ __('Date') }}</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="date"
                                    value="{{ old('date') }}">
                                @error('date')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row @error('featured_image') error @enderror">
                            <label class="col-sm-3 col-form-label required">Featured Image</label>
                            <div class="col-sm-9">
                                <div class="file-upload-section">
                                    <input name="featured_image" type="file" class="form-control d-none" allowed="png,gif,jpeg,jpg">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled="" readonly placeholder="Size: 200x200 and max 500kB">
                                        <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-outline-secondary" type="button"><i class="fas fa-upload"></i> Browse</button>
                                        </span>
                                    </div>
                                    @error('featured_image')
                                        <p class="error-message">{{ $message }}</p>
                                    @enderror
                                    <div class="display-input-image d-none">
                                        <img src="{{ asset(\App\Library\Enum::NO_IMAGE_PATH) }}" alt="Preview Image"/>
                                        <button type="button" class="btn btn-sm btn-outline-danger file-upload-remove" title="Remove">x</button>
                                    </div>
                                </div>
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

                    <div class="col-md-6">
                        <div class="form-group row @error('short_description') error @enderror">
                            <label class="col-sm-3 col-form-label" for="short_description">{{ __('Short Description') }}</label>
                            <div class="col-sm-9">
                                <textarea type="text" name="short_description" class="form-control"
                                    placeholder="{{ __('Write Short Description') }}" rows="4">{{ old('short_description') }}</textarea>
                                @error('short_description')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row @error('description') error @enderror">
                            <label class="col-sm-3 col-form-label" for="description">{{ __('Description') }}</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="summernote" name="description" autofocus="autofocus">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                                <p class="text-danger" id="description"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card col-md-12" style="box-shadow: rgb(0, 92, 45) 0px 2px 5px !important;">
            <div class="card-body">

                @include('admin.pages.partial.create')

                <div class="row">
                    <div class="modal-footer justify-content-center col-md-12">

                        {!! \App\Library\Html::btnReset() !!}

                        <button type="submit" class="btn mr-3 my-3 btn2-secondary d-none" id="subBtnFinal">
                            <i class="fas fa-save"></i> Save
                        </button>

                        <span class="btn mr-3 my-3 btn2-secondary" id="subBtn">
                            <i class="fas fa-save"></i> Save
                        </span>

                    </div>
                </div>
            </div>
        </div>
    </form>

</div>
@stop

@include('admin.assets.select2')
@include('admin.assets.summernote-text-editor')

@push('scripts')

    @vite('resources/admin_assets/js/partial/create.js')
    @vite('resources/admin_assets/js/project/create.js')

@endpush
