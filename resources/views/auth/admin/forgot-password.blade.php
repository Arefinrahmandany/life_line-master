@extends('layouts.admin-auth',['title'=>'Recover your password'])
@push('css')
    @toastr_css
@endpush
@section('content')
    <div class="row align-items-center justify-content-center">
        <div class="col-xl-6 col-lg-7 col-sm-12 col-12 fxt-bg-color" style="border-radius: 15px;">
            <div class="fxt-content" style="border-radius: 15px;">
                <div class="fxt-header">
                    <a href="/" class="fxt-logo"><img src="{{asset('logo.png')}}" alt="Logo" style="width: 150px;"></a>
                    <p>Recover your password</p>
                </div>
                <div class="fxt-form">
                    <form id="submitRestF" method="POST" action="{{ route('password.code') }}">
                        @csrf
                        <div class="form-group">
                            <div class="fxt-transformY-50 fxt-transition-delay-1">
                                <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" placeholder="Enter your phone number" required autocomplete="phone" autofocus>
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="fxt-transformY-50 fxt-transition-delay-4">
                                <button type="submit" class="fxt-btn-fill" id="submitBtn" style="background-color: #eb008b!important;">Send Password Reset Code</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="fxt-footer">
                    <div class="fxt-transformY-50 fxt-transition-delay-9">
                        <p><a href="/" class="switcher-text2 inline-text">Back</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@push('js')
    <script>
        $('#submitRestF').submit(function () {
            $('#submitBtn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending...');
            document.getElementById('submitBtn').disabled = true;
        });
    </script>
    @toastr_js
    @toastr_render
@endpush

