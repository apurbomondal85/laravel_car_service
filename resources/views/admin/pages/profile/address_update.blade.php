@extends('admin.layouts.master')

@section('title', __('Update Address'))

@section('content')

<div class="content-wrapper">

    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ __('Update Address') }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.profile.index')) !!}
    </div>

    <div class="card shadow-sm col-sm-8">
        <div class="card-body">
            <form method="post" action="{{ route('admin.profile.update_address') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="p-sm-3">

                        <div class="col-sm-12">
                            @include('admin.components.address_form', ['field_values' => $user->userProfile])
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