@extends('admin.layouts.master')

@section('title', __('Update Career'))

@section('content')
<div class="content-wrapper">

    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Update Career')) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.career.index')) !!}
    </div>

    <div class="card shadow-sm col-md-8">
        <div class="card-body py-sm-4">
            <form method="post" action="{{ route('admin.career.update', $career->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="p-sm-3">

                    <input type="hidden" name="id" value="{{ $career->id }}">

                    <div class="form-group row @error('job_type') error @enderror">
                        <label class="col-sm-3 col-form-label">{{ __('Job Type') }}</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="job_type">
                                <option value="" class="selected highlighted">Select One</option>
                                @foreach($job_type as $value)
                                    <option value="{{ $value }}" {{(old("job_type", $career->job_type) == $value) ? "selected" : ""}}>
                                        {{ ucwords($value) }}</option>
                                @endforeach
                            </select>
                            @error('job_type')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row @error('title') error @enderror">
                        <label class="col-sm-3 col-form-label required">{{ __('Job Title') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="title"
                                value="{{ old('title', $career->title) }}" placeholder="{{ __('Write Your Job Title') }}"
                                required>
                            @error('title')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row @error('company_name') error @enderror">
                        <label class="col-sm-3 col-form-label" for="company_name">{{ __('Company Name') }}</label>
                        <div class="col-sm-9">
                            <textarea type="text" name="company_name" class="form-control"
                                placeholder="{{ __('Write Company Name') }}" rows="4">{{ old('company_name', $career->company_name) }}</textarea>
                            @error('company_name')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row @error('deadline') error @enderror">
                        <label class="col-sm-3 col-form-label required" for="deadline">{{ __('Deadline') }}</label>
                        <div class="col-sm-9">
                            <input type="date" name="deadline" id="deadline" class="form-control"
                                value="{{old('deadline', $career->deadline)}}" min="{{ now()->format('Y-m-d') }}" required>
                            @error('deadline')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row @error('location') error @enderror">
                        <label class="col-sm-3 col-form-label">{{ __('Location') }}</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="location">
                                <option value="" class="selected highlighted">Select One</option>
                                @foreach($job_locations as $value)
                                    <option value="{{ $value }}" {{(old("location", $career->location) == $value) ? "selected" : ""}}>
                                        {{ ucwords($value) }}</option>
                                @endforeach
                            </select>
                            @error('location')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row @error('short_description') error @enderror">
                        <label class="col-sm-3 col-form-label" for="short_description">{{ __('Short Descriptions') }}</label>
                        <div class="col-sm-9">
                            <textarea type="text" name="short_description" class="form-control"
                                placeholder="{{ __('Write Short Descriptions') }}" rows="4">{{ old('short_description', $career->short_description) }}</textarea>
                            @error('short_description')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row @error('description') error @enderror">
                        <label class="col-sm-3 col-form-label" for="description">{{ __('Description') }}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="summernote" name="description">{{ old('description', $career->description) }}</textarea>
                            @error('description')
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
        height: 400
    });
</script>
@endpush
