@extends('admin.layouts.master')

@section('title', 'General Expenses')

@section('content')

@php
    $user_role = App\Models\User::getAuthUser()->roles()->first();
    $hasPermission = $user_role->hasPermission('role_create');
@endphp

<div class="content-wrapper">

    <div class="content-header d-flex justify-content-between">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('General Expenses' )) }}</h4>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table expense-table display nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Types of Expense</th>
                        <th>Amount</th>
                        <th>Date</th>
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
        {data: 'expense_type', name: 'expense_type'},
        {data: 'amount', name: 'amount'},
        {data: 'date', name: 'date'},
        {data: 'action', name: 'action', orderable: false, searchable: false, responsive:true},
    ];

    let column_defs = [];

    let AddNewBtn = '';
    
    AddNewBtn = '<a class="dt-button buttons-collection" href="{{ route('admin.expense.create') }}"><i class="fas fa-plus"></i> Add New</a>';

    var table = $('.expense-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        order: [[ 0 , "desc" ]],

        ajax: {
            url: "{{ route('admin.expense.index') }}"
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

</script>

@endpush
