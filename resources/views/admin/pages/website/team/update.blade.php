@extends('admin.layouts.master')

@section('title', __('Update Team'))

@section('content')
<div class="content-wrapper">

    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Update Team')) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.team.index')) !!}
    </div>

    <div class="card shadow-sm col-md-8">
        <div class="card-body py-sm-4">
        <form method="post" action="{{ route('admin.team.update', $team->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group @error('name') error @enderror">
                <label class="required">{{ __('Name') }}</label>

                <input type="text" class="form-control" name="name" value="{{ old('name', $team->name) }}"
                    placeholder="{{ __('Write Your Team Name') }}" required>
                @error('name')
                <p class="error-message">{{ $message }}</p>
                @enderror

            </div>
            <div class="form-group @error('short_description') error @enderror">
                <label class="">{{ __('Short Description') }}</label>
                <textarea type="text" class="form-control" name="short_description"
                    placeholder="{{ __('Write About Team') }}" rows="6">
                    {{ old('short_description', $team->short_description) }}
                </textarea>
                @error('short_description')
                <p class="error-message">{{ $message }}</p>
                @enderror

            </div>

            <div class="row">
                <div class="d-flex justify-content-center col-md-12">
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
