@extends('admin.layouts.master')

@section('title', 'Notifications')

@section('content')

@php
    $user_role = App\Models\User::getAuthUser()->roles()->first();
    $hasPermission = $user_role->hasPermission('notification_create');
@endphp


<div class="content-wrapper">

    <div class="content-header d-flex justify-content-between">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Notifications' )) }}</h4>
        </div>
    </div>
    <div class="card shadow-sm">
        <div class="card-body">

            <div id="filterArea" class="d-inline-flex justify-content-start">
                <ul class="nav nav-pills nav-pills-success" role="tablist">
                    <li class="nav-item">
                        <div class="form-check form-check-secondary mr-5">
                            <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" id="is_for_emp" value="is_for_emp">
                                Employee
                            <i class="input-helper"></i></label>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="form-check form-check-secondary mr-5">
                            <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" id="is_for_member" value="is_for_member">
                                Members
                            <i class="input-helper"></i></label>
                        </div>
                    </li>
                </ul>
            </div>

            <table id="dataTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Message</th>
                        <th>Type</th>
                        <th>For Employees</th>
                        <th>For Members</th>
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
        {
            data: 'id',
            name: 'id'
        },
        {
            data: 'message',
            name: 'message'
        },
        {
            data: 'type',
            name: 'type'
        },
        {
            data: 'employee',
            name: 'employee',
        },
        {
            data: 'donor',
            name: 'donor',
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
            targets: 2,
            visible: true
        }
    ];

    let AddNewBtn = '';

    if ({{ $hasPermission }}) {
        AddNewBtn = '<a class="dt-button buttons-collection" href="{{ route('admin.notification.create') }}"><i class="fas fa-plus"></i> Add New</a>';
    }

    var table = $('#dataTable').DataTable({
        order: [[0, 'desc']],
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {
            url: "{{ route('admin.notification.index') }}",
            data: function (d) {
                d.is_for_emp = $('#is_for_emp:checked').val(),
                d.is_for_donor = $('#is_for_donor:checked').val(),
                d.is_for_org = $('#is_for_org:checked').val()
            },
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
    $("#is_for_emp, #is_for_donor, #is_for_org").on('change', function () {
        table.ajax.reload()
    });

    // For Delete
    function deleteNotification(id)
    {
        loading('show');
        let base_url = getBaseUrl();
        const url = base_url + '/notifications/' + id + '/delete-api';
        axios.post(url)
        .then(response => {
            notify(response.data.message, 'success');
            table.ajax.reload();
        })
        .catch(error => {
            const response = error.response;
            if (response)
                notify(response.data.message, 'error');
        })
        .finally(() => {
            loading('hide');
        });
    }

</script>

@endpush
