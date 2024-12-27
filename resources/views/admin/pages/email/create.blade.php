@extends('admin.layouts.master')

@section('title', __('New Email'))

@section('content')
<div class="content-wrapper">

    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('New Email')) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.email.index')) !!}
    </div>

    <div class="card shadow-sm">
        <div class="card-body py-sm-4">
            <form method="post" action="{{ route('admin.email.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="p-sm-3">

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label required">{{ __('Select Member') }}</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <select class="form-control select2-multiple" value="{{ old('subscriber_id') }}" id="subscriber_id"
                                                name="subscriber_id[]" multiple="multiple">
                                                <option value="all">All</option>
                                                @foreach($subscriber as $key => $value)
                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label required">{{ __('Email Subject') }}</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="form-group col-12 @error('subject') error @enderror">
                                            <input type="text" class="form-control" value="{{ old('subject') }}"
                                                name="subject" placeholder="{{ __('Subject') }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label required">{{ __('Email Body') }}</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="form-group col-12 @error('message') error @enderror">
                                            <textarea class="form-control" id="summernote" name="message"
                                                required>{{ old('message') }}</textarea>
                                        </div>
                                    </div>
                                </div>
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
@include('admin.assets.dt')
@include('admin.assets.select2')
@include('admin.assets.summernote-text-editor')

@push('scripts')
@vite('resources/admin_assets/js/bulk_email/create.js')
@endpush
