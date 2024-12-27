@extends('admin.layouts.master')

@section('title', 'Committee')

@section('content')


<div class="content-wrapper">

    <div class="content-header d-flex justify-content-between">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Committee' )) }}</h4>
        </div>
    </div>
    <div class="card shadow-sm">
        <div class="card-body">
            <table id="dataTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Year</th>
                        <th>Current Team</th>
                        <th>Created At</th>
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
        {
            data: 'id',
            name: 'id',
        },
        {
            data: 'name',
            name: 'name'
        },
        {
            data: 'year',
            name: 'year'
        },
        {
            data: 'is_current',
            name: 'is_current',
        },
        {
            data: 'created_at',
            name: 'created_at',
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
        },
        {
            targets: 3,
            visible: true
        },
        {"className": "text-center", "targets": [0,2,3,4,5]}
    ];

    let AddNewBtn = '';


    AddNewBtn = '<a class="dt-button buttons-collection" href="{{ route('admin.committee.create') }}"><i class="fas fa-plus"></i> Add New</a>';


    var table = $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,

        order: [[ 0 , "desc" ]],

        ajax: {
            url: "{{ route('admin.committee.index') }}",
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
    // End Filtering
</script>

<script type="text/javascript">
window.changePrimary = function (e, route)
{
    e.preventDefault();
    confirmFormModal(route, 'Confirmation', 'Are you sure to set Current Committee? Other Committee will be secondary by default. ');
}
</script>

@endpush
