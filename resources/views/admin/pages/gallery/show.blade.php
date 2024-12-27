@extends('admin.layouts.master')

@section('title', 'Gallery Details')

@section('content')

@php
    $user_role = App\Models\User::getAuthUser()->roles()->first();
@endphp

<div class="content-wrapper">
    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Gallery Details')) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.gallery.index')) !!}
    </div>

    <div class="row">

        <div class="col-md-4">
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <table class="table org-data-table table-bordered show-table">
                        <tbody>
                            <tr>
                                <td> Name</td>
                                <td> {{ $gallery->name }} </td>
                            </tr>
                            <tr>
                                <td> Category</td>
                                <td> {{ $gallery->category }} </td>
                            </tr>
                            <tr>
                                <td>Is Featured</td>
                                <td>
                                    <span class="badge {{ $gallery->is_featured ? "btn2-secondary" : "btn-secondary" }}">
                                        {{ $gallery->is_featured ? "Yes" : "No" }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Operator</td>
                                <td> {{ $gallery->operator?->full_name }} </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="text-center my-4">

                        @if($user_role->hasPermission('gallery_update_status'))
                            <button class="btn btn-sm mr-1 {{ $gallery->is_featured ? 'btn-secondary' : 'btn2-secondary' }}"
                                onclick="confirmFormModal('{{ route('admin.gallery.change_status', [$gallery->id, 'is_featured']) }}', 'Confirmation', 'Are you sure to change status?')">
                                <i class="fas fa-power-off"></i> {{ $gallery->is_featured ? 'Not Featured' : 'Make Featured' }}
                            </button>
                        @endif

                        @if($user_role->hasPermission('gallery_update'))
                            <a href="{{ route('admin.gallery.update', $gallery->id) }}" class="btn btn-sm btn-warning mr-1">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        @endif

                        @if($user_role->hasPermission('gallery_delete'))
                            <button class="btn btn-sm btn-danger"
                                onclick="confirmFormModal('{{ route('admin.gallery.delete', $gallery->id) }}', 'Confirmation', 'Are you sure to delete operation?')"><i
                                class="fas fa-trash-alt"></i> Delete
                            </button>
                        @endif

                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 ">Gallery Images</div>
                        <div class="col-md-6 text-right">

                            @if($user_role->hasPermission('gallery_image_create'))
                                <a href="{{ route('admin.gallery.createGalleryImage', $gallery->id) }}" style="color:#000;text-decoration:none;">
                                    <i class="fas fa-plus"></i>
                                    Add New
                                </a>
                            @endif

                        </div>
                    </div>
                    <hr>

                    <div class="row">

                        @foreach($galleryImages as $key => $value)
                            <div class="col-md-6 d-flex align-items-stretch">
                                <figure class="snip1">

                                    <img src="{{ $value->getGalleryImage() }}" alt="{{ $value->name }}"/>

                                    <div>
                                        <h2>{{ $value->name }}</h2>

                                        <div class="curl"></div>

                                        @if($user_role->hasPermission('gallery_image_delete'))
                                            <a href="#" onclick="confirmFormModal('{{ route('admin.gallery.deleteGalleryImage', $value->id) }}', 'Confirmation', 'Are you sure to delete operation?')">
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
                    <div class="text-left">

                        {!! $gallery->description !!}

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
