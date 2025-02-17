<!-- Modal -->
<div class="modal fade" id="createDropdownModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">

    <form id="createDropdownForm" onsubmit="createDropdown(event, this)">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="text-transform: capitalize"><i class="fas fa-plus"></i> {{ __('New') }} {{ ucwords(str_replace("_", " ", $dropdown)); }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input name="name" type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter name" required>
            <small class="form-text error-message"></small>
          </div>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn2-light-secondary mr-3" data-dismiss="modal"><i class="fas fa-times"></i> {{ __('Close') }}</button>
          <button type="submit" class="btn btn2-secondary"><i class="fas fa-save"></i> {{ __('Save') }} </button>
        </div>
      </div>
    </form>

  </div>
</div>

@push('scripts')
<script type="text/javascript">
  function createDropdown(e, t)
  {
    e.preventDefault();
    let dropdown = "{{ $dropdown }}"
    let base_url = getBaseUrl();
    const url = base_url + '/configs/dropdowns/'+ dropdown +'/create';
    var form_data = $(t).serialize();

    loading('show');
    axios.post(url, form_data)
      .then(response => {
          notify(response.data.message, 'success');
          $(createDropdownModal).modal('hide');
          location.reload();
          return false;
      })
      .catch(error => {
          const response = error.response;
          if (response) {
              if (response.status === 422)
                  validationForm(createDropdownForm, response.data.errors);
              else if(response.status === 404)
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
