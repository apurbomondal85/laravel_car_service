@extends('admin.layouts.master')

@section('title', 'Faq Details')

@section('content')

@php
    $user_role = App\Models\User::getAuthUser()->roles()->first();
@endphp

<div class="content-wrapper">
    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Faq Details')) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.faqs.index')) !!}
    </div>

    <div class="row justify-content-start">

        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">


                    <table class="table org-data-table table-bordered show-table">
                        <tbody>
                            <tr>
                                <td>Status</td>
                                <td>
                                    <span class="badge {{ ($faq->is_active == \App\Library\Enum::STATUS_ACTIVE) ? "btn2-secondary" : "btn-secondary" }}">
                                        {{ ($faq->is_active == \App\Library\Enum::STATUS_ACTIVE) ? "Active" : "Inactive" }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Question</td>
                                <td> {{ $faq->question }} </td>
                            </tr>
                            <tr>
                                <td>Answer</td>
                                <td> {{ $faq->answer }} </td>
                            </tr>
                            <tr>
                                <td>Operator</td>
                                <td> {{ $faq->operator?->full_name }} </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="text-center my-4">

                        @if($user_role->hasPermission('faq_update_status'))
                            <button class="btn btn-sm mr-1 {{ $faq->is_active == \App\Library\Enum::STATUS_ACTIVE ? 'btn-secondary' : 'btn2-secondary' }}"
                                onclick="confirmFormModal('{{ route('admin.faq.change_status', $faq->id) }}', 'Confirmation', 'Are you sure to change status?')">
                                <i class="fas fa-power-off"></i> {{ $faq->is_active == \App\Library\Enum::STATUS_ACTIVE ? 'Make Inactive' : 'Make Active' }}
                            </button>
                        @endif

                        @if($user_role->hasPermission('faq_update'))
                            <a href="{{ route('admin.faqs.update', $faq->id) }}" class="btn btn-sm btn-warning mr-1">
                                <i class="fas fa-edit"></i> Edit
                            </a>
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
