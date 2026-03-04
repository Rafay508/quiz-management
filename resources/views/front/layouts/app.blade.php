<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link rel="shortcut icon" type="image/x-icon" href="{!! asset('assets/admin/app-assets/images/ico/favicon.ico') !!}">
  <!-- <link href="{{ asset('assets/front/img/favicon.png') }}" rel="icon"> -->
  <link href="{{ asset('assets/front/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/front/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/front/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/front/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/front/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('assets/front/css/main.css') }}" rel="stylesheet">

  <!-- BEGIN: Toastr CSS-->
  <link rel="stylesheet" type="text/css" href="{!! asset('assets/admin/app-assets/vendors/css/extensions/toastr.css') !!}">
  <link rel="stylesheet" type="text/css" href="{!! asset('assets/admin/app-assets/css/plugins/extensions/toastr.css') !!}">
  <!-- END: Toastr CSS-->

  <!-- sweet alert -->
  <link rel="stylesheet" href="{!! asset('assets/vendor/libs/sweetalert2/sweetalert2.css') !!}" />

  <!-- =======================================================
  * Template Name: Learner
  * Template URL: https://bootstrapmade.com/learner-bootstrap-course-template/
  * Updated: Jul 08 2025 with Bootstrap v5.3.7
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  @yield('css')
</head>

<body class="index-page">

  @if (!Route::is('quiz.take'))
    @include('front.layouts.partials.header')
  @endif
  <main class="main">
    @yield('content')
  </main>

  @if (!Route::is('quiz.take'))
    @include('front.layouts.partials.footer')
  @endif

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/front/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/front/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets/front/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/front/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets/front/vendor/swiper/swiper-bundle.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('assets/front/js/main.js') }}"></script>

  <!-- Jquery -->
  <script src="{!! asset('assets/vendor/libs/jquery/jquery.js') !!}"></script>

  <!-- Toastr -->
  <script src="{!! asset('assets/admin/app-assets/vendors/js/extensions/toastr.min.js') !!}"></script>
  <script src="{!! asset('assets/admin/app-assets/js/scripts/extensions/toastr.js') !!}"></script>

  <!-- sweet alert -->
  <script src="{!! asset('assets/vendor/libs/sweetalert2/sweetalert2.js') !!}"></script>
  <script src="{!! asset('assets/js/extended-ui-sweetalert2.js') !!}"></script>

  <!-- include errors -->
  @include('front.partials.errors')

</body>

</html>
