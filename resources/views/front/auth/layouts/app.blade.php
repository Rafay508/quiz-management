<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-wide customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{!! asset('assets') !!}/"
  data-template="vertical-menu-template">
<!-- BEGIN: Head-->

<head>
  
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="author" content="Beep.ae">
    @if ($siteSettings->favicon && file_exists(uploadsDir('front') . $siteSettings->favicon))
    <link rel="apple-touch-icon" href="{!! asset(uploadsDir('front') . $siteSettings->favicon) !!}">
    <link rel="shortcut icon" type="image/x-icon" href="{!! asset(uploadsDir('front') . $siteSettings->favicon) !!}">
    <link rel="icon" type="image/x-icon" href="{!! asset(uploadsDir('front') . $siteSettings->favicon) !!}" />
    @else
    <link rel="apple-touch-icon" href="{!! asset('assets/img/favicon-32x32.png') !!}">
    <link rel="shortcut icon" type="image/x-icon" href="{!! asset('assets/img/favicon-32x32.png') !!}">
    <link rel="icon" type="image/x-icon" href="{!! asset('assets/img/favicon-32x32.png') !!}" />
    @endif

    <title>@yield('title')</title>
    <link rel="stylesheet" href="{!! asset('assets/front/css/style1.css') !!}" />
    <link rel="stylesheet" href="{!! asset('assets/front/css/all.min.css') !!}" />
    <link rel="stylesheet" href="{!! asset('assets/front/css/style.css') !!}" />
    <link rel="stylesheet" href="{!! asset('assets/front/css/flatpickr.min.css') !!}" />
  
    <script src="{!! asset('assets/front/script/fontawesom.js') !!}" crossorigin="anonymous"></script>
    <script src="{!! asset('assets/front/script/tailwind.js') !!}"></script>
    <!-- BEGIN: Toastr CSS-->
    <link rel="stylesheet" type="text/css" href="{!! asset('assets/admin/app-assets/vendors/css/extensions/toastr.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('assets/admin/app-assets/css/plugins/extensions/toastr.css') !!}">
    <!-- END: Toastr CSS-->
    @yield('css')

    <style type="text/css">
/*        input:after { background: white }*/
    </style>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body>
   
    @yield('content')

    <script src="{!! asset('assets/vendor/libs/jquery/jquery.js') !!}"></script>
    <!-- Toastr -->
    <script src="{!! asset('assets/admin/app-assets/vendors/js/extensions/toastr.min.js') !!}"></script>
    <script src="{!! asset('assets/admin/app-assets/js/scripts/extensions/toastr.js') !!}"></script>
    <!-- END: Page JS-->
    @include('admin.partials.errors')
</body>
<!-- END: Body-->

</html>