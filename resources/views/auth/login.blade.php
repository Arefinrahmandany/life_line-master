@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div style="background: linear-gradient(#8ff3dab0, #82f7d78a)!important; padding: 5px;border-top-left-radius: 15px;border-top-right-radius: 15px;">
                    <center>
                        <img src="{{asset('logo.png')}}" alt="" width="100%;" style="border-radius: 10px;height: 70px;">
                    </center>
                </div>
                <br>
                <div class="card" style="background: linear-gradient(#8ff3da00, #82f7d736)!important;border: none;box-shadow: 0 0 20px 1px #00000029;">
                    <div class="card-header text-center" style="background: linear-gradient(#54bda1, #43c5a400)!important">
                        <img src="{{asset('images/users/defaultMaleAvatar.png')}}" alt="" width="35px;">
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}" id="submitLoginF">
                            @csrf

                            <div class="form-group row" style="margin-bottom: .5rem;">
                                <div class="col-md-6 m-auto">
                                    <label for="userid" class="text-md-right text-white" style="margin-bottom: 0.1rem;">{{ __('User ID') }}</label>
                                    <input id="userid" type="text" class="form-control @error('userid') is-invalid @enderror" name="userid" value="{{ old('userid') }}" placeholder="Enter User ID" required autocomplete="userid" autofocus>
                                    @error('userid')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" style="margin-bottom: .5rem;">
                                <div class="col-md-6 m-auto">
                                    <label for="password" class="text-white" style="margin-bottom: 0.1rem;">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter your password" required autocomplete="current-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-block" id="submitBtn">
                                        <img src="{{asset('images/users/admin-transparent-png-images-pngbarn-admin-png-350_350.png')}}" width="25px;" alt="">  {{ __('Login') }}
                                    </button>

                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link mt-0" style="color:#4affbca8;margin-left: -10px;" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $('#submitLoginF').submit(function () {
            $('#submitBtn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Login...');
            document.getElementById('submitBtn').disabled = true;
        });
    </script>
@endsection
