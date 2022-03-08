<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="EGSHOP">
    <meta name="author" content="EGSHOP.COM.BD">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('logo.png')}}">
    <title>{{@$title}} - {{env('APP_NAME')}}</title>
    {{--select2--}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!--  CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link href="{{asset('assets/admin/css/style.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/pages/file-upload.css')}}" rel="stylesheet">
    <!-- This page CSS -->
{{--    <link rel="stylesheet" type="text/css" href="../assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">--}}
{{--    <link href="../assets/node_modules/morrisjs/morris.css" rel="stylesheet">--}}
{{--    <link href="../assets/node_modules/c3-master/c3.min.css" rel="stylesheet">--}}
{{--    <link href="dist/css/pages/dashboard1.css" rel="stylesheet">--}}
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @toastr_css
    @livewireStyles
    <!--iziModal-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.5.1/css/iziModal.min.css" />
    <!--  This custom css -->
    <link href="{{asset('assets/admin/css/pages/user-card.css?v=2')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/custom.css')}}" rel="stylesheet">
    @stack('style')
</head>
<body class="skin-default fixed-layout">
<!-- Main wrapper - style you can find in pages.scss -->
<div id="main-wrapper">
    <!-- Topbar header - style you can find in pages.scss -->
    @include('admin.partials.header')
    <!-- End Topbar header -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <aside class="left-sidebar">
       @include('admin.partials.left-sidebar')
    </aside>
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- Page wrapper  -->
    <div class="page-wrapper">
        <!-- Preloader - style you can find in spinners.css -->
        <div class="preloader" style="z-index: 9;left: 0;">
            <div class="loader">
                <div class="loader__figure"style="border: 0 solid #eb008b;"></div>
                <p class="loader__label"style="color: #eb008b;">{{env('app_name')}}</p>
            </div>
        </div>
        <!-- Container fluid  -->
        <div class="container-fluid">
         @yield('content')
           <!-- .right-sidebar -->
            @include('admin.partials.right-sidebar')
           <!-- End Right sidebar -->
        </div>
        <!-- End Container fluid  -->
    </div>
    <!-- End Page wrapper  -->
    <!-- footer -->
    <footer class="footer">
        @component('components.app-copyright-component')@endcomponent
    </footer>
    <!-- End footer -->
</div>
<!-- End Wrapper -->
<!-- All Jquery -->
<script src="{{asset('assets/admin/jquery/jquery-3.2.1.min.js')}}"></script>
<!-- Bootstrap popper Core JavaScript -->
<script src="{{asset('assets/admin/popper/popper.min.js')}}"></script>
<script src="{{asset('assets/admin/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{asset('assets/admin/js/perfect-scrollbar.jquery.min.js')}}"></script>
<!--Wave Effects -->
<script src="{{asset('assets/admin/js/waves.js')}}"></script>
{{--Font Awesome--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<!--Menu sidebar -->
<script src="{{asset('assets/admin/js/sidebarmenu.js')}}"></script>
<!--Custom JavaScript -->
<script src="{{asset('assets/admin/js/custom.min.js')}}"></script>
<!-- This page plugins -->
{{--Sweetalert--}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{asset('assets/admin/js/pages/jasny-bootstrap.js')}}"></script>
<script src="{{asset('assets/admin/js/ms-bootstrap-form-validation.js')}}"></script>
<script src="{{asset('assets/admin/js/iziModal.js')}}" ></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@toastr_js
@toastr_render
@livewireScripts
<script src="{{asset('assets/admin/js/app.js?v=2')}}"></script>
<script type="text/javascript">
    // livewire load-more
    window.onscroll = function(ev) {
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
            window.livewire.emit('load-more');
        }
    };
    //sidebarnav
    $(function () {
        $('#sidebarnav a').on('click', function (e) {
            if (!$(this).hasClass("active")) {
                // open our new menu and add the open class
                $(this).next("ul").addClass("in");
                $(this).addClass("active");
            }
            else if ($(this).hasClass("active")) {
                $(this).removeClass("active");
                $(this).parents("ul:first").removeClass("active");
                $(this).next("ul").removeClass("in");
            }
        })
        $('#sidebarnav >li >a.has-arrow').on('click', function (e) {
            e.preventDefault();
        });
    });
</script>
@stack('script')
</body>
</html>
