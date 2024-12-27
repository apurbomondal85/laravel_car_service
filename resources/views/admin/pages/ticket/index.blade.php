@extends('admin.layouts.master')

@section('title', __('Support Tickets'))

@section('content')

<div class="content-wrapper">

    @php
        $user_role = App\Models\User::getAuthUser()->roles()->first();
        $hasPermission = $user_role->hasPermission('ticket_create');
    @endphp

    <div class="content-header d-flex justify-content-between">
        <div class="d-block">
            <h4 class="content-title">{{ __('SUPPORT TICKETS' )}}</h4>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <div id="filterArea" class="d-inline-flex justify-content-start">
                <ul class="nav nav-pills nav-pills-success" id="pills-tab" role="tablist" >
                    @php $active_status = \App\Library\Enum::TICKET_STATUS_OPEN; @endphp
                    @foreach(\App\Library\Enum::getTicketStatus() as $key => $value)
                        <li class="nav-item">
                            <a class="nav-link tab-menu {{$key == \App\Library\Enum::TICKET_STATUS_OPEN ? 'active' : ''}}" href="#" onclick="filterStatus('{{$key}}')">{{$value}}
                        <b>({{ $count_total[$key] }})</b></a>
                        </li>
                    @endforeach
                </ul>
                <input type="hidden" id="ticketStatus" value="{{ $active_status }}">
            </div>

            <table id="dataTable" class="table table-bordered ticket-data-table">
                <thead>
                    <tr>
                        <th width="50px">No</th>
                        <th>Name</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Last Reply</th>
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
    // Handle Datatables
    let columns = [
            {
                data: 'id',
                name: 'id'
            },
            {
                data: 'full_name',
                name: 'full name'
            },
            {
                data: 'priority',
                name: 'priority'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'last-reply',
                name: 'last reply'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                responsive:true
            },
    ];

    let column_defs = [
        {
            targets: 4,
            visible: false
        }
    ];

    let AddNewBtn = '';

    if ({{ $hasPermission }}) {
        AddNewBtn = '<a class="dt-button buttons-collection" href="{{ route('admin.ticket.create') }}"><i class="fas fa-plus"></i> Add New</a>';
    }

    var table = $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,

        ajax: {
            url: "{{ route('admin.ticket.index') }}",
            data: function (d) {
                d.status = $("#ticketStatus").val()
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
            {
                html: AddNewBtn,
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

    function filterStatus(status = '') {
        $("#ticketStatus").val(status)
        table.ajax.reload();
    }
</script>

@endpush
