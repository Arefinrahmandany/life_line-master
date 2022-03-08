<div style="display: none;" id="twoFactorAuthenticationForm" class="row align-items-center justify-content-center">
    <div class="col-xl-6 col-lg-7 col-sm-12 col-12 fxt-bg-color">
        <div class="ms-bar-login"style="z-index:99;">
            <div></div>
        </div>
        <div class="fxt-content ms-blur-bg">
            <div class="fxt-header">
                <a href="#" class="fxt-logo"><img src="{{asset('logo.png')}}" alt="Logo" style="width: 150px;"></a>
            </div>
            <div class="fxt-form">
                <div class="card" style="border: none;">
                    <img src="{{asset('images/2fa-icon.png')}}" alt="Phone" width="130" style="margin: auto;margin-top: 15px;">
                    <div class="card-body">
                        <p style="font-size: 22px;">Two-step verification</p>
                        <p>Thanks for keeping your account secure.</p>
                        <div class="alert alert-success" style="background-color:#00ff6c8c;" role="alert">
                            Check your mobile device: <strong id="last3DigitPhone"></strong>
                        </div>
                    </div>
                </div>
                <form method="POST" onsubmit="return false">
                    @csrf
                    <div class="form-group">
                        <div class="fxt-transformY-50 fxt-transition-delay-1">
                            <lablel style="margin-bottom: 5px;"><strong>Your Verification Code</strong></lablel>
                            <input type="number" id="verify_code" class="form-control" name="verify_code" onkeyup="validation1add()" placeholder="Enter 6-Digit Code" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="fxt-transformY-50 fxt-transition-delay-4">
                            <button type="submit" class="fxt-btn-fill btn-verify-admin" id="btn-verify-admin" style="background-color: #eb008b!important;">Log In Securely</button>
                        </div>
                    </div>
                </form>
            </div>


            <div class="fxt-footer">
                <div class="fxt-transformY-50 fxt-transition-delay-9">
                    <p>Didn't get the verification code?  We can <strong style="cursor: pointer;text-decoration: underline;" id="resendSms">resend</strong> it.</p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        function validationVerifyCode(){""==$("#verify_code").val()?($("#verify_code").css("border","2px solid red"),$("#verify_code").css("background-image","none"),Toast.fire({icon:"error",title:"Enter 6-digit verify code"})):$("#verify_code").css("border","1px solid #ced4da")}function loginErrorVerify(){clear2(),Toast.fire({icon:"error",title:"Verify code is wrong."})}function clear2(){$(".ms-bar-login").removeClass("ms-bar"),$(".ms-blur-bg").css("filter","blur(0px)"),document.getElementById("btn-verify-admin").disabled=!1}function verifyCodeIsExpired(){clear(),Toast.fire({icon:"error",title:"Verify code is expired."})}$("#resendSms").click(function(){$(".ms-bar-login").addClass("ms-bar"),$(".ms-blur-bg").css("filter","blur(5px)"),document.getElementById("btn-verify-admin").disabled=!0;const e=$("#phone").val();$.ajax({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},type:"post",dataType:"json",url:"/admin-server/resend/2fa-code",data:{phone:e},success:function(e){setTimeout(function(){200===e?(Toast.fire({icon:"success",title:"The code has been sent to your phone."}),clear2()):404===e&&setTimeout(function(){clear2(),Toast.fire({icon:"error",title:"Try again later."})},1e3)},1e3)},error:function(){location.reload()}})}),$(".btn-verify-admin").click(function(){validationVerifyCode();const e=$("#phone").val(),o=$("#password").val(),r=$("#verify_code").val();""==e||""==o||""==r||($(".ms-bar-login").addClass("ms-bar"),$(".ms-blur-bg").css("filter","blur(5px)"),document.getElementById("btn-verify-admin").disabled=!0,$.ajax({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},type:"post",dataType:"json",url:"/admin-server/login/2fa-check-points",data:{phone:e,password:o,verify_code:r},success:function(e){setTimeout(function(){200===e?(Toast.fire({icon:"success",title:"You are successfully login:)"}),setTimeout(function(){window.open("/admin/dashboard","_self")},1e3)):401===e?verifyCodeIsExpired():404===e&&setTimeout(function(){loginErrorVerify()},1e3)},1e3)},error:function(){location.reload()}}))});
    </script>
@endpush
