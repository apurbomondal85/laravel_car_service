@extends('admin.layouts.master')

@section('title', __('New Ticket'))

@section('content')
<div class="content-wrapper">
    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('New Ticket')) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.ticket.index')) !!}
    </div>

    <div class="card">
        <div class="card-body py-sm-4">
            <form method="post"  action="{{ route('admin.ticket.create') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="p-sm-3">

                            <div class="form-group row @error('department') error @enderror">
                                <label class="col-sm-3 col-form-label required">{{ __('Department') }}</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="department" required>
                                        <option value="" class="selected highlighted">Select Department</option>
                                        @foreach($departments as $value)
                                            <option value="{{ $value }}" {{(old("department") == $value) ? "selected" : ""}}>
                                                {{ ucwords($value) }}</option>
                                        @endforeach
                                    </select>
                                    @error('department')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row @error('priority') error @enderror">
                                <label class="col-sm-3 col-form-label required">{{ __('Priority') }}</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="priority" required>
                                        <option value="" class="selected highlighted">Select Priority</option>
                                        @foreach(\App\Library\Enum::getTicketPriority() as $index => $value)
                                            <option value="{{ $index }}" {{(old("priority") == $index) ? "selected" : ""}}>
                                                {{ ucwords($value) }}</option>
                                        @endforeach
                                    </select>
                                    @error('priority')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group member-select row @error('priority') error @enderror">
                                <label class="col-sm-3 col-form-label required">{{ __('Member') }}</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="user_id" id="member">
                                        <option value="" class="selected highlighted">Select One</option>
                                        @foreach($members as $member)
                                            <option value="{{ $member->id }}"
                                                {{(old("user_id") == $member->id) ? "selected" : ""}}>
                                                {{ $member->getFullNameAttribute() }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-sm-3">

                            <div class="form-group row @error('subject') error @enderror">
                                <label class="col-sm-3 col-form-label required">{{ __('Subject') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="subject" value="{{ old('subject') }}"
                                           placeholder="{{ __('Ticket Subject') }}" required>
                                    @error('subject')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row @error('message') error @enderror">
                                <label class="col-sm-3 col-form-label required">{{ __('Message') }}</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="exampleTextarea1" name="message" rows="8" placeholder="Ticket Message">{{ old('message') }}</textarea>
                                    @error('message')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row @error('attachment') error @enderror">
                                <label class="col-sm-3 col-form-label">Attachment</label>
                                <div class="col-sm-9">
                                    <div class="file-upload-section">
                                        <input name="attachment" type="file" class="form-control d-none" allowed="*">
                                        <div class="input-group col-xs-12">
                                            <input type="text" id="file_name" class="form-control file-upload-info" disabled="" readonly placeholder="Upload attachment file">
                                            <span class="input-group-append">
                                              <button class="file-upload-browse btn btn-outline-secondary" type="button"><i class="fas fa-upload"></i> Browse</button>
                                            </span>
                                        </div>
                                    </div>
                                    @error('attachment')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
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
@include('admin.assets.select2')

@push('scripts')
<script>
    function showDonor()
    {
        $('.organization-select').hide();
        $('.donor-select').show();
        $('#operator_id').val('');
        $('#org_id').val('');
    }

    function showOrg()
    {
        $('.organization-select').show();
        $('.donor-select').hide();
        $("#donor option").prop("selected", false);
    }

    let ticket_for = parseInt('{{ old('ticket_for') }}');

    if( isNaN(ticket_for) || ticket_for == 0){
        showDonor();
    }
    else {
        showOrg();
    }
    // Ticket For Donor or Organization
    $("input[name='ticket_for']").change(function () {
        if ($(this).val() == 1)
            showOrg();
        else
            showDonor();
    });

    // Select2
    $('select[name="org_id"]').select2();

    $('#org_id').change(function () {
        var org_id = $(this).val();
        let base_url = getBaseUrl();
        const url = base_url + '/organizations/' + org_id + '/operators-api';
        axios.get(url)
            .then(response => {
                let operators = response.data.data;
                $('select[name="operator_id"]').html('<option value="">Select One</option>');
                let options = '';
                for (let i = 0; i < operators.length; i++) {
                    let m_name = operators[i].m_name ? ' ' + operators[i].m_name + ' ' : ' ';
                    options += '<option value="' + operators[i].id + '"> ' + operators[i].f_name + m_name + operators[i]
                        .l_name +
                        ' </option>';
                }
                $('select[name="operator_id"]').append(options);
            })
            .catch(error => {
                const response = error.response;
                if (response) {
                    if (response.status === 404)
                        notify('Not found', 'error');
                    else
                        notify(response.data.message, 'error');
                }
            })
            .finally(() => {

            });
    });
</script>
@endpush
