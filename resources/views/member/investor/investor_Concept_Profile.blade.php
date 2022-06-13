<?php error_reporting(0); ?>

@extends('member.investor.layouts.app')
@section('title', 'Add Product')

@section('sidebar')
   @include('member.investor.layouts.sidebar') 
@endsection

@section('header')
   @include('member.investor.layouts.header') 
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
                        <a href="/investor/create-concept" >Add Investor Concept</a>
                        <!--end::Card title-->
                    </div>
                    <!--begin::Card header-->
                    <!--begin::Content-->
                    <div class="card-body">

                         <div class="table-responsive">
            
                           <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive" style="width: 100%;">
            
                              <thead>
            
                                 <tr>
            
                                    <th>#</th>
            
                                    <th>Government Ministry</th>
            
                                    <th>Email</th> 
            
                                    <!--<th>Phone</th> -->
            
                                    <th>Mobile</th>                                                                                                                 
            
                                    <th>Department</th>  
                                    <th>LeadPoint of Contact</th>
                                    <th>Job Title</th>
            
                                    <th style="width:20%">Action</th>
            
                                 </tr>
            
                              </thead>
            
                              <tbody>
            
                                 @foreach ($investor as $value)
            
                                 <tr>
            
                                    <td>{{'#'.$value->id}}</td>
            
                                    <td>{{$value->Government_name}}</td>                        
            
                                    <td>{{$value->email}}</td>
            
                                    <!--<td>{{$value->phone}}</td>-->
            
                                    <td>{{$value->mobile}}</td>
                                    <td>{{$value->Department}}</td> 
                                    <td>{{$value->LeadPointof}}</td>
                                    <td>{{$value->Job_Title}}</td>
                                    <td>
                                        <button type="submit" class="btn btn-danger" name="delete" id="delete_product" value="{{encrypt($value->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                        <a href='{{url('/investor/edit/'.encrypt($value->id))}}' class='btn btn-primary btn-sm'> <i class="fa fa-edit"></i></a>
            
                                        <!--<a href='#' class='btn btn-warning btn-sm'> <i class="fa fa-eye"></i></a>
            
                                        <a href='#' class='btn btn-info btn-sm'> <i class="fa fa-image"></i></a>-->
            
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
            url:"/investor/delete/"+id,
            success:function(data)
            {
                console.log(data)
                if(data.status == 200)
                {
                    alert(data.success);
                   window.location.href = '/investor/investor_concept_detail';
                }
            }
        });
        }
   })
   </script>
@endsection

