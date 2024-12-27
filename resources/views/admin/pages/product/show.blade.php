@extends('admin.layouts.master')

@section('title', 'Project Details')

@section('content')

@php
    $user_role = App\Models\User::getAuthUser()->roles()->first();
@endphp

<div class="content-wrapper">
    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Project Details')) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.project.index')) !!}
    </div>

    <div class="row">

        <div class="col-md-4">
            <div class="card shadow-sm mb-3">
                <div class="card-body">

                    <div class="border-bottom text-center pb-2">
                        <img src="{{ $project->getImage() }}" alt="profile" class="img-lg rounded-circle mb-3">
                        <div class="mb-3">
                            <h3>{{ $project->name }} </h3>
                        </div>
                    </div>
                    <table class="table org-data-table table-bordered show-table">
                        <tbody>
                            <tr>
                                <td>Project Name</td>
                                <td> {{ $project->name }} </td>
                            </tr>
                            <tr>
                                <td>Is Active</td>
                                <td>
                                    <span class="badge {{ $project->is_active ? "btn2-secondary" : "btn-secondary" }}">
                                        {{ $project->is_active ? "Active" : "Inactive" }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Is Featured</td>
                                <td>
                                    <span class="badge {{ $project->is_featured ? "btn2-secondary" : "btn-secondary" }}">
                                        {{ $project->is_featured ? "Yes" : "No" }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>URL</td>
                                <td> {{ $project->url ?? 'N/A' }} </td>
                            </tr>
                            <tr>
                                <td>Date</td>
                                <td> {{ $project->date ?? 'N/A' }} </td>
                            </tr>
                            <tr>
                                <td>Operator</td>
                                <td> {{ $project->operator?->full_name }} </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="text-center my-4">

                        @if($user_role->hasPermission('project_update_status'))
                            <button class="btn btn-sm mr-1 {{ $project->is_active ? 'btn-secondary' : 'btn2-secondary' }}"
                                onclick="confirmFormModal('{{ route('admin.project.change_status', [$project->id, 'is_active']) }}', 'Confirmation', 'Are you sure to change status?')">
                                <i class="fas fa-power-off"></i> {{ $project->is_active ? 'Make Inactive' : 'Make Active' }}
                            </button>
                        @endif

                        @if($user_role->hasPermission('project_update_status'))
                            <button class="btn btn-sm mr-1 {{ $project->is_featured ? 'btn-secondary' : 'btn2-secondary' }}"
                                onclick="confirmFormModal('{{ route('admin.project.change_status', [$project->id, 'is_featured']) }}', 'Confirmation', 'Are you sure to change status?')">
                                <i class="fas fa-power-off"></i> {{ $project->is_featured ? 'Not Featured' : 'Make Featured' }}
                            </button>
                        @endif

                        @if($user_role->hasPermission('project_update'))
                            <a href="{{ route('admin.project.update', $project->id) }}" class="btn btn-sm btn-warning mr-1">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        @endif

                        @if($user_role->hasPermission('project_delete'))
                            <button class="btn btn-sm btn-danger"
                                onclick="confirmFormModal('{{ route('admin.project.delete', $project->id) }}', 'Confirmation', 'Are you sure to delete operation?')"><i
                                class="fas fa-trash-alt"></i> Delete
                            </button>
                        @endif

                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 ">Project Images</div>
                        <div class="col-md-6 text-right">

                            @if($user_role->hasPermission('project_image_create'))
                                <a href="{{ route('admin.project.createProjectImage', $project->id) }}" style="color:#000;text-decoration:none;">
                                    <i class="fas fa-plus"></i>
                                    Add New
                                </a>
                            @endif

                        </div>
                    </div>
                    <hr>

                    <div class="row">

                        @foreach($projectImages as $key => $value)
                            <div class="col-md-6 d-flex align-items-stretch">
                                <figure class="snip1">

                                    <img src="{{ $value->getProjectImage() }}" alt="{{ $value->name }}"/>

                                    <div>
                                        <h2>{{ $value->name }}</h2>

                                        <div class="curl"></div>

                                        @if($user_role->hasPermission('project_image_delete'))
                                            <a href="#" onclick="confirmFormModal('{{ route('admin.project.deleteProjectImage', $value->id) }}', 'Confirmation', 'Are you sure to delete operation?')">
                                                <i class="fas fa-trash text-danger"></i>
                                            </a>
                                        @endif

                                    </div>
                                </figure>
                            </div>
                        @endforeach

                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body py-4">
                    <div class="text-left pb-1">

                        {{ $project->short_description }}

                    </div>
                    <hr>

                    <div class="text-left">

                        {!! $project->description !!}

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@stop


@push('scripts')
<script>
    /* Demo purposes only */
    $("figure").mouseleave(
        function () {
            $(this).removeClass("hover");
        }
    );
</script>
@endpush
