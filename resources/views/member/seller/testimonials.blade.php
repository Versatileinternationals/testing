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
                            <h3 class="fw-bolder m-0">Client Testimonials</h3> 
								@if (session('status'))
									<div class="alert alert-success">
										 <p>{{ session('status') }}</p>
										 </div>
									@endif 
                        </div>
					
						@if(session()->has('message'))
							<div class="alert alert-success">
								{{ session()->get('message') }}
							</div>
						@endif
                        <!--end::Card title-->
                    </div>
					<div class="row">
					<div class="col-md-9"></div>
					<div class="col-md-3"><a style="float:right" a href="{{url('seller/add-testimonials')}}"  class="btn btn-success me-2 mb-2"><i class="fa fa-add" aria-hidden="true"></i> Add Testimonials</a></div>
					</div>
                    <!--begin::Card header-->
                    <!--begin::Content-->
                    <div class="card-body">

                         <div class="table-responsive">
            
                           <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive" style="width: 100%;">
            
                              <thead>
            
                                 <tr>
            
                                <th>#</th>
                                <th>Name</th>
								<th>Description</th>
								<th>Designation</th> 
								<th>Country</th>                          
								<th>Status</th>           
                               <th>Action</th>  
            
                                 </tr>
            
                              </thead>
            
                              <tbody>
                                @php
                                $key=1;
                                @endphp
                                
                                @foreach ($ClientTestimonials as $value)
                        
                                 <tr>
            
                                    <td>{{$key}}</td>
                                  
                                    <td>{{$value->name}}</td>
                                    <td>{{$value->description}}</td>
            
                                    <td>{{$value->designation}}</td>
                                    <td>{{$value->country}}</td>
            
                                    <td>@if($value->Status == 1)
										<span class="badge badge-success ">Active</span>
									@elseif($value->Status == 0)
									<span class="badge badge-warning">InActive</span>
									
									
									@endif</td>
                                    
                                    <td>
									 <a href="{{url('seller/delete_testimonials/'.$value->id)}}" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger me-2 mb-2"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        <a href="{{url('seller/edit-testimonial/'.$value->id)}}" class="btn btn-primary me-2 mb-2"> <i class="fa fa-edit"></i></a>
            
                                      
									</td>
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

