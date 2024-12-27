@extends('admin.layouts.master')

@section('title', __('Club Details'))

<style>
    em img {
        max-width: 100%;
    }
</style>

@section('content')


<div class="content-wrapper">
<div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Club Details')) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.club.index')) !!}
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class=" text-center">
                        <img src="{{ asset( $club->image ) }}"
                            alt="profile" class="img-lg rounded-circle mb-3">
                        <div class="mb-3">
                            <h3>{{ $club->name }}</h3>
                        </div>
                        <div class="text-center mt-4">

                            <a href="{{ route('admin.club.update', $club->id) }}"
                                class="btn btn-sm btn2-light-secondary mb-2 mr-2">
                                <i class="fa fa-edit"></i> Edit
                            </a>

                            <a class="btn btn-sm btn-danger mb-2 mr-2"
                                onclick="confirmFormModal('{{ route('admin.club.delete.api', $club->id) }}', 'Confirmation', 'Are you sure to delete operation?')">
                                <i class="fa fa-trash"></i> Delete </a>
                        </div>
                        <hr>
                    </div>
                    <p class="">{!! $club ? $club->description : 'N/A' !!}</p>
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
                                            <th>Note</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($members as $key => $member)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $member->user?->getFullNameAttribute() }}</td>
                                            <td>{{ isset($member->designation) ? \App\Library\Helper::getClubDesignationByKey($member->designation) : 'Member' }}</td>
                                            <td width="20%">{{ isset($member->note) ? $member->note : 'N/A' }}</td>

                                            <td class="text-center">
                                                <div class="action dropdown">
                                                    <button class="btn btn2-secondary btn-sm dropdown-toggle"
                                                        type="button" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="fas fa-tools"></i> Action
                                                    </button>

                                                    <div class="dropdown-menu">

                                                        <a class="dropdown-item text-primary"
                                                            href="{{ route('admin.club.member.update', [$club->id, $member->id]) }}">
                                                            <i class="far fa-edit"></i> Edit
                                                        </a>

                                                        <a class="dropdown-item text-danger" href="javascript:void(0)"
                                                            onclick="confirmModal(deleteClubMember, {{ $member->id }}, 'Are you sure to delete operation?')">
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
let club_id = "{{$club->id}}" ;

var table1 = $('#dataTable').DataTable({
    order: [[0, 'asc']],
    processing: true,
    responsive: true,
    autoWidth: false,
    dom: 'Bfrtip',
    buttons: [
        'pageLength',
        colVisibility('#dataTable', column_defs),
        '<a class="dt-button buttons-collection" href="'+ BASE_URL + '/clubs/' + club_id + '/members/create"><i class="fas fa-plus"></i> Add New Member</a>'
    ],
    columnDefs: column_defs,
    language: {
        searchPlaceholder: "Search records",
        search: "",
        buttons: { pageLength: { _: "%d rows", } }
    }
});
executeColVisibility(table1);

window.deleteClub = function (id) {
    loading('show');
    const url = BASE_URL + '/clubs/' + id + '/delete-api';
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

window.deleteClubMember = function (id) {
    loading('show');
    const url = BASE_URL + '/clubs/members/' + id + '/delete-api';
    axios.post(url)
    .then(response => {
        notify(response.data.message, 'success');
        setTimeout(() => {
            location.reload();
        }, 1000);
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
