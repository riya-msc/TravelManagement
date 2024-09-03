<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title inertia>{{ config('app.name', 'TRAVELER') }}</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Free HTML Templates" name="keywords">
        <meta content="Free HTML Templates" name="description">

        <!-- Favicon -->
        <link href="{{ asset('assets/frontend/img/favicon.ico') }}" rel="icon">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="{{ asset('assets/frontend/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/frontend/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{ asset('assets/frontend/css/style.css') }}" rel="stylesheet">
{{--        {{ asset('assets/frontend/') }}--}}

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('assets/frontend/lib/easing/easing.min.js') }}" defer></script>
        <script src="{{ asset('assets/frontend/lib/owlcarousel/owl.carousel.min.js') }}" defer></script>
        <script src="{{ asset('assets/frontend/lib/tempusdominus/js/moment.min.js') }}" defer></script>
        <script src="{{ asset('assets/frontend/lib/tempusdominus/js/moment-timezone.min.js') }}" defer></script>
        <script src="{{ asset('assets/frontend/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}" defer></script>

        <!-- Contact Javascript File -->
        <script src="{{ asset('assets/frontend/mail/jqBootstrapValidation.min.js') }}" defer></script>
        <script src="{{ asset('assets/frontend/mail/contact.js') }}" defer></script>

        <!-- Template Javascript -->
        <script src="{{ asset('assets/frontend/js/main.js') }}" defer></script>
    </body>
</html>
