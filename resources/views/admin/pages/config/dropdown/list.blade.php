@extends('admin.layouts.master')

@section('title', 'Manage Dropdown List')

@section('content')

<div class="content-wrapper">

    <div class="content-header d-flex justify-content-between">
        <div class="d-block">
            <h4 class="content-title">DROPDOWN LIST</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table table-bordered no-footer dtr-inline" id="dataTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php $sn = 1; @endphp
                            @foreach(\App\Library\Enum::getConfigDropdown() as $key => $value)
                            <tr>
                                <td>{{ $sn++ }}</td>
                                <td>
                                    <a class="text-primary fs-1" href="{{ route('admin.config.dropdown.index', $key) }}">{{ $value }}</a>
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

@stop

@include('admin.assets.dt')
@include('admin.assets.dt-buttons')


@push('scripts')

@vite('resources/admin_assets/js/config/dropdown/list.js')

@endpush
