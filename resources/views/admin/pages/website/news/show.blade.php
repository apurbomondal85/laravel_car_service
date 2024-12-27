@extends('admin.layouts.master')

@section('title', 'News Details')

@section('content')

@php
$user_role = App\Models\User::getAuthUser()->roles()->first();
@endphp

<div class="content-wrapper">
    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('News Details')) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.news.index')) !!}
    </div>

    <div class="row">

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">

                    <div class="border-bottom text-center pb-2">
                        <img src="{{ $news->getFeaturedImage() }}" alt="profile" class="img-lg rounded-circle mb-3">
                        <div class="mb-3">
                            <h3>{{ $news->title }} </h3>
                        </div>
                    </div>
                    <table class="table org-data-table table-bordered show-table">
                        <tbody>
                            <tr>
                                <td>Status</td>
                                <td>
                                    <span class="badge {{ ($news->is_active == \App\Library\Enum::STATUS_ACTIVE) ? "
                                        btn2-secondary" : "btn-secondary" }}">
                                        {{ ($news->is_active == \App\Library\Enum::STATUS_ACTIVE) ? "Published" :
                                        "Draft" }}
                                    </span>
                                </td>
                            </tr>  
                            <tr>
                                <td>Featured</td>
                                <td>
                                    <span class="badge {{ ($news->is_featured == 1) ? "btn2-secondary" : "btn-secondary" }}">
                                        {{ ($news->is_featured == 1) ? "Yes" :
                                        "No" }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Link</td>
                                <td> <a class="text-primary" target="_blank" href="{{ $news->link }}"> Click Here </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Operator</td>
                                <td> {{ $news->operator?->f_name }} {{ $news->operator?->l_name }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="text-center my-4">
                        <button
                            class="btn btn-sm mr-1 {{ $news->is_active == \App\Library\Enum::STATUS_ACTIVE ? 'btn-secondary' : 'btn2-secondary' }}"
                            onclick="confirmFormModal('{{ route('admin.news.change_status', $news->id) }}', 'Confirmation', 'Are you sure to change status?')">
                            <i class="fas fa-power-off"></i> {{ $news->is_active == \App\Library\Enum::STATUS_ACTIVE ?
                            'Make Draft' : 'Make Published' }}
                        </button>                        
                        <button
                            class="btn btn-sm mr-1 {{ $news->is_featured == 1 ? 'btn-secondary' : 'btn2-secondary' }}"
                            onclick="confirmFormModal('{{ route('admin.news.change_featured', $news->id) }}', 'Confirmation', 'Are you sure to change featured status?')">
                            <i class="fas fa-power-off"></i> {{ $news->is_featured == 1 ?
                            'Unfeature' : 'Make Featured' }}
                        </button>
                        <a href="{{ route('admin.news.update', $news->id) }}" class="btn btn-sm btn-warning mr-1">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-title py-2 my-2 text-center">{{ __('Description' )}}</div>
                <div class="card-body">
                    {!! $news->description !!}
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