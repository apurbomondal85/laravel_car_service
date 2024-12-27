@extends('admin.layouts.master')

@section('title', 'Transactions')

@section('content')

@php
    $user_role = App\Models\User::getAuthUser()->roles()->first();
    $hasPermission = $user_role->hasPermission('role_create');
@endphp

<div class="content-wrapper">

    <div class="content-header d-flex justify-content-between">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Transactions' )) }}</h4>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <div id="filterArea" class="d-inline-flex justify-content-start">
                <ul class="nav nav-pills nav-pills-success"  role="tablist" >
                    @php $pending_status = \App\Library\Enum::PAYMENT_METHOD_PENDING; @endphp
                    @foreach(\App\Library\Enum::getPaymentStatus() as $key => $value)
                        <li class="nav-item pb-2">
                            <a class="nav-link tab-menu {{ $pending_status == $key ? 'active' : '' }}" href="#" onclick="filterStatus({{ $key }})">{{ $value }}</a>
                        </li>
                    @endforeach

                </ul>
            </div>

            <input type="hidden" id="paymentStatus" value="{{ $pending_status }}">

            <table class="table transaction-table display nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Operator</th>
                        <th>Member Name</th>
                        <th>Payment Method</th>
                        <th>Transaction ID</th>
                        <th>Membership Type</th>
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
        {data: 'created_by', name: 'created_by'},
        {data: 'user_id', name: 'user_id'},
        {data: 'payment_method', name: 'payment_method'},
        {data: 'transaction_id', name: 'transaction_id'},
        {data: 'membershipType', name: 'membershipType'},
        {data: 'amount', name: 'amount'},
        {data: 'created_at', name: 'created_at'},
        {data: 'action', name: 'action', orderable: false, searchable: false, responsive:true},
    ];

    let column_defs = [];

    let AddNewBtn = '';

    AddNewBtn = '<a class="dt-button buttons-collection" href="{{ route('admin.transaction.create') }}"><i class="fas fa-plus"></i> Add New</a>';

    var table = $('.transaction-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        order: [[ 0 , "desc" ]],

        ajax: {
            url: "{{ route('admin.transaction.index') }}",
            data: function (d) {
                d.status    = $("#paymentStatus").val()
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
        if(status)
        {
            $("#paymentStatus").val(status);
        }
        table.ajax.reload();
    }
    // End Filtering

</script>

@endpush
