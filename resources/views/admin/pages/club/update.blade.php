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

    <div class="card shadow-sm col-md-12">
        <div class="card-body py-sm-4">
            <form method="post" action="{{ route('admin.club.update', $club->id) }}" enctype="multipart/form-data"
                id="notificationCreateForm">
                @csrf

                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group row @error('name') error @enderror">
                            <label class="col-sm-3 col-form-label required">{{ __('Club Name') }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" value="{{ old('name',$club->name) }}"
                                    placeholder="{{ __('Club Name') }}" required>
                                @error('name')
                                <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row @error('image') error @enderror">
                            <label class="col-sm-3 col-form-label required"> Club Picture </label>
                            <div class="col-sm-9">
                                <div class="file-upload-section">
                                    <input name="image" type="file" class="form-control d-none"
                                        allowed="png,gif,jpeg,jpg">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled="" readonly
                                            placeholder="Size: 600x600 and max 500kB">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-outline-secondary"
                                                type="button"><i class="fas fa-upload"></i> Browse</button>
                                        </span>
                                    </div>
                                    @error('image')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror
                                    <div class="display-input-image @if(!$club->image) d-none @endif">
                                        <img src="{{ asset( isset($club->image) ? $club->image : \App\Library\Enum::NO_IMAGE_PATH) }}" alt="Preview Image" />
                                        <button type="button" class="btn btn-sm btn-outline-danger file-upload-remove"
                                            title="Remove">x</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row @error('cover_image') error @enderror">
                            <label class="col-sm-3 col-form-label"> Club Cover Picture </label>
                            <div class="col-sm-9">
                                <div class="file-upload-section">
                                    <input name="cover_image" type="file" class="form-control d-none"
                                        allowed="png,gif,jpeg,jpg">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled="" readonly
                                            placeholder="Size: 600x800 and max 500kB">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-outline-secondary"
                                                type="button"><i class="fas fa-upload"></i> Browse</button>
                                        </span>
                                    </div>
                                    @error('cover_image')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror
                                    <div class="display-input-image @if(!$club->cover_image) d-none @endif">
                                        <img src="{{ asset( isset($club->cover_image) ? $club->cover_image : \App\Library\Enum::NO_IMAGE_PATH ) }}" alt="Preview Image" />
                                        <button type="button" class="btn btn-sm btn-outline-danger file-upload-remove"
                                            title="Remove">x</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">

                        <div class="form-group row @error('description') error @enderror">
                            <label class="col-sm-3 col-form-label required">{{ __('Club Description') }}</label>
                            <div class="col-sm-9">
                                <textarea name="description" placeholder="Textarea" id="message"
                                    class="form-control quill-editor" rows="8"> {{ old('description', $club->description ) }}</textarea>
                                @error('description')
                                <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-footer text-center">
                    {!! \App\Library\Html::btnSubmit() !!}
                </div>

            </form>
        </div>
    </div>
</div>
@stop
@include('admin.assets.quill-text-editor')
@push('scripts')
<script>
    $('.quill-editor').each(function (i, el) {
        var el = $(this),
            id = 'quilleditor-' + i,
            val = el.val(),
            editor_height = 200;
        var div = $('<div/>').attr('id', id).css('height', editor_height + 'px').html(val);
        el.addClass('d-none');
        el.parent().append(div);

        var quill = new Quill('#' + id, {
            modules: {
                toolbar: true
            },
            theme: 'snow'
        });
        quill.on('text-change', function (delta, oldDelta, source) {
            document.getElementById("message").value = quill.root.innerHTML;
        });
    });
</script>
@endpush