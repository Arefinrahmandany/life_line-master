<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{asset('assets/error/css/backend-plugin.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/error/css/backendf700.css')}}">
    <title> EG SHOP  </title>
    <link rel="image_src" href="{{asset('logo.png')}}}"/>
    <meta name="title" content="EG SHOP">
    <meta name="description" content="EG SHOP LIMITED">
    <link rel="shortcut icon" href="{{asset('logo.png')}}" sizes="32x32" type="image/png">
    @toastr_css
</head>
<body>
<div class="wrapper" style="background: url({{asset('assets/error/images/background.png')}}); background-attachment: fixed; background-size: cover;">
    <div class="container">
        <div class="row no-gutters height-self-center">
            <div class="col-sm-12 text-center align-self-center">
                <div class="iq-error position-relative">
                    <img src="{{asset('assets/error/images/error/new-404.png')}}" class="img-fluid iq-error-img" alt="">
                    <h2 class="mb-0 mt-4">Oops! This Page is Not Found.</h2>
                    <p>The requested page dose not exist.</p>
                    <a class="btn btn-primary d-inline-flex align-items-center mt-3" href="/"><i class="ri-home-4-line"></i>Back to Home</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Backend Bundle JavaScript -->
<script src="{{asset('assets/error/js/backend-bundle.min.js')}}"></script>
<!-- app JavaScript -->
<script src="{{asset('assets/error/js/appf700.js')}}"></script>
@toastr_js
@toastr_render
</body>
</html>


