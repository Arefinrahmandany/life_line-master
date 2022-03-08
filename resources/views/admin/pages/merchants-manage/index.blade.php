@extends('layouts.admin',['title'=>'Merchants'])
@section('content')
    <!-- Bread crumb and right sidebar toggle -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Select Merchant</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Merchants Manage</a></li>
                    <li class="breadcrumb-item active">Select Merchant</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- End Bread crumb and right sidebar toggle -->
    <livewire:admin.merchants-component :route="'merchants_manage'">
    <!-- End Page Content -->
@stop
@push('script')
    <script>
    </script>
@endpush
