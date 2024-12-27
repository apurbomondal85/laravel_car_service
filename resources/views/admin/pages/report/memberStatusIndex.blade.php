@extends('admin.layouts.master')

@section('title', 'Membership Status Report')

@section('content')

@php
    $user_role = App\Models\User::getAuthUser()->roles()->first();
    $hasPermission = $user_role->hasPermission('role_create');
@endphp

<div class="content-wrapper">

    <div class="content-header d-flex justify-content-between">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Membership Status Report' )) }}</h4>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div id="filterArea" class="">
                <div class="row report" role="tablist" >

                    <div class="col-md-3">
                        <div class="form-group row">
                                <label class="col-sm-4 col-4 col-form-label">{{ __('Select Status : ') }}</label>
                            <div class="col-sm-8 col-8">
                                <select class="form-control" name="status" id="get_status" onchange="filterDate()">
                                    <option value="4" class="selected highlighted"> Select Status </option>

                                    @foreach(\App\Library\Enum::getUserStatus() as $key => $value)
                                        <option value="{{ $key }}" > {{ $value }} </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row @error('end') error @enderror">
                            <label class="col-sm-4 col-4 col-form-label">{{ __('Select Date : ') }}</label>
                            <div class="col-sm-8 col-8">
                                <div class="input-group">
                                    <input type="date" class="form-control" name="date" id="get_date" value="{{ old('date') }}" onchange="filterDate()"
                                        placeholder="{{ __('Select Date') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <input type="hidden" id="status" value="4">
            <input type="hidden" id="date" value="">


            <table class="table membership-status-data-table display nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Payment Date</th>
                        <th>Amount</th>
                        <th>Expire Date</th>
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
        {data: 'unique_id', name: 'unique_id'},
        {data: 'nick_name', name: 'nick_name'},
        {data: 'mobile', name: 'mobile'},
        {data: 'email', name: 'email'},
        {data: 'member_type', name: 'member_type'},
        {data: 'created_at', name: 'created_at'},
        {data: 'amount', name: 'amount'},
        {data: 'membership_expired_at', name: 'membership_expired_at'},
        {data: 'created_by', name: 'created_by'},
    ];

    let column_defs = [];

    let AddNewBtn = '';

    var table = $('.membership-status-data-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        order: [[ 0 , "desc" ]],

        ajax: {
            url: "{{ route('admin.report.memberStatus') }}",
            data: function (d) {
                d.status   = $("#status").val()
                d.date     = $("#date").val()
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
        var getStatus = $("#get_status").val();
        $("#status").val(getStatus);

        var getDate = $("#get_date").val();
        $("#date").val(getDate);

        table.ajax.reload();
    }

    </script>
@endpush
