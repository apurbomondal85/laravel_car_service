@extends('admin.layouts.master')

@section('title', 'Payment Hitory')

@section('content')

<div class="content-wrapper">

    <div class="content-header d-flex justify-content-between">
        <div class="d-block">
            <h4 class="content-title">{{ __('Payment Hitory' )}}</h4>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">

                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label>{{ __('Campain') }}</label>
                            <select name="camp_id" class="form-control js-example-basic-single" id="camp_id">
                                <option selected disabled>Select One</option>
                                @foreach($campains as $key => $campain)
                                <option value="{{ $campain->id }}"
                                    {{ (old('camp_id') == $campain->id) ? "selected" : "" }}>
                                    {{ $campain->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-sm-4">
                            <label>{{ __('Donors') }}</label>
                            <select name="donor_id" class="form-control js-example-basic-single" id="donor_id">
                                <option selected disabled>Select One</option>
                                @foreach($donors as $key => $donor)
                                <option value="{{ $donor->user?->id }}"
                                    {{ (old('donor_id') == $donor->id) ? "selected" : "" }}>
                                    {{ $donor->user?->getFullNameAttribute() }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-sm-4">
                            <label>{{ __('Type') }}</label>
                            <select name="type" class="form-control js-example-basic-single" id="type">
                                <option selected disabled>Select One</option>
                                @foreach($payment_types as $key => $payment_type)
                                <option value="{{ $payment_type }}"
                                    {{ (old('type') == $payment_type) ? "selected" : "" }}>
                                    {{ $payment_type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3 shadow-sm">
        <div class="card-body">
            <table class="table table-bordered role-data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>TRX ID</th>
                        <th>Organization</th>
                        <th>Campain</th>
                        <th>Donor</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Commission</th>
                        <th>Is Recurrent</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="6" style="text-align:right">Total:</th>
                        <th><span id="amount"></span> <span id="totalAmount"></span></th>
                        <th><span id="commission"></span> <span id="totalcommission"></span></th>
                        <th id="total"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@stop
@include('admin.assets.dt')

@push('scripts')
<script type="text/javascript">
 
    var PaymentTable = $('.role-data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('admin.payment.index') }}",
            data: function (d) {
                d.camp_id = $("#camp_id").val(),
                d.donor_id = $("#donor_id").val(),
                d.type = $("#type").val()
            },
        },
       
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'trx_id',
                name: 'trx_id'
            },
            {
                data: 'org_name',
                name: 'org_name'
            },
            {
                data: 'campaign',
                name: 'campaign'
            },
            {
                data: 'donor_name',
                name: 'donor_name'
            },
            {
                data: 'type',
                name: 'type'
            },
            {
                data: 'amount',
                name: 'amount'
            },
            {
                data: 'commission',
                name: 'commission'
            },
            {
                data: 'is_recurrent',
                name: 'is_recurrent'
            }, 
        ],
        
        footerCallback: function (row, data, start, end, display) {
            var api = this.api();
 
            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
            };

            // Total over this page
            pageTotalCol6 = api
                .column(6, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Total over this page
            pageTotalCol7 = api
                .column(7, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                
            // Update footer
            $("#amount").html( pageTotalCol6 );
            $("#commission").html( pageTotalCol7 );
        },
        drawCallback: function () {
            $("#totalAmount").html('( Total: '+ this.api().ajax.json().amountSum +' )');
            $("#totalcommission").html('( Total: '+ this.api().ajax.json().commissionSum +' )');
        }
       
    });
    $('#total_order').html({data:'total'});
    $("#camp_id, #donor_id, #type").on('change', function () {
        PaymentTable.ajax.reload()
    });

</script>

@endpush