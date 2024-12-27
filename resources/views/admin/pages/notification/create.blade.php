@extends('admin.layouts.master')

@section('title', __('New Notification'))

@section('content')
<div class="content-wrapper">

    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('New Notification')) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.notification.index')) !!}
    </div>

    <div class="card shadow-sm col-md-5">
        <div class="card-body py-sm-4">
            <form method="post" action="{{ route('admin.notification.create') }}" enctype="multipart/form-data" id="notificationCreateForm">
                @csrf

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label required">{{ __('User Type') }}</label>
                    <div class="col-sm-9">
                        <div class="d-inline-flex justify-content-start">

                            <div class="form-check form-check-secondary mr-5">
                                <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="is_for_emp" id="is_for_emp" value="1" onclick="userTypeValidation()">
                                Employee
                                <i class="input-helper"></i></label>
                            </div>
                            <div class="form-check form-check-secondary mr-5">
                                <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="is_for_donor" id="is_for_donor" value="1" onclick="userTypeValidation()">
                                Donor
                                <i class="input-helper"></i></label>
                            </div>
                            <div class="form-check form-check-secondary mr-5">
                                <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="is_for_org" id="is_for_org" value="1" onclick="userTypeValidation()">
                                Organization
                                <i class="input-helper"></i></label>
                            </div>
                        </div>
                        <span class="text-danger" id="checkbox"></span>
                    </div>
                </div>

                <div class="form-group row @error('type') error @enderror">
                    <label class="col-sm-3 col-form-label required">{{ __('Type') }}</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="type" required>
                            <option selected disabled value="">Select One</option>
                            @foreach($notification_types as $notification_type)
                                <option value="{{ $notification_type }}" {{ (old("type") == $notification_type) ? "selected" : ""}}> {{ $notification_type }} </option>
                            @endforeach
                        </select>
                        @error('type')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group row @error('message') error @enderror">
                    <label class="col-sm-3 col-form-label required">{{ __('Message') }}</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="exampleTextarea1" name="message" rows="5" placeholder="Notification Message" required>{{ old('message') }}</textarea>
                        @error('message')
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
@include('admin.assets.dt')
@push('scripts')
<script>
    $(document).ready(function () {
        $("#is_for_emp").prop('checked', true);
    });

    function userTypeValidation()
    {
        checked = $("input[type=checkbox]:checked").length;
        if (checked){
            $("#checkbox").html('');
            $('button[type=submit]').prop('disabled', false);
        }
        else{
            $("#checkbox").html('<span>Check the checbox</span>');
            $('button[type=submit]').prop('disabled', true); 
        }
    }

</script>
@endpush
