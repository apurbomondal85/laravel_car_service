@extends('admin.layouts.master')

@section('title', __('Membership Type'))

@section('content')
<div class="content-wrapper">

    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Membership Type')) }}</h4>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body py-sm-4">
            <form method="post" action="{{ route('admin.config.membership.type.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="p-sm-3">
                            @foreach(\App\Library\Enum::getMemberType() as $key => $member_type)
                                <div class="form-group row @error("general") error @enderror">
                                    <label class="col-sm-3 col-form-label required">{{ $member_type }}</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="{{ $member_type }}"
                                            value="{{ $membership_types ? $membership_types->$key : old($key) }}" placeholder="Enter Amount"
                                            required>
                                            @if($errors->has($member_type))
                                                <div class="text-danger">{{ $errors->first($member_type) }}</div>
                                            @endif
                                    </div>
                                </div>
                            @endforeach
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
@push('scripts')
@endpush
