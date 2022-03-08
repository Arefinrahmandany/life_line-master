@extends('user-panel.layouts.app')
@section('page-title') Dashboard @endsection
@section('content')
<div class="content-wrapper">
  <div class="page-header mb-2">
    <h3 class="page-title ms_x_card_s"style="padding:5px!important;">
      <span class="page-title-icon bg-gradient-info text-white mr-2">
        <i class="mdi mdi-home"></i>
      </span> Dashboard </h3>
    <nav aria-label="breadcrumb">
      <ul class="breadcrumb ms_x_card_s"style="padding:5px!important;">
        <li class="breadcrumb-item active" aria-current="page">
          <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
        </li>
      </ul>
    </nav>
  </div>
    <style>
        .form-group{padding: 5px;}
    </style>
    <div class="row">
        <div class="col-8 mb-3">

{{--            <div class="card ms_x_card_s">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-6 stretch-card grid-margin" style="margin-bottom:.1rem!important;margin-top:.3rem!important;">--}}
{{--                            <div class="card z-depth-1 bg-gradient-success card-img-holder text-white" style="height:80px;">--}}
{{--                                <div class="card-body" style="padding:.25rem!important;">--}}
{{--                                    <h4 class="font-weight-normal mb-3" style="font-size:15px;"> Notifications <i class="mdi mdi-bell-alert menu-icon mdi-24px float-right"></i></h4>--}}
{{--                                    <h2 class="mb-5 counter" style="font-size:25px;"></h2>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

            <div class="card ms_x_card_s">
                <div class="card-body">
                    <h4 class="font-weight-normal mb-3 font-weight-bold" style="font-size:18px;"> Pending Orders List <i class="mdi mdi-history menu-icon mdi-24px float-right"></i></h4>
                    <div class="table-responsive">
                        <table class="table table-bordered ">
                            <thead style="background: #e7eff7;">
                            <tr>
                                <th>Customer Name</th>
                                <th>Phone</th>
                                <th>Total Deposit</th>
                                <th>Total Limit</th>
                                <th>Order Amount</th>
                                <th>Order Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

{{--        news feeds--}}
        <div class="col-4 mb-3">
            <div class="card ms_x_card_s">
                <div class="card-body">
                    <div class="card-header">
                        <h6>News & Offer</h6>
                    </div>
                    <div class="row">

                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection
