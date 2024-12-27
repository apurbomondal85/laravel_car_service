@extends('admin.layouts.master')

@section('title', 'Business Details')

<style>
    .disabled-link {
        pointer-events: none;
        opacity: 0.65;
    }
</style>

@section('content')

@php
    $user_role = App\Models\User::getAuthUser()->roles()->first();
@endphp

<div class="content-wrapper">
    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Business Details')) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.business.index')) !!}
    </div>

    <div class="row">

        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-body">

                    <div class="border-bottom text-center pb-2">
                        <img src="{{ $business->getBusinessLogo() }}" alt="profile" class="img-lg rounded-circle mb-3">
                        <div class="mb-3">
                            <h3>{{ $business->title }} </h3>
                        </div>
                        <p class="mx-auto mb-2 w-75">{{ $business->description }}</p>
                    </div>
                    <table class="table org-data-table table-bordered show-table">
                        <tbody>
                            <tr>
                                <td>Status</td>
                                <td>
                                    <span class="badge {{ $business->is_active ? "btn2-secondary" : "btn-secondary" }}">
                                        {{ $business->is_active ? "Active" : "Inactive" }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Type</td>
                                <td> {{ ucwords($business->business_type) }} </td>
                            </tr>
                            <tr>
                                <td>Contact Person</td>
                                <td> {{ $business->contact_person }} </td>
                            </tr>
                            <tr>
                                <td>Company URL</td>
                                <td>
                                    <a href="{{ $business->url }}" target="_blank"> {{ $business->url }}</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Start Date</td>
                                <td> {{ $business->start_date }} </td>
                            </tr>
                            <tr>
                                <td>End Date</td>
                                <td> {{ $business->end_date }} </td>
                            </tr>
                            <tr>
                                <td>Ranking</td>
                                <td>
                                    @foreach($ranking as $key => $value)
                                        @if($key == $business->ranking)
                                            <span class="badge btn2-light-secondary">{{ $value }} </span>
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td>Amount</td>
                                <td>
                                    <span class="badge btn2-light-secondary">{{ env('CURRENCY_SIGN') }}{{ $business->amount }} </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Payment Status</td>
                                <td>
                                    <span class="badge {{ $business->is_payment ? "btn2-secondary" : "btn-danger" }}">
                                        {{ $business->is_payment ? "Paid" : "Pending" }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 30%;">Payment Note</td>
                                <td> {{ $business->user?->nick_name }} </td>
                            </tr>
                            <tr>
                                <td style="width: 30%;">Operator</td>
                                <td> {{ $business->note }} </td>
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

                        @if($user_role->hasPermission('business_change_status'))
                            <button class="btn btn-block btn-sm mb-1 {{ $business->is_active ? 'btn-secondary' : 'btn2-secondary' }}" {{ $business->is_payment ? 'disabled' : '' }}
                                onclick="confirmFormModal('{{ route('admin.business.change_status.api', $business->id) }}', 'Confirmation', 'Are you sure to change status?')">
                                <i class="fas fa-power-off"></i> {{ $business->is_active ? 'Make Inactive' : 'Make Active' }}
                            </button>
                        @endif

                        @if($user_role->hasPermission('business_update'))
                            <a href="{{ route('admin.business.update', $business->id) }}" class="btn btn-block  btn-sm btn-warning mr-1 {{ !$business->is_payment ? '' : 'disabled-link' }}">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        @endif

                        @if($user_role->hasPermission('business_confirm_payment'))
                            <button class="btn btn-sm btn-block btn-info" {{ !$business->is_payment ? '' : 'disabled' }} {{ $business->is_active ? '' : 'disabled' }}
                                onclick="confirmFormModal('{{ route('admin.business.payment.api', $business->id) }}', 'Confirmation', 'Are you sure to confirm payment operation? If once you confirm payment all actions will be disabled this business post.')">
                                <i class="fas fa-check"></i> Confirm Payment
                            </button>
                        @endif

                        @if($user_role->hasPermission('business_delete'))
                            <button class="btn btn-sm btn-block btn-danger" {{ $business->is_payment ? 'disabled' : '' }}
                                onclick="confirmFormModal('{{ route('admin.business.delete.api', $business->id) }}', 'Confirmation', 'Are you sure to delete operation?')">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@stop


@push('scripts')
<script>
    function clickChangeStatus() {
        $(changeStatusModal).modal('show');
    }
</script>
@endpush
