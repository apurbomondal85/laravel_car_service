@extends('admin.layouts.master')

@section('title', 'Transaction Report')

@section('content')

@php
    $user_role = App\Models\User::getAuthUser()->roles()->first();
    $hasPermission = $user_role->hasPermission('role_create');
@endphp

<div class="content-wrapper">

    <div class="content-header d-flex justify-content-between">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Transaction Report' )) }}</h4>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div id="filterArea" class="">
                <div class="row report" role="tablist" >

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-sm-4 col-4 col-form-label">{{ __('Start Date :') }}</label>
                            <div class="col-sm-8 col-8">
                                <div class="input-group">
                                    <input type="date" class="form-control " id="get_start" name="start" onchange="filterDate()"
                                        value="{{ old('start') }}" placeholder="{{ __('Start Date') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row @error('end') error @enderror">
                            <label class="col-sm-4 col-4 col-form-label">{{ __('End Date : ') }}</label>
                            <div class="col-sm-8 col-8">
                                <div class="input-group">
                                    <input type="date" class="form-control" name="end" id="get_end" value="{{ old('end') }}" onchange="filterDate()"
                                        placeholder="{{ __('End Date') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                                <label class="col-sm-4 col-4 col-form-label">{{ __('Type : ') }}</label>
                            <div class="col-sm-8 col-8">
                                <select class="form-control" name="type" id="get_type" onchange="filterDate()">
                                    <option value="4" class="selected highlighted"> All </option>

                                    @foreach(\App\Library\Enum::getPaymentType() as $key => $value)
                                        <option value="{{ $key }}" > {{ $value }} </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <input type="hidden" id="startDate" value="">
            <input type="hidden" id="endDate" value="">
            <input type="hidden" id="type" value="0">


            <table class="table transaction-data-table display nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Trx ID</th>
                        <th>User</th>
                        <th>Payment Method</th>
                        <th>Amount</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th>Action By</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>


@stop

@include('admin.assets.dt')
@include('admin.assets.dt-buttons')
@include('admin.assets.dt-buttons-export')

@push('scripts')

<script type="text/javascript">
    // For Tables Operation
    let columns = [
        {data: 'id', name: 'id'},
        {data: 'trx_id', name: 'trx_id'},
        {data: 'user_id', name: 'user_id'},
        {data: 'payment_method', name: 'payment_method'},
        {data: 'amount', name: 'amount'},
        {data: 'type', name: 'type'},
        {data: 'created_at', name: 'created_at'},
        {data: 'created_by', name: 'created_by'},
    ];

    let column_defs = [];

    let AddNewBtn = '';

    var table = $('.transaction-data-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        order: [[ 0 , "desc" ]],

        ajax: {
            url: "{{ route('admin.report.transaction') }}",
            data: function (d) {
                d.startDate     = $("#startDate").val()
                d.endDate       = $("#endDate").val()
                d.type          = $("#type").val()
            }
        },

        columns: columns,
        dom: 'Bfrtip',

        buttons: [
            'pageLength',
            {
                text : '<i class="fas fa-download"></i> Export',
                extend: 'collection',
                className: 'custom-html-collection pull-right',
                buttons: [
                    'pdf',
                    'csv',
                    'excel',
                ]
            },
            {
                html: colVisibility(columns, column_defs),
            },
        ],
        columnDefs: column_defs,
        language: {
            searchPlaceholder: "Search records",
            search: "",
            buttons: {
                pageLength: {
                    _: "%d rows",
                }
            }
        }
    });

    executeColVisibility(table);

    // End Tables

    // For Filtering
    function filterDate()
    {
        var startDateValue = $("#get_start").val();
        $("#startDate").val(startDateValue);

        var endDateValue = $("#get_end").val();
        $("#endDate").val(endDateValue);

        var getType = $("#get_type").val();
        $("#type").val(getType);

        table.ajax.reload();
    }

    </script>
@endpush
