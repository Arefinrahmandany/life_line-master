@extends('layouts.admin',['title'=> $user->full_name])
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
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Users Manage</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.users')}}">User</a></li>
                    <li title="Shop Type" class="breadcrumb-item active">Profile</li>
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
                    <div class="card-body">
                        <h5 class="text-muted font-weight-bold">Order Calculation </h5>
                        <span class="badge badge-primary" title="Total Orders"> <i class="ti-shopping-cart"></i>&nbsp; Total Orders: <strong>250</strong></span>
                        <span class="badge badge-success" title="Total Completed"> <i class="ti-check"></i>&nbsp; Completed Orders: <strong>150</strong></span>
                        <span class="badge badge-warning" title="Total Returned"> <i class="ti-alert"></i>&nbsp; Returned Orders; <strong>20</strong></span>
                        <span class="badge badge-danger" title="Total Canceled"> <i class="ti-na"></i>&nbsp; Canceled Orders: <strong>50</strong></span>

                        <br/>
                        <br/>
                        <br/>
                        <button class="btn btn-circle btn-secondary"><i class="fab fa-facebook-f"></i></button>
                        <button class="btn btn-circle btn-secondary"><i class="fab fa-twitter"></i></button>
                        <button class="btn btn-circle btn-secondary"><i class="fab fa-youtube"></i></button>
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
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!--second tab-->
                    <div class="tab-pane active animated fadeIn" id="profile" role="tabpanel">
                        @include('admin.pages.users-manage.profile-update-form')
                    </div>
                    <div class="tab-pane animated fadeIn" id="settings" role="tabpanel">
                        <div class="card-body">
                            <form action="{{route('admin.user.change-password',$user->id)}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                @csrf
                                <div class="form-row">
                                    <h6 class="font-weight-bold">Make Active/Inactive</h6>
                                    <div class="col-md-12 mb-3">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="activeInactiveStatus" {{ $user->is_active ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="activeInactiveStatus"></label>
                                        </div>
                                    </div>
                                    <hr>
                                    <h6 class="font-weight-bold">Change Password</h6>
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
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
    <!-- Row -->
    <!-- End Page Content -->
@stop
@push('script')
    <script>
        $(function() {
            $('#activeInactiveStatus').change(function() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!'
                }).then((result) => {
                    if (result.value) {
                            alert("It's working!")
                    }
                })
            })
        })
        function merchantProfileStatus(id){
            alert('done');
            Swal.fire({
                title: 'Are you sure?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.value) {
                    Livewire.emit(eventName,id)
                }
            })
        }
    </script>
@endpush
