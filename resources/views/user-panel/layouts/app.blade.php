<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name='robots' content='noindex,nofollow'/>
    <!-- CSRF Token -->
    <!-- Meta, title, CSS, favicons-->
    <meta name="description" content="">
    <meta name="keywords" content="php,laravel,">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  	<title>@yield('page-title') - ArabicaCoffee</title>
  	<!-- Favicon -->
  	<link type="image/ico" href="{{ asset('logo.png') }}" rel="shortcut icon">
    <link href="https://fonts.googleapis.com/css?family=Fredoka+One|Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/msx_admin/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/msx_admin/mdi/css/materialdesignicons.min.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('assets/mscdnxpress/css/animated.min.css')}}"> -->
    <!-- <link rel="stylesheet" href="{{asset('assets/msx_admin/bootstrap-datepicker.min.css')}}"> -->
    <link rel="stylesheet" href="{{asset('assets/mscdnxpress/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/msx_admin/custom.css?v=03')}}">
    @if(request()->is('dashboard'))
    @else
    @include('user-panel.partials.dataTable-Styles')
    @endif
      @yield('css')
   @livewireStyles
      @toastr_css
  </head>
  <body class="sidebar-fixed sidebar-dark" data-gr-c-s-loaded="true">
    <div class="container-scroller">
    <!-- include top nav bar-->
    @include('user-panel.partials.nav')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
    <!-- include Left Menu slide-->
    @include('user-panel.partials.left-slide-menu')
    <!-- partial -->
    <div class="main-panel">
      <!--This is all content part-->
      @yield('content')
      <!--end page content-------->
      <!-- content-wrapper ends -->
      <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
          <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Arabicacoffeebd.com | All rights reserved.</span>
        </div>
      </footer>
      <!-- partial -->
    </div>
    <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <script src="{{asset('assets/msx_admin/app.js?v=4')}}"></script>
    <script src="{{asset('assets/mscdnxpress/js/select2.min.js')}}"></script>
    @if(request()->is('dashboard'))
    @else
    @include('user-panel.partials.dataTable-Scripts')
    @endif
    @yield('javascript')
    <script>
        $('.select2').select2();
    </script>
    @livewireScripts
    @toastr_js
    @toastr_render
  </body>
</html>
