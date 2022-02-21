<!doctype html>
<html lang="ar" dir="rtl">

<head>
    @include('layouts/admin/head')
</head>

<body class="app sidebar-mini">

<!-- Start Switcher -->
@include('layouts/admin/switcher')
<!-- End Switcher -->

<!-- GLOBAL-LOADER -->
@include('layouts/admin/loader')
<!-- /GLOBAL-LOADER -->

<!-- PAGE -->
<div class="page">
    <div class="page-main">
        <!--APP-SIDEBAR-->
    @include('layouts/admin/main-sidebar')
    <!--/APP-SIDEBAR-->

        <!-- Header -->
    @include('layouts/admin/main-header')
    <!-- Header -->
        <!--Content-area open-->
        <div class="app-content">
            <div class="side-app">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">مرحبا بـك ! <i class="fas fa-heart text-danger"></i></h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">لوحة التحكم</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@yield('page_name')</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->
                @yield('content')
            </div>
            <!-- End Page -->
        </div>
        <!-- CONTAINER END -->
    </div>
    <!-- SIDE-BAR -->

    <!-- FOOTER -->
@include('layouts/admin/footer')
<!-- FOOTER END -->
</div>
<!-- BACK-TO-TOP -->
<a href="#top" id="back-to-top"><i class="fa fa-angle-up mt-4"></i></a>

@include('layouts/admin/scripts')
@yield('ajaxCalls')
@toastr_js
@toastr_render
</body>
</html>
