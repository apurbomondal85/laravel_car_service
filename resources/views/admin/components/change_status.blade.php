<!-- Modal -->
<div class="modal fade" id="updateStatusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
  
      <form id="updateStatusForm" method="POST" action="{{ route($route, $org->id) }}">
        @csrf
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> {{ __($title) }}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <div class="form-group">
                      <label for="name">{{ __($label) }}</label>
                      <select name="status" id="status" class="form-control js-example-basic-single">
                          <option selected disabled>Select One</option>
                          @foreach($allStatus as $index => $value)
                              <option {{ $org->status == $index ? 'selected' : ''  }} value="{{ $index }}">{{ ucwords($value) }}</option>
                          @endforeach
                      </select>
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