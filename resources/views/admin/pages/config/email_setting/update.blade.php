@extends('admin.layouts.master')

@section('title', __('Update Email Settings'))

@section('content')

<div class="content-wrapper">

    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Update Email Settings')) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.config.email.index')) !!}
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="post" action="{{ route('admin.config.email.update', $data->id) }}"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="p-sm-3">

                            <div class="form-group row @error('subject') error @enderror">
                                <label class="col-sm-2 col-form-label required">{{ __('Email Subject') }}</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="subject"
                                        value="{{ old('subject', $data->subject) }}"
                                        placeholder="{{ __('Email Address') }}" required>
                                    @error('subject')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row @error('message') error @enderror">
                                <label class="col-sm-2 col-form-label required" for="name">{{ __('Email Message') }}</label>
                                <div class="col-sm-10">
                                    <div id="editor">
                                        <textarea name="message" placeholder="Textarea" id="message" class="form-control quill-editor">
                                                {{ $data->message }}
                                        </textarea>
                                        @error('message')
                                        <p class="error-message">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="pt-sm-10">
                                        @foreach($shortcodes as $key => $shortcode)
                                            @if($shortcode )
                                                <span class="badge btn2-light-secondary pointer mb-sm-2" onclick="shortCodeCopy({{$key}})">
                                                    {{$shortcode}}
                                                    <input type="hidden" id="copyShortCode{{$key}}" value="{{$shortcode}}">
                                                </span>
                                            @endif
                                        @endforeach

                                        @php $i = 0; @endphp
                                        @foreach($systemShortCodes as $index => $systemShortCode)
                                            @if($index)
                                                @php $i++; @endphp
                                                <span class="badge btn2-light-secondary pointer mb-sm-2" onclick="systemShortCodeCopy({{$i}})">
                                                    {{$index}}
                                                    <input type="hidden" id="copySystemShortCode{{$i}}" value="{{$index}}">
                                                </span>
                                            @endif
                                        @endforeach
                                        <div id="copied-success" class="copied">
                                            <span>Copied!</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="modal-footer justify-content-center col-md-12">
                        <button type="submit" class="btn btn2-secondary"><i class="fas fa-save"></i> {{ __('Update') }} </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@include('admin.assets.quill-text-editor')
@push('scripts')
<script>
    //   var quill = new Quill('#editor', {
    //     theme: 'snow'
    //   });
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
        quill.on('text-change', function(delta, oldDelta, source) {
            document.getElementById("message").value = quill.root.innerHTML;
        });
    });

    function shortCodeCopy(key) {
        let copyText = document.getElementById("copyShortCode"+key);
        let copySuccess = document.getElementById("copied-success");
        copyText.select();
        let textValue = '{'+'{'+copyText.value+'}'+'}';

        navigator.clipboard.writeText(textValue);

        copySuccess.style.opacity = "1";
        setTimeout(function(){ copySuccess.style.opacity = "0" }, 500);
    };

    function systemShortCodeCopy(i) {
        let copyText = document.getElementById("copySystemShortCode"+i);
        let copySuccess = document.getElementById("copied-success");
        copyText.select();

        let textValue = '{'+'{'+copyText.value+'}'+'}';

        navigator.clipboard.writeText(textValue);

        copySuccess.style.opacity = "1";
        setTimeout(function(){ copySuccess.style.opacity = "0" }, 500);
    };

</script>
@endpush
