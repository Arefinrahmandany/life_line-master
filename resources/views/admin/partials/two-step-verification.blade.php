<!-- Modal structure -->
<div id="msModal3" data-iziModal-fullscreen="false" data-iziModal-title="EGSHOP 2-Step Verification"  data-iziModal-subtitle="Stronger security for your EGSHOP Account <br>With 2-Step Verification, you’ll protect your account with both your password and your phone"  data-iziModal-icon="icon-cart">
    <div id="form-submitting-progress-bar2" class="iziModal-progressbar display-none">
        @component('components.ms-progress-bar')@endcomponent
    </div>
    <div class="iziModal-content-body">
        <input type="text" value="{{current_user()->phone}}" style="display: none!important;" id="phonew">
        <form id="2StepVerificationPwdCheckForm" onsubmit="event.preventDefault(); twoStepActivePwdCheckingForm();" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <center>
                <img src="{{user_profile_photo($user)}}" class="img-circle" width="100px" height="100px" style="border: 3px solid #eb008b;" />
                <h4>{{current_user()->full_name}}</h4>
            </center>
            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <input type="password" class="form-control" id="password" readonly onfocus="this.removeAttribute('readonly');" name="password" placeholder="Enter your account password" autocomplete="off" required>
                </div>
            </div>
            <button class="btn btn-primary ms-form-submit-btn btn-block"><i class="ti-check"></i> Submit</button>
        </form>

        <form id="2StepVerificationActiveForm" style="display: none;" onsubmit="event.preventDefault(); twoStepActiveForm();" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <center>
                <img src="{{asset('images/2fa-icon.png')}}" class="img-circle" width="100px" height="100px" style="border: 3px solid #eb008b;" />
                <div class="card" style="border: none;">
                    <div class="card-body">
                        <strong> Verification code has been sent to your phone.</strong>
                        <br> <br>
                        <div class="alert alert-success" style="background-color:#00ff6c8c;" role="alert">
                            Check your mobile device: <strong id="last3DigitPhone"></strong>
                        </div>
                    </div>
                </div>
            </center>
            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <input type="number" id="verify_code" class="form-control" name="verify_code" placeholder="Enter 6-Digit Verify Code" required="required">
                </div>
            </div>
            <button class="btn btn-primary ms-form-submit-btn01 btn-block"><i class=" ti-lock"></i> Enable</button>
        </form>

        <form id="2StepVerificationDeActiveForm" style="display: none;" onsubmit="event.preventDefault(); twoStepDeActiveForm();" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <br>
            <button class="btn btn-primary ms-form-submit-btn11 btn-block"><i class="ti-unlock"></i> Disable</button>
        </form>
    </div>
</div>

