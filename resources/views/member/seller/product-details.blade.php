<?php error_reporting(0); ?>

@extends('member.seller.layouts.app')
@section('title', 'Add Product')

@section('sidebar')
   @include('member.seller.layouts.sidebar') 
@endsection

@section('header')
   @include('member.seller.layouts.header') 
@endsection
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-fluid">
        <div class="d-flex flex-column flex-lg-row">
            
            <div class="flex-md-row-fluid">
                
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
            
                           <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive" style="width: 100%;">
            
                              <thead  class="table-light">
            
                                 <tr>
            
                                    <th>Date</th>
            
                                    <th>ID</th>
            
                                    <th>Image</th>
            
                                    <th>Name</th> 
            
                                    <th>Status</th> 
            
                                    <th>Price</th>                                                                                                                 
            
                                   <!-- <th>Stock</th>   -->                                                                
            
                                    <th style="width:20%">Action</th>
            
                                 </tr>
            
                              </thead>
            
                              <tbody>
            
                                 @foreach ($products as $value)
            
                                 <tr>
                                     
                                     <td>
									 <?php   $timestamp = strtotime($value->created_at);
									       $new_date=date("d-M-Y", $timestamp); ?>
									 
									 {{$new_date}}</td>
            
                                    <td>{{'#'.$value->product_number}}</td>
            
                                    <td>
            
                                       @if($value->main_image == "")
            
                                          <img src="{{url('assets/images/noimage.png')}}" height="100px" width="150px">
            
                                       @else
            
                                          <img src="{{url('assets/images/upload/'.explode(",",$value->main_image)[0])}}" height="100px" width="auto">
            
                                       @endif
            
                                    </td>                        
            
                                    <td>{{$value->name}}</td>
            
                                    @if($value->status=='1')
                                    <td><span class="badge badge-success">Approved</span></td>
                                    @elseif($value->status=='Pending')
                                    <td><span class="badge badge-warning">Pending</span></td>
                                    @elseif($value->status=='0')
                                    <td><span class="badge badge-danger">Disapproved</span></td>
                                    @else
                                    <td><span class="badge badge-warning">Pending</span></td>
                                    @endif
            
                                    
            
                                    <td><span class="text-danger"><strike>{{ $value->regular_price }}</strike></span>&nbsp;<span class="">{{ $value->sale_price }}</span>&nbsp BZ$</td>
            
                                   <!--  <td>{{$value->stock.'pc.'}}</td> -->                      
            
                                    <td>
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger me-2 mb-2" name="delete" id="delete_product" value="{{$value->id}}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                        <a href="{{url('seller/edit-product/'.encrypt($value->id))}}" class="btn btn-primary me-2 mb-2"> <i class="fa fa-edit"></i></a>
            
                                        <a href='#' class='btn btn-info me-2 mb-2'> <i class="fa fa-eye"></i></a>
            
                                      <!--  <a href='#' class='btn btn-info btn-sm'> <i class="fa fa-image"></i></a>-->
            
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
   @include('member.seller.layouts.footer') 
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <script>
   $("#delete_product").click(function(){
       var id = $(this).val();
       $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if(confirm('Are you sure you want to delete this?')) {
        $.ajax({
            type:"POST",
            url:"/seller/delete/"+id,
            success:function(data)
            {
                console.log(data)
                if(data.status == 200)
                {
                    alert(data.success);
                   window.location.href = '/seller/product-details';
                }
            }
        });
        }
   })
   </script>
   
 
@endsection

