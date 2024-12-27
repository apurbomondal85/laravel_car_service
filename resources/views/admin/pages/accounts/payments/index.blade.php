@extends('admin.layouts.master')

@section('title', 'Payments')

@section('content')

@php
    $user_role = App\Models\User::getAuthUser()->roles()->first();
    $hasPermission = $user_role->hasPermission('role_create');
@endphp

<div class="content-wrapper">

    <div class="content-header d-flex justify-content-between">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Payments' )) }}</h4>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table payment-table display nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Trx ID</th>
                        <th>Member Name</th>
                        <th>Member Type</th>
                        <th>Payment Method</th>
                        <th>Amount</th>
                        <th>Payment Type</th>
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
        {data: 'trx_id', name: 'trx_id'},
        {data: 'user_id', name: 'user_id'},
        {data: 'member_type', name: 'member_type'},
        {data: 'payment_method', name: 'payment_method'},
        {data: 'amount', name: 'amount'},
        {data: 'type', name: 'type'},
        {data: 'created_at', name: 'created_at'},
    ];

    let column_defs = [];

    var table = $('.payment-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        order: [[ 0 , "desc" ]],

        ajax: {
            url: "{{ route('admin.payment.index') }}"
        },

        columns: columns,
        dom: 'Bfrtip',

        buttons: [
            'pageLength',
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

</script>

@endpush
