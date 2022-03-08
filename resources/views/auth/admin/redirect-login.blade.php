@extends('layouts.admin-auth',['title'=>'Connect to the Login Server','bg'=> asset('images/61773.png')])
@push('css')
    @toastr_css
@endpush
@section('content')
    <style>
        .lds-ellipsis {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 20px;
        }
        .lds-ellipsis div {
            position: absolute;
            top: 10px;
            width: 13px;
            height: 13px;
            border-radius: 50%;
            background: #fff;
            animation-timing-function: cubic-bezier(0, 1, 1, 0);
        }
        .lds-ellipsis div:nth-child(1) {
            left: 8px;
            animation: lds-ellipsis1 0.6s infinite;
        }
        .lds-ellipsis div:nth-child(2) {
            left: 8px;
            animation: lds-ellipsis2 0.6s infinite;
        }
        .lds-ellipsis div:nth-child(3) {
            left: 32px;
            animation: lds-ellipsis2 0.6s infinite;
        }
        .lds-ellipsis div:nth-child(4) {
            left: 56px;
            animation: lds-ellipsis3 0.6s infinite;
        }
        @keyframes lds-ellipsis1 {
            0% {
                transform: scale(0);
            }
            100% {
                transform: scale(1);
            }
        }
        @keyframes lds-ellipsis3 {
            0% {
                transform: scale(1);
            }
            100% {
                transform: scale(0);
            }
        }
        @keyframes lds-ellipsis2 {
            0% {
                transform: translate(0, 0);
            }
            100% {
                transform: translate(24px, 0);
            }
        }

    </style>
    <div class="row align-items-center justify-content-center">
        <div class="col-xl-6 col-lg-7 col-sm-12 col-12 fxt-bg-color">
            <div class="fxt-content">
                <div class="fxt-header">
                    <a href="/" class="fxt-logo"><img src="{{asset('logo.png')}}" alt="Logo" style="width: 150px;"></a>
                    <p>Connect to the Login Server <br> More Secure :)</p>
                </div>
                <div class="fxt-form">
                    <div class="card" style="border: none;">
                        <img src="{{asset('images/data-security.png')}}" alt="Server" width="130" style="margin: auto;margin-top: 15px;">
                        <div class="card-body">
                            <div class="alert alert-warning text-center" style="" role="alert">
                                <strong>Please enter uuid for Connect to the Login Server</strong>
                            </div>
                        </div>
                    </div>
                    <form id="submitRestF" method="POST" action="{{ route('auth.connectToLogin') }}" onsubmit="return false">
                        @csrf
                        <div class="form-group">
                            <div class="fxt-transformY-50 fxt-transition-delay-1">
                                <input id="uuid" type="text" class="form-control @error('uuid') is-invalid @enderror" name="uuid" value="{{ old('uuid') }}"  autocomplete="uuid" placeholder="Enter login uuid" autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="fxt-transformY-50 fxt-transition-delay-3">
                                <div class="fxt-checkbox-area">
                                    <div class="checkbox">
                                        <input type="checkbox" name="save_this_browser" id="save_this_browser">
                                        <label for="save_this_browser">Save this browser</label>
                                    </div>
                                    <a href="{{route('password.showPage')}}" class="switcher-text">Forgot Password</a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: -15px;">
                            <div class="fxt-transformY-50 fxt-transition-delay-4">
                                <button type="submit" class="fxt-btn-fill" id="submitBtn" style="background-color: #eb008b!important;">Connect to the Login Server</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@push('js')
    <script>
        function validationUUID(){""==$("#uuid").val()?($("#uuid").css("border","2px solid red"),$("#uuid").css("background-image","none"),Toast.fire({icon:"error",title:"Please Enter UUID"})):$("#uuid").css("border","1px solid #ced4da")}function connectingError(){clear()}function clear(){$("#submitBtn").html("Connect to the Login Server"),document.getElementById("submitBtn").disabled=!1}$("#submitBtn").click(function(){validationUUID();const e=$("#uuid").val();var t="";t=!0===$("#save_this_browser").prop("checked")?"save_this_browser":"",""==e||($("#submitBtn").html('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div> Connecting...'),document.getElementById("submitBtn").disabled=!0,$.ajax({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},type:"post",dataType:"json",url:"/connect-to/login-server",data:{uuid:e,saveThisBrowser:t},success:function(t){setTimeout(function(){200===t?(Toast.fire({icon:"success",title:"Successfully Connected :)"}),setTimeout(function(){window.open("/admin-server/"+e,"_self")},3e3)):404===t&&setTimeout(function(){Toast.fire({icon:"error",title:"Connection Failed:)"}),connectingError()},1e3)},1e3)},error:function(){location.reload()}}))});
    </script>
    @toastr_js
    @toastr_render
@endpush

