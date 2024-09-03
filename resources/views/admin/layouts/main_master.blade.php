<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>@yield('admin_title') | Destiny Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    @include('admin.layouts.partials.head')

    @stack('admin_styles')

</head>

<body data-topbar="dark">

<!-- <body data-layout="horizontal" data-topbar="dark"> -->
<!-- Loader -->
<div id="preloader">
    <div id="status">
        <div class="spinner">
            <i class="ri-loader-line spin-icon"></i>
        </div>
    </div>
</div>


<!-- Begin page -->
<div id="layout-wrapper">


   @include('admin.layouts.partials.header')

    <!-- ========== Left Sidebar Start ========== -->
    @include('admin.layouts.partials.sidebar')
    <!-- Left Sidebar End -->



    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        @yield('admin_content')
        <!-- End Page-content -->

        @include('admin.layouts.partials.footer')

    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<!-- Right Sidebar -->

<!-- /Right-bar -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- JAVASCRIPT -->
@stack('admin_scripts')

@include('admin.layouts.partials.foot')

</body>

</html>
