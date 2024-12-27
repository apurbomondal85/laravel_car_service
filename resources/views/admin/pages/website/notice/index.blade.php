@extends('admin.layouts.master')

@section('title', 'Notice')

@section('content')

@php
    $user_role = App\Models\User::getAuthUser()->roles()->first();
    $hasPermission = $user_role->hasPermission('role_create');
@endphp

<div class="content-wrapper">

    <div class="content-header d-flex justify-content-between">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Notice' )) }}</h4>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div id="filterArea" class="d-inline-flex justify-content-start">
                <ul class="nav nav-pills nav-pills-success"  role="tablist" >
                    @php $active_status = \App\Library\Enum::STATUS_ACTIVE; @endphp
                    @foreach(\App\Library\Enum::getStatus() as $key => $value)
                        <li class="nav-item">
                            <a class="nav-link tab-menu {{ $active_status == $key ? 'active' : '' }}" href="#" onclick="filterStatus({{ $key }})">{{ $value }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <input type="hidden" id="userStatus" value="{{ $active_status }}">

            <table class="table notice-table display nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Type</th>
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
        {data: 'notice_type', name: 'notice_type'},
        {data: 'action', name: 'action', orderable: false, searchable: false, responsive:true},
    ];

    let column_defs = [];

    let AddNewBtn = '';
    
    AddNewBtn = '<a class="dt-button buttons-collection" href="{{ route('admin.notice.create') }}"><i class="fas fa-plus"></i> Add New</a>';

    var table = $('.notice-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        order: [[ 0 , "desc" ]],

        ajax: {
            url: "{{ route('admin.notice.index') }}",
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
