@extends('layouts.admin',['title'=>'Category'])
@push('style')
@endpush
@section('content')
    <!-- Bread crumb and right sidebar toggle -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Product Category <div class="btn btn-primary btn-sm msModalTrigger"><i class="ti-plus"></i> Add New</div> </h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Settings</a></li>
                    <li class="breadcrumb-item active">Product Category</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- End Bread crumb and right sidebar toggle -->
    <livewire:admin.category-component :typeId="'1'"/>
    <!-- End Page Content -->
@stop
@push('script')
@endpush
