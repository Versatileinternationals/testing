@extends('admin.layouts.light.master')
@section('title', 'Edit Users')

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
              <form method="post" action="{{url('clienttestimonials/'.$ClientTestimonials->id)}}" class="form theme-form">
                @csrf
               
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                        <label class="col-form-label">Client Name</label>
                        <input class="form-control" type="text" value="{{old('name',$ClientTestimonials->name)}}" name="name" placeholder="Enter Name">
                        @error('name')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Description</label>
                      <input class="form-control" type="text" value="{{old('email',$ClientTestimonials->description)}}" name="description" placeholder="Enter Description">
                      @error('description')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Designation</label>
                      <input class="form-control" type="text" value="{{old('designation',$ClientTestimonials->designation)}}" name="designation" placeholder="Enter Designation">                      
                      @error('designation')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Country</label>
                      <input class="form-control" type="text" value="{{old('country',$ClientTestimonials->country)}}" name="country" placeholder="Enter Country">                      
                     
                    </div>
                  </div>
                </div> 
                <div class="row">      
                  <div class="col-12">
                    
                  </div>              
                                  
                </div> 
                <div class="row">      
                  <div class="col-6">
                    
					<div class="form-group mb-3">
                      <label class="col-form-label">Status</label>
                      <select class="js-example-basic-single select2 col-sm-12 form-select" name="status" id="status">                                                  
                        <option value="1" {{old('status',$ClientTestimonials->status) =="1"? 'selected' : ''}}>Active</option>
                        <option value="0" {{old('status',$ClientTestimonials->status) =="0"? 'selected' : ''}}>InActive</option>
                      </select>  
                      @error('status')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>              
                  <div class="col-6">
                    
					
                  </div>                 
                </div> 
             
                                    
                <div class="row">
                  <div class="col-12">
                    <div>
                      <button type="submit" class="btn btn-primary me-3">Save</button>
                      <a href="{{url('clienttestimonials')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
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