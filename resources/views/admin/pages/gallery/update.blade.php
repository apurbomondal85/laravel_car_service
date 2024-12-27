@extends('admin.layouts.master')

@section('title', __('Update Gallery'))

@section('content')
<div class="content-wrapper">

    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Update Gallery')) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.gallery.index')) !!}
    </div>

    <form method="post" id="create-form" action="{{ route('admin.gallery.update', $gallery->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="card col-md-12 mb-4" style="box-shadow: rgb(0, 92, 45) 0px 2px 5px !important;">
            <div class="card-body">

                <div class="row pt-4">
                    <div class="col-md-6">
                        <div class="form-group row @error('category') error @enderror">
                            <label class="col-sm-3 col-form-label">{{ __('Category') }}</label>
                            <div class="col-sm-9">
                                <select class="form-control select" name="category" id="category">
                                    <option value="" class="selected highlighted">Select One</option>
                                    @foreach($category as $value)
                                        <option value="{{ $value }}" {{ (old("category", $gallery->category) == $value) ? "selected" : "" }}>
                                            {{ ucwords($value) }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row @error('name') error @enderror">
                            <label class="col-sm-3 col-form-label required">{{ __('Name') }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name', $gallery->name) }}" placeholder="{{ __('Write Gallery Name') }}"
                                    required>
                                @error('name')
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
                                            value="1" @checked(old('is_featured', $gallery->is_featured))>
                                        <i class="input-helper"></i></label>
                                    @error('is_featured')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="form-group row @error('description') error @enderror">
                            <label class="col-sm-3 col-form-label" for="description">{{ __('Description') }}</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="summernote" name="description" autofocus="autofocus" >{{ old('description', $gallery->description) }}</textarea>
                                @error('description')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                                <p class="text-danger" id="description"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="modal-footer justify-content-center col-md-12">

                        {!! \App\Library\Html::btnReset() !!}

                        <button type="submit" class="btn mr-3 my-3 btn2-secondary" id="subBtnFinal">
                            <i class="fas fa-save"></i> Save
                        </button>

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

    @vite('resources/admin_assets/js/gallery/create.js')

@endpush
