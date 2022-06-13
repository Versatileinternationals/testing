<?php error_reporting(0); ?>

@extends('member.buyer.layouts.app')
@section('title', 'Add Product')

@section('sidebar')
   @include('member.buyer.layouts.sidebar') 
@endsection

@section('header')
   @include('member.buyer.layouts.header') 
@endsection

@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-fluid">
        <div class="d-flex flex-column flex-lg-row">
            
            <div class="flex-md-row-fluid ms-lg-12">
                
                <div class="card mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bolder m-0">Product List</h3>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--begin::Card header-->
                    <!--begin::Content-->
                    <div class="card-body">

                         <div class="table-responsive">
            
                           <table class="table table-bordered" >
            
                              <thead>
            
                                 <tr>
            
                                    <th>#</th>
            
                                    <th>Image</th>
            
                                    <th>Name</th> 
            
                                    <!--<th>Brand</th> -->
            
                                    <th>Price</th>                                                                                                                 
            
                                   <!-- <th>Stock</th>   -->                                                                
            
                                    <th style="width:20%">Action</th>
            
                                 </tr>
            
                              </thead>
            
                              <tbody>
            
                                 @foreach ($products as $value)
            
                                 <tr>
            
                                    <td>{{'#'.$value->product_number}}</td>
            
                                    <td>
            
                                       @if($value->image == "")
            
                                          <img src="{{url('assets/images/noimage.png')}}" height="100px" width="150px">
            
                                       @else
            
                                          <img src="{{url('assets/images/upload/'.explode(",",$value->image)[0])}}" height="100px" width="auto">
            
                                       @endif
            
                                    </td>                        
            
                                    <td>{{$value->name}}</td>
            
                                   <!-- <td>{{$value->brand}}</td>-->
            
                                    <td><span class="text-danger"><strike>{{$value->regular_price}}</strike></span>{{$value->sale_price}}USD</td>
            
                                   <!--  <td>{{$value->stock.'pc.'}}</td> -->                      
            
                                    <td>
            
                                        <a href='{{url('member/edit-product/'.encrypt($value->id))}}' class='btn btn-primary btn-sm'> <i class="fa fa-edit"></i></a>
            
                                        <a href='#' class='btn btn-warning btn-sm'> <i class="fa fa-eye"></i></a>
            
                                        <a href='#' class='btn btn-info btn-sm'> <i class="fa fa-image"></i></a>
            
                                    </td>
            
                                 </tr>
            
                                 @endforeach
            
                              </tbody>
            
                           </table>
            
                         </div>
            
                       </div>
                    <!--end::Content-->
                </div>
                <!--end::Basic info-->
                
            </div>
            <!--end::Layout-->
        </div>
    </div>
    <!--end::Container-->
</div>

@endsection


@section('footer')
   @include('member.buyer.layouts.footer') 
@endsection

