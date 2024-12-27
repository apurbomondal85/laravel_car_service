@extends('admin.layouts.master')

@section('title', __('Update Team'))

@section('content')
<div class="content-wrapper">

    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Update Committee')) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.committee.index')) !!}
    </div>

    <div class="card shadow-sm col-md-5">
        <div class="card-body py-sm-4">
            <form method="post" action="{{ route('admin.committee.update', $committee->id) }}" enctype="multipart/form-data"
                id="notificationCreateForm">
                @csrf

                <div class="form-group row @error('name') error @enderror">
                    <label class="col-sm-3 col-form-label required">{{ __('Team Name') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="name" value="{{ old('name', $committee->name) }}"
                            placeholder="{{ __('Team Name') }}" required>
                        @error('name')
                        <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group row @error('year') error @enderror">
                    <label class="col-sm-3 col-form-label required" for="name">{{ __('Seasion') }}</label>
                    <div class="col-sm-9">
                        <select class="select form-control" name="year" id="year" style="width: 100%;">
                            <option selected disabled value="">Select One</option>
                            @foreach($seasons as $season)
                            <option value="{{ $season }}" {{ old('season', $committee->year) == $season ? 'selected' : '' }}> {{$season}}
                            </option>
                            @endforeach
                        </select>
                        @error('year')
                        <p class="error-message">{{ $message }}</p>
                        @enderror
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
@push('scripts')

@endpush