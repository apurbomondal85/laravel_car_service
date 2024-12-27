@extends('admin.layouts.master')

@php $dropdown_label = \App\Library\Enum::getConfigDropdown($dropdown); @endphp

@section('title', "Manage $dropdown_label")

@section('content')

<div class="content-wrapper">

    <div class="row content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title" style="text-transform: uppercase">{{ $dropdown_label }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.config.dropdown.list')) !!}
    </div>

    <div class="card shadow-sm col-md-6">
        <div class="card-body">

            <table class="table dropdown-data-table display nowrap table-bordered no-footer dtr-inline" id="dropdownTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $value)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $value }}</td>
                            <td style="display: flex;">
                                <div class="action dropdown">
                                    <button class="btn btn2-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuSizeButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       <i class="fas fa-tools"></i> Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item text-secondary" href="javascript:void(0)" onclick="clickEditAction('{{ $key }}')" ><i class="far fa-edit"></i> Edit</a>
                                        <a class="dropdown-item text-danger" href="javascript:void(0)" onclick="confirmModal(deleteDropdown, '{{ $key }}', 'Are you sure to delete operation?')" ><i class="far fa-trash-alt"></i> Delete</a>
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

@include('admin.pages.config.dropdown.partial.modal_create')
@include('admin.pages.config.dropdown.partial.modal_update')

@stop

@include('admin.assets.dt')
@include('admin.assets.dt-buttons')

@push('scripts')

@vite('resources/admin_assets/js/config/dropdown/index.js')

<script type="text/javascript">

    const createDropdownModal = "#createDropdownModal";
    const createDropdownForm = "#createDropdownForm";
    const updateDropdownModal = "#updateDropdownModal";
    const updateDropdownForm = "#updateDropdownForm";

    function clearForm()
    {
        $(createDropdownForm).find("input[name='name']").val('');
    }

    function clickAddAction()
    {
        clearValidation(createDropdownForm);
        clearForm();
        $(createDropdownModal).modal('show');
    }

    function clickEditAction(id)
    {
        loading('show');
        let dropdown = "{{ $dropdown }}";
        let base_url = getBaseUrl();
        const url = base_url + '/configs/dropdowns/' + dropdown + '/' + id + '/show-api';
        axios.get(url)
        .then(response => {
            console.log(response);
            const data = response.data;
            clearValidation(updateDropdownForm);
            $(updateDropdownForm).find("input[name='id']").val(data.index);
            $(updateDropdownForm).find("input[name='name']").val(data.value);
            $(updateDropdownModal).modal('show');
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

    function deleteDropdown(id)
    {
        loading('show');
        let base_url = getBaseUrl();
        let dropdown = "{{ $dropdown }}"
        const url = base_url + '/configs/dropdowns/' + dropdown + '/' + id + '/delete-api';
        axios.post(url)
        .then(response => {
            console.log(response);
            notify(response.data.message, 'success');
            location.reload();
            return false;
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
