@extends('admin.layouts.master')

@section('title', 'Transaction Details')

@section('content')

@php
    $user_role = App\Models\User::getAuthUser()->roles()->first();
@endphp

<div class="content-wrapper">
    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Transaction Details')) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.transaction.index')) !!}
    </div>

    <div class="row">

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">

                    <table class="table org-data-table table-bordered show-table">
                        <tbody>
                            <tr>
                                <td>ID</td>
                                <td> {{ $transaction->id }} </td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>
                                    @if($transaction->status == \App\Library\Enum::PAYMENT_METHOD_PENDING)
                                        <span class="badge btn-primary">Pending</span>
                                    @elseif($transaction->status == \App\Library\Enum::PAYMENT_METHOD_PROCESSING)
                                        <span class="badge btn-info">Processing</span>
                                    @elseif($transaction->status == \App\Library\Enum::PAYMENT_METHOD_HOLD)
                                        <span class="badge btn-warning">Hold</span>
                                    @elseif($transaction->status == \App\Library\Enum::PAYMENT_METHOD_COMPLETED)
                                        <span class="badge btn-success">Completed</span>
                                    @elseif($transaction->status == \App\Library\Enum::PAYMENT_METHOD_DECLINED)
                                        <span class="badge btn-danger">Declined</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Date & Time</td>
                                <td> {{ $transaction->created_at->format('d-m-Y H:i A') }} </td>
                            </tr>
                            <tr>
                                <td>Member</td>
                                <td> {{ $transaction->member->full_name }} </td>
                            </tr>
                            <tr>
                                <td>Membership Type</td>
                                <td> {{ $transaction->membership?->type }} </td>
                            </tr>
                            @if($transaction->transaction_id)
                            <tr>
                                <td>Transaction ID</td>
                                <td> {{ $transaction->transaction_id }} </td>
                            </tr>
                            @endif
                            @if($transaction->membership_expired_at)
                            <tr>
                                <td>Membership Expired</td>
                                <td> {{ $transaction->membership_expired_at }} </td>
                            </tr>
                            @endif
                            <tr>
                                <td>Amount</td>
                                <td> {{ env('CURRENCY_SIGN')}}{{ $transaction->amount }} </td>
                            </tr>
                            <tr>
                                <td>Payment Method</td>
                                <td> {{ ucwords($transaction->payment_method) }} </td>
                            </tr>
                            <tr>
                                <td>Operator</td>
                                <td> {{ $transaction->user?->full_name }} </td>
                            </tr>
                            <tr>
                                <td>Notes</td>
                                <td> {{ $transaction->note }} </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card shadow-sm">
                <div class="card-header bg-light-secondary">
                    <span><i class="fas fa-cog"></i> {{ __('Actions') }} </span>
                </div>

                <div class="card-body py-4">
                    <div class="text-left">
                        <button class="btn btn-block btn-sm mb-3 btn2-light-secondary w-100" onclick="clickChangeStatus()"
                            {{ $transaction->status == \App\Library\Enum::PAYMENT_METHOD_COMPLETED ? 'disabled' : '' }}>
                            <i class="fas fa-power-off"></i> Change Status
                        </button>
                        <button class="btn btn-sm btn-block btn-danger w-100"
                            {{ $transaction->status == \App\Library\Enum::PAYMENT_METHOD_COMPLETED ? 'disabled' : '' }}
                            onclick="confirmFormModal('{{ route('admin.transaction.delete.api', $transaction->id) }}', 'Confirmation', 'Are you sure to delete operation?')">
                            <i class="fas fa-trash-alt"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<!-- Update Status Modal -->
<div class="modal fade" id="changeStatusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{ route('admin.transaction.change_status.api',$transaction->id) }}" enctype="multipart/form-data" id="updateStatusForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <select class="form-control" name="status" required>
                            <option value="" class="selected highlighted disabled">Select One</option>
                            @foreach(\App\Library\Enum::getPaymentStatus() as $key => $value)
                                <option value="{{ $key }}" {{ (old("status", $transaction->status) == $key) ? "selected" : ($key == \App\Library\Enum::PAYMENT_METHOD_PENDING ? "disabled" : "") }}>
                                    {{ ucwords($value) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-0" >
                        <textarea name="note" type="text" class="form-control" placeholder="Notes"></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn2-secondary"><i class="fas fa-save"></i> Save </button>
                </div>
            </div>
        </form>
    </div>
</div>

@stop


@push('scripts')
<script>
    function clickChangeStatus() {
        $("#changeStatusModal").modal('show');
    }
</script>
@endpush
