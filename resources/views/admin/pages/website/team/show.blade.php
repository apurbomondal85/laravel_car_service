@extends('admin.layouts.master')

@section('title', 'Team Details')

@section('content')

@php
    $user_role = App\Models\User::getAuthUser()->roles()->first();
@endphp

<div class="content-wrapper">
    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Team Details')) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.team.index')) !!}
    </div>

    <div class="row">

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">

                    <div class="border-bottom text-center pb-2">
                        <div class="mb-3">
                            <h3>{{ $team->name }} </h3>
                        </div>
                        <p class="mx-auto mb-2 w-75">{{ $team->short_description }}</p>
                    </div>

                    <div class="text-center my-4">
                        @if($user_role->hasPermission('team_update_status'))
                        <button class="btn btn-sm mr-1 {{ $team->is_active ? 'btn2-secondary' : 'btn-secondary' }}"
                            onclick="confirmFormModal('{{ route('admin.team.update_active_status', $team->id) }}', 'Confirmation', 'Are you sure to change status?')">
                            <i class="fas fa-power-off"></i> {{ $team->is_active ? 'Make Inactive' : 'Make Active' }}
                        </button>
                        @endif

                        @if($user_role->hasPermission('team_update'))
                        <a href="{{ route('admin.team.update', $team->id) }}" class="btn btn-sm btn-warning mr-1">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        @endif

                        @if($user_role->hasPermission('team_delete'))
                        <button class="btn btn-sm btn-danger mr-1"
                            onclick="confirmFormModal('{{ route('admin.team.delete', $team->id) }}', 'Confirmation', 'Are you sure to delete operation?')">
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
                    <h5> {{ __('Team Members') }} </h5>
                    <div class="table-responsive pt-3">
                        <input type="hidden" id="teamId" value="{{$team->id}}">
                    <table class="table table-bordered" id="dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Is Featured</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $index = 0; @endphp
                                @foreach($members as $row)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $row->user?->getFullNameAttribute() }}</td>
                                        <td class="text-center">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox"
                                                    onchange="changeActiveStatus('{{route('admin.team.member.update_active_status', $row->id)}}', 'Are you sure !! You Change Status?')"
                                                    class="custom-control-input"
                                                    id="primarySwitch_{{$row->id}}" {{$row->is_active ? 'checked' : ''}}>
                                                <label class="custom-control-label" for="primarySwitch_{{ $user_role->hasPermission('team_update_status') ? $row->id : ''}}"></label>
                                            </div>
                                        </td>

                                        <td class="text-center">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox"
                                                    onchange="changeFeatureStatus('{{route('admin.team.member.update_feature_status', $row->id)}}', 'Are you sure !! You Change Feature Status?')" class="custom-control-input"
                                                    id="primaryFeatureSwitch_{{$row->id}}" {{$row->is_featured ? 'checked' : ''}}>
                                                <label class="custom-control-label" for="primaryFeatureSwitch_{{ $user_role->hasPermission('team_update_status') ? $row->id : ''}}"></label>
                                            </div>
                                        </td>

                                        <td class="text-center">
                                            <div class="action dropdown">
                                                <button class="btn btn2-secondary btn-sm dropdown-toggle" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-tools"></i> Action
                                                </button>

                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item text-primary" href="{{ route('admin.team.member.update', $row->id) }}">
                                                        <i class="fas fa-edit"></i>  Edit
                                                    </a>
                                                    <a class="dropdown-item text-danger" href="javascript:void(0)"
                                                        onclick="confirmFormModal('{{ route('admin.team.member.delete.api', $row->id) }}', 'Are you sure to delete operation?')">
                                                        <i class="fas fa-trash"></i>  Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
@include('admin.assets.dt')
@include('admin.assets.dt-buttons')


@push('scripts')
@vite('resources/admin_assets/js/team/show.js')
@endpush
