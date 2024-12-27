@extends('admin.layouts.master')

@section('title', __('Update Pricing Plan'))

@section('content')
<div class="content-wrapper">

    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Update Pricing Plan')) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.pricing_plan.index')) !!}
    </div>

    <div class="card shadow-sm col-md-12">
        <div class="card-body py-sm-4">
            <form method="post" action="{{ route('admin.pricing_plan.update', [$pricingPlan->id]) }}" enctype="multipart/form-data">
                @csrf
                <div class="p-sm-3 row">

                    <div class="col-md-6">
                        <div class="form-group row @error('name') error @enderror">
                            <label class="col-sm-3 col-form-label required">{{ __('Name') }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name', $pricingPlan->name) }}" placeholder="{{ __('Write Pricing Plan Name') }}" required>

                                @error('name')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row @error('price') error @enderror">
                            <label class="col-sm-3 col-form-label required">{{ __('Amount') }}</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="price" step="0.01"
                                    value="{{ old('price', $pricingPlan->price) }}" placeholder="{{ __('Write Amount') }}" required>

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
                                        <input type="hidden" value="0" name="is_active">

                                        <input type="checkbox" class="form-check-input" name="is_active"
                                            value="{{ old('is_active' == 1 ? 'checked' : '', 1) }}" {{ $pricingPlan->is_active == 1 ? 'checked' : '' }}>

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
                                <textarea class="form-control" id="summernote" name="description">
                                    {{ old('description', $pricingPlan->description) }}
                                </textarea>
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
