@extends('admin.layouts.light.master')
@section('title', 'Add Trainning Stream')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>{{$moduleName}}</h3>
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
              <form method="post" action="{{url('trainning_course/'.$Courses->id)}}" class="form theme-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                        <label class="col-form-label">Course Name</label>
                        <input class="form-control" type="text" value="{{old('Course_Name',$Courses->Course_Name)}}" name="Course_Name" placeholder="Enter Name">
                        @error('Course_Name')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>
                </div>
               
			   <div class="row">
                  <div class="col-12">
				    <label class="col-form-label">Stream Name</label>
                     <select class="js-example-basic-single select2 col-sm-12 form-select" name="stream_id" id="stream_id">                                                  
                          <option value="">Select Stream</option>
                          @foreach ($Streams as $value)
                          <option value="{{$value->id}}" {{old('stream_id',$Courses->stream_id) ==$value->id? 'selected' : ''}}>{{$value->name}}</option>    
                          @endforeach
                        </select>  
                        @error('stream_id')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror					  
					
                  </div>
                </div>
                
                <div class="row">      
                  <div class="col-lg-12">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Status</label>
                      <select class="js-example-basic-single select2 col-sm-12 form-select" name="Status" id="status">                                                  
                        <option value="1" {{old('Status',$Courses->Status) =="1"? 'selected' : ''}}>Active</option>
                        <option value="0" {{old('Status',$Courses->Status) =="0"? 'selected' : ''}}>InActive</option>
                      </select>  
                      @error('Status')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>  
                             
                </div>                          
                
                <div class="row">
                  <div class="col-12">
                    <div>
                      <button type="submit" class="btn btn-primary me-3">Save</button>
                      <a href="{{url('trainning_course')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
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