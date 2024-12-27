@extends('admin.layouts.master')

@section('title', 'Thank You')

@section('content')

@php
    $user_role = App\Models\User::getAuthUser()->roles()->first();
    $hasPermission = $user_role->hasPermission('role_create');
@endphp

<div class="content-wrapper">

    <div class="content-header d-flex justify-content-between">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Thank You' )) }}</h4>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div id="filterArea" class="d-inline-flex justify-content-start">
                <ul class="nav nav-pills nav-pills-success" role="tablist" >
                    @php $active_status = \App\Library\Enum::STATUS_ACTIVE; @endphp
                    @foreach(\App\Library\Enum::getStatus() as $key => $value)
                        <li class="nav-item">
                            <a class="nav-link tab-menu {{ $active_status == $key ? 'active' : '' }}" href="#" onclick="filterStatus({{ $key }})">{{ $value }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <input type="hidden" id="userStatus" value="{{ $active_status }}">
            <input type="hidden" id="isDeleted" value="0">


            <table class="table blog-table display nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Contact Person</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Amount</th>
                        <th width="100px">Action</th>
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
        {data: 'title', name: 'title'},
        {data: 'contact_person', name: 'contact_person'},
        {data: 'start_date', name: 'start_date'},
        {data: 'end_date', name: 'end_date'},
        {data: 'amount', name: 'amount'},
        {data: 'action', name: 'action', orderable: false, searchable: false, responsive:true},
    ];

    let column_defs = [];

    let AddNewBtn = '';

    AddNewBtn = '<a class="dt-button buttons-collection" href="{{ route('admin.thanks.create') }}"><i class="fas fa-plus"></i> Add New</a>';

    var table = $('.blog-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        order: [[ 0 , "desc" ]],

        ajax: {
            url: "{{ route('admin.thanks.index') }}",
            data: function (d) {
                d.status    = $("#userStatus").val()
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
    function filterStatus(status)
    {
        $("#userStatus").val(status);
        table.ajax.reload();
    }
    // End Filtering

</script>

@endpush
