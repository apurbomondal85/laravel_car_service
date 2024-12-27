@extends('admin.layouts.master')

@section('title', __('New Faq'))

@section('content')
<div class="content-wrapper">

    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('New Faq')) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.faqs.index')) !!}
    </div>

    <div class="card shadow-sm col-md-8">
        <div class="card-body py-sm-4">
            <form method="post" action="{{ route('admin.faqs.create') }}" enctype="multipart/form-data">
                @csrf
                <div class="p-sm-3">

                    <div class="form-group row @error('question') error @enderror">
                        <label class="col-sm-3 col-form-label required">{{ __('Question') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="question"
                                value="{{ old('question') }}" placeholder="{{ __('Write the Faq Question') }}"
                                required>
                            @error('question')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row @error('answer') error @enderror">
                        <label class="col-sm-3 col-form-label required" for="answer">{{ __('Answer') }}</label>
                        <div class="col-sm-9">
                            <textarea type="text" name="answer" class="form-control" required
                                placeholder="{{ __('Write Answer') }}" rows="4">{{ old('answer') }}</textarea>
                            @error('answer')
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
