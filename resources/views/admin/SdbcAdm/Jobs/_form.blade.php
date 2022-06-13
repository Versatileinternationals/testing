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
              <form method="post" action="{{url('jobs/'.$BlzJobs->id)}}" class="form theme-form">
                @csrf
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                        <label class="col-form-label">Job Name</label>
                        <input class="form-control" type="text" value="{{old('JobName',$BlzJobs->JobName)}}" name="JobName" placeholder="Job Name">
                        @error('JobName')
                        <div class="text-danger show"><strong>{{$message}}</strong></div>
                        @enderror
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Job Type</label>
                      <input class="form-control" type="text" value="{{old('JobType',$BlzJobs->JobType)}}" name="JobType" placeholder="Enter Job Type">
                      @error('JobType')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Location</label>
                      <input class="form-control" type="text" value="{{old('Location',$BlzJobs->Location)}}" name="Location" placeholder="Enter Location">                      
                      @error('Location')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Salary</label>
                      <input class="form-control" type="number" value="{{old('Salary',$BlzJobs->Salary)}}" name="Salary" placeholder="Enter Salary">                      
                      @error('Salary')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>
                </div> 
                <div class="row">      
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Job Address</label>
                      <input class="form-control" type="text" value="{{old('JobAddress',$BlzJobs->JobAddress)}}" name="JobAddress" placeholder="Job Address">                     
                      @error('Job Address')
                      <div class="text-danger show"><strong>{{$message}}</strong></div>
                      @enderror
                    </div>
                  </div>              
                  <div class="col-6">
                    <div class="form-group mb-3">
                      <label class="col-form-label">Status</label>
                      <select class="js-example-basic-single select2 col-sm-12 form-select" name="Status" id="status">                                                  
                        <option value="1" {{old('VideoUpload',$BlzJobs->Status) =="1"? 'selected' : ''}}>Active</option>
                        <option value="0" {{old('VideoUpload',$BlzJobs->Status) =="0"? 'selected' : ''}}>InActive</option>
                      </select>  
                      @error('Status')
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
                      <button type="submit" class="btn btn-primary me-3">Save</button>
                      <a href="{{url('jobs')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
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