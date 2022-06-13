<?php error_reporting(0); ?>

@extends('member.seller.layouts.app')
@section('title', 'Add Product')

@section('sidebar')
   @include('member.seller.layouts.sidebar') 
@endsection

@section('header')
   @include('member.seller.layouts.header') 
@endsection

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
                            <h3 class="fw-bolder m-0">Quotation Lists</h3>
                        </div>
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
            
                                    <th>Date</th>
            
                                    <th>Name</th> 
                                    <th>Phone</th> 
                                    <th>Email</th> 
            
                                    <th>Service/Products</th> 
            
                                    <th>Qty</th>                                                                                                                 
            
                                    <th>Unit</th>                                                                   
            
                                    <th>Status</th>
            
                                 </tr>
            
                              </thead>
            
                              <tbody>
                                @php
                                $key=1;
                                @endphp
                                
                                @foreach ($data as $value)
                        
                                 <tr>
            
                                    <td>{{$key}}</td>
                                  
                                    <td>{{$value->date}}</td>
                                    <td>{{$value->name}}</td>
            
                                    <td>{{$value->phone}}</td>
                                    <td>{{$value->email}}</td>
            
                                    <td>{{$value->service}}</td>
                                    <td>{{$value->qty}}</td>
                                    <td>{{$value->unit}}</td>
                                    <td>@if($value->quotation_status == 0) <span class="badge badge-warning">Pending</span>@elseif($value->quotation_status == 1) <span class="badge badge-success">Accepted</span>@elseif($value->quotation_status == 2) <span class="badge badge-info">Closed</span>@elseif($value->quotation_status == 3) <span class="badge badge-danger">Cancelled</span>@endif</td>
                                 </tr>
                                @php
                                $key++
                                @endphp
                                
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
@endsection

