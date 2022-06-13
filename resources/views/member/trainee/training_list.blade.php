<?php error_reporting(0); ?>

@extends('member.trainee.layouts.app')
@section('title', 'Training Lists')

@section('sidebar')
@include('member.trainee.layouts.sidebar')
@endsection

@section('header')
@include('member.trainee.layouts.header')
@endsection

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-fluid">
        <div class="d-flex flex-column flex-lg-row">

            <div class="flex-md-row-fluid">

                <div class="card mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                        data-bs-target="#kt_account_profile_details" aria-expanded="true"
                        aria-controls="kt_account_profile_details">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bolder m-0">Training Lists</h3>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--begin::Card header-->
                    <!--begin::Content-->
                    <div class="card-body">

                        <div class="table-responsive">

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive"
                                style="width: 100%;">

                                <thead>

                                    <tr>

                                        <th>Training Name</th>
                                        <th>Category</th>
                                        
                                        <th>Course </th>
                                        <th>Status</th>
                                        <!--<th>Complate Payment</th>-->
                                        <th style="width:20%">Action</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach ($TrainingLists as $value)
                                  
                                    <tr>
                                        <td>{{$value->TrainingName}}</td>
                                        <td>{{$value->name}}</td>
                                        <td>{{$value->Course_Name}}</td>
                                       <td>
                                           @if($value->status == 0)
                                           Pending
									      @elseif($value->status == 1)
                                           Pre- Assessment
                                           @elseif($value->status == 4)
                                           Completed
                                           @endif
                                       </td>
                                      
                                        <!--<td><a href="view_payment/{{$value->id}}">View Payment</a></td>-->
                                        
                                           <td class="text-end">
													<a href="#" class="btn btn-primary  btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions 
													<!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
													<span class="svg-icon svg-icon-5 m-0">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon--></a>
													<!--begin::Menu-->
													<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
														<!--begin::Menu item-->
														<div class="menu-item px-3">
														 <a href='#' class='btn btn-warning btn-sm'> <i class="fa fa-eye"></i></a>
															
														</div>
														<!--end::Menu item-->
														<!--begin::Menu item-->
														@if($value->status == 4)
														<div class="menu-item px-3">
															<a href='{{url("/trainee/certificate")}}' class='btn btn-success btn-sm'>
                                                  Certificate</a>
														</div>
														@endif
												<div class="menu-item px-3">
														 <a href="/trainee/add_payment/{{encrypt($value->id)}}" class='btn btn-info btn-sm'>
                                                Payment</a>
												</div>
											<div class="menu-item px-3">	
											@if($value->status == 4)
                                           <a href="/trainee/feedback_form/{{encrypt($value->id)}}" class='btn btn-success btn-sm'>
                                                Feedback</a>
                                           @endif
											</div>	
											
											<div class="menu-item px-3">	
											@if($value->status == 1)
                                           <a href="/trainee/pre_assessment/{{encrypt($value->id)}}" class='btn btn-success btn-sm'>
                                                Pre-Assessment</a>
                                           @endif
											</div>	
											<div class="menu-item px-3">	
											@if($value->status == 1)
                                           <a href="/trainee/training_content/{{encrypt($value->id)}}" class='btn btn-success btn-sm'>
                                                Content</a>
                                           @endif
											</div>	
														<!--end::Menu item-->
													</div>
													<!--end::Menu-->
												</td> 

                                            
                                           
											<!----	 --->
                                           
                                          
                                        </div>
                                      

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
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
$(document).ready(function(){
  $(".dropdown-toggle").click(function()
  {
     $(".dropdown-menu").show(); 
  });
});
</script>
@endsection


@section('footer')
@include('member.seller.layouts.footer')
@endsection