@push('script')
    <script>
        const phone = $('#phonew').val();
        $('#last3DigitPhone').text('(xxx)-xxx-'+phone.replace(/\d(?=\d{4})/g, ""));
        function twoStepActivePwdCheckingForm() {
            const password = $('#2StepVerificationPwdCheckForm #password').val();
            if(password == '')
            {
                Toast.fire({
                    icon: 'error',
                    title: 'Please enter your password'
                });
            }else{
                $('#form-submitting-progress-bar2').css('display','block');
                $(".ms-form-submit-btn").prop('disabled', true);
                $(".ms-form-submit-btn").html('<div class="spinner-border spinner-border-sm" role="status"></div>&nbsp; Checking....');

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "get",
                    dataType: "json",
                    url: "/auth-account/2fa-pwd/checking/" + password,
                    data: {password: password,},
                    success: function (resp) {
                        setTimeout(function () {
                            if (resp === 200) {
                                $('#2StepVerificationPwdCheckForm').css('display','none');
                                $('#2StepVerificationActiveForm').css('display','block');
                                $('#form-submitting-progress-bar2').css('display','none');
                                $(".ms-form-submit-btn").prop('disabled', false);
                                $(".ms-form-submit-btn").html('<i class="ti-check"></i> Enable');
                            } else if (resp === 201) {
                                $('#2StepVerificationPwdCheckForm').css('display','none');
                                $('#2StepVerificationActiveForm').css('display','none');
                                $('#2StepVerificationDeActiveForm').css('display','block');
                                $('#form-submitting-progress-bar2').css('display','none');
                                $(".ms-form-submit-btn").prop('disabled', false);
                                $(".ms-form-submit-btn").html('<i class="ti-check"></i> Submit');
                            }else if (resp === 404) {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'Password is wrong'
                                })
                                $('#form-submitting-progress-bar2').css('display','none');
                                $(".ms-form-submit-btn").prop('disabled', false);
                                $(".ms-form-submit-btn").html('<i class="ti-check"></i> Submit');
                            }
                        }, 1000);
                    }, error: function () {
                        location.reload();
                    }
                });
            }
        }

        //twoStepActiveForm
        function twoStepActiveForm() {
            const verify_code = $('#2StepVerificationActiveForm #verify_code').val();
            if(verify_code == '')
            {
                Toast.fire({
                    icon: 'error',
                    title: 'Please enter verify code'
                });
            }else{
                $('#form-submitting-progress-bar2').css('display','block');
                $(".ms-form-submit-btn01").prop('disabled', true);
                $(".ms-form-submit-btn01").html('<div class="spinner-border spinner-border-sm" role="status"></div>&nbsp; Checking....');

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "post",
                    dataType: "json",
                    url: "/auth-account/2fa-pwd/active-deactivate",
                    data: {verify_code: verify_code,type:'active'},
                    success: function (resp) {
                        setTimeout(function () {
                            if (resp === 200) {
                                Toast.fire({
                                    icon: 'success',
                                    title: '2-Step Verification is Enabled'
                                })
                                $('#form-submitting-progress-bar2').css('display','none');
                                $(".ms-form-submit-btn01").prop('disabled', false);
                                $(".ms-form-submit-btn01").html('<i class="ti-check"></i> Enable');
                                setTimeout(function (){
                                    location.reload();
                                },2000);
                            } else if (resp === 401) {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'Verify code is expired'
                                })
                                $('#form-submitting-progress-bar2').css('display','none');
                                $(".ms-form-submit-btn01").prop('disabled', false);
                                $(".ms-form-submit-btn01").html('<i class="ti-check"></i> Enable');
                            }else if (resp === 404) {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'Verify code is wrong'
                                })
                                $('#form-submitting-progress-bar2').css('display','none');
                                $(".ms-form-submit-btn01").prop('disabled', false);
                                $(".ms-form-submit-btn01").html('<i class="ti-check"></i> Enable');
                            }
                        }, 1000);
                    }, error: function () {
                        location.reload();
                    }
                });
            }
        }

        //twoStepDeActiveForm
        function twoStepDeActiveForm() {
            $('#form-submitting-progress-bar2').css('display','block');
            $(".ms-form-submit-btn11").prop('disabled', true);
            $(".ms-form-submit-btn").html('<div class="spinner-border spinner-border-sm" role="status"></div>&nbsp; Checking....');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                dataType: "json",
                url: "/auth-account/2fa-pwd/active-deactivate",
                data: {type:'deactive'},
                success: function (resp) {
                    setTimeout(function () {
                        if (resp === 200) {
                            Toast.fire({
                                icon: 'success',
                                title: '2-Step Verification is Disabled'
                            })
                            $('#form-submitting-progress-bar2').css('display','none');
                            $(".ms-form-submit-btn11").prop('disabled', false);
                            $(".ms-form-submit-btn11").html('<i class="ti-unlock"></i> Disabled');
                            setTimeout(function (){
                                location.reload();
                            },2000);
                        }
                    }, 1000);
                }, error: function () {
                    location.reload();
                }
            });
        }
    </script>
@endpush
