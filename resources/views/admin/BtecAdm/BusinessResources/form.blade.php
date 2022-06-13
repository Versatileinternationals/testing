@extends('admin.layouts.light.master')
@section('title', 'Add Users')

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
              <form method="post" action="{{url('business_resources')}}" class="form theme-form">
                @csrf
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                        <label class="col-form-label">Resource Name</label>
                        <input class="form-control" type="text" value="{{old('resource_name')}}" name="resource_name" placeholder="Resource Name">
                        @error('resource_name')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Upload Document</label>
                      <input class="form-control" type="file" value="{{old('document_upload')}}" name="document_upload" >
                      
                    </div>
                  </div>
                </div>
                
                
				
                <div class="row">      
                  <div class="col-6">
                    
					
					<div class="form-group">
                        <label class="col-form-label">Resource Links</label>
                        <input class="form-control" type="text" value="{{old('resource_links')}}" name="resource_links" placeholder="Resource Links">
                        @error('resource_links')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>              
                  
				  
                </div> 
                
                
                
                <div class="row">
                  <div class="col-12">
                    <div>
                      <button type="submit" class="btn btn-primary me-3">Add</button>
                      <a href="{{url('business_resources')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
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