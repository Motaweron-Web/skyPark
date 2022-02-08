<!DOCTYPE html>
<html>
<head>
    <title>@yield('page_title')</title>
    @include('admin.layouts.assets.head')
</head>
<body class="g-sidenav-show  bg-gray-100">
@include('admin.layouts.inc.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        @include('admin.layouts.inc.navbar')
        <content class="container-fluid pt-4">
        @yield('content')
            @include('admin.layouts.inc.footer')
        </content>
    </main>
@include('admin.layouts.assets.scripts')
</body>
</html>

