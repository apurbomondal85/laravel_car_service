<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Admin Login </title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ url('/') }}">

    <!-- Favicons -->
    <link href="{{asset('frontend/images/logo.png')}}" rel="icon">
    <link href="{{asset('frontend/images/logo.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{asset('frontend/assets/css/main.css')}}" rel="stylesheet">
    <!-- endinject -->

    <!-- Font awosome -->
    <link href="{{asset('frontend/assets/plugin/fontawesome/css/all.min.css') }}" rel="stylesheet">

    <script src="{{asset('frontend/assets/js/jquery-3.6.0.min.js') }}"></script>

    @stack('styles')

</head>

<body>
    <!-- ======= Main ======= -->
    <section class="login" data-aos="fade-up" data-aos-delay="100">
    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <div class="login-card shadow-lg py-5">
            <a href="{{ url('/') }}" class="text-center">
                <img src="{{ settings('logo') ? asset(settings('logo')) : Vite::asset(\App\Library\Enum::LOGO_PATH) }}" width="300" alt="Logo" class="img-fluid">

            </a>
            <h1>Admin Login</h1>
            <span></span>
            <div class="login-form">
                <h4>Email </h4>
                <div class="username-input">
                    <i class="fas fa-user"></i>
                    <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <h4>Password </h4>
                <div class="password-input">
                    <i class="fas fa-lock"></i>
                    <input id="password" type="password" class="password @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <i class="fas fa-eye" id="show_pass"></i>
                </div>
                {{-- @if (Route::has('admin.password.request'))
                <p> <a href="{{ route('admin.password.request') }}">Forgot password?</a> </p>
                @endif --}}
            </div>
            <button type="submit" class="login-btn text-center">
                LOGIN
            </button>
            <div class="alternative-signup">

            </div>
        </div>
    </form>

</section>
    <!-- End #main -->



    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('frontend/assets/vendor/aos/aos.js')}}"></script>
    <script src="{{asset('frontend/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
    <script src="{{asset('frontend/assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
    <script src="{{asset('frontend/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('frontend/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
    {{-- <script src="{{asset('frontend/assets/vendor/php-email-form/validate.js')}}"></script> --}}

    <!-- Template Main JS File -->
    <script src="{{asset('frontend/assets/js/main.js')}}"></script>

    @include('sweetalert::alert')
    @stack('scripts')
    <script type="text/javascript">
    $(function () {
        $("#show_pass").click(function () {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
            $("#password").attr("type", type);
        });
    });
</script>
</body>

</html>
