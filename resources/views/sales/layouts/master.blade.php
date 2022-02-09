<!DOCTYPE html>
<html>
<head>
    <title>@yield('page_title')</title>
    @include('sales.layouts.assets.head')
</head>
<body class="g-sidenav-show  bg-gray-100">
@include('sales.layouts.inc.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        @include('sales.layouts.inc.navbar')
        <content class="container-fluid pt-4">
        @yield('content')
            @include('sales.layouts.inc.footer')
        </content>
    </main>
@include('sales.layouts.assets.scripts')
</body>
</html>

