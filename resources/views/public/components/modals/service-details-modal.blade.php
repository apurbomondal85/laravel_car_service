<div class="modal fade" id="servicesModal" tabindex="-1" aria-labelledby="servicesModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row gy-2">
                    <img src="" class="col-lg-7 img-fluid modal-img isimage2" alt="" data-bs-toggle="modal" data-bs-target="#servicesModal2">
                    <div class="col-lg-5">
                        <h1 class="modal-title fs-4">Home Renovation</h1>
                        <p class="modal-description fs-6"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="servicesModal2" tabindex="-1" aria-labelledby="servicesModal2" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row gy-2">
                    <img src="" class="col-lg-12 img-fluid modal-img2" alt="">
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
        let count = 0;
        $(document).ready(function () {
            $('.btn.read-btn').click(function () {
                
                var index = $(this).closest('.col-lg-4').index();

                count = index;
                
                var service = @json($services);
                
                $('#servicesModal .modal-title').text(service[index].title);
                $('#servicesModal .modal-img').attr('src', service[index].image);
                $('#servicesModal .modal-description').text(service[index].details);

                
                $('#servicesModal').modal('show');
            });

            $('.isimage').click(function () {
                
                var index = $(this).closest('.col-lg-6').index();

                
                var service = @json($services);
                
                $('#servicesModal2 .modal-img2').attr('src', service[index].image);

                
                $('#servicesModal2').modal('show');
            });

            $('.isimage2').click(function () {
                var service = @json($services);
                
                $('#servicesModal2 .modal-img2').attr('src', service[count].image);

                
                $('#servicesModal2').modal('show');
            });
        });
</script>
@endpush()