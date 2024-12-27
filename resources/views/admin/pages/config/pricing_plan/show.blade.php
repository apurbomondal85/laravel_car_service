@extends('admin.layouts.master')

@section('title', 'Pricing Plan Details')

@section('content')

@php
    $user_role = App\Models\User::getAuthUser()->roles()->first();
@endphp

<div class="content-wrapper">
    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Pricing Plan Details')) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.pricing_plan.index')) !!}
    </div>

    <div class="row">

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">

                    <table class="table org-data-table table-bordered show-table">
                        <tbody>
                            <tr>
                                <td>Is Active</td>
                                <td>
                                    <span class="badge {{ $pricingPlan->is_active ? "btn2-secondary" : "btn-secondary" }}">
                                        {{ $pricingPlan->is_active ? "Active" : "Inactive" }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Is Featured</td>
                                <td>
                                    <span class="badge {{ $pricingPlan->is_featured ? "btn2-secondary" : "btn-secondary" }}">
                                        {{ $pricingPlan->is_featured ? "Yes" : "No" }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td> {{ ucwords($pricingPlan->name) }} </td>
                            </tr>
                            <tr>
                                <td>Price</td>
                                <td> {{ $pricingPlan->price }} </td>
                            </tr>
                            <tr>
                                <td>Operator</td>
                                <td> {{ $pricingPlan->operator?->full_name }} </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="text-center my-4">

                        @if($user_role->hasPermission('pricing_plan_change_status'))
                            <button class="btn btn-sm mr-1 {{ $pricingPlan->is_active ? 'btn-secondary' : 'btn2-secondary' }}"
                                onclick="confirmFormModal('{{ route('admin.pricing_plan.change_status.api', [$pricingPlan->id, 'is_active']) }}', 'Confirmation', 'Are you sure to change status?')">
                                <i class="fas fa-power-off"></i> {{ $pricingPlan->is_active ? 'Make Inactive' : 'Make Active' }}
                            </button>
                        @endif

                        @if($user_role->hasPermission('pricing_plan_change_status'))
                            <button class="btn btn-sm mr-1 {{ $pricingPlan->is_featured ? 'btn-secondary' : 'btn2-secondary' }}"
                                onclick="confirmFormModal('{{ route('admin.pricing_plan.change_status.api', [$pricingPlan->id, 'is_featured']) }}', 'Confirmation', 'Are you sure to change status?')">
                                <i class="fas fa-power-off"></i> {{ $pricingPlan->is_featured ? 'Not Featured' : 'Make Featured' }}
                            </button>
                        @endif

                        @if($user_role->hasPermission('pricing_plan_update'))
                            <a href="{{ route('admin.pricing_plan.update', $pricingPlan->id) }}" class="btn btn-sm btn-warning mr-1">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        @endif

                        @if($user_role->hasPermission('pricing_plan_delete'))
                            <button class="btn btn-sm btn-danger"
                                onclick="confirmFormModal('{{ route('admin.pricing_plan.delete.api', $pricingPlan->id) }}', 'Confirmation', 'Are you sure to delete operation?')">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        @endif

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body py-4">
                    <div class="text-left">

                        {!! $pricingPlan->description !!}

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@stop
