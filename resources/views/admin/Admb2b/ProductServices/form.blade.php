@extends('admin.layouts.light.master')
@section('title', 'Add Service')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>{{$moduleName}}</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{$moduleName}}</li>
<li class="breadcrumb-item active">Add</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <form method="post" action="{{url('product_services')}}" class="form theme-form">
                @csrf
                <div class="row">
                  <div class="col-12">
                   <div class="form-group mb-3">
                        <label class="col-form-label">Service Category</label>
                        <select class="js-example-basic-single select2 col-sm-12 form-select" name="category" id="category">                                                  
                          <option value="">Select Service Category</option>
                          @foreach ($service_category as $value)
                          <option value="{{$value->id}}" {{old('category') ==$value->id? 'selected' : ''}}>{{$value->name}}</option>    
                          @endforeach
                        </select>  
                        @error('category')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                      </div>
                  </div>
                  <div class="col-12">
                     <div class="form-group">
                      <label class="col-form-label">Description</label>
                      <textarea id="description" name="description" cols="30" rows="10">{{old('description')}}
                      </textarea>
                      @error('description')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                  </div>
                  </div>
				  
				  
                </div>
                 <div class="row">      
                  
				  
                  <div class="col-lg-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Status</label>
                      <select class="js-example-basic-single select2 col-sm-12 form-select" name="Status" id="status">                                                  
                        <option value="0">Save As Draft</option>
                        <option value="1">Published</option>
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
                      <button type="submit" class="btn btn-primary me-3">Add</button>
                      <a href="{{url('product_services')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
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