@extends('admin.layouts.master')

@section('title', __('Committee'))

@section('content')


<div class="content-wrapper">

    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Committee Details')) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.committee.index')) !!}
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="border-bottom text-center pb-4">
                        <div class="mb-3">
                            <h3>{{ $committee->name }}</h3>
                        </div>
                        <p class="w-75 mx-auto">{{ $committee ? $committee->year : 'N/A' }}</p>
                    </div>

                    <div class="text-center mt-4">

                        <a href="#" class="btn btn-sm mb-2 mr-2 {{ $committee->is_current == 1 ? 'btn2-secondary' : 'btn-warning' }}">
                            @if($committee->is_current == 1)
                                <i class="fa fa-users"></i> Current Team
                            @else
                                N/A
                            @endif
                        </a>
                        <a href="{{ route('admin.committee.update', $committee->id) }}"
                            class="btn btn-sm btn2-light-secondary mb-2 mr-2">
                            <i class="fa fa-edit"></i> Edit
                        </a>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow-sm">
                            <div class="card-body py-sm-4">
                                <table class="table table-bordered" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Designation</th>
                                            <th>Vote</th>
                                            <th>Image</th>
                                            <th>Role</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($members as $key => $member)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $member->user?->f_name }}</td>
                                            <td>{{ App\Library\Enum::getCommitteeDesignation($member->designation) }}</td>
                                            <td>{{ $member->vote ? $member->vote : 'N/A' }}</td>
                                            <td><img src="{{ asset(($member->image) ? $member->image : \App\Library\Enum::NO_IMAGE_PATH) }}"
                                                alt="Preview Image" /></td>
                                            <td>{{ $member->role_id ? $member->roleGet->name : 'N/A' }}</td>
                                            <td class="text-center">
                                                <div class="action dropdown">
                                                    <button class="btn btn2-secondary btn-sm dropdown-toggle"
                                                        type="button" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="fas fa-tools"></i> Action
                                                    </button>

                                                    <div class="dropdown-menu">

                                                        <a class="dropdown-item text-primary"
                                                            href="{{ route('admin.committee.member.update', [$committee->id, $member->id]) }}">
                                                            <i class="far fa-edit"></i> Edit
                                                        </a>

                                                        <a class="dropdown-item text-danger" href="javascript:void(0)"
                                                            onclick="confirmModal(deleteOperator, {{ $member->id }}, 'Are you sure to delete operation?')">
                                                            <i class="fa fa-trash"></i> Delete
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

    </div>
</div>

@include('admin.components.update_password')

@stop

@include('admin.assets.dt')
@include('admin.assets.dt-buttons')

@push('scripts')
<script type="text/javascript">

let column_defs = [];
let committee_id = "{{$committee->id}}" ;

var table1 = $('#dataTable').DataTable({
    order: [[0, 'asc']],
    processing: true,
    responsive: true,
    autoWidth: false,
    dom: 'Bfrtip',
    buttons: [
        'pageLength',
        colVisibility('#dataTable', column_defs),
        '<a class="dt-button buttons-collection" href="'+ BASE_URL + '/committees/' + committee_id + '/members/create"><i class="fas fa-plus"></i> Add New Member</a>'
    ],
    columnDefs: column_defs,
    language: {
        searchPlaceholder: "Search records",
        search: "",
        buttons: { pageLength: { _: "%d rows", } }
    }
});
executeColVisibility(table1);

window.deleteOperator = function (id) {
    loading('show');
    const url = BASE_URL + '/committees/members/' + id + '/delete-api';
    axios.post(url)
    .then(response => {
        notify(response.data.message, 'success');
        setTimeout(() => {
            location.reload();
        }, 2000);
    })
    .catch(error => {
        const response = error.response;
        if (response)
            notify(response.data.message, 'error');
    })
    .finally(() => {
        loading('hide');
    });
}

</script>
@endpush
