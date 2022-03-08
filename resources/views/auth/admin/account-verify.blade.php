@extends('layouts.admin-auth',['title'=>'Account Verification'])
@section('content')
    <div id="accountVerifyForm" class="row align-items-center justify-content-center">
        <div class="col-xl-6 col-lg-7 col-sm-12 col-12 fxt-bg-color">
            <div class="ms-bar-login"style="z-index:99;">
                <div></div>
            </div>
            <div class="fxt-content ms-blur-bg">
                <div class="fxt-header">
                    <a href="#" class="fxt-logo"><img src="{{asset('logo.png')}}" alt="Logo" style="width: 150px;"></a>
                    <p>Please verify your account</p>
                </div>
                <div class="fxt-form">
                    <div class="card">
                        <img src="{{asset('images/phone.png')}}" alt="Phone" width="60" style="margin: auto;margin-top: 15px;">
                        <div class="card-body">
                            <strong> Verification code has been sent to your phone.</strong>
                            <br> <br>
                            <div class="alert alert-success" style="background-color:#00ff6c8c;" role="alert">
                                Check your mobile device: <strong id="last3DigitPhone"></strong>
                            </div>
                            {{--Didn't get the verification code?  We can <strong style="cursor: pointer;" id="resendSms">resend</strong> it.--}}
                        </div>
                    </div>
                    <br>
                    <form id="fromdDusm" method="POST" action="{{route('account.verify')}}">
                        @csrf
                        <input type="text" style="display: none" name="phone" id="phone" value="{{$phone}}">
                        <div class="form-group">
                            <div class="fxt-transformY-50 fxt-transition-delay-1">
                                <input type="number" id="verify_code" class="form-control" name="verify_code" onkeyup="validation1add()" placeholder="Enter 6-Digits Verification Code" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="fxt-transformY-50 fxt-transition-delay-4">
                                <button type="submit" class="fxt-btn-fill btn-verify-admin" id="btn-verify-admin" style="background-color: #eb008b!important;">Verify</button>
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
        const phone = $('#phone').val();
        $('#last3DigitPhone').text('(xxx)-xxx-'+phone.replace(/\d(?=\d{4})/g, ""));
        $('#fromdDusm').submit(function(){
            $('.ms-bar-login').addClass("ms-bar");
            $('.ms-blur-bg').css("filter","blur(5px)");
            document.getElementById("btn-verify-admin").disabled = true;
            $('.invalid-feedback3').css("display","none");
        });
    </script>
@endpush
