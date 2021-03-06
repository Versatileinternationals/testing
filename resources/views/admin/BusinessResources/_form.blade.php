@extends('admin.layouts.light.master')
@section('title', 'Edit Business Resources')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Edit {{$moduleName}}</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{$moduleName}}</li>
<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <form method="post" action="{{url('business_resources/'.$BlzRes->id)}}" class="form theme-form" enctype="multipart/form-data">
                @csrf
               
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                        <label class="col-form-label">Resource Name</label>
                        <input class="form-control" type="text" value="{{old('resource_name',$BlzRes->resource_name)}}" name="resource_name" placeholder="Enter Name">
                        @error('resource_name')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Resource Links</label>
                      <input class="form-control" type="text" value="{{old('resource_links',$BlzRes->resource_links)}}" name="resource_links" placeholder="Resource Links">
                      
                    </div>
                  </div>
                </div>
               
                
                <div class="row">      
                  <div class="col-6">
                    
					 <div class="form-group mb-3">
                      <label class="col-form-label">Upload Document</label>
                      <input class="form-control" type="file" value="{{old('document_upload')}}" name="document_upload" >
                      
                    </div>
					 @if($BlzRes->document_upload == "")
					 <img src="{{url('assets/images/noimage.png')}}" class="??mg table-img">
				 @else
					 <img src="{{url('assets/images/upload/'.$BlzRes->document_upload)}}" class="??mg table-img">
					 
                           @endif
                  </div>              
                 
				 <div class="col-6">
                    
					 <div class="form-group mb-3">
                      <label class="col-form-label">Video Upload</label>
                      <input class="form-control" type="file" value="{{old('resource_video')}}" name="resource_video" >
                      
                    </div>
					 <video width="100" height="80" controls>
  <source src="{{url('assets/video/'.$BlzRes->resource_video)}}" type="video/mp4">
  <source src="{{url('assets/video/'.$BlzRes->resource_video)}}" type="video/ogg">
                  </div>    
				  
                </div> 
              <div class="row">  
			   <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Status</label>
                      <select class="js-example-basic-single select2 col-sm-12 form-select" name="Status" id="status">                                                  
                        <option value="1" {{old('Status',$BlzRes->Status) =="1"? 'selected' : ''}}>Active</option>
                        <option value="0" {{old('Status',$BlzRes->Status) =="0"? 'selected' : ''}}>InActive</option>
                      </select>  
                      
                    </div>
                  </div>   
			  
			  </div>
                                       
                <div class="row">
                  <div class="col-12">
                    <div>
                      <button type="submit" class="btn btn-primary me-3">Save</button>
                      <a href="{{url('blzinvst_business_resources')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection

@section('script')
@endsection