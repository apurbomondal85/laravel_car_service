@extends('admin.layouts.master')

@section('title', 'Asset Report')

@section('content')

@php
    $user_role = App\Models\User::getAuthUser()->roles()->first();
    $hasPermission = $user_role->hasPermission('role_create');
@endphp

<div class="content-wrapper">

    <div class="content-header d-flex justify-content-between">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Asset Report' )) }}</h4>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div id="filterArea" class="">
                <div class="row report"  role="tablist" >

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
                                <label class="col-sm-4 col-4 col-form-label">{{ __('Status : ') }}</label>
                            <div class="col-sm-8 col-8">
                                <select class="form-control" name="status" id="get_status" onchange="filterDate()">
                                <option value="3" class="selected highlighted"> All </option>
                                @php $pending_status = \App\Library\Enum::ASSET_GOOD; @endphp

                                @foreach(\App\Library\Enum::getAssetStatus() as $key => $value)
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
            <input type="hidden" id="status" value="3">


            <table class="table asset-data-table display nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Stock</th>
                        <th>Date</th>
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

@push('scripts')

<script type="text/javascript">
    // For Tables Operation
    let columns = [
        {data: 'id', name: 'id'},
        {data: 'name', name: 'name'},
        {data: 'asset_type', name: 'asset_type'},
        {data: 'quantity', name: 'quantity'},
        {data: 'price', name: 'price'},
        {data: 'total', name: 'total'},
        {data: 'stock', name: 'stock'},
        {data: 'purchased_date', name: 'purchased_date'},
    ];

    let column_defs = [];

    let AddNewBtn = '';

    var table = $('.asset-data-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        order: [[ 0 , "desc" ]],

        ajax: {
            url: "{{ route('admin.report.asset') }}",
            data: function (d) {
                d.startDate     = $("#startDate").val()
                d.endDate       = $("#endDate").val()
                d.status        = $("#status").val()
            }
        },

        columns: columns,
        dom: 'Bfrtip',

        buttons: [
            'pageLength',
            {
                html: colVisibility(columns, column_defs),
            },
            {
                html: AddNewBtn
            }
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
        var startDateValue  =   $("#get_start").val();
        $("#startDate").val(startDateValue);

        var endDateValue    =   $("#get_end").val();
        $("#endDate").val(endDateValue);

        var getStatus       =   $("#get_status").val();
        $("#status").val(getStatus);

        table.ajax.reload();
    }

    </script>
@endpush
