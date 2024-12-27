@extends('admin.layouts.master')

@section('title', 'Activity Log')

@section('content')

<div class="content-wrapper">

    <div class="content-header d-flex justify-content-between">
        <div class="d-block">
            <h4 class="content-title">{{ __('ACTIVITY LOG') }}</h4>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            <table class="table table-bordered no-footer dtr-inline" id="activityLogDataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Date & Time</th>
                        <th>Operation</th>
                        <th>Model</th>
                        <th>Details</th>
                        <th>Action By</th>
                        <th>User Type</th>
                        <th>Ip</th>
                        <th>Browser</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="modal fade" id="activityLogModal" tabindex="-1" role="dialog" aria-labelledby="activityLogModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content" style="width: 50%; margin: 0 auto;">
        <div class="modal-body" style="padding-bottom: 0;">
            <table class="table table-bordered">
                <thead id="logTableHead">
                </thead>
                <tbody id="logTableBody">
                </tbody>
              </table>
        </div>
        <div class="modal-footer" style="border: none; margin: 0 auto">
          <button type="submit" class="btn btn2-secondary" data-dismiss="modal"><i class="fas fa-close"></i> Close</button>
        </div>
      </div>
    </div>
</div>

@stop


@include('admin.assets.dt')
@include('admin.assets.dt-buttons')
@include('admin.assets.dt-buttons-export')

@push('scripts')

    <script src="{{ asset('admin/js/moment.js') }}"></script>
    @vite('resources/admin_assets/js/logs/activity_log.js')

@endpush

@push('styles')
    <style>
        #activityLogModal td{
            white-space: inherit !important;
        }
    </style>
@endpush
