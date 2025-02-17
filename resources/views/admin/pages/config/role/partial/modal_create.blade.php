<!-- Modal -->
<div class="modal fade" id="createRoleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">

        <form id="createRoleForm" onsubmit="createRole(event, this)" action="{{ route('admin.config.role.create.api') }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> {{ __('New Role') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="required" for="name">{{ __('Name') }}</label>
                        <input name="name" type="text" class="form-control" id="name"
                            aria-describedby="emailHelp" placeholder="Enter name" required>
                        <small class="form-text error-message"></small>
                    </div>
                    <div class="form-group">
                        <label class="required" for="slug">{{ __('Slug') }}</label>
                        <input name="slug" type="text" class="form-control" id="slug"
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

        $('#name').change(function(e) {
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
                    $('#slug').val(response.slug);
                    $(':input[type="submit"]').prop('disabled', false);
                },
            });
        });
    </script>

    <script type="text/javascript">
        function createRole(e, t) {
            e.preventDefault();

            let base_url = getBaseUrl();
            const url = base_url + '/configs/roles/create';
            var form_data = $(t).serialize();

            loading('show');
            axios.post(url, form_data)
                .then(response => {
                    notify(response.data.message, 'success');
                    $(createRoleModal).modal('hide');
                    location.reload();
                })
                .catch(error => {
                    const response = error.response;
                    if (response) {
                        if (response.status === 422)
                            validationForm(createRoleForm, response.data.errors);
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
