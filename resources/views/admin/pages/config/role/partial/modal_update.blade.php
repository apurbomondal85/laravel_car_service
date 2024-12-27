<!-- Modal -->
<div class="modal fade" id="updateRoleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="updateRoleForm" onsubmit="updateRole(event, this)">
            <input type="hidden" name="id" value="">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> {{ __('Update Role') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="required" for="name">{{ __('Name') }}</label>
                        <input name="name" type="text" class="form-control" id="uname"
                            aria-describedby="emailHelp" placeholder="Enter name" required>
                        <small class="form-text error-message"></small>
                    </div>
                    <div class="form-group">
                        <label class="required" for="slug">{{ __('Slug') }}</label>
                        <input name="slug" type="text" class="form-control" id="uslug"
                            placeholder="Enter Slug" required readonly>
                        <small class="form-text error-message"></small>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn2-light-secondary mr-3" data-dismiss="modal"><i
                            class="fas fa-times"></i> {{ __('Close') }}</button>
                    <button type="submit" class="btn btn2-secondary"><i class="fas fa-save"></i> {{ __('Save') }}
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>

@push('scripts')

    <script>
        $(document).ready(function() {
            $(':input[type="submit"]').prop('disabled', true);
        });

        $('#uname').change(function(e) {
            const slugUrl = '{{ route('admin.config.role.slug.api') }}';
            var name = $(this).val();

            $.ajax({
                url: slugUrl,
                method: "GET",
                data: {
                    "_token": "{{ csrf_token() }}",
                    name: name
                },
                success: function(response) {
                    $('#uslug').val(response.slug);
                    $(':input[type="submit"]').prop('disabled', false);
                },
            });
        });
    </script>

    <script type="text/javascript">
        function updateRole(e, t) {
            e.preventDefault();
            const role_id = $(updateRoleForm).find("input[name='id']").val();

            let base_url = getBaseUrl();
            const url = base_url + '/configs/roles/' + role_id + '/update-api';
            var form_data = $(t).serialize();

            loading('show');
            axios.post(url, form_data)
                .then(response => {
                    notify(response.data.message, 'success');
                    $(updateRoleModal).modal('hide');
                    location.reload();
                })
                .catch(error => {
                    const response = error.response;
                    if (response) {
                        if (response.status === 422)
                            validationForm(updateRoleForm, response.data.errors);
                        else if (response.status === 404)
                            notify('Not found', 'error');
                        else
                            notify(response.data.message, 'error');
                    }
                })
                .finally(() => {
                    loading('hide');
                });

        }
    </script>
@endpush
