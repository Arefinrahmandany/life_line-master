<div style="{{$data}}" id="loginForm" class="row align-items-center justify-content-center">
    <div class="col-xl-6 col-lg-7 col-sm-12 col-12 fxt-bg-color">
        <div class="ms-bar-login"style="z-index:99;">
            <div></div>
        </div>
        <div class="fxt-content ms-blur-bg">
            <div class="fxt-header">
                <a href="/" class="fxt-logo"><img src="{{asset('logo.png')}}" alt="Logo" style="width: 150px;"></a>
                <p>Login into your account</p>
            </div>
            <div class="fxt-form">
                <form method="POST" onsubmit="return false">
                    @csrf
                    <div class="form-group">
                        <div class="fxt-transformY-50 fxt-transition-delay-1">
                            <input type="number" id="phone" class="form-control" name="phone" onkeyup="validation1add()" placeholder="Phone" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="fxt-transformY-50 fxt-transition-delay-2">
                            <input id="password" type="password" class="form-control" onkeyup="validation2add()" name="password" placeholder="Password" required="required">
                            <i toggle="#password" class="fa fa-fw fa-eye toggle-password field-icon"></i>
                        </div>
                        <span class="invalid-feedback3 fas fa-exclamation-triangle animated" style="display: none; margin-top: 15px!important;padding:0px;color:red;font-size: 13px;"role="alert">&nbsp;&nbsp; These credentials do not match our records.</span>
                    </div>
                    <div class="form-group">
                        <div class="fxt-transformY-50 fxt-transition-delay-3">
                            <div class="fxt-checkbox-area">
                                <div class="checkbox">
                                    <input id="checkbox1" type="checkbox" name="remember" id="remember">
                                    <label for="checkbox1">Keep me logged in</label>
                                </div>
                                <a href="{{route('password.showPage')}}" class="switcher-text">Forgot Password</a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="fxt-transformY-50 fxt-transition-delay-4">
                            <button type="submit" class="fxt-btn-fill btn-login-admin" id="btn-login-admin" style="background-color: #eb008b!important;">Log in</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
