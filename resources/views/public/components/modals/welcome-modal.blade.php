<div class="modal fade" id="welcomeModal" tabindex="-1" aria-labelledby="welcomeModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content welcome-modal">
            <button type="button" class="btn-close mt-2 ms-2" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body px-5">
                <h1 class="welcome-title">!! Welcome !!</h1>
                <p class="text-center">&#128640; Welcome to KMS Property Maintenance Services Limited, where
                    construction meets excellence. As a leading name in the industry. &#128640;</p>
            </div>
        </div>
    </div>
</div>


@push('scripts')
<script>
    $(document).ready(function () {
            if (!document.cookie.includes('modalDisplayed')) {
            setTimeout(function () {
                $('#welcomeModal').modal('show');
                document.cookie = 'modalDisplayed=true; expires=' + new Date(new Date().getTime() + 30 * 24 * 60 * 60 * 1000).toUTCString() + '; path=/';
            }, 3000);
        }
        });
</script>
@endpush
