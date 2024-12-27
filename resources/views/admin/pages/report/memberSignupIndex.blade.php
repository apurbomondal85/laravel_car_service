@extends('admin.layouts.master')

@section('title', 'Member Signup Report')

@section('content')

@php
    $user_role = App\Models\User::getAuthUser()->roles()->first();
    $hasPermission = $user_role->hasPermission('role_create');
@endphp

<div class="content-wrapper">

    <div class="content-header d-flex justify-content-between">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Member Signup Report' )) }}</h4>
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

                </div>
            </div>

            <input type="hidden" id="startDate" value="">
            <input type="hidden" id="endDate" value="">


            <table class="table membership-status-data-table display nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Signup Date</th>
                        <th>Expire Date</th>
                        <th>Status</th>
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
        {data: 'signup_date', name: 'signup_date'},
        {data: 'membership_expired_at', name: 'membership_expired_at'},
        {data: 'status', name: 'status'},
    ];

    let column_defs = [];

    let AddNewBtn = '';

    var table = $('.membership-status-data-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        order: [[ 0 , "desc" ]],

        ajax: {
            url: "{{ route('admin.report.memberSignup') }}",
            data: function (d) {
                d.startDate     = $("#startDate").val()
                d.endDate       = $("#endDate").val()
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

        table.ajax.reload();
    }

    </script>
@endpush
