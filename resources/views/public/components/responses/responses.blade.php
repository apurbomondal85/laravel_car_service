<div class="container">
    @if(Session::has('success'))
    <div class="row my-3">
        <div class="col-12">
            <div class="alert alert-success d-flex  align-items-center px-1 py-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-check-circle-fill pl-2" viewBox="0 0 16 16">
                    <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </svg>
                <p class="mx-3">{{Session::get('success')}}</p>
                <button class="btn-close ms-auto pr-2" data-bs-dismiss="alert" aria-label="close"></button>
            </div>
        </div>
    </div>
    @endif
    @if(Session::has('failure'))
    <div class="row my-3">
        <div class="col-12">
            <div class="alert alert-warning d-flex align-items-center  px-1 py-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-exclamation-circle pl-2" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                    <path
                        d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
                </svg>
                <p class="mx-3">{{ Session::get('failure') }}</p>
                <button class="btn-close ms-auto pr-2" data-dismiss="alert" aria-label="close"></button>
            </div>
        </div>
    </div>
    @endif

    @if ($errors->any())
    <div class="row my-3">
        @foreach ($errors->all() as $error)
        <div class="col-12">
            <div class="alert alert-danger d-flex align-items-center px-1 py-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-exclamation-circle  pl-2" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                    <path
                        d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
                </svg>
                <p class="mx-3">{{ $error }}</p>
                <button class="btn-close ms-auto pr-2" data-bs-dismiss="alert" aria-label="close"></button>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>