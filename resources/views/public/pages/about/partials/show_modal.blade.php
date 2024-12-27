<div id="showSponsorDetailsModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Client Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row gy-4">
                    <div class="col-lg-12">
                        <div class="ps-lg-4 pt-lg-5 text-center">
                            <img src="" class="img-fluid" alt="" id="img">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="ps-lg-4 mt-3">
                        <h3 class="fw-bold fs-2 mb-3">Description</h3>
                        <p id="description"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script type="text/javascript">
    const showSponsorDetailsModal = "#showSponsorDetailsModal";

    function showSponsorDetails(id) {

        $.ajax({
            url: BASE_URL + "/client/show",
            method: 'get',
            data: {
                id: id
            },
            dataType: 'json',
            success: function (response) {

                console.log(response);
                $('#img').attr('src',BASE_URL+'/'+response.logo);
                $('#name').html(response.name);
                $('#description').html(response.description);

                $(showSponsorDetailsModal).modal('show');
            }
        });

    }
</script>
@endpush