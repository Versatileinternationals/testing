@extends('admin.layouts.light.master')
@section('title', 'Add Online Application')

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
                
              <form method="post" action="{{url('onlineformupdate/'.$BlzAppFormOnline->id)}}" class="form theme-form">
                @csrf
               
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                        <label class="col-form-label">Application Name</label>
                        <input class="form-control" type="text" value="{{old('application_name',$BlzAppFormOnline->application_name)}}" name="application_name" placeholder="Application Name">
                        @error('application_name')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Application Date</label>
                      <input class="form-control" type="date" value="{{old('application_date',$BlzAppFormOnline->app_date)}}" name="app_date" placeholder="Application Date">
                     
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Application Type</label>
                      <input class="form-control" type="text" value="{{old('application_type',$BlzAppFormOnline->application_type)}}" name="application_type" placeholder="Enter Application Type">                      
                      @error('application_type')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Application Code</label>
                      <input class="form-control" type="number" value="{{old('application_code',$BlzAppFormOnline->application_code)}}" name="application_code" placeholder="Application Code">                      
                      @error('application_code')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>
                </div> 
                <div class="row">      
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Application Address</label>
                      <input class="form-control" type="text" value="{{old('address',$BlzAppFormOnline->application_address)}}" name="application_address" placeholder="Application Address">                     
                      @error('address')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>              
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Status</label>
                      <select class="js-example-basic-single select2 col-sm-12 form-select" name="status" id="status">                                                  
                        <option value="1" {{old('Status') =="1"? 'selected' : ''}}>Active</option>
                        <option value="0" {{old('Status') =="0"? 'selected' : ''}}>InActive</option>
                      </select>  
                      @error('status')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
					
                  </div>                 
                </div> 
                <div class="row">      
                  <div class="col-6">
                    
					
					
                  </div>              
                  
				  
                </div> 
                
                
                
                <div class="row">
                  <div class="col-12">
                    <div>
                      <button type="submit" class="btn btn-primary me-3">Add</button>
                      <a href="{{url('blzinvst_online_application')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
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