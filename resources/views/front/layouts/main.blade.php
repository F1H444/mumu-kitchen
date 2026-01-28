<!DOCTYPE html>
<html lang="en">

<head>
    <title>Mumu Kitchen</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
        integrity="sha512-PgQMlq+nqFLV4ylk1gwUOgm6CtIIXkKwaIHp/PAIWHzig/lKZSEGKEysh0TCVbHJXCLN7WetD8TFecIky75ZfQ=="
        crossorigin="anonymous" />
    <style>
        body {
            background-color: #050505;
            background-image:
                radial-gradient(at 0% 0%, rgba(255, 140, 0, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(255, 59, 59, 0.05) 0px, transparent 50%);
            background-attachment: fixed;
            font-family: 'Outfit', sans-serif !important;
        }

        /* Grainy noise texture */
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("https://grainy-gradients.vercel.app/noise.svg");
            opacity: 0.08;
            pointer-events: none;
            z-index: 1000;
        }
    </style>
    <link rel="shortcut icon" href="{{ asset('assets') }}/img/logomini.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link href= "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <link rel="stylesheet" href="{{ asset('assets2/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets2/css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('assets2/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets2/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets2/css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('assets2/css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('assets2/css/ionicons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets2/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets2/css/jquery.timepicker.css') }}">


    <link rel="stylesheet" href="{{ asset('assets2/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets2/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets2/css/style.css') }}">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/checkout/">






    @yield('style')
</head>

<body>
    @include('front.partials.navbar')

    <!-- Modal -->
    @yield('container')




    @include('front.partials.footer')

    <!-- Start Footer -->

    <!-- End Footer -->

    <!-- Start Script -->


    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('assets2/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets2/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('assets2/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets2/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets2/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('assets2/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets2/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('assets2/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets2/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets2/js/aos.js') }}"></script>
    <script src="{{ asset('assets2/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('assets2/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets2/js/scrollax.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="{{ asset('assets2/js/google-map.js') }}"></script>
    <script src="{{ asset('assets2/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- End Script -->

    @yield('script')
</body>

</html>
