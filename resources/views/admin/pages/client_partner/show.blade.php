@extends('admin.layouts.master')

@section('title', ucwords($client->client_type))

@section('content')

@php
    $user_role = App\Models\User::getAuthUser()->roles()->first();

    $type = $client->client_type;
    $clients = \App\Library\Enum::CLIENT_TYPE_CLIENT;
    $partners = \App\Library\Enum::CLIENT_TYPE_PARTNER;

    $client_type = 'partner';

    if ($client->client_type == $clients) {
        $client_type = 'client';
    }

@endphp

<div class="content-wrapper">
    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper($type) }} DETAILS</h4>
        </div>
        {!! \App\Library\Html::linkBack($type == $clients ? route('admin.client.index', ['type' => $clients]) : route('admin.partner.index', ['type' => $partners])) !!}
    </div>

    <div class="row">

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">

                    <div class="border-bottom text-center">
                        <img src="{{ $client->getLogo() }}" alt="profile" class="img-lg rounded-circle mb-3">
                        <div class="mb-3">
                            <h3>{{ $client->name }} </h3>
                        </div>
                    </div>
                    <table class="table org-data-table table-bordered show-table">
                        <tbody>
                            <tr>
                                <td>Status</td>
                                <td>
                                    <span class="badge {{ ($client->is_active == \App\Library\Enum::STATUS_ACTIVE) ? "btn2-secondary" : "btn-secondary" }}">
                                        {{ ($client->is_active == \App\Library\Enum::STATUS_ACTIVE) ? "Active" : "Inactive" }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Is Featured</td>
                                <td>
                                    <span class="badge {{ $client->is_featured ? "btn2-secondary" : "btn-secondary" }}">
                                        {{ $client->is_featured ? "Yes" : "No" }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Operator</td>
                                <td> {{ $client->operator?->full_name }} </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="text-center my-4">

                        @if($user_role->hasPermission('' . $client_type . '_update_status'))
                            <button class="btn btn-sm mr-1 {{ $client->is_active ? 'btn-secondary' : 'btn2-secondary' }}"
                                onclick="confirmFormModal('{{ route('admin.' . $client_type . '.change_status.api', [$client->id, 'is_active']) }}', 'Confirmation', 'Are you sure to change status?')">
                                <i class="fas fa-power-off"></i> {{ $client->is_active ? 'Make Inactive' : 'Make Active' }}
                            </button>
                        @endif

                        @if($user_role->hasPermission('' . $client_type . '_update_status'))
                            <button class="btn btn-sm mr-1 {{ $client->is_featured ? 'btn-secondary' : 'btn2-secondary' }}"
                                onclick="confirmFormModal('{{ route('admin.' . $client_type . '.change_status.api', [$client->id, 'is_featured']) }}', 'Confirmation', 'Are you sure to change status?')">
                                <i class="fas fa-power-off"></i> {{ $client->is_featured ? 'Not Featured' : 'Make Featured' }}
                            </button>
                        @endif

                        @if($user_role->hasPermission('' . $client_type . '_update'))
                            <a href="{{ route('admin.' . $client_type . '.update', $client->id) }}" class="btn btn-sm btn-warning mr-1">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        @endif

                        @if($user_role->hasPermission('' . $client_type . '_delete'))
                            <button class="btn btn-sm btn-danger"
                                onclick="confirmFormModal('{{ route('admin.' . $client_type . '.delete.api', $client->id) }}', 'Confirmation', 'Are you sure to delete operation?')"><i
                                class="fas fa-trash-alt"></i> Delete
                            </button>
                        @endif

                    </div>
                </div>
            </div>
        </div>

        @if($client->description)
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body py-4">
                        <div class="text-left">

                            {{ $client->description }}

                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>

@stop
