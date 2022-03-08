@extends('layouts.admin',['title'=> current_user()->full_name])
@php($user=current_user())
@push('style')

@endpush
@section('content')
    <!-- Bread crumb and right sidebar toggle -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">{{Str::limit($user->full_name,29)}}</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">My Account</a></li>
                    <li title="Profile" class="breadcrumb-item active">Profile</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- Row -->
    <div class="row">
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-4 col-xlg-3 col-md-5">
            <div class="card">
                <div class="card">
                    <div class="card-body">
                        <center class="m-t-30">
                            <a href="{{user_profile_photo($user)}}" target="_blank" title="Click me for view this profile photo."><img src="{{user_profile_photo($user)}}" class="img-circle" width="100px" height="100px" /></a>
                            <h4 class="card-title m-t-10">{{$user->full_name}}</h4>
                            <h6 class="card-subtitle">{{@$user->type->name}}</h6>
                            <div class="row text-center justify-content-md-center">
                                <small>
                                    @if($user->phone_verified_at != null)
                                        <span class="badge badge-primary" title="User is Verified"> <i class="ti-check-box"></i>&nbsp; Verified</span>
                                    @else
                                        <span class="badge badge-warning" title="User is Unverified"> <i class="ti-alert"></i>&nbsp; Unverified</span>
                                    @endif
                                    @if($user->is_active)
                                        <span class="badge badge-success" title="User is Active"> <i class="ti-user"></i>&nbsp; Active</span>
                                    @else
                                        <span class="badge badge-danger" title="User is Inactive"> <i class="ti-na"></i>&nbsp; Inactive</span>
                                    @endif
                                    <hr style="border-top: 1px solid rgb(255 253 253 / 16%);margin-bottom: 5px;margin-top: 5px;">
                                    @if(Carbon\Carbon::now()->diffInWeeks($user->created_at, false)===0)<span class="badge badge-info badge-sm">New</span>@endif
                                    <span class="badge badge-cyan badge-sm" title="Merchant Register {{$user->created_at->diffForHumans()}} ">{{$user->created_at->diffForHumans()}}</span>
                                    <span class="badge badge-cyan badge-sm" title="Merchant Register at {{format_datetime($user->created_at)}}">{{format_datetime($user->created_at)}}</span>
                                </small>
                            </div>
                        </center>
                    </div>
                    <div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-lg-8 col-xlg-9 col-md-7" style="padding-left: 0px;">
            <div class="card">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs profile-tab" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#profile" role="tab">Profile Update</a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Settings</a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#security" role="tab">Security</a> </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!--second tab-->
                    <div class="tab-pane active animated fadeIn" id="profile" role="tabpanel">
                        @include('admin.auth-account.profile-update-form')
                    </div>
                    <div class="tab-pane animated fadeIn" id="settings" role="tabpanel">
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                @csrf
                                <div class="form-row">
                                    <h6 class="font-weight-bold">Change Password</h6>
                                    <div class="col-md-12 mb-3">
                                        <label for="current_password">Current-Password</label>
                                        <input type="password" minlength="6" class="form-control" id="current_password" name="current_password" placeholder="Enter Current-Password" value="" required>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="password">New-Password</label>
                                        <input type="password" minlength="6" class="form-control" id="password" name="password" placeholder="Enter New-Password" value="" required>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="confirm-password">Confirm-New-Password</label>
                                        <input type="password" minlength="6" class="form-control" id="confirm-password" name="confirm-password" placeholder="Enter Confirm-New-Password" value="" required>
                                    </div>
                                </div>
                                <button class="btn btn-primary"><i class="ti-save"></i> Change</button>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane animated fadeIn" id="security" role="tabpanel">
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                @csrf
                                <div class="form-row">
                                    <h6 class="font-weight-bold">EGSHOP 2-Step Verification @if($user->is_two_factor_auth)<img style="width: 25px;margin-left: 5px;margin-bottom: 4px;" src="{{asset('images/icons/check-mark-green-tick.png')}}" alt="Secure">@endif</h6>
                                    <p>Stronger security for your EGSHOP Account
                                        With 2-Step Verification, you’ll protect your account with both your password and your phone</p>
                                    <div class="col-md-12 mb-3">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input msModalTrigger3" id="activeInactiveStatus" {{ $user->is_two_factor_auth ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="activeInactiveStatus"></label>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
    <!-- Row -->
    <!-- End Page Content -->
    @include('admin.partials.two-step-verification')
@stop

