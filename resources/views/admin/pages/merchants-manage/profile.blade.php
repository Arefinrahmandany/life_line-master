@extends('layouts.admin',['title'=> $merchant->full_name])
@push('style')

@endpush
@section('content')
    <!-- Bread crumb and right sidebar toggle -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">{{Str::limit($merchant->full_name,29)}}</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Merchants Manage</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.merchants')}}">Merchant</a></li>
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
            <div class="card"> <img class="card-img" src="{{storage_url(@$merchant->shop->image)}}" height="456" alt="Card image">
                <div class="card-img-overlay card-inverse text-white social-profile d-flex justify-content-center">
                    <div class="align-self-center"> <img src="{{user_profile_photo($merchant)}}" class="img-circle" width="100px" height="100px">
                        <h4 class="card-title">{{$merchant->full_name}}</h4>
                        <h6 class="card-subtitle">{{@$merchant->type->name}}</h6>
                        <small>
                            @if($merchant->phone_verified_at != null)
                                <span class="badge badge-primary" title="Merchant is Verified"> <i class="ti-check-box"></i>&nbsp; Verified</span>
                            @else
                                <span class="badge badge-warning" title="Merchant is Unverified"> <i class="ti-alert"></i>&nbsp; Unverified</span>
                            @endif
                            @if($merchant->is_active)
                                <span class="badge badge-success" title="Merchant is Active"> <i class="ti-user"></i>&nbsp; Active</span>
                            @else
                                <span class="badge badge-danger" title="Merchant is Inactive"> <i class="ti-na"></i>&nbsp; Inactive</span>
                            @endif
                                <hr style="border-top: 1px solid rgb(255 253 253 / 16%);margin-bottom: 5px;margin-top: 5px;">
                                @if(Carbon\Carbon::now()->diffInWeeks($merchant->created_at, false)===0)<span class="badge badge-info badge-sm">New</span>@endif
                                <span class="badge badge-cyan badge-sm" title="Merchant Register {{$merchant->created_at->diffForHumans()}} ">{{$merchant->created_at->diffForHumans()}}</span>
                                <span class="badge badge-cyan badge-sm" title="Merchant Register at {{format_datetime($merchant->created_at)}}">{{format_datetime($merchant->created_at)}}</span>
                        </small>
                        <hr style="border-top: 1px solid rgb(255 253 253 / 16%);margin-top: 5px;">
                       <div style="background: #383953ad;padding: 15px;border-radius: 15px;">
                            @if($merchant->shop)<h6>{{@$merchant->shop->type->name}}: <strong> <a href="{{route('admin.shops.profile.show',$merchant->shop->slug)}}">{{Str::limit(@$merchant->shop->name,25)}} <span class="badge badge-primary" title="Total Product">{{@$merchant->shop->products->count()}}</span> </a></strong></h6>@else Shop: Not Found!  @endif
                        <small>
                            @if(@$merchant->shop->is_verified)
                                <span class="badge badge-primary mt-2" title="{{@$merchant->shop->type->name}} is Verified"> <i class="ti-check-box"></i>&nbsp; Verified</span>
                            @else
                                <span class="badge badge-warning mt-2" title="{{@$merchant->shop->type->name}} is Unverified"> <i class="ti-alert"></i>&nbsp; Unverified</span>
                            @endif
                            @if(@$merchant->shop->is_active)
                                <span class="badge badge-success mt-2" title="{{@$merchant->shop->type->name}} is Active"> <i class="ti-shopping-cart"></i>&nbsp; Active</span>
                            @else
                                <span class="badge badge-danger mt-2" title="{{@$merchant->shop->type->name}} is Inactive"> <i class="ti-na"></i>&nbsp; Inactive</span>
                            @endif
                        </small>
                       </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body"> <small class="text-muted">Email address </small>
                    <h6>{{$merchant->email}}</h6> <small class="text-muted p-t-30 db">Phone</small>
                    <h6>{{$merchant->phone}}</h6>
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
                        @include('admin.pages.merchants-manage.profile-update-form')
                    </div>
                    <div class="tab-pane animated fadeIn" id="settings" role="tabpanel">
                        <div class="card-body">
                            <form action="{{route('admin.user.change-password',$merchant->id)}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                @csrf
                                <div class="form-row">
                                    <h6 class="font-weight-bold">Make Active/Inactive</h6>
                                    <div class="col-md-12 mb-3">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="activeInactiveStatus" {{ $merchant->is_active ? 'checked' : '' }}>
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
