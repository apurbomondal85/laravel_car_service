@extends('admin.layouts.master')

@section('title', 'Subscribers')

@section('content')

@php
$user_role = App\Models\User::getAuthUser()->roles()->first();
$hasPermission = $user_role->hasPermission('role_create');
@endphp

<div class="content-wrapper">
    <div class="content-header d-flex justify-content-between">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Subscribers' )) }}</h4>
        </div>
    </div>
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table subscribers-table display nowrap" id="subscribersTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
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
@include('admin.assets.dt-buttons-export')

@push('scripts')

<script type="text/javascript">
    // For Tables Operation
    let columns = [
        {data: 'id', name: 'id'},
        {data: 'name', name: 'name'},
        {data: 'email', name: 'email'},
        {data: 'mobile', name: 'mobile'},
        {data: 'action', name: 'action', orderable: false, searchable: false, responsive:true},
    ];

    let column_defs = [
        { targets: 3, visible: true },
        { className: "text-center", targets: [4] },
    ];

    var table = $('.subscribers-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        order: [[ 0 , "desc" ]],

        ajax: {
            url: "{{ route('admin.subscribers.index') }}",
            data: function (d) {
                d.status    = $("#userStatus").val()
                d.is_deleted = $("#isDeleted").val()
            }
        },

        columns: columns,
        dom: 'Bfrtip',

        buttons: [
            "pageLength",
                {
                    text: '<i class="fas fa-download"></i> Export',
                    extend: "collection",
                    className: "custom-html-collection pull-right",
                    buttons: ["pdf", "csv", "excel"],
                },
                {
                    html: colVisibility('#subscribersTable', column_defs),
                },
                {
                    html: '<a class="dt-button buttons-collection" href="{{ route('admin.subscribers.create') }}"><i class="fas fa-plus"></i> Add New</a>',
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
    function filterStatus(status, type = '')
    {
        if(type == 'is_deleted')
        {
            $("#isDeleted").val(1);
        }
        else{
            $("#userStatus").val(status);
            $("#isDeleted").val(0);
        }
        table.ajax.reload();
    }
    // End Filtering

</script>
<script type="text/javascript">
    window.changeStatus = function (e, route)
    {
        e.preventDefault();
        confirmFormModal(route, 'Confirmation', 'Are you sure to change the status?');
    }
</script>
@endpush
