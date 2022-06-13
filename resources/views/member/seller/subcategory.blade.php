<?php error_reporting(0); ?>

@extends('member.seller.layouts.app')
@section('title', 'Add Category')

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
                            <h3 class="fw-bolder m-0">Category</h3> 
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
					<div class="col-md-3"><a style="float:right" a href="{{url('seller/subcategory/create')}}"  class="btn btn-success me-2 mb-2"><i class="fa fa-add" aria-hidden="true"></i> Add SubCategory</a></div>
					</div>
                    <!--begin::Card header-->
                    <!--begin::Content-->
                    <div class="card-body">

                                    <div class="table-responsive">
            
                           <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive" style="width: 100%;">
            
                              <thead  class="table-light">
            
                                 <tr>
								
								<th>Image</th>
								<th>Name</th>  
								<th>Category</th>                                               
								<th>Status</th>                                                                   
								<th>Action</th>
                                </tr>
            
                              </thead>
            
                              <tbody>
            
                                 @foreach ($subcategory as $value)
            
                                 <tr>
                                     <td>
            
                                       @if($value->image == "")
            
                                          <img src="{{url('assets/images/noimage.png')}}" height="100px" width="150px">
            
                                       @else
            
                                          <img src="{{url('assets/images/upload/'.explode(",",$value->image)[0])}}" height="100px" width="150px">
            
                                       @endif
            
                                    </td>                        
            
                                      <td>{{$value->name}}</td>
                                   
                                   
								
								<td>{{$value->category->name}}</td>
								</td>     
                                    @if($value->status=='1')
                                    <td><span class="badge badge-success">Approved</span></td>
                                    @elseif($value->status=='Pending')
                                    <td><span class="badge badge-warning">Pending</span></td>
                                    @elseif($value->status=='0')
                                    <td><span class="badge badge-danger">Disapproved</span></td>
                                    @else
                                    <td><span class="badge badge-warning">Pending</span></td>
                                    @endif
            
                               
            
                                    
                                   <!--  <td>{{$value->stock.'pc.'}}</td> -->                      
            
                                    <td>
                                      <!--  <button type="submit" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger me-2 mb-2" name="delete" id="delete_product" value="{{$value->id}}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                        <a href="{{url('seller/edit-product/'.encrypt($value->id))}}" class="btn btn-primary me-2 mb-2"> <i class="fa fa-edit"></i></a>-->
            
                                        
                                      <!--  <a href='#' class='btn btn-info btn-sm'> <i class="fa fa-image"></i></a>-->
            
                                    </td>
            
                                 </tr>
            
                                 @endforeach
            
                              </tbody>
            
                           </table>
            
                         </div>
                         </div>
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

