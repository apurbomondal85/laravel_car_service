@extends('admin.layouts.master')

@section('title', __('New Subscription'))

@section('content')
<div class="content-wrapper">

    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('New Subscription')) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.transaction.index')) !!}
    </div>

    <div class="card shadow-sm col-md-6">
        <div class="card-body py-sm-4">
            <form method="post" action="{{ route('admin.transaction.create') }}" enctype="multipart/form-data">
                @csrf
                <div class="p-sm-3">

                    <div class="form-group row @error('user_id') error @enderror">
                        <label class="col-sm-3 col-form-label required">{{ __('Member') }}</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="user_id" required>
                                <option value="" class="selected highlighted">Select One</option>
                                @foreach($members as $row)
                                    <option value="{{ $row->id }}" {{(old("user_id", $id) == $row->id) ? "selected" : ""}}>
                                        {{ ucwords($row->full_name) }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row @error('membership_id') error @enderror">
                        <label class="col-sm-3 col-form-label required">{{ __('Membership Type') }}</label>
                        <div class="col-sm-9">
                            <select id="memberType" class="form-control" name="membership_id" required >
                                <option value="" class="selected highlighted">Select One</option>
                                @foreach($membership_types as $key => $data)
                                    <option value="{{ $data->id }}" {{ (old("membership_id") == $data->id) ? "selected" : "" }} data-params="{{ $data->amount }}">
                                        {{ $data->type }}</option>
                                @endforeach
                            </select>
                            @error('membership_id')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row @error('amount') error @enderror">
                        <label class="col-sm-3 col-form-label required">{{ __('Amount') }} ({{ env('CURRENCY_SIGN') }})</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="amount" id="amount" step="0.01"
                                value="{{ old('amount', 0.00) }}" placeholder="{{ __('Write Amount') }}"
                                required readonly>
                            @error('amount')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row @error('note') error @enderror">
                        <label class="col-sm-3 col-form-label" for="note">{{ __('Notes') }}</label>
                        <div class="col-sm-9">
                            <textarea type="text" name="note" class="form-control"
                                placeholder="{{ __('Write Short Note') }}" rows="4">{{ old('note') }}</textarea>
                            @error('note')
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

@push('scripts')


<script type="text/javascript">

    $('#memberType').on('change', function() {
        var params = $(this).children(':selected').data('params');
        $("#amount").val(params);
    });

</script>
@endpush
