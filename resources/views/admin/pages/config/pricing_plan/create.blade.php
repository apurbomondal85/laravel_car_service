@extends('admin.layouts.master')

@section('title', __('New Pricing Plan'))

@section('content')
<div class="content-wrapper">

    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('New Pricing Plan')) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.pricing_plan.index')) !!}
    </div>

    <div class="card shadow-sm col-md-12">
        <div class="card-body py-sm-4">
            <form method="post" action="{{ route('admin.pricing_plan.create') }}" enctype="multipart/form-data">
                @csrf
                <div class="p-sm-3 row">

                    <div class="col-md-6">
                        <div class="form-group row @error('name') error @enderror">
                            <label class="col-sm-3 col-form-label required">{{ __('Name') }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name') }}" placeholder="{{ __('Name') }}" required>

                                @error('name')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row @error('price') error @enderror">
                            <label class="col-sm-3 col-form-label required">{{ __('Price') }}</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="price" step="0.01"
                                    value="{{ old('price') }}" placeholder="{{ __('Write Price') }}" required>

                                @error('price')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row @error('is_active') error @enderror" style="align-items: center;">
                            <label class="col-sm-3 col-form-label">{{ __('Is Active') }}</label>
                            <div class="col-sm-9">
                                <div class="form-check form-check-success">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="is_active"
                                            value="1" @checked(old('is_active'))>
                                        <i class="input-helper"></i></label>

                                    @error('is_active')
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
                                <textarea class="form-control" id="summernote" name="description">{{ old('description') }}</textarea>
                                @error('description')
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

@include('admin.assets.summernote-text-editor')

@push('scripts')
<script>
    $('#summernote').summernote({
        height: 200
    });
</script>
@endpush